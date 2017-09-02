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

$factory->define(\CodeEduUser\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'verified' => true,
    ];
});

$factory->state(\CodeEduUser\Models\User::class, 'author', function (Faker\Generator $faker) {
    return [
        'email' => 'author@editora.com',
    ];
});

$factory->define(\CodeEduBook\Models\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => ucfirst($faker->unique()->word),
    ];
});

$factory->define(\CodeEduBook\Models\Book::class, function (Faker\Generator $faker) {

    $repository = app(\CodeEduUser\Repositories\UserRepositoryEloquent::class);
    /** @var \Illuminate\Database\Eloquent\Collection $users */
    $authorId = $repository->all()->random()->id;

    return [
        'author_id' => $authorId,
        'title' => ucfirst($faker->title),
        'subtitle' => ucfirst($faker->jobTitle),
        'price' => $faker->randomFloat(2, 1, 100),
        'dedication' => $faker->sentence,
        'description' => $faker->paragraph,
        'website' => $faker->url,
        'percent_complete' => rand(0, 100),
    ];
});

$factory->define(\CodeEduBook\Models\Chapter::class, function (Faker\Generator $faker) {
    return [
        'name' => ucfirst($faker->sentence(2)),
        'content' => $faker->paragraph(10),
    ];
});
