<div class="container">
    <div class="page-header"><h2>Crear Usuario</h2></div>
    <form action="/api.php" method="post">
        <input class="form-control" type="hidden" name="fn" value="crear_usuario">

        <div class="row">
            <div class="col-xs-12">
                <div class="">
                    <label for="email">Usuario</label>
                </div>
                <div class="">
                    <input class="form-control" type="text" name="email" required>
                </div>
            </div>
        </div>
        <label for="nombre">Nombre</label>
        <input class="form-control" type="text" name="nombre" required>
        <label for="apellido">Apellido</label>
        <input class="form-control" type="text" name="apellido" required>
        <label for="password">Contrase&ntilde;a</label>
        <input class="form-control" type="password" name="password" required>
        <label for="password_verify">Confirmar Contrase&ntilde;a</label>
        <input class="form-control" type="password" name="password_verify" required>
        <label for="departamento">Departamento</label>
        <select name="departamento" id="departamento" class="form-control departamento" required>
            <option value="">--Selecciona un departamento--</option>
            <option value="1">Cruz Roja</option>
            <option value="2">Bomberos</option>
            <option value="3">IT</option>
        </select>
        <label for="estacion">Estacion</label>
        <input type="text" name="estacion" class="form-control estacion" id="estacion" required>
        <label for="estacion">Matricula</label>
        <input type="text" name="extra" class="form-control extra" id="extra">

        <div class="row text-center" id="continuar">
            <div class="col-xs-12">
                <button type="submit" class="submitBtn"><img src="/imagenes/siguiente.png" alt=""></button>
            </div>
        </div>

    </form>
</div>