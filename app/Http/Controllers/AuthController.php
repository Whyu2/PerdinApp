<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials =$request -> validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->role == 'admin') {
                return redirect()->intended('/admin');
            }
            if ($user->role == 'pegawai') {
                return redirect()->intended('/pegawai');
            }
            if ($user->role == 'sdm') {
                return redirect()->intended('/sdm');
            }
        }
        
    return back()->with('loginError','Username & Password Tidak Sesuai!');
    }
    
    public function logout(){
        Auth::logout();
 
        request()->session()->invalidate();
    
        request()->session()->regenerateToken();
    
        return redirect('/');
    }
}
