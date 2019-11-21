<?php

use Illuminate\Database\Seeder;

class WalletsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::Table('wallets')->insert(array([
            'user_id' => 1,
            'currency_id' => rand(1, 11),
            'credit' => rand(1,20000),
        ],
        [
            'user_id' => 2,
            'currency_id' => rand(1, 11),
            'credit' => rand(1,20000),
        ],
        [
            'user_id' => 3,
            'currency_id' => rand(1, 11),
            'credit' => rand(1,20000),
        ],
        [                            
            'user_id' => 5,
            'currency_id' => rand(1, 11),
            'credit' => rand(1,20000),
        ],
        [                            
            'user_id' => 6,
            'currency_id' => rand(1, 11),
            'credit' => rand(1,20000),
        ]));

    }
}
