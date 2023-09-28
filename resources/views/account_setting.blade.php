
@extends('layoutPages')
@section('title', 'Settings')
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
<p></p>
<div class="row">
    <div class="col-md-6 mb-3">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title text-center">User</h5>
          <h6 class="form-label text-center">Please complete all fields</h6>
          <form action="{{ route('account.update') }}" method="POST" class="ms-auto me-auto mt-3" style="max-width: 500px;">
    @csrf
    
    <div class="mb-3">
    
    <p></p>
      <label class="form-label">Full-name</label>
      <input type="text" class="form-control" name="name" value="{{auth()->user()->name}}">
    </div>
    <div class="mb-3">
      <label class="form-label">Email address</label>
      <input type="email" class="form-control" name="email" value="{{auth()->user()->email}}">
    </div>
    <div class="mb-3">
  <label class="form-label">Current Password</label>
  <input type="password" class="form-control" name="current_password">
</div>
<div class="mb-3">
  <label class="form-label">New Password</label>
  <input type="password" class="form-control" name="new_password">
</div>
<div class="mb-3">
  <label class="form-label">Confirm New Password</label>
  <input type="password" class="form-control" name="new_password_confirmation">
</div>
<button type="submit" class="btn btn-primary">Update Profile</button>
  </form>
        </div>
      </div>
    </div>
    
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title text-center">Company</h5>
          <p></p>
          <p></p>
          <form action="{{route('dashboard.post')}}" method="POST" class=" needs-validation " novalidate>
            @csrf 
            <div class="container_1">
              <div class="row justify-content-center"> 
                <div class="col-md-6">
                  <div class="form-group">
                    <h3 class="small">Company's Name</h3>
                    <input type="text" class="form-control" placeholder="Fill in here" name="Company" value="{{ $companyInfo->where('key', 'Company')->first()->value ?? '' }}" required>
                  </div>
                </div>
              </div>
            </div>
            <p></p>
            <div class="container_1">
              <div class="row justify-content-center"> 
                <div class="col-md-4">
                  <div class="form-group">
                    <h3 class="small">CIF</h3>
                    <input type="text" class="form-control" placeholder="RO########"
                    name="CIF" pattern="RO\d{8}" title="Enter a valid CIF starting with RO and followed by 8 digits." value="{{ $companyInfo->where('key', 'CIF')->first()->value ?? '' }}" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <h3 class="small">Trade Reg</h3>
                    <input type="text" class="form-control" placeholder="J/C/F##/####/####" name="Register" pattern="[JCF]\d{2}\/\d{4}\/\d{4}" title="Enter a valid TradeReg starting with J, C or F followed by 11 digits." value="{{ $companyInfo->where('key', 'Register')->first()->value ?? '' }}" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                  <h3 class="small" for="legal_form">Legal Form:</h3>
                <select class="form-control" id="legal_form" name="Legal form">
                
                <option value="" disabled selected>Choose the legal form</option>
                    <option value="SRL" {{ optional($companyInfo->where('key', 'Legal_form')->first())->value === 'SRL' ? 'selected' : '' }}>SRL</option>
                    <option value="PFA" {{ optional($companyInfo->where('key', 'Legal_form')->first())->value === 'PFA' ? 'selected' : '' }}>PFA</option>
                    <option value="II" {{ optional($companyInfo->where('key', 'Legal_form')->first())->value === 'II' ? 'selected' : '' }}>II</option>
                    <option value="IF" {{ optional($companyInfo->where('key', 'Legal_form')->first())->value === 'IF' ? 'selected' : '' }}>IF</option>
                </select>
                  </div>
                </div>
              </div>
            </div>
            <p></p>
            <div class="container_1">
              <div class="row justify-content-center"> 
                <div class="col-md-5">
                  <div class="form-group">
                    <h3 class="small">Bank</h3>
                    <input type="text" class="form-control" placeholder="Fill in here" name="Bank" value="{{ $companyInfo->where('key', 'Bank')->first()->value ?? '' }}" required>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <h3 class="small">IBAN</h3>
                    <input type="text" class="form-control" placeholder="Fill in here" name="IBAN" value="{{ $companyInfo->where('key', 'IBAN')->first()->value ?? '' }}" required>
                  </div>
                </div>
              </div>
            </div>
            <p></p>
            <div class="container_1">
              <div class="row justify-content-center"> 
                <div class="col-md-5">
                  <div class="form-group">
                    <h3 class="small">Address</h3>
                    <input type="text" class="form-control" placeholder="Fill in here" name="Address" value="{{ $companyInfo->where('key', 'Address')->first()->value ?? '' }}" required>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <h3 class="small">Locality</h3>
                    <input type="text" class="form-control" placeholder="Fill in here" name="Locality" value="{{ $companyInfo->where('key', 'Locality')->first()->value ?? '' }}" required>
                  </div>
                </div>
              </div>
            </div>
            <p></p>
            <div class="container_1">
              <div class="row justify-content-center"> 
                <div class="col-md-5">
                  <div class="form-group">
                    <h3 class="small">County</h3>
                    <input type="text" class="form-control" placeholder="Fill in here" name="County" value="{{ $companyInfo->where('key', 'County')->first()->value ?? '' }}" required>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <h3 class="small">Country</h3>
                    <input type="text" class="form-control" placeholder="Fill in here" name="Country" value="{{ $companyInfo->where('key', 'Country')->first()->value ?? '' }}" required>
                  </div>
                </div>
              </div>
            </div>

            <p></p>
            <div class="container_1">
              <div class="row justify-content-center"> 
                <div class="col-md-5">
                  <div class="form-group">
                    <h3 class="small">Social Capital</h3>
                    <input type="text" class="form-control" placeholder="Fill in here" name="Social"
                    value="{{ $companyInfo->where('key', 'Social')->first()->value ?? '' }}" required>
                  </div>
                </div>
                <div class="col-md-5">
                        <div class="form-group">
                            <h3 class="small">VAT payer?</h3>
                            <select class="form-control" name="VAT_Payer">
                            <option value="Yes" {{ optional($companyInfo->where('key', 'VAT_Payer')->first())->value === 'Yes' ? 'selected' : '' }}>Yes</option>
            <option value="No" {{ optional($companyInfo->where('key', 'VAT_Payer')->first())->value === 'No' ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                    </div>
              </div>
              <p></p>
            </div>
            <div class="container_1">
              <div class="row justify-content-center"> 
                <div class="col-md-3">
                  <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-block mb-4">Add or update company</button>
                  
                  </div>
                </div>
              </div>
            </div>
</form>
        </div>
      </div>
    </div>

</div>
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
@endsection