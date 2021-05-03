<?php
//app/Helpers/Envato/User.php
namespace App\Helpers;

class Strings {
        /**
         * MARZO 16 2018
         * Retorna un string sin espacios extenos e internos, con la longitus indicada
         */
    public static function UpperTrim( $String, $Long ) {
        $String = trim( $String );
        $String = preg_replace('/\s\s+/', ' ', $String  );
        $String = substr($String, 0, $Long  );
        $String = mb_strtoupper( $String,'UTF-8');
        return $String;
    }

}
