<?php
namespace App\View\Helper;

use Cake\View\Helper;

class FechaHelper extends Helper
{
  /*
   * Power by nicolaspar 2007 - especific proyect
   * Example:
   * get_date_spanish(time(), true, 'month'); # return Enero
   * get_date_spanish(time(), true, 'month_mini'); # return ENE
   * get_date_spanish(time(), true, 'Y'); # return 2007
   * get_date_spanish(time());#return 06 de septiempre, 12:31 hs
   *
  */
  	function get_date_spanish( $time, $hidetime = false ){
  		#Declare n compatible arrays
  	    $month = array("","Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiempre","Octubre", "Noviembre", "Diciembre");#n
  	    $month_execute = "n"; #format for array month

  	    $month_mini = array("","ENE", "FEB", "MAR", "ABR", "MAY", "JUN", "JUL", "AGO", "SEP", "OCT", "NOV", "DIC");#n
  	    $month_mini_execute = "n"; #format for array month

  	    $day = array("Domingo","Lunes","Martes","Mi&eacute;rcoles","Jueves","Viernes","S&aacute;bado"); #w
  	    $day_execute = "w";

  	    $day_mini = array("DOM","LUN","MAR","MIE","JUE","VIE","SAB"); #w
  	    $day_mini_execute = "w";

  	/*
  	Other examples:
  	    Whether it's a leap year
  	    $leapyear = array("Este año febrero tendrá 28 días"."Si, estamos en un año bisiesto, un día más para trabajar!"); #l
  	     $leapyear_execute = "L";
  	*/

  	    #Content array exception print "HOY", position content the name array. Duplicate value and key for optimization in comparative
  	    $print_hoy = array("month"=>"month", "month_mini"=>"month_mini");

  	    if( $hidetime  ){
  	        return $this->output($day[idate("w", $time)].' '. idate("d", $time) .' de '. $month[idate("m",$time)] .' del  '.idate("Y",$time));
  	    }else{
  	    	return $this->output($day[idate("w", $time)].' '. idate("d", $time) .' de '. $month[idate("m",$time)] .' del  '.idate("Y",$time) .' a las '. date("h:i a",$time));
  	    }
  	}
}
