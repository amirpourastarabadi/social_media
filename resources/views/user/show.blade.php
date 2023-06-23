@extends('layouts.app')

@section('main_content')
<div class="container mt-5">
    <div class="row">
      <div class="col-md-4">
        <!-- User information -->
        <div class="card">
          <img src="{{ asset('storage/profile_images/'.$user->profile->image_full_path) }}" class="card-img-top" alt="User Image">
          <div class="card-body">
            <h5 class="card-title">{{$user->name}}</h5>
            <p class="card-text">{{$user->profile->bio}}</p>
          </div>
        </div>
      </div>
      <div class="col-md-8">
        <!-- User posts -->
        <div class="card-deck">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Post Title</h5>
              <p class="card-text">Post Content</p>
            </div>
            <div class="card-footer">
              <small class="text-muted">Posted on Date</small>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Post Title</h5>
              <p class="card-text">Post Content</p>
            </div>
            <div class="card-footer">
              <small class="text-muted">Posted on Date</small>
            </div>
          </div>
          <!-- Add more cards for additional posts -->
        </div>
      </div>
    </div>
  </div>
@endsection