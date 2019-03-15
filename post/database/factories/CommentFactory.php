<?php

    $factory->define(App\Comment::class, function (Faker\Generator $faker) {
        return [
            'post_id' => factory('App\Post')->create()->id,
            'user_id' => factory('App\User')->create()->id,
            'body' => $faker->text(50)
        ];
    });
