<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Wallet;
use App\Currency;
use DB;
use App\Http\Controllers\HomeController;

    class BuyController extends Controller
    {
        //Function to display cryptos and amount inside wallet in buying page
        public function buyCryptos(){

            $crypto = Currency::all();
            $amount = DB::table('wallets')
                        ->join('users', 'users.id', '=', 'wallets.user_id')
                        ->join('currencies', 'currencies.id', '=', 'wallets.currency_id')
                        ->select('wallets.id AS iud','currencies.id','wallets.credit','currencies.name','currencies.symbol')
                        ->where('users.id', Auth::user()->id)
                        ->get();
                        
            return view('customer.buyCryptos',compact('amount','crypto'));
        
            }
    }
