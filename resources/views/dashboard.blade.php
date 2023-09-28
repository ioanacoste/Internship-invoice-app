@extends('layoutPages')
@section('title', 'Dashboard')
@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

<div class="container">
    <div class="tabs-animation">
        <div class="mb-3 card">
            <div class="card-header-tab card-header">
                <div class="card-header-title font-size-lg text-capitalize font-weight-normal">

                </div>
            <div class="no-gutters row">
                <div class="col-sm-6 col-md-4 col-xl-4">
                    <div class="card no-shadow rm-border bg-transparent widget-chart text-left">
                        <div class="icon-wrapper rounded-circle">
                            <div class="icon-wrapper-bg opacity-10 bg-warning"></div>
                            <i class="lnr-laptop-phone text-dark opacity-8"></i>
                        </div>
                        <div class="widget-chart-content">
                            <div class="widget-subheading">Total paid</div>
                            @php
                $totalRON = 0;
                $totalEURO = 0;
            @endphp
                            @foreach ($paidInvoices as $invoice)
                <tr>
                    
                
                    @php
                $totalProductPrice = 0;
                
                    foreach($invoice->products as $product) {
                        $totalProductPrice+= $product->PriceWithVAT;
                    }
                    if($invoice->currency1 == 'ron'){
                                 $totalRON += $totalProductPrice;}
                                 if($invoice->currency1 == 'euro'){
                                 $totalEURO += $totalProductPrice;}
            @endphp
          
                </tr>
                @endforeach
                <tr>
    <td colspan="7" class="text-end total-heading">Total:</td>
    
    <td colspan="2" class="total-heading text-center">{{ $totalRON }} ron  <br></br> {{ $totalEURO }} euro</td>
</tr>
                            <div class="widget-description opacity-8 text-focus">
                                <div class="d-inline text-danger pr-1">
                                    <i class="fa fa-angle-down"></i>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                    <div class="divider m-0 d-md-none d-sm-block"></div>
                </div>
                <div class="col-sm-6 col-md-4 col-xl-4">
                    <div class="card no-shadow rm-border bg-transparent widget-chart text-left">
                        <div class="icon-wrapper rounded-circle">
                            <div class="icon-wrapper-bg opacity-9 bg-danger"></div>
                            <i class="lnr-graduation-hat text-white"></i>
                        </div>
                        <div class="widget-chart-content">
                            <div class="widget-subheading">Total Overdue</div>
                            @php


                $totalRON = 0;
                $totalEURO = 0;
            @endphp
            @foreach ($overdueInvoices as $invoice)
                <tr>
               
                    @php
                $totalProductPrice = 0;
                
                    foreach($invoice->products as $product) {
                        $totalProductPrice+= $product->PriceWithVAT;
                    }
                    if($invoice->currency1 == 'ron'){
                                 $totalRON += $totalProductPrice;}
                                 if($invoice->currency1 == 'euro'){
                                 $totalEURO += $totalProductPrice;}
            @endphp
                </tr>
                @endforeach

                 <td colspan="2" class="total-heading text-center">{{ $totalRON }} ron  <br></br> {{ $totalEURO }} euro</td>
                            <div class="widget-description opacity-8 text-focus">
                                <span class="text-info pl-1">
                                    <i class="fa fa-angle-down"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="divider m-0 d-md-none d-sm-block"></div>
                </div>
                <div class="col-sm-12 col-md-4 col-xl-4">
                    <div class="card no-shadow rm-border bg-transparent widget-chart text-left">
                        <div class="icon-wrapper rounded-circle">
                            <div class="icon-wrapper-bg opacity-9 bg-success"></div>
                            <i class="lnr-apartment text-white"></i>
                        </div>
                        <div class="widget-chart-content">
                            <div class="widget-subheading">Total issued</div>
                            @php
                $totalRON = 0;
                $totalEURO = 0;
            @endphp
            @foreach ($issuedInvoices as $invoice)
                <tr>
               
                    @php
                $totalProductPrice = 0;
                
                    foreach($invoice->products as $product) {
                        $totalProductPrice+= $product->PriceWithVAT;
                    }
                    if($invoice->currency1 == 'ron'){
                                 $totalRON += $totalProductPrice;}
                                 if($invoice->currency1 == 'euro'){
                                 $totalEURO += $totalProductPrice;}
            @endphp
                </tr>
                @endforeach

                <td colspan="2" class="total-heading text-center">{{ $totalRON }} ron  <br></br> {{ $totalEURO }} euro</td>
                            </div>
                            <div class="widget-description text-focus">
                                <span class="text-warning pl-1">
                                    <i class="fa fa-angle-up"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center d-block p-3 card-footer">
                <button class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary btn-lg">
                    <span class="mr-2 opacity-7">
                        <i class="icon icon-anim-pulse ion-ios-analytics-outline"></i>
                    </span>
                    <a class="btn btn-primary btn-sm" href="{{ route('reportsPage') }}">View Complete Report</a> 
                </button>
            </div>
                </div>
                </div>
                </div>
                </div>
                
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card h-100">
                <a href="{{ route('invoices') }}">
                    <img src="https://www.computerhope.com/jargon/i/invoice.png" class="card-img-top" alt="Invoice Image">
                    <div class="card-body">
                        <h5 class="card-title">Invoice Overview</h5>
                        <p class="card-text">View a quick overview of your invoices and financial status.</p>
                    </div>
                </a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100">
                <a href="{{ route('clients') }}">
                    <img src="https://estratcom.com/wp-content/uploads/2019/06/customerengagementlast.png" class="card-img-top" alt="Customer Image">
                    <div class="card-body">
                        <h5 class="card-title">Customer Management</h5>
                        <p class="card-text">Manage your customer information and keep track of interactions.</p>
                    </div>
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                <a href="{{ route('reportsPage') }}">
                    <img src="https://tse4.mm.bing.net/th?id=OIP.RU7CKUxXAIabSQ-BAWSokQAAAA&pid=Api&P=0&h=180" class="card-img-top" alt="Report Image">
                    <div class="card-body">
                        <h5 class="card-title">Generate Reports</h5>
                        <p class="card-text">Generate detailed reports to analyze your business performance.</p>
                    </div>
                    </a>
                </div>
            </div>
    </div>
    
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3 text-center">
                <blockquote class="blockquote">
                    <p class="mb-0">"Success is not final, failure is not fatal: It is the courage to continue that counts."</p>
                    <footer class="blockquote-footer mt-2">Winston Churchill</footer>
                </blockquote>
            </div>
        </div>
    </div>

</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
@endsection