@extends('layouts.auth_layout')
@section('content')
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner">
      <!-- Register Card -->
      <div class="card">
        <div class="card-body">          
          <h4 class="mb-2">Adventure starts here 🚀</h4>
          <p class="mb-4">Make your app management easy and fun!</p>
          <form id="formAuthentication" class="mb-3" action="{{ route('register') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" value="{{old('name')}}" name="name" placeholder="Enter your username" autofocus/>
              @if($errors->has('name'))
                  <div class="text-danger">{{ $errors->first('name') }}</div>
              @endif
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="text" class="form-control" id="email" value="{{old('email')}}" name="email" placeholder="Enter your email" />
              @if($errors->has('email'))
                  <div class="text-danger">{{ $errors->first('email') }}</div>
              @endif
            </div>
            <div class="mb-3">
              <label for="phone" class="form-label">Phone Number</label>
              <input type="number" class="form-control" id="phone" value="{{old('phone')}}" name="phone" placeholder="Enter your Phone number" autofocus/>
              @if($errors->has('phone'))
                  <div class="text-danger">{{ $errors->first('phone') }}</div>
              @endif
            </div>
            <div class="mb-3 form-password-toggle">
              <label class="form-label" for="password">Password</label>
              <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
              </div>
              @if($errors->has('password'))
                  <div class="text-danger">{{ $errors->first('password') }}</div>
              @endif
            </div>

            <div class="mb-3 form-password-toggle">
              <label class="form-label" for="password_confirmation">Confirm Password</label>
              <div class="input-group input-group-merge">
                <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
              </div>
              @if($errors->has('password_confirmation'))
                  <div class="text-danger">{{ $errors->first('password_confirmation') }}</div>
              @endif
            </div>
            <button class="btn btn-primary d-grid w-100">Sign up</button>
          </form>

          <p class="text-center">
            <span>Already have an account?</span>
            <a href="{{route('login')}}">
              <span>Sign in instead</span>
            </a>
          </p>
        </div>
      </div>
      <!-- Register Card -->
    </div>
  </div>
</div>
@endsection