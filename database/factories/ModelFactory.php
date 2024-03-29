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
    return [
        'name' => $faker->name,
        'email' => $faker->email,
    ];
});
$factory->define(App\Http\Models\Message::class, function ($faker) {
    return [
        "type"=> "html",
        "body"=> $faker->text,
        "recipients"=> $faker->email,
        "subject"=> $faker->text,
        "status"=> "3",
        "sender"=> $faker->email,
    ];
});
$factory->define(App\Http\Models\ProviderAccount::class, function ($faker) {
    return [
        "status"=> 1,
        "priority"=> 2,
        "type"=> "Mailjet",
        "username"=> $faker->name,
        "password"=> $faker->name,
    ];
});

$factory->define(App\Http\Models\Log::class, function ($faker) {
    return [
        "sender"=>$faker->email,
        "recipients"=>$faker->email,
        "rawResponse"=>"",
        "provider"=>2,
        "message"=> $faker->text,
        "status"=>0,
    ];
});

