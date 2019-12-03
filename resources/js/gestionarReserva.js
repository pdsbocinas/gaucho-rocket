$(document).ready(function(){
  pagarReserva();
  eliminarReserva();
  agregarAlVuelo();
  $('.close-toast').on('click', function(){
    $(".toast").css('opacity', 0);  
  })
  const regexOnlyNumber = new RegExp('([0-9.,]+)', 'g');
  const precio = $('.precioBase').text();
  const precioInt = precio !== 'undefined' ? parseInt(precio.match(regexOnlyNumber).shift()) : null;
  $('#precioFinal').val(precioInt);
  obtenerTodosLosServicios();
  precioFinalSegunServicio();
  precioFinalSegunServicioDeAbordo();
  obtenerEscalas();
});

function pagarReserva () {
  $('.pagar').on('click', function(e) {
    const regexOnlyNumber = new RegExp('([0-9.,]+)', 'g');
    const getId = this.id.match(regexOnlyNumber).shift();
    $.ajax({
      type: "POST",
      url: "http://localhost:8888/gaucho-rocket/reservas/pagarReserva",
      data: { reserva_id: getId },
      success: function(response) {
        $('.pagar').removeClass('btn-primary');
        $('.pagar').addClass('btn-success disabled').text('pagado');
        window.location.href = `http://${window.location.host}/gaucho-rocket/micuenta/reservas`
      }
    })
  })
}

function obtenerTodosLosServicios () {
  $.ajax({
    type: "GET",
    url: `http://${window.location.host}/gaucho-rocket/reservas/obtenerTodosLosServicios`,
    success: function(response) {
      const responseParse = JSON.parse(response);
      const html = responseParse.map(function(servicio){
        return (
          `<option value=${servicio.id}>
            ${servicio.descripcion}
            <span>(${servicio.porcentaje}%)</span>
          </option>`
        )})
      $("#servicios").html(html)
    }
  })
}

function precioFinalSegunServicio () {
  $('#servicios').on('change', function (e) {
    const text = $("#servicios option:selected").text();
    const regexOnlyNumber = new RegExp('([0-9.,]+)', 'g');
    const getPorcentaje = parseInt(text.match(regexOnlyNumber).shift());
    const precio = $('.precioFinal').text();
    const precioInt = parseInt(precio.match(regexOnlyNumber).shift());
    const precioFinal = precioInt + precioInt * getPorcentaje / 100;
    $('#precioFinal').val(precioFinal);
    $('.precioFinal').text(`$ ${precioFinal}`);
  })
}

function precioFinalSegunServicioDeAbordo () {
  $('#menu').on('change', function (e) {
    const text = $("#menu option:selected").text();
    const regexOnlyNumber = new RegExp('([0-9.,]+)', 'g');
    const getPorcentaje = parseInt(text.match(regexOnlyNumber).shift());
    const precio = $('.precioFinal').text();
    const precioInt = parseInt(precio.match(regexOnlyNumber).shift());
    const precioFinal = precioInt + precioInt * getPorcentaje / 100;
    $('#precioFinal').val(precioFinal);
    $('.precioFinal').text(`$ ${precioFinal}`);
  })
}

function eliminarReserva () {
  $('.eliminar-reserva').on('click', function(e) {
    const regexOnlyNumber = new RegExp('([0-9.,]+)', 'g');
    const getId = this.id.match(regexOnlyNumber).shift();
    $.ajax({
      type: "POST",
      url: `http://${window.location.host}/gaucho-rocket/reservas/eliminarReserva`,
      data: { reserva_id: getId },
      success: function(response) {
        if (typeof responseParse === 'number') {
          $(".toast").css('opacity', 1);
          $(".toast-body").text("Cancelacion exitosa");
        } else {
          $(".toast-body").text("Cancelacion exitosa");
          $(".toast").css('opacity', 1);  
        }
        window.location.href = `http://${window.location.host}/gaucho-rocket/`
      }
    })
  })
}

function agregarAlVuelo () {
  $('.form-lista-de-espera').on('click', function(e) {
    e.preventDefault();
    const data = $(this).serializeArray();
    console.log(data);
    $.ajax({
      type: "POST",
      url: `http://${window.location.host}/gaucho-rocket/reservas/confirmarReserva`,
      data: { vuelo_id: data[0].value, usuario_id: data[1].value, precioFinal: data[2].value, servicio: 1 },
      success: function(response) {
        if (response === 'No hay lugar para este vuelo') {
          $(".toast").css('opacity', 1);
          $(".toast-body").text(response);
        } else {
          $('.generar-reserva').removeClass('btn-primary');
          $('.generar-reserva').addClass('btn-success disabled').text('Agregado');
          window.location.href = `http://${window.location.host}/gaucho-rocket/admin/`
        }
      }
    })
  });
}

function obtenerEscalas () {
  let params = (new URL(document.location)).searchParams;
  let vueloId = parseInt(params.get('id'));
  $.ajax({
    type: "GET",
    url: `http://${window.location.host}/gaucho-rocket/vuelos/obtenerEscalasDelVuelo`,
    data: {
      id: vueloId
    },
    success: function(response) {
      const responseParse = JSON.parse(response);
      const html = responseParse.map(function(v){
        return (
          `<li class="mr-2"><h6><span class="badge badge-secondary">${v.origen}</span></h6></li>
          <li class="mr-2"><h6><span class="badge badge-secondary">${v.destino}</span></h6></li>`
        )})
      $("#lista-de-escalas").html(html)
    }
  })
}