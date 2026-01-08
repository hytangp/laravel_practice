<table class="table table-dark table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Descripton</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @if(!$categories || $categories->isEmpty())
            <tr>
                <td colspan="5">No categories available.</td>
            </tr>
        @else
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description }}</td>
                    <td>{{ $category->status_name }}</td>
                    <td><button type="button" class="btn btn-success edit-category" data-url="{{ route('category.edit', $category->id) }}">Edit</button>
                        <button type="button" class="btn btn-danger delete-category" data-url="{{ route('category.destroy', $category->id) }}">Delete</button>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>