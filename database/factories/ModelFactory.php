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
        'name' => $faker->name,
        'email' => ($faker->unique()->safeEmail).(rand() % (100 + 1 - 1) + 1),
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\Models\Extra::class, function (Faker\Generator $faker) {
    return [

    ];
});

$factory->define(App\Models\Users\Citizen::class, function (Faker\Generator $faker) {

    return [
        'mobile_number' => $faker->word,
        'user_id' => function () use ($faker) {
            return factory(App\User::class)->create()->id;
        },
        'contactable' => $faker->boolean,
    ];
});
$factory->define(App\Models\Users\SocialWorker::class, function (Faker\Generator $faker) {

    return [
        'area_id' => rand() % (4 + 1 - 1) + 1,
        'user_id' => function () use ($faker) {
            return factory(App\User::class)->create()->id;
        },
        'address' => $faker->address,
        'mobile' => $faker->phoneNumber,
        'telephone' => $faker->tollFreePhoneNumber,
        'cv' => 'public/cvs/xft3LSfjZECK6riTRC3LK78c67GmYIo0Nu9liJNj.pdf',
    ];
});
