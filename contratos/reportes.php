<!DOCTYPE html>
<?php  if ($session_rol != "invitado" and $session_rol != "cliente" and $session_rol != "proveedor" ) {?>
<html lang="es">
<?php include_once '../assets/controlador/sesion.php'?>
<?php include_once '../assets/vista/contratos/head-reportes.php'?>

<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed">
    <?php include_once '../assets/vista/contratos/body-reportes.php'?>
    <script>
    var hostUrl = "assets/";
    </script>
    <?php
    include('../config.php');
    $sqlchart = ("SELECT DATE_FORMAT(c.fechaFin, '%Y-%m') AS mes, SUM(CASE WHEN u.rol = 'cliente' THEN 1 ELSE 0 END) AS total_registros_rol1, SUM(CASE WHEN u.rol = 'proveedor' THEN 1 ELSE 0 END) AS total_registros_rol2,
        CASE
            WHEN DATE_FORMAT(c.fechaFin, '%m') = '01' THEN 'Enero'
            WHEN DATE_FORMAT(c.fechaFin, '%m') = '02' THEN 'Febrero'
            WHEN DATE_FORMAT(c.fechaFin, '%m') = '03' THEN 'Marzo'
            WHEN DATE_FORMAT(c.fechaFin, '%m') = '04' THEN 'Abril'
            WHEN DATE_FORMAT(c.fechaFin, '%m') = '05' THEN 'Mayo'
            WHEN DATE_FORMAT(c.fechaFin, '%m') = '06' THEN 'Junio'
            WHEN DATE_FORMAT(c.fechaFin, '%m') = '07' THEN 'Julio'
            WHEN DATE_FORMAT(c.fechaFin, '%m') = '08' THEN 'Agosto'
            WHEN DATE_FORMAT(c.fechaFin, '%m') = '09' THEN 'Septiembre'
            WHEN DATE_FORMAT(c.fechaFin, '%m') = '10' THEN 'Octubre'
            WHEN DATE_FORMAT(c.fechaFin, '%m') = '11' THEN 'Noviembre'
            WHEN DATE_FORMAT(c.fechaFin, '%m') = '12' THEN 'Diciembre'
        END AS nombre_mes FROM contratos c INNER JOIN usuarios u ON c.idUsuario = u.id  WHERE c.fechaFin >= DATE_SUB(CURDATE(), INTERVAL 12 MONTH) GROUP BY DATE_FORMAT(c.fechaFin, '%Y-%m') ORDER BY mes;");
    $querychart = mysqli_query($con, $sqlchart);
    ?>
    <script src="assets/plugins/global/plugins.bundle.js"></script>
    <script src="assets/js/scripts.bundle.js"></script>
    <script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
    <script src="assets/js/widgets.bundle.js"></script>
    <script src="assets/js/custom/widgets.js"></script>
    <script src="assets/js/custom/apps/chat/chat.js"></script>
    <script src="assets/js/custom/utilities/modals/create-app.js"></script>
    <script src="assets/js/custom/utilities/modals/users-search.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Mes', 'Cliente', 'Proveedor'],
          <?php  while ($dataChart = mysqli_fetch_array($querychart)) { ?>
          ['<?php echo $dataChart['nombre_mes']; ?>',<?php echo $dataChart['total_registros_rol1']; ?>,<?php echo $dataChart['total_registros_rol2']; ?>],
          <?php } ?>
        ]);

        var options = {
          
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material2'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
    
    </script>
    <?php
    include('../config.php');
    $sqlchart1 = ("SELECT DATE_FORMAT(c.fechaInicio, '%Y-%m') AS mes, SUM(CASE WHEN u.rol = 'cliente' THEN 1 ELSE 0 END) AS total_registros_rol1, SUM(CASE WHEN u.rol = 'proveedor' THEN 1 ELSE 0 END) AS total_registros_rol2,
        CASE
            WHEN DATE_FORMAT(c.fechaInicio, '%m') = '01' THEN 'Enero'
            WHEN DATE_FORMAT(c.fechaInicio, '%m') = '02' THEN 'Febrero'
            WHEN DATE_FORMAT(c.fechaInicio, '%m') = '03' THEN 'Marzo'
            WHEN DATE_FORMAT(c.fechaInicio, '%m') = '04' THEN 'Abril'
            WHEN DATE_FORMAT(c.fechaInicio, '%m') = '05' THEN 'Mayo'
            WHEN DATE_FORMAT(c.fechaInicio, '%m') = '06' THEN 'Junio'
            WHEN DATE_FORMAT(c.fechaInicio, '%m') = '07' THEN 'Julio'
            WHEN DATE_FORMAT(c.fechaInicio, '%m') = '08' THEN 'Agosto'
            WHEN DATE_FORMAT(c.fechaInicio, '%m') = '09' THEN 'Septiembre'
            WHEN DATE_FORMAT(c.fechaInicio, '%m') = '10' THEN 'Octubre'
            WHEN DATE_FORMAT(c.fechaInicio, '%m') = '11' THEN 'Noviembre'
            WHEN DATE_FORMAT(c.fechaInicio, '%m') = '12' THEN 'Diciembre'
        END AS nombre_mes FROM contratos c INNER JOIN usuarios u ON c.idUsuario = u.id  WHERE c.fechaInicio >= DATE_SUB(CURDATE(), INTERVAL 12 MONTH) GROUP BY DATE_FORMAT(c.fechaInicio, '%Y-%m') ORDER BY mes;");
    $querychart1 = mysqli_query($con, $sqlchart1);
    ?>
    <script src="assets/plugins/global/plugins.bundle.js"></script>
    <script src="assets/js/scripts.bundle.js"></script>
    <script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
    <script src="assets/js/widgets.bundle.js"></script>
    <script src="assets/js/custom/widgets.js"></script>
    <script src="assets/js/custom/apps/chat/chat.js"></script>
    <script src="assets/js/custom/utilities/modals/create-app.js"></script>
    <script src="assets/js/custom/utilities/modals/users-search.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Mes', 'Cliente', 'Proveedor'],
          <?php  while ($dataChart1 = mysqli_fetch_array($querychart1)) { ?>
          ['<?php echo $dataChart1['nombre_mes']; ?>',<?php echo $dataChart1['total_registros_rol1']; ?>,<?php echo $dataChart1['total_registros_rol2']; ?>],
          <?php } ?>
        ]);

        var options = {
          
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material1'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
</body>
</html>
<?php } else{
header("location: ../panel/index.php");
} ?>