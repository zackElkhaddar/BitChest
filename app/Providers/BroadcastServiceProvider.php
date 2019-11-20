<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Broadcast::routes();

        require base_path('routes/channels.php');
    }
    public function transfertCryptoMoneyToEuro( $quantity ){
        $client = new Client(['base_uri' => 'https://apirone.com/']);  
        $response = $client->request('GET', 'api/v1/ticker?currency=ltc'); 
        $body = $response->getBody();
        $content =$body->getContents();
        $arrs = json_decode($content,TRUE);
        $taux = $arrs['EUR']['last'];
        return $quantity*$taux;
    }
}
