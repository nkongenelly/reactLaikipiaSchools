@extends('layoutsBuyer')

@section('content')
    <div class="row">
        <div class="col-sm-7">
            <table class="table table-condensed table-striped table-hover table-bordered">

                <tr>
                    <th>Product Name</th>
                    <th>Seller Name</th>
                    <th colspan="2">Action</th>
                </tr>
                
        @foreach($productss as $product)
                <tr>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $user }}</td>
                    <td>
                    <a href="/orders/cart/{{ $product->id }}" class="btn btn-outline-success my-2 my-sm-0">Add to Cart</a>
                    </td>
                    <td>
                    <a href="/reviewsbuyer/{{ $product->id }}" class="btn btn-outline-success my-2 my-sm-0">Add Review</a>
                    </td>
                </tr>
      
            
            
            
            </table>
        </div>
        <div class="col sm 5">
        
                <img src="/images/{{ $product->product_image }}" 
            style="width:150px; height:150px;"> 
              
       </div>
    </div>
    @endforeach
@endsection

