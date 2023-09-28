@extends('layoutPages')
@section('title', 'Invoices')
@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
<style>
  .invoice-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }
  .invoice-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
  }
  .invoice-header h2 {
    margin: 0;
  }
  .invoice-details p {
    margin: 5px 0;
  }
  .invoice-table {
    width: 100%;
    border-collapse: collapse;
  }
  .invoice-table th,
  .invoice-table td {
    padding: 10px;
    border-bottom: 1px solid #ddd;
  }
</style>
<div class="container">
  <div class="invoice-container">
    <div class="invoice-header">
      <h2>Invoice #{{ $invoice['id'] }}</h2>
      <span class="invoice-status">{{ ucfirst($invoice['status']) }}</span>
    </div>
    <div class="invoice-details">
      <p><strong>Name:</strong> {{ $invoice['Name'] }}</p>
      <p><strong>Legal Form:</strong> {{ $invoice['legal_form'] }}</p>
      <p> CIF: {{$invoice['CIF']}} </p>
        <p> Register: {{$invoice['Register']}} </p>
        <p> Bank: {{$invoice['RegBankister']}} </p>
        <p> Account: {{$invoice['Account']}} </p>
        <p>Emitting Date: {{ date('d-m-Y', strtotime($invoice['DateOfIssue'])) }}</p>
       <p> Term: {{ date('d-m-Y', strtotime($invoice['Term'])) }} </p>
       <p> Seriers and Number: {{$invoice['SeriesNumber']}} </p>
       <p> Made: {{$invoice['Made']}} </p>
       <p> ID_made: {{$invoice['ID_made']}} </p>
       <p> email_delegate: {{$invoice['email_delegate']}} </p>
       <p> NoNotice: {{$invoice['NoNotice']}} </p>
       <p> Mentions: {{$invoice['Mentions']}} </p>
       <p> Delivery Date : {{ date('d-m-Y', strtotime($invoice['DeliveryDate'])) }} </p>
       <p> Date Of Collection : {{ date('d-m-Y', strtotime($invoice['DateOfCollection'])) }} </p>
       <p> Method: {{$invoice['method']}} </p>
    </div>
    <table class="invoice-table">
      <thead>
        <tr>
          <th>Product</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{ $product->name }}</td>
          <td>{{ $product->PriceWithVAT }}</td>
          <td>{{ $product->quantity }}</td>
          <td>{{ $product->PriceWithVAT * $product->quantity }}</td>
        </tr>
      </tbody>
    </table>
    <div class="invoice-total">
      <p><strong>Total Price:</strong> {{ $totalProductPrice }}</p>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
@endsection
