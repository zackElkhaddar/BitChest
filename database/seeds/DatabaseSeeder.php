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
        //Call to all TableSeeders
        $this->call(UsersTableSeeder::class);
        $this->call(TransactionsTableSeeder::class);
        $this->call(CurrenciesTableSeeder::class);
        $this->call(WalletsTableSeeder::class);

    }
}
