<!-- resources/views/invoices/details.blade.php -->
@extends('layoutPages')
@section('title', 'Invoice Details')
@section('content')

<div class="container">
    <p></p>
<th scope="col-md-4">
   <a class="btn btn-info btn-sm" href="{{ route('invoice-details-preview', ['client_id' => $clients['id'] , 'id' => $invoices['id']]) }}">Design 1</a>
   <a class="btn btn-info btn-sm" href="{{ route('invoice-details-preview2', ['client_id' => $clients['id'] , 'id' => $invoices['id']]) }}">Design 2</a>
   <a class="btn btn-info btn-sm" href="{{ route('invoice-details-preview3', ['client_id' => $clients['id'] , 'id' => $invoices['id']]) }}">Design 3</a>
</th>
<th scope="col-md-4">
   <a class="btn btn-success btn-sm" href="{{ route('invoice-export', ['client_id' => $clients['id'] , 'id' => $invoices['id']]) }}">Download 1</a>
   <a class="btn btn-success btn-sm" href="{{ route('invoice-export2', ['client_id' => $clients['id'] , 'id' => $invoices['id']]) }}">Download 2</a>
   <a class="btn btn-success btn-sm" href="{{ route('invoice-export3', ['client_id' => $clients['id'] , 'id' => $invoices['id']]) }}">Download 3</a>
</th>

<hr></hr>
<h1 class="text-center"> Invoice Details</h1>
<div class="container">
  <div class="row">
  <div class="col-md-3">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title text-center">Company</h5>
          <p><strong>Name: </strong>{{ $companyInfo->where('key', 'Company')->first()->value ?? '' }}</p>
          <p><strong>CIF: </strong>{{ $companyInfo->where('key', 'CIF')->first()->value ?? '' }}</p>
          <p><strong>Register:</strong>{{ $companyInfo->where('key', 'Register')->first()->value ?? '' }}</p>
          <p><strong>Legal form:</strong>{{ $companyInfo->where('key', 'Legal_form')->first()->value ?? '' }}</p>
          <p><strong>Bank:</strong>{{ $companyInfo->where('key', 'Bank')->first()->value ?? '' }}</p>
          <p><strong>Account:</strong> {{ $companyInfo->where('key', 'IBAN')->first()->value ?? '' }}</p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title text-center">Client</h5>
          <p><strong>Name: </strong>{{ $clients->Name }}</p>
          <p><strong>CIF: </strong>{{ $clients->CIF }}</p>
          <p><strong>Register:</strong> {{ $clients->Register }}</p>
          <p><strong>Legal form:</strong> {{ $clients->legal_form }}</p>
          <p><strong>Bank:</strong> {{ $clients->Bank }}</p>
          <p><strong>Account:</strong> {{ $clients->Account }}</p>
        </div>
      </div>
    </div>
    
    <div class="col-md-3">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title text-center">Invoice</h5>
          <p><strong>Date of issue: </strong>{{ date('d-m-Y', strtotime( $invoices['DateOfIssue'])) }}</p>
          <p><strong>Term: </strong>{{ date('d-m-Y', strtotime( $invoices['Term'])) }}</p>
          <p><strong>Number:</strong> {{ $invoices->SeriesNumber }}</p>
          <p><strong>Language:</strong> {{ $invoices->lang }}</p>
          <p><strong>Payment method:</strong> {{ $invoices->method }}</p>
          <p><strong>Currency:</strong> {{ $invoices->currency1 }}</p>
        </div>
      </div>
    </div>
    
    <div class="col-md-3">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title text-center">Employees</h5>
          <p><strong>Made:</strong> {{ $invoices->Made }}</p>
          <p><strong>ID:</strong> {{ $invoices->ID_made }}</p>
          <p><strong>Email: </strong>{{$invoices->email_made }}</p>
          <p><strong>Delegate:</strong> {{ $invoices->Delegate }}</p>
          <p><strong>ID delegate:</strong> {{ $invoices->ID_delegate }}</p>
          <p><strong>Email delegate: </strong>{{$invoices->email_delegate }}</p>
          <p><strong>Currency:</strong> {{ $invoices->currency1 }}</p>
        </div>
      </div>
    </div>
</div>
    <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title text-center">Products/Service</h5>
          <table class="invoice-table w-100 mx-auto">
      <thead>
        <tr>
            <th>Id</th>
          <th>Product</th>
          <th>Unit</th>
          <th>Quantity</th>
          <th>Price with VAT</th>
        </tr>
      </thead>
      <tbody>
        @foreach($invoices->products as $product) 
        <td> {{$product->id}}</td>
            <td> {{$product->ProductService}}</td>
                <td> {{$product->Unit}}</td>
                    <td> {{ $product->Quantity}}</td>
                    <td>{{ $product->PriceWithVAT}}</td>
        @endforeach
      </tbody>
    </table>
        </div>
      </div>
    </div>
</div>
</div>
</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

@endsection
