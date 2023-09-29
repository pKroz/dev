<?php
include('../config.php');

if (!empty($_POST['btneliminar'])) {
    if (!empty($_POST['id'])) {
        $id = $_POST['id'];
        $consulta2 = "UPDATE `usuarios` SET `estado`='2' where id='$id'";
        $resultado2 = mysqli_query($con, $consulta2);
        header("location: clientes.php");
}}


if (!empty($_POST['btnreset'])) {
    if (!empty($_POST['resetId']) and !empty($_POST['resetPass']) and !empty($_POST['resetNombres'])) {
        $resetId = $_POST['resetId'];
        $resetPass = $_POST['resetPass'];
        $resetNombres = $_POST['resetNombres'];
        $hashedPassword2 = hash('sha256', $resetPass);
        $fecha = date('Y-m-d H:i:s');
        $consulta4 = "INSERT `resetPasswords` (`usuarioSolicitante`,`fecha`,`idReset`,`nombreReset`) VALUES ('$session_nombres $session_apellidos','$fecha','$resetId','$resetNombres')";
        $resultado4 = mysqli_query($con, $consulta4);
        $consulta3 = "UPDATE `usuarios` SET `pass`='$hashedPassword2' where id='$resetId'";
        $resultado3 = mysqli_query($con, $consulta3);
        header("location: clientes.php");
}}

if (!empty($_POST['btneditar'])) {
    if (!empty($_POST['editId'])) {
        $editId = $_POST['editId'];
        $editRol = $_POST['editRol'];
        $editNumero = $_POST['editNumero'];
        $editDireccion = $_POST['editDireccion'];
        $imagen = $_FILES['imagen']['name'];
        if (isset($imagen) and $imagen!=""){
            $tipo = $_FILES['imagen']['type'];
            $temp = $_FILES['imagen']['tmp_name'];
            $extension = pathinfo($imagen,PATHINFO_EXTENSION);
            if (!((strpos($tipo, 'jpeg')) or (strpos($tipo, 'jpg')) or (strpos($tipo, 'png')))){
                echo '<div class="toast show position-fixed bottom-0 end-0 p-2 bg-danger" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header bg-danger">
                            <i class="ki-duotone ki-abstract-39 fs-2 bg-danger"><span class="path1 bg-danger"></span><span class="path2 bg-danger"></span></i>
                            <strong class="me-auto text-white">Alerta</strong>
                            <button type="button" class="btn-close bg-white" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body text-white">
                    Solo se permiten archivos con extensión jpeg, jpg o png.
                </div>
            </div>';
        }else {
            $nuevo_nombre_imagen = $editId . '.' . $extension;
            $ruta_imagen = '../assets/media/avatars/' . $nuevo_nombre_imagen;
            move_uploaded_file($temp, $ruta_imagen);
            $consulta4 = "UPDATE `usuarios` SET `numero`='$editNumero', `direccion`='$editDireccion' , `imagen`='$nuevo_nombre_imagen' where id='$editId'";
            $resultado4 = mysqli_query($con, $consulta4);
            header("location: proveedores.php");
        }
    }else {
            $consulta5 = "UPDATE `usuarios` SET `numero`='$editNumero' , `direccion`='$editDireccion' where id='$editId'";
            $resultado5 = mysqli_query($con, $consulta5);
            header("location: proveedores.php");
    }
}
}

