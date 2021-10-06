<?php

namespace App\Http\Controllers;

use Str;
use Cache;
use Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
//--
use App\Models\Tercero as Terceros;
use App\Models\TercerosWeb as Users;
use App\Models\TercerosWebActividades as TercerosActividades;
//--
use Illuminate\Support\Facades\Auth;
//--
use Illuminate\Support\Facades\Lang;
use App\Events\Terceros\UsersWebEvent;
//--

use App\Http\Requests\TercerosRequest;
use App\Events\Terceros\UsersContactUsEvent;
use App\Http\Requests\TercerosUsersWebRequest;
use Illuminate\Validation\ValidationException;


class TercerosUsersWebController extends Controller
{
   
    public function contactMessage ( TercerosUsersWebRequest $FormData ) {
        UsersContactUsEvent::dispatch( $FormData );
    }

    public function contactWebRegister( TercerosUsersWebRequest $FormData) {
        $userWeb = new Users;
        $userWeb->email            = $FormData->email ;
        $userWeb->idtercero        = $FormData->idtercero ;
        $userWeb->password         = $FormData->password ;
        $userWeb->password_updated = true ;
        $userWeb->save();
        TercerosActividades::saveActivity( $FormData->idtercero , 1, 'NUEVO REGISTRO' );         
         return response()->json('Ok', 200); 
    }

    public function searchContactsWithOutWebRegister ( TercerosRequest $FormData ) {
            $Contacts = Terceros::searchContactsWithOutWebRegister($FormData->identificacion ) ;
            return $Contacts;
    }

    public function login ( TercerosUsersWebRequest  $FormData ){         
         if ( $this->isPasswordUpdated ($FormData ) == false ) {
             $this->ErrorMessage ( Lang::get("validation.custom.UserLogin.credencials-error") );
             return [];
         }
         if (Auth::attempt( ['email' => $FormData->email, 'password' => $FormData->password  ], true ) ) { // true al final es para recordar sessión    
              $DatosEmpresaUsuario = Users::getDatosEmpresaUsuario ( Auth::user()->idregistro); 
              TercerosActividades::saveActivity( Auth::user()->idtercero, 5, 'INGRESO SISTEMA' );         
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

    public function resetPassword ( TercerosUsersWebRequest $FormData ){
        $User = Users::where('email', $FormData->email)->first();      
        if ( !$User || $User->inactivo ) {
            $this->ErrorMessage (  Lang::get("validation.custom.UserLogin.inactive-user") );
            return ;
        }  
        $User->tmp_token        = Str::random(100);
        $User->tmp_token_expira = Carbon::now()->addMinute(15) ;
        $User->save();
        UsersWebEvent::dispatch( $User->email, $User->tmp_token);
        TercerosActividades::saveActivity( $User->idtercero, 6, 'CAMBIO CONTRASEÑA - SOLICITUD' );         
        return response()->json('Ok', 200);  
    }
    
    public function updatePassword ( TercerosUsersWebRequest $FormData ){
        $User = Users::where('tmp_token', $FormData->token)->first();
  
        $this->tokenValidate           ( $User  );
        $this->tokenExpirationValidate ( $User  );

        $User->password         = $FormData->password;
        $User->remember_token   = '';
        $User->tmp_token        = '';
        $User->password_updated = true;
        $User->save();
        TercerosActividades::saveActivity( $User->idtercero, 7, 'CAMBIO CONTRASEÑA - ACTUALIZACIÓN' );         
       return response()->json('Ok', 200); 

    }

        private function tokenValidate ( $User ){
            if ( !$User) {
                throw ValidationException::withMessages( [
                    'tokenError' => 'Token no válido',
                    'password' =>   'El token de validación ha expirado o no es válido. No se ha podido validar identidad del usuario. Por favor inicie el proceso nuevamente.'  ,
                    'status'   => 422
                ]);             
            }
        }

        private function tokenExpirationValidate ( $User ) {
            $Expiracion = $User->tmp_token_expira;
            $Diferencia = $Expiracion->diffInMinutes();
            if (  $Diferencia > 15 ) {
                throw ValidationException::withMessages( [
                    'tokenError' => 'Token sin vigencia',
                    'password' =>   'El token de validación ha expirado o no es válido. No se ha podido validar identidad del usuario. Por favor inicie el proceso nuevamente.'  ,
                    'status'   => 422
                ]);             
            }
        }

       public function logout( Request $FormData){ 
            Session::flush();
            Cache::flush();
            Auth::logout();
            TercerosActividades::saveActivity( $FormData->idtercero, 8, 'SALIDA SISTEMA' );         
        }


    private function ErrorMessage ( $ErrorTex ) {
        throw ValidationException::withMessages( [
            'email' =>  [$ErrorTex  ]
        ]);
    }
}
