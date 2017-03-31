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
        $this->call(CountiesTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
        $this->call(QuestionsTableSeeder::class);
        $this->call(InstitutionsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
