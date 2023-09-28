@extends('layoutPages')
@section('title', 'Clients')
@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
<style>
  /* .container {
    display: flex;
    justify-content: space-between;
    align-items: flex-start; 
  } */
  .table-container {
    width: 70%;
    padding: 20px;
  }
  .image-container {
    width: 30%;
    padding: 20px;
    text-align: center; 
  }
  .image-container img {
    width: 220%;
    max-height: 160%; 
  }
</style>
<div class="container">
<div class="row justify-content-center">
  <div class="table-container">
    <div class="container_1">
      
        <div class="col">
          <table class="table">
            <thead class="table-light">
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Legal form</th>
                <th scope="col">CIF</th>
                <th scope="col">Register</th>
                <th scope="col">Bank</th>
                <th scope="col">IBAN</th>
              </tr>
            </thead>
            <tbody>
              @foreach($clients as $client)
              <tr>
                <td>{{$client['id']}}</td>
                <td>{{$client['Name']}}</td>
                <td>{{$client['legal_form']}}</td>
                <td>{{$client['CIF']}}</td>
                <td>{{$client['Register']}}</td>
                <td>{{$client['Bank']}}</td>
                <td>{{$client['Account']}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
  </div>
  <div class="image-container">
    <div class="col-md-6">
      <img src="https://tse4.mm.bing.net/th?id=OIP.dZw23kPE1-6VY_YvqKD69QAAAA&pid=Api&P=0&h=180" alt="Image">
    </div>
  </div>
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
@endsection
