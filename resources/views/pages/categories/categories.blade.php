@extends('layouts.app')

@section('title', 'Categories List')

@section('content')
    <div class='container'>
        <div class="d-flex flex-column align-items-center text-center my-3">
            <h1>Categories List</h1>
            <div class="alert alert-success m-2 d-none alert-dismissible fade show" id="successAlert" role="alert">
                <strong></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <div class="alert alert-danger m-2 d-none alert-dismissible fade show" id="errorAlert" role="alert">
                <strong></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        <button type="button" class="btn btn-primary p-2 m-2" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">Add Category</button>

        <div id="category_listing_table">
            @include('pages.templates.categories.category_listing', ['categories' => $categories ?? null])
        </div>
    </div>

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" id="addUpdateCategoryFormModal">
                @include('pages.templates.categories.category_add_update_form')
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const categoryStoreUrl = "{{ route('category.store') }}";
        const csrfToken = "{{ csrf_token() }}";
    </script>
    <script src="{{ asset('js/categories/category.js') }}"></script>
@endsection