<!DOCTYPE html>
<html lang="en" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
  <meta charset="utf-8">
  <meta name="x-apple-disable-message-reformatting">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="format-detection" content="telephone=no, date=no, address=no, email=no">
  <!--[if mso]>
    <xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch></o:OfficeDocumentSettings></xml>
    <style>
      td,th,div,p,a,h1,h2,h4,h4,h5,h6 {font-family: "Segoe UI", sans-serif; mso-line-height-rule: exactly;}
    </style>
  <![endif]-->
    <title>Cripack - Servicio al cliente</title>
</head>

<body style="font-size: 12px; margin: 0; padding: 0; width: 60%; word-break: break-word; -webkit-font-smoothing: antialiased; background-color: #fff;">
 
  <div role="article"  lang="en">
    <header style="display: flex; margin: 0 40px;">
      <div style="font-size: 12px;">
       
        <h4>Señores:</h4>
        <h4 style="margin-top: 20px; margin-bottom: 0px; font-size:12px;"> {{ $Empresa }}</h4>
        
        
        <br><br> 
      </div>
    </header> 
    <aside style="margin: 0 40px; margin-top: 50px;">
      <div>
        <h4 style="font-weight: 300;">Cordial saludo,</h4>
        <br><br>
        <h4 style="font-weight: 300;">
        Con corte a: {{ date('d-M-Y') }}, nuestro sistema identifica ordenes de trabajo pendientes por facturar. Solicitamos generar y enviar las respectivas órdenes de compra al correo: 
        {{ config('company.EMAIL_AUXCONTABLE') }}, con el fin de continuar el trámite respectivo de facturación. <br><br><br>
        
        </h4>
      </div>
 
       <table   width="100%">
      <thead  style="text-align: center; color: #fff; background-color: #272C6B; height:25px;">
        <tr>
          <th>&nbsp;#&nbsp;</th>
          <th style="text-align: center;">Ord.Trabajo</th>
          <th>&nbsp;Tipo Trabajo&nbsp;</th>
          <th>Referencia</th>
          <th>&nbsp;(*&nbsp;)Días &nbsp;</th>
          <th>&nbsp;Cotización&nbsp;</th>
          <th>Precio</th>
        </tr>
      </thead>
      <tbody  >
             {!! $BodyTable !!}
      </tbody>
      </table>

 
 
    </aside>
        <div style="margin: 0 40px; margin-top: 50px;">
      <h4 style="font-weight: 400;">
        <span>
        <br><br><br>
            (*) Días   = Días transcurridos desde la última solicitud de orden de compra. <br>Después de 10 días sin respuesta, nuestro sistema bloquerá automáticamente el registro de nuevos trabajos.
        </span>
        </h4>
    </div>

    <div style="margin: 0 40px; margin-top: 50px;">
      <h4 style="font-weight: 500;">
      <span>
        <br><br><br>
       Cordialmente,</span></h4>
    </div>
  </div>
  
  <footer>
    <br><br><br><br><br><br>
    <img src="{{ asset('storage/images/firmas/serviclientes.png') }}" alt="Firma corporativa">
  </footer>

</body>
</html>