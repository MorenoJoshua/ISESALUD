<?php
foreach ($_SESSION['siniestro'] as $k => $v) {
    $$k = $v;
}
?>
Siniestro:
<ul>
    <li>Codigo c4: <?= $codigo ?>.</li>
    <li>Fecha/Hora: <?= $fecha ?>.</li>
    <li>Direccion entrada: <?= $direccion ?>.</li>
    <li>Coords: <?= $lat . ', ' . $lng ?>.</li>
    <li>V&iacute;ctimas: <?= $victimas ?>. <?= $victimas == count($victimasArray) ? '' : 'Faltan de agregar' ?>.</li>
    <li>Vehiculos: <?= $vehiculos ?>. <?= $vehiculos == count($vehiculosArray) ? '' : 'Faltan de agregar' ?>.</li>
</ul>
V&iacute;ctimas:
<ul>
    <?php
    foreach ($victimasArray as $victima) {
        $esfatal = $victima['fatal'] == 1 ? 'fatal' : 'no fatal';
        echo "<li>{$victima['nombre']} {$victima['apellido']}, $esfatal</li><pre>" . json_encode($victima, 128) . "</pre>";
    }
    ?>
</ul>

Veh&iacute;culos:
<ul>
    <?php
    foreach ($vehiculosArray as $vehiculo) {
        echo "<li>{$vehiculo['marca']} {$vehiculo['modelo']}, {$vehiculo['tipo']}<pre>" . json_encode($vehiculo, 128) . "</pre></li>";
    }
    ?>
</ul>