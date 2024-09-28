<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coin extends Model
{
    use HasFactory;
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idCMC',
        'name',
        'symbol',
        'slug',
        'is_active',
        'is_fiat',
        'circulating_supply',
        'total_supply',
        'max_supply',
        'mineable',
        'price',
        'volume_24h',
        'percent_change_1h',
        'percent_change_24h',
        'percent_change_7d',
        'percent_change_30d',
        'market_cap',
        'last_updated' => 'datetime',
    ];
    
}
