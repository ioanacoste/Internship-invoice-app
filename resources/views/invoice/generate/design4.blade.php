@extends('layoutPages')
@section('title', 'Invoices')
@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
<style>
  .invoice-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    border: 2px solid #222;
    border-radius: 10px;
    background-color: #111;
    color: #ddd;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.4);
  }
  .invoice-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
  }
  .invoice-status {
    font-weight: bold;
    color: #e74c3c;
  }
  .invoice-id {
    font-size: 24px;
    color: #ddd;
  }
  .invoice-details {
    margin-bottom: 20px;
    color: #ddd;
  }
  .invoice-details h4 {
    font-size: 20px;
    margin-bottom: 10px;
    color: #ccc;
  }
  .invoice-table {
    width: 100%;
    border-collapse: collapse;
  }
  .invoice-table th,
  .invoice-table td {
    padding: 12px;
    border-bottom: 1px solid #333;
    color: #ccc;
  }
  .invoice-total {
    margin-top: 20px;
    text-align: right;
    font-size: 18px;
    color: #ddd;
  }
</style>
<div class="container">
    <div class="invoice-container">
      <div class="invoice-header">
        <span class="invoice-status">{{ ucfirst($invoice['status']) }}</span>
        <span class="invoice-id">Invoice #{{ $invoice['id'] }}</span>
      </div>
      <div class="invoice-details">
        <h4>{{ $invoice['Name'] }}</h4>
        <p> Legal Form: {{$invoice['legal_form']}} </p>
        <!-- ... Other fields ... -->
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
        <p>Total Price: {{ $totalProductPrice }}</p>
      </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
