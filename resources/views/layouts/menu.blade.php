<!-- need to remove -->
@if(auth()->user()->role_id!=3)
<li class="nav-item">
    <a href="{{ route('dashboard') }}" class="nav-link {{ Request::routeIs('dashboard') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Inicio</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('shop.index') }}" class="nav-link {{ Request::routeIs('shop.*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-globe"></i>
        <p>Administración</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('users.index') }}" class="nav-link {{ Request::routeIs('users.*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user"></i>
        <p>Usuarios</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('logs.index') }}" class="nav-link {{ Request::routeIs('logs.*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-calendar-check"></i>
        <p>Registro de actividad</p>
    </a>
</li>
@endif

<li class="nav-item">
    <a href="{{ route('products.index') }}" class="nav-link {{ Request::routeIs('products.*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-cart-plus"></i>
        <p>Productos</p>
    </a>
</li>
@if(auth()->user()->role_id!=3)
<li class="nav-item">
    <a href="{{ route('purchases.index') }}" class="nav-link {{ Request::routeIs('purchases.*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-money-bill"></i>
        <p>Compras</p>
    </a>
</li>
@endif

<li class="nav-item">
    <a href="{{ route('categories.index') }}" class="nav-link {{ Request::routeIs('categories.*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-check-square"></i>
        <p>Marcas</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('subcategories.index') }}" class="nav-link {{ Request::routeIs('subcategories.*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-check-circle"></i>
        <p>Modelos</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('customers.index') }}" class="nav-link {{ Request::routeIs('customers.*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-users"></i>
        <p>Clientes</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('sales.index') }}" class="nav-link {{ Request::routeIs('sales.index') ? 'active' : '' }}">
        <i class="nav-icon fas fa-file-invoice-dollar"></i>
        <p>Ventas realizadas</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('sales.create') }}" class="nav-link {{ Request::routeIs('sales.create') ? 'active' : '' }}">
        <i class="nav-icon fas fa-shopping-bag"></i>
        <p>Nueva Venta</p>
    </a>
</li>

<li class="nav-item">
    <a href="#" class="nav-link"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="nav-icon fas fa-sign-out-alt"></i>
        <p>Salir</p>
    </a>
</li>

