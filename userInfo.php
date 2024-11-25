<a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <!-- Mostrar la foto de perfil -->
            <img src="assets/img/<?php echo $_SESSION['imgU']; ?>" alt="Profile" class="rounded-circle">
            <!-- Mostrar el nombre, apellido y nivel del usuario -->
            <span class="d-none d-md-block dropdown-toggle ps-2">
              <?php echo ucfirst($_SESSION['nombreU'] . ' ' . $_SESSION['apellidoU'] . ' - ' . $_SESSION['nivelU']); ?>
            </span>
</a>
         
