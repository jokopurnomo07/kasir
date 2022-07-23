<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('login',[
            'data' => Setting::all(),
        ]);
    }

    public function create()
    {
        //
    }

    public function Auth(Request $request)
    {
        try {
            $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
            ]);

            if (Auth::attempt($credentials)) {

                $request->session()->regenerate();

                return redirect()->intended('dashboard');
            }

            return back()->withErrors([
                'username' => 'The provided credentials do not match our records.',
            ]);
        } catch (\Throwable $th) {
            $th->getmessage();
        }
    
    }

    public function logout(Request $request){
        try {
            Auth::logout();
            $request->session()->invalidate();
            return redirect('/');
        } catch (\Throwable $th) {
            $th->getmessage();
        }
    }

}
