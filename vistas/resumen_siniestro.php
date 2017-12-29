<?php
$resumenSiniestro = $_SESSION['resumensiniestro'];

$tiposSiniestro = $GLOBALS['tiposSiniestros'];
$tiposSiniestrosLimpios = [];
foreach ($tiposSiniestro as $k => $v) {
    $tiposSiniestrosLimpios[$v['id']] = $v['tipo'];
}

$tiposVehiculos = $GLOBALS['tiposVehiculos'];
$tiposVehiculosLimpios = [];
foreach ($tiposVehiculos as $k => $v) {
    $tiposVehiculosLimpios[$v['id']] = $v['tipo'];
}

$tiposSeguridad = $GLOBALS['tiposSeguridad'];
$tiposSeguridadLimpios = [];
foreach ($tiposSeguridad as $k => $v) {
    $tiposSeguridadLimpios[$v['id']] = $v['tipo'];
}

$tiposServicio = $GLOBALS['tiposServicio'];
$tiposServicioLimpios = [];
foreach ($tiposServicio as $k => $v) {
    $tiposServicioLimpios[$v['id']] = $v['tipo'];
}

$tiposEventos = $GLOBALS['tiposEventos'];
$tiposEventosLimpios = [];
foreach ($tiposEventos as $k => $v) {
    $tiposEventosLimpios[$v['id']] = $v['tipo'];
}

$victimasLimpias = [];
foreach ($resumenSiniestro['victimas_info'] as $victima) {
    $victimasLimpias[$victima['id']] = $victima;
}

$resumenSiniestro['tipo'] = $tiposSiniestrosLimpios[$resumenSiniestro['tipo']];

$victimasInfoLimpias = [];
foreach ($resumenSiniestro['victimas_info'] as $victima) {
    $victimasInfoLimpias[$victima['id']] = $victima;
    $victimasInfoLimpias[$victima['id']]['seguridad'] = $tiposSeguridadLimpios[$victima['seguridad']];
    $victimasInfoLimpias[$victima['id']]['sexo'] = $victima['sexo'] == 0 ? 'Masculino' : 'Femenino';
}

foreach ($resumenSiniestro['vehiculos_info'] as &$vehiculo) {
    $vehiculo['tipo_vehiculo'] = $tiposVehiculosLimpios[$vehiculo['tipo_vehiculo']];
    $vehiculo['tipo_siniestro'] = $tiposSiniestrosLimpios[$vehiculo['tipo_siniestro']];
    $vehiculo['servicio'] = $tiposServicioLimpios[$vehiculo['servicio']];
    $chofer = $victimasLimpias[$vehiculo['chofer']];
    $vehiculo['chofer'] = "{$chofer['nombre']} {$chofer['apellido']}, {$chofer['edad']}";
}

?>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <h3>Siniestro <?= $resumenSiniestro['codigo'] ?></h3>
            <p class="h4">
                Calle <?= $resumenSiniestro['calle'] ?>,
                Colonia <?= $resumenSiniestro['colonia'] ?>,
                Delegacion <?= $resumenSiniestro['delegacion'] ?>,
                <?= $resumenSiniestro['municipio'] ?>
            </p>
        </div>
    </div>
    <div class="mapa">

        <iframe
                id="mapa"
                frameborder="0" style="border:0"
                src="https://www.google.com/maps/embed/v1/place?key=AIzaSyD5AJlyTybWZYeg4zQiof4neuPIUfGFToI&zoom=14&language=es_MX&q=<?= $resumenSiniestro['lat'] . ',' . $resumenSiniestro['lng'] ?>"
                allowfullscreen class="w-100">
        </iframe>

    </div>
    <div class="h3">Victimas:</div>
    <table class="table table-responsive table-condensed">
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Edad</th>
            <th>Estado</th>
            <th>Obs.</th>
        </tr>
        </thead>
        <tbody>
        <?php

        foreach ($resumenSiniestro['victimas_info'] as $victima) {
            echo <<<HTML
<tr>
<td>{$victima['nombre']} {$victima['apellido']}</td>
<td>{$victima['edad']}</td>
<td>{$victima['tipo']}</td>
<td>{$victima['observacion']}</td>
</tr>
HTML;

        }
        ?>
        </tbody>
    </table>

    <div class="h3">Veh&iacute;culos:</div>
    <table class="table table-responsive table-condensed">
        <thead>
        <tr>
            <th>Marca</th>
            <th>Modelo</th>
            <th>A&ntilde;o</th>
            <th>Servicio</th>
            <th>Chofer</th>
            <th>Obs.</th>
        </tr>
        </thead>
        <tbody>
        <?php

        foreach ($resumenSiniestro['vehiculos_info'] as $vehiculo_siniestro) {
            echo <<<HTML
<tr>
<td>{$vehiculo_siniestro['marca']}</td>
<td>{$vehiculo_siniestro['modelo']}</td>
<td>{$vehiculo_siniestro['anio']}</td>
<td>{$vehiculo_siniestro['servicio']}</td>
<td>{$vehiculo_siniestro['chofer']}</td>
<td>{$vehiculo_siniestro['observacion']}</td>
</tr>
HTML;

        }
        ?>
        </tbody>
    </table>
    <div class="spacer"></div>
    <div class="row">
        <a href="/?json" class="form-control btn btn-warning">Mostrar JSON</a>
    </div>
    <div class="row">
        <a href="/?landing" class="form-control btn btn-info">Regresar al inicio</a>
    </div>
</div>

