$(document).ready(function(){
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
      }
    })
  })

});