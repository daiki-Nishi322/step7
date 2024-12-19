@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">商品一覧画面</h1>

        <div class="search mt-5">

            <form id="searchForm" action="{{ route('products.index') }}" method="GET" class="row g-3">

                <div class="col-sm-12 col-md-2">
                    <input type="text" name="search" class="form-control" placeholder="検索キーワード"
                        value="{{ request('search') }}">
                </div>


                <div class="col-sm-12 col-md-2">
                    <select name="company_id" class="form-control">
                        <option value="">メーカー名を選択</option>
                        @foreach ($companies as $company)
                            <option value="{{ $company->id }}" {{ $company_id == $company->id ? 'selected' : '' }}>
                                {{ $company->company_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-sm-12 col-md-2">
                    <input type="number" name="min_price" class="form-control" placeholder="最小価格"
                        value="{{ request('min_price') }}">
                </div>

                <div class="col-sm-12 col-md-2">
                    <input type="number" name="max_price" class="form-control" placeholder="最大価格"
                        value="{{ request('max_price') }}">
                </div>

                <div class="col-sm-12 col-md-2">
                    <input type="number" name="min_stock" class="form-control" placeholder="最小在庫"
                        value="{{ request('min_stock') }}">
                </div>

                <div class="col-sm-12 col-md-2">
                    <input type="number" name="max_stock" class="form-control" placeholder="最大在庫"
                        value="{{ request('max_stock') }}">
                </div>






                <div class="col-sm-12 col-md-3">
                    <button class="btn btn-outline-secondary" type="submit">検索</button>
                </div>
            </form>

            <a href="{{ route('products.index') }}" class="btn btn-success mt-3">検索条件を元に戻す</a>



        </div>



        <div id="productsList" class="products mt-5">
            @include('products.list', ['products' => $products])
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var $ = jQuery.noConflict();
        $(document).ready(function() {
            console.log("jQuery is loaded and ready!");
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#searchForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('products.index') }}",
                    type: "GET",
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#productsList').html(response);
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });

            $(document).on('click', '.delete-button', function(e) {
                e.preventDefault();

                var form = $(this).closest('form');
                console.log("Form action:", form.attr('action'));

                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        console.log("Delete request successful.");
                        form.closest('tr').remove();
                    },
                    error: function(xhr) {
                        console.log("Delete request failed.");
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endsection
