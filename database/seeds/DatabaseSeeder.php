<?php

use App\Hotel;
use App\Route;
use App\Location;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $this->call(UsersTableSeeder::class);

        factory(Location::class, 1)->create();
        factory(Hotel::class, 5)->create();
        factory(Route::class, 1)->create();

        DB::table('hotel_route')->insert([
            'route_id' => 1,
            'hotel_id' => 1,
            'arrival_date' => $faker->date(),
            'departure_date' => $faker->date(),
            'price' => $faker->numberBetween(15, 100),
            'amount_persons' => $faker->numberBetween(1, 4),
            'paid' => true,
            'bank_account_number' => $faker->creditCardNumber()
        ]);
        DB::table('hotel_route')->insert([
            'route_id' => 1,
            'hotel_id' => 1,
            'arrival_date' => $faker->date(),
            'departure_date' => $faker->date(),
            'price' => $faker->numberBetween(15, 100),
            'amount_persons' => $faker->numberBetween(1, 4),
            'paid' => true,
            'bank_account_number' => $faker->creditCardNumber()
        ]);
        DB::table('hotel_route')->insert([
            'route_id' => 1,
            'hotel_id' => 2,
            'arrival_date' => $faker->date(),
            'departure_date' => $faker->date(),
            'price' => $faker->numberBetween(15, 100),
            'amount_persons' => $faker->numberBetween(1, 4),
            'paid' => true,
            'bank_account_number' => $faker->creditCardNumber()
        ]);
        DB::table('hotel_route')->insert([
            'route_id' => 2,
            'hotel_id' => 3,
            'arrival_date' => $faker->date(),
            'departure_date' => $faker->date(),
            'price' => $faker->numberBetween(15, 100),
            'amount_persons' => $faker->numberBetween(1, 4),
            'paid' => true,
            'bank_account_number' => $faker->creditCardNumber()
        ]);

        DB::table('location_route')->insert([
            'id' => 1,
            'location_id' => 1,
            'route_id' => 1,
            'arrival_date' => $faker->date(),
            'departure_date' => $faker->date()
        ]);


    }
}
