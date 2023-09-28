<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\CompanyInfo;


class AddCompanyController extends Controller
{
    //returnare view cu detaliile companiei
    public function dashboard()
    {
        $companyInfo = CompanyInfo::whereIn('key', ['Company', 'CIF', 'Register', 'Legal_form', 'Bank', 'IBAN', 'Address', 'Locality', 'County', 'Country', 'Social', 'VAT_payer'])->get();
        return view('/account_setting', compact('companyInfo'));
    }

    //validarea si salvarea datelor introduse
    public function dashboardSave(Request $request)
    {
        Validator::make($request->all(), [
            'Company' => 'required',
            'CIF' => ['required', 'regex:/^RO\d{8}$/'],
            'Register' => ['required', 'regex:/^[JCF]\d{2}\/\d{4}\/\d{4}$/'],
            'Legal_form' => 'required|in:SRL,PFA,II,IF',
            'Bank' => 'required',
            'IBAN' => ['required', 'regex:/^RO\d{8}$/'],
            'Address' => 'required',
            'Locality' => 'required',
            'County' => 'required',
            'Country' => 'required',
            'Social' => 'required',
            'VAT_Payer' => 'required'
        ])->validate();

        $data = [
            'Company' => $request->Company,
            'CIF' => $request->CIF,
            'Register' => $request->Register,
            'Legal_form' => $request->input('Legal_form'),
            'Bank' => $request->Bank,
            'IBAN' => $request->IBAN,
            'Address' => $request->Address,
            'Locality' => $request->Locality,
            'County' => $request->County,
            'Country' => $request->Country,
            'Social' => $request->Social,
            'VAT_Payer' => $request->VAT_Payer,
        ];
        foreach ($data as $key => $value) {
            CompanyInfo::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        return redirect()->route('account_setting')->with('success', 'Company added successfully!');
    }

    //functie actualizare date company
    public function updateCompany(Request $request)
    {
        // validarea datelor de intrare, similar cu metoda dashboardSave
        $data = [
            'Company' => $request->Company,
            'CIF' => $request->CIF,
            'Register' => $request->Register,
            'Legal_form' => $request->input('Legal_form'),
            'Bank' => $request->Bank,
            'IBAN' => $request->IBAN,
            'Address' => $request->Address,
            'Locality' => $request->Locality,
            'County' => $request->County,
            'Country' => $request->Country,
            'Social' => $request->Social,
            'VAT_Payer' => $request->VAT_Payer,
        ];

        $keysToRetrieve = ['Company', 'CIF', 'Register', 'Legal_form', 'Bank', 'IBAN', 'Address', 'Locality', 'County', 'Country', 'Social', 'VAT_Payer'];

        foreach ($data as $key => $value) {
            CompanyInfo::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        return redirect()->back()->with('success', 'Company information updated successfully!');
    }

}