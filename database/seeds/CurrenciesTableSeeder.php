<?php

use Illuminate\Database\Seeder;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::Table('currencies')->insert(array([
            'name' => 'Bitcoin',
            'symbol' => 'BC',
        ],
            [
                'money_name' => 'Ethereum',
                'symbol' => 'Eth',
            ],
            [
                'money_name' => 'Ripple',
                'symbol' => 'R',
            ],
            [
                'money_name' => 'Bitcoin Cash',
                'symbol' => 'BC-C',
            ],
            [
                'money_name' => 'Cardano',
                'symbol' => 'C',
            ],
            [
                'money_name' => 'Litecoin',
                'symbol' => 'LC',
            ],
            [
                'money_name' => 'NEM',
                'symbol' => 'NEM',
            ],
            [
                'money_name' => 'Stellar',
                'symbol' => 'S',
            ],
            [
                'money_name' => 'IOTA',
                'symbol' => 'IOTA',
            ],
            [
                'money_name' => 'DASH',
                'symbol' => 'DASH',
            ]));
    }
}
