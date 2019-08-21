<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Company;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Company::class, function (Faker $faker) {
    return [
        'user_id'             => 1,
        'name'                => $faker->name,
        'email'               => $faker->unique()->safeEmail,
      'website'               => $faker->name,
        'logo'                 => 'Screenshot from 2019-08-14 20-38-20_1566364836.png',
    ];
});
