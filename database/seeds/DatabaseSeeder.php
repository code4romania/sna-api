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
        $this->call(CountiesPopulationTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
        $this->call(StepsTableSeeder::class);
        $this->call(QuestionsTableSeeder::class);
        $this->call(InstitutionTypesTableSeeder::class);
        $this->call(InstitutionsTableSeeder::class);
        //$this->call(UsersTableSeeder::class);
        // $this->call(AnswersTableSeeder::class);
        // $this->call(AnswersCountiesTableSeeder::class);
    }
}
