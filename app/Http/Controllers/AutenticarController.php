<?php

namespace App\Http\Controllers;

use App\Http\Requests\AutenticarRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AutenticarController extends Controller
{
    public function login()
    {
        if( Auth::check() )
            return redirect()->route('escritorio.index');

        return view('autenticar.login');
    }

    public function attempt(AutenticarRequest $request)
    {
        $credenciales = $request->only(['name', 'password']);

        if(! Auth::attempt( $credenciales ) )
            return redirect()->route('autenticar.login')->withInput()->withErrors(['failed']);

        return redirect()->route('escritorio.index');
    }

    public function logout(Request $request)
    {
        Auth::logout(); 
        
        // Session::flush();
        
        $request->session()->invalidate();
        
        $request->session()->regenerateToken();
     
        return redirect()->route('autenticar.login');
    }
}
