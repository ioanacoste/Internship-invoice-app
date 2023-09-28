@extends('layoutPages')
@section('title', 'Reports')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel=”stylesheet” href=”css/bootstrap.css”>
<link rel=”stylesheet” href=”css/bootstrap-responsive.css”>
<style>
    .center-buttons {
    text-align: center;
}
    </style>
<body>
    <div class="container">
        <p></p>
        <p></p>
        <p></p>


        <div class="row">
  <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title text-center">Total Reports</h5>
          <h2 >Paid Invoices Report</h2>
    <div class="row d-flex justify-content-center center-buttons ">
        <div class="col-md-3">
            <a class="btn btn-primary btn-sm" href="{{ route('invoices-reports-paid') }}">Generate Paid Report</a>   
        </div>
        <div class="col-md-3">
        <a class="btn btn-success btn-sm" href="{{ route('invoices-reports-export') }}">Download</a>
        </div>
    </div>

    <p></p>
        <p></p>
        <p></p>
    <h2>Issued Invoices Report</h2>
    <div class="row d-flex justify-content-center center-buttons ">
    <div class="col-md-3">
        <a class="btn btn-primary btn-sm" href="{{ route('invoices-reports-issued') }}">Generate Issued Report</a>   
    </div>
   
    </div>
    <p></p>
        <p></p>
        <p></p>
    <h2>Overdue Invoices Report</h2>
    <div class="row d-flex justify-content-center center-buttons ">
        <div class="col-md-3">
        <a class="btn btn-primary btn-sm" href="{{ route('invoices-reports-overdue') }}">Generate Overdue Report</a> 
        </div>  
        </div> 
    </div>
        </div>
      </div>
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title text-center">Reports per client</h5>
            <select class="form-select" id="existingClient" name="existingClient">
            <option value="" disabled selected>Select an existing client</option>
            @foreach($existingClients as $client)
            <option value="{{ $client->id }}"
                    data-client-id="{{ $client->id }}">
                    {{ $client->Name }}
                </option>
                @endforeach
            </select>
            <p></p>
            <div class="row">
                <div class="col-md-4">
                    <div>Total paid invoices: </div>
                </div>
                <div class="col-md-2">
                    <div id="totalpaidRON">0</div>
                </div>
                <div class="col-md-2">
                    <div>RON</div>
                </div>
                <div class="col-md-2">
                    <div id="totalpaidEURO">0</div>
                </div>
                <div class="col-md-2">
                    <div>EURO</div>
                </div>
            </div>
            <p></p>
            <div class="row">
                <div class="col-md-4">
                    <div>Total overdue invoices: </div>
                </div>
                <div class="col-md-2">
                    <div id="totaloverdueRON">0</div>
                </div>
                <div class="col-md-2">
                    <div>RON</div>
                </div>
                <div class="col-md-2">
                    <div id="totaloverdueEURO">0</div>
                </div>
                <div class="col-md-2">
                    <div>EURO</div>
                </div>
            </div>
            <p></p>
            <div class="row">
                <div class="col-md-4">
                    <div>Total issued invoices: </div>
                </div>
                <div class="col-md-2">
                    <div id="totalissuedRON">0</div>
                </div>
                <div class="col-md-2">
                    <div>RON</div>
                </div>
                <div class="col-md-2">
                    <div id="totalissuedEURO">0</div>
                </div>
                <div class="col-md-2">
                    <div>EURO</div>
                </div>
            </div>
            <p></p>
            
            <div class="row d-flex justify-content-center center-buttons">
                <div class="col-md-6 ">
                    <a class="btn btn-primary btn-sm"  id="reportButton" >Generate Report</a>   
                </div>
                <div class="col-md-6">
                    <a class="btn btn-success btn-sm" id="downloadButton">Download Report</a>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    
        const existingClientSelect = document.getElementById('existingClient');

        const totalpaidRON = document.getElementById('totalpaidRON'); 
        const totalpaidEURO = document.getElementById('totalpaidEURO'); 
        
        const totalissuedRON = document.getElementById('totalissuedRON'); 
        const totalissuedEURO = document.getElementById('totalissuedEURO'); 

        const totaloverdueRON = document.getElementById('totaloverdueRON'); 
        const totaloverdueEURO = document.getElementById('totaloverdueEURO');
        const button = document.getElementById('reportButton');

        existingClientSelect.addEventListener('change', function() {
         const client_id = existingClientSelect.value;
         console.log(client_id);
         
            $.ajax({
                type: 'GET',
                url: `/getTotal/${client_id}`,
                success: function(response) {
                    totalpaidRON.textContent = response.totalRONpaid;
                    totalpaidEURO.textContent = response.totalEUROpaid;
                    
                    totaloverdueRON.textContent = response.totalRONoverdue;
                    totaloverdueEURO.textContent = response.totalEUROoverdue;
                    
                    totalissuedRON.textContent = response.totalRONissued;
                    totalissuedEURO.textContent = response.totalEUROissued;
                    
                    
                },
                error: function(error) {
                    console.error('Error fetching total:', error);
                }
            });
        });
        reportButton.addEventListener('click', function() {
        const client_id = existingClientSelect.value;
        if (client_id) {
            const generateReportLink = `/invoices_reports/${client_id}`;
            window.location.href = generateReportLink;
        } else {
        alert('Please select a client before generating the report.');
        }   
    });
        downloadButton.addEventListener('click', function() {
        const client_id = existingClientSelect.value;
        if (client_id) {
            const generateReportLink = `/invoices_reports_download/${client_id}`;
            window.location.href = generateReportLink;
        } else {
        alert('Please select a client before generating the report.');
        }
});
        </script>
@endsection