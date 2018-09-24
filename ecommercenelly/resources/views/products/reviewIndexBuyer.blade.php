@extends('layoutsBuyer')

@section('content')
    <table class="table table-condensed table-striped table-hover table-bordered">
        <tr>
            <th>#</th>
            <th>Product Name</th>
            <th>From</th>
            <th>Seller</th>
            <th>Review</th>
            <th>Action</th>
        </tr>
        
        @if(count($reviews))
            @foreach($reviews as $review)
            <tr>
                <td>{{ $review->id }}</td>
                <td>{{ $review->product->product_name }}</td>
                <td>{{ Auth::user()->find($review->user_id)->name }}</td>               
                <td>{{ Auth::user()->find($review->product->user_id)->name }}</td>
                <td>{{ $review->review }}</td>
                <td>
                    @if(($review->user_id)==(Auth::user()->id))
                    <a href="/reviewsbuyerdestroy/{{ $review->id }}/{{ Auth::user()->id }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this review?')">Delete</a>
                    @endif

                </td>
            </tr>
            @endforeach
        @endif       
       
    
    </table>

@endsection

