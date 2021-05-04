<a class="navbar-brand" href="/admin">Panel Admin</a>
<button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i>
</button>
<img src="{{ asset('images/logoPJY.png') }}" style="width: 300px; margin: 0 auto">
<!-- Navbar Search-->
<form class="d-none d-md-inline-block form-inline ml-md-3 mr-0 mr-md-3 my-2 my-md-0">
    <div class="input-group">
        <input class="form-control" type="text" placeholder="Search for..." aria-label="Search"
               aria-describedby="basic-addon2"/>
        <div class="input-group-append">
            <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
        </div>
    </div>
</form>
<!-- Navbar-->
<ul class="navbar-nav ml-auto ml-md-0">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            @yield('navBar')
            <a class="dropdown-item" href="login.html">Cerrar sesión</a>
        </div>
    </li>
</ul>