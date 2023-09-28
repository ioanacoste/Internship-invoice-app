@extends('layoutPages')
@section('title', 'Billing')
@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
<div class="container">
<div>
        @if($errors->any())
            <div class="col-12">
                    @foreach($errors->all() as $error)
                    <div class="alert alert-danger">{{$error}}</div>
                    @endforeach
            </div>
        @endif

        @if(session()->has('error'))
            <div class="alert alert-danger">{{session('error')}}</div>
        @endif 
        @if(session()->has('success'))
            <div class="alert alert-success">{{session('success')}}</div>
        @endif
        @if(session()->has('warning'))
    <div class="alert alert-warning">
        {{ session('warning') }}
    </div>
@endif
    </div>
<div class="col">
                <a class="btn btn-secondary" href="{{route('invoices')}}">BACK</a>
              </div>
              <p> </p>
              <p> </p>
              <h2>Company Information</h2>

<form action="{{route('billing.post')}}" method="POST" class=" needs-validation d-flex flex-column" >
            @csrf 
            <hr class="hr" />

            <div class="col-md-2">
      <div class="form-group">
      <h3 class="small">Existing Client</h3>
    <select class="form-select" id="existingClient" name="existingClient">
            <option value="" disabled selected>Select an existing client</option>
            @foreach($existingClients as $client)
            <option value="{{ $client->id }}"
                    data-client-name="{{ $client->Name }}"
                    data-client-cif="{{ $client->CIF }}"
                    data-client-legalform="{{ $client->legal_form }}"
                    data-client-register="{{ $client->Register }}"
                    data-client-bank="{{ $client->Bank }}"
                    data-client-account="{{ $client->Account }}">
                    {{ $client->Name }}
                </option>
            @endforeach
        </select>
        <p> </p><p> </p> <p> </p>
    <select class="form-select" id="legal_form" name="legal_form">
        <option value="" disabled selected>Choose the legal form</option>
        <option value="SRL">SRL</option>
        <option value="PFA">PFA</option>
        <option value="II">II</option>
        <option value="IF">IF</option>
    </select>
      </div>
    </div>
    <p></p>
        <div class="row outline">
            <div class="col-md-4">
                <div class="form-group">
                    <h3 class="small">Name</h3>
                    <input type="text" class="form-control" placeholder="Fill in here" name="Name">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <h3 class="small">CIF</h3>
                    <input type="text" class="form-control" placeholder="RO########" name="CIF" aria-describedby="CIFHelp">
                    <small id="CIFHelp" class="form-text text-muted">ex. RO00001111 </small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <h3 class="small">TradeReg</h3>
                    <input type="text" class="form-control" placeholder="J\F\C##/####/####" name="Register" aria-describedby="TradeHelp">
                    <small id="TradeHelp" class="form-text text-muted">ex. J00/0000/0000 </small>
                </div>
            </div>
            
            <div class="row outline">
            <div class="col-md-6">
                <div class="form-group">
                    <h3 class="small">Bank</h3>
                    <input type="text" class="form-control" placeholder="Fill in here" name="Bank">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <h3 class="small">IBAN</h3>
                    <input type="text" class="form-control" placeholder="[A-Z]{2}########" name="Account" aria-describedby="IBANHelp">
                    <small id="IBANHelp" class="form-text text-muted">ex. BT01010101 </small>
                </div>
            </div>
</div>
        </div>
        <p> </p>
        <p> </p>
              <h2>Invoice Information</h2>
        <hr class="hr" />

        <div class="row">
            
            <div class="col-md-4">
                <div class="form-group">
                    <h3 class="small">Date Of Issue</h3>
                    <input type="text" class="form-control" id="DateOfIssue" name="DateOfIssue" placeholder="Automatic Filling Date of Issue" onclick="completeDateFields()">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <h3 class="small">Term</h3>
                    <input type="text" class="form-control" id="Term" name="Term" placeholder="Automatic Filling Data of Term" onclick="completeDateFields()">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <h3 class="small">Series and number</h3>
                    <input type="text" class="form-control" placeholder="Fill in here" name="SeriesNumber">
                </div>
            </div>
        </div>
        <p></p>
        <div class="row">
            <div class="col-6">
            <div class="form-group">
            <h3 class="small">Language</h3>
                    <select class="form-select" id="language" name="lang" aria-label=".form-select-lg example">
                        <option value="" disabled selected>Choose language</option>
                        <option value="Romanian">Romanian</option>
                        <option value="English">English</option>
                        <option value="French">French</option>
                    </select>
            </div>
            </div>
            <div class="col-6">
            <div class="form-group">
            <h3 class="small">Currency</h3>
            <select class="form-select" id="currency" name="currency1" aria-label=".form-select-lg example">
                        <option value="" disabled selected>Choose currency</option>
                        <option value="ron">RON</option>
                        <option value="euro">EURO</option>
                    </select>
                </div>
        </div>
