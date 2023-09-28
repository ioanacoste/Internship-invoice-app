<?php

use App\Http\Controllers\AddCompanyController;

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\InvoicesListController;
use App\Http\Controllers\ClientListController;

use App\Http\Controllers\Controller;
use App\Http\Controllers\EditCompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ConatactPersonController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Settings;
use App\Http\Controllers\ViewsController;
use Illuminate\Routing\ViewController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\userDashController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RegisterController;
use App\Models\Setting;
use App\Http\Controllers\Login;
use App\Http\Controllers\Contact;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|




*/

Route::get('/', [ViewsController::class, 'welcome'])->name('welcome');


Route::controller(Login::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.post');

    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.post');

    Route::get('logout', 'logout')->name('logout');
});

Route::group(['middleware' => 'auth'], function(){
    Route::get('account_setting', [AddCompanyController::class, 'dashboard'])->name('account_setting');
    Route::post('account_setting', [AddCompanyController::class, 'dashboardSave'])->name('dashboard.post');
    Route::post('/account/update', [Login::class, 'updateProfile'])->name('account.update');
    Route::post('/update-company', [AddCompanyController::class,'updateCompany'])->name('company.update');

    Route::get('invoices', [InvoicesListController::class, 'show'])->name('invoices');

    Route::put('/invoice/update-status/{invoice}', [InvoicesListController::class, 'updateStatus'])->name('update-status');
    
    
    Route::get('/invoices/{client_id}/details/{id}', [InvoiceController::class, 'showDetails'])->name('invoice-details');
    // Route::get('/invoices/export/{id}', [InvoiceController::class, 'exportInvoice'])->name('export-invoice');
    
    Route::get('/invoices/{client_id}/details/{id}/preview', [InvoiceController::class, 'showInvoices'])->name('invoice-details-preview');
    Route::get('/invoices/{client_id}/export/{id}/download', [InvoiceController::class, 'downloadInvoice'])->name('invoice-export');

    Route::get('/invoices/{client_id}/details/{id}/preview2', [InvoiceController::class, 'showInvoices2'])->name('invoice-details-preview2');
    Route::get('/invoices/{client_id}/export/{id}/download2', [InvoiceController::class, 'downloadInvoice2'])->name('invoice-export2');

    Route::get('/invoices/{client_id}/details/{id}/preview3', [InvoiceController::class, 'showInvoices3'])->name('invoice-details-preview3');
    Route::get('/invoices/{client_id}/export/{id}/download3', [InvoiceController::class, 'downloadInvoice3'])->name('invoice-export3');
    

    //Route::get('/invoices/generate-report', [InvoiceController::class, 'generatePaidInvoiceReport'])->name('reports.invoice_report');
    //Route::get('/invoices/{id}/download-report', [InvoiceController::class, 'downloadInvoiceReport'])->name('invoices.download-report');
    
    Route::get('/invoices/reports/paid', [InvoiceController::class, 'showPaidInvoicesReport'])->name('invoices-reports-paid');
    Route::get('/invoices/reports/export/', [InvoiceController::class, 'generatePaidInvoiceReport'])->name('invoices-reports-export');
    Route::get('/invoices/reports/overdue', [InvoiceController::class, 'showOverdueInvoicesReport'])->name('invoices-reports-overdue');
    Route::get('/invoices/reports/issued', [InvoiceController::class, 'showIssuedInvoicesReport'])->name('invoices-reports-issued');

    Route::get('/invoices_reports/{client_id}', [ReportController::class, 'showInvoicesClientReport'])->name('invoices_reports');
    Route::get('/invoices_reports_download/{client_id}', [ReportController::class, 'downloadInvoicesClientReport'])->name('invoices_reports_download');
   
   
    Route::get('/dashboard', [InvoiceController::class, 'showDashboardReport'])->name('dashboard-reports');
    
    Route::get('billing', [InvoiceController::class, 'billing'])->name('billing');
    Route::post('billing', [InvoiceController::class, 'billingSave'])->name('billing.post');
    Route::get('/getClientData/{clientId}', [InvoiceController::class, 'getClientData']);

    
    Route::get('clients', [ClientListController::class, 'show'])->name('clients');
    Route::get('reportsPage', [ReportController::class, 'reportsPage'])->name('reportsPage');
    Route::get('/getTotal/{client_id}', [ReportController::class, 'getTotal'])->name('get-total');
 
    Route::get('/pagina', function () {
        return view('pagina');
    })->name('pagina');
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');
    

    
    Route::get('contact', [Contact::class, 'contact'])->name('contact');
    Route::post('contact', [Contact::class, 'contact_mail_send'])->name('contact.post');
    

});





