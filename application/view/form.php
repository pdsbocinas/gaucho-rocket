<form class='w3-container' action='<?php echo $path->getEvent('login', 'loginAction'); ?>' method='POST'>
  <div class='w3-section'>
    <label><b>Usuario</b></label>
    <input class='w3-input w3-border w3-margin-bottom' type='text' pattern='(?!^\d+$)^.+$' placeholder='Ingrese su Usuario' name='email' required>
    <label><b>Contrase&ntilde;a</b></label>
    <input class='w3-input w3-border' type='text' placeholder="Ingrese su Contrase&ntilde;a" name="password" required>
    <button class="w3-button w3-block w3-green w3-section w3-padding" name="ingresar" type="submit">Ingresar</button>
    <input class="w3-check w3-margin-top" type="checkbox" checked="checked"> Recordarme
  </div>
</form>

<div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
  <!--<button onclick="document.getElementById('id01').style.display='none'" type="button" class="w3-button w3-red">Cancelar</button>-->
  <span class="w3-right w3-padding w3-hide-small">Olvid&oacute; su <a href="#">Contrase&ntilde;a?</a></span>
</div>