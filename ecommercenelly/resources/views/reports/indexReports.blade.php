@extends('layoutsSeller')

@section('content')
<a href="/bar-chart" class="btn btn-warning">Totals Line Graph</a>
    <table class="table table-condensed table-striped table-hover table-bordered">
        <tr>
            
            <th>Category</th>
            <th>Product Name</th>
            <th>Product quantity</th>
            <th>Product Total Price</th>
            <th>View</th>
        </tr>
        
        @if(count($reports))
            @foreach($reports as $report)
            <tr>
                <td>{{ $report->category_name }}</td>
                <td>{{ $report->product_name }}</td>
                <td>{{ $report->quantity }}</td>
                <td>{{ $report->price }}</td>
                <td>
                    <a href="/reportsview/{{ $report->id }}/{{ $report->order_id }}" class="btn btn-warning">Product Sales</a>
                </td>
               
            </tr>
            @endforeach
        @endif    
        <tr>
            
            <th>Category</th>
            <th>Product Name</th>
            <th>Product quantity</th>
            <th>{{ $total }}</th>
            <th>View</th>
        </tr>   
       
    
    </table>

@endsection

