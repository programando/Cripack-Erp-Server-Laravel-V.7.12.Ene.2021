<?php
namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Pagination\LengthAwarePaginator;

class Arrays {

  /*JUNIO 08 2021.         DEVUELVE ID's UNICOS DE UN ARRAY.  */
    public static function getUniqueIdsFromArray ( $Array, $IdFieldReference ){
        return array_unique( Arr::pluck($Array , $IdFieldReference ) );
    }
   
    /* JUNIO 02.        CREA TABLA A PARTIR DE ARRAY PARA INCLUIR EN LOS CORREOS   */
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

    /*JUNIO 01 2021.         DEVUELVE FILAS UNICAS DE UN ARRAY.  */
    public static function getUniqueRowsFormArray( $Array, $key) {
      $uniqueColumn = array_unique(array_column($Array, $key));
      $uniqueArray  = array_intersect_key($Array, $uniqueColumn);
     return $uniqueArray;

    }

    /*JUNIO 01 2021.         EXTRAE EMAIL UNICOS DE UN CONJUNTO DE DATOS TENIENDO EN CUENTA $key(campo de comparación) */
   public static function getEmailsFromArray( $DataArray, $fieldCompare, $Key ) {
       $Emails = [];
       foreach ($DataArray as $Data) {
            if (  $Data->$fieldCompare == $Key ) {
                array_push ($Emails, trim($Data->email) );
            }
        } //forDataArray 
        array_push ($Emails, config('company.EMAIL_SERVICLIENTES'));
        return  array_values( array_unique($Emails));
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
