<?php

use Illuminate\Database\Seeder;
use App\PlayerDB;

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
            'name' => 'PES 2018 - May/18',
            'slug' => str_slug('PES 2018 - May/18')
        ]);

        $player = PlayerDB::create([
            'name' => 'PES 2019 - Sep/18',
            'slug' => str_slug('PES 2019 - Sep/18')
        ]);
    }
}