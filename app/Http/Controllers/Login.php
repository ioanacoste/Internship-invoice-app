<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CompanyInfo;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Login extends Controller
{
    public function register()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard-reports');
        }
        return view('/register');
    }
    public function registerSave(Request $request)
    {
        Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|confirmed'
            ]
        )->validate();

        $User = new User();
        $User->name = $request->name;
        $User->email = $request->email;
        $User->password = Hash::make($request->password);
        $User->save();

        return redirect()->route('login');
    }
    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard-reports');
        }
        return view('/login');
    }
    public function loginAction(Request $request)
    {
        Validator::make(
            $request->all(),
            [
                'email' => 'required|email',
                'password' => 'required'
            ]
        )->validate();
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            if (CompanyInfo::where('key', 'Company')->exists())
                return redirect()->route('dashboard-reports');
            else
                return redirect()->route('account_setting');
        } else
            return redirect()->route('login')->with('warning', "Account with the email address '{$request->email}' does not exist.");

    }
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'current_password' => 'nullable',
            'new_password' => 'nullable|min:8|confirmed',
        ]);

        if ($request->has('current_password') && !Hash::check($request->input('current_password'), $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->has('new_password') ? Hash::make($request->input('new_password')) : $user->password,
        ]);

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
    function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('login');


    }
}