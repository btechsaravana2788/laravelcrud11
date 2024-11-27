@extends('products.layout')
  
@section('content')

<div class="card mt-5">
  <h2 class="card-header">Show Product</h2>
  <div class="card-body">
  
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-primary btn-sm" href="{{ route('products.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
    </div>
  
    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Name:</strong> <br/>
                {{ $product->name }}
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 mt-2">
            <div class="form-group">
                <strong>Details:</strong> <br/>
                {{ $product->description }}
            </div>
        </div>
		<div class="col-xs-6 col-sm-6 col-md-6 mt-2">
            <div class="form-group">
                <strong>Slug:</strong> <br/>
                {{ $product->slug }}
            </div>
        </div>
		<div class="col-xs-6 col-sm-6 col-md-6 mt-2">
            <div class="form-group">
                <strong>SKU:</strong> <br/>
                {{ $product->sku }}
            </div>
        </div>
		<div class="col-xs-6 col-sm-6 col-md-6 mt-2">
            <div class="form-group">
                <strong>Price:</strong> <br/>
                {{ $product->price }}
            </div>
        </div>
    </div>
  
  </div>
</div>
@endsection