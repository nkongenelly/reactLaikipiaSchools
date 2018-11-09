@extends('layoutsSeller')

@section('content')
    <a href="/productfeatures/{{ $product->id }}/{{ Auth::user()->id }}" class="btn btn-warning">Add Product Feature</a>
    <a href="/featuress/create" class="btn btn-warning">Add Feature</a>
    <table class="table table-condensed table-striped table-hover table-bordered">
        <tr>
            <th>#</th>
            <th>Product Name</th>
            <th>Feature Name</th>
        </tr>

                <tr>
                
                    <td>{{ $product['id'] }}</td>
                    <td>{{ $product['product_name'] }}</td>
                    <td colspan="3">
                    @foreach($pfeatures as $pfeature)
                        <ol>
                            <ul>{{ $featurename }} : {{ $pfeature->name }}
                    
                                <a href="/productfeaturesedit/{{ $product['id'] }}/{{ $pfeature->id }}" class="btn btn-warning">Edit</a>
                                <a href="/productfeaturesdelete/{{ $product['id'] }}/{{ $pfeature->id }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product feature?')">Delete</a>
                            </ul>
                         
                        </ol>
                    @endforeach
                    </td>
                   
                
                </tr>
    
 

    </table>

@endsection

