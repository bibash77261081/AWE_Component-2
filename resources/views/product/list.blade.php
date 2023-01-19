@extends('product.admin-main')
@section('content')

<div class="container">
    <div class="row align-items-centre py-3">
        <div class="col h2 text-center">CRUD Operations</div>
    </div>

    <div class="row justify-content-between">
        <div class="col h4">Products</div>
        <div class="col-auto">
            <a href="{{ route('products.create') }}" class="btn btn-primary">Add Product</a>
        </div>
    </div>

    <div class="row align-items-centre p-3">
        @if (Session::has('success'))
            <div class="col alert alert-success text-center mt-3">
                {{ Session::get('success') }}
            </div>
        @endif
    </div>
    <div class="card border-0 shadow-lg">
        <div class="card-body">
            <table class="table table-striped">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>

                @if ($products->isNotEmpty())
                    @foreach ($products as $product)
                        <tr valign="middle">
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->description }}</td>
                            <td>
                                @if ($product->image != '' && file_exists(public_path('/uploads/products/' . $product->image)))
                                    <img src="{{ url('uploads/products/' . $product->image) }}" alt=""
                                        width="60" height="60" class="rounded">
                                @else
                                    <img src="{{ url('assets/images/no-image.png') }}" alt="" width="50"
                                        height="50" class="rounded">
                                @endif
                            </td>
                            <td>{{ $product->category->name }}</td>
                            <td>
                                <a href="{{ route('products.edit', $product->id) }}"
                                    class="btn btn-primary btn-sm">Edit</a>
                                <a href="#" onClick="deleteProduct({{ $product->id }})"
                                    class="btn btn-danger btn-sm">Delete</a>

                                <form id="product-edit-action-{{ $product->id }}"
                                    action="{{ route('products.destroy', $product->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="colspan-8">Products Not Found</td>
                    </tr>
                @endif
            </table>
        </div>
    </div>
    <div class="mt-4">
        {{ $products->links() }}
    </div>
</div>

@endsection
