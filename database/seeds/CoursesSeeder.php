<?php

use Illuminate\Database\Seeder;

class CoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $slugify = new \Cocur\Slugify\Slugify();

        $course = new \App\Course();
        $course->title = "Creer un test";
        $course->subtitle = "How to creer un text avec Claude";
        $course->slug = $slugify->slugify($course->title);
        $course->description= "Toruss sunt apolloniatess de albus hilotae. Bursa, nixus, et buxum. Glos crederes, tanquam emeritis vita. Toruss sunt apolloniatess de albus hilotae. Bursa, nixus, et buxum. Glos crederes, tanquam emeritis vita. Toruss sunt apolloniatess de albus hilotae. Bursa, nixus, et buxum. Glos crederes, tanquam emeritis vita.";
        $course->price = 19.99;
        $course->category_id = 1;
        $course->user_id = 4;
        $course->save();

        $course = new \App\Course();
        $course->title = "La science";
        $course->subtitle = "Oh to study la science avec Adam";
        $course->slug = $slugify->slugify($course->title);
        $course->description= "Planets are the klingons of the chemical coordinates. Wisely assimilate a planet. Starlight travel at the universe that is when boldly suns meet. Where is the apocalyptic planet? All hands die. Nuclear flux at the cosmos was the sonic shower of modification, desired to a lunar vogon.";
        $course->price = 19.99;
        $course->category_id = 3;
        $course->user_id = 3;
        $course->save();

        $course = new \App\Course();
        $course->title = "ahahah";
        $course->subtitle = "On rigole fort avec sofort";
        $course->slug = $slugify->slugify($course->title);
        $course->description= "Hell is not the unbiased beauty of the master. As i have acquired you, so you must love one another. The afterlife is a strange wind. Who can desire the attitude and silence of a wind if he has the sincere politics of the moon.";
        $course->price = 19.99;
        $course->category_id = 3;
        $course->user_id = 4;
        $course->save();

        $course = new \App\Course();
        $course->title = "En cuisine";
        $course->subtitle = "Tous en cuisine avec ta femme";
        $course->slug = $slugify->slugify($course->title);
        $course->description= "Everyone loves the flavor of shrimps loaf marinated with divided jasmine. All children like dried lobsters in salad cream and thyme. Marinate eleven and a half teaspoons of spinach in five teaspoons of vinaigrette. To the gooey blueberries add pickles, chicken, peanut sauce and delicious sauerkraut.";
        $course->price = 19.99;
        $course->category_id = 2;
        $course->user_id = 2;
        $course->save();

    }
}
