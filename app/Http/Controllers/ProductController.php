<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Company;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $query = Product::query();
        $search = $request->search;
        $company_id = $request->input('company_id');
        $companies = Company::all();



        if ($search) {
            $query->where('product_name', 'LIKE', "%" . $search . "%");
        }

        if ($company_id) {
            $query->where('company_id', $company_id);
        }



        $products = $query->paginate(10);

        return view('products.index', compact('products', 'company_id', 'search', 'companies'));
    }






    public function create()
    {
        $companies = Company::all();

        return view('products.create', compact('companies'));
    }


    public function store(Request $request)
    {

        $request->validate([
            'product_name' => 'required',
            'company_id' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'comment' => 'nullable',
            'img_path' => 'nullable|image',
        ]);



        $product = new Product([
            'product_name' => $request->get('product_name'),
            'company_id' => $request->get('company_id'),
            'price' => $request->get('price'),
            'stock' => $request->get('stock'),
            'comment' => $request->get('comment'),
        ]);

        if ($request->hasFile('img_path')) {
            $filename = $request->img_path->getClientOriginalName();
            $filePath = $request->img_path->storeAs('products', $filename, 'public');
            $product->img_path = '/storage/' . $filePath;
        }

        $product->save();

        return redirect('products');
    }


    public function show(Product $product)
    {
        $companies = Company::all();
        return view('products.show', compact('product', 'companies'));
    }


    public function edit(Product $product)
    {
        $companies = Company::all();


        return view('products.edit', compact('product', 'companies'));
    }


    public function update(Request $request, Product $product)
    {
        $request->validate([
            'product_name' => 'required',
            'company_id' => 'required',
            'price' => 'required',
            'stock' => 'required',
        ],[
            'product_name.required' =>'商品名を入力してください',
            'company_id.required' =>'メーカー名を選択してください',
            'price.required' =>'価格を入力してください',
            'stock.required' =>'在庫数を入力してください',
        ]);

        $product->product_name = $request->product_name;
        $product->company_id = $request->company_id;
        $product->price = $request->price;
        $product->stock = $request->stock;

        $product->save();

        return redirect()->route('products.index')
            ->with('success', 'product updated successfully');
    }


    public function destroy(Product $product)
    {
        $company = $product->company;

        $product->delete();

        if ($company->products()->count() === 0) {
            $company->delete();
        }

        return redirect('/products');
    }
}
