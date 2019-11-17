$(document).ready(function(){
  $('.confirm_lista_espera').submit(function(e) {
    e.preventDefault();
    const regex = /[A-Za-z0-9]+/g
    const params = decodeURIComponent($(this).serialize());
    const extractParams = params.match(regex)
    const data = {
      usuario: parseInt(extractParams[1]),
      vuelo: parseInt(extractParams[3])
    }
    anotarListaEspera(data);
  })
  $('.close-toast').on('click', function(){
    $(".toast").css('opacity', 0);  
  })
});

function anotarListaEspera(data) {
  $.ajax({
    type: "POST",
    url: `http://${window.location.host}/gaucho-rocket/reservas/agregarAListaDeEspera`,
    data: data,
    success: function(response) {
      console.log(response)
      $(".toast").css('opacity', 1);  
    }
  })
}