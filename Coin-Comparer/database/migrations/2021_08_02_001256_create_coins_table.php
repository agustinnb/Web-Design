<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coins', function (Blueprint $table) {
            $table->id();
            $table->integer('idCMC');
            $table->string('name');
            $table->string('symbol');
            $table->string('slug');
            $table->boolean('is_active');
            $table->boolean('is_fiat');
            $table->double('circulating_supply');
            $table->double('total_supply');
            $table->double('max_supply');
            $table->boolean('mineable');
            $table->double('price');
            $table->double('volume_24h');
            $table->double('percent_change_1h');
            $table->double('percent_change_24h');
            $table->double('percent_change_7d');
            $table->double('percent_change_30d');
            $table->double('market_cap');
            $table->dateTime('last_updated');         
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coins');
    }
}
