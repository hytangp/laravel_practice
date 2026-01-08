<form id="addUpdateProductForm" data-url="{{ !empty($product) ? route('product.update', $product->id) : route('product.store') }}" enctype="multipart/form-data">
    @csrf
    @if(!empty($product))
        @method('PUT')
    @endif
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">{{ !empty($product) ? 'Update' : 'Add' }} Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body form-group">
            <div class="mb-3">
                <label for="productName" class="col-form-label">Product Name:</label>
                <input name="name" type="text" class="form-control" value="{{ $product->name ?? '' }}" id="productName" required>
            </div>
            <div class="mb-3">
                <label for="productPrice" class="col-form-label">Price:</label>
                <input name="price" type="number" class="form-control" value="{{ $product->price ?? '' }}" id="productPrice" required min="0" step="0.01">
            </div>
            <div class="mb-3">
                <label for="productCategory" class="col-form-label">Category:</label>
                <select class="form-select" multiple name="categories[]">
                    <option disabled>Select category(s) of the Product</option>
                    @if(!empty($categories))
                        @foreach ($categories as $category)
                            <option {{ !empty($product) && !empty($product->linked_categories) && $product->linked_categories->contains('category_id', $category->id) ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->cat_name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="mb-3">
                <label for="productStatus" class="col-form-label">Status:</label>
                <select class="form-select" name="status" required>
                    <option {{ !empty($product) && $product->status == 'inactive' ? 'selected' : '' }} value="inactive">In-Active</option>
                    <option {{ !empty($product) && $product->status == 'active' ? 'selected' : '' }} value="active">Active</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Image:</label>
                <input name="image" class="form-control" type="file" id="formFile">
                @if(!empty($product) && !empty($product->image))
                    <img src="{{ asset('storage/' . $product->image) }}" class="img-thumbnail show-uploaded-image mt-2" width="100">
                @endif
            </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" id="addUpdateProductBtn" class="btn btn-primary">Save changes</button>
    </div>
</form>