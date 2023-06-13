@extends('layouts.app')

@section('main_content')
<div class="container-fluid h-100">
    <div class="row h-100">
        <div class="col-sm-12 my-auto">
            <div class="card">
                <div class="card-header">{{ __('Welcome to Social Media Website') }}</div>

                <div class="card-body">
                    <div class="text-center mb-3">
                        <img src='{{asset("storage/generals/logo.jpg")}}' class="rounded-circle shadow-4-strong" alt="Logo" width="250" height="260">
                    </div>
                    <div class="text-center mb-3">
                        <a href="{{ route('login.form') }}" class="btn btn-primary">{{ __('Login') }}</a>
                        <a href="{{ route('register.form') }}" class="btn btn-secondary">{{ __('Register') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection