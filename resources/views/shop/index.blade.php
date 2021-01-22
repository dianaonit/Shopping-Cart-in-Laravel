@extends('layouts.master')

@section('title')
Laravel Shopping Cart
@endsection

@section('content')
  @if(Session::has('success'))
      <div class="row">
          <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
              <div id="charge-message" class="alert alert-success">
                 {{ Session::get('success') }}
              </div>
          </div>
      </div>
  @endif
   @foreach($products->chunk(3) as $productChunk)<!-- chunk() splits all data into separate selects, like pagination -->
   <div class="row">
       @foreach($productChunk  as $product)
       <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <img src="{{ $product->imagePath }}" alt="..." class="img-responsive">
                <div class="caption">
                    <h3>{{ $product->title }}</h3><!-- title of every products -->
                    <p class="description">{{ $product->description }}</p><!-- description of every products -->
                    <div class="clearfix">
                        <div class="pull-left price">${{ $product->price }}</div><!-- price of every products -->
                        <a href="{{ route('product.addToCart',['id' => $product->id]) }}" class="btn btn-success pull-right" role="button">Add to Cart</a>
                    </div>
                </div>
            </div>
        </div>
       @endforeach
    </div>
   @endforeach

   
@endsection