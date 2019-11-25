<div class="container mt-4 mb-4">
  <h2>Tu estudio:</h2>
  <?php 
    foreach ($data as $key => $value) {
      echo "<p>".$key.": <strong>".$value."<strong><p>";
    } 
  ?>
</div>