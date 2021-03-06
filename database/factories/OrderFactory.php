<?php

use App\Models\Order;

$factory->define(Order::class, function () {
    return [
        'ip' => rand(1, 255) . '.0.0.1',
        'phone' => '38063' . rand(1, 9) . rand(1, 9) . '91212',
        'name' => string_random(7),
        'user_id' => null,
        'total' => rand(80, 1700),
    ];
});

$factory->state(Order::class, 'taken', function () {
    return [
        'user_id' => 1,
    ];
});
