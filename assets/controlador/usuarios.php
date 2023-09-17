<?php
include('../config.php');
if (!empty($_POST['btneditar'])) {
    if (!empty($_POST['email']) and !empty($_POST['password']) and !empty($_POST['nombres']) and !empty($_POST['apellidos'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $nombres = strtoupper($nombres);
        $apellidos = strtoupper($apellidos);
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                if (preg_match('/^(?=.*[A-Z])(?=.*[.!@#$%^&*])(?=.{8,})/', $password)) {
                    // Verificar que las contraseñas coincidan
                    if ($password === $password2) {
                        // Comprobar si el correo ya está registrado
                        $consulta_email = "SELECT * FROM usuarios WHERE email = '$email'";
                        $resultado_email = mysqli_query($con, $consulta_email);

                        if (mysqli_num_rows($resultado_email) == 0) {
                            // El correo no está registrado, procede a insertar el nuevo usuario
                            $hashedPassword = hash('sha256', $password);
                            $consulta = "INSERT usuarios (`email`,`pass`,`nombres`,`apellidos`,`imagen`,`rol`) VALUES ('$email','$hashedPassword','$nombres','$apellidos','blank.png','usuario')";
                            $resultado = mysqli_query($con, $consulta);
                            header("location: index.php");
                        } else {
                            echo '<div class="toast show position-fixed bottom-0 end-0 p-2 " role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header">
                                <i class="ki-duotone ki-abstract-39 fs-2 text-primary "><span class="path1"></span><span class="path2"></span></i>
                                <strong class="me-auto">Alerta</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                            <div class="toast-body">
                                El correo electrónico ya está registrado. Por favor, elija otro correo.
                            </div>
                        </div>';
                        }
                    } else {
                        echo '<div class="toast show position-fixed bottom-0 end-0 p-2 " role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            <i class="ki-duotone ki-abstract-39 fs-2 text-primary "><span class="path1"></span><span class="path2"></span></i>
                            <strong class="me-auto">Alerta</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                            Las contraseñas no coinciden.
                        </div>
                    </div>';
                    }
                } else {
                    echo '<div class="toast show position-fixed bottom-0 end-0 p-2 " role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <i class="ki-duotone ki-abstract-39 fs-2 text-primary "><span class="path1"></span><span class="path2"></span></i>
                        <strong class="me-auto">Alerta</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        La contraseña debe tener al menos una letra mayúscula, un símbolo y un mínimo de 8 caracteres.
                    </div>
                </div>';
                }
            } else {
                echo '<div class="toast show position-fixed bottom-0 end-0 p-2 " role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <i class="ki-duotone ki-abstract-39 fs-2 text-primary "><span class="path1"></span><span class="path2"></span></i>
                    <strong class="me-auto">Alerta</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    El nombre y apellido solo deben contener letras y espacios.
                </div>
            </div>';
            }
        } else {
            echo '<div class="toast show position-fixed bottom-0 end-0 p-2 " role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i class="ki-duotone ki-abstract-39 fs-2 text-primary "><span class="path1"></span><span class="path2"></span></i>
                <strong class="me-auto">Alerta</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                El formato del correo electrónico no es válido.
            </div>
        </div>';
        }
    } else {
        echo '<div class="toast show position-fixed bottom-0 end-0 p-2 " role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="ki-duotone ki-abstract-39 fs-2 text-primary "><span class="path1"></span><span class="path2"></span></i>
            <strong class="me-auto">Alerta</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            Por favor, completa todos los campos.
        </div>
    </div>';
    }
}


if (!empty($_POST['btneliminar'])) {
    if (!empty($_POST['id'])) {
        $id = $_POST['id'];
        $consulta2 = "UPDATE `usuarios` SET `estado`='2' where id='$id'";
        $resultado2 = mysqli_query($con, $consulta2);
        header("location: index.php");
}}


if (!empty($_POST['btnreset'])) {
    if (!empty($_POST['resetId']) and !empty($_POST['resetPass']) and !empty($_POST['resetNombres'])) {
        $resetId = $_POST['resetId'];
        $resetPass = $_POST['resetPass'];
        $resetNombres = $_POST['resetNombres'];
        $hashedPassword2 = hash('sha256', $resetPass);
        $fecha = date('Y-m-d H:i:s');
        $consulta4 = "INSERT `resetPasswords` (`usuarioSolicitante`,`fecha`,`idReset`,`nombreReset`) VALUES ('$nombres $apellidos','$fecha','$resetId','$resetNombres')";
        $resultado4 = mysqli_query($con, $consulta4);
        $consulta3 = "UPDATE `usuarios` SET `pass`='$hashedPassword2' where id='$resetId'";
        $resultado3 = mysqli_query($con, $consulta3);
        header("location: index.php");
}}

if (!empty($_POST['btneditar'])) {
    if (!empty($_POST['id']) and !empty($_POST['nombre']) and !empty($_POST['email'])) {
        $editId = $_POST['id'];
        $editRol = $_POST['rol'];
        $editNumero = $_POST['numero'];
        $imagen = $_FILES['imagen']['name'];
        if (isset($imagen) and $imagen!=""){
            $tipo = $_FILES['imagen']['type'];
            $temp = $_FILES['imagen']['tmp_name'];
            $extension = pathinfo($imagen,PATHINFO_EXTENSION);
            if (!((strpos($tipo, 'jpeg')) or (strpos($tipo, 'jpg')) or (strpos($tipo, 'png')))){
                echo '<div class="toast show position-fixed bottom-0 end-0 p-2 " role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <i class="ki-duotone ki-abstract-39 fs-2 text-primary "><span class="path1"></span><span class="path2"></span></i>
                    <strong class="me-auto">Alerta</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    Solo se permiten archivos con extensión jpeg, jpg o png.
                </div>
            </div>';
        }else {
            $nuevo_nombre_imagen = $editId . '.' . $extension;
            $ruta_imagen = '../assets/media/avatars/' . $nuevo_nombre_imagen;
            move_uploaded_file($temp, $ruta_imagen);
            $consulta4 = "UPDATE `usuarios` SET `rol`='$editRol', `numero`='$editNumero', `imagen`='$nuevo_nombre_imagen' where id='$editId'";
            $resultado4 = mysqli_query($con, $consulta4);
            header("location: index.php");
        }
    }else {
            $consulta5 = "UPDATE `usuarios` SET `rol`='$editRol', `numero`='$editNumero' where id='$editId'";
            $resultado5 = mysqli_query($con, $consulta5);
            header("location: index.php");
    }
}
}
?>