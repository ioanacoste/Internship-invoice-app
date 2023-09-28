<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\ClientList;
use App\Models\Invoice;

class ClientListController extends Controller
{
    public function show()
    {
        $data = ClientList::all();
        return view('clients',['clients'=>$data]);
    }
}
