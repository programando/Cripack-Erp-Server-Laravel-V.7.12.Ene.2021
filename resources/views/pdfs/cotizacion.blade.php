<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>CRIPACK S.A.S.</title>
   <style>
    @page           { size:1910pt 2467pt; }
    *               { margin:0; padding:0; }
    html            { margin:0; padding:0; font-family:Arial, Helvetica, sans-serif; font-size:20pt; line-height:20pt; }
    table, tr, td   { margin:0; padding:0; border:0; border-spacing:0; }
    .pagion         { padding:55pt 75pt 0 75pt; }
    .colorfff       { color:#000; }
    .bAzul          { background-color:#EEEEEE; }
    .h60            { height:60pt;}
    .taC            { text-align:center;}
    .taR            { text-align:right;}
    .tB             { font-weight:bold;}
    .t18            { font-size:18pt; line-height:18pt; }
    .t24            { font-size:24pt; line-height:24pt; }
    .t26            { font-size:26pt; line-height:26pt; }
    .t32            { font-size:32pt; line-height:32pt; }
    .t34            { font-size:34pt; line-height:34pt; }
    .t36            { font-size:36pt; line-height:36pt; }
    .t38            { font-size:38pt; line-height:38pt; }
    .t40            { font-size:40pt; line-height:40pt; }
    .mb3            { margin-bottom:3pt; }
    .mb10           { margin-bottom:10pt; }
    .mb15           { margin-bottom:15pt; }
    .mb40           { margin-bottom:40pt; }
    .p105           { padding:20pt 8pt; }
    .p128           { padding:12pt 8pt; }
    .p5             { padding:5pt 8pt; }
    .p8             { padding:8pt; }
    .p10            { padding:10pt; }
    .p20            { padding:20pt; }
    .linea          { height:5pt; }
    .bS1            { border:2pt solid #333; }
    .bRS1           { border-right:1pt solid #333; }
    .bBS1           { border-bottom:2pt solid #333; }
    .bTS1           { border-top:2pt solid #333; }
    .bB0            { border-bottom:none; }
    .bRad           { border-radius:10pt; }
    .bRad1          { border-radius:10pt 10pt 0 0; }
    .bRad2          { border-radius:0 0 10pt 10pt; }
    .vatop          { vertical-align:top;}
</style>

  </head>
  <body>
 
  
<div>
    <div class="pagion">
        <table width="100%" class="mb40">
            <tr>
                <td width="30%">
                   <img src="https://drako.api.plusoft.co/storage/images/drako/logo.jpg" alt="">              
                </td>
              
                <td width="40%" class="taC">
                    <div class="t38 tB"> CRIPACK S.A.S </div>
                    <div class="t24 mb10"  >NIT 800.149.062-1</div>
                    <div class="t24 mb10" >Carrera 6 # 21 - 44 </div>
                    <div class="t24 mb10" >Código Postal 760044 Cali - Colombia</div>
                    <div class="t24 mb10" >(57)(602) 387 3164 </div>
                    <div class="t24 mb10" >Cel. 315 270 1964 </div>
                    
                </td>
                 <td width="30%" class="taR">
                    <div class="t24"> </div>
                    <div > </div>
                    <div> &nbsp; </div>
                    <div>&nbsp; </div>  
                    <div> &nbsp;</div>
                    <div> &nbsp;</div>
                </td>

            </tr>
        </table>

        <div class="bAzul linea mb40"></div>

        <table width="100%" class="mb40">
            <tr>
                <td width="30%">
                    <div class="bAzul bS1 bRad1 bB0">
                        <table width="100%" class="taC colorfff tB">
                            <tr>
                                <td class="p8 bRS1">Fecha documento</td>
                            </tr>
                        </table>
                    </div>
                    <div class="bS1 bRad2">
                        <table width="100%" class="taC">
                            <tr>
                                <td width="33%" class="p5 bRS1"> {{ date('d')}}  </td>
                                <td width="33%" class="p5 bRS1"> {{ date('Mm')}}  </td>
                                <td width="34%" class="p5 bRS1"> {{ date('Y')}}  </td>
                            </tr>
                        </table>
                    </div>
                </td>
                <td></td>

                <td width="30%">

                </td>

                <td></td>
                <td width="35%">
                    <div class="t26 taC mb3"><strong> COTIZACIÓN </strong> </div>
                    <div class="p8 bS1 bRad tB taC t32"> {{ $Cotizacion[0]->nro_cotizacion}}  </div>
                </td>
            </tr>
        </table>

        <div class="bS1 bRad p20 mb40">
            <table width="100%"  >
                <tr >
                    <td width="10%" class="p5 tB">Cliente :</td>
                    <td width="35%" class="p5"> {{ $Cotizacion[0]->nomtercero}} </td>
                    <td width="10%" class="p5 tB">N.I.T.:</td>
                    <td width="25%" class="p5"> {{ $Cotizacion[0]->identificacion}}</td>
                </tr>
                <tr>
                    <td width="10%" class="p5 tB">Dirección:</td>
                    <td width="25%" class="p5">{{ $Cotizacion[0]->despacho}} </td>
                    <td width="10%" class="p5 tB">Municipio:</td>
                    <td width="35%" class="p5">{{ trim( $Cotizacion[0]->nommcipio ) . ' ' . trim($Cotizacion[0]->nomdpto ) }}   </td>
                    <td width="10%" class="p5 tB">Teléfono :</td>
                    <td width="10%" class="p5">{{ $Cotizacion[0]->telefono}} </td>
                </tr>
 

            </table>
        </div>

 

        <div class="bS1 bRad mb40">
            <table width="100%" class="bAzul taC colorfff tB">
                <tr>
                    <td width="40%" class="p8 bRS1">REFERENCIA</td>
                    <td width="15%" class="p8 bRS1">ESTILO</td>
                    <td width="10%" class="p8 bRS1">TRABAJO</td>
                    <td width="30%" class="p8 bRS1">MATERIAL</td>
                    <td width="5%" class="p8 bRS1">CAB</td>
                    <td width="5%" class="p8 bRS1">ENC</td>
                    <td width="6%" class="p8 bRS1">CANT</td>
                    <td width="10%" class="p8 bRS1">PRECIO</td>
                    <td width="14%" class="p8 bRS1">SUBTOTAL</td>
                </tr>
            </table>
            <table width="100%">
                 
  

                    <tr>
                        <td width="40%" class="p128 bRS1 ">     {{ $Cotizacion[0]->referencia}}    </td>
                        <td width="15%" class="p128 bRS1 ">     {{ $Cotizacion[0]->nomestilotrabajo}}     </td>
                        <td width="10%" class="p128 bRS1">      {{ $Cotizacion[0]->nomtipotrabajo}}    </td>
                        <td width="30%" class="p128 bRS1 ">     {{ $Cotizacion[0]->nommaterial}} </td>
                        <td width="5%" class="p128 bRS1 taR">   {{ $Cotizacion[0]->cabida}}   </td>
                        <td width="5%" class="p128 bRS1 taR">   {{ $Cotizacion[0]->ctzacion_encauche}}   </td>
                        <td width="6%" class="p128 bRS1 taR">   {{ $Cotizacion[0]->cantidad}} </td>
                        <td width="10%" class="p128  bRS1 taR"> {{ number_format( $Cotizacion[0]->ctzacion_precio_unitario, 0, ",", ".")}}     </td>
                        <td width="14%" class="p128 bRS1 taR">   {{ number_format($Cotizacion[0]->ctzacion_precio_unitario * $Cotizacion[0]->cantidad)}}    </td>
                         
                    </tr>
                
 
            </table>
            

            <table class="bTS1" width="100%">
                <tr class="vatop">

                    <td width="80%" class="p128 bRS1">
                    <div class="mb15">
                       <div >
                            OBSERVACIONES : <br><br>
                            <p>Condiciones de pago : <span> {{ $Cotizacion[0]->nomformapago}}  </span> </p>
                            <p>Fecha de entrega a convenir</p>
                        </div>
                    </td>

                <td width="20%">
                        <table width="100%">
                            <tr>
                                <td width="50%" class="p10 tB bRS1 bBS1">SUBTOTAL :</td>
                                <td width="55%" class="t20 tB p10 bBS1 taR">{{ number_format($Cotizacion[0]->ctzacion_precio_unitario * $Cotizacion[0]->cantidad)}} </td>
                            </tr>
                        </table>
                                           
                        <table width="100%">
                            <tr>
                                <td width="50%" class="p10 tB bRS1 bBS1">IVA</td>
                                <td width="55%" class="t20 tB p10 bBS1 taR"> {{ number_format($Cotizacion[0]->ctzacion_precio_unitario * $Cotizacion[0]->cantidad * $Cotizacion[0]->iva )}}</td>
                            </tr>
                        </table>
                        <table width="100%">
                            <tr>
                                <td width="50%" class="p10 tB bRS1">TOTAL</td>
                                <td width="55%" class="t20 tB p10 taR"></td>
                            </tr>
                        </table>
                    </td>

                </tr>
            </table>
           
        </div>
 <br><br><br>
 

        <div class="h60"></div>



    </div>
</div>



  </body>
</html>