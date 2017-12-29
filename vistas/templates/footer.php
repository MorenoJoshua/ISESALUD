<?php


switch ($GLOBALS['vistaActiva']) {
    case 'resultados_busqueda':
    case 'resumen_siniestro':
    case 'nuevosiniestro':
        echo <<<HTML
        <div class="bottom-padding"></div>
HTML;

        break;
    default:
        break;
}
switch ($GLOBALS['vistaActiva']) {
    case '':
    case 'agregar_victima':
    case 'agregar_vehiculo':
        break;
    default:
        ?>
        <div class="kc_fab_wrapper"></div>
        <script src="/fab.js"></script>
        <script>
            $(document).ready(function () {
                var links = [
                    {
                        "bgcolor": "#31b0d5",
                        "icon": "+"
                    },
                    {
                        "url": "/?buscarsiniestro",
                        "bgcolor": "#2cb2d9",
                        "color": "#fffff",
                        "icon": "<img src='/imagenes/busqueda.png' class='icono'>",
                    },
                    {
                        "url": "/",
                        "bgcolor": "#2cb2d9",
                        "color": "#fffff",
                        "icon": "<img src='/imagenes/casa.png' class='icono'>",
                    },
                    <?php
                    if ($_SESSION['departamento_abreviacion'] != 'admin' && $_SESSION['departamento_abreviacion'] != 'it') {
                        echo <<<TEXT
                    {
                        "url": "/?nuevosiniestro",
                        "bgcolor": "green",
                        "color": "#fffff",
                        "icon": "<img src='/imagenes/lapiz.png' class='icono'>",
                    },
TEXT;


                    } else {
                        echo <<<TEXT
            {
                "url": "/?crear_usuario",
                "bgcolor": "teal",
                "color": "#fffff",
                "icon": "<img src='/imagenes/crear.png' class='icono'>",
            },
TEXT;

                    }


                    ?>
                    {
                        "url": "/?ayuda",
                        "bgcolor": "red",
                        "color": "#fffff",
                        "icon": "<img src='/imagenes/seguro.png' class='icono'>",
                    }
                ];
                $('.kc_fab_wrapper').kc_fab(links);
            });
        </script>

        <?php
}

switch ($GLOBALS['vistaActiva']) {
    case 'nuevosiniestro':
    case 'agregar_victima':
    case 'agregar_vehiculo':
        echo <<<HTML
<footer></footer>
HTML;

        break;
}

?>
</body>
</html>