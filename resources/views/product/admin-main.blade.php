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
    <nav class="navbar sticky-top navbar-expand-lg bg-body-tertiary" style="background-color: #e3f2fd;">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('products.index') }}">EZ Gadgets</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('products.index') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products.index') }}">Products</a>
                    </li>
                </ul>
                <div class="row justify-content-between">
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

    @yield('content')

    </div>
    <script>
        function deleteProduct(id) {
            if (confirm("Are you sure you want to delete?")) {
                document.getElementById('product-edit-action-' + id).submit();
            }
        }
    </script>
</body>

</html>
