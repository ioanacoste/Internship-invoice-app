

@extends('layoutLoginRegister')
@section('title', 'Login')
@section('content')
<div class="container  d-flex flex-column justify-content-center align-items-center vh-100">
<div class="card mb-3">
  <div>
        @if($errors->any())
            <div class="col-12">
                    @foreach($errors->all() as $error)
                    <div class="alert alert-danger">{{$error}}</div>
                    @endforeach
            </div>
        @endif

        @if(session()->has('error'))
            <div class="alert alert-danger">{{session('error')}}</div>
        @endif 
        @if(session()->has('success'))
            <div class="alert alert-success">{{session('success')}}</div>
        @endif
        @if(session()->has('warning'))
    <div class="alert alert-warning">
        {{ session('warning') }}
    </div>
@endif
    </div>
    <div class="row g-0 d-flex align-items-center">
      <div class="col-lg-4 card d-none d-lg-flex  d-flex flex-column justify-content-center align-items-center">
        
        <img src="https://images.pexels.com/photos/5483075/pexels-photo-5483075.jpeg" alt="Login Page"
          class="card-img w-100 rounded-t-5 rounded-tr-lg-5 rounded-bl-lg-5">
          <div class="card-img-overlay d-flex flex-column justify-content-center align-items-center ">
            <h2 class="headers card-text text-light"> User Login </h2>
            <h3 class="headers card-text text-light"> Enter your login details to get into the application</h3>
          </div>
      </div>
      <div class="col-lg-8">
        <div class="card-body py-5 px-md-5 justify-content-center align-items-center">
          <div class="col d-flex justify-content-center margin-bottom">
                <a type="text">Login</a>
                </div>
            <form action="{{route('login.post')}}" method="POST" class=" needs-validation d-flex flex-column align-items-center" novalidate>
            @csrf 
              <div class="form-floating mb-3 ">
                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email" required>
                <label for="floatingInput">Email address</label>
                <div class="invalid-feedback">Please enter your email</div>
              </div>
              <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" placeholder="password" name="password" required>
                <label for="floatingPassword">Password</label>
              <div class="invalid-feedback">Please enter a password.</div>
              </div>
              <div class="row mb-4 margin-top dimension">
              <div class="col d-flex justify-content-center">

                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
                  <label class="form-check-label" for="form2Example31"> Remember me </label>
                </div>
              </div>
              
              <div class="col">
                <a href="#!">Forgot password?</a>
              </div>

              <div class="col">
                <a href="{{route('register')}}">Do you need to register?</a>
              </div>
          </div>


          <div class="row margin-top">
              <div class="col d-flex justify-content-center">
                <button type="submit" class="btn btn-primary btn-block mb-4">Sign in</button>
                </div>

            </div>

          </form>

        </div>
      </div>
    </div>
  </div>
  
</div>
<script>
      // Add Bootstrap's JavaScript-based form validation
      (function () {
        'use strict';

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation');

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms).forEach(function (form) {
          form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
              event.preventDefault();
              event.stopPropagation();
            }

            form.classList.add('was-validated');
          }, false);
        });
      })();
    </script>
<link href="{{ asset('css/login.css') }}" rel="stylesheet">
@endsection