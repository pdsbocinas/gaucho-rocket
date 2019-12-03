<div class="container">
  <h1>Lista de esperas</h1>
  <ul class='d-flex flex-row list-group'>
    <li class='list-group-item'>Vuelo Id</li>
    <li class='list-group-item'>Vuelo Referencia</li>
    <li class='list-group-item'>Fecha</li>
    <li class='list-group-item'>Nombre del Vuelo</li>
    <li class='list-group-item'>Usuario</li>
  </ul>
  <div class="listaDeEspera">
    <?php 
      foreach ($data as $fila) {
        include($path->getPage("view", "Admin/listaDeEsperas/components/view_admin_lista_de_espera_item.php"));
      }
      include($path->getPage("view", "components/toast_success.php"));
    ?>
  </div>
</div>
