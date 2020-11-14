<?php

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cat = new \App\Category();
        $cat->icon='<i class="fad fa-code"></i>';
        $cat->name="Le dev";
        $cat->save();

        $cat = new \App\Category();
        $cat->icon='<i class="fad fa-hat-chef"></i>';
        $cat->name="Le cuisine";
        $cat->save();

        $cat = new \App\Category();
        $cat->icon='<i class="fas fa-ballot-check"></i>';
        $cat->name="Le reste";
        $cat->save();
    }
}
