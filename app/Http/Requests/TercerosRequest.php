<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Route;
class TercerosRequest extends FormRequest
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
        if ( $currentRouteName == 'otsCustomerRegister')    {  return $this->identificationValidate();       }
    }


        private function identificationValidate () {
         return [ 
                    'identificacion'       => ['exists:terceros']   
                ]; 
          
    }
  
      public function messages()
    {
      return [
            'identificacion.exists'       => ' Identificación de cliente no registrada en nuestra base de datos.',   
      ];
    }
 
}
