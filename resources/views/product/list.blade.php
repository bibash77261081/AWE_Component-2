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
    <nav class="navbar navbar-expand-lg bg-body-tertiary" style="background-color: #e3f2fd;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">EZ Gadgets</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('home.index')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Category</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                </ul>
                <div class="row justify-content-between">
                    @if (auth()->user())
                    <form action="" method="post" class="d-flex col-9" role="search">
                    @else
                    <form action="" method="post" class="d-flex col-7" role="search">
                    @endif
                        @csrf
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-primary" type="submit">Search</button>
                    </form>
                    @if (auth()->user())
                    <form class="col-2 me-4 px-2" action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-primary"> Logout</button>
                    </form>
                    @else
                    <button class="btn btn-primary col-2">Login</button>
                    <button class="btn btn-primary mx-2 col-2">Register</button>
                    @endif
                </div>
            </div>
        </div>
    </nav>

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
            @if(Session::has('success'))
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

                    @if($products -> isNotEmpty())
                    @foreach($products as $product)
                    <tr valign="middle">
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->description }}</td>
                        <td>
                            @if($product->image != '' && file_exists(public_path('/uploads/products/'.$product->image)))
                            <img src="{{ url('uploads/products/'.$product->image) }}" alt="" width="60" height="60" class="rounded">
                            @else
                            <img src="{{url('assets/images/no-image.png')}}" alt="" width="50" height="50" class="rounded">
                            @endif
                        </td>
                        <td>{{ $product->category->name }}</td>
                        <td>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <a href="#" onClick="deleteProduct({{ $product->id }})" class="btn btn-danger btn-sm">Delete</a>

                            <form id="product-edit-action-{{$product->id}}" action="{{ route('products.destroy', $product->id) }}" method="post">
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
</body>
</html>

<script>
    function deleteProduct(id){
        if(confirm("Are you sure you want to delete?")){
            document.getElementById('product-edit-action-'+id).submit();
        }
    }
</script>
