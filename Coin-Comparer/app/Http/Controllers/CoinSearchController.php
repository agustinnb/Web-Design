<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coin;


class CoinSearchController extends Controller
{
    //
    public function coins(Request $request){
        //Recuperamos lo que el usuario escribió en el buscador
        $term = $request->term;	
    
        $querys = Coin::where('name','like','%' . $term . '%')
                        ->orWhere('slug','like','%'.$term.'%')
                        ->orWhere('symbol','like','%'.$term.'%')
                        ->orderBy('id','ASC')
                        ->select(array("name", "symbol", "idCMC"))
                        ->get();
        
        $x=0;
        foreach ($querys as $query){
            $symbol[$x]['label']=$query['name'] . " (" . $query['symbol'] .")";
            $symbol[$x]['id']=$query['idCMC'];
            $x++;
        }
        return $symbol;
    
    
        }
}
