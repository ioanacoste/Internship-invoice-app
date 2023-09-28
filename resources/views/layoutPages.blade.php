<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel=”stylesheet” href=”css/bootstrap.css”>
<link rel=”stylesheet” href=”css/bootstrap-responsive.css”>
<style>
</style>


  </head>
  <body class="d-flex flex-column min-vh-100">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
    <div class="collapse navbar-collapse" id="navbarsExample07">
        <a class="navbar-brand" href="#">
            <img src="..\css\LogoMakr-6VkXBJ.png" alt="Logo" height="40">
        </a>


        <a class="navbar-brand" href="#">{{ config('app.name') }}</a>
        </div>
          <div class="collapse navbar-collapse" id="navbarsExample07">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('dashboard-reports') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('invoices') }}">Invoices</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('clients') }}">Clients</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('reportsPage') }}">Reports</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('account_setting') }}">Account Settings</a>
                </li>
           

            @auth
            
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}">Log out</a>
                </li>
                </ul>
                </div>
                <ul class="navbar-nav p-2 ml-auto">
                <li class="nav-item">
                    <span class="navbar-text">User: {{ auth()->user()->name }}</span>
                </li>
            </ul>
            @endauth
        
    </div>
</nav>
    @yield('content')
    
    <footer class="footer bg-dark text-white mt-auto text-center">
  <div class="container p-4 pb-0 sticky-bottom">
    <section class="">
      <form action="">
        <div class="row d-flex justify-content-center">
          <div class="col-auto">
            <p class="pt-2">
              <strong></strong>
            </p>
          </div>
          <div class="col-md-5 col-12">
            <div class="form-outline form-white mb-4">
              <input type="email" id="form5Example29" class="form-control" />
              <label class="form-label" for="form5Example29">Email address</label>
            </div>
          </div>
          <div class="col-auto">
            <button type="submit" class="btn btn-outline-light mb-4">
              Subscribe
            </button>
          </div>
        </div>
      </form>
    </section>
  </div>
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
    © 2023 Copyright:
    <a class="text-white" href=# >Invoice Master</a>
  </div>
</footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" ></script>
  </body>
  
</html>