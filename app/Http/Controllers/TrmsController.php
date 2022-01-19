<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Trm;

class TrmsController extends Controller
{
    public function getTrm () {
        $soap = new \soapclient("https://www.superfinanciera.gov.co/SuperfinancieraWebServiceTRM/TCRMServicesWebService/TCRMServicesWebService?WSDL", array(
            'soap_version'   => SOAP_1_1,
            'trace' => 1,
            "location" => "http://www.superfinanciera.gov.co/SuperfinancieraWebServiceTRM/TCRMServicesWebService/TCRMServicesWebService",
        ));
        $response = $soap->queryTCRM(array('tcrmQueryAssociatedDate' => date("Y-m-d")));
        $response = $response->return;
        
        if($response->success){
           $Trm         = new Trm;
           $Trm->moneda ='USD';
           $Trm->fecha  = $response->validityFrom;
           $Trm->trm    = $response->value;
           $Trm->save();
        }
        // https://themewp.inform.click/es/api-de-tipos-de-cambio-con-conversion-de-moneda-en-php/
    }


}
