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
    <title>Cripack - Notificaciones</title>
</head>
<body style="font-size: 12px; margin: 0; padding: 0; width: 60%; word-break: break-word; -webkit-font-smoothing: antialiased; background-color: #fff;">
 
  <div role="article"  lang="en">
    <br><br> 
    <aside style="margin: 0 40px; margin-top: 50px;">
      <div>
        <h3 style="font-weight: 500;">Apreciados colaboradores,</h3>
        <br><br>
        <h3 style="font-weight: 500;">Se les informa que las órdes de trabajo relacionadas a continuación han culminado su proceso productivo y se encuentran listas para despacho. Agradecemos iniciar las labores correspondientes para que dicho despacho se realice a la mayor brevedad posible.:</h3>
      </div>
        <br>
       <table   width="100%">
      <thead  style="text-align: center; color: #fff; background-color: #272C6B; height:25px;">
        <tr>
          <th>#</th>
          <th style="text-align: center;">Número OT</th>
          <th style="text-align: center;">Cliente</th>
          <th>Tipo Trabajo</th>
          <th>Referencia</th>
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