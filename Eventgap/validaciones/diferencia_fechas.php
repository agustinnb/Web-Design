<?php
function diferencia_fechas($diferencia){
 $segundos = $diferencia % 60;
 $segundos = str_pad($segundos, 2, "0", STR_PAD_LEFT);
 $diferencia = floor($diferencia / 60);
 $minutos = $diferencia % 60;
 $minutos = str_pad($minutos, 2, "0", STR_PAD_LEFT);
 $diferencia = floor($diferencia / 60);
 $horas = $diferencia;
 $cadena = $horas.":".$minutos.":".$segundos;
 return $cadena;
}

?>