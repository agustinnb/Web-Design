<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coin;

class CoinShowController extends Controller
{
    //
    public function showcoin(Request $request){
        $selcoin = $request->term;

        $coin = Coin::where('idCMC',$selcoin);
                        
        $coindata=sCoins($selcoin);

        foreach ($coindata->data as $coind){
        $coin ->update(array(
            'is_fiat'=>$coind->is_fiat,
            'circulating_supply'=>$coind->circulating_supply,
            'total_supply'=>$coind->total_supply,
            'max_supply'=>$coind->max_supply,
            'price'=>$coind->quote->USD->price,
            'volume_24h'=>$coind->quote->USD->volume_24h,
            'percent_change_1h'=>$coind->quote->USD->percent_change_1h,
            'percent_change_24h'=>$coind->quote->USD->percent_change_24h,
            'percent_change_7d'=>$coind->quote->USD->percent_change_7d,
            'percent_change_30d'=>$coind->quote->USD->percent_change_30d,
            'market_cap'=>$coind->quote->USD->market_cap,
            'last_updated'=>$coind->quote->USD->last_updated
        ));
        $coinS= array("name"=>$coind->name,
                    "symbol"=>$coind->symbol,
                    "slug"=>$coind->slug,
                    'is_fiat'=>$coind->is_fiat,
                    'circulating_supply'=>$coind->circulating_supply,
                    'total_supply'=>$coind->max_supply,
                    'price'=>$coind->quote->USD->price,
                    'volume_24h'=>$coind->quote->USD->volume_24h,
                    'percent_change_1h'=>$coind->quote->USD->percent_change_1h,
                    'percent_change_24h'=>$coind->quote->USD->percent_change_24h,
                    'percent_change_7d'=>$coind->quote->USD->percent_change_7d,
                    'percent_change_30d'=>$coind->quote->USD->percent_change_30d,
                    'market_cap'=>$coind->quote->USD->market_cap,
                    'last_updated'=>$coind->quote->USD->last_updated
    );

        return $coinS;
        }
        
    }

    

}

function sCoins($gcoin){
    $url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/quotes/latest';

    $headers = [
        'Accepts: application/json',
        'X-CMC_PRO_API_KEY: ' . env('CMC_API_KEY')
    ];
    $parameters = [
        'id' => $gcoin
      ];
        $qs = http_build_query($parameters); // query string encode the parameters
        $request = "{$url}?{$qs}"; // create the request URL


    $curl = curl_init(); // Get cURL resource
    // Set cURL options
    curl_setopt_array($curl, array(
    CURLOPT_URL => $request,            // set the request URL
    CURLOPT_HTTPHEADER => $headers,     // set the headers 
    CURLOPT_RETURNTRANSFER => 1         // ask for raw response instead of bool
    ));

    $response = curl_exec($curl); // Send the request, save the response
    $coins=json_decode($response); // print json decoded response
    
    curl_close($curl); // Close request
    return $coins;
 
}
