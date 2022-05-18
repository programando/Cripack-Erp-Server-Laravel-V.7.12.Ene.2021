<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EvlcionDsmpnioCmncconesViaEmail ;
use  App\Events\Empleados\EvaluacionDesempenioEvent ;
use DB;


class TercerosEvaluacionDesepenioController extends Controller
{
    public function enviarComunicaciones () {
        $Registros =  DB::select('call evlcion_dsmpnio_cmnccones_via_email_consulta()');
        foreach ( $Registros as $Registro ) {
            EvaluacionDesempenioEvent::dispatch( $Registro) ;
        }

        
        /*$Registros = DB::table('evlcion_dsmpnio_cmnccones_via_email as Emails')
            ->join('terceros', 'terceros.idtercero','=', 'Emails.idtercero')
            ->where('Emails.inactivo','0')
            ->select('Emails.idregistro', 'Emails.observacion','Emails.aprobada','terceros.nomtercero', 'terceros.email_crprttvo')
            ->get();
        */

      //  return $Registros;


/* idregistro
idtercero
fecha
observacion
aprobada
inactivo
*/

       //return EvlcionDsmpnioCmncconesViaEmail::with('Terceros:nomtercero,email_crprttvo')->where('inactivo','0')
        //->select('terceros')
        //->get();
    }
}
