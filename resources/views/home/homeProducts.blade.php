<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
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
                        <a class="nav-link active" aria-current="page" href="{{ route('home.index') }}">Home</a>
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
                        <button class="btn btn-primary me-4 col-2">Logout</button>
                    @else
                        <button class="btn btn-primary col-2">Login</button>
                        <button class="btn btn-primary mx-2 col-2">Register</button>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    {{-- product card --}}
    <div class="container my-3">
        <h2 class="text-center">EZ Gadgets Products</h2>
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4">
                    <div class="card my-3" style="width: 18rem;">
                        @if($product->image != '' && file_exists(public_path('/uploads/products/'.$product->image)))
                        <img src="{{ url('uploads/products/'.$product->image) }}" class="card-img-top" alt="...">
                        @else
                        <img src="{{url('assets/images/no-image.png')}}" class="card-img-top" alt="...">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">$ {{ $product->price }}</li>
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="mt-4">
        {{ $products->links() }}
    </div>

    <div class="container-fluid bg-dark text-light">
        <p class="text-center mb-0">
            Copyright EZ Gadgets 2023 | All right reserved
        </p>
    </div>
</body>

</html>

<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
