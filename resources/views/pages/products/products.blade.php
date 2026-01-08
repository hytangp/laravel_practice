@extends('layouts.app')

@section('title', 'Product List')

@section('content')
    <div class='container'>
        <div class="d-flex flex-column align-items-center text-center my-3">
            <h1>Product List</h1>
            <div class="alert alert-success m-2 d-none alert-dismissible fade show" id="successAlert" role="alert">
                <strong></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <div class="alert alert-danger m-2 d-none alert-dismissible fade show" id="errorAlert" role="alert">
                <strong></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        <button type="button" class="btn btn-primary p-2 m-2" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">Add Product</button>

        <div id="product_listing_table">
            @include('pages.templates.products.product_listing', ['products' => $products ?? null])
        </div>
        <p>
            <a href="{{ route('category.index') }}" class="m-2 link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Get Categories</a>
            <a href="{{ route('dashboard') }}" class="m-2 link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Dashboard</a>
        </p>
    </div>

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" id="addUpdateProductFormModal">
                @include('pages.templates.products.product_add_update_form')
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const productStoreUrl = "{{ route('product.store') }}";
        const csrfToken = "{{ csrf_token() }}";
    </script>
    <script src="{{ asset('js/products/product.js') }}"></script>
@endsection