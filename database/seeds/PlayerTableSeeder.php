<?php

use Illuminate\Database\Seeder;
use App\Player;

class PlayerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $player = Player::create([
            'players_db_id' => 1,
            'game_id' => 7511,
            'name' => 'L. Messi',
            'img' => 'http://www.pesmaster.com/pes-2018/graphics/players/player_7511.png',
            'team_name' => 'FC BARCELONA',
            'nation_name' => 'ARGENTINA',
            'position' => 'ED',
            'height' => 170,
            'age' => 30,
            'overall_rating' => 94,
            'slug' => str_slug('L. Messi')
        ]);
    }
}