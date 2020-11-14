<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 3; $i++){
            $user = new \App\User();
            $user->name = Str::random(10);
            $user->email = Str::random(15).'@gmail.com';
            $user->password= Hash::make('password');
            $user->save();

        }

        $user = new \App\User();
        $user->name = 'Simon Lou';
        $user->email = 'simsimbidet@gmail.com';
        $user->password= Hash::make('Simsimlnsm88');
        $user->save();

        for($i = 0; $i < 3; $i++){
            $user = new \App\User();
            $user->name = Str::random(10);
            $user->email = Str::random(15).'@gmail.com';
            $user->password= Hash::make('password');
            $user->save();

        }


    }
}
