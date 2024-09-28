<?php

namespace App\Http\Controllers;

use App\Models\Coin;
use Illuminate\Http\Request;


class IndexController extends Controller
{
    //
   

    public function __invoke(){
        $coins = Coin::All();

        return view('coinmonitor',compact('coins'));
    }
}
