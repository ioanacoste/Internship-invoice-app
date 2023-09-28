<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Invoice;
use App\Models\User;
use App\Models\Report;
use App\Models\CompanyInfo;
use App\Models\Product;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    //returnare view reports page cu lista de clienti existenti
    public function reportsPage()
    {
        $existingClients = Client::all();
        return view('reportsPage', ['existingClients' => $existingClients]);
    }

    //functie calcul total pentru fiecare client preluat din dropdown
    public function getTotal($client_id)
    {
        $invoices_paid = Invoice::where('status', 'paid')
            ->where('client_id', $client_id)
            ->with('products')->get();
        $invoices_overdue = Invoice::where('status', 'overdue')
            ->where('client_id', $client_id)
            ->with('products')->get();
        $invoices_issued = Invoice::where('status', 'issued')
            ->where('client_id', $client_id)
            ->with('products')->get();

        $totalRONpaid = 0;
        $totalEUROpaid = 0;
        $totalRONoverdue = 0;
        $totalEUROoverdue = 0;
        $totalRONissued = 0;
        $totalEUROissued = 0;
        foreach ($invoices_paid as $invoice) {
            foreach ($invoice->products as $product) {
                if ($invoice->currency1 == 'ron') {
                    $totalRONpaid += $product->PriceWithVAT;
                }
                if ($invoice->currency1 == 'euro') {
                    $totalEUROpaid += $product->PriceWithVAT;
                }
            }
        }
        foreach ($invoices_issued as $invoice) {
            foreach ($invoice->products as $product) {
                if ($invoice->currency1 == 'ron') {
                    $totalRONissued += $product->PriceWithVAT;
                }
                if ($invoice->currency1 == 'euro') {
                    $totalEUROissued += $product->PriceWithVAT;
                }
            }
        }
        foreach ($invoices_overdue as $invoice) {
            foreach ($invoice->products as $product) {
                if ($invoice->currency1 == 'ron') {
                    $totalRONoverdue += $product->PriceWithVAT;
                }
                if ($invoice->currency1 == 'euro') {
                    $totalEUROoverdue += $product->PriceWithVAT;
                }
            }
        }

        return response()->json([
            'totalRONpaid' => $totalRONpaid,
            'totalEUROpaid' => $totalEUROpaid,
            'totalRONissued' => $totalRONissued,
            'totalEUROissued' => $totalEUROissued,
            'totalRONoverdue' => $totalRONoverdue,
            'totalEUROoverdue' => $totalEUROoverdue
        ]);

    }
    //generare raport per client 
    public function showInvoicesClientReport($client_id)
    {
        $invoices = Invoice::where('client_id', $client_id)
            ->with('clients', 'products')
            ->get();
        return view('reports.clients.invoices_reports', compact('invoices'));
    }
    //export raport per client
    public function downloadInvoicesClientReport($client_id)
    {
        $invoices = Invoice::where('client_id', $client_id)
            ->with('clients', 'products')
            ->get();

        $pdf = Pdf::loadView('reports.clients.invoices_reports', compact('invoices'));
        $todayDate = Carbon::now()->format('d-m-Y');
        return $pdf->download('invoice-report-' . $todayDate . '.pdf');
    }

}