<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use App\Models\DocumentacionProcesosArchivo as Archivos;


class DocumentacionProcesosArchivosController extends Controller
{
     public function getArchivosLecturaWeb () {
         return Archivos::where('cnslta_web','1')->get();
     }

     public function downloadFile ( $File ) {
        // $File =  config('company.FTP_HOST')."/$File";
         
        return   Storage::disk('ftp')->get( $File  ) ;

         return  Storage::disk('ftp')->download( $File );
     }







}
