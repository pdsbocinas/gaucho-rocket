$(document).ready(function(){
  $('.centro-medico').on('click', function(e) {
    const regexOnlyNumber = new RegExp('([0-9.,]+)', 'g');
    const getId = this.id.match(regexOnlyNumber).shift();
    $.ajax({
      type: "POST",
      url: `http://${window.location.host}/gaucho-rocket/micuenta/crearTurno`,
      data: { centro_id: getId },
      success: function(response) {
        window.location.href = `http://${window.location.host}/gaucho-rocket/micuenta/examenes`
      }
    })
  })
});