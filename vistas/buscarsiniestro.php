<div class="container">
    <div class="page-header">
        <h2>Buscar siniestro</h2>
    </div>
    <div class="spacer"></div>
    <form action="/api.php" method="post">
        <input type="hidden" name="fn" value="buscar_siniestro">
        <div class="row">
            <div class="col-xs-12 ">
                <label for="" class="form-control-static">Siniestro</label>
            </div>
            <div class="col-xs-12">
                <input type="text" name="siniestro" placeholder="" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <input type="submit" value="Buscar" class="form-control btn btn-info">
            </div>
        </div>

    </form>
</div>