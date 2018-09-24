<div class="modal fade" id="featureModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
        <form action="/productfeatures" method="POST" class="form-horixontal">
            {{ csrf_field() }}
            <input type="hidden" name="product_id" value="{{$product->id}}">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Feature for{{$product->product_name}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                    <div class="form-group">
                        <label>Chose Feature</label>
                        <select name="feature_id">
                            <option value="0">--No Feature--</option>
                            @if(count($features))                   
                                @foreach($features as $feature)
                                    <option value="{{ $feature->id }}">
                                        {{ $feature->feature_name }}">
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        
                    </div>          
                    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add Feature</button>
            </div>
        </div>
      </form> 
   </div>
</div>

    @if(count($productfeatures->feature))
        
            <table class="table table-condensed table-striped table-bordered table-hover">
                <tr>
                    <th>#</th>
                    <th>Feature Name</th>
                    <th>Created By</th>
                    <th colspan="3">Actions</th>
                </tr>
                @foreach($productfeatures->feature as $pfeatures)
                <tr>
                    <td>{{ $pfeatures->id }}</td>
                    <td>{{ $pfeatures->feature_name }}</td>
                    <td>{{ $pfeatures->created_at->diffForHumans() }}</td>`
                   
                    <td><!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal{{$product->id}}">
                    Edit
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="editModal{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form action="/productfeatures/update/{{$productfeatures->id}}" method="POST" class="form-horixontal">
                                        {{ csrf_field() }}
                                        {{ method_field('PATCH')}}
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Feature</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        
                                            <div class="form-group">
                                                <label>Edit Feature</label>
                                                <select name="feature_id">
                                                    <option value="{{ $productfeatures->id }}">{{ $productfeatures->feature->feature_name }}</option>
                                                    @foreach($features as $feature)
                                                        <option value="{{ $feature->id }}">
                                                            {{ $feature->feature_name }}">
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>          
                                            
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Edit Comment</button>
                                    </div>
                                </div>
                            </form> 
                    </div>
                    </div>
                    </td>

                    <td><a href="/products" class="btn btn-sm btn-success">View roduct</a></td>
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <td><a href="/productsfeatures/{{ $productfeatures->id}}" class="btn btn-sm btn-danger" onclick="confirm('Are you sure you want to delete?')">Delete</a></td>
                @endforeach
                </tr>
            </table>

    @endif