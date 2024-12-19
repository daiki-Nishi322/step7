<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SalesController extends Controller
{
    public function purchase(Request $request)
{

    DB::beginTransaction();

    try {
        $productId = $request->input('product_id');
    $quantity = $request->input('quantity', 1);


    $product = Product::find($productId);


    if (!$product) {
        return response()->json(['message' => '商品が存在しません'], 404);
    }
    if ($product->stock < $quantity) {
        return response()->json(['message' => '商品が在庫不足です'], 400);
    }


    $product->stock -= $quantity;
    $product->save();



    $sale = new Sale([
        'product_id' => $productId,
        'quantity' => $quantity,
    ]);

    $sale->save();

    DB::commit();


    return response()->json(['message' => '購入成功']);
    } catch (\Exception $e) {
        DB::rollBack();

        Log::error('購入処理中にエラーが発生しました:'.$e->getMessage());

        return response()->json(['error' => '購入処理に失敗しました'], 500);
    }


}


public function yourMethod()
{
    try {
        // ここにコードを記述
    } catch (\Exception $e) {
        // エラーをログに記録
        Log::error('エラーが発生しました: '.$e->getMessage());

        // クライアントに一般的なエラーメッセージを返す
        return response()->json(['error' => '内部サーバーエラー'], 500);
    }
}


}
