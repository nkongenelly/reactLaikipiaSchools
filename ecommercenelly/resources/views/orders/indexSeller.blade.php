@extends('layoutsSeller')

@section('content')
<a href="/productsbuyer" class="btn btn-warning">Back</a>
    <table class="table table-condensed table-striped table-hover table-bordered">
        <tr>   
        <th>Product Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th colspan="2">Action</th>
        </tr>
        @if(array($orders))
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order['product_name'] }}</td>
                        <td>
                        <a href="/orderviewsingle/{{ $order['id'] }}" class="btn btn-warning">View</a>    
                        </td>
                        <td>
                            <a href="/orderscomplete/{{ $order['id'] }}/$order['user_id'] }}" class="btn btn-outline-success my-2 my-sm-0">Complete Orders</a>
                        </td>
                        </tr>
                @endforeach
            @endif
                
       
           
    
    </table>
    

@endsection

