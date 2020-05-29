@extends('layouts.admin-app')

@section('content')
<div class="container py-4">
    <div class="container bg-white shadow my-4 py-4">
        <h1 class="text-center mb-4">Edit Admin Profile of ID No.{{ $user->id }}</h1>

        <form action="{{ route('admin.update', ['user' => $user->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group row">
                <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}<sup class="text-danger">*</sup></label>
    
                <div class="col-md-6">
                    <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name', $user->first_name) }}" required autofocus>
    
                    @if ($errors->has('first_name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('first_name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
    
            <div class="form-group row">
                <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}<sup class="text-danger">*</sup></label>
    
                <div class="col-md-6">
                    <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name', $user->last_name)}}" required autofocus>
    
                    @if ($errors->has('last_name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('last_name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
    
            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}<sup class="text-danger">*</sup></label>
    
                <div class="col-md-6">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email', $user->email)}}" required>
    
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
    
            <div class="form-group row">
                <label for="new_password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>
    
                <div class="col-md-6">
                    <input id="new_password" type="password" class="form-control{{ $errors->has('new_password') ? ' is-invalid' : '' }}" name="new_password">
    
                    @if ($errors->has('new_password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('new_password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
    
            <div class="form-group row">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm New Password') }}</label>
    
                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="new_password_confirmation">
                </div>
            </div>
    
            <div class="form-group row">
                <label for="avatar" class="col-md-4 col-form-label text-md-right">{{ __('Avatar(~4MB)') }}</label>
    
                <div class="col-md-6">
                    <input id="avatar" type="file" class="form-control-file" name="avatar" accept="image/png, image/jpeg, image/gif">
                </div>
            </div>
    
            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-block btn-primary">
                        {{ __('Update') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
