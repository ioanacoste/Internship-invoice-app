<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\InvoiceList;
use App\Models\Invoice;
use App\Models\Client;
class InvoicesListController extends Controller
{
    public function show()
    {    $clients = Client::with('invoice.products')->get();
    return view('invoices', ['clients' => $clients]);
    }
    public function updateStatus(Request $request, Invoice $invoice)
        {
            $invoice->status = $request->input('status');
            $invoice->save();

            return redirect()->route('invoices')->with('success', 'Status updated successfully');
        }
    }

