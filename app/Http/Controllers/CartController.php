<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart') ?? [];
        return view('cart', compact('cart'));
    }

    public function add(Request $request)
    {
        $product =$request->get('product');

        if(session()->has('cart')){
            session()->push('cart', $product);
        }else{
            $products = $product;
            session()->push('cart', $products);
        }

        flash('Produto Adicionado no carrinho')->success();
        return redirect()->route('product.single', ['slug' => $product['slug']]);
    }

    public function remove($slug)
    {
        if(!session()->has('cart')) {
            return redirect()->route('cart.index');
        }

        $products = session()->get('cart');

        // filtrando todos os produtos que não seja igual ao slug passado na url
        $products = array_filter($products, function ($line) use($slug){
            return $line['slug'] != $slug;
        });

        // sobrescrevendo a sessao cart com os novos produtos
        session()->put('cart', $products);
        return redirect()->route('cart.index');
    }
}