</div>
<p></p>
<p></p><p></p>
        <h2>Products/Services Information</h2>
<p></p>
                <hr class="hr" />
                <p></p>
<div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <h3 class="small">Product or service name</h3>
                    <input type="text" class="form-control" placeholder="Fill in here" name="ProductService" id="ProductService">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <h3 class="small">Measure unit</h3>
                    <input type="text" class="form-control" placeholder="Fill in here" name="Unit">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <h3 class="small">Quantity</h3>
                    <input type="text" class="form-control" placeholder="Fill in here" name="Quantity" id="quantity">
                </div>
            </div>
</div>
<p></p>
<div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <h3 class="small">VAT Rate</h3>
                    <input type="text" class="form-control" placeholder="Fill in here" name="VATrate" id="tva">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <h3 class="small">Unit price</h3>
                    <input type="text" class="form-control" placeholder="Fill in here" name="UnitPrice" id="unitprice">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <h3 class="small">Price without VAT</h3>
                    <input type="text" class="form-control" placeholder="Fill in here" name="PriceWithoutVAT" id="pricewithoutvat">
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="form-group">
                    <h3 class="small">Price with VAT</h3>
                    <input type="text" class="form-control" placeholder="Fill in here" name="PriceWithVAT" id="pricewithvat">
                </div>
            </div>
            
        </div>
        <p> </p>
        <div>
        <div class="col-md-3">
                <div class="form-group">
                <button class="btn btn-secondary me-md-2" type="button" id="addProductButton">Add product/service</button>
                </div>
            </div>
    <div>
    <p> </p>
    <p> </p><p> </p>
    <h4>List of Added Products:</h4>
    <table id="productTable" class="table">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Unit</th>
                <th>Quantity</th>
                <th>VAT Rate</th>
                <th>Unit Price</th>
                <th>Price without VAT</th>
                <th>Price with VAT</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="productTableBody"></tbody>
    </table>
    <input type="hidden" name="products" id="products" value="[]">

</div>
</div>
    <p> </p>
    <p> </p>
              <h2>Employees Information</h2>
                <hr class="hr" />
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <h3 class="small">Made by</h3>
                            <input type="text" class="form-control" placeholder="Fill in here" name="Made">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <h3 class="small">ID card</h3>
                            <input type="text" class="form-control" placeholder="Fill in here" name="ID_made">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <h3 class="small">E-mail</h3>
                            <input type="email" class="form-control" placeholder="Fill in here" name="email_made">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <h3 class="small">Phone</h3>
                            <input type="text" class="form-control" placeholder="Fill in here" name="phone">
                        </div>
                    </div>
     </div>
    
     <p> </p>
     <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <h3 class="small">Delegate</h3>
                    <input type="text" class="form-control" placeholder="Fill in here" name="Delegate">
                </div>
            </div>
           
            <div class="col-md-3">
                        <div class="form-group">
                            <h3 class="small">ID card</h3>
                            <input type="text" class="form-control" placeholder="Fill in here" name="ID_delegate">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <h3 class="small">E-mail</h3>
                            <input type="email" class="form-control" placeholder="Fill in here" name="email_delegate">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <h3 class="small">Phone</h3>
                            <input type="text" class="form-control" placeholder="Fill in here" name="phone_delegate">
                        </div>
                    </div>
    </div>
    <p> </p>
     <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <h3 class="small">No. accompanying notice</h3>
                    <input type="text" class="form-control" placeholder="Fill in here" name="NoNotice">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <h3 class="small">Mentions</h3>
                    <input type="text" class="form-control" placeholder="Here add a necessary mention" name="Mentions">
                </div>
            </div>
            
     </div>
     <p> </p>
     <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <h3 class="small">Delivery date</h3>
                    <input type="text" class="form-control" placeholder="DD/MM/YY" name="DeliveryDate" id="DeliveryDate">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <h3 class="small">Date of collection</h3>
                    <input type="text" class="form-control" placeholder="DD/MM/YY" name="DateOfCollection">
                </div>
            </div>
            <div class="col-md-3">
            <div class="form-group">
            <h3 class="small">Payment</h3>
            <select class="form-select" id="method" name="method" aria-label=".form-select-lg example">
                        <option value="" disabled selected>Choose method</option>
                        <option value="Card">Card</option>
                        <option value="Cash">Cash</option>
                        <option value="Payment Order">Payment Order</option>

                    </select>
                </div>
        </div>
        
        <p> </p>
     </div>
     <div class="col-md-3  d-flex justify-content-end">
            <div class="form-group">
            <h3 class="small"></h3>
        <button class="btn btn-primary me-md-2" id="saveProductsButton" type="submit">Invoice preview</button>
    </div>
        </div>
