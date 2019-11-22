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

    public function transfer( $quantity ,$isEuro ){
        if($isEuro)
        return $quantity/$this->getRate();
        else 
        return $quantity*$this->getRate();
    }

    public static function getRate($cryptoType){
        if($cryptoType == 'EUR'){
        return 1;}
        else{
        $client = new Client(['base_uri' => 'http://api.coinlayer.com/']);  
        $response = $client->request('GET', 'live?access_key=ae4edf312c3f0f934c23c55551610efc&target=EUR'); 
        $body = $response->getBody();
        $content =$body->getContents();
        $arrs = json_decode($content,TRUE);
        $arrs = $arrs['rates'][$cryptoType];
        return $arrs;
    }
        
    }

    public function profile()
    {
        $users = User::where('id', Auth::id())->get();
        //$users = User::all();
        return view('admin.profile',compact('users'));
    }

    public function storeAdminProfile(Request $request)
    {
        //
        // validate
        $rules = array(
            'name'       => 'required',
            'email'      => 'required|email',
            'is_admin' => 'required|numeric'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('profile/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $user = new User;

            $user->name=$request->input('name');
            $user->email=$request->input('email');
            $user->is_admin=$request->input('is_admin');
            $user->save();

            // redirect
            Session::flash('message', 'Successfully created user!');
            return Redirect::to('profile');
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editAdminProfile($id)
    {
        //
        // get the user
        $user = User::find($id);

        // show the edit form and pass the user
        return view('admin.editAdminProfile',compact('user'));
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
        //
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

    public function homeclient()
    {   
        
        $amounts = $this->getRate('ETH');
        $cryptos = DB::table('currencies')
        ->select('currencies.id','currencies.name','currencies.symbol')
        ->where('currencies.symbol','!=','EUR')
        ->get();
        return view('customer.homeClient',compact('cryptos','amounts'));
    }

    public function homeadmin()
    {   
        
        $amounts = $this->getRate('ETH');
        $cryptos = DB::table('currencies')
        ->select('currencies.id','currencies.name','currencies.symbol')
        ->get();
        return view('admin.homeAdmin',compact('cryptos','amounts'));
    }

    public function buy(Request $request){
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
         ->update(['credit' => $moneyEuros->credit+($rate * $credit)]);
         $crypto = Wallet::find($iud);
         $crypto->delete();
       }
       else {
           DB::table('wallets')
            ->insert(array(
            array('currency_id'=>'11'),
            array('credit'=>$credit),            
        ))->where('user_id', Auth::user()->id);
       }
       return Redirect::to('sellCryptos');
    }
}
