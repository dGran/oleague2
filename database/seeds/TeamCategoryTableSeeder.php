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
            'name' => 'Selecciones nacionales'
        ]);

        $category = TeamCategory::create([
            'name' => 'Liga española'
        ]);

        $category = TeamCategory::create([
            'name' => 'Liga italiana'
        ]);

        $category = TeamCategory::create([
            'name' => 'Liga inglesa'
        ]);
    }
}
