<div class="container">
  <?php
    echo "<h2>Reservas pagas</h2>
    <ul class='d-flex flex-row list-group'>
    <li class='list-group-item'>Id</li>
    <li class='list-group-item'>codigo</li>
    <li class='list-group-item'>Vuelo id</li>
    <li class='list-group-item'>Ref Vuelo id</li>
    <li class='list-group-item'>Usuario</li>
  </ul>";
    
    foreach ($data['pagas'] as $fila) {
      include($path->getPage("view", "Admin/reservas/components/view_admin_reserva_paga_item.php"));
    }
    echo "<h2>Reservas no pagas</h2>
      <ul class='d-flex flex-row list-group'>
    <li class='list-group-item'>Id</li>
    <li class='list-group-item'>codigo</li>
    <li class='list-group-item'>Vuelo id</li>
    <li class='list-group-item'>Ref Vuelo id</li>
    <li class='list-group-item'>Usuario</li>
  </ul>";
    foreach ($data['noPagas'] as $fila) {
      include($path->getPage("view", "Admin/reservas/components/view_admin_reserva_no_paga_item.php"));
    }
  ?>
</div>