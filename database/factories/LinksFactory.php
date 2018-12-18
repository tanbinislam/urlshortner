<?php

use Faker\Generator as Faker;

$factory->define(App\Links::class, function (Faker $faker) {
    return [
        'user_id'       => null,
        'main_url'      => 'www.facebook.com',
        'shortened_url' => uniqid(),
        'unauthed'      => '1',
    ];
});
