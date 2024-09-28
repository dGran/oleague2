<?php

use Illuminate\Database\Seeder;
use App\TeamCategory;
use App\Team;
use Illuminate\Support\Str;

class TeamTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = TeamCategory::create([
            'name' => 'Packs',
            'slug' => Str::slug('Packs')
        ]);

        foreach (range(1,32) as $index) {
        	if ($index < 10) {
        		$pack_num = '0' . $index;
        	} else {
        		$pack_num = $index;
        	}
            $pack = Team::create([
                'team_category_id' => 1,
                'name' => 'Pack' . $pack_num,
                'logo' => 'img/teams/packs.png'
            ]);
        }
    }
}