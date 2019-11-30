<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
       "post"=> "post is nothing post is nothingpost is nothingpost is nothingpost is nothingpost is nothing",
       "the_user"=>"10"
    ];
});
