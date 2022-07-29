<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TroquelPlanoRequest extends FormRequest
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
          return [
               'referencia'  => ['required'],
               'cabida'  => ['required'],
               'id_maquina'  => ['required'],
               'id_frecuencia'  => 'required|numeric|min:0',
                
          ];
    }

        public function messages()
    {
      return [
        'referencia.required'    => 'referencia requerida',
        'cabida.required'        => 'cabida requerida',
        'id_maquina.required'    => 'Seleccione máquina',
        'id_frecuencia.required' => 'Frecuencia requerida',
        'id_frecuencia.min'      => 'Frecuencia requerida',
        
        
      ];
    }
}
