<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

 use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class TercerosWeb extends  Authenticatable
{
	use Notifiable;
 
	protected $table = 'terceros_web';
	protected $primaryKey = 'idregistro';

	protected $casts = [
		'idtercero' => 'int',
		'password_updated' => 'bool',
		'uso_web_empresa' => 'bool',
		'inactivo' => 'bool'
	];

	protected $dates = [
		'tmp_token_expira'
	];

	protected $hidden = [
		'password',
		'remember_token',
		'tmp_token'
	];

	protected $fillable = [
		'idtercero',
		'email',
		'password',
		'password_updated',
		'uso_web_empresa',
		'remember_token',
		'tmp_token',
		'tmp_token_expira',
		'inactivo'
	];

  		public function setPasswordAttribute ( $value ){
					$this->attributes['password'] = Hash::make( $value );
			}
			
			
			public static function getDatosEmpresaUsuario( $Idregistro ) {
						return     DB::select('call api_terceros_consulta_x_datos_usuario( ?)', array ($Idregistro) );
			}
			
			 

}
