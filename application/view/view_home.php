<div class="container-fluid">
  <div class="row">
    <form class="d-flex align-items-center" method="post" app>
      <div class="col-md-4 col-sm-4">
        <label>Origen:</label>
        <select class="form-control origen">
          <option value="1">Buenos Aires</option>
          <option value="2">Ankara</option>
        </select>
      </div>
      <div class="col-md-4 col-sm-4">
        <label>Destinos:</label>
        <select class="form-control destino">
          <option value="1">Marte</option>
          <option value="2">Luna</option>
        </select>
      </div>
      <div class="col-md-4 col-sm-4"> <!-- Date input -->
        <label class="control-label" for="date">Date</label>
        <input class="form-control" id="date_desde" name="date_from" placeholder="MM/DD/YYY" value="" type="date"/>
      </div>
      <div class="col-md-4 col-sm-4"> <!-- Date input -->
        <label class="control-label" for="date">Date</label>
        <input class="form-control" id="date_hasta" name="date_end" placeholder="MM/DD/YYY" value="" type="date"/>
      </div>
      <div class="align-self-end mb-0 form-group"> <!-- Submit button -->
        <button class="btn btn-primary submit" name="submit">Submit</button>
      </div>
    </form>
  </div>
  <div class="row">
    <div class="col-md-3">
      <ul>
        <li>
          <h2>Tipo de vuelo</h2>
        </li>
        <li>
          <div class="form-check">
            <input class="form-check-input tipoVuelo" type="radio" name="equipos" id="equipo-1" value="equipo-1" checked>
            <label class="form-check-label" for="equipo-1">
              Orbitales
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input tipoVuelo" type="radio" name="equipos" id="equipo-2" value="equipo-2">
            <label class="form-check-label" for="equipo-2">
              Baja aceleracion
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input tipoVuelo" type="radio" name="equipos" id="equipo-3" value="equipo-3">
            <label class="form-check-label" for="equipo-3">
              Alta aceleracion
            </label>
          </div>
        </li>
      </ul>
    </div>
    <div class="col-md-9">
      <?php 
        foreach ($data as $fila) {
          include($path->getPage("view", "components/card_vuelo.php"));
        }
      ?>
      <div id="vuelos"></div>
    </div> 
  </div>
</div>
