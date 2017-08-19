<?php

use Illuminate\Database\Seeder;

class ChaptersTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $books = \CodeEduBook\Models\Book::all();
        foreach ($books as $book) {
            factory(\CodeEduBook\Models\Chapter::class, 5)->create()->each(function ($chapter) use ($book) {
                $chapter->book_id = $book->id;
                $chapter->save();
            });
        }
    }
}