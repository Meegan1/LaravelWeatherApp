<?php

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
        // $this->call(UsersTableSeeder::class);
        // Seeding the cities
        $this->call(CitiesTableSeeder::class);
        $this->command->info('Seeded the cities table ...');
    }
}
