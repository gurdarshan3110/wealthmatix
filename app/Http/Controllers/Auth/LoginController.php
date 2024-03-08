<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Mail\ForgotPasswordMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Store;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        if (Auth::check()) {
            
            return redirect()->intended('/dashboard');
        }
        return view('auth.login');
    }

    // Process the login form
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        $userTypes = [User::USER_SUPER_ADMIN]; 

        if (Auth::attempt($credentials) && in_array(Auth::user()->user_type, $userTypes)) {
            return redirect()->intended('/dashboard');
        } else {
            // Authentication failed
            return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
        }
    }

    // Logout the authenticated user
    public function logout()
    {
        Auth::logout();

        return redirect('/login');
    }

    public function selectStore(Request $request)
    {
        if($request->input('store_id')==null){
            $store = Store::latest()->first();
            $store = ((!empty($store))?$store->id:'');
        }else{
            $store = $request->input('store_id');
        }
        Session::put('store_id', $store);

        return response()->json(['store'=>$store,'success' => true]);
    }

    public function registration()
    {
        if(Auth::user()){
            return redirect()->intended('dashboard');
        }
        return view('auth.registration');
    }

}
