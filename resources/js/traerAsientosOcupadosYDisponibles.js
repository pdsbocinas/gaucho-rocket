
$(document).ready(function(){
  let params = (new URL(document.location)).searchParams;
  let id = parseInt(params.get('vuelo_id'));
  manejarAsiento(id);
  obtenerTotalidadDeAsientos(id);
  obtenerDisponibilidad(id);
  console.log(obtenerTodosLosAsientosOcupados(id));
});

function obtenerTotalidadDeAsientos(id) {
  $.ajax({
    type: "GET",
    url: `http://${window.location.host}/gaucho-rocket/micuenta/obtenerCapacidadTotal`,
    data: { 
      vuelo_id: id
    },
    success: function(response) {
      const jsonResponse = JSON.parse(response)
      const total = parseInt(jsonResponse[0]['familiar']) + parseInt(jsonResponse[0]['general']) + parseInt(jsonResponse[0]['suite']);

      let list = [];
      for (var i = 1; i <= total; i++) {
        list.push(i);
      }

      let strings = ["a","b","c","d","f","g"];
      const chunked = list.chunk(6)
      
      const reduce = chunked.reduce(function(acc, v, i){
        const item = v.map((g,k) => g + strings[k])
        return acc.concat(...item);
      }, [])

      const html = reduce.map(function(asiento){
      return (
        `
        <button id=${asiento} class="content-asiento">
          <div style="width: 15px; height: 15px;" class=${obtenerDisponibilidad(asiento, id)}></div>
          <span class='asiento'>${asiento}</span>
        </button>`
      )})

      $("#asientos").html(html)
    }
  })
}

function obtenerDisponibilidad(asiento, id) {
  let listaOcupada = obtenerTodosLosAsientosOcupados(id);
  console.log(obtenerTodosLosAsientosOcupados(id))
  return ['1a'].includes(asiento) ? 'ocupado' : 'disponible';
}

function manejarAsiento (id) {
  $(document).on('click', '.content-asiento', function(e) {
    const asiento = this.id;
    $.ajax({
      type: "POST",
      url: `http://${window.location.host}/gaucho-rocket/micuenta/guardarAsiento`,
      data: { 
        vuelo_id: id,
        asiento,
      },
      success: function(response) {
        const jsonResponse = JSON.parse(response)
        window.location.href = "./gaucho-rocket/micuenta/checkin"
      }
    })
  });
}

async function obtenerTodosLosAsientosOcupados (id) {
  let asientos = []
  $.ajax({
    type: "GET",
    url: `http://${window.location.host}/gaucho-rocket/micuenta/obtenerAsientosOcupados`,
    data: { 
      vuelo_id: id
    },
    success: function(response) {
      const jsonResponse = JSON.parse(response)
      asientos = jsonResponse
    }
  })
  return asientos
}

Object.defineProperty(Array.prototype, 'chunk', {
  value: function(chunkSize) {
    var R = [];
    for (var i = 0; i < this.length; i += chunkSize)
      R.push(this.slice(i, i + chunkSize));
    return R;
  }
});

