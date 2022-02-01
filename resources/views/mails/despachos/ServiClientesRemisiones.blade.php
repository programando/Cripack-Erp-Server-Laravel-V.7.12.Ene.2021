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
    <title>Cripack - Despachos</title>
</head>
<body style="font-size: 12px; margin: 0; padding: 0; width: 100%; word-break: break-word; -webkit-font-smoothing: antialiased; background-color: #fff;">
 
  <div role="article"  lang="en">
    <header style="display: flex; margin: 0 40px;">
      <div style="font-size: 12px;">
       
        <h4>Señores:</h4>
        <h4 style="margin-top: 20px; margin-bottom: 0px;"> SERVICIO AL CLIENTE - CRIPACK</h4>
        <br><br>
      </div>
    </header> 
    <aside style="margin: 0 40px; margin-top: 50px;">
      <div>
        <p> A continuación se informa sobre despachos enviados a clientes:</p>
      </div>
 
       <table   width="100%">
      <thead  style="text-align: center; color: #fff; background-color: #272C6B; height:25px;">
        <tr>
          <th>#</th>
          <th>Núm.Orden </th>
          <th>Cliente </th>
          <th>Tipo Trabajo</th>
          <th>Referencia</th>
          <th>#Guía</th>
          <th>Transportador</th>
        </tr>
      </thead>
      <tbody>
             {!! $BodyTable !!}
      </tbody>
      </table>

 
    </aside>

  </div>
  <footer>
    <br><br><br><br><br><br>
    <img src="{{ asset('storage/images/firmas/serviclientes.png') }}" alt="Firma corporativa Cripack-Serviclientes">
  </footer>
</body>
</html>