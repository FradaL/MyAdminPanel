<?php

namespace Modules\Users\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Alert;


class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        if(Auth::check()){
            return redirect('/dashboard');
        }
        return view('users::login.login');
    }

    /*
     * Authenticate Manual User
     */
    public function authenticate(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            Alert::message("Bienvenido," .  Auth::user()->username)->autoclose(1000);;
            return redirect()->intended('dashboard');
        }
        else{
            return redirect()->back()->with('Message', 'Datos Incorrectos, Verifique porfavor.');
        }
    }

    /*
     * Logout Manual User
     */
    public function logout()
    {
        Auth::logout();
        Alert::message("Vuelva Pronto, Su Session se ha Cerrado")->autoclose(1000);;
        return redirect('/');
    }

}
