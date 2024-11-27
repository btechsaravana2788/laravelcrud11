@extends('products.layout')
   
@section('content')
  
<div class="card mt-5">
  <h2 class="card-header">Laravel Interview Task</h2>
  <div class="card-body">
          
        @session('success')
            <div class="alert alert-success" role="alert"> {{ $value }} </div>
        @endsession
		@session('error')
            <div class="alert alert-danger" role="alert"> {{ $value }} </div>
        @endsession
		@session('updated')
            <div class="alert alert-info" role="alert"> {{ $value }} </div>
        @endsession
		@session('deleted')
            <div class="alert alert-danger" role="alert"> {{ $value }} </div>
        @endsession
  
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="btn btn-success btn-sm" href="{{ route('products.create') }}"> <i class="fa fa-plus"></i> Create New Product</a>
			<a class="btn btn-success btn-sm" href="{{ route('products.import') }}"> <i class="fa fa-plus"></i> Import Product</a>
			<a class="btn btn-success btn-sm" href="{{ route('products.export') }}"> <i class="fa fa-plus"></i> Export Product</a>
        </div>
  
        <table class="table table-bordered table-striped mt-4">
            <thead>
                <tr>
                    <th width="80px">No</th>
                    <th>Product Name</th>
                    <th>Product Description</th>
					<th>Product Slug</th>
					<th>Product SKU</th>
					<th>Product Price</th>
                    <th width="250px">Action</th>
                </tr>
            </thead>
  
            <tbody>
            @forelse ($products as $product)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
					<td>{{ $product->slug }}</td>
					<td>{{ $product->sku }}</td>
					<td>{{ $product->price }}</td>
                    <td>
                        <form action="{{ route('products.destroy',$product->id) }}" method="POST">
             
                            <a class="btn btn-info btn-sm" href="{{ route('products.show',$product->id) }}"><i class="fa-solid fa-list"></i> Show</a>
              
                            <a class="btn btn-primary btn-sm" href="{{ route('products.edit',$product->id) }}"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
             
                            @csrf
                            @method('DELETE')
                
                            <button type="submit" class="btn btn-danger btn-sm delete-button"><i class="fa-solid fa-trash"></i> Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7 text-center">There are no data.</td>
                </tr>
            @endforelse
            </tbody>
  
        </table>
        
        {!! $products->links() !!}
  
  </div>
  <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('.delete-button');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function () {
                    if (confirm('Are you sure you want to delete this item?')) {
                        this.closest('form').submit();
                    }
                });
            });
        });
    </script>
</div>  
@endsection