</form>
<p> </p><p> </p>

</div>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

     <script>
        const existingClientSelect = document.getElementById('existingClient');
        const formInput = document.querySelector('[name="legal_form"]');
        const nameInput = document.querySelector('[name="Name"]');
        const cifInput = document.querySelector('[name="CIF"]');
        const registerInput = document.querySelector('[name="Register"]');
        const bankInput = document.querySelector('[name="Bank"]');
        const accountInput = document.querySelector('[name="Account"]');
        // ... alte câmpuri din formular

        existingClientSelect.addEventListener('change', function() {
            const client_id = existingClientSelect.value;
            const selectedOption = existingClientSelect.options[existingClientSelect.selectedIndex];
            
            const selectedClientForm = selectedOption.getAttribute('data-client-legalform');
            const selectedClientName = selectedOption.getAttribute('data-client-name');
            const selectedClientCIF = selectedOption.getAttribute('data-client-cif');
            const selectedClientRegister = selectedOption.getAttribute('data-client-register');
            const selectedClientBank = selectedOption.getAttribute('data-client-bank');
            const selectedClientAccount = selectedOption.getAttribute('data-client-account');
            

            formInput.value=selectedClientForm;
            nameInput.value = selectedClientName;
            cifInput.value = selectedClientCIF;
            registerInput.value = selectedClientRegister;
            bankInput.value = selectedClientBank;
            accountInput.value = selectedClientAccount;
            // Exemplu de cod AJAX
            $.ajax({

                
                type: 'GET',
                url: `/getClientData/${client_id}`, // ruta corectă către backend
                success: function(response) {
                    formInput.value=response.legal_form
                    nameInput.value = response.Name;
                    cifInput.value = response.CIF;
                    registerInput.value = response.Register;
                    bankInput.value=response.Bank;
                    accountInput.value=response.Account;
                },
                error: function(error) {
                    console.error('Error fetching client data:', error);
                }
            });
        });
        
          function completeDateFields() {
        var currentDate = new Date();
        var futureDate = new Date();
        futureDate.setDate(futureDate.getDate() + 30);
        var options = { day: '2-digit', month: '2-digit', year: 'numeric' };
        var currentDateFormatted = currentDate.toLocaleDateString('ro-RO', options).replace(/\./g, '-');
        var futureDateFormatted = futureDate.toLocaleDateString('ro-RO', options).replace(/\./g, '-');
        document.getElementById('DateOfIssue').value = currentDateFormatted;
        document.getElementById('DeliveryDate').value = currentDateFormatted;
        document.getElementById('Term').value = futureDateFormatted;
    }
