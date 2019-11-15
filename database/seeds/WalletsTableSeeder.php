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
            'user_id' => rand(1, 3),
            'currency_id' => rand(1, 10),
            
        ],
        [
            'user_id' => rand(1, 3),
            'currency_id' => rand(1, 10),
            
        ],
        [
            'user_id' => rand(1, 3),
            'currency_id' => rand(1, 10),
            
        ],
        [                            
            'user_id' => rand(1, 3),
            'currency_id' => rand(1, 10),
            
        ],
        [
            'user_id' => rand(1, 3),
            'currency_id' => rand(1, 10),
            
        ],
        [
            'user_id' => rand(1, 3),
            'currency_id' => rand(1, 10),
            
        ],
        [                           
            'user_id' => rand(1, 3),
            'currency_id' => rand(1, 10),
            
        ],
        [                            
            'user_id' => rand(1, 3),
            'currency_id' => rand(1, 10),
            
        ]));

    }
}
