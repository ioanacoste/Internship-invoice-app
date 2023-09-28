<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Preview</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel=”stylesheet” href=”css/bootstrap.css”>
<link rel=”stylesheet” href=”css/bootstrap-responsive.css”>
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
  
  .invoice-invoice p {
    margin: 5px 0;
  }
  .invoice-sub p {
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
  </head>
  <body>
<div class="container">
  <div class="invoice-container">
    <div class="invoice-header">
      <h2>Invoice #{{ $invoice['id'] }}</h2>
      <span class="invoice-status">{{ ucfirst($invoice['status']) }}</span>
    </div>
    <div class="invoice-details">
      <p><strong>Name Buyer:</strong> {{ $invoice['Name'] }}</p>
      <p><strong>Legal Form:</strong> {{ $invoice['legal_form'] }}</p>
      <p><strong> CIF: </strong>{{$invoice['CIF']}} </p>
        <p><strong> Register:</strong> {{$invoice['Register']}} </p>
        <p><strong> Bank:</strong> {{$invoice['Bank']}} </p>
        <p><strong> Account:</strong> {{$invoice['Account']}} </p>
</div> <hr></hr>
        <div class="invoice-invoice">
        <p><strong>Emitting Date:</strong> {{ date('d-m-Y', strtotime($invoice['DateOfIssue'])) }}</p>
       <p> <strong>Term:</strong> {{ date('d-m-Y', strtotime($invoice['Term'])) }} </p>
       <p> <strong>Seriers and Number:</strong> {{$invoice['SeriesNumber']}} </p>
       <p> <strong>Method:</strong> {{$invoice['method']}} </p>
    </div>
    <table class="invoice-table">
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
        @foreach($invoice->products as $product) 
        <tr>
        <td> {{$product->id}}</td>
            <td> {{$product->ProductService}}</td>
                <td> {{$product->Unit}}</td>
                    <td> {{ $product->Quantity}}</td>
                    <td>{{ $product->PriceWithVAT}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <div class="invoice-total">
    @php
        $totalProductPrice = 0;
        foreach($invoice->products as $product) {
            $totalProductPrice += $product->PriceWithVAT;
        }
    @endphp
         <p><strong>Total Price:</strong> {{ $totalProductPrice }}</p>
      
    </div>
    <hr></hr>
    <div class="invoice-sub">
    <p> <strong>Made out:</strong> {{$invoice['Made']}} </p>
       <p> <strong>ID: </strong>{{$invoice['ID_made']}} </p>
       <p> <strong>Email:</strong> {{$invoice['email_delegate']}} </p>
       <hr></hr>
       <p> <strong>Delegate:</strong> {{$invoice['Delegate']}} </p>
       <p> <strong>ID delegate: </strong>{{$invoice['ID_delegate']}} </p>
       <p> <strong>Email delegate:</strong> {{$invoice['email_delegate']}} </p>
       <hr></hr>
       <p><strong> Number Notice:</strong> {{$invoice['NoNotice']}} </p>
       <p><strong> Mentions:</strong> {{$invoice['Mentions']}} </p>
       <p><strong> Delivery Date:</strong> {{ date('d-m-Y', strtotime($invoice['DeliveryDate'])) }} </p>
       <p><strong> Date Of Collection: </strong>{{ date('d-m-Y', strtotime($invoice['DateOfCollection'])) }} </p>

    </div>
</div>
    </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" ></script>
  </body>
</html>
<!-- html,
        body {
            margin: 10px;
            padding: 10px;
            font-family: sans-serif;
            
        }
        h1,h2,h3,h4,h5,h6,p,span,label {
            font-family: sans-serif;
        }
        table {
            width: 60%;
            border-collapse: collapse;
            margin-bottom: 0px !important;
        }
        table thead th {
            height: 28px;
            text-align: left;
            font-size: 16px;
            font-family: sans-serif;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 14px;
        }
        table {
          display: table;
      }
      tr {
          display: table-row;
      }
      highlight {
          background-color: greenyellow;
          display: table-cell;
      }
        .heading {
            font-size: 24px;
            margin-top: 12px;
            margin-bottom: 12px;
            font-family: sans-serif;
        }
        .small-heading {
            font-size: 18px;
            font-family: sans-serif;
        }
        .total-heading {
            font-size: 18px;
            font-weight: 700;
            font-family: sans-serif;
        }
        .order-details tbody tr td:nth-child(1) {
            width: 20%;
        }
        .order-details tbody tr td:nth-child(3) {
            width: 20%;
        }

        .text-start {
            text-align: left;
        }
        .text-end {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .company-data span {
            margin-bottom: 4px;
            font-family: sans-serif;
            font-size: 14px;
            font-weight: 400;
        }
        .no-border {
            border: 1px solid #fff !important;
        }
        .bg-blue {
            background-color: #414ab1;
            color: #fff;
        } -->