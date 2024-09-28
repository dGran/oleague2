<?php

use Illuminate\Database\Seeder;
use App\PlayerDB;
use Illuminate\Support\Str;

class PlayerDBTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $player = PlayerDB::create([
            'name' => 'PES 2020 - Sep19',
            'slug' => Str::slug('PES 2020 - Sep19')
        ]);
    }
}