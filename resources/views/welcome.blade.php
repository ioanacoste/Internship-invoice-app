<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1 , shrink-to-fit=no">
    <title>Welcome page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel=”stylesheet” href=”css/bootstrap.css”>
    <link rel=”stylesheet” href=”css/bootstrap-responsive.css”>
    <link rel="stylesheet" type="text/css" href="/css/welcome.css" />
    
  </head>
  <body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <div class="container d-flex flex-column justify-content-center align-items-center vh-100">
          <div class="row">
            <div class="col-12">
              <h1>Hello</h1>
            </div>
          </div>
         <div class="row">
            <div class="col-6">
              <a class="btn btn-primary btn-lg " href="{{ route('login') }}" >Login</a>
            </div>
            <div class="col-6">
              <a class=" btn btn-secondary btn-lg" href="{{ route('register') }}">Register</a>
            </div>
        </div>
    </div>
  </body>
</html>