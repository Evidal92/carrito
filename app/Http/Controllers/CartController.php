<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;

class CartController extends Controller
{
    public function update(Request $req){
        $currentCart                = auth()->user()->cart;
        
        $total = 0;
        foreach (auth()->user()->cart->details as $detail)
          $total= $total + $detail->product->price * $detail->quantity;
        
        $currentCart->code          = $this->generateCode(8);
        $currentCart->total         = $total;
        $currentCart->order_date    = date('d-m-Y');
        $currentCart->status        = "Pendiente";
        $currentCart->save();

        $notification= "Tu pedido se ha registrado correctamente. Te contactaremos via email a la brevedad...";
        return back()->with(compact('notification'));
    }

    public function updateStatus(Request $req){

        $order = auth()->user()->orderDetails;
        
        $order->status = $req->status;

        if($req->status == "Finalizado")
            $order->arrived_date = date('d-m-Y');
        $order->save();  
        
        $notification           = "¡El status del producto ha cambiado!";
        return back()->with(compact('notification'));
    }

    public function destroy(Request $req){
        $order = auth()->user()->orderDetails;
 
        #if($cartDetail->cart_id == auth()->user()->cart->id)
        $order->delete();

        $notification = "¡El pedido seleccionado se ha eliminado correctamente!.";
        return back()->with(compact('notification'));
    }

    private function generateCode($len){
        $caracteres = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        $cadena = "";
        for($i=0;$i<$len;$i++)
            $cadena .= substr($caracteres,rand(0,strlen($caracteres)),1);
        return $cadena;
    }
}
