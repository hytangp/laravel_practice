<form id="addUpdateCategoryForm" data-url="{{ isset($category) ? route('category.update', $category->id) : route('category.store') }}" enctype="multipart/form-data">
    @csrf
    @if(isset($category))
        @method('PUT')
    @endif
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">{{ isset($category) ? 'Update' : 'Add' }} Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body form-group">
            <div class="mb-3">
                <label for="categoryName" class="col-form-label">Category Name:</label>
                <input name="name" type="text" class="form-control" value="{{ $category->name ?? '' }}" id="categoryName" required>
            </div>
            <div class="mb-3">
                <label for="categoryDescription" class="col-form-label">Description:</label>
                <input name="description" type="text" class="form-control" value="{{ $category->description ?? '' }}" id="categoryDescription" required>
            </div>
            <div class="mb-3">
                <label for="categoryStatus" class="col-form-label">Status:</label>
                <select class="form-select" name="status" required>
                    <option {{ isset($category) && $category->status == 'inactive' ? 'selected' : '' }} value="inactive">In-Active</option>
                    <option {{ isset($category) && $category->status == 'active' ? 'selected' : '' }} value="active">Active</option>
                </select>
            </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" id="addUpdateCategoryBtn" class="btn btn-primary">Save changes</button>
    </div>
</form>