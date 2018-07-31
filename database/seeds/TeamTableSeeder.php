<?php

use Illuminate\Database\Seeder;
use App\Team;

class TeamTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $team = Team::create([
        	'team_category_id' => 1,
            'name' => 'España',
            'logo' => 'http://www.101languages.net/images/flags/128/Spain.png'
        ]);
        $team = Team::create([
            'team_category_id' => 1,
            'name' => 'Argentina',
            'logo' => 'https://www.shareicon.net/data/128x128/2016/09/01/822512_world_512x512.png'
        ]);
    }
}
