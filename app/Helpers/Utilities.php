<?php 
namespace App\Helpers;



class Utilities { 
        /**
         * MAYO 02 2021
         * Toma una URL y retorna de forma única su composición.
         */
    public static function getUrlUniqueName(   ) {
         $url         = request()->url();
         $queryParams = request()->query();
         ksort($queryParams);                                   //Se ordenan los parámetros de URL (actua por referencia)
        $queryString = http_build_query($queryParams);          //Convirtiendo el arreglo en un query string
        return  "{$url}?{$queryString}";
    }

 

}
