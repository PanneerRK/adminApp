@extends('layouts.dash_layout')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4>
  <div class="row">
    <div class="col-md-12">
      <div class="card mb-4">
        <h5 class="card-header">Profile Details</h5>
        @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">{{ Session::get('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <!-- Account -->
        <div class="card-body">
          <form id="" method="POST" action="{{ route('update_profile',[$user->id]) }}">
            @csrf
            <input type="hidden" value="{{$user->id}}"/>
            <div class="row">
              <div class="mb-3 col-md-6">
                <label for="Username" class="form-label">Username</label>
                <input class="form-control" type="text" id="name" name="name" value="{{old('name', $user->name)}}" autofocus/>
                @if($errors->has('name'))
                    <div class="text-danger">{{ $errors->first('name') }}</div>
                @endif
              </div>
              <div class="mb-3 col-md-6">
                <label for="email" class="form-label">Email</label>
                <input class="form-control" type="text" id="email" name="email" value="{{old('email', $user->email)}}" readonly placeholder="john.doe@example.com" />
                @if($errors->has('email'))
                    <div class="text-danger">{{ $errors->first('email') }}</div>
                @endif
              </div>              
              <div class="mb-3 col-md-6">
                <label class="form-label" for="phone">Phone Number</label>
                <div class="input-group input-group-merge">
                  {{-- <span class="input-group-text">IND (+91)</span> --}}
                  <input type="text" id="phone" name="phone" class="form-control" value="{{old('phone', $user->phone)}}" placeholder="202 555 0111"/>                 
                </div>
                @if($errors->has('phone'))
                      <div class="text-danger">{{ $errors->first('phone') }}</div>
                  @endif 
              </div>              
            </div>
            <div class="mt-2">
              <button type="submit" class="btn btn-primary me-2">Save changes</button>
              <button type="reset" class="btn btn-outline-secondary">Cancel</button>
            </div>
          </form>
        </div>
        <!-- /Account -->
      </div>
    </div>
  </div>
</div>
@endsection