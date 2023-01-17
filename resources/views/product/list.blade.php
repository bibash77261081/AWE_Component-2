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
                <div class="h4">Products</div>
                <div>
                    <a href="{{ route('products.create') }}" class="btn btn-primary">Add Product</a>
                </div>
            </div>
            @if(Session::has('success'))
            <div class="alert alert-success text-center mt-5">
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
                        <th>Action</th>
                    </tr>

                    @if($products -> isNotEmpty())
                    foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->description }}</td>
                        <td>
                            @if($products->image != '' && file_exists(public_path().'/uploads/products/'.$product->image))
                            <img src="{{ url('uploads/products/'.$product->image) }}" alt="" width="50" height="50" class="rounded-circle">
                            @endif
                        </td>
                        <td>
                            <a href="#" class="btn btn-primary btn-sm">Edit</a>
                            <a href="#" class="btn btn-danger btn-sm">Delete</a>
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
    </div>
</body>
</html>