document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector('form');
    const addProductButton = document.getElementById('addProductButton');
    const productTableBody = document.getElementById('productTableBody');
    const quantityInput = document.getElementById('quantity');
    const unitPriceInput = document.getElementById('unitprice');
    const vatRateInput = document.getElementById('tva');
    const priceWithoutVATInput = document.getElementById('pricewithoutvat');
    const priceWithVATInput = document.getElementById('pricewithvat');
    var productList = [];

    function updateProductTable() {
        productTableBody.innerHTML = '';

        productList.forEach((product, index) => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${product.name}</td>
                <td>${product.unit}</td>
                <td>${product.quantity}</td>
                <td>${product.vatRate}</td>
                <td>${product.unitPrice}</td>
                <td>${product.priceWithoutVAT}</td>
                <td>${product.priceWithVAT}</td>
                <td><button class="btn btn-danger btn-sm" onclick="deleteProduct(${index})">Delete</button></td>
            `;
            productTableBody.appendChild(row);
        });
    }

    function addProductToList() {
    // Capture values from the form
    const productName = form.querySelector('[name="ProductService"]').value;
    const productUnit = form.querySelector('[name="Unit"]').value;
    const productQuantity = form.querySelector('[name="Quantity"]').value;
    const productVATrate = form.querySelector('[name="VATrate"]').value;
    const productUnitPrice = form.querySelector('[name="UnitPrice"]').value;
    const productPriceWithoutVAT = form.querySelector('[name="PriceWithoutVAT"]').value;
    const productPriceWithVAT = form.querySelector('[name="PriceWithVAT"]').value;
    const product = {
        name: productName,
        unit: productUnit,
        quantity: productQuantity,
        vatRate: productVATrate,
        unitPrice: productUnitPrice,
        priceWithoutVAT: productPriceWithoutVAT,
        priceWithVAT: productPriceWithVAT
    };

        // Validation and adding to the list
        if (productName && productUnit && productQuantity && productVATrate && productUnitPrice && productPriceWithoutVAT && productPriceWithVAT) {
            productList.push(product);
            console.log(productList);
            // Update table display
            updateProductTable();

            // Reset product-related fields
            form.querySelector('[name="ProductService"]').value = '';
            form.querySelector('[name="Unit"]').value = '';
            form.querySelector('[name="Quantity"]').value = '';
            form.querySelector('[name="VATrate"]').value = '';
            form.querySelector('[name="UnitPrice"]').value = '';
            form.querySelector('[name="PriceWithoutVAT"]').value = '';
            form.querySelector('[name="PriceWithVAT"]').value = '';
        } else {
            alert('Please fill in all fields to add a product.');
        }
    }


    addProductButton.addEventListener('click', addProductToList);

        function updateHiddenField() {
            console.log('Updating hidden field with productList:', productList);
            const productsJsonField = document.getElementById('products');
            productsJsonField.value = JSON.stringify(productList);
        }



        $('#saveProductsButton').click(function() {
        updateHiddenField();
        const updatedProductsJson = document.getElementById('products').value;
        // Trimiteți datele către backend folosind AJAX
        $.ajax({
            type: 'POST',
            url: '/billingSave', // Specificați aici ruta corectă către backend
            data: {
                products: updatedProductsJson
            },
            success: function(response) {
                // Manipulați răspunsul primit de la server (dacă este necesar)
            },
            error: function(error) {
                // Tratați erorile în caz de problemă la trimiterea datelor
            }
        });
    });


    function deleteProduct(index) {
        productList.splice(index, 1);
        updateProductTable();
    }


    quantityInput.addEventListener('input', calculatePriceWithoutVAT);
    unitPriceInput.addEventListener('input', calculatePriceWithoutVAT);
    quantityInput.addEventListener('input', calculatePriceWithVAT);
    unitPriceInput.addEventListener('input', calculatePriceWithVAT);
    vatRateInput.addEventListener('input', calculatePriceWithVAT);

    function calculatePriceWithoutVAT() {
        const quantity = parseFloat(quantityInput.value);
        const unitPrice = parseFloat(unitPriceInput.value);
        const priceWithoutVAT = quantity * unitPrice;

        priceWithoutVATInput.value = priceWithoutVAT.toFixed(2);
    }

    function calculatePriceWithVAT() {
        const quantity = parseFloat(quantityInput.value);
        const unitPrice = parseFloat(unitPriceInput.value);
        const tvaInput = parseFloat(vatRateInput.value);
        const tvaDecimal = tvaInput / 100;
        const priceWithVAT = quantity * unitPrice * tvaDecimal + quantity * unitPrice;

        priceWithVATInput.value = priceWithVAT.toFixed(2);
    }
});

    </script>
@endsection
