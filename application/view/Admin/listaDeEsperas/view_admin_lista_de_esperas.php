<div class="container">
  <h1>Lista de esperas</h1>
  <div class="listaDeEspera">
    <?php 
      foreach ($data as $fila) {
        include($path->getPage("view", "Admin/listaDeEsperas/components/view_admin_lista_de_espera_item.php"));
      }
      include($path->getPage("view", "components/toast_success.php"));
    ?>
  </div>
</div>
