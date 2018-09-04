<?php

use Illuminate\Database\Seeder;
use App\TeamCategory;

class TeamCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = TeamCategory::create([
            'name' => 'Selecciones nacionales',
            'slug' => str_slug('Selecciones nacionales')
        ]);

        $category = TeamCategory::create([
            'name' => 'LaLiga',
            'slug' => str_slug('LaLiga')
        ]);

        $category = TeamCategory::create([
            'name' => 'Serie A TIM',
            'slug' => str_slug('Serie A TIM')
        ]);

        $category = TeamCategory::create([
            'name' => 'Premier League',
            'slug' => str_slug('Premier League')
        ]);

        $category = TeamCategory::create([
            'name' => 'Bundesliga',
            'slug' => str_slug('Bundesliga')
        ]);
    }
}
