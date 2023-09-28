@extends('layoutPages')
@section('title', 'Contact')
@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <img src="..\css\contact.png" alt="Email Image" class="img-fluid">
        </div>
        <div class="col-md-6 ftco-animate">
            <div class="row">
                <div class="col-md-12">
                    <h2>Contact us</h2>
                    <form action="{{ url('contact')}}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" placeholder="Your Name">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="Your Email">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="subject" placeholder="Invoice number">
                        </div>
                        <div class="form-group">
                            <textarea name="message" id="" cols="30" rows="7" class="form-control" placeholder="Reminder of the due date/past the due date of the invoice"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="NOTICE" class="btn btn-primary py-3 px-5">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
