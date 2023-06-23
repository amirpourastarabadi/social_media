@extends('layouts.app')


@section('main_content')


<div class="container mt-5">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    Profile Picture
                </div>
                <div class="card-body">
                    <img src="{{ asset('storage/profile_images/'.$user->profile->image_full_path) }}" alt="{{ $user->name }}" class="img-fluid">
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    User Information
                </div>
                <div class="card-body">
                    <form action="{{ route('api.profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                        </div>
                        <div class="form-group">
                            <label for="bio">Bio:</label>
                            <textarea class="form-control" id="bio" name="bio">{{ $user->bio }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="bio">Picture:</label>
                            <input type="file" class="form-control-file" id="image" name="image">
                        </div>

                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <a href="{{ route('web.password.reset.request') }}" class="btn btn-link">Reset Password</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection