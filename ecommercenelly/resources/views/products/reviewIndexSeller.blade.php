@extends('layoutsSeller')

@section('content')
    <table class="table table-condensed table-striped table-hover table-bordered">
        <tr>
            <th>Review</th>
            <th>Product Name</th>
            <th>From</th>
            <th>Review</th>
        </tr>
        
        @if(count($reviews))
            @foreach($products as $product)
            <tr>
            @foreach($reviews as $review)
            
                <td>{{ $review->id }}</td>
                <td>{{ $product->product_name }}</td>
                <td>{{ Auth::user()->find($review->user_id)->name }}</td>
                <td>{{ $review->review }}</td>
                   @endforeach         
            </tr>

            @endforeach
        @endif       
       
    
    </table>

@endsection

