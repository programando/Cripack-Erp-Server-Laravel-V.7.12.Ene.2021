<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Route;

class TercerosUsersWebRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $currentRouteName = Route::currentRouteName();
        if ( $currentRouteName == 'login')                  {  return $this->loginvalidate();       }
        if ( $currentRouteName == 'reset-password')         {  return $this->resetPassword();       }
        if ( $currentRouteName == 'update-password')        {  return $this->updatePassword();      }
        if ( $currentRouteName == 'contactWebRegister')     {  return $this->registerValidate();      } 
        if ( $currentRouteName == 'contactMessage')         {  return $this->contacValid();      } 
    }

   private function contacValid () {
      return [
              'contacto' => ['required'],
              'asunto'   => ['required'],
              'email'    => ['email','required'],
              'mensaje'  => ['required']
      ];
   }

     private function registerValidate () {
          return [
               'password'  => ['min:6','required','confirmed'],
               'idtercero' => ['required']
          ];      
     }
     
     private function loginvalidate(){
          return [
                'email'       => ['required', 'email','exists:terceros_web'],
                'password'    => ['required','min:6'],
        ];
    }

      private function resetPassword(){
            return [
                  'email'  => ['required', 'email','exists:terceros_web'],
          ];
      }

    private function updatePassword() {
          return [
                  'password'  => ['required','confirmed','min:6'],
          ];
    }



    public function messages()
    {
      return [
        'email.exists'       => 'Cuenta de correo (Email) no encontrada en nuestros registros.',
        'password.confirmed' => 'La contraseña y su confirmación no son iguales.',
        'password.required'  => 'La contraseña y su confirmación son campos obligatorios.',
        'password.min'       => 'La contraseña debe tener al menos 6 caracteres.',
        'idtercero.required' => 'Registre el número de identificación de la empresa',
        'contacto.required'  => 'Debe indicar la persona de contacto',
        'asunto.required'    => 'Por favor indique el asunto o motivo de su mensaje',
        'email.required'     => 'El correo electrónico es un dato requerido',
        'mensaje.required'   => 'Por favor describa los detalles del motivo de su consulta'
        
      ];
    }

}
