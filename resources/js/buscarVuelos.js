$(document).ready(function(){
  $('.tipoVuelo').on('click', function(e) {
    obtenerVuelosPorTipo(this);
  })

  $('.submit').on('click', function(e) {
    e.preventDefault();
    obtenerVuelosPorFecha(this);
  })

  $('#aplicarPrecio').on('click', function(e){
    e.preventDefault();
    obtenerVuelosPorPrecio(this)
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
          `<div class='card' style='width: 18rem; float: left;'>
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

function obtenerVuelosPorPrecio () {
  const max = $('#maxPrecio').val();
  const min = $('#minPrecio').val();
  console.log(max, min)
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
          `<div class='card' style='width: 18rem; float: left;'>
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