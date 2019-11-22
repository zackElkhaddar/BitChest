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
        //Seeder to generate names and symbols currencies
        DB::Table('currencies')->insert(array([
            'name' => 'Bitcoin',
            'symbol' => 'BTC',
        ],
            [
                'money_name' => 'Ethereum',
                'symbol' => 'ETH',
            ],
            [
                'money_name' => 'Ripple',
                'symbol' => 'XRP',
            ],
            [
                'money_name' => 'Bitcoin Cash',
                'symbol' => 'BCH',
            ],
            [
                'money_name' => 'Cardano',
                'symbol' => 'ADA',
            ],
            [
                'money_name' => 'Litecoin',
                'symbol' => 'LTC',
            ],
            [
                'money_name' => 'NEM',
                'symbol' => 'XEM',
            ],
            [
                'money_name' => 'Stellar',
                'symbol' => 'XLM',
            ],
            [
                'money_name' => 'IOTA',
                'symbol' => 'MIOTA',
            ],
            [
                'money_name' => 'DASH',
                'symbol' => 'DASH',
            ],
            [
                'money_name' => 'EURO',
                'symbol' => 'EUR',
            ]));
    }
}
