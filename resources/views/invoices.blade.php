@extends('layoutPages')
@section('title', 'Invoices')
@section('content')
<style>
  .card-body{
    position: relative;
    right: 10px;
  }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
<div class="container">
  <div class="row d-flex ">
    <div class="col-md-6">
      <div class="card">
        <div class="card-body justify-content-center">
          <h5 class="card-title text-center">Click and add a new invoice</h5>
          <a class="btn btn-outline-secondary" href="{{ route('billing') }}" type="button">+Add invoice</a>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card">
        <div class="card-body justify-content-center align-items-center">
          <h5 class="card-title text-center">BNR</h5>
          <!-- INCEPUT SCRIPT PRELUARE CURS VALUTAR v2.0 -->
          <script type="text/javascript" language="javascript" src="//cdn1.curs-valutar-bnr.ro/custom_widgets/get_widget.php?lw=230&rw=1&font=Trebuchet%20MS&cft=00b0ea&ctt=ffffff&ttb=0&cc=f2f2f2&cfb=ffffff&ct=000000&pd=4&pc=4&aiv=1&val[]=8&mf=14&avc=0&ac=1&aod=0&lang=ro"></script>
        </div>
</div>
</div>
</div>

        
  <div class="container_1">
    <div class="row justify-content-center"> 
      <div class="col">
        <div class="table-responsive small">
          <h2>Invoices</h2>
          <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th scope="col">Name</th>
                <th scope="col">Id</th>
                <th scope="col">Emitting Date</th>
                <th scope="col">Due Date</th>
                <th scope="col">Series/Number</th>
                <th scope="col">Total Price</th>
                <th scope="col">Delivery date</th>
                <th scope="col">Payment Method</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach($clients as $client)
          @foreach($client->invoice as $invoice)
        <tr>
            <th scope="col">{{$client['Name']}}</th>
            <th scope="col">{{$invoice['id']}}</th>
            <th scope="col">{{ date('d-m-Y', strtotime($invoice['DateOfIssue'])) }}</th>
            <th scope="col">{{ date('d-m-Y', strtotime($invoice['Term'])) }}</th>
            <th scope="col">{{$invoice['SeriesNumber']}}</th>
            @php
                $totalProductPrice = 0;
                foreach($invoice->products as $product) {
                    $totalProductPrice += $product->PriceWithVAT;
                }
            @endphp
            <th>{{ $totalProductPrice }}</th>
            <th scope="col">{{ date('d-m-Y', strtotime($invoice['DeliveryDate'])) }}</th>
            <th scope="col">{{$invoice['method']}}</th>
            <th scope="col">
                <form action="{{ route('update-status', ['invoice' => $invoice->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                            <select class="form-select" aria-label="Default select example" name="status">
                                <option value="draft" {{ $invoice['status'] == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="cancel" {{ $invoice['status'] == 'cancel' ? 'selected' : '' }}>Canceled</option>
                                <option value="overdue" {{ $invoice['status'] == 'overdue' ? 'selected' : '' }}>Overdue</option>
                                <option value="issued" {{ $invoice['status'] == 'issued' ? 'selected' : '' }}>Issued</option>
                                <option value="partially_paid" {{ $invoice['status'] == 'partially_paid' ? 'selected' : '' }}>Partially paid</option>
                                <option value="paid" {{ $invoice['status'] == 'paid' ? 'selected' : '' }}>Paid</option>
                                </select>
                        <button class="btn btn-primary btn-block" type="submit">Update Status</button>
                        </form>
            </th>
            <th scope="col">
                <a class="btn btn-info btn-sm" href="{{ route('invoice-details', ['client_id' => $client->id , 'id' => $invoice->id]) }}">View Details</a>
            </th>
        </tr>
    @endforeach
@endforeach
            </tbody>
          
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
@endsection