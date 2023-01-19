@extends('product.admin-main')
@section('content')

<div class="container">
    <div class="d-flex flex-column py-4">
        <div class="h2 text-center">CRUD Operations</div>
        <div class="d-flex justify-content-between">
            <div class="h4">Edit Product</div>
            <div>
                <a href="{{ route('products.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <div class="card border-0 shadow-lg">
        <div class="card-body">
            <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input class="form-control @error('name') is-invalid @enderror" type="text" name="name"
                        id="name" placeholder="Product Name" value="{{ old('name', $product->name) }}">
                    @error('name')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input class="form-control @error('price') is-invalid @enderror" type="number" name="price"
                        id="price" placeholder="Price" value="{{ old('price', $product->price) }}">
                    @error('price')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                        rows="3">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input class="form-control @error('image') is-invalid @enderror" type="file" name="image"
                        id="image">
                    @error('image')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror

                    <div class="pt-3">
                        @if ($product->image != '' && file_exists(public_path() . '/uploads/products/' . $product->image))
                            <img src="{{ url('uploads/products/' . $product->image) }}" alt="" width="100"
                                height="100" class="rounded">
                        @endif
                    </div>
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select class="form-select @error('category') is-invalid @enderror" name="category" id="category">
                        @if ($categories->isNotEmpty())
                            <option value="{{ $product->category->id }}" selected>
                                {{ old('category', $product->category->name) }}</option>

                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        @else
                            <option selected>Category not Found</option>
                        @endif
                    </select>
                    @error('category')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>

                <button class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>

@endsection
