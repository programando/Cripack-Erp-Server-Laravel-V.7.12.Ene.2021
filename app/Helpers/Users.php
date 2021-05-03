<?php

namespace App\Helpers;
use Illuminate\Support\Facades\DB;
use Cache;
class Users {

    public static function Name( $Id_Terc) {
       $nom_user  = Cache::tags('Username')->rememberForever('UserName', function( ) use ( $Id_Terc) {
          $user = DB::table('terceros')->where('id_terc', $Id_Terc)->first();
          return (isset($user->pnombre) ? $user->pnombre : 'No reconocido');
      });
      return $nom_user;
    }


    public static function User(){
        return auth()->user();
    }

    public  static function getIdTercero(){
       $id_terc  = Cache::tags('UserId')->rememberForever('UserId', function() {
          return    auth()->user()->id_terc;
       });
       return  $id_terc;
    }

}
