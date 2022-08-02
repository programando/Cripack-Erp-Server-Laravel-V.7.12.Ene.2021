<?php

namespace App\Helpers;

class NumbersHelper {


   public static function jsonFormat( $value, $decimals=0) {
      return number_format ( $value, $decimals, '.', '');
   }

   public static function invoiceFormat($value) {
      return number_format( $value, 0, ",", ".");
   }

}
?>