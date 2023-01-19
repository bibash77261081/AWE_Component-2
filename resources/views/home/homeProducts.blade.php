@extends('home.main')
@section('content')

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

@endsection
