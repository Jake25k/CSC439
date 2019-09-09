
<?php
  require("mysqli_oop_connect.php");
  $q = "INSERT INTO Persons values (NULL, 'Jake')";
  $r = @$mysqli->query($q);

    include_once("Index.html");
?>