if (!empty($_POST['btncrear'])) {
    if (!empty($_POST['crearEmail']) and !empty($_POST['crearNombres']) and !empty($_POST['crearApellidos']) and !empty($_POST['crearPassword'])) {
        $imagen = $_FILES['imagen']['name'];
        $crearEmail = $_POST['crearEmail'];
        $crearNombres = $_POST['crearNombres'];
        $crearApellidos = $_POST['crearApellidos'];
        $crearNumero = $_POST['crearNumero'];
        $crearDireccion = $_POST['crearDireccion'];
        $crearPassword = $_POST['crearPassword'];
        $crearRol = $_POST['crearRol'];
        $crearNombres = strtoupper($crearNombres);
        $crearApellidos = strtoupper($crearApellidos);
        if (filter_var($crearEmail, FILTER_VALIDATE_EMAIL)) {
            if (preg_match('/^[A-Za-z\s]+$/', $crearNombres) && preg_match('/^[A-Za-z\s]+$/', $crearApellidos)) {
                $consulta_email = "SELECT * FROM usuarios WHERE email = '$crearEmail'";
                $resultado_email = mysqli_query($con, $consulta_email);
                if (mysqli_num_rows($resultado_email) == 0) {
                    if (isset($imagen) and $imagen!=""){
                        $tipo = $_FILES['imagen']['type'];
                        $temp = $_FILES['imagen']['tmp_name'];
                        $extension = pathinfo($imagen,PATHINFO_EXTENSION);
                        if (!((strpos($tipo, 'jpeg')) or (strpos($tipo, 'jpg')) or (strpos($tipo, 'png')))){
                            echo '<div class="toast show position-fixed bottom-0 top-2 end-0 p-2 " role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header">
                                <i class="ki-duotone ki-abstract-39 fs-2 text-primary "><span class="path1"></span><span class="path2"></span></i>
                                <strong class="me-auto">Alerta</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                            <div class="toast-body">
                                Solo se permiten archivos con extensión jpeg, jpg o png.
                            </div>
                        </div>';
                        } else{
                            $hashedPassword = hash('sha256', $crearPassword);
                            $consulta = "INSERT usuarios (`email`,`pass`,`nombres`,`apellidos`,`numero`,`direccion`,`imagen`,`rol`,`metodoLogin`,`estado`) VALUES ('$crearEmail','$hashedPassword','$crearNombres','$crearApellidos','$crearNumero','$crearDireccion','$imagen','proveedor','email','1')";
                            $resultado = mysqli_query($con, $consulta);
                            $id_usuario = mysqli_insert_id($con);
                            $consulta11 = "INSERT contratos (`observacion`,`recomendacion`,`idUsuario`) VALUES ('-','-','$id_usuario')";
                            $resultado3 = mysqli_query($con, $consulta11);
                            $nuevo_nombre_imagen = $id_usuario . '.' . $extension;
                            $ruta_imagen = '../assets/media/avatars/' . $nuevo_nombre_imagen;
                            move_uploaded_file($temp, $ruta_imagen);
                            $consulta33 = "UPDATE `usuarios` SET `imagen`='$nuevo_nombre_imagen' where id='$id_usuario'";
                            $resultado2 = mysqli_query($con, $consulta33);
                            header("location: proveedores.php");
                        }
                    } else{
                        $hashedPassword = hash('sha256', $crearPassword);
                        $consulta = "INSERT usuarios (`email`,`pass`,`nombres`,`apellidos`,`numero`,`direccion`,`imagen`,`rol`,`metodoLogin`,`estado`) VALUES ('$crearEmail','$hashedPassword','$crearNombres','$crearApellidos','$crearNumero','$crearDireccion','blank.png','proveedor','email','1')";
                        $resultado = mysqli_query($con, $consulta);
                        $id_usuario = mysqli_insert_id($con);
                        $consulta11 = "INSERT contratos (`observacion`,`recomendacion`,`idUsuario`) VALUES ('-','-','$id_usuario')";
                        $resultado3 = mysqli_query($con, $consulta11);
                        header("location: proveedores.php");
                    }
                }else{
                    echo '<div class="toast show position-fixed bottom-0 end-0 p-2 bg-danger" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header bg-danger">
                            <i class="ki-duotone ki-abstract-39 fs-2 bg-danger"><span class="path1 bg-danger"></span><span class="path2 bg-danger"></span></i>
                            <strong class="me-auto text-white">Alerta</strong>
                            <button type="button" class="btn-close bg-white" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body text-white">
                            El correo electrónico ya está registrado. Por favor, elija otro correo.
                        </div>
                    </div>';
                }
            } else {
                echo '<div class="toast show position-fixed bottom-0 end-0 p-2 bg-danger" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header bg-danger">
                            <i class="ki-duotone ki-abstract-39 fs-2 bg-danger"><span class="path1 bg-danger"></span><span class="path2 bg-danger"></span></i>
                            <strong class="me-auto text-white">Alerta</strong>
                            <button type="button" class="btn-close bg-white" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body text-white">
                            El nombre y apellido solo deben contener letras y espacios.
                        </div>
                    </div>';
            }
        } else{
            echo '<div class="toast show position-fixed bottom-0 end-0 p-2 bg-danger" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header bg-danger">
                            <i class="ki-duotone ki-abstract-39 fs-2 bg-danger"><span class="path1 bg-danger"></span><span class="path2 bg-danger"></span></i>
                            <strong class="me-auto text-white">Alerta</strong>
                            <button type="button" class="btn-close bg-white" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body text-white">
                        El formato del correo electrónico no es válido.
                    </div>
                </div>';
        }
    }else{
        echo '<div class="toast show position-fixed bottom-0 end-0 p-2 bg-danger" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header bg-danger">
                            <i class="ki-duotone ki-abstract-39 fs-2 bg-danger"><span class="path1 bg-danger"></span><span class="path2 bg-danger"></span></i>
                            <strong class="me-auto text-white">Alerta</strong>
                            <button type="button" class="btn-close bg-white" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body text-white">
                    Por favor, completa todos los campos.
                </div>
            </div>';
    }
}
?>