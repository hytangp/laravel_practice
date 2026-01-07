<form id="addUpdateProductForm" data-url="{{ isset($product) ? route('product.update', $product->id) : route('product.store') }}" enctype="multipart/form-data">
    @csrf
    @if(isset($product))
        @method('PUT')
    @endif
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">{{ isset($product) ? 'Update' : 'Add' }} Product</h5>
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
                <label for="productStatus" class="col-form-label">Status:</label>
                <select class="form-select" name="status" required>
                    <option {{ isset($product) && $product->status == 'inactive' ? 'selected' : '' }} value="inactive">In-Active</option>
                    <option {{ isset($product) && $product->status == 'active' ? 'selected' : '' }} value="active">Active</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Image:</label>
                <input name="image" class="form-control" type="file" id="formFile">
                @if(isset($product) && !empty($product->image))
                    <img src="{{ asset('storage/' . $product->image) }}" class="img-thumbnail show-uploaded-image mt-2" width="100">
                @endif
            </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" id="addUpdateProductBtn" class="btn btn-primary">Save changes</button>
    </div>
</form>