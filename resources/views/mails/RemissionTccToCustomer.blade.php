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
      td,th,div,p,a,h1,h2,h3,h4,h5,h6 {font-family: "Segoe UI", sans-serif; mso-line-height-rule: exactly;}
    </style>
  <![endif]-->
    <title>Cripack - Despachos TCC</title>
</head>
<body style="margin: 0; padding: 0; width: 100%; word-break: break-word; -webkit-font-smoothing: antialiased; background-color: #fff;">
 
  <div role="article" aria-roledescription="email" aria-label="Confirm your email address" lang="en">
    <header style="display: flex; margin: 0 40px;">
      <div style="font-size: 14px;">
       
        <h3>Señores:</h3>
        <h3 style="margin-top: 20px; margin-bottom: 0px;"> {{ $Empresa }}</h3>
        <h3 style="margin-top: 0; margin-bottom: 0;"> {{ $Contacto }}</h3>
        <br><br>
      </div>
    </header> 
    <aside style="margin: 0 40px; margin-top: 50px;">
      <div>
        <h3 style="font-weight: 500;">Apreciados Señores,</h3>
        <br><br><br>
        <h3 style="font-weight: 500;">Con guia Número: 
        <span style="color: blue; font-weight: 900;">
            <a href="{{ $TccRastreo }}"><strong>{{ $TccNroGuia }} </strong></a> 
        </span> de TCC hemos despachado lo siguiente:</h3>
      </div>
 
       <table   width="100%">
      <thead  style="text-align: center; color: #fff; background-color: #272C6B; height:25px;">
        <tr>
          <th>#</th>
          <th>Núm.Orden Trabajo</th>
          <th>Tipo Trabajo</th>
          <th>Referencia</th>
        </tr>
      </thead>
      <tbody>
             {!! $BodyTable !!}
      </tbody>
      </table>

 
    </aside>
    <div style="margin: 0 40px; margin-top: 50px;">
      <h3 style="font-weight: 500;">Total: <span style="font-weight: 900;">
      {{ $Unidades }} paquetes/unidades</span> con un peso aproximado de: <span style="font-weight: 900;">{{ $KilosReales }} kilos</span></h3>
    </div>
  </div>
  <footer>
    <br><br><br><br><br><br>
    <img src="{{ asset('storage/images/firmas/serviclientes.png') }}" alt="Firma cripack serviclientes">
  </footer>
</body>
</html>