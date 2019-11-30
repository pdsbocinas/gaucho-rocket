<form action='<?php echo $path->getEvent('main', 'register'); ?>' method='POST'>
  <div class="form-group">
    <label><b>Nombre de usuario</b></label>
    <input type="text" class="form-control" placeholder='Ingrese su Usuario' name='nombre_de_usuario' required>
  </div>
  <div class="form-group">
    <label><b>Mail</b></label>
    <input type="email" class="form-control" pattern='(?!^\d+$)^.+$' placeholder='Ingrese su Usuario' name='email' required>
  </div>
  <div class="form-group">
    <label><b>Contrase&ntilde;a</b></label>
    <input type="password" class="form-control" placeholder="Ingrese su Contrase&ntilde;a" name="password" required>
  </div>
  <div class="d-flex">
    <button type="submit" class="btn btn-primary mr-2" name="ingresar" type="submit">Ingresar</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
  </div>
</form>