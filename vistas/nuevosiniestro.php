<div class="container">
    <div class="page-header"><h2>Captura de siniestro</h2></div>
    <form action="/api.php" method="post">
        <input type="hidden" name="fn" value="agregar_siniestro">
        <input type="hidden" class="form-control lat" name="lat" id="lat">
        <input type="hidden" class="form-control lng" name="lng" id="lng">


        <div class="row">
            <div class="col-xs-6">
                <div class="">
                    <label for="codigo" class="form-control-static">Siniestro:</label>

                </div>
                <div class="">
                    <input type="text" class="form-control codigo" name="codigo" id="codigo"
                           required>

                </div>
            </div>
            <div class="col-xs-6">
                <div class="">

                    <label for="fecha" class="form-control-static">Hora/Fecha</label>
                </div>
                <div class="">
                    <input type="datetime-local" class="form-control fecha" name="fecha" id="fecha"
                           required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-6">
                <div class="">
                    <label for="municipio" class="form-control-static">Municipio</label>
                </div>
                <div class="">
                    <input type="text" class="form-control direccion" name="municipio" id="municipio"

                           required>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="">
                    <label for="delegacion" class="form-control-static">Delegaci&oacute;n</label>
                </div>
                <div class="">
                    <input type="text" class="form-control direccion" name="delegacion" id="delegacion"

                           required>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-xs-6">
                <div class="">
                    <label for="colonia" class="form-control-static">Colonia</label>
                </div>
                <div class="">
                    <input type="text" class="form-control direccion" name="colonia" id="colonia"

                           required>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="">
                    <label for="calle" class="form-control-static">Calle</label>
                </div>
                <div class="">
                    <input type="text" class="form-control direccion" name="calle" id="calle"

                           required>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-xs-6">
                <div class="">

                    <label for="tipo" class="form-control-static">Tipo de siniestro</label>
                </div>
                <div class="">

                    <select name="tipo" id="tipo" class="form-control tipo" required>
                        <option value="">--Selecciona un tipo--</option>
                        <?php

                        $tiposSiniestros = $GLOBALS['tiposSiniestros'];

                        foreach ($tiposSiniestros as $tipo) {
                            echo <<<HTML
<option value="${tipo['id']}">{$tipo['tipo']}</option>
HTML;

                        }

                        ?>
                    </select>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="">
                    <label for="" class="form-control-static">V&iacute;ctimas Fatales:</label>
                </div>
                <div class="">
                    <input type="number" min="0" step="1" name="fatal" id="fatal" class="form-control fatal"
                           required>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-xs-6">
                <div class="">
                    <label for="leve" class="form-control-static">Lesionados leves:</label>
                </div>
                <div class="">
                    <input type="number" min="0" step="1" name="leve" id="leve" class="form-control leve"
                           required>

                </div>
            </div>
            <div class="col-xs-6">
                <div class="">
                    <label for="grave" class="form-control-static">Lesionados graves:</label>

                </div>
                <div class="">
                    <input type="number" min="0" step="1" name="grave" id="grave" class="form-control grave"
                           required>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-6">
                <div class="">
                    <label for="vehiculos" class="form-control-static">Cant. Veh&iacute;culos</label>
                </div>
                <div class="">
                    <input type="number" min="1" step="1" class="form-control vehiculos" name="vehiculos" id="vehiculos"
                           required>
                </div>
            </div>
        </div>

        <?php
        if($_SESSION['departamento_abreviacion'] == 'b'){
            ?>
            <div class="row">
                <div class="col-xs-12">
                    <div class="">
                        <label for="bombero_unidades">Unidades involucradas</label>
                    </div>
                    <div class="">
                        <textarea name="bombero_unidades" id="bombero_unidades" cols="30" rows="10"></textarea>
                    </div>
                </div>
            </div>
        <?php
        }

        ?>

        <div class="row text-center" id="continuar">
            <div class="col-xs-12">
                <button type="submit" class="submitBtn"><img src="/imagenes/siguiente.png" alt=""></button>
            </div>

        </div>

    </form>
    <script>
        String.prototype.padZero = function (len, c) {
            var s = this, c = c || '0';
            while (s.length < len) s = c + s;
            return s;
        };
        function fillPos(geo) {
            document.querySelector('.lat').value = geo.coords.latitude;
            document.querySelector('.lng').value = geo.coords.longitude;

            var hora = '';
            date = new Date;
            year = '' + date.getFullYear();
            month = '' + (date.getMonth() + 1);
            d = '' + date.getDate();
            day = '' + date.getDay();
            h = '' + date.getHours();
            m = '' + date.getMinutes();
            s = '' + date.getSeconds();
            hora = year + '-' + month.padZero(2) + '-' + day.padZero(2) + 'T' + h.padZero(2) + ':' + m.padZero(2);
            console.log(hora);
            document.querySelector('.fecha').value = hora;
        }

        function errorGeo(error) {
            console.error(error);
        }

        navigator.geolocation.watchPosition(fillPos, errorGeo, {enableHighAccuracy: true, maximumAge: 0});
    </script>
</div>