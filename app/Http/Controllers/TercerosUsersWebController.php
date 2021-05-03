<?php

namespace App\Http\Controllers;

use Str;
use Cache;
use Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\TercerosWeb as Users;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use App\Http\Requests\TercerosUsersWebRequest;
use Illuminate\Validation\ValidationException;

class TercerosUsersWebController extends Controller
{
   
    public function login ( TercerosUsersWebRequest  $FormData ){
          
         if ( $this->isPasswordUpdated ($FormData ) == false ) {
             $this->ErrorMessage ( Lang::get("validation.custom.UserLogin.credencials-error") );
             return ;
         }

         if (Auth::attempt( ['email' => $FormData->email, 'password' => $FormData->password  ], true ) ) { // true al final es para recordar sessión    
              $DatosEmpresaUsuario = Users::getDatosEmpresaUsuario ( Auth::user()->idregistro);
              return response()->json( $DatosEmpresaUsuario, 200);
        }     
        $this->ErrorMessage ( Lang::get("validation.custom.UserLogin.credencials-error") );
    }

    /* APRIL 28 2012
        VERIFICA QUE EL PASSWORD NO HA SIDO ACTUALIZADO. SI ES IGUAL SE ACTUALIZA.
    */
    private function isPasswordUpdated( $FormData ) {
        $User = Users::where('email', $FormData->email)->first();
        if ( !$User )                           return false;
        if ( $User->password_updated == true )  return true;

        $dbPassword = trim($User->password);
        $md5Password = md5($FormData->password );

        if ( $dbPassword === $md5Password ) {
            $User->password = $FormData->password ;
            $User->password_updated = true;
            $User->save();
            return true;
        } else {
            return false;
        }

    }

       public function logout(){ 
            Session::flush();
            Cache::flush();
            Auth::logout();
            
    }


    private function ErrorMessage ( $ErrorTex ) {
        throw ValidationException::withMessages( [
            'email' =>  [$ErrorTex  ]
        ]);
    }
}
