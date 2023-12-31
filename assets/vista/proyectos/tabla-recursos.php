<?php
include('../config.php');
$sql1 = ("SELECT proyectos.id, proyectos.nombre, proyectos.fechaInicio, proyectos.fechaFin, proyectos.descripcion, proyectos.fechaCreacion, proyectos.estado, proyectosInfo.tipo, proyectosInfo.fechaAdd, proyectosInfo.fechaEstado, proyectosInfo.idProyecto, GROUP_CONCAT(proyectosInfo.idUsuario) AS idUsuarios
FROM proyectos
JOIN proyectosInfo ON proyectos.id = proyectosInfo.idProyecto where proyectos.id= '$idProyecto'
GROUP BY proyectos.id");
$query1 = mysqli_query($con, $sql1);
?>

<div class="content flex-column-fluid" id="kt_content">
    <?php 
    $dataUsuario3Array = array(); // Array para almacenar los datos de $query3
                        
    while ($dataUsuario1 = mysqli_fetch_array($query1)) {
        include('../config.php');
        $sql3 = ("SELECT * FROM proyectos JOIN proyectosInfo ON proyectos.id = proyectosInfo.idProyecto LEFT JOIN usuarios ON proyectosInfo.idUsuario = usuarios.id WHERE proyectosInfo.idProyecto = '$idProyecto' AND proyectosInfo.estado='1';");
        $query3 = mysqli_query($con, $sql3);
        // Almacenar los datos de $query3 en el array
        $dataUsuario3Array[$idProyecto] = array();
        while ($dataUsuario3 = mysqli_fetch_array($query3)) {
            $dataUsuario3Array[$idProyecto][] = $dataUsuario3;
        }
    ?>
    <div class="card mb-6 mb-xl-9">
        <div class="card-body pt-9 pb-0">
            <div class="d-flex flex-wrap flex-sm-nowrap mb-6">
                <div class="flex-grow-1">
                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                        <div class="d-flex flex-column">
                            <div class="d-flex align-items-center mb-1">
                                <a
                                    class="text-gray-800 text-hover-primary fs-2 fw-bold me-3"><?php echo strtoupper($dataUsuario1['nombre']);?></a>
                                <?php 
									if ($dataUsuario1['estado'] == "1") { ?>
                                <span class="badge badge-light-warning me-auto">En progreso</span>
                                <?php } else { ?>
                                <span class="badge badge-light-success me-auto">Finalizado</span>
                                <?php } ?>


                            </div>

                            <div class="d-flex flex-wrap fw-semibold mb-4 fs-5 text-gray-500">
                                <?php 
									if ($dataUsuario1['descripcion'] != "") { ?>
                                <?php echo $dataUsuario1['descripcion']; ?>
                                <?php } else { ?>
                                -
                                <?php } ?>

                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap justify-content-start">
                        <div class="d-flex flex-wrap">
                            <?php 
                        $fechaInicio = $dataUsuario1['fechaInicio'];
                        $fechaInicioF = date('d/m/Y', strtotime($fechaInicio));
                        $fechaFin = $dataUsuario1['fechaFin'];
                        $fechaFinF = date('d/m/Y', strtotime($fechaFin));
                        ?>
                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="fs-4 fw-bold"><?php echo $fechaInicioF?></div>
                                </div>

                                <div class="fw-semibold fs-6 text-gray-500">Fecha inicio</div>
                            </div>

                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="fs-4 fw-bold"><?php echo $fechaFinF?></div>
                                </div>

                                <div class="fw-semibold fs-6 text-gray-500">Fecha límite</div>
                            </div>





                            <?php
                        $totaldocs = 0;
                        $sql15 = "SELECT GROUP_CONCAT(tareasInfo.idUsuario SEPARATOR ',') AS idUsuarios, 
                                        proyectosTareas.id,
                                        proyectosTareas.nombre,
                                        proyectosTareas.estado,
                                        proyectosTareas.fechaFin,
                                        tareasInfo.idTarea, 
                                        proyectosTareas.idProyecto 
                                FROM tareasInfo 
                                JOIN proyectosTareas ON tareasInfo.idTarea = proyectosTareas.id 
                                WHERE proyectosTareas.idProyecto = '$idProyecto'
                                GROUP BY proyectosTareas.id;";
                        $query15 = mysqli_query($con, $sql15);
                        if ($query15) {
                            $totaldocs = mysqli_num_rows($query15); // Contamos el total de registros
                        }
                        $sqlArchivosT = ("SELECT proyectosTareas.nombre,proyectosDocumentos.fechaAdd,proyectosDocumentos.documento,proyectosDocumentos.extension,proyectosDocumentos.link FROM `proyectosTareas` INNER JOIN proyectosDocumentos ON proyectosTareas.id = proyectosDocumentos.idProyectoTarea  WHERE proyectosTareas.idProyecto = '$idProyecto';");
                        $queryArchivosT = mysqli_query($con, $sqlArchivosT);
                        if ($queryArchivosT) {
                            $totalArchivosT = mysqli_num_rows($queryArchivosT); // Contamos el total de registros
                        }?>
                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="ki-duotone ki-arrow-down fs-3 text-danger"><span
                                            class="path1"></span><span class="path2"></span></i>
                                    <div class="fs-4 fw-bold counted" data-kt-countup="true" data-kt-countup-value="75"
                                        data-kt-initialized="1"><?php echo $totalArchivosT ?></div>
                                </div>

                                <div class="fw-semibold fs-6 text-gray-500">Documentos adjuntos</div>
                            </div>


                        </div>

                        <div class="symbol-group symbol-hover mb-3">
                            <?php foreach ($dataUsuario3Array[$dataUsuario1['id']] as $dataUsuario3) {
                                if ($dataUsuario3['imagen'] != "blank.png") {
                                    echo '<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip"
                                            title="' . $dataUsuario3['nombres'] . ' ' . $dataUsuario3['apellidos'] . '">
                                            <img src="assets/media/avatars/' . $dataUsuario3['imagen'] . '" alt="user-image">
                                        </div>';
                                } else {
                                    $iniciales = substr($dataUsuario3['nombres'], 0, 1) . substr($dataUsuario3['apellidos'], 0, 1);
                                    echo '<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip"
                                            title="' . $dataUsuario3['nombres'] . ' ' . $dataUsuario3['apellidos'] . '">
                                            <span class="symbol-label bg-dark text-inverse-primary fw-bold">' . $iniciales . '</span>
                                        </div>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="separator"></div>

            <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
                <li class="nav-item">
                    <a class="nav-link text-active-primary py-5 me-6 active"
                        href="/../proyectos/recursos?idProyecto=<?php echo $idProyecto ?>">
                        Información </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-active-primary py-5 me-6"
                        href="/../proyectos/tareas?idProyecto=<?php echo $idProyecto ?>">
                        Tareas </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-active-primary py-5 me-6 "
                        href="/../proyectos/miembros?idProyecto=<?php echo $idProyecto ?>">
                        Miembros </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-active-primary py-5 me-6 "
                        href="/../proyectos/archivos?idProyecto=<?php echo $idProyecto ?>">
                        Archivos </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link text-active-primary py-5 me-6 "
                        href="/../proyectos/configuracion?idProyecto=<?php echo $idProyecto ?>">
                        Configuración </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="row gx-6 gx-xl-9">
        <div class="col-lg-6 mb-6">
            <div class="card card-flush h-lg-100">
                <div class="card-header mt-6">
                    <div class="card-title flex-column">
                        <h3 class="fw-bold mb-1">RESUMEN DE ACTIVIDADES</h3>
                        <?php
                        include('../config.php');
                        // Variables para contar los diferentes estados
                        $progreso = 0;
                        $finalizados = 0;
                        $retraso = 0;
                        $totalreg = 0;
                        // Fecha actual
                        $fechaActual = new DateTime();
                        $sql14 = "SELECT
                        GROUP_CONCAT(tareasInfo.idUsuario SEPARATOR ',') AS idUsuarios,
                        proyectosTareas.id,
                        proyectosTareas.nombre,
                        CASE
                            WHEN proyectosTareas.estado = 2 THEN 3  -- Si el estado es igual a 2, establecer verificación en 3
                            WHEN proyectosTareas.fechaFin < CURDATE() THEN 2
                            ELSE 1
                        END AS verificacion,
                        proyectosTareas.fechaFin,
                        tareasInfo.idTarea,
                        proyectosTareas.idProyecto
                    FROM
                        tareasInfo
                    JOIN proyectosTareas ON tareasInfo.idTarea = proyectosTareas.id
                    WHERE
                        proyectosTareas.idProyecto = '$idProyecto'
                    GROUP BY proyectosTareas.id;";
                        $query14 = mysqli_query($con, $sql14);
                        if ($query14) {
                            $totalreg = mysqli_num_rows($query14); // Contamos el total de registros
                            while ($tarea = mysqli_fetch_assoc($query14)) {
                                // Incrementamos según el estado
                                if ($tarea['verificacion'] == '1') {
                                    $progreso++;
                                } else if ($tarea['verificacion'] == '2') {
                                    $retraso++;
                                } elseif ($tarea['verificacion'] == '3') {
                                    $finalizados++;
                            }}
                        }
                        ?>
                        <div class="fs-6 fw-semibold text-gray-500">El proyecto tiene <?php echo $totalreg; ?>
                            actividades.</div>
                    </div>
                </div>

                <div class="card-body p-9 pt-5">
                    <div class="d-flex flex-wrap">


                        <div class="d-flex flex-column justify-content-center flex-row-fluid pe-11 mb-5">
                            <div class="d-flex fs-6 fw-semibold align-items-center mb-3">
                                <div class="bullet bg-warning me-3"></div>
                                <div class="text-gray-500">Pendientes</div>
                                <div class="ms-auto fw-bold text-gray-700"><?php echo $progreso; ?></div>
                            </div>

                            <div class="d-flex fs-6 fw-semibold align-items-center mb-3">
                                <div class="bullet bg-success me-3"></div>
                                <div class="text-gray-500">Completados</div>
                                <div class="ms-auto fw-bold text-gray-700"><?php echo $finalizados; ?></div>
                            </div>

                            <div class="d-flex fs-6 fw-semibold align-items-center mb-3">
                                <div class="bullet bg-danger me-3"></div>
                                <div class="text-gray-500">Destiempo</div>
                                <div class="ms-auto fw-bold text-gray-700"><?php echo $retraso; ?></div>
                            </div>

                        </div>
                    </div>


                    <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed  p-6">

                        <div class="d-flex flex-stack flex-grow-1 ">
                            <div class=" fw-semibold">

                                <div class="fs-6 text-gray-700 ">Se considera "destiempo" si la tarea no esta o no fue
                                    completada antes de la fecha límite indicada por el encargado.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-lg-6 mb-6">
            <!--begin::Card-->
            <div class="card card-flush h-lg-100">
                <!--begin::Card header-->
                <div class="card-header mt-6">
                    <!--begin::Card title-->
                    <div class="card-title flex-column">
                        <h3 class="fw-bold mb-1">CALENDARIO DE TAREAS</h3>
                        <?php
                        include('../config.php');
                        $sql1 = "SELECT id, nombre, fechaInicio, fechaFin, DATEDIFF(fechaFin, fechaInicio) AS cantidad_dias FROM proyectos WHERE id = '$idProyecto'";
                        $query1 = mysqli_query($con, $sql1);
                        $sql = "SELECT proyectos.id, proyectos.nombre, proyectos.fechaInicio, proyectos.fechaFin, DATEDIFF(proyectos.fechaFin, proyectos.fechaInicio) AS cantidad_dias, proyectosTareas.fechaFin AS fechaLimite FROM proyectos JOIN proyectosTareas ON proyectos.id=proyectosTareas.idProyecto WHERE proyectos.id = '$idProyecto'";
                        $query = mysqli_query($con, $sql);
                        $tareas = mysqli_fetch_all($query, MYSQLI_ASSOC);
                        // Verifica que la consulta haya retornado un resultado
                        if($query1 && mysqli_num_rows($query1) > 0) {
                            $result = mysqli_fetch_assoc($query1);
                            $fechaInicio = new DateTime($result['fechaInicio']);
                            $fechaFin = new DateTime($result['fechaFin']);
                            // Incrementar un día porque la fecha final es inclusiva
                            $fechaFin->modify('+1 day'); 
                            echo "<div class='fs-6 text-gray-500'>El proyecto abarca " . $result['cantidad_dias'] . " días.</div>";
                        ?>
                    </div>

                </div>

                <div class="card-body p-9 pt-0">
                    <ul class="nav nav-pills d-flex flex-nowrap hover-scroll-x py-2" role="tablist">
                        <?php
                        setlocale(LC_TIME, 'es_ES.UTF-8', 'Spanish_Spain.1252');
                        $fechasUnicas = [];
                        foreach ($tareas as $tarea) {
                            // Convertimos la fechaLimite a un objeto DateTime
                            $fechaLimite = new DateTime($tarea['fechaLimite']);
                            // Creamos un string de la fecha para usar como clave
                            $fechaClave = $fechaLimite->format('Y-m-d');
                            if (!array_key_exists($fechaClave, $fechasUnicas)) { // Verifica si esta fecha ya fue agregada
                                $fechasUnicas[$fechaClave] = $fechaLimite; // Agrega la fecha al array con la clave en formato Y-m-d
                            }
                        }

                        // Ordenamos las fechas
                        ksort($fechasUnicas);

                        foreach ($fechasUnicas as $fecha) {
                            $dia = $fecha->format('j'); // 'j' dará el día sin ceros iniciales
                            $dayOfWeek = strftime('%a', $fecha->getTimestamp()); // Abreviatura del día de la semana en español
                            echo "<li class='nav-item me-1' role='presentation'>
                                    <a class='nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-active-primary'
                                        data-bs-toggle='tab' href='#kt_schedule_day_$dia' aria-selected='false' tabindex='-1' role='tab'>
                                        <span class='opacity-50 fs-7 fw-semibold'>$dayOfWeek</span>
                                        <span class='fs-6 fw-bold'>$dia</span>
                                    </a>
                                </li>";
                        }
                        ?>
                    </ul>
                    <?php
                    } else {
                        echo "<div class='fs-6 text-gray-500'>Información no disponible.</div>";
                    }
                    ?>
                    <div class="tab-content">
                        <div id="kt_schedule_initial_message" class="tab-pane fade show active" role="tabpanel">
                            <div class="d-flex flex-stack position-relative mt-2">
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <div class="fs-5 fw-bold text-gray-800">Seleccione un día para ver las tareas
                                        asignadas a ese día.</div>
                                </div>
                            </div>
                        </div>
                        <?php
                        $sqlTareas = "SELECT * FROM proyectosTareas WHERE idProyecto = '$idProyecto' ORDER BY fechaFin ASC";
                        $queryTareas = mysqli_query($con, $sqlTareas);
                        $tareas = mysqli_fetch_all($queryTareas, MYSQLI_ASSOC);

                        // Inicializa un array para agrupar las tareas por fecha
                        $tareasPorFecha = [];
                        foreach ($tareas as $tarea) {
                            $fechaFin = new DateTime($tarea['fechaFin']);
                            $fechaClave = $fechaFin->format('Y-m-d');
                            $tareasPorFecha[$fechaClave][] = $tarea; // Agrega la tarea al array de su fecha correspondiente
                        }

                        foreach ($tareasPorFecha as $fecha => $tareasDeEseDia) {
                            $fechaObj = new DateTime($fecha);
                            $dia = $fechaObj->format('j'); // 'j' dará el día sin ceros iniciales
                            ?>
                        <div id="kt_schedule_day_<?php echo $dia; ?>" class="tab-pane fade" role="tabpanel">
                            <?php foreach ($tareasDeEseDia as $tarea): ?>
                            <div class="d-flex flex-stack position-relative mt-2">
                                <!-- Tu contenido para cada tarea aquí -->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!-- Descripción de la tarea -->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                        <?php echo $tarea['nombre']; ?>
                                    </a>
                                </div>
                                <a href="/../proyectos/tareas?idProyecto=<?php echo $idProyecto ?>"
                                    class="btn btn-bg-light btn-active-color-primary btn-sm">Ver</a>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-6">
            <!--begin:Card-->
            <div class="card card-flush h-lg-100">
                <!--begin::Card header-->
                <div class="card-header mt-6">
                    <!--begin::Card title-->
                    <div class="card-title flex-column">
                        <h3 class="fw-bold mb-1">CONTRIBUIDORES</h3>
                        <?php
                        include('../config.php');
                        $sqlContri = ("SELECT 
                        u.imagen, 
                        u.nombres, 
                        u.apellidos,
                        u.rol,
                        p.id AS idProyecto, 
                        pi.fechaAdd, 
                        pi.fechaEstado, 
                        pi.idUsuario, 
                        COALESCE(t.cantidad, 0) AS cantidad
                    FROM 
                        proyectos p
                    JOIN 
                        proyectosInfo pi ON p.id = pi.idProyecto
                    LEFT JOIN 
                        usuarios u ON pi.idUsuario = u.id
                    LEFT JOIN (
                        SELECT 
                            pt.idProyecto, 
                            ti.idUsuario, 
                            COUNT(ti.id) AS cantidad
                        FROM 
                            proyectosTareas pt
                        JOIN 
                            tareasInfo ti ON pt.id = ti.idTarea
                        WHERE 
                            pt.idProyecto = '$idProyecto'
                        GROUP BY 
                            pt.idProyecto, ti.idUsuario
                    ) t ON p.id = t.idProyecto AND pi.idUsuario = t.idUsuario
                    WHERE 
                        p.id = '$idProyecto' and u.rol!='cliente'
                    GROUP BY 
                        pi.idUsuario;");
                        $queryContri = mysqli_query($con, $sqlContri);
                        if ($queryContri) {
                            $totalContribuidores = mysqli_num_rows($queryContri); // Contamos el total de registros
                        }?>
                        <div class="fs-6 text-gray-500">El proyecto tiene <?php echo $totalContribuidores; ?>
                            proveedor(es).
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <a href="/../proyectos/miembros?idProyecto=<?php echo $idProyecto ?>"
                            class="btn btn-bg-light btn-active-color-primary btn-sm">Ver</a>
                    </div>
                </div>

                <div class="card-body d-flex flex-column p-9 pt-3 ">
                    <?php while ($DataContri = mysqli_fetch_assoc($queryContri)) {    ?>
                    <div class="d-flex align-items-center mb-5">
                        <div class="me-5 position-relative">
                            <?php
                                if ($DataContri['imagen'] != "blank.png") {
                                        echo '<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip"
                                                title="' . $DataContri['nombres'] . ' ' . $DataContri['apellidos'] . '">
                                                <img src="assets/media/avatars/' . $DataContri['imagen'] . '" alt="user-image">
                                            </div>';
                                    } else {
                                        $iniciales = substr($DataContri['nombres'], 0, 1) . substr($DataContri['apellidos'], 0, 1);
                                        echo '<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip"
                                                title="' . $DataContri['nombres'] . ' ' . $DataContri['apellidos'] . '">
                                                <span class="symbol-label bg-dark text-inverse-primary fw-bold">' . $iniciales . '</span>
                                            </div>';
                                    }
                                ?>
                        </div>
                        <div class="fw-semibold">
                            <a class="fs-5 fw-bold text-gray-900 text-hover-primary"><?php echo $DataContri['nombres']; ?>
                                <?php echo $DataContri['apellidos']; ?></a>

                        </div>
                        <div class="badge badge-light ms-auto"><?php echo $DataContri['cantidad']; ?> tareas
                        </div>
                    </div>
                    <?php } ?>

                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-6">
            <div class="card card-flush h-lg-100">
                <div class="card-header mt-6">
                <?php
                        include('../config.php');
                        $sqlArchivos = ("SELECT proyectosTareas.nombre,proyectosDocumentos.fechaAdd,proyectosDocumentos.documento,proyectosDocumentos.extension,proyectosDocumentos.link FROM `proyectosTareas` INNER JOIN proyectosDocumentos ON proyectosTareas.id = proyectosDocumentos.idProyectoTarea WHERE proyectosTareas.idProyecto = '$idProyecto' ORDER BY proyectosTareas.id DESC LIMIT 5;");
                        $queryArchivos = mysqli_query($con, $sqlArchivos);
                        if ($queryArchivos) {
                            $totalArchivos = mysqli_num_rows($queryArchivos); // Contamos el total de registros
                        }?>
                    <div class="card-title flex-column">
                        <h3 class="fw-bold mb-1">Archivos subidos</h3>
                        <div class="fs-6 text-gray-500">Ultimos 5 archivos subidos.</div>
                    </div>

                    <div class="card-toolbar">
                        <a href="/../proyectos/archivos?idProyecto=<?php echo $idProyecto ?>" class="btn btn-bg-light btn-active-color-primary btn-sm">Ver</a>
                    </div>
                </div>
                <div class="card-body p-9 pt-3">
                    <div class="d-flex flex-column">
                        <?php while ($DataArchivo = mysqli_fetch_assoc($queryArchivos)) {    
                            $fecha = $DataArchivo['fechaAdd'];
                            setlocale(LC_TIME, 'es_ES'); // Establecer la configuración regional a español
                            $fechaFormateada = strftime("%d de %B del %Y", strtotime($fecha));?>
                            <div class="d-flex align-items-center mb-5">
                                <div class="symbol symbol-30px me-5">
                                    <img alt="Icon" src="/assets/media/svg/files/<?php echo $DataArchivo['extension']; ?>.svg">
                                </div>
                                <div class="fw-semibold">
                                    <a class="fs-6 fw-bold text-gray-900 text-hover-primary" href="/assets/documentos/<?php echo $DataArchivo['documento']; ?>"><?php echo $DataArchivo['nombre']; ?> - <?php echo $DataArchivo['documento']; ?></a>
                                    <div class="text-gray-500">
                                    <?php echo $fechaFormateada ?> 
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>