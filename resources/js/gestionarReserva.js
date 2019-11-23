$(document).ready(function(){
  pagarReserva();
  cancelarReserva();
  const regexOnlyNumber = new RegExp('([0-9.,]+)', 'g');
  const precio = $('.precioBase').text();
  const precioInt = precio !== 'undefined' ? parseInt(precio.match(regexOnlyNumber).shift()) : null;
  $('#precioFinal').val(precioInt);
  obtenerTodosLosServicios();
  precioFinalSegunServicio();
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
    const precio = $('.precioBase').text();
    const precioInt = parseInt(precio.match(regexOnlyNumber).shift());
    const precioFinal = precioInt + precioInt * getPorcentaje / 100;
    $('#precioFinal').val(precioFinal);
    $('.precioFinal').text(`$ ${precioFinal}`);
  })
}

function cancelarReserva () {
  $('.cancelar').on('click', function(e) {
    const regexOnlyNumber = new RegExp('([0-9.,]+)', 'g');
    const getId = this.id.match(regexOnlyNumber).shift();
    $.ajax({
      type: "POST",
      url: `http://${window.location.host}/gaucho-rocket/reservas/cancelarReserva`,
      data: { reserva_id: getId },
      success: function(response) {
        if (typeof responseParse === 'number') {
          $(".toast").css('opacity', 1);
          $(".toast-body").text("Cancelacion exitosa");
        } else {
          $(".toast-body").text("Cancelacion exitosa");
          $(".toast").css('opacity', 1);  
        }
        window.location.href = `http://${window.location.host}/gaucho-rocket/micuenta/reservas`
      }
    })
  })
}