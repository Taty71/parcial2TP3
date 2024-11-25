<?php 
function mostrarMensaje($Mensaje, $tipoMensaje, $icono) {
    if (!empty($Mensaje)) { ?>
        <!-- Mostrar el mensaje con la clase y el icono según el tipo -->
        <div class="alert <?php echo $tipoMensaje; ?> alert-dismissible fade show" role="alert">
            <i class="bi <?php echo $icono; ?> me-1"></i>
            <?php echo $Mensaje; ?>
        </div>
    <?php }
}
