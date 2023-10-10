<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CartDetail;
use App\Product;


class CartDetailController extends Controller
{
    public function store(Request $request){
        
        $current_cart_id = auth()->user()->cart->id;

        if($this->exists($request,$current_cart_id)){ 
            $error = "Lo sentimos, el producto ya se encuentra en el carrito";
            return back()->with(compact('error'));
        }
        
        $cartDetail             = new CartDetail();
        $cartDetail->cart_id    = $current_cart_id;
        $cartDetail->product_id = $request->product_id;
        $product                = Product::find($request->product_id);
        $product->popularity    = $product->popularity + 1;
        $product->save();
        
        $cartDetail->quantity   = $request->quantity;
        $cartDetail->save();

        $notification = "El producto se agregó exitosamente";
        return back()->with(compact('notification'));
    }
    
    public function destroy(Request $request){

        $cartDetail             = CartDetail::find($request->cart_detail_id);
        if($cartDetail->cart_id == auth()->user()->cart->id)
            $cartDetail->delete();

        $notification = "¡El producto se ha eliminado del carrito correctamente!.";
        return back()->with(compact('notification'));
    }

    public function getProduct(){
        return $this->belongsTo(Product::class);
    }

    private function exists($request, $current_cart_id){
        $result = CartDetail::where(function ($query) use ($request){
            $query->where('product_id', '=', $request->product_id);
        })->where(function ($query) use ($current_cart_id){
            $query->where('cart_id', '=', $current_cart_id);
        })->exists();

        if($result)
            return true;
        else
            return false;
    }

}
