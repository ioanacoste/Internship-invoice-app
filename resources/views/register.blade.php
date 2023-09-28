
@extends('layoutLoginRegister')
@section('title', 'Register')
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
            <h2 class="headers card-text text-light"> User Registration </h2>
            <h3 class="headers card-text text-light"> Enter your details to create an acount</h3>
          </div>
      </div>
      <div class="col-lg-8">
        <div class="card-body py-5 px-md-5 justify-content-center align-items-center">
          <div class="col d-flex justify-content-center margin-bottom">
                <a type="text">REGISTER</a>
                </div>
                <form action="{{route('register.post')}}" method="POST" class="ms-auto me-auto mt-3" style="max-width: 500px;">
    @csrf
    
    <div class="mb-3">
      <label class="form-label">Full-name</label>
      <input type="text" class="form-control" name="name">
    </div>
    <div class="mb-3">
      <label class="form-label">Email address</label>
      <input type="email" class="form-control" name="email">
    </div>
    <div class="mb-3">
      <label class="form-label">Password</label>
      <input type="password" class="form-control" name="password">
    </div>
    <div class="mb-3">
      <label class="form-label">Password confirmation</label>
      <input type="password" class="form-control" name="password_confirmation">
    </div>
    <button type="submit" class="btn btn-primary">Create acount</button>
    <a href="{{route('login')}}">Do you have an acount?</a>
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