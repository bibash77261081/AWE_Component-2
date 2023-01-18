<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Operations</title>
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
</head>

<body>
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
                        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" placeholder="Product Name" value="{{ old('name', $product->name) }}">
                        @error('name')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror                        
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input class="form-control @error('price') is-invalid @enderror" type="text" name="price" id="price" placeholder="Price" value="{{ old('price', $product->price) }}">
                        @error('price')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror  
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="3">{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror  
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input class="form-control @error('image') is-invalid @enderror" type="file" name="image" id="image">
                        @error('image')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror  

                        <div class="pt-3">
                            @if($product->image != '' && file_exists(public_path().'/uploads/products/'.$product->image))
                            <img src="{{ url('uploads/products/'.$product->image) }}" alt="" width="100" height="100" class="rounded">
                            @endif
                        </div>
                    </div>

                    <button class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>