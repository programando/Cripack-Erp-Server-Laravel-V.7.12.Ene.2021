<?php
namespace App\Helpers;

class Folders {

     /** * MARZO 18 2018.  Retorna ruta base para el almacenamiento de imagenes */
    public static function UserImages() {
       return   asset('storage/images/users/');
    }

     /** * MARZO 18 2018.  Retorna ruta base para el almacenamiento de imagenes */
      public static function Images() {
       return   asset('storage/images/');
    }

    public static     function ImagesApp( ) {
                return    asset('storage/images/app/');
   }

}


