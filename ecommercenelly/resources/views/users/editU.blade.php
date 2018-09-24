@extends('layoutsAdmin')

@section('content')
    
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Register') }}</div>

                        <div class="card-body">
                            <form action="/users" method="POST" class="form-horizontal">
                                {{ csrf_field() }}

                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" value="{{ $user->name }}" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" required autofocus>

                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" value="{{ $user['email'] }}"  class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"  required>

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" value="{{ $user['password'] }}"  class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required >

                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" value="{{ $user['password'] }}"  class="form-control" name="password_confirmation" required >
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="usertype_id" class="col-md-4 col-form-label text-md-right">User Type:</label>
                                        <div class="col-md-6">
                                            <select name="usertype_id" id="type" class="form-control">
                                            <option value="{{ $user->usertype_id }}" >{{ $user->usertype->user_type }}</option>
                                                @foreach($types as $type)
                                                    <option value="{{ $type->id }}">{{ $type->user_type }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                    <a href="/users" class="btn btn-warning">
                                           Back
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                           Edit
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    

@endsection