
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
<html>
<style>
  body {
  font-family: "Arial", sans-serif;
  background-color: #ffc0cb; /* Pink background */
  margin: 0;
  padding: 0;
}

.invoice-container {
  width: 80%;
  margin: 30px auto;
  padding: 20px;
  background-color: #fff; 
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

.invoice-header {
  text-align: center;
  margin-bottom: 20px;
}

.title {
  font-size: 24px;
  color: #333;
  margin-bottom: 5px;
}

.date {
  font-size: 16px;
  color: #777;
}

.invoice-number {
  font-size: 18px;
  color: #555;
}

table {
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 20px;
}

th, td {
  padding: 10px;
  border-bottom: 1px solid #ddd;
  text-align: left;
}

th {
  background-color: #f2f2f2;
  font-weight: bold;
}

.total {
  font-size: 20px;
  font-weight: bold;
  color: #333;
  text-align: right;
}


</style>
<body>
    <div class="container">
        <table class="order-details"> 
    
        <thead>
            <tr>
                
                    
                
                <th colspan="4" class="text-center company-data">
                <h2 class="text-center">Invoice Master</h2>
                    <p>Invoice #{{ $invoices['id'] }}</p>
                    <p><strong>{{ ucfirst($invoices['status']) }}</strong></p>
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
                <td class="text-center" colspan="4">{{$invoices['phone'   ]}}</td>
                <td>Phone:</td>
                <td class="text-center" colspan="4"> {{$invoices['phone_delegate'    ]}}</td>
            </tr>
            <tr>
            <td class="text-center" colspan="4">Mentions:{{$invoices['Mentions']}}</td>
                        </tr>

                        <thead>
            <tr>
                <th class="heading text-center" colspan="8"> 
                </th>
            </tr>
        <tr>
            <td>Emitting Date:</td>
                <td class="text-center" colspan="4"> {{ date('d-m-Y', strtotime($invoices['DateOfIssue'])) }}</td>
                <td>Term:</td>
                <td class="text-center" colspan="4">{{ date('d-m-Y', strtotime($invoices['Term'])) }} </td>

                          </tr>
                          </thead>
        </tbody>
    </table>
                            
    <br>
    </div>
</body>
<html>