<!DOCTYPE html>
<html>
<head>
    <title>Invoices Report</title>
</head>
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
<body>
              <p> </p>

    <h1>Invoices Report</h1>
    <table class="table">
        <thead>
            <tr>
            <th class="text-center" scope="col">Id Invoice</th>
            <th class="text-center" scope="col">Name Client</th>
                <th class="text-center"  scope="col">Series</th>
                <th class="text-center"  scope="col">Issue date</th>
                <th class="text-center"  scope="col">Term</th>  
                <th class="text-center"  scope="col">Status</th>
                <th class="text-center"  scope="col">Method</th>
                <th class="text-center"  colspan="2" scope="col">Total</th>
            </tr>
        </thead>
        <tbody>
         @php
                $totalRON = 0;
                $totalEURO = 0;
            @endphp
            @foreach ($invoices as $invoice)
                <tr>
                <td class="text-center">{{ $invoice->id }}</td>
                <td class="text-center">{{ $invoice->clients->Name }}</td>
                
                <td class="text-center">{{ $invoice->SeriesNumber }}</td>
                <td class="text-center">{{ date('d-m-Y', strtotime($invoice->DateOfIssue ))}}</td>
                    <td class="text-center">{{ date('d-m-Y', strtotime($invoice->Term)) }}</td>
                    <td class="text-center">{{ $invoice->status }}</td>
                    <td class="text-center">{{ $invoice->method }}</td>
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
            <td class="text-center">{{ $totalProductPrice }}</td>
            <td class="text-center">{{ $invoice->currency1 }}</td>
                </tr>
                @endforeach
            <tr>
<tr>
    <td colspan="7" class="text-end total-heading">Total:</td>
    
    <td colspan="2" class="total-heading text-center">{{ $totalRON }} ron  <br></br> {{ $totalEURO }} euro</td>
</tr>

            </tr>
        </tbody>
    </table>
</body>
</html>
