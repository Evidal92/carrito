<?php

use Illuminate\Database\Seeder;
use App\Product;
use App\Category;
use App\ProductImage;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {       
        $categories =  factory(Category::class, 5)->create();
        $categories->each( function($cat){

            $products = factory(Product::class, 5)->make();
            $cat->products()->saveMany($products);

            $products->each(function($prod){
                $prod->getImages()->saveMany(factory(ProductImage::class, 5)->make());
            });
        });

    }
}
