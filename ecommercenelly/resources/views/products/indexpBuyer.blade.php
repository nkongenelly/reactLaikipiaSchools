@extends('layoutsBuyer')

@section('content')
<div class="row">
    <div class="col-sm-11">
        <table class="table table-condensed table-striped table-hover table-bordered">
            <tr>
                <th>#</th>
                <th>Category</th>
                <th>Product Name</th>
                <th>Product Features</th>
                <th>Product description</th>
                <th>Product Price</th>
                <th>Created On</th>
                <th colspan="3">Action</th>
            </tr>
            
    @if(array($products))
    
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->category['category_name'] }}</td>
                            <td>{{ $product->product_name }}</td>
                            <td>
                                @foreach($product->features as $feature)
                                    <ol>
                                        <li>{{ $feature->feature_name}}</li>
                                    </ol>
                                @endforeach
                            </td>     
                            @if(array($cart))
                                <input type="hidden" value="{{ $orderid }}" name ="order_id">
                            @endif     
                            <td>{{ $product->product_description }}</td>
                            <td>{{ $product->product_price }}</td>
                            <td>{{ $product->created_at->diffForHumans() }}</td>
                            @if($product->product_status == "2")
                            <td>
                                <a href="#" class="btn btn-success disabled" title="Out of Stock">View</a>
                            </td>
                            <td>
                                <a href="#" class="btn btn-success disabled" title="Out of Stock">Add to Cart</a>
                            </td>
                            <td>
                            <a href="/reviewsbuyer/{{ $product->id }}" class="btn btn-outline-success my-2 my-sm-0" >Review</a>
                            </td>
                            @else
                            <td>
                                <a href="/orderbuyerview/{{ $product->id }}" class="btn btn-outline-success my-2 my-sm-0" >View</a>
                            </td>
                             <td>
                                <a href="/orders/cart/{{ $product->id }}" class="btn btn-outline-success my-2 my-sm-0" >Add to Cart</a>
                            </td>
                           
                            <td>
                                <a href="/reviewsbuyer/{{ $product->id }}" class="btn btn-outline-success my-2 my-sm-0" >Review</a>
                            </td>

                            @endif
                        </tr>
                    @endforeach 
        @endif       
        
        
        </table>
    </div>
    <div class="col-sm-1">
     @include('sidebar')
    </div>
</div>
    

@endsection

