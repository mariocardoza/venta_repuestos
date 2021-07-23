<!DOCTYPE html>
<html lang="en" style="height: auto;"><head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ datos_negocio()->shop_name!= '' ? datos_negocio()->shop_name :  asser('app.name') }} - 40</title>
  <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="" style="height: auto;">
<div class="wrapper">
  <div class="content-wrappesr" style="min-height: 1602px;">
    <!-- Main content -->
    <section class="content">
      <br><br><br><br>
      <div class="error-page">
        <h2 class="headline text-warning"> 401</h2>

        <div class="error-content">
          <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Debe iniciar sesión.</h3>

          <p>
            <a href="{{route('dashboard')}}">Volver al inicio</a>
          </p>
        </div>
        <!-- /.error-content -->
      </div>
      <!-- /.error-page -->
    </section>
    <!-- /.content -->
  </div>
</div>
</body>
</html>