@extends('layouts.dash_layout')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Contact /</span> </h4>
  <div class="row">
    <div class="col-md-12">
      <div class="card mb-4">
        <h5 class="card-header">Contact Form</h5>
        @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">{{ Session::get('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <!-- Account -->
        <div class="card-body">
          <form id="" method="POST" action="{{ route('store_contact')}}">
            @csrf
            <div class="row">
              <div class="mb-3 col-md-7">
                <label for="name" class="form-label">Name</label>
                <input class="form-control" type="text" id="name" name="name" value="{{old('name')}}" autofocus/>
                @if($errors->has('name'))
                    <div class="text-danger">{{ $errors->first('name') }}</div>
                @endif
              </div>
              <div class="mb-3 col-md-7">
                <label for="email" class="form-label">Email</label>
                <input class="form-control" type="text" id="email" name="email" value="{{old('email')}}" placeholder="john.doe@example.com" />
                @if($errors->has('email'))
                    <div class="text-danger">{{ $errors->first('email') }}</div>
                @endif
              </div>              
              <div class="mb-3 col-md-7">
                <label for="Message" class="form-label">Message</label>
                <textarea class="form-control" name="message" id="message" rows="3"></textarea>
                @if($errors->has('message'))
                      <div class="text-danger">{{ $errors->first('message') }}</div>
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