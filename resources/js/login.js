$(document).ready(function(){
  $('.login-form').on('submit', function(e) {
    e.preventDefault();
    const data = $(this).serializeArray();
    console.log(data);
    $.ajax({
      type: "POST",
      url: `http://${window.location.host}/gaucho-rocket/main/login`,
      data: { email: data[0].value, password: data[1].value },
      success: function(response) {
        console.log(response)
        if (response === 'Contraseña incorrecta') {
          return $('#errors-login').text(response);
        }
        if (response === 'El usuario no esta activado') {
          return $('#errors-login').text(response);
        }
        if (response === 'Usuario no encontrado') {
          return $('#errors-login').text(response);
        }
        // window.location.href = `http://${window.location.host}/gaucho-rocket/main/index`
      }
    })
  })
});