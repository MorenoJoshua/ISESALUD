<?php
$checkboxes = '';
foreach ($_SESSION['victimas'] as $k => $victima) {
    $checkboxes .= <<<HTML
<label><input type="checkbox" name="victima[]" value="$k"> {$victima['nombre']} {$victima['apellido']}, {$victima['edad']}</label><br>
HTML;
}

?>


<div class="container">
    <div class="page-header"><h2>Captura de Veh&iacute;culo</h2></div>
    <form action="/api.php" method="post">

        <input type="hidden" name="fn" value="agregar_vehiculo">
        <input type="hidden" name="siniestro" id="siniestro" class="form-control siniestro"
               value="<?= $_SESSION['activo']['siniestro'] ?>">


        <div class="row">
            <div class="col-xs-6">
                <div class="">
                    <label for="tipo_vehiculo" class="form-control-static">Tipo de Veh&iacute;culo</label>
                </div>
                <div class="">
                    <select name="tipo_vehiculo" id="tipo_vehiculo" class="form-control tipo_vehiculo">
                        <?php
                        foreach ($GLOBALS['tiposVehiculos'] as $tipo) {
                            echo <<<HTML
<option value="{$tipo['id']}">{$tipo['tipo']}</option>
HTML;

                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="">
                    <label for="marca" class="form-control-static">Marca</label>
                </div>
                <div class="">
                    <input type="text" name="marca" id="marca" class="form-control marca">
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-xs-6">
                <div class="">

                    <label for="modelo" class="form-control-static">Modelo</label>
                </div>
                <div class="">

                    <input type="text" name="modelo" id="modelo" class="form-control modelo">
                </div>
            </div>
            <div class="col-xs-6">
                <div class="">
                    <label for="anio" class="form-control-static">A&ntilde;o</label>

                </div>
                <div class="">
                    <input type="number" name="anio" min="0" max="2017" id="anio" class="form-control anio">

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-6">
                <div class="">
                    <label for="color" class="form-control-static">Color</label>
                </div>
                <div class="">
                    <input type="text" name="color" id="color" class="form-control color">
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-xs-6">
                <div class="">
                    <label for="servicio" class="form-control-static">Tipo de Servicio</label>

                </div>
                <div class="">
                    <select name="servicio" id="servicio" class="form-control servicio">
                        <?php
                        foreach ($GLOBALS['tiposServicio'] as $tipo) {
                            echo <<<HTML
<option value="{$tipo['id']}">{$tipo['tipo']}</option>
HTML;

                        }
                        ?>
                    </select>

                </div>
            </div>
            <div class="col-xs-6">
                <div class="">
                <label for="chofer" class="form-control-static">Chofer</label>
                </div>
                <div class="">
                <select name="chofer" id="chofer" class="form-control chofer">
                    <?php
                    foreach ($_SESSION['victimas'] as $victima) {
                        echo <<<HTML
<option value="{$victima['id']}">{$victima['nombre']} {$victima['apellido']}, {$victima['edad']}</option>
HTML;

                    }
                    ?>
                </select>
                </div>
            </div>
        </div>




        <div class="row">
            <div class="col-xs-12 ">
                <label for="" class="form-control-static">Pasajeros</label>
            </div>
            <div class="col-xs-12">
                <?= $checkboxes ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 ">
                    <label for="observaciones" class="form-control-static">Observaciones</label>
            </div>
            <div class="col-xs-12">
            <textarea name="observaciones" id="observaciones"
                      class="form-control observaciones"></textarea>
            </div>
        </div>

        <div class="row text-center" id="continuar">
            <div class="col-xs-12">
                <button type="submit" class="submitBtn"><img src="/imagenes/siguiente.png" alt=""></button>
            </div>
        </div>
    </form>
</div>