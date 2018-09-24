@extends('layoutsAdmin')

@section('content')
    <form action="/categories" method="POST" class="form-horizontal">
        {{ csrf_field() }}
        <div class="form-control">
            <select name="category_parent">
                <option value="0">--No Parent--</option>
               
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->category_name}}</option>
                    @endforeach
               
            </select>
            <div class="form-group">
                <label>Category name</label>
                <input type="text" class="form-control" placeholder="Type the category name" name="category_name">
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
           
        </div>
    
    </form>

@endsection