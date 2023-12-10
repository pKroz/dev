<?php
include('../config.php');
$sql1 = ('SELECT contratos.id,usuarios.nombres,usuarios.apellidos,usuarios.rol,usuarios.imagen,usuarios.numero,contratos.fechaInicio,contratos.fechaFin,contratos.observacion,contratos.recomendacion,contratos.idUsuario FROM usuarios INNER JOIN contratos ON usuarios.id = contratos.idUsuario WHERE contratos.fechaInicio IS NOT NULL AND contratos.fechaFin IS NOT NULL ORDER BY contratos.id DESC;');
$query1 = mysqli_query($con, $sql1);
?>
<table class="table align-middle table-row-dashed fs-6 gy-5 " id="kt_table_users">
    <thead>
        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
            <th class="min-w-120px">
                Imagen
            </th>
            <th class="min-w-125px">Nombres</th>
            <th class="min-w-125px">Apellidos</th>
            <th class="min-w-125px">Rol</th>
            <th class="min-w-125px">Estado</th>
            <th class="min-w-125px" hidden>Fecha Inicio</th>
            <th class="min-w-125px" hidden>Fecha Fin</th>
            <th class="min-w-125px">Número</th>
            <th class="min-w-125px">Observación</th>
            <th class="min-w-125px">Recomendación</th>
            <th class="min-w-125px">Opciones</th>
        </tr>
    </thead>
    <tbody class="text-gray-600 fw-bold">
        <?php 
		$i = 1;
		while ($dataUsuario1 = mysqli_fetch_array($query1)) { ?>
        <tr>
            <td class="d-flex align-items-center">
                <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                    <a>
                        <div class="symbol-label">
                            <img src="assets/media/avatars/<?php echo $dataUsuario1['imagen']; ?>"
                                alt="<?php echo $dataUsuario1['nombres']; ?> <?php echo $dataUsuario1['apellidos']; ?>"
                                class="w-100" />
                        </div>
                    </a>
                </div>
            </td>
            <td ><?php echo $dataUsuario1['nombres']; ?></td>
            <td><?php echo $dataUsuario1['apellidos']; ?></td>
            <?php 
			if ($dataUsuario1['rol'] == "admin") { ?>A
            <td> <div class="badge badge-light-danger fw-bolder"><?php echo ucfirst($dataUsuario1['rol']); ?></div> </td>
            <?php } else if ($dataUsuario1['rol'] == "cliente") { ?>
            <td> <div class="badge badge-light-success fw-bolder"><?php echo ucfirst($dataUsuario1['rol']); ?></div> </td>
            <?php } else if ($dataUsuario1['rol'] == "proveedor"){ ?>
            <td> <div class="badge badge-light-warning fw-bolder"><?php echo ucfirst($dataUsuario1['rol']); ?></div> </td>
            <?php } else if ($dataUsuario1['rol'] == "usuario"){ ?>
            <td> <div class="badge badge-light-info fw-bolder"><?php echo ucfirst($dataUsuario1['rol']); ?></div> </td>
            <?php } else { ?>
            <td> <div class="badge badge-light-dark fw-bolder"><?php echo ucfirst($dataUsuario1['rol']); ?></div> </td>
            <?php } ?>

            <?php $fechaActual = date('Y-m-d'); 
            if ($dataUsuario1['fechaFin'] != "" and $dataUsuario1['fechaInicio'] != "" && strtotime($dataUsuario1['fechaFin']) < strtotime($fechaActual)) { ?>
             
                <td> <div class="badge badge-danger fw-bolder">Expirado</div> </td>
               
            <?php } else { ?>
            <?php  if ($dataUsuario1['fechaFin'] != "" and $dataUsuario1['fechaInicio'] != "") { ?>
                <td> <div class="badge badge-success fw-bolder">Contratado</div> </td>
            <?php }  else { ?>
                <td> <div class="badge badge-warning fw-bolder">Pendiente</div> </td>
            <?php } }?>
            <?php if ($dataUsuario1['fechaInicio'] == "") { ?>
            <td hidden> - </td>
            <?php } else { ?>
            <td hidden><?php echo date('d/m/Y', strtotime($dataUsuario1['fechaInicio'])); ?></td>
            <?php } ?>

            <?php if ($dataUsuario1['fechaFin'] == "") { ?>
            <td hidden> - </td>
            <?php } else { ?>
            <td hidden><?php echo date('d/m/Y', strtotime($dataUsuario1['fechaFin'])); ?></td>
            <?php } ?>
            <?php if ($dataUsuario1['numero'] == "-") { ?>
            <td><?php echo $dataUsuario1['numero']; ?></td>
            <?php } else { ?>
            <td><a href="https://wa.me/51<?php echo $dataUsuario1['numero']; ?>"><?php echo $dataUsuario1['numero']; ?></a> </td>
            <?php } ?>

            <td><?php echo $dataUsuario1['observacion']; ?></td>
            <td><?php echo $dataUsuario1['recomendacion']; ?></td>
            <?php $fechaActual = date('Y-m-d'); 
            if ($dataUsuario1['fechaFin'] != "" and $dataUsuario1['fechaInicio'] != "" && strtotime($dataUsuario1['fechaFin']) < strtotime($fechaActual)) { ?>
                <td>
                    <a href="../ejemplo.php?idUsuario=<?php echo $dataUsuario1['id']; ?>" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                        <span class="bi bi-eye-fill fs-7 opacity-50"></span>
                    </a>
                </td>
            <?php } else { ?>
            <?php  if ($dataUsuario1['fechaFin'] != "" and $dataUsuario1['fechaInicio'] != "") { ?>
                <td>
                    <a href="../ejemplo.php?idUsuario=<?php echo $dataUsuario1['id']; ?>" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                        <span class="bi bi-eye-fill fs-7 opacity-50"></span>
                    </a>
                </td>
            <?php } ?>
        </tr>
        <?php } ?>
        
        <?php } ?>
    </tbody>
</table>