<div class="w3-container">
    <div id="id01" class="w3-modal">
        <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">

            <div class="w3-center"><br>
                <!--<span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-transparent w3-display-topright" title="Cerrar">×</span>-->
                <!--<img src="img_avatar4.png" alt="Avatar" style="width:30%" class="w3-circle w3-margin-top">-->
            </div>

            <form class="w3-container" action="/action_page.php">
                <div class="w3-section">
                    <label><b>Usuario</b></label>
                    <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Ingrese su Usuario" name="usuario" required>
                    <label><b>Contrase&ntilde;a</b></label>
                    <input class="w3-input w3-border" type="text" placeholder="Ingrese su Contrase&ntilde;a" name="clave" required>
                    <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Ingresar</button>
                    <input class="w3-check w3-margin-top" type="checkbox" checked="checked"> Recordarme
                </div>
            </form>

            <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
                <!--<button onclick="document.getElementById('id01').style.display='none'" type="button" class="w3-button w3-red">Cancelar</button>-->
                <span class="w3-right w3-padding w3-hide-small">Olvid&oacute; su  <a href="#">Contrase&ntilde;a?</a></span>
            </div>

        </div>
    </div>
</div>