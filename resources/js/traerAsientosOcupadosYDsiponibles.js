
    console.log("dentrosdfsdfsdfsdfsdfy");
$(document).ready(function(){
    console.log("dentro del ready");

    
    
  
  });


  function obtenerAsientos(obj) {
      const asientoId=obj.Id
      $.ajax({
        type: "POST",
        url: `http://${window.location.host}/gaucho-rocket/micuenta/checkin_paso2.php`,
        data: { asiento_id: asientoId },
        success: function(response) {
                                        const jsonResponse = JSON.parse(response);
                                        const notFound = `<p>No se encontro ningun asiento</p>`;
                                        if (jsonResponse.length === 0) {
                                            $('.server').remove();
                                            return $("#asientos").html(notFound);
                                        }   

                                        const html = jsonResponse.map(function(asientos){
                                        return (
                                                    `<div class='card' style='width: 18rem; float: left;'>
                                                    <div class='card-body'>
                                                    <p class='card-text'> ${asientos.numero} </p>
                                                    </div>`
                                                )})
                                        //$('.server').remove();
                                        $("#asientos").html(html)
                                    }
    })
  }