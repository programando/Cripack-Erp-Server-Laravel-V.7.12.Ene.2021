<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 
use Illuminate\Support\Facades\Storage;
use App\Models\DocumentacionProcesosArchivo as Archivos;

use Response;

class DocumentacionProcesosArchivosController extends Controller
{
     public function getArchivosLecturaWeb () {
         return Archivos::where('cnslta_web','1')->get();
     }

     public function downloadFile ( Request $FormData) {
     
        $File = $FormData->get('pdfFile');   
        $path = Storage::disk('GestionDocumentalEmpresa')->path($File );
        
        return Response::make(file_get_contents($path), 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="'.$File.'"'
        ]);

     } 




 



}
