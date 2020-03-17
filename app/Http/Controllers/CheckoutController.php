<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        if(!auth()->check()){
            return redirect()->route('login');
        }

        $this->makePagSeguroSession();
        var_dump(session()->get('pagseguro_session_code'));

        return view('checkout');
    }

    public function makePagSeguroSession()
    {
        if(!session()->has('pagseguro_session_code')){
            $sessionCode = \PagSeguro\Services\Session::create(
                \PagSeguro\Configuration\Configure::getAccountCredentials()
            );

            // criando a chave na sessão
            session()->put('pagseguro_session_code', $sessionCode->getResult());
        }
    }
}
