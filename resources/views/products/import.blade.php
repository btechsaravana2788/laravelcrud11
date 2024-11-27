@extends('products.layout')
    
@section('content')
  
<div class="card mt-5">
  <h2 class="card-header">Add New Product</h2>
  <div class="card-body">
  
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-primary btn-sm" href="{{ route('products.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
    </div>
  
    <form action="{{ route('products.importstore') }}" method="POST" enctype="multipart/form-data">
        @csrf
  
        <div class="mb-3">
            <label for="inputName" class="form-label"><strong>Upload CSV File:</strong></label>
            <input 
                type="file" 
                name="file" 
                class="form-control @error('file') is-invalid @enderror" 
                id="inputName" 
                placeholder="Upload CSV File">
            @error('file')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Upload</button>
    </form>
  
  </div>
</div>
@endsection