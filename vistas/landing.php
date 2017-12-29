<?php
foreach ($_SESSION as $k => $v) {
    $$k = $v;
}

//var_dump($_SESSION);
?>
    <div class="fullscreen">
        <div class="container center-center">
            <div class="">
                <div class="">
                    <div class="alert alert-<?= $_SESSION['alerta']['tipo'] ?>"><?= $_SESSION['alerta']['msg'] ?></div>
                </div>
                <div class="col-xs-12">
                    <div class="col-xs-8 col-xs-offset-2">
                        <img src="/imagenes/<?= $departamento_abreviacion ?>.png" alt="" class="w-100 img-circle">
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="spacer3"></div>
                    <p class="h2 center-center">
                        <?= $nombre . ' ' . $apellido ?>
                    </p>
                    <p class="h4 center-center">
                        <?= $extra ?>
                    </p>
                </div>
                <div class="col-xs-12">
                    <p class="h3 center-center">
                        <?= $estacion ?>
                    </p>
                    <div class="spacer3"></div>
                    <div class="spacer3"></div>
                    <div class="spacer3"></div>
                </div>
            </div>
        </div>
    </div>
<?php

$_SESSION['alerta'] = ['tipo' => '', 'msg' => ''];