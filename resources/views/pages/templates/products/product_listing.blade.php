<table class="table table-dark table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Status</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @if(!$products || $products->isEmpty())
            <tr>
                <td colspan="6">No products available.</td>
            </tr>
        @else
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->status_name }}</td>
                    <td><img src="{{ $product->image ? 'storage/'.$product->image : '' }}" width="100"></td>
                    <td><button type="button" class="btn btn-success edit-product" data-url="{{ route('product.edit', $product->id) }}">Edit</button>
                        <button type="button" class="btn btn-danger delete-product" data-url="{{ route('product.destroy', $product->id) }}">Delete</button>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>