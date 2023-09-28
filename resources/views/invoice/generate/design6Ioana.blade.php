<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invoice #{{ $invoice['id'] }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel=”stylesheet” href=”css/bootstrap.css”>
<link rel=”stylesheet” href=”css/bootstrap-responsive.css”>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    

    <style>
         @page {
            size: A4;
            margin: 0;
        }
        html,
        body {
            margin: 10px;
            padding: 10px;
            font-family: sans-serif;
            
        }
        h1,h2,h3,h4,h5,h6,p,span,label {
            font-family: sans-serif;
        }
        table {
            width: 100%;
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
        }
    </style>
</head>
<body>
    <div class="container">
        <table class="order-details"> 
    
        <thead>
            <tr>
                
                    
                
                <th colspan="4" class="text-center company-data">
                <h2 class="text-center">Invoice Master</h2>
                    <p>Invoice #{{ $invoice['id'] }}</p>
                    <p><strong>{{ ucfirst($invoice['status']) }}</strong></p>
                    <p><strong>Emitting Date:</strong> {{ date('d-m-Y', strtotime($invoice['DateOfIssue'])) }}</p>
                    <p><strong>Term:</strong> {{ date('d-m-Y', strtotime($invoice['Term'])) }}</p>
                    <p><strong>Series and Number:</strong> {{$invoice['SeriesNumber']}}</p>
                    <p><strong>Method:</strong> {{$invoice['method']}}</p>
                </th>
            </tr>
            <tr class="bg-blue">
                <th colspan="2">Company Details</th>
                <th colspan="2">Client Details</th>
            </tr>
        </thead>
    
        <tbody>
            
            <tr>
                <td>Name:</td>
                <td>{{ $companyInfo->where('key', 'Company')->first()->value ?? '' }}</td>
                <td>Name:</td>
                <td>{{ $invoice['Name'] }}</td>
            </tr>
            <tr>
                <td>CIF:</td>
                <td>{{ $companyInfo->where('key', 'CIF')->first()->value ?? '' }}</td>
                <td>CIF:</td>
                <td>{{$invoice['CIF']}}</td>
            </tr>
            <tr>
                <td>Register:</td>
                <td>{{ $companyInfo->where('key', 'Register')->first()->value ?? '' }}</td>
                <td>Register:</td>
                <td> {{$invoice['Register']}}</td>
            </tr>
            <tr>
                <td>Legal form:</td>
                <td>{{ $companyInfo->where('key', 'Legal_form')->first()->value ?? '' }}</td>
                <td>Legal form:</td>
                <td>{{ $invoice['legal_form'] }}</td>
            </tr>
            <tr>
                <td>Bank:</td>
                <td>{{ $companyInfo->where('key', 'Bank')->first()->value ?? '' }}</td>
                <td>Bank:</td>
                <td> {{$invoice['Bank']}}</td>
            </tr>
            <tr>
                <td>IBAN:</td>
                <td>{{ $companyInfo->where('key', 'IBAN')->first()->value ?? '' }}</td>
                <td>IBAN:</td>
                <td> {{$invoice['Account']}}</td>
            </tr>

        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <th class="heading text-center" colspan="8">
                    Order Items
                </th>
            </tr>
            <tr class="bg-blue">
                <th scope="col" class="fs-sm text-dark text-uppercase-bold-sm px-1">Id</th>
                <th scope="col" class="fs-sm text-dark text-uppercase-bold-sm px-1">Product</th>
                <th scope="col" class="fs-sm text-dark text-uppercase-bold-sm px-1">Unit</th>
                <th scope="col" class="fs-sm text-dark text-uppercase-bold-sm px-1">Unit Price</th>
                <th scope="col" class="fs-sm text-dark text-uppercase-bold-sm px-1">Quantity</th>
                <th scope="col" class="fs-sm text-dark text-uppercase-bold-sm px-1">Price without VAT</th>
                <th scope="col" class="fs-sm text-dark text-uppercase-bold-sm px-1">Price with VAT</th>
                <th scope="col" class="fs-sm text-dark text-uppercase-bold-sm px-1"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoice->products as $product) 
            <tr>
                <td class="px-1"> {{$product->id}}</td>
                <td class="px-1"> {{$product->ProductService}}</td>
                <td class="px-1"> {{$product->Unit}}</td>
                <td class="px-1"> {{$product->UnitPrice}}</td>
                <td class="px-1"> {{ $product->Quantity}}</td>
                <td class="px-1">{{ $product->PriceWithoutVAT}}</td>
                <td class="px-1">{{ $product->PriceWithVAT}}</td>
            </tr> 
            @endforeach
            <tr>
                        @php
                    $totalProductPrice = 0;
                    foreach($invoice->products as $product) {
                        $totalProductPrice += $product->PriceWithVAT;
                            }
                        @endphp
                <td colspan="6" class="total-heading">Total Amount - <small>Inc. all vat/tax</small> :</td>
                <td colspan="1" class="total-heading">{{ $totalProductPrice }}</td>
                <td colspan="1" class="total-heading">{{$invoice['currency1']}}</td>
            </tr>
        </tbody>
        </table>
        <table>
        <thead>
            <tr>
                <th class="heading text-center" colspan="8"> 
                </th>
            </tr>
            <tr class="bg-blue">
                <th colspan="2">Issued By</th>
                <th colspan="2">To</th>
            </tr>
                        </thead>
                        <tbody>
            <tr>
                <td>Name:</td>
                <td>{{ $invoice['Made'] }}</td>
                <td>Name:</td>
                <td>{{ $invoice['Delegate'] }}</td>
            </tr>
            <tr>
                <td>ID:</td>
                <td>{{$invoice['ID_made']}}</td>
                <td>ID:</td>
                <td>{{$invoice['ID_delegate']}}</td>
            </tr>
            <tr>
                <td>Email:</td>
                <td>{{$invoice['email_made']}}</td>
                <td>Email:</td>
                <td> {{$invoice['email_delegate']}}</td>
            </tr>
            <tr>
            <td class="text-center" colspan="4">Mentions:{{$invoice['Mentions']}}</td>
                        </tr>
        </tbody>
    </table>
                            
    <br>
    </div>
</body>
</html>

