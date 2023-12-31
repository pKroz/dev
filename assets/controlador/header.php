<?php
include('../config.php');
$sql1 = ("SELECT COUNT(*) as totalProyectos FROM proyectosInfo WHERE idUsuario = '$session_id'");
$query1 = mysqli_query($con, $sql1);
?>
<div class="d-flex align-items-center ms-1" id="kt_header_user_menu_toggle">
    <div class="btn btn-flex align-items-center bg-hover-white bg-hover-opacity-10 py-2 px-2 px-md-3"
        data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
        <div class="d-none d-md-flex flex-column align-items-end justify-content-center me-2 me-md-4">
            <span class="text-muted fs-8 fw-bold lh-1 mb-1"><?php echo $session_nombres?>
                <?php echo $session_apellidos?></span>
            <span class="text-white fs-8 fw-bolder lh-1"><?php echo ucfirst($session_rol)?></span>
        </div>
        <div class="symbol symbol-30px symbol-md-40px">
            <img src="assets/media/avatars/<?php echo $session_imagen?>" alt="image" />
        </div>
    </div>
    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px"
        data-kt-menu="true">
        <div class="menu-item px-3">
            <div class="menu-content d-flex align-items-center px-3">
                <div class="symbol symbol-50px me-5">
                    <img alt="Logo" src="assets/media/avatars/<?php echo $session_imagen?>" />
                </div>
                <div class="d-flex flex-column">
                    <div class="fw-bolder d-flex align-items-center fs-5"><?php echo $session_nombres?>
                        <?php echo $session_apellidos?>
                        <span
                            class="badge badge-light-success fw-bolder fs-8 px-2 py-1 ms-2"><?php echo ucfirst($session_rol)?></span>
                    </div>
                    <a class="fw-bold text-muted text-hover-primary fs-7"><?php echo $session_email?></a>
                </div>
            </div>
        </div>
        <div class="separator my-2"></div>

        <div class="menu-item px-5">
            <a href="https://dev.pkroz.net/proyectos/index.php" class="menu-link px-5">
                <span class="menu-text">Mis proyectos</span>
                <?php 
												while ($dataUsuario1 = mysqli_fetch_array($query1)) { ?>
                <span class="menu-badge">
                    <span
                        class="badge badge-light-danger badge-circle fw-bolder fs-7"><?php echo $dataUsuario1['totalProyectos']; ?></span>
                </span>
                <?php } ?>
            </a>
        </div>
        <div class="menu-item px-5 my-1">
            <a href="../../demo14/dist/account/settings.html" class="menu-link px-5">Configuración</a>
        </div>
        <div class="separator my-2"></div>
        <div class="menu-item px-5">
            <form class="menu-link px-5" method="POST">
                <button type="submit" class="menu-link" name="unlogin" value="deslogear"
                    style="padding: 0; border: none; background: none; text-decoration: none; color: inherit; display: inline-block; font-weight: 500; text-align: left;">
                    <span>Cerrar Sesión</span>
                </button>
            </form>
        </div>
    </div>
</div>