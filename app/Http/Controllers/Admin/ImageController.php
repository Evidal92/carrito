<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\ProductImage;
use File;
use Storage;

class ImageController extends Controller
{
    public function index($id_product){

        $product = Product::find($id_product);
        $images = $product->getImages()->orderBy('featured','desc')->get();
        return view('admin.products.images.index')->with(compact('product','images'));
    }

    public function store(Request $request, $id){
        $file       = $request->file('photo');
        $path       = public_path().'/images/products';
        $filename   = uniqid().$file->getClientOriginalName();
        $moved      = $file->move($path,$filename);

        if($moved){
            $productImage               = new ProductImage();
            $productImage->url          = $filename;
            $productImage->product_id   = $id;
            $productImage->save();
        }
        return back();
    }

    public function destroy(Request $request, $id){
        $image = ProductImage::find($request->image_id);
        
        if(substr($image->url, 0, 4) === "http")
            $deleted = true;
        else{
            $fullPath   = public_path().'/images/products/'.$image->url;
            $deleted    = File::delete($fullPath);
        }

        if($deleted)
            $image->delete();

        return back();
    }

    public function select($product_id, $image_id){
        ProductImage::where('product_id', $product_id)->update([
            'featured' => false
        ]);
        
        $image = ProductImage::find($image_id);
        $image->featured = true;
        $image->save();

        return back();
    }
}
