

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>商品画像</th>
            <th>商品名</th>
            <th>価格
                <a href="{{ request()->fullUrlWithQuery(['sort' => 'price', 'direction' => 'asc']) }}">↑</a>
                <a href="{{ request()->fullUrlWithQuery(['sort' => 'price', 'direction' => 'desc']) }}">↓</a>
            </th>
            <th>在庫数
                <a href="{{ request()->fullUrlWithQuery(['sort' => 'stock', 'direction' => 'asc']) }}">↑</a>
                <a href="{{ request()->fullUrlWithQuery(['sort' => 'stock', 'direction' => 'desc']) }}">↓</a>
            </th>
            <th>メーカー名</th>
            <th><a href="{{ route('products.create') }}" class="btn btn-warning">新規登録</a></th>
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
                    <form method="POST" action="{{ route('products.destroy', $product) }}" class="d-inline delete-form" data-id="{{ $product->id }}">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="btn btn-danger btn-sm mx-1" value="削除" onclick='return confirm("本当に削除しますか？")'>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $products->appends(request()->query())->links() }}
