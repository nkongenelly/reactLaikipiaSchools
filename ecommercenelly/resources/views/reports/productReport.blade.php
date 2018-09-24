@extends('layoutsSeller')

@section('content')
<a href="/reports/{{ Auth::user()->id }}" class="btn btn-warning">Back</a>
    <table class="table table-condensed table-striped table-hover table-bordered">
        <tr>
            
            <th>Product Name</th>
            <th>Buyer</th>
            <th>Quantity</th>
            <th>Order Price</th>
        </tr>
        
                <tr>
                    <td>{{ $products }}</td>
                    <td>{{ $buyername }}</td>
                    <td>{{ $quantity }}</td>
                    <td>{{ $price }}</td>               
                </tr>
          
       
    
    </table>

@endsection

