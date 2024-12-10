<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Image;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        // // Loop to create 10 books with images
        // for ($i = 1; $i <= 15; $i++) {
        //     $book = Book::create([
        //         'name' => 'Book Title ' . $i,
        //         'description' => 'Description for book ' . $i,
        //         'status' => 'published',
        //         'author' => 'Author ' . $i,
        //         'likes' => rand(0, 100),
        //     ]);

        //     // Add a cover image for the book
        //     $book->coverImage()->create([
        //         'url' => 'images/book' . $i . '_cover.jpg', // Relative path
        //         'type' => 'cover',
        //     ]);
        // }
    }
}
