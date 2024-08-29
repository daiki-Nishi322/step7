@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">商品新規登録画面</h1>



    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">

        @csrf



        <div class="mb-3">
            <label for="product_name" class="form-label">商品名<span class="text-danger">*</label>
            <input id="product_name" type="text" name="product_name" class="form-control">
            @error('product_name')
            <span style="color:red;">商品名を入力してください</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="company_id" class="form-label">メーカー<span class="text-danger">*</label>
            <select class="form-select" id="company_id" name="company_id">
                <option value=""></option>
                @foreach($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                @endforeach
            </select>
            @error('company_id')
            <span style="color:red;">メーカーを選択してください</span>
            @enderror
        </div>


        <div class="mb-3">
            <label for="price" class="form-label">価格<span class="text-danger">*</label>
            <input id="price" type="text" name="price" class="form-control">
            @error('price')
            <span style="color:red;">価格を入力してください</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">在庫数<span class="text-danger">*</label></label>
            <input id="stock" type="text" name="stock" class="form-control">
            @error('stock')
            <span style="color:red;">在庫数を入力してください</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="comment" class="form-label">コメント</label>
            <textarea id="comment" name="comment" class="form-control" rows="3" ></textarea>
        </div>

        <div class="mb-3">
            <label for="img_path" class="form-label">商品画像</label>
            <input id="img_path" type="file" name="img_path" class="form-control" >
        </div>

        <button type="submit" class="btn btn-warning">新規登録</button>
        <a href="{{ route('products.index') }}" class="btn btn-primary">戻る</a>
    </form>


</div>
@endsection
