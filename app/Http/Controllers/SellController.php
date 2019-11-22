<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Wallet;
use DB;
use App\Http\Controllers\HomeController;

    class SellController extends Controller
    {
        
        //Function to display cryptos and amount for selling page
        public function sellCryptos(){

        $amount = DB::table('wallets')
        ->join('users', 'users.id', '=', 'wallets.user_id')
        ->join('currencies', 'currencies.id', '=', 'wallets.currency_id')
        ->select('wallets.id AS iud','currencies.id','wallets.credit','currencies.name','currencies.symbol')
        ->where('users.id', Auth::user()->id)
        ->get();
        return view('customer.sellCryptos',compact('amount'));

        }
    }
