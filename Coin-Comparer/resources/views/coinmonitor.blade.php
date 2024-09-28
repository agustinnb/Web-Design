@extends('layouts.plantilla')
@section('title','Coin Comparer')
@section('content')
<style>
    .ui-autocomplete-loading {
      background: white url({{asset("storage/img/ui-anim_basic_16x16.gif")}}) 95% center no-repeat;
    }
</style>
<script type="text/javascript">
function showLoading() {
  document.querySelector('#loading').classList.add('loading');
  document.querySelector('#loading-content').classList.add('loading-content');
  
}

function hideLoading() {
  document.querySelector('#loading').classList.remove('loading');
  document.querySelector('#loading-content').classList.remove('loading-content');
  document.querySelector('#loading-text').innerHTML="";
}

function hideLoading2() {
  document.querySelector('#loading').classList.remove('loading');
  document.querySelector('#loading-content').classList.remove('loading-content');
  document.querySelector('#loading-text').innerHTML="";
}

</script>
<script>
    $(document).ready(function() {
    showLoading();

    
    setTimeout(function() {
        hideLoading();
        $( "#coin1" ).fadeIn( 400 );
    }, 5000);    
});

    </script>
<section id="loading">
    <div id="loading-content"></div>
    <div id="loading-text">Loading...</div>
  </section>




