
<?php 

  //use qrcode/qrlib.php;
  require 'core/helpers/QR_code/phpqrcode/qrlib.php';
  $dir = 'resources/qr/';

  if(!file_exists($dir))
    mkdir($dir);
  
    $tamanio=2;
    $level='M';
    $frameSize = 3;
    
    
    foreach ($data as $key => $value) {
      $contenido =' estado: '. $value['estado'].
                  ' nombre de usuario: '. $value['nombre_de_usuario'].
                  ' tipo cabina : '. $value['tipo_de_cabina'].
                  ' asiento : '. $value['asiento'].
                  ' Origen : '. $value['Origen'].
                  ' Destino: '. $value['Destino'].
                  ' tipo cabina : '. $value['vuelo_id'];

                  //direccion donde se guarda el archivo 
      $filename=$dir.$value['nombre_de_usuario']. $value['vuelo_id'].$value['reserva_id'].'.jpeg';
      $nombreqr=$value['nombre_de_usuario']. $value['vuelo_id'].$value['reserva_id'].'.jpeg';
      //echo "nombre del archivo QR: ".$nombreqr;
      QRcode::png($contenido,$filename,$level,$tamanio,$frameSize);


      $contenidoPagina="
        <div class='container border'>
          <div class='row' >
          </div>
          <div class='row'>
            <div class='col-10'>
              <div class='col-10'>
                <label class='font-weight-bold'>Pasajero</label>
                <div>  {$value['nombre_de_usuario']}</div>
              </div>    
            </div>
            <div class='col-2'>
              <label class='font-weight-bold'>Pasajero</label>
              <div>{$value['nombre_de_usuario']}</div>    
            </div> 
          </div>
          <div class='row'>
            <div class='col-10'>
              <div class='row'>
                <div class='col'>
                  <label class='font-weight-bold'>Origen</label>
                  <div> {$value['Origen']}</div>
                </div>
                <div class='col'>
                  <label class='font-weight-bold'>Vuelo</label>
                  <div> {$value['vuelo_id']}</div>    
                </div>
                <div class='col'>
                  <label class='font-weight-bold'>Fecha</label>
                  <div> {$value['fecha_salida']}</div>    
                </div>
                <div class='col'>
                  <label class='font-weight-bold'>Hora</label>
                  <div></div>    
                </div>
              </div>
            </div>
            <div class='col-2'>
              <div class='row'>
                <div class='col'>
                  <label class='font-weight-bold'>Origen</label>
                  <div>{$value['Origen']}</div>    
                </div>
                <div class='col'>
                  <label class='font-weight-bold'>Destino</label>
                  <div>{$value['Destino']}</div>    
                </div>
              </div>    
            </div>
            <div class='row'>
              
            
            <div class='col-10'>
            <div class='row'>
              <div class='col'>
                <label class='font-weight-bold'>Tipo Cabina</label>
                <div> {$value['tipo_de_cabina']}</div>
              </div>
              <div class='col'>
                <label class='font-weight-bold'>Asiento</label>
                <div> {$value['asiento']}</div>    
              </div>
            <img src='../resources/qr/nico11.jpeg'>  
              </div>
        </div>";
    }

    echo $contenidoPagina;
    ?>
  <div class="container">
  <div class="alert alert-primary" role="alert">
    Le enviaremos el codigo de Reserva a su mail.
  </div>
    <?php echo "<a class='btn btn-primary mr-2' href=".$path->getEvent('micuenta','EnviarCodigo')."?id=".$value['id']."&nombre_de_usuario=".$value['nombre_de_usuario']."&email=".$value['email']."&vuelo_id=".$value['vuelo_id']."&reserva_id=".$value['reserva_id'].">Finalizar</a>";
  ?>
  </div>


