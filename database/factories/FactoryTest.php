<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\Country::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'user_id' => rand(1,10),
        'description' => $faker->realText(rand(80, 600)),
        'slug' =>  str_replace('--', '-', strtolower(preg_replace('/[^a-zA-Z0-9]/', '-', trim($faker->sentence(5))))),
        'keywords' => $faker->word,
        'meta_description' => $faker->sentence(5),


    ];
});

$factory->define(App\State::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->realText(rand(80, 600)),
        'user_id' => rand(1,10),
        'slug' =>  str_replace('--', '-', strtolower(preg_replace('/[^a-zA-Z0-9]/', '-', trim($faker->sentence(5))))),
        'keywords' => $faker->word,
        'meta_description' => $faker->sentence(5),
        'country_id' => rand(1,50),

    ];
});


$factory->define(App\District::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->realText(rand(80, 600)),
        'user_id' => rand(1,50),
        'slug' =>  str_replace('--', '-', strtolower(preg_replace('/[^a-zA-Z0-9]/', '-', trim($faker->sentence(5))))),
        'keywords' => $faker->word,
        'meta_description' => $faker->sentence(5),
        'state_id' => rand(1,50),

    ];
});

$factory -> define(App\Category::class, function (Faker $faker){
    return[
        'name' => $faker->word,
        'description' => $faker->realText(rand(80, 600)),
        'parent_id' => rand(1,100),
        'user_id' => rand(1,50),
        'slug' =>  str_replace('--', '-', strtolower(preg_replace('/[^a-zA-Z0-9]/', '-', trim($faker->sentence(5))))),
        'keywords' => $faker->word,
        'meta_description' => $faker->sentence(5),
        'position' => rand(1,10),
        'status' => rand(1,2),
  ];

});


$factory -> define(App\Post::class, function (Faker $faker){
    return[
        'title' => $faker->word,
        'description' => $faker->realText(rand(80, 600)),
        'slug' =>  str_replace('--', '-', strtolower(preg_replace('/[^a-zA-Z0-9]/', '-', trim($faker->sentence(5))))),
        'keywords' => $faker->word,
        'user_id' => rand(1,50),
        'meta_description' => $faker->sentence(5),
        'image'  => 'https://via.placeholder.com/350x150',
        'status' => rand(1,3),
        'district_id' =>rand(1,10),
    ];
});

$factory -> define(App\Gallery::class, function (Faker $faker){
    return[
        'title' => $faker->word,
        'description' => $faker->realText(rand(80, 600)),
        'slug' =>  str_replace('--', '-', strtolower(preg_replace('/[^a-zA-Z0-9]/', '-', trim($faker->sentence(5))))),
        'keywords' => $faker->word,
        'user_id' => rand(1,10),
        'meta_description' => $faker->sentence(5),
        'cover'  => 'https://via.placeholder.com/350x150',
        'status' => rand(1,3),

    ];



});
$factory -> define(App\User::class, function (Faker $faker){
    return[
        'name' => $faker->word,
        'email' => Str::random(10).'@gmail.com',
        'password' => bcrypt('secret'),
    ];



});


