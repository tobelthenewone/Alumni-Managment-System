<?php
require 'connection.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Data</title>
  </head>
  <body>
    <table border = 1 cellspacing = 0 cellpadding = 10>
      <tr>
        <td>#</td>
        <td>Image</td>
      </tr>
      <?php
      $i = 1;
      $rows = mysqli_query($conn, "SELECT * FROM original_degree ORDER BY id DESC")
      ?>

      <?php foreach ($rows as $row) : ?>
      <tr>
        <td><?php echo $i++; ?></td>
        <td> <img src="./admin/img/<?php echo $row["service_fee"]; ?>" width = 200 title="<?php echo $row['service_fee']; ?>"> </td>
      </tr>
      <?php endforeach; ?>
    </table>
    <br>
    <a href="../uploadimagefile">Upload Image File</a>
  </body>
</html>