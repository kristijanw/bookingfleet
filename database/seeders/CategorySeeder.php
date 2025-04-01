<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'title' => 'View all',
                'order_column' => 1,
            ],
            [
                'title' => 'Boat excursion',
                'order_column' => 1,
            ],
            [
                'title' => 'Private yacht tours',
                'order_column' => 1,
            ],
            [
                'title' => 'Rent a boat',
                'order_column' => 1,
            ],
            [
                'title' => 'Rent a kayak',
                'order_column' => 1,
            ],
            [
                'title' => 'Adventures',
                'order_column' => 1,
            ],
            [
                'title' => 'Other',
                'order_column' => 1,
            ],
        ]);
    }
}
