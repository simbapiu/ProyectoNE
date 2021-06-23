@if(Auth::User()->role == 'admin')
    <div class="title-header">
        <a class="navbar-brand" href="/admin">Administrador</a>
    </div>
@elseif(Auth::User()->role == 'user')
    <div class="title-header">
        <a class="navbar-brand" href="/admin">Evaluador</a>
    </div>
@endif
<button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i>
</button>
<div class="pjy-logo">
    <img src="{{ asset('images/logoPJY.png') }}"><a href="/admin"></a>
</div>
<!-- Navbar-->
<ul class="navbar-nav ml-auto ml-md-0">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            @if(Auth::User()->role == 'admin')
                <a class="dropdown-item" href="#">Ajustes</a>
                <div class="dropdown-divider"></div>
            @endif
            <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
                <a class="dropdown-item" href="javascript:{}" onclick="document.getElementById('logoutForm').submit(); return false;">Cerrar sesión</a>
        </div>
    </li>
</ul>