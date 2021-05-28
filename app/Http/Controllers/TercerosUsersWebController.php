<?php

namespace App\Http\Controllers;

use Str;
use Cache;
use Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\TercerosWeb as Users;
use App\Models\Tercero as Terceros;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use App\Events\TercerosUsersWebEvent;
use App\Http\Requests\TercerosUsersWebRequest;
use App\Http\Requests\TercerosRequest;
use Illuminate\Validation\ValidationException;

class TercerosUsersWebController extends Controller
{
   
    public function searchContactsWithOutWebRegister ( TercerosRequest $FormData ) {
            $Tercero = Terceros::searchContactsWithOutWebRegister($FormData->identificacion ) ;

            return $Tercero;
    }

    public function login ( TercerosUsersWebRequest  $FormData ){         
         if ( $this->isPasswordUpdated ($FormData ) == false ) {
             $this->ErrorMessage ( Lang::get("validation.custom.UserLogin.credencials-error") );
             return [];
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

    public function resetPassword ( TercerosUsersWebRequest $FormData ){
        $User = Users::where('email', $FormData->email)->first();
        if ( !$User || $User->inactivo ) {
            $this->ErrorMessage (  Lang::get("validation.custom.UserLogin.inactive-user") );
        }  
        $User->tmp_token        = Str::random(100);
        $User->tmp_token_expira = Carbon::now()->addMinute(15) ;
        $User->save();
        TercerosUsersWebEvent::dispatch( $User->email, $User->tmp_token);
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
