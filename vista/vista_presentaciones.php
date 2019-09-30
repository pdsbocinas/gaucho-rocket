<!-- The Band Section -->
<div class="w3-container w3-content w3-center w3-padding-64" style="max-width:800px" id="band">
    <h2 class="w3-wide">Presentaciones</h2>
    <table class="w3-table">
        <tr>
            <th>Presentacion</th>
            <th>fecha</th>
            <th>precio</th>
        </tr>
<?php
foreach ($presentaciones as $presentacion){
    echo   "<tr>
                    <td>" . $presentacion['nombre'] . "</td>
                    <td>" . $presentacion['fecha'] . "</td>
                    <td>" . $presentacion['precio'] . "</td>
                </tr>";
}
?>
</table>
</div>
