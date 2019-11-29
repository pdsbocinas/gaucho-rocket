<div class="banner">
  <div class="card-img-overlay"></div>
  <?php
    echo "<img src='" . $path->getLink("images", "banner-home.jpg") . "' width='100%' />"; 
  ?>
  <div class="buscador-fechas">
    <h1>Buscá ofertas de vuelos</h1>
    <form class="" method="post">
      <div class="d-flex">
        <div class="col-md-4 col-sm-4">
          <label>Origen:</label>
          <select class="form-control origen">
          </select>
        </div>
        <div class="col-md-4 col-sm-4">
          <label>Destinos:</label>
          <select class="form-control destino">
          </select>
        </div>
      </div>
      <div class="d-flex">
        <div class="col-md-4 col-sm-4"> <!-- Date input -->
          <label class="control-label" for="date">Date</label>
          <input class="form-control" id="date_desde" name="date_from" placeholder="MM/DD/YYY" value="" type="date"/>
        </div>
        <div class="col-md-4 col-sm-4"> <!-- Date input -->
          <label class="control-label" for="date">Date</label>
          <input class="form-control" id="date_hasta" name="date_end" placeholder="MM/DD/YYY" value="" type="date"/>
        </div>
      </div>
      <div class="d-flex">
        <div class="col-md-4"> <!-- Submit button -->
          <button class="btn btn-primary submit mt-3" name="submit">Buscar</button>
        </div>
      </div>
      <div id="error" style="color: red;"></div>
    </form>
  </div>
  <ul class="banner-consejos">
    <li>Buscá en cientos de webs de viajes a la vez</li>
    <li>Reservá con confianza con la Predicción de precios</li>
    <li>Creá una alerta de precio y no te pierdas una sola oferta de vuelos</li>
    <li>Encontrá la información que necesitás para tomar la mejor decisión</li>
  </ul>
</div>
<div class="container-fluid max-width-1240 h-100">
  <div class="row">
    <h2 class="text-center mt-5 mb-2">Descubrí los destinos de todo el Universo</h2>
  </div>
  <div class="row">
    <div class="col-md-2 mt-4">
      <aside>
        <ul>
          <li>
            <h2>Tipo de vuelo</h2>
          </li>
          <li>
            <div class="form-check">
              <input class="form-check-input tipoVuelo" type="radio" name="equipos" id="orbitales" value="orbitales" checked>
              <label class="form-check-label" for="equipo-1">
                Orbitales
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input tipoVuelo" type="radio" name="equipos" id="baja aceleracion" value="baja aceleracion">
              <label class="form-check-label" for="equipo-2">
                Baja aceleracion
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input tipoVuelo" type="radio" name="equipos" id="alta aceleracion" value="alta aceleracion">
              <label class="form-check-label" for="equipo-3">
                Alta aceleracion
              </label>
            </div>
          </li>
        </ul>
        <ul>
          <li>
            <h2>Precio</h2>
          </li>
          <li class="price">
            <input id="minPrecio" type="number" placeholder="Min" name="minPrice" value="">
            -
            <input id="maxPrecio" type="number" placeholder="Max" name="maxPrice" value="">
            <button id="aplicarPrecio" name="aplicarPrecio"><i aria-label="icon: right" class="anticon anticon-right"><svg viewBox="64 64 896 896" class="" data-icon="right" width="1em" height="1em" fill="currentColor" aria-hidden="true" focusable="false"><path d="M765.7 486.8L314.9 134.7A7.97 7.97 0 0 0 302 141v77.3c0 4.9 2.3 9.6 6.1 12.6l360 281.1-360 281.1c-3.9 3-6.1 7.7-6.1 12.6V883c0 6.7 7.7 10.4 12.9 6.3l450.8-352.1a31.96 31.96 0 0 0 0-50.4z"></path></svg></i></button>
          </li>
        </ul>
      </aside>
    </div>
    <div class="col-md-10 mt-4">
      <?php 
        foreach ($data as $fila) {
          include($path->getPage("view", "components/card_vuelo.php"));
        }
      ?>
      <div id="vuelos"></div>
    </div> 
  </div>
</div>
