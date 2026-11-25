<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name'     => $faker->name,
        'email'    => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'phone'    => $faker->phoneNumber,
        'role'     => App\User::ROLE_USER,
        'avatar'   => '/img/demo/av' . rand(1, 5) . '.jpg',
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\House::class, function (Faker\Generator $faker) {
    $cities  = ['深圳市', '广州市', '北京市', '上海市'];
    $city    = $faker->randomElement($cities);
    $price   = $faker->numberBetween(100, 800) * 10000;

    return [
        'title'        => $faker->streetName . ' ' . $faker->numberBetween(2, 5) . '房',
        'description'  => $faker->paragraph(3),
        'price'        => $price,
        'type'         => $faker->randomElement(['new', 'second']),
        'status'       => 'sale',
        'city'         => $city,
        'district'     => $faker->citySuffix . '区',
        'address'      => $faker->address,
        'area'         => $faker->randomFloat(1, 50, 200),
        'bedrooms'     => $faker->numberBetween(1, 5),
        'living_rooms' => $faker->numberBetween(1, 3),
        'bathrooms'    => $faker->numberBetween(1, 3),
        'floor'        => $faker->numberBetween(1, 30),
        'total_floor'  => 32,
        'orientation'  => $faker->randomElement(['南', '北', '东南', '西南', '南北']),
        'decoration'   => $faker->randomElement(['精装', '普装', '毛坯', '豪装']),
        'images'       => ['/img/demo/gallery-boxed.jpg'],
        'is_featured'  => false,
    ];
});

$factory->define(App\Agent::class, function (Faker\Generator $faker) {
    return [
        'name'        => $faker->name,
        'phone'       => $faker->phoneNumber,
        'email'       => $faker->safeEmail,
        'agency'      => $faker->company,
        'license_no'  => 'AG' . date('Y') . str_pad($faker->numberBetween(1, 999), 4, '0', STR_PAD_LEFT),
        'avatar'      => '/img/demo/av' . $faker->numberBetween(1, 5) . '.jpg',
        'description' => $faker->paragraph(2),
        'rating'      => $faker->randomFloat(1, 3.5, 5.0),
    ];
});
