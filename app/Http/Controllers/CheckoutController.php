<?php

namespace App\Http\Controllers;

use App\Payment\PagSeguro\CreditCard;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        // session()->forget('pagseguro_session_code');

        if(!auth()->check()){
            return redirect()->route('login');
        }

        $this->makePagSeguroSession();

        $cartItems = array_map(function($line){
            return $line['amount'] * $line['price'];
        }, session()->get('cart'));

        $cartItems = array_sum($cartItems);

        return view('checkout', compact('cartItems'));
    }

    public function proccess(Request $request)
    {
        $dataPost = $request->all();
        $user = auth()->user();
        $cartItems = session()->get('cart');
        $reference = 'XPTO';

        $creditCardPayment = new CreditCard($cartItems, $user, $dataPost, $reference);
        $result = $creditCardPayment->doPayment();
        
        $userOder = [
            'reference' => $reference,
            'pagseguro_code' => $result->getCode(),
            'pagseguro_status' => $result->getStatus(),
            'items' => serialize($cartItems),
            'store_id' => 41
        ];

        $user->orders()->create($userOder);

        return response()->json([
            'data' => [
                'status' => true,
                'message' => 'Pedido criado com sucesso!'
            ]
        ]);
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
