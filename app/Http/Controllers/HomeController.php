<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\User;
use App\Currency;
use GuzzleHttp\Client;
use DB;
use App\Wallet;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {   
        header('Access-Control-Allow-Origin : *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, X-Auth-Token, Authorization, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.homeAdmin');
    }

    public function edit()
    {
        $users = User::where('id', Auth::id())->get();
        $wallets = Wallet::where('user_id', Auth::id())->get();
       
        return view('admin.homeAdmin', compact('users','wallets'));
    }

    public function update()
    {
        $rules = array(
            'name' => 'required',
            'email' => 'required|email',
            'is_admin' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);
        
        if ($validator->fails()) {
            return Redirect::to('admin.homeAdmin')
                ->withErrors($validator)
                ->withInput(Input::except('is_admin'));
        } else {
            $user = User::where(Auth::user()->id);
            $user->name = Input::get('name');
            $user->email = Input::get('email');
            $user->is_admin = Input::get('is_admin');
            $user->save();
            Session::flash('flash_message', 'Data of' . $user->name . 'modified succefully');
         
            return redirect('admin.homeAdmin');
         }
    }

    //Function to transfer EURO to Cryptos coins and vice versa
    public function transfer( $quantity ,$isEuro ){
        if($isEuro)
        return $quantity/$this->getRate();
        else 
        return $quantity*$this->getRate();
    }

    //Function to get the rate in "EUR" of cryptos coins in real-time via online API
    public static function getRate($cryptoType)
    {
        if($cryptoType == 'EUR'){

        return 1;

        }else{

        $client = new Client(['base_uri' => 'http://api.coinlayer.com/']);  
        $response = $client->request('GET', 'live?access_key=bd309d937fcdbf58df694796fe3c43e6&target=EUR'); 
        $body = $response->getBody();
        $content =$body->getContents();
        $arrs = json_decode($content,TRUE);
        $arrs = $arrs['rates'][$cryptoType];

        return $arrs;
    }
        
    }

    //Function to display profile for this authenticated user's in admin side and client side
    public function profile()
    {
        $users = User::where('id', Auth::id())->get();
        //$users = User::all();
        return view('admin.profile',compact('users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateAdminProfile(Request $request, $id)
    {
        // validate
        $rules = array(
            'name'       => 'required',
            'email'      => 'required|email',
            'is_admin' => 'required|numeric'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('profile/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $user = User::find($id);
            $user->name=$request->input('name');
            $user->email=$request->input('email');
            $user->is_admin=$request->input('is_admin');
            $user->save();

            // redirect
            Session::flash('message', 'Successfully updated user!');
            return Redirect::to('profile');
        }
        
    }


    //Function for Admin controller to manage users 
    public function usermanage()
    {
        $users = User::all();

        return view('admin.userManage',compact('users'));
    }

    //Function to display ONLY cryptos coins inside the user's wallets contents 
    public function wallet()
    {   
        $amounts = $this->getRate('ETH');
        $cryptos = DB::table('wallets')
                        ->join('users', 'users.id', '=', 'wallets.user_id')
                        ->join('currencies', 'currencies.id', '=', 'wallets.currency_id')
                        ->select('currencies.id','wallets.credit','currencies.name','currencies.symbol')
                        ->where('users.id', Auth::user()->id)
                        ->get();

        return view('customer.wallet',compact('cryptos','amounts'));
    }

    //Function to display all cryptos coins in client side
    public function homeclient()
    {   
        $amounts = $this->getRate('ETH');
        $cryptos = DB::table('currencies')
                        ->select('currencies.id','currencies.name','currencies.symbol')
                        ->where('currencies.symbol','!=','EUR')
                        ->get();

        return view('customer.homeClient',compact('cryptos','amounts'));
    }

    //Function to display all cryptos coins in admin side
    public function homeadmin()
    {   
        $amounts = $this->getRate('ETH');
        $cryptos = DB::table('currencies')
                        ->select('currencies.id','currencies.name','currencies.symbol')
                        ->get();

        return view('admin.homeAdmin',compact('cryptos','amounts'));
    }

    //Function to sell all contents of wallet user
    public function sell(Request $request){

       $credit = $request->input('credit');
       $currency_id = $request->input('currency_id');
       $iud = $request->input('iud');

       $rate = $this->getRate($currency_id);

       $moneyEuros = DB::table('wallets')
                    ->join('users', 'users.id', '=', 'wallets.user_id')
                    ->join('currencies', 'currencies.id', '=', 'wallets.currency_id')
                    ->select('wallets.id AS uid','currencies.id','wallets.credit','currencies.name','currencies.symbol')
                    ->where('users.id', Auth::user()->id)
                    ->where('currency_id',11)
                    ->first();

       if(isset($moneyEuros)){

        Wallet::where('id', $moneyEuros->uid)
                ->update(['credit' => $moneyEuros->credit+($rate * $credit)]); // Or Use above Transfer function 
         
        $crypto = Wallet::find($iud);
        $crypto->delete();
        }else{
            $crypto = new Wallet;

            $crypto->currency_id= 11;
            $crypto->credit= $credit;
            $crypto->user_id = Auth::user()->id;
            $crypto->save(); 
            
            $crypto = Wallet::find($iud);
            $crypto->delete();   
       }
      // Session::flash('message', 'You have selling your wallet successufly!');
       return Redirect::to('wallet')->with('status', 'You selling your wallet successufly!');
    }

     public function buy(Request $request){
        $credit = $request->input('credit');
        $currency_id = $request->input('currency_id');
        $iud = $request->input('iud');
        $rate = $this->getRate($currency_id);
        $moneyCrypto = DB::table('wallets')
        ->join('users', 'users.id', '=', 'wallets.user_id')
        ->join('currencies', 'currencies.id', '=', 'wallets.currency_id')
        ->select('wallets.id AS uid','currencies.id','wallets.credit','currencies.name','currencies.symbol')
        ->where('users.id', Auth::user()->id)
        ->where('currency_id',11)
        ->first();
 
        if(isset($moneyCrypto)){
         Wallet::where('id', $moneyCrypto->uid)
          ->update(['credit' => $moneyCrypto->credit+($credit / $rate)]);
          $crypto = Wallet::find($iud);
          $crypto->delete();
        }
        else {
            $crypto = new Wallet;

       // $crypto->name=$request->input('name');
        $crypto->currency_id=$request->input('currency_id');
        $crypto->credit=$request->input('credit');
        $crypto->save();
        }
        return Redirect::to('buyCryptos')->with('status', 'You buying successufly! Check your wallet');
     } 
}
