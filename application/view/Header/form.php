<form action='<?php echo $path->getEvent('main', 'login'); ?>' method='POST'>
  <div class="form-group">
    <label><b>Usuario</b></label>
    <input type="email" class="form-control" pattern='(?!^\d+$)^.+$' placeholder='Ingrese su Usuario' name='email' required>
  </div>
  <div class="form-group">
    <label><b>Contrase&ntilde;a</b></label>
    <input type="password" class="form-control" placeholder="Ingrese su Contrase&ntilde;a" name="password" required>
  </div>
  <div class="form-group">
    <input class="w3-check w3-margin-top" type="checkbox">
    <label class="form-check-label" for="exampleCheck1">Recordarme</label>
  </div>
  <button type="submit" class="btn btn-primary" name="ingresar" type="submit">Ingresar</button>
</form>
<div>
  <span>Olvidaste tu contraseña <a href="#"> Contrase&ntilde;a?</a></span>
</div>
<div>
  <span>No tenes cuenta todavia?<a href data-toggle="modal" data-target="#exampleModal"> Registrate</a></span>
</div>
