<?php 
namespace App\Helpers;

use Illuminate\Pagination\LengthAwarePaginator;

class Utilities {
 
   
    public static function buildTableOtsReferenciaToEmail ($ArrayOts, $fieldCompare, $key ) {
        $Tabla = '';
        $Num = 1;
        foreach ($ArrayOts  as $OT) {
           if ($OT->$fieldCompare ==  $key)  {
                    $Tabla =  $Tabla ."<tr>"  ;
                    $Tabla = $Tabla . "<td>" . $Num       . "</td>" ;
                    $Tabla = $Tabla . "<td>" . $OT->numero_ot          . "</td>" ;
                    $Tabla = $Tabla . "<td>" . trim($OT->nomestilotrabajo)   . "</td>" ;
                    $Tabla = $Tabla . "<td>" . trim($OT->referencia )        . "</td>" ;
                    $Tabla = $Tabla . '</tr>';
                    $Num++;
           }
        } // foreach $ArrayOts
        return   $Tabla;
    }

    public static function getUniqueValuesFormArray( $Array, $key) {
      $uniqueColumn = array_unique(array_column($Array, $key));
      $uniqueArray  = array_intersect_key($Array, $uniqueColumn);
     return $uniqueArray;

    }


   public static function getEmailsFromArray( $DataArray, $fieldCompare, $Key ) {
       $Emails = [];
       foreach ($DataArray as $Data) {
            if (  $Data->$fieldCompare == $Key ) {
                array_push ($Emails, trim($Data->email) );
            }
        } //forDataArray 
        array_push ($Emails, config('company.EMAIL_SERVICIO_CLIENTES'));
        return  array_values( array_unique($Emails));
     }
 
 
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

        /**
         * MAYO 02 2021
         * Incluye paginación laravel para el resultado de una consulta desde un procedimiento almancenado.
         */
   public static function arrayPaginator( $Data, $Request) {
        // Define how many items we want to be visible in each page
        $perPage = 150;
       // Get current page form url e.x. &page=1
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        // Create a new Laravel collection from the array data
        $itemCollection = collect($Data);
        // Slice the collection to get the items to display in current page
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
        // Create our paginator and pass it to the view
        $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
        // set url path for generted links
        $paginatedItems->setPath($Request->url());
        return $paginatedItems;      
   }

}
