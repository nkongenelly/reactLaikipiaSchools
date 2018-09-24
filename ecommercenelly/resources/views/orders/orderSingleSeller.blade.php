@extends('layoutsSeller')

@section('content')
    <div class="row">
        <div class="col-sm-7">
            <table class="table table-condensed table-striped table-hover table-bordered">

                <tr>
                    <th>Order No.</th>
                    <th>Product Name</th>
                    <th>Buyer Name</th>
                    <th>Quantity</th>
                    <th>Product price</th>
                    <th>Action</th>
                </tr>
                
        
                <tr>
                    <td>{{ $order }}</td>
                    <td>{{ $product }}</td>
                    <td>{{ $user }}</td>
                    <td>{{ $quantity }}</td>               
                    <td>{{ $price}}</td>
                    <td>
                        <a href="/orderscomplete/{{ $userid }}/{{ $order }}" class="btn btn-warning">Complete Order</a>
                    </td>
                </tr>
            
            
            
            </table>
        </div>
    </div>

@endsection

