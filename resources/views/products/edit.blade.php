@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2>商品情報編集画面</h2>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="product_id" class="form-label">ID</label>
                                <input type="text" class="form-control-plaintext" id="product_id" name="product_id"
                                    value="{{ $product->id }}" readonly>
                            </div>


                            <div class="mb-3">
                                <label for="product_name" class="form-label">商品名<span class="text-danger">*</label>
                                <input type="text" class="form-control" id="product_name" name="product_name"
                                    value="{{ $product->product_name }}">
                                @error('product_name')
                                    <span style="color:red;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="company_id" class="form-label">メーカー名<span class="text-danger">*</label>
                                <select class="form-select" id="company_id" name="company_id">
                                    @foreach ($companies as $company)
                                        <option value="{{ $company->id }}"
                                            {{ $product->company_id == $company->id ? 'selected' : '' }}>
                                            {{ $company->company_name }}</option>
                                    @endforeach
                                </select>
                                @error('company_id')
                                    <span style="color:red;">{{ $message }}い</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="price" class="form-label">価格<span class="text-danger">*</label>
                                <input type="number" class="form-control" id="price" name="price"
                                    value="{{ $product->price }}">
                                @error('price')
                                    <span style="color:red;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="stock" class="form-label">在庫数<span class="text-danger">*</label>
                                <input type="number" class="form-control" id="stock" name="stock"
                                    value="{{ $product->stock }}">
                                @error('stock')
                                    <span style="color:red;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="comment" class="form-label">コメント</label>
                                <textarea id="comment" name="comment" class="form-control" rows="3">{{ $product->comment }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="img_path" class="form-label">商品画像</label>
                                <input id="img_path" type="file" name="img_path" class="form-control">
                                <img src="{{ asset($product->img_path) }}" alt="商品画像" class="product-image">
                            </div>

                            <button type="submit" class="btn btn-warning">更新</button>
                            <a href="{{ route('products.index') }}" class="btn btn-primary">戻る</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
