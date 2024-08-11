@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">商品一覧画面</h1>


<div class="search mt-5">



    <form action="{{ route('products.index') }}"  method="GET" class="row g-3">


        <!-- 商品名検索用の入力欄 -->
        <div class="col-sm-12 col-md-3">
            <input type="text" name="search" class="form-control" placeholder="検索キーワード" value="{{ request('search') }}">
        </div>


        <div class="col-sm-12 col-md-3">
            <select name="company_id" class="form-control">
                <option value="" >メーカー名を選択</option>
                @foreach($companies as $company)
                <option value="{{ $company->id }}" {{ $company_id == $company->id ? 'selected' : '' }}>
                    {{ $company->company_name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="col-sm-12 col-md-3">
            <button class="btn btn-outline-secondary" type="submit">検索</button>
        </div>
    </form>

         <!-- 商品一覧を表示する部分 -->
     @foreach($products as $product)
         <!-- 商品情報を表示 -->
     @endforeach
</div>





    <div class="products mt-5">

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>商品画像</th>
                    <th>商品名</th>
                    <th>価格</th>
                    <th>在庫数</th>
                    <th>メーカー名</th>
                    <th><a href="{{ route('products.create') }}" class="btn btn-warning ">新規登録</a></th>
                </tr>
            </thead>
            <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td><img src="{{ asset($product->img_path) }}" alt="商品画像" width="100"></td>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->company->company_name }}</td>
                    <td>
                        <a href="{{ route('products.show', $product) }}" class="btn btn-info btn-sm mx-1">詳細</a>
                        <form method="POST" action="{{ route('products.destroy', $product) }}" class="d-inline" onsubmit="return confirmDelete()">
                            @csrf
                            @method('DELETE')
                            {{-- <button type="submit" class="btn btn-danger btn-sm mx-1">削除</button> --}}
                            <input type="submit" class="btn btn-danger btn-sm mx-1" value="削除" onclick='return confirm("本当に削除しますか？")''>
                        </form>

                    </td>
                </tr>
            @endforeach


            </tbody>
        </table>
    </div>

    {{ $products->appends(request()->query())->links() }}


</div>


@endsection
