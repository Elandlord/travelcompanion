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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name(),
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Route::class, function (Faker\Generator $faker) {
   return [
       'user_id' => 1,
       'departure_date' => $faker->date(),
       'return_date' => $faker->date(),
       'name' => $faker->name() . " Route",
   ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Hotel::class, function (Faker\Generator $faker) {
    return [
        'location_id' => 1,
        'description' => $faker->text(),
        'name' => $faker->name()." Hotel",
        'road_name' => $faker->streetName(),
        'house_number' => $faker->numberBetween(1, 300),
        'phone_number' => $faker->phoneNumber(),
        'email_address' => $faker->safeEmail(),
        'zip_code' => $faker->postcode(),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Location::class, function (Faker\Generator $faker) {
    return [
        'id' => 1,
        'name' => $faker->streetName(),
        'country' => $faker->country(),
    ];
});
