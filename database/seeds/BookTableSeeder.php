<?php

use Illuminate\Database\Seeder;
use App\Book;

class BookTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('books')->delete();

        for ($i=1; $i < 10; $i++) {
        
            $faker = Faker\Factory::create();

            $book = new Book;
            $book->id = $i;
            $book->book_code = $faker->bothify('??##');
            $book->title = $faker->sentence(3);
            $book->author = $faker->name;
            $book->price_code = $faker->bothify('??##');
            $book->price = $faker->randomNumber(3);
            $book->quantity = $faker->randomNumber(2);
            $book->status = $faker->randomElement($array = array ('new','old'));
            $book->save();

        }

    }
}
