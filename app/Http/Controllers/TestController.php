<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class TestController extends Controller
{
    public function welcome(){
        $allProducts = Product::orderBy('popularity','DESC')->limit(6)->get();
        return view("welcome")->with(compact('allProducts'));
    }
}
