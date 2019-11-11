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
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('.tipoVuelo').on('click', function(e) {
      obtenerVuelosPorTipo(this);
    })

    $('.submit').on('click', function(e) {
      e.preventDefault();
      obtenerVuelosPorFecha(this);
    })
  });

  function obtenerVuelosPorFecha (obj) {
    const origen_id = $('.origen').val();
    const destino_id = $('.destino').val();
    const desde = $('#date_desde').val();
    const hasta = $('#date_hasta').val();

    const data = {
      origen_id,
      destino_id,
      desde,
      hasta,
    }
    console.log(data)
    $.ajax({
      type: "POST",
      url: "<?php echo $path->getEvent('vuelos', 'obtenerVuelosPorDestinoFechas') ?>",
      data: data,
      success: function(response) {
        const jsonResponse = JSON.parse(response);
        const notFound = `<p>No se encontro ningun vuelo</p>`;
        if (jsonResponse.length === 0) {
          $('.server').remove();
          return $("#vuelos").html(notFound);
        }
        const html = jsonResponse.map(function(vuelo){
          return (
            `<div class='card' style='width: 18rem'>
            <img src='https://estaticos.muyinteresante.es/media/cache/760x570_thumb/uploads/images/pyr/55520750c0ea197b3fd513ef/luna-azul_1.jpg' class='card-img-top'>
            <div class='card-body'>
              <h5 class='card-title'> ${vuelo.titulo} </h5>
              <p class='card-text'> ${vuelo.descripcion} </p>
              <a href='' class='btn btn-primary'>Reserva</a>
            </div>`
          )})
        $('.server').remove();
        $("#vuelos").html(html)
      }
    })
  }

  function obtenerVuelosPorTipo(obj) {
    const regexOnlyNumber = new RegExp('([0-9.,]+)', 'g');
    const equipoId = obj.id.match(regexOnlyNumber).shift();
    $.ajax({
      type: "POST",
      url: "<?php echo $path->getEvent('vuelos', 'obtenerVuelosPorTipoDeVuelo') ?>",
      data: { equipo_id: equipoId },
      success: function(response) {
        const jsonResponse = JSON.parse(response);
        const notFound = `<p>No se encontro ningun vuelo</p>`;
        if (jsonResponse.length === 0) {
          $('.server').remove();
          return $("#vuelos").html(notFound);
        }
        const html = jsonResponse.map(function(vuelo){
          return (
            `<div class='card' style='width: 18rem'>
            <img src='https://estaticos.muyinteresante.es/media/cache/760x570_thumb/uploads/images/pyr/55520750c0ea197b3fd513ef/luna-azul_1.jpg' class='card-img-top'>
            <div class='card-body'>
              <h5 class='card-title'> ${vuelo.titulo} </h5>
              <p class='card-text'> ${vuelo.descripcion} </p>
              <a href='' class='btn btn-primary'>Reserva</a>
            </div>`
          )})
        $('.server').remove();
        $("#vuelos").html(html)
      }
    })
  }
</script>
