
$(document).ready(function(){
  let params = (new URL(document.location)).searchParams;
  let id = parseInt(params.get('vuelo_id'));
  obtenerDisponibilidad(id);
  manejarAsiento(id);
});

function obtenerTotalidadDeAsientos (id) {
  return $.ajax({
    type: "GET",
    url: `http://${window.location.host}/gaucho-rocket/micuenta/obtenerCapacidadTotal`,
    data: { 
      vuelo_id: id
    }
  })
}

function obtenerTodosLosAsientosOcupados (id) {
  return $.ajax({
    type: "GET",
    url: `http://${window.location.host}/gaucho-rocket/micuenta/obtenerAsientosOcupados`,
    data: { 
      vuelo_id: id
    }
  })
}

function armarAsientos (jsonResponse) {
  const total = parseInt(jsonResponse[0]['familiar']) + parseInt(jsonResponse[0]['general']) + parseInt(jsonResponse[0]['suite']);

  const list = [...Array(total + 1).keys()].filter(v => v !== 0)

  const strings = ["a","b","c","d","f","g"];
  const chunked = list.chunk(6)
  
  const asientos = chunked.reduce(function(acc, v, i){
    const item = v.map((g,k) => `${g}${strings[k]}` )
    return acc.concat(...item);
  }, [])
  return asientos
}

function chequearAsientos (listaDeOcupados, asiento) {
  return listaDeOcupados.includes(asiento) ? 'ocupado' : 'disponible';
}

function estructuraDeAsientos (asientos, ocupados) {
  const o = ocupados.map(function(v){ return v.asiento })
  const htmlAsientos = asientos.map(function(asiento){
  return (
    `
    <button id=${asiento} class="content-asiento">
      <div style="width: 15px; height: 15px;" class=${chequearAsientos(o, asiento)}></div>
      <span class='asiento'>${asiento}</span>
    </button>`
  )})

  return htmlAsientos;
}

async function obtenerDisponibilidad(id) {
  const total = await obtenerTotalidadDeAsientos(id)
  const ocupados = await obtenerTodosLosAsientosOcupados(id)
  const asientos = await armarAsientos(JSON.parse(total))
  const disponibilidad = await estructuraDeAsientos(asientos, JSON.parse(ocupados))
  $("#asientos").html(disponibilidad)
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

Object.defineProperty(Array.prototype, 'chunk', {
  value: function(chunkSize) {
    var lista = [];
    for (var i = 0; i < this.length; i += chunkSize)
      lista.push(this.slice(i, i + chunkSize));
    return lista;
  }
});

