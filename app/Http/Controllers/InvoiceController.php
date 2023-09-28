<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Invoice;
use App\Models\User;
use App\Models\CompanyInfo;
use App\Models\Product;
use App\Models\Client;
use App\Models\Bnr;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class InvoiceController extends Controller
{
    public function billing()
    {
        $existingClients = Client::all();
        return view('/billing', ['existingClients' => $existingClients]);
    }
    //functie preluare date clienti din baza de date
    public function getClientData($client_id)
    {
        $client = Client::find($client_id);

        return response()->json([
            'legal_form' => $client->legal_form,
            'Name' => $client->Name,
            'CIF' => $client->CIF,
            'Register' => $client->Register,
            'Bank' => $client->Bank,
            'Account' => $client->Account
        ]);
    }
    //validare campuri+salvare in functie de existenta clientului 
    public function billingSave(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'legal_form' => 'required|in:SRL,PFA,II,IF',
            'Name' => 'required',
            'CIF' => ['required', 'regex:/^RO\d{8}$/'],
            'Register' => ['required', 'regex:/^[JCF]\d{2}\/\d{4}\/\d{4}$/'],
            'Bank' => 'required',
            'Account' => ['required', 'regex:/^[A-Z]{2}\d{8}$/'],
            'DateOfIssue' => 'required|date_format:d-m-Y',
            'Term' => 'required|date_format:d-m-Y',
            'SeriesNumber' => 'required',
            'currency1' => 'required',
            'Made' => 'required',
            'ID_made' => 'required',
            'email_made' => 'required',
            'phone' => ['required', 'regex:/^\d{10}$/'],
            'Delegate' => 'required',
            'ID_delegate' => 'required',
            'email_delegate' => 'required',
            'phone_delegate' => ['required', 'regex:/^\d{10}$/'],
            'DeliveryDate' => 'required',
            'method' => 'required'
        ])->validate();
        $existingClient = Client::where('Name', $request->input('Name'))->first();
        if ($existingClient) {
            $Invoice = new Invoice();
            $Invoice->client_id = $existingClient->id;
            $Invoice->DateOfIssue = $request->DateOfIssue ? date('Y-m-d', strtotime($request->DateOfIssue)) : date('Y-m-d');
            $Invoice->Term = $request->Term ? date('Y-m-d', strtotime($request->Term)) : date('Y-m-d', strtotime('+30 days'));
            $Invoice->SeriesNumber = $request->SeriesNumber;
            $Invoice->lang = $request->lang;
            $Invoice->currency1 = $request->currency1;
            $Invoice->Made = $request->Made;
            $Invoice->ID_made = $request->ID_made;
            $Invoice->email_made = $request->email_made;
            $Invoice->phone = $request->phone;
            $Invoice->Delegate = $request->Delegate;
            $Invoice->ID_delegate = $request->ID_delegate;
            $Invoice->email_delegate = $request->email_delegate;
            $Invoice->phone_delegate = $request->phone_delegate;
            $Invoice->NoNotice = $request->NoNotice;
            $Invoice->Mentions = $request->Mentions;
            $Invoice->DeliveryDate = $request->DeliveryDate ? date('Y-m-d', strtotime($request->DeliveryDate)) : null;
            $Invoice->DateOfCollection = $request->DateOfCollection ? date('Y-m-d', strtotime($request->DateOfCollection)) : null;
            $Invoice->method = $request->method;
            $status = $request->input('status');
            $Invoice->status = $status ?: 'draft';

            $existingClient->invoice()->save($Invoice);
            //$Invoice->save();
            $productsJson = $request->input('products');
            $products = json_decode($productsJson);


            foreach ($products as $productData) {
                $Product = new Product();
                $Product->invoice_id = $Invoice->id; // Asocierea cu factura
                $Product->ProductService = $productData->name;
                $Product->Unit = $productData->unit;
                $Product->Quantity = $productData->quantity;
                $Product->VATrate = $productData->vatRate;
                $Product->UnitPrice = $productData->unitPrice;
                $Product->PriceWithoutVAT = $productData->priceWithoutVAT;
                $Product->PriceWithVAT = $productData->priceWithVAT;

                $Invoice->products()->save($Product);
            }

        } else {

            $Client = new Client();
            $Client->legal_form = $request->legal_form;
            $Client->Name = $request->Name;
            $Client->CIF = $request->CIF;
            $Client->Register = $request->Register;
            $Client->Bank = $request->Bank;
            $Client->Account = $request->Account;
            $Client->save();

            $Invoice = new Invoice();
            $Invoice->client_id = $Client->id;
            $Invoice->DateOfIssue = $request->DateOfIssue ? date('Y-m-d', strtotime($request->DateOfIssue)) : date('Y-m-d');
            $Invoice->Term = $request->Term ? date('Y-m-d', strtotime($request->Term)) : date('Y-m-d', strtotime('+30 days'));
            $Invoice->SeriesNumber = $request->SeriesNumber;
            $Invoice->lang = $request->lang;
            $Invoice->currency1 = $request->currency1;
            $Invoice->Made = $request->Made;
            $Invoice->ID_made = $request->ID_made;
            $Invoice->email_made = $request->email_made;
            $Invoice->phone = $request->phone;
            $Invoice->Delegate = $request->Delegate;
            $Invoice->ID_delegate = $request->ID_delegate;
            $Invoice->email_delegate = $request->email_delegate;
            $Invoice->phone_delegate = $request->phone_delegate;
            $Invoice->NoNotice = $request->NoNotice;
            $Invoice->Mentions = $request->Mentions;
            $Invoice->DeliveryDate = $request->DeliveryDate ? date('Y-m-d', strtotime($request->DeliveryDate)) : null;
            $Invoice->DateOfCollection = $request->DateOfCollection ? date('Y-m-d', strtotime($request->DateOfCollection)) : null;
            $Invoice->method = $request->method;
            $status = $request->input('status');
            $Invoice->status = $status ?: 'draft';


            $Client->invoice()->save($Invoice);
            $productsJson = $request->input('products');
            $products = json_decode($productsJson);


            foreach ($products as $productData) {
                $Product = new Product();
                $Product->invoice_id = $Invoice->id; // Asocierea cu factura
                $Product->ProductService = $productData->name;
                $Product->Unit = $productData->unit;
                $Product->Quantity = $productData->quantity;
                $Product->VATrate = $productData->vatRate;
                $Product->UnitPrice = $productData->unitPrice;
                $Product->PriceWithoutVAT = $productData->priceWithoutVAT;
                $Product->PriceWithVAT = $productData->priceWithVAT;

                $Invoice->products()->save($Product);

            }

        }
        return redirect()->route('invoices');

    }

    //ruta butonului View Details de la ficare factura si preluarea inf necesare din baza de date
    public function showDetails($client_id, $id)
    {
        $clients = Client::find($client_id);
        $invoices = Invoice::find($id);
        $user = User::find($id);

        $keysToRetrieve = ['Company', 'CIF', 'Register', 'Legal_form', 'Bank', 'IBAN', 'Made', 'ID_made', 'email_made', 'phone', 'Delegate', 'ID_delegate', 'email_delegate', 'phone_delegate', 'Mentions'];
        $companyInfo = CompanyInfo::whereIn('key', $keysToRetrieve)->get();
        return view('invoice.details', compact('clients', 'invoices', 'companyInfo'));
    }


    //functii previzualizare facturi cu cele 3 design uri
    public function showInvoices($client_id, $id)
    {

        $clients = Client::find($client_id);
        $invoices = Invoice::find($id); // Presupunând că folosești modelul "Invoice" pentru facturi
        $user = User::find($id);
        $keysToRetrieve = ['Company', 'CIF', 'Register', 'Legal_form', 'Bank', 'IBAN', 'Made', 'ID_made', 'email_made', 'phone', 'Delegate', 'ID_delegate', 'email_delegate', 'phone_delegate', 'Mentions'];
        $companyInfo = CompanyInfo::whereIn('key', $keysToRetrieve)->get();
        return view('invoice.generate.generate-invoice', compact('clients', 'invoices', 'companyInfo'));
    }

    public function showInvoices2($client_id, $id)
    {
        $clients = Client::find($client_id);
        $invoices = Invoice::find($id); // Presupunând că folosești modelul "Invoice" pentru facturi
        $user = User::find($id);
        $keysToRetrieve = ['Company', 'CIF', 'Register', 'Legal_form', 'Bank', 'IBAN', 'Made', 'ID_made', 'email_made', 'phone', 'Delegate', 'ID_delegate', 'email_delegate', 'phone_delegate', 'Mentions'];
        $companyInfo = CompanyInfo::whereIn('key', $keysToRetrieve)->get();
        return view('invoice.generate.design2Patri', compact('clients', 'invoices', 'companyInfo'));
    }
    public function showInvoices3($client_id, $id)
    {
        $clients = Client::find($client_id);
        $invoices = Invoice::find($id); // Presupunând că folosești modelul "Invoice" pentru facturi
        $user = User::find($id);
        $keysToRetrieve = ['Company', 'CIF', 'Register', 'Legal_form', 'Bank', 'IBAN', 'Made', 'ID_made', 'email_made', 'phone', 'Delegate', 'ID_delegate', 'email_delegate', 'phone_delegate', 'Mentions'];
        $companyInfo = CompanyInfo::whereIn('key', $keysToRetrieve)->get();
        return view('invoice.generate.design3', compact('clients', 'invoices', 'companyInfo'));
    }

    //functii download pdf pentru cele 3 design uri
    public function downloadInvoice($client_id, $id)
    {
        $clients = Client::find($client_id);
        $invoices = Invoice::find($id);
        $data = ['invoice' => $invoices];
        $user = User::find($id);
        $keysToRetrieve = ['Company', 'CIF', 'Register', 'Legal_form', 'Bank', 'IBAN', 'Made', 'ID_made', 'email_made', 'phone', 'Delegate', 'ID_delegate', 'email_delegate', 'phone_delegate', 'Mentions'];
        $companyInfo = CompanyInfo::whereIn('key', $keysToRetrieve)->get();
        $pdf = Pdf::loadView('invoice.generate.generate-invoice', compact('clients', 'invoices', 'companyInfo'));
        $todayDate = Carbon::now()->format('d-m-Y');
        return $pdf->download('invoice' . $invoices->id . '-' . $todayDate . '.pdf');
    }


    public function downloadInvoice2($client_id, $id)
    {
        $clients = Client::find($client_id);
        $invoices = Invoice::find($id);
        $data = ['invoice' => $invoices];
        $user = User::find($id);
        $keysToRetrieve = ['Company', 'CIF', 'Register', 'Legal_form', 'Bank', 'IBAN', 'Made', 'ID_made', 'email_made', 'phone', 'Delegate', 'ID_delegate', 'email_delegate', 'phone_delegate', 'Mentions'];
        $companyInfo = CompanyInfo::whereIn('key', $keysToRetrieve)->get();
        $pdf = Pdf::loadView('invoice.generate.design2Patri', compact('clients', 'invoices', 'companyInfo'));
        $todayDate = Carbon::now()->format('d-m-Y');
        return $pdf->download('invoice' . $invoices->id . '-' . $todayDate . '.pdf');
    }
    public function downloadInvoice3($client_id, $id)
    {
        $clients = Client::find($client_id);
        $invoices = Invoice::find($id);
        $data = ['invoice' => $invoices];
        $user = User::find($id);
        $keysToRetrieve = ['Company', 'CIF', 'Register', 'Legal_form', 'Bank', 'IBAN', 'Made', 'ID_made', 'email_made', 'phone', 'Delegate', 'ID_delegate', 'email_delegate', 'phone_delegate', 'Mentions'];
        $companyInfo = CompanyInfo::whereIn('key', $keysToRetrieve)->get();
        $pdf = Pdf::loadView('invoice.generate.design3', compact('clients', 'invoices', 'companyInfo'));
        $todayDate = Carbon::now()->format('d-m-Y');
        return $pdf->download('invoice' . $invoices->id . '-' . $todayDate . '.pdf');
    }

    //functie pentru afisarea tuturor facturilor platite + generare pdf 
    public function showPaidInvoicesReport()
    {
        $paidInvoices = Invoice::where('status', 'paid')
            ->with('clients', 'products')
            ->get();

        return view('reports.paid_invoices_report', compact('paidInvoices'));
    }
    public function generatePaidInvoiceReport()
    {
        $paidInvoices = Invoice::where('status', 'paid')
            ->with('clients', 'products')
            ->get();
        $pdf = Pdf::loadView('reports.paid_invoices_report', compact('paidInvoices'));
        $todayDate = Carbon::now()->format('d-m-Y');
        return $pdf->download('report_paid.pdf');
    }

    public function showOverdueInvoicesReport()
    {
        $overdueInvoices = Invoice::where('status', 'overdue')
            ->with('clients', 'products')
            ->get();

        return view('reports.overdue_invoices_report', compact('overdueInvoices'));
    }
    public function showIssuedInvoicesReport()
    {
        $issuedInvoices = Invoice::where('status', 'issued')
            ->with('clients', 'products')
            ->get();

        return view('reports.issued_invoices_report', compact('issuedInvoices'));
    }

    //rapoarte html pagina dashboard
    public function showDashboardReport()
    {

        $paidInvoices = Invoice::where('status', 'paid')
            ->with('clients', 'products')
            ->get();

        $overdueInvoices = Invoice::where('status', 'overdue')
            ->with('clients', 'products')
            ->get();

        $issuedInvoices = Invoice::where('status', 'issued')
            ->with('clients', 'products')
            ->get();


        return view('dashboard', compact('paidInvoices', 'overdueInvoices', 'issuedInvoices'));
    }


}