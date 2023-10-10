<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use File;

class CategoryController extends Controller
{
    public function index(){
        $allCategories= Category::orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.categories.index')->with(compact('allCategories'));
    }

    public function create(){
        return view('admin.categories.create');
    }

    public function store(Request $request){
        $this->validate($request, Category::$rules, Category::$messages);
        $category = Category::create($request->only('name','description'));
        
        if($request->hasFile('image')){
            $file       = $request->file('image');
            $path       = public_path().'/images/categories';
            $filename   = uniqid().$file->getClientOriginalName();
            $moved      = $file->move($path,$filename);

            if($moved){
                $category->image = $filename;
                $category->save();
            }
        }
        return redirect('/admin/categories');
    }

    public function edit(Category $category){
        return view('admin.categories.edit')->with(compact('category'));
    }

    public function update(Request $request, Category $category){
        $this->validate($request, Category::$rules, Category::$messages);
        $category->update($request->only('name','description'));
        
        if($request->hasFile('image')){
            //dd("entra");
            $file       = $request->file('image');
            $path       = public_path().'/images/categories';
            $filename   = uniqid().$file->getClientOriginalName();
            $moved      = $file->move($path,$filename);

            if($moved){
                $previousPath = public_path().'/images/categories/'.$category->image;
                $category->image = $filename;
                $saved = $category->save();

                if($saved)
                    File::delete($previousPath);
            }
        }
        return redirect('/admin/categories');
    }

    public function destroy(Category $category){
        $category->delete();
        return redirect('/admin/categories');
    }
}
