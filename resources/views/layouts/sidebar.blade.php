<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('home') }}" class="brand-link">
        
        <span class="brand-text font-weight-light">{{ datos_negocio()->shop_name!= '' ? datos_negocio()->shop_name :  asser('app.name') }} </span><br>
    </a>

    <div class="sidebar">
        <br>
        <div class="col-md-12">
            <img class="m-auto d-block" height="100" src="{{ datos_negocio()->logo!= '' ? datos_negocio()->url_logo :  asset('images/no-disponible.jpg') }}" alt="">
        </div>
        <br>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @include('layouts.menu')
            </ul>
        </nav>
    </div>

</aside>
