window.data = [];

$(document).ready(async function(){
  window.data = await obtenerDestinos();

  $('.tipoVuelo').on('click', function(e) {
    obtenerVuelosPorTipo(this);
  })

  $('.submit').on('click', function(e) {
    e.preventDefault();
    obtenerVuelosPorFecha();
  })

  $('#aplicarPrecio').on('click', function(e){
    e.preventDefault();
    obtenerVuelosPorPrecio(this);
  })

  armarComboOrigen(window.data)
  $('.origen').on('change', function(e) {
    const origenSeleccionado = $(this).children("option:selected").text();
    armarComboDestino(e.target.value, origenSeleccionado)
  });
});

function obtenerVuelosPorFecha () {
  const origen_id = $('.origen').val();
  const destino_id = $('.destino').val();
  const desde = $('#date_desde').val();
  const hasta = $('#date_hasta').val();
  const circuito_id = $('.origen').children("option:selected").text().indexOf("circuito 1") > -1 ? 1 : 2;

  const data = {
    origen_id,
    destino_id,
    circuito_id,
    desde,
    hasta,
  }

  if (origen_id === destino_id) {
    const error = $("#error").text("El origen no puede ser igual al destino");
    return error;
  }

  $("#error").text("");

  $.ajax({
    type: "POST",
    url: `http://${window.location.host}/gaucho-rocket/vuelos/obtenerVuelosPorDestinoFechas`,
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
          `<div class='card' style='width: 18rem; float: left;'>
          <img src='http://${window.location.host}/gaucho-rocket/resources/images/${vuelo.ruta}' class='card-img-top'>
          <div class='card-body'>
            <h5 class='card-title'> ${vuelo.titulo} </h5>
            <p class='card-text'> ${vuelo.descripcion} </p>
            <a href='reservas?id=${vuelo.id}' class='btn btn-primary'>Reserva</a>
          </div>`
        )})
      $('.server').remove();
      $("#vuelos").html(html)
    }
  })
}

function obtenerVuelosPorTipo(obj) {
  const equipoId = obj.id
  $.ajax({
    type: "POST",
    url: `http://${window.location.host}/gaucho-rocket/vuelos/obtenerVuelosPorTipoDeVuelo`,
    data: { equipo_id: equipoId },
    success: function(response) {
      const responseParse = JSON.parse(response);
      const notFound = `<p>No se encontro ningun vuelo</p>`;
      if (responseParse.length === 0) {
        $('.server').remove();
        return $("#vuelos").html(notFound);
      }
      const html = responseParse.map(function(vuelo){
        return (
          `<div class="card card-vuelos-height m-3" style="width: 18rem; float:left;">
            <img class="card-img-top" src="http://${window.location.host}/gaucho-rocket/resources/images/${vuelo.ruta}" class="card-img-top" alt="...">
            <div class="d-flex flex-column card-body">
              <h5 class='card-title'> ${vuelo.titulo} </h5>
              <p class='card-text'> ${vuelo.descripcion} </p>
              <strong class="mb-2">$ ${vuelo.precio}</strong>
              <a href='reservas?id=${vuelo.id}' class='btn btn-primary'>Reserva</a>
            </div>
          </div>`
        )})
      $('.server').remove();
      $("#vuelos").html(html)
    }
  })
}

function obtenerVuelosPorPrecio () {
  const max = $('#maxPrecio').val();
  const min = $('#minPrecio').val();

  $.ajax({
    type: "POST",
    url: `http://${window.location.host}/gaucho-rocket/vuelos/obtenerVuelosPorPrecio`,
    data: { max, min },
    success: function(response) {
      const responseParse = JSON.parse(response);
      const notFound = `<p>No se encontro ningun vuelo</p>`;
      if (responseParse.length === 0) {
        $('.server').remove();
        return $("#vuelos").html(notFound);
      }
      const html = responseParse.map(function(vuelo){
        return (
          `<div class='card card-vuelos-height m-3' style='width: 18rem; float: left;'>
          <img src="http://${window.location.host}/gaucho-rocket/resources/images/${vuelo.ruta}" class='card-img-top'>
          <div class='card-body'>
            <h5 class='card-title'>${vuelo.titulo}</h5>
            <p class='card-text'>${vuelo.descripcion}</p>
            <a href='reservas?id=${vuelo.id}' class='btn btn-primary'>Reserva</a>
          </div>`
        )})
      $('.server').remove();
      $("#vuelos").html(html)
    }
  })
}

function obtenerDestinosAjax () {
  return $.ajax({
    type: "GET",
    url: `http://${window.location.host}/gaucho-rocket/vuelos/obtenerTodosLosDestinoPorCircuito`
  });
}

async function obtenerDestinos () {
  return await obtenerDestinosAjax();
}

function armarComboOrigen (destinos) {
  const destinosJson = JSON.parse(destinos)
  const origen = destinosJson.map(function(v){ return ( `<option value="${v.destino_id}">${v.destino} - ${v.tipo}</option>`) })         
  $(".origen").html(origen)
}

function armarComboDestino (value, origenSeleccionado) {
  $("#error").text("");
  const destinos = JSON.parse(window.data)
  const circuito = origenSeleccionado.indexOf("circuito 1") > -1 ? 'circuito 1' : 'circuito 2';
  const porCircuito = destinos.filter(function(v){ return v.tipo === circuito});
  const seleccionado = destinos.filter(function(v){ return v.destino_id === value && v.tipo === circuito }).shift();
  const circuitoIndex = porCircuito.reduce(function(acc, v, i){
    if(v.destino === seleccionado.destino){
      acc = i;
      return acc;
    }
    return acc
  }, 0)
  const filterBase = porCircuito.filter(function(v){ return (v.destino !== "Buenos aires" && v.destino !== "Ankara")})
  const destinosFinales = porCircuito.map(function(v){ return ( `<option value="${v.destino_id}">${v.destino} - ${v.tipo}</option>`) })
  $(".destino").html(destinosFinales)
}
