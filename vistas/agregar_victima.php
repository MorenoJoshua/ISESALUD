<div class="container">
    <?php
    //que victima es?

    //    $cantdeVictimasPendientes =

    if ($_SESSION['activo']['fatal'] > 0) {
        $tipoDeVictima = 'fatal';
    } elseif ($_SESSION['activo']['grave'] > 0) {
        $tipoDeVictima = 'grave';
    } elseif ($_SESSION['activo']['leve'] > 0) {
        $tipoDeVictima = 'leve';
    } else {
        $tipoDeVictima = '';
        echo 'Hay un error x ahi';
    }

    //    var_dump($_SESSION['activo']);

    ?>
    <div class="page-header">
        <h2>V&iacute;ctima <?= $tipoDeVictima ?></h2>
    </div>
    <form action="/api.php" method="post" class="padd">

        <input type="hidden" name="fn" value="agregar_victima">
        <input type="hidden" name="tipo" id="tipo" class="form-control tipo"
               value="<?= $tipoDeVictima ?>">
        <input type="hidden" name="siniestro" value="<?= $_SESSION['activo']['id'] ?>">

        <div class="row">
            <div class="col-xs-12 ">
                <label for="nombre" class="form-control-static">Nombre</label>
            </div>
            <div class="col-xs-12">
                <input type="text" name="nombre" id="nombre" class="form-control nombre" required>
            </div>
        </div>


        <div class="row">
            <div class="col-xs-6">
                <div class="">
                    <label for="" class="form-control-static">Apellido Paterno</label>
                </div>
                <div class="">
                    <input type="text" name="apellido" id="apellido" class="form-control apellido" required>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="">
                    <label for="apellido_m" class="form-control-static">Apellido Materno</label>
                </div>
                <div class="">
                    <input type="text" name="apellido_m" id="apellido_m"
                           class="form-control apellido_m">
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-xs-6">
                <div class="">
                    <label for="seguridad" class="form-control-static">Sexo</label>
                </div>
                <div class="">
                    <select name="sexo" id="sexo" class="form-control" required>
                        <option value="">--Seleccionar Sexo--</option>
                        <option value="m">Masculino</option>
                        <option value="f">Femenino</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="">
                    <label for="edad" class="form-control-static">Edad</label>
                </div>
                <div class="">
                    <input type="number" min="0" max="199" name="edad" id="edad"
                           class="form-control edad">
                </div>

            </div>
        </div>


        <div class="row">
            <div class="col-xs-12 ">
                <label for="profesion" class="form-control-static">Profesi&oacute;n</label>
            </div>
            <div class="col-xs-12">
                <input type="text" name="profesion" id="profesion"
                       class="form-control profesion">
            </div>
        </div>

        <div class="row ">
            <div class="col-xs-6">
                <div class="">
                    <label for="alcoholemia" class="form-control-static">Alcoholemia</label>
                </div>
                <div class="">
                    <input type="number" step="0.01" min="0" max="10" name="alcoholemia"
                           id="alcoholemia"
                           class="form-control alcoholemia">
                </div>
            </div>
            <div class="col-xs-6">
                <div class="">
                    <label for="seguridad" class="form-control-static">Medida de seguridad</label>
                </div>
                <div class="">
                    <select name="seguridad" id="seguridad" class="form-control seguridad" required>
                        <option value="">--Selecciona una medida--</option>
                        <?php
                        foreach ($GLOBALS['tiposSeguridad'] as $seguridad) {
                            echo <<<HTML
<option value="{$seguridad['id']}">{$seguridad['tipo']}</option>
HTML;

                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>

        <?php

        if ($_SESSION['departamento_abreviacion'] == 'cr') {

            ?>
            <div class="row">
                <div class="col-xs-6">
                    <div class="">
                        <label for="cr_alergias">Alergias</label>
                    </div>
                    <div class="">
                        <input type="text" name="cr_alergias" class="form-control" id="cr_alergias">
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="">
                        <label for="cr_medicamentos">Medicamentos</label>
                    </div>
                    <div class="">
                        <input type="text" name="cr_medicamentos" class="form-control" id="cr_medicamentos">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <div class="">
                        <label for="cr_cirugias">Cirugias Previas</label>
                    </div>
                    <div class="">
                        <input type="text" name="cr_cirugias" class="form-control" id="cr_cirugias">
                    </div>
                </div>
            </div>
            <!--        alergias
                    medicamentos
                    cirugia previa-->
            <?php
        }
        ?>
        <div class="row">
            <div class="col-xs-12 ">
                <label for="observacion" class="form-control-static">Observaciones</label>
            </div>
            <div class="col-xs-12">
                    <textarea name="observacion" id="observacion"
                              class="form-control observacion"></textarea>
            </div>
        </div>
        <div class="row text-center" id="continuar">
            <div class="col-xs-12">
                <button type="submit" class="submitBtn"><img src="/imagenes/siguiente.png" alt=""></button>
            </div>
        </div>

    </form>
</div>