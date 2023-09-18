<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        DB::table('Author')->insert([
            ['name' => 'Чехов А. П.'],
            ['name' => 'Шолохов М. А.'],
            ['name' => 'Бунин И. А.'],
            ['name' => 'Булгаков М. А.'],
            ['name' => 'Твардовский А. Т.'],
        ]);

        DB::table('Genre')->insert([
            ['name' => 'Роман'],
            ['name' => 'Поэма'],
            ['name' => 'Стихотворение'],
            ['name' => 'Рассказ'],
            ['name' => 'Комедия'],
        ]);

        DB::table('Book')->insert([
            ['title' => 'Вишневый сад', 'author' => '1', 'genre' => '5', 'age_rating' => '16'],
            ['title' => 'Тихий Дон', 'author' => '2', 'genre' => '1', 'age_rating' => '18'],
            ['title' => 'Тёмные аллеи', 'author' => '3', 'genre' => '4', 'age_rating' => '18'],
            ['title' => 'Мастер и Маргарита', 'author' => '4', 'genre' => '1', 'age_rating' => '16'],
            ['title' => 'Василий Тёркин', 'author' => '5', 'genre' => '3', 'age_rating' => '12'],
        ]);


        DB::table('Reader')->insert([
            ['name' => 'Новиков В. Ш.', 'phone' => '+79208348234', 'birth_date' => '1990-12-01'],
            ['name' => 'Бурый С. В.', 'phone' => '+79968398342', 'birth_date' => '2003-07-16'],
            ['name' => 'Краснов П. В.', 'phone' => '+79106483926', 'birth_date' => '2005-03-12'],
            ['name' => 'Никулин П. М.', 'phone' => '+79694738946', 'birth_date' => '1984-05-29'],
            ['name' => 'Афанасьева Д. В.', 'phone' => '+79107582396', 'birth_date' => '2009-04-03'],
        ]);

        DB::table('Library_card')->insert([
            ['reader_id' => '1', 'book_id' => '1', 'date' => '2020-12-01'],
            ['reader_id' => '2', 'book_id' => '2', 'date' => '2020-12-18'],
            ['reader_id' => '3', 'book_id' => '3', 'date' => '2021-05-11'],
            ['reader_id' => '4', 'book_id' => '4', 'date' => '2021-09-28'],
            ['reader_id' => '1', 'book_id' => '5', 'date' => '2022-03-16'],
        ]);

    }
}
