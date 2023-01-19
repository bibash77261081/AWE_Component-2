@extends('home.main')
@section('content')

    {{-- categoires card --}}
    <div class="container my-3">
        <h2 class="text-center">EZ Gadgets Category</h2>
        <div class="row">
            @foreach ($categories as $category)
                <div class="col-md-4">
                    <div class="card my-3" style="width: 18rem;">
                        <img src="https://source.unsplash.com/800x450/?'.{{ $category->name }}.',electronics"
                            class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $category->name }}</h5>
                            <a href="#" class="btn btn-primary">View Products</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="mt-4">
        {{ $categories->links() }}
    </div>

@endsection
