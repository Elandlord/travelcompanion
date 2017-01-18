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
        factory(Hotel::class, 1)->create();
        factory(Route::class, 1)->create();

        DB::table('hotels_routes')->insert([
            'route_id' => 1,
            'hotel_id' => 1,
            'arrival_date' => $faker->date(),
            'departure_date' => $faker->date(),
            'price' => $faker->numberBetween(15, 100),
            'amount_persons' => $faker->numberBetween(1, 4),
            'paid' => true,
            'bank_account_number' => $faker->creditCardNumber()
        ], [
            'route_id' => 1,
            'hotel_id' => 1,
            'arrival_date' => $faker->date(),
            'departure_date' => $faker->date(),
            'price' => $faker->numberBetween(15, 100),
            'amount_persons' => $faker->numberBetween(1, 4),
            'paid' => true,
            'bank_account_number' => $faker->creditCardNumber()
        ]);

        DB::table('locations_routes')->insert([
            'id' => 1,
            'location_id' => 1,
            'route_id' => 1,
            'arrival_date' => $faker->date(),
            'departure_date' => $faker->date()
        ]);


    }
}
