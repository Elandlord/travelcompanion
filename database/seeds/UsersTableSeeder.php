<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $ruben = new User();
        $ruben->name = 'Ruben';
        $ruben->email = 'ruben@hanze.nl';
        $ruben->password = bcrypt('secret');
        $ruben->photo_link = $faker->imageUrl($width = 640, $height = 480);
        $ruben->save();

        $vincent = new User();
        $vincent->name = 'Vincent';
        $vincent->email = 'vincent@hanze.nl';
        $vincent->password = bcrypt('secret');
        $vincent->photo_link = $faker->imageUrl($width = 640, $height = 480);
        $vincent->save();

        $eric = new User();
        $eric->name = 'Eric';
        $eric->email = 'eric@hanze.nl';
        $eric->password = bcrypt('secret');
        $eric->photo_link = $faker->imageUrl($width = 640, $height = 480);
        $eric->save();

        $marc = new User();
        $marc->name = 'Marc';
        $marc->email = 'marc@hanze.nl';
        $marc->password = bcrypt('secret');
        $marc->photo_link = $faker->imageUrl($width = 640, $height = 480);
        $marc->save();
    }
}