<script>
    var gdata1;
    var gdata2;
    $( function() {
            
            $( "#coins" ).autocomplete({
                search: function(event, ui) { 
                    $('.spinner').show();
                },
                response: function(event, ui) {
                    $('.spinner').hide();
                },
                select: showResult,
                source: function( request, response ) {
                $.ajax( {
                    url: "{{route('search.coins')}}",
                    dataType: "json",
                    data: {
                        term: request.term
                    },
                    success: function( data ) {
                    response( $.map( data, function( item )
                        {
                            return{                                   
                                    label: item.label,
                                    value: item.label,
                                    id: item.id                                                                   
                                   }
                        }));
                    }
                });
                }
          
            });
      
            function showResult(event, ui) {
                $('#hiddenIdCMC').val(ui.item.id).trigger('change');
                $( "#coins" ).prop( "disabled", true );
            }



            $( "#coins2" ).autocomplete({
                search: function(event, ui) { 
                    $('.spinner').show();
                },
                response: function(event, ui) {
                    $('.spinner').hide();
                },
                select: showResult2,
                source: function( request, response ) {
                $.ajax( {
                    url: "{{route('search.coins')}}",
                    dataType: "json",
                    data: {
                        term: request.term
                    },
                    success: function( data ) {
                    response( $.map( data, function( item )
                        {
                            return{                                   
                                    label: item.label,
                                    value: item.label,
                                    id: item.id                                                                   
                                   }
                        }));
                    }
                });
                }
          
            });
      
            function showResult2(event, ui) {
                $('#hiddenIdCMC2').val(ui.item.id).trigger('change');
                $( "#coins2" ).prop( "disabled", true );
            }














            $('#hiddenIdCMC').change(function(){
            //fire your ajax call 
            console.log( "Handler for #hiddenIdCMC called." );
            $.ajax( {
                    url: "{{route('show.coins')}}",
                    dataType: "json",
                    data: {
                        term: $('#hiddenIdCMC').val()
                    },
                    success: function( data ) {
                    gdata1=data;
                    console.log(gdata1);
                        $( "#coin1" ).fadeOut( 400, function() {
                            $( "#coin2" ).fadeIn( 400 );
                        } );
    
                    /*
                    $('#coincompare').append("<p>Coin name: " + data.name + "</p>" +
                    "<p>Coin symbol: " + data.symbol + "</p>" +
                    "<p>Coin slug: " + data.slug + "</p>" +
                    "<p>Coin Circulating Supply: " + data.circulating_supply + "</p>" +
                    "<p>Coin Total Supply: " + data.total_supply + "</p>" +
                    "<p>Coin Price: " + data.price + " USD</p>" +
                    "<p>Coin Volume 24h: " + data.volume_24h + "</p>" +
                    "<p>Coin Percent Change 1h: " + data.percent_change_1h + "</p>" +
                    "<p>Coin Percent Change 24h: " + data.percent_change_24h + "</p>" +
                    "<p>Coin Percent Change 7d: " + data.percent_change_7d + "</p>" +
                    "<p>Coin Percent Change 30d: " + data.percent_change_30d + "</p>" +
                    "<p>Coin Market Cap: " + data.market_cap + "</p>" +
                    "<p>Last Updated: " + data.last_updated + "</p>"); */
                    }
                });
            });
            
            $("#hiddenIdCMC2").change(function(){
            //fire your ajax call 
            console.log( "Handler for #hiddenIdCMC2 called." );
            $.ajax( {
                    url: "{{route('show.coins')}}",
                    dataType: "json",
                    data: {
                        term: $('#hiddenIdCMC2').val()
                    },
                    success: function( data ) {
                    gdata2=data;
                    console.log(gdata2);
                    var compCC="";
                    if (parseFloat(gdata1.circulating_supply) > parseFloat(gdata2.circulating_supply)){
                        compCC=gdata1.name + " has " + Math.round(parseFloat(gdata1.circulating_supply)-parseFloat(gdata2.circulating_supply)) + " more circulating supply than " + gdata2.name;
                    }else{
                        compCC=gdata2.name + " has " + Math.round(parseFloat(gdata2.circulating_supply)-parseFloat(gdata1.circulating_supply)) + " more circulating supply than " + gdata1.name;
                    }
                    var compTS="";
                    if (parseFloat(gdata1.total_supply) > parseFloat(gdata2.total_supply)){
                        compTS=gdata1.name + " has " + Math.round(parseFloat(gdata1.total_supply)-parseFloat(gdata2.total_supply)) + " more total supply than " + gdata2.name;
                    }else{
                        compTS=gdata2.name + " has " + Math.round(parseFloat(gdata2.total_supply)-parseFloat(gdata1.total_supply)) + " more total supply than " + gdata1.name;
                    }
                    var price="";
                    if (parseFloat(gdata1.price) > parseFloat(gdata2.price)){
                        price=gdata1.name + " has " + parseFloat((parseFloat(gdata1.price)-parseFloat(gdata2.price))).toFixed(4) + " more value per coin than " + gdata2.name;
                    }else{
                        price=gdata2.name + " has " +  + parseFloat((parseFloat(gdata2.price)-parseFloat(gdata1.price))).toFixed(4) + " more value per coin than " + gdata1.name;
                    }
                    var volume_24h="";
                    if (parseFloat(gdata1.volume_24h) > parseFloat(gdata2.volume_24h)){
                        volume_24h=gdata1.name + " has " + parseFloat((parseFloat(gdata1.volume_24h)-parseFloat(gdata2.volume_24h))).toFixed(4) + " more volume in the last 24h than " + gdata2.name;
                    }else{
                        volume_24h=gdata2.name + " has " +  + parseFloat((parseFloat(gdata2.volume_24h)-parseFloat(gdata1.volume_24h))).toFixed(4) + " more volume in the last 24h than " + gdata1.name;
                    }
                    var percent_change_1h="";
                    if (parseFloat(gdata1.percent_change_1h) > parseFloat(gdata2.percent_change_1h)){
                        percent_change_1h=gdata1.name + " has a positive difference of " + parseFloat(Math.abs(parseFloat(gdata1.percent_change_1h)-parseFloat(gdata2.percent_change_1h))).toFixed(4) + "% percent change in the last hour than " + gdata2.name;
                    }else{
                        percent_change_1h=gdata2.name + " has a positive difference of " + parseFloat(Math.abs(parseFloat(gdata1.percent_change_1h)-parseFloat(gdata2.percent_change_1h))).toFixed(4) + "% percent change in the last hour than " + gdata1.name;
                    }
                    var percent_change_24h="";
                    if (parseFloat(gdata1.percent_change_24h) > parseFloat(gdata2.percent_change_24h)){
                        percent_change_24h=gdata1.name + " has a positive difference of " + parseFloat(Math.abs(parseFloat(gdata1.percent_change_24h)-parseFloat(gdata2.percent_change_24h))).toFixed(4) + "% percent change in the last 24h than " + gdata2.name;
                    }else{
                        percent_change_24h=gdata2.name + " has a positive difference of " + parseFloat(Math.abs(parseFloat(gdata1.percent_change_24h)-parseFloat(gdata2.percent_change_24h))).toFixed(4) + "% percent change in the last 24h than " + gdata1.name;
                    }
                    var percent_change_7d="";
                    if (parseFloat(gdata1.percent_change_7d) > parseFloat(gdata2.percent_change_7d)){
                        percent_change_7d=gdata1.name + " has a positive difference of " + parseFloat(Math.abs(parseFloat(gdata1.percent_change_7d)-parseFloat(gdata2.percent_change_7d))).toFixed(4) + "% percent change in the last 7d than " + gdata2.name;
                    }else{
                        percent_change_7d=gdata2.name + " has a positive difference of " + parseFloat(Math.abs(parseFloat(gdata1.percent_change_7d)-parseFloat(gdata2.percent_change_7d))).toFixed(4) + "% percent change in the last 7d than " + gdata1.name;
                    }
                    var percent_change_30d="";
                    if (parseFloat(gdata1.percent_change_30d) > parseFloat(gdata2.percent_change_30d)){
                        percent_change_30d=gdata1.name + " has a positive difference of " + parseFloat(Math.abs(parseFloat(gdata1.percent_change_30d)-parseFloat(gdata2.percent_change_30d))).toFixed(4) + "% percent change in the last 30d than " + gdata2.name;
                    }else{
                        percent_change_30d=gdata2.name + " has a positive difference of " + parseFloat(Math.abs(parseFloat(gdata1.percent_change_30d)-parseFloat(gdata2.percent_change_30d))).toFixed(4) + "% percent change in the last 30d than " + gdata1.name;
                    }
                    var market_cap="";
                    if (parseFloat(gdata1.market_cap) > parseFloat(gdata2.market_cap)){
                        market_cap=gdata1.name + " has " + parseFloat((parseFloat(gdata1.market_cap)-parseFloat(gdata2.market_cap))).toFixed(0) + " more Market Cap than " + gdata2.name;
                    }else{
                        market_cap=gdata2.name + " has " +  + parseFloat((parseFloat(gdata2.market_cap)-parseFloat(gdata1.market_cap))).toFixed(0) + " more Market Cap than " + gdata1.name;
                    }





                    var text_coincompare="<div class='container rounded'>" +
                        "<div class='row rounded' style='font-size:22px; background-color: #6a6a6b41; !important'><div class='col'>" + gdata1.name + "</div><div class='col'>Comparison</div><div class='col'>" + gdata2.name + "</div></div>" + 
                        "<div class='row' style='font-size:20px;'><div class='col'>" + gdata1.symbol + "</div><div class='col'></div><div class='col'>" + gdata2.symbol + "</div></div>";
                        if ((parseFloat(gdata1.circulating_supply)!=0)&&(parseFloat(gdata2.circulating_supply)!=0)){
                        text_coincompare+="<div class='row' style='font-size:12px;'><div class='col'>Circulating Supply: " + parseFloat(gdata1.circulating_supply).toFixed(2) + "</div><div class='col' style='font-size:10px;'>" + compCC + "</div><div class='col'>Circulating Supply: " + parseFloat(gdata2.circulating_supply).toFixed(2) + "</div></div>";    
                        }
                        if ((parseFloat(gdata1.total_supply)!=0)&&(parseFloat(gdata2.total_supply)!=0)){
                        text_coincompare+="<div class='row' style='font-size:12px;'><div class='col'>Total Supply: " + parseFloat(gdata1.total_supply).toFixed(2) + "</div><div class='col' style='font-size:10px;'>" + compTS + "</div><div class='col'>Total Supply: " + parseFloat(gdata2.total_supply).toFixed(2) + "</div></div>";
                        }
                        if ((parseFloat(gdata1.price)!=0)&&(parseFloat(gdata2.price)!=0)){
                        text_coincompare+="<div class='row' style='font-size:12px;'><div class='col'>Price: " + parseFloat(gdata1.price).toFixed(2) + " USD</div><div class='col' style='font-size:10px;'>" + price + "</div><div class='col'>Price: " + parseFloat(gdata2.price).toFixed(2) + " USD</div></div>";
                        }
                        if ((parseFloat(gdata1.volume_24h)!=0)&&(parseFloat(gdata2.volume_24h)!=0)){
                        text_coincompare+="<div class='row' style='font-size:12px;'><div class='col'>Coin Volume 24h: " + parseFloat(gdata1.volume_24h).toFixed(2) + "</div><div class='col' style='font-size:10px;'>" + volume_24h + "</div><div class='col'>Coin Volume 24h: " + parseFloat(gdata2.volume_24h).toFixed(2) + "</div></div>";
                        }
                        text_coincompare+="<div class='row' style='font-size:12px;'><div class='col'>Percent Change 1h: " + parseFloat(gdata1.percent_change_1h).toFixed(2) + "% </div><div class='col' style='font-size:10px;'>" + percent_change_1h + "</div><div class='col'>Percent Change 1h: " + parseFloat(gdata2.percent_change_1h).toFixed(2) + "%</div></div>" +
                        "<div class='row' style='font-size:12px;'><div class='col'>Percent Change 24h: " + parseFloat(gdata1.percent_change_24h).toFixed(2) + "% </div><div class='col' style='font-size:10px;'>" + percent_change_24h + "</div><div class='col'>Percent Change 24h: " + parseFloat(gdata2.percent_change_24h).toFixed(2) + "%</div></div>" +
                        "<div class='row' style='font-size:12px;'><div class='col'>Percent Change 7d: " + parseFloat(gdata1.percent_change_7d).toFixed(2) + "% </div><div class='col' style='font-size:10px;'>" + percent_change_7d + "</div><div class='col'>Percent Change 7d: " + parseFloat(gdata2.percent_change_7d).toFixed(2) + "%</div></div>" +
                        "<div class='row' style='font-size:12px;'><div class='col'>Percent Change 30d: " + parseFloat(gdata1.percent_change_30d).toFixed(2) + "% </div><div class='col' style='font-size:10px;'>" + percent_change_30d + "</div><div class='col'>Percent Change 30d: " + parseFloat(gdata2.percent_change_30d).toFixed(2) + "%</div></div>";
                        if ((parseFloat(gdata1.market_cap)!=0)&&(parseFloat(gdata2.market_cap)!=0)){
                        text_coincompare+="<div class='row' style='font-size:12px;'><div class='col'>Market Cap: " + parseFloat(gdata1.market_cap).toFixed(2) + " </div><div class='col' style='font-size:10px;'>" + market_cap + "</div><div class='col'>Market Cap: " + parseFloat(gdata2.market_cap).toFixed(2) + "</div></div>";
                        }
                        text_coincompare+="<div class='row' style='font-size:12px;'><div class='col'>Last Updated: " + gdata1.last_updated + " </div><div class='col'></div><div class='col'>Last Updated: " + gdata2.last_updated + "</div></div>";
                        
                        "</div>";

                    $("#coincompare").append(text_coincompare);

                    $( "#coin2" ).fadeOut( 400, function() {
                            $( "#coincompare" ).fadeIn( 400 );
                        } );

                    
                        

                    /*
                    $('#coincompare').append("<p>Coin name: " + data.name + "</p>" +
                    "<p>Coin symbol: " + data.symbol + "</p>" +
                    "<p>Coin slug: " + data.slug + "</p>" +
                    "<p>Coin Circulating Supply: " + data.circulating_supply + "</p>" +
                    "<p>Coin Total Supply: " + data.total_supply + "</p>" +
                    "<p>Coin Price: " + data.price + " USD</p>" +
                    "<p>Coin Volume 24h: " + data.volume_24h + "</p>" +
                    "<p>Coin Percent Change 1h: " + data.percent_change_1h + "</p>" +
                    "<p>Coin Percent Change 24h: " + data.percent_change_24h + "</p>" +
                    "<p>Coin Percent Change 7d: " + data.percent_change_7d + "</p>" +
                    "<p>Coin Percent Change 30d: " + data.percent_change_30d + "</p>" +
                    "<p>Coin Market Cap: " + data.market_cap + "</p>" +
                    "<p>Last Updated: " + data.last_updated + "</p>"); */
                    }
                });
            });


            


        });

    
    </script>
<section id="coin1" style="display: none">
    <div id="coin-search">
        <div class="autocomplete">
            <p><label for="coins">Select a coin:</label></p>
            <p><input id="coins"><input type="hidden" id="hiddenIdCMC" name="hiddenIdCMC" /></p>
        </div>
    </div>
</section>

<section id="coin2" style="display: none">
    <div id="coin-search2">
        <div class="autocomplete">
            <p><label for="coins2">Select other coin:</label></p>
            <p><input id="coins2"><input type="hidden" id="hiddenIdCMC2" name="hiddenIdCMC2" /></p>
        </div>
    </div>
</section>


<section style="text-align: center; margin-bottom: 10%; display: none;" id="coincompare">
    

    
</section>
<?php    

/*
use App\Models\User;

$user =User::select('name')->where('id',30)->get();
$gid=$user->where('id',50);
foreach ($user as $username){
echo $username['name'] . "<br />";
}

*/


?>

@endsection