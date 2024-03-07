
<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">

<!-- Nav Item - User Information -->
<li class="nav-item dropdown no-arrow">
        <div class="nav-link" id="clock" style="margin-left: 20px; color: #3a3b45; font-weight: bold;"></div>
</li>

<!-- Nav Item - Alerts -->
<li class="nav-item dropdown no-arrow mx-1">
    
    <a class="nav-link dropdown-toggle" id="clear" role="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-bell fa-fw"></i>
        <!-- Counter - Alerts -->
        <span class="badge badge-danger badge-counter"><?php echo $totalAsistenciasNotify;?></span>
    </a>
    <!-- Dropdown - Alerts -->
    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
        aria-labelledby="alertsDropdown">
        <h6 class="dropdown-header">
            Centro de notificaciones
        </h6>
        <a class="dropdown-item d-flex align-items-center" href="#">                    
            <div>
                <?php
                $clientes = obtenerClientesNoNotificados($conexion);
                foreach ($clientes as $cliente) {
                    echo '
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="mr-3">
                                <div class="icon-circle bg-primary">
                                    <i class="fas fa-file-alt text-white"></i>
                                </div>
                            </div>
                            <div>
                                
                                <span class="font-weight-bold">' . $cliente . ' Ha reportado asistencia</span>
                            </div>
                        </a>';
                }
                ?>
            </div>
            
        </a>
        <a id="clear" class="dropdown-item text-center small text-gray-500" >Limpiar Historial</a>
    </div>
</li>



<div class="topbar-divider d-none d-sm-block"></div>

<!-- Nav Item - User Information -->
<li class="nav-item dropdown no-arrow">
    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $usuario; ?></span>
        <img class="img-profile rounded-circle"
            src="../../resources/img/undraw_profile.svg">
    </a>
    <!-- Dropdown - User Information -->
    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
        aria-labelledby="userDropdown">
        <a class="dropdown-item" href="#">
            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
            Perfil
        </a>
        <a class="dropdown-item" href="#">
            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
            Registro de actividades
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            Salir
        </a>
    </div>
</li>

</ul>

</nav>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Deseas salir?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Selecciona salir si deseas cerrar sesión.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="../login/logout.php">Salir</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateClock() {
            const now = new Date();
            const date = now.toLocaleDateString();
            const hours = now.getHours().toString().padStart(2, '0');
            const minutes = now.getMinutes().toString().padStart(2, '0');
            const seconds = now.getSeconds().toString().padStart(2, '0');
            document.getElementById('clock').textContent = `${date} ${hours}:${minutes}:${seconds}`;
        }

        setInterval(updateClock, 1000); // Actualiza el reloj cada segundo
        updateClock(); // Actualiza el reloj de inmediato al cargar la página
    </script>


<script>
        document.getElementById('clear').addEventListener('click', function(event) {
            event.preventDefault(); // Evita que el enlace recargue la página
            
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '../components/marcarNotificacion.php', true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    console.print('Notificaciones marcadas correctamente.');
                } else {
                    console.print('Error al marcar las notificaciones: ' + xhr.statusText);
                }
                location.reload();
            };
            xhr.onerror = function() {
                alert('Error de conexión.');
            };
            xhr.send();
        });
    </script>


    