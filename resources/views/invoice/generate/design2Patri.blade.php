<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invoice #{{ $invoices['id'] }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel=”stylesheet” href=”css/bootstrap.css”>
<link rel=”stylesheet” href=”css/bootstrap-responsive.css”>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
<style>
   {
	border: 0;
	box-sizing: content-box;
	color: inherit;
	font-family: inherit;
	font-size: inherit;
	font-style: inherit;
	font-weight: inherit;
	line-height: inherit;
	list-style: none;
	margin: 0;
	padding: 0;
	text-decoration: none;
	vertical-align: top;
}

/* content editable */

*[contenteditable] { border-radius: 0.25em; min-width: 1em; outline: 0; }

*[contenteditable] { cursor: pointer; }

*[contenteditable]:hover, *[contenteditable]:focus, td:hover *[contenteditable], td:focus *[contenteditable], img.hover { background: #DEF; box-shadow: 0 0 1em 0.5em #DEF; }

span[contenteditable] { display: inline-block; }

/* heading */

h1 { font: bold 100% sans-serif; letter-spacing: 0.5em; text-align: center; text-transform: uppercase; }

/* table */

table { font-size: 75%; table-layout: fixed; width: 100%; }
table { border-collapse: separate; border-spacing: 2px; }
th, td { border-width: 1px; padding: 0.5em; position: relative; text-align: left; }
th, td { border-radius: 0.25em; border-style: solid; }
th { background: #EEE; border-color: #BBB; }
td { border-color: #DDD; }

/* page */

html { font: 16px/1 'Open Sans', sans-serif; overflow: auto; padding: 0.5in; }
html { background: #999; cursor: default; }

body { box-sizing: border-box; height: 11in; margin: 0 auto; overflow: hidden; padding: 0.5in; width: 8.5in; }
body { background: #FFF; border-radius: 1px; box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5); }

/* header */

header { margin: 0 0 3em; }
header:after { clear: both; content: ""; display: table; }

header h1 { background: #000; border-radius: 0.25em; color: #FFF; margin: 0 0 1em; padding: 0.5em 0; }
header address { float: left; font-size: 75%; font-style: normal; line-height: 1.25; margin: 0 1em 1em 0; }
header address p { margin: 0 0 0.25em; }
header span, header img { display: block; float: right; }
header span { margin: 0 0 1em 1em; max-height: 25%; max-width: 60%; position: relative; }
header img { max-height: 100%; max-width: 100%; }
header input { cursor: pointer; -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)"; height: 100%; left: 0; opacity: 0; position: absolute; top: 0; width: 100%; }

/* article */

article, article address, table.meta, table.inventory { margin: 0 0 3em; }
article:after { clear: both; content: ""; display: table; }
article h1 { clip: rect(0 0 0 0); position: absolute; }

article address { float: left; font-size: 125%; font-weight: bold; }

/* table meta & balance */

table.meta, table.balance { float: right; width: 36%; }
table.meta:after, table.balance:after { clear: both; content: ""; display: table; }

/* table meta */

table.meta th { width: 40%; }
table.meta td { width: 60%; }

/* table items */

table.inventory { clear: both; width: 100%; }
table.inventory th { font-weight: bold; text-align: center; }

table.inventory td:nth-child(1) { width: 26%; }
table.inventory td:nth-child(2) { width: 38%; }
table.inventory td:nth-child(3) { text-align: right; width: 12%; }
table.inventory td:nth-child(4) { text-align: right; width: 12%; }
table.inventory td:nth-child(5) { text-align: right; width: 12%; }

/* table balance */

table.balance th, table.balance td { width: 50%; }
table.balance td { text-align: right; }

/* aside */

aside h1 { border: none; border-width: 0 0 1px; margin: 0 0 1em; }
aside h1 { border-color: #999; border-bottom-style: solid; }

/* javascript */

.add, .cut
{
	border-width: 1px;
	display: block;
	font-size: .8rem;
	padding: 0.25em 0.5em;	
	float: left;
	text-align: center;
	width: 0.6em;
}

.add, .cut
{
	background: #9AF;
	box-shadow: 0 1px 2px rgba(0,0,0,0.2);
	background-image: -moz-linear-gradient(#00ADEE 5%, #0078A5 100%);
	background-image: -webkit-linear-gradient(#00ADEE 5%, #0078A5 100%);
	border-radius: 0.5em;
	border-color: #0076A3;
	color: #FFF;
	cursor: pointer;
	font-weight: bold;
	text-shadow: 0 -1px 2px rgba(0,0,0,0.333);
}

.add { margin: -2.5em 0 0; }

.add:hover { background: #00ADEE; }

.cut { opacity: 0; position: absolute; top: 0; left: -1.5em; }
.cut { -webkit-transition: opacity 100ms ease-in; }

tr:hover .cut { opacity: 1; }

@media print {
	* { -webkit-print-color-adjust: exact; }
	html { background: none; padding: 0; }
	body { box-shadow: none; margin: 0; }
	span:empty { display: none; }
	.add, .cut { display: none; }
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
                    <p>Invoice #{{ $invoices['id'] }}</p>
                    <p><strong>{{ ucfirst($invoices['status']) }}</strong></p>
                    <p><strong>Emitting Date:</strong> {{ date('d-m-Y', strtotime($invoices['DateOfIssue'])) }}</p>
                    <p><strong>Term:</strong> {{ date('d-m-Y', strtotime($invoices['Term'])) }}</p>
                    <p><strong>Series and Number:</strong> {{$invoices['SeriesNumber']}}</p>
                    <p><strong>Method:</strong> {{$invoices['method']}}</p>
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
                <td>{{ $clients['Name'] }}</td>
            </tr>
            <tr>
                <td>CIF:</td>
                <td>{{ $companyInfo->where('key', 'CIF')->first()->value ?? '' }}</td>
                <td>CIF:</td>
                <td>{{$clients['CIF']}}</td>
            </tr>
            <tr>
                <td>Register:</td>
                <td>{{ $companyInfo->where('key', 'Register')->first()->value ?? '' }}</td>
                <td>Register:</td>
                <td> {{$clients['Register']}}</td>
            </tr>
            <tr>
                <td>Legal form:</td>
                <td>{{ $companyInfo->where('key', 'Legal_form')->first()->value ?? '' }}</td>
                <td>Legal form:</td>
                <td>{{ $clients['legal_form'] }}</td>
            </tr>
            <tr>
                <td>Bank:</td>
                <td>{{ $companyInfo->where('key', 'Bank')->first()->value ?? '' }}</td>
                <td>Bank:</td>
                <td> {{$clients['Bank']}}</td>
            </tr>
            <tr>
                <td>IBAN:</td>
                <td>{{ $companyInfo->where('key', 'IBAN')->first()->value ?? '' }}</td>
                <td>IBAN:</td>
                <td> {{$clients['Account']}}</td>
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
            @foreach($invoices->products as $product) 
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
                    foreach($invoices->products as $product) {
                        $totalProductPrice += $product->PriceWithVAT;
                            }
                        @endphp
                <td colspan="6" class="total-heading">Total Amount - <small>Inc. all vat/tax</small> :</td>
                <td colspan="1" class="total-heading">{{ $totalProductPrice }}</td>
                <td colspan="1" class="total-heading">{{$invoices['currency1']}}</td>
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
                <th colspan="5">Issued By</th>
                <th colspan="5">To</th>
            </tr>
                        </thead>
                        <tbody>
            <tr>
                <td>Name:</td>
                <td  class="text-center" colspan="4">{{ $invoices['Made'] }}</td>
                <td>Name:</td>
                <td class="text-center" colspan="4">{{ $invoices['Delegate'] }}</td>
            </tr>
            <tr>
                <td>ID:</td>
                <td class="text-center" colspan="4">{{$invoices['ID_made']}}</td>
                <td>ID:</td>
                <td class="text-center" colspan="4">{{$invoices['ID_delegate']}}</td>
            </tr>
            <tr>
                <td>Email:</td>
                <td class="text-center" colspan="4">{{$invoices['email_made'   ]}}</td>
                <td>Email:</td>
                <td class="text-center" colspan="4"> {{$invoices['email_delegate'    ]}}</td>
            </tr>
            <tr>
                <td>Phone:</td>
                <td class="text-center" colspan="4">{{$invoices['phone']}}</td>
                <td>Phone:</td>
                <td class="text-center" colspan="4"> {{$invoices['phone_delegate']}}</td>
            </tr>
            <tr>
            <td class="text-center" colspan="4">Mentions:{{$invoices['Mentions']}}</td>
                        </tr>
        </tbody>
    </table>
                            
    <br>
    </div>
</body>
</html>