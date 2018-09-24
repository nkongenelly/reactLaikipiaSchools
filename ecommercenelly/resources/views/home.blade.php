@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in! as <strong>{{ strtoupper(Auth::user()->usertype_id) }}</strong>
                <br>

                Admin Page: <a href="{{ url('/') }}/adminOnlyPage">{{ url('/') }}/adminOnlyPage</a>
                <br>
                Seller Page: <a href="{{ url('/') }}/sellerOnlyPage">{{ url('/') }}/sellerOnlyPage</a>
                <br>
                Buyer Page: <a href="{{ url('/') }}/buyerOnlyPage">{{ url('/') }}/buyerOnlyPage</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
