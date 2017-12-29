<div class="container">
    <div class="page-header">
        <h2>Buscar siniestro</h2>
    </div>

    <div>
        <?php
        if (count($_SESSION['busqueda']) == 0) {
            echo 'No se encontraron resultados';
        }
        foreach ($_SESSION['busqueda'] as $resultado) {
            echo <<<HTML
        
        <form action="/api.php" method="post">
        <input type="hidden" name="fn" value="resumen_siniestro">
        <input type="hidden" name="siniestro" value="{$resultado['id']}">
        <input class="form-control" type="submit" value="Siniestro {$resultado['codigo']}">
</form>
HTML;

        }
        ?>
    </div>
    <div class="spacer"></div>
    <div class="row">
        <div class="col-xs-12">
            <a href="/?buscarsiniestro" class="form-control btn btn-info">Regresar</a>
        </div>
    </div>

</div>


