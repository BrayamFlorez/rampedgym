<!-- slidebar.php -->
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="../dashboard/welcome.php">
    <div class="sidebar-brand-icon">
        <img src="../../resources/img/01_06.png" alt="Imagen de perfil" class="rounded-circle img-fluid" style="width: 50px; height: 50px;">
    </div>
    <div class="sidebar-brand-text mx-3"><?php echo $usuario; ?></div>
</a>


<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="../dashboard/welcome.php">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>RAMPED-GYM</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Menú
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Administrar Gym</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="#">Rutinas</a>
        </div>
    </div>
</li>


<!-- Divider -->
<hr class="sidebar-divider">

<!-- Nav Item - Charts -->
<li class="nav-item">
    <a class="nav-link" href="../customers/clients.php">
        <i class="fas fa-fw fa-user"></i>
        <span>Clientes</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Nav Item - Charts -->
<li class="nav-item">
    <a class="nav-link" href="../machines/machines.php">
        <i class="fas fa-fw fa-wrench"></i>
        <span>Maquinas</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->