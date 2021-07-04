<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ datos_negocio()->shop_name!= '' ? datos_negocio()->shop_name :  asser('app.name') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{ mix('js/app.js') }}" defer></script>
    <link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery-ui.theme.css') }}" rel="stylesheet">

    <script src="/js/jquery-ui.js" defer></script>

    @yield('third_party_stylesheets')

    @stack('page_css')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <!-- Main Header -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                    
                    <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                </a>
                 
                
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <!-- User image -->
                    <li class="user-header bg-default">
                        
                        <p>
                            {{ Auth::user()->name }}
                            <small>Miembro desde {{ Auth::user()->created_at->format('M. Y') }}</small>
                        </p>
                        <img class="img-fluid rounded" src="{{auth()->user()->avatar}}" height="75" alt="">
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <a href="{{route('profile')}}" class="btn btn-default btn-flat">Perfil</a>
                        <a href="#" class="btn btn-default btn-flat float-right"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Cerrar sesión
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>

    <!-- Left side column. contains the logo and sidebar -->
@include('layouts.sidebar')

    <div class="content-wrapper">
        <div class="content-header">
          @yield('cabecera')
        </div>

        <section class="content">
            @if (session()->has('error'))
                <div class="alert alert-danger alert-block alert-dismissable">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                  {!! session('error') !!}
                </div>
              @endif
              @if (session()->has('success'))
                <div class="alert alert-success alert-block alert-dismissable">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                  {!! session('success') !!}
                </div>
              @endif

            @yield('content')
        </section>
    </div>

    <!-- Main Footer -->
    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 0.0.1
        </div>
        <strong>Copyright &copy; {{date('Y')}} <a href="https://integrappsv.com" target="_blank">integrappsv</a>.</strong> All rights
        reserved.
    </footer>
</div>
<script src="{{ asset('js/datatables.min.js') }}" defer></script>
<script src="{{ asset('js/pdfmake.min.js') }}" defer></script>
<script src="{{ asset('js/vfs_fonts.js') }}" defer></script>
<script src="{{ asset('js/jquery.inputmask.js') }}" defer></script>
<script>
$(function(){
    $(".dui").inputmask("99999999-9");
    $(".nit").inputmask("9999-999999-999-9");
    $(".phone").inputmask("9999-9999");
    //Datatable
    $("#dataTable").DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                text: 'Excel'
            },
            {
                extend: 'pdfHtml5',
                text: 'PDF',
            }
        ],
            language: {
                processing: "Búsqueda en curso...",
                search: "Buscar:",
                lengthMenu: "Mostrar _MENU_ Elementos",
                info: "Mostrando _START_ de _END_ de un total de _TOTAL_ elementos",
                infoEmpty: "Visualizando 0 de 0 de un total de 0 elementos",
                infoFiltered: "(Filtrado de _MAX_ elementos en total)",
                infoPostFix: "",
                loadingRecords: "Carga de datos en proceso..",
                zeroRecords: "Elementos no encontrados",
                emptyTable: "La tabla no contiene datos",
                paginate: {
                    first: "Primero",
                    previous: "Anterior",
                    next: "siguiente",
                    last: "Último"
                },
            },
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": false,
            "info": true,
            "autoWidth": false,
            "destroy":true
        });

        $('.fechita').datepicker({
            selectOtherMonths: true,
            changeMonth: true,
            changeYear: true,
            yearRange: "-100:+0", // last hundred years
            dateFormat: 'dd-mm-yy',
            format: 'dd-mm-yyyy'
        });
    });

     
    function modal_cargando(){
      swal.fire({
        title: 'Cargando!',
        text: 'Este diálogo se cerrará al completar la operación.',
        allowOutsideClick: false,
        allowEscapeKey: false,
        showConfirmButton: false,
        onOpen: function () {
          swal.showLoading()
        }
      });
    }
</script>

@yield('third_party_scripts')

@stack('page_scripts')
</body>
</html>
