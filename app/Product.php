<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category(){ 
        return $this->belongsTo(Category::class);
    }

    public function getImages(){
        return $this->hasMany(ProductImage::class);
    }

    public function getFeaturedImageUrlAttribute(){
        $featuredImage = $this->getImages()->where('featured', true)->first();
         
        if(!$featuredImage)
            $featuredImage = $this->getImages()->first();
    
        if($featuredImage)
            return $featuredImage->url;

        return '/images/products/default.png';
    }

    public function getCategoryNameAttribute(){
        if($this->category)
            return $this->category->name;
        return 'General';
    }

}
