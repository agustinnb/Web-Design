<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Coin;
class CoinTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    

    
     public function run()
    {
        //
    
        $coins = gCoins();
        foreach ($coins->data as $coin){
            $coinadd=new Coin();
            $coinadd->idCMC=$coin->id;
            $coinadd->name=$coin->name;
            $coinadd->symbol=$coin->symbol;
            $coinadd->slug=$coin->slug;
            $coinadd->is_active=$coin->is_active;
            $coinadd->save();

        }
     
    }
    

}

function gCoins(){
    $url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/map';

    $headers = [
        'Accepts: application/json',
        'X-CMC_PRO_API_KEY: ' . env('CMC_API_KEY')
    ];

    $request = "{$url}"; // create the request URL


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