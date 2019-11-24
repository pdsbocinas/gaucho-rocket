<div class="container">
  <?php
    echo "<h2>Reservas pagas</h2>";
    foreach ($data['pagas'] as $fila) {
      include($path->getPage("view", "Admin/reservas/components/view_admin_reserva_paga_item.php"));
    }
    echo "<h2>Reservas no pagas</h2>";
    foreach ($data['noPagas'] as $fila) {
      include($path->getPage("view", "Admin/reservas/components/view_admin_reserva_no_paga_item.php"));
    }
  ?>
</div>