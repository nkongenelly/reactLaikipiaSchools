@extends('layoutsSeller')

@section('content')
    <a href="/productss/create" class="btn btn-warning">Add Product</a>
    <table class="table table-condensed table-striped table-hover table-bordered">
        <tr>
            <th>#</th>
            <th>Category</th>
            <th>Product Name</th>
            <th>Product Status</th>
            <th>Product price</th>
            <th>Product description</th>
            <th>Product Quantity</th>
            <th>Created On</th>
            <th colspan="4">Action</th>
        </tr>
        
        @if(count($products))
            @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->category['category_name'] }}</td>
                <td>{{ $product['product_name'] }}</td>
                <td>
                    @if(($product['product_status'])=="1")
                        <h5>In Stock</h5>
                    @else(($product['product_status'])=="2")
                        <h5>Out of Stock</h5>
                    @endif
                </td>
               
                <td>{{ $product['product_price'] }}</td>
                <td>{{ $product['product_description'] }}</td>
                <td>{{ $product['Product_quantity'] }}</td>
                <td>{{ $product['created_at->diffForHumans()'] }}</td>
                <td>
                    <a href="/products/features/{{ $product['id'] }}" class="btn btn-warning">Features</a>
                </td>
                <td>
                    <a href="/products/edit/{{ $product['id'] }}" class="btn btn-warning">Edit</a>
                </td>
                <td>
                    <a href="/productimage/{{ $product['id'] }}" class="btn btn-success">Add Image</a>
                </td>
                <td>
                    <a href="/products/delete/{{ $product['id'] }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                </td>
            </tr>
            @endforeach
        @endif       
       
    
    </table>

@endsection

