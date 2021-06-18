<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Request::routeIs('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('users.index') }}" class="nav-link {{ Request::routeIs('users.*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user"></i>
        <p>Usuarios</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('products.index') }}" class="nav-link {{ Request::routeIs('products.*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Productos</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('compras.index') }}" class="nav-link {{ Request::routeIs('compras.*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Compras</p>
    </a>
</li>

<li class="nav-item">
    <a href="#" class="nav-link"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="nav-icon fas fa-sign-out-alt"></i>
        <p>Salir</p>
    </a>
</li>
