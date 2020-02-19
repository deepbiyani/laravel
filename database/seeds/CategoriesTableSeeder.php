<?php

use Illuminate\Database\Seeder;
use App\Models\ModelsCategory;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        ModelsCategory::create([
            'name'          =>  'Root',
            'description'   =>  'This is the root category, don\'t delete this one',
            'parent_id'     =>  null,
        ]);

        factory('App\Models\ModelsCategory', 10)->create();
    }
}
