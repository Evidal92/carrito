<?php

use Faker\Generator as Faker;
use App\ProductImage;

$factory->define(ProductImage::class, function (Faker $faker) {
    return [

        'url' => 'default.png',
        'product_id' => $faker->numberBetween(1,100)
    ];
});
