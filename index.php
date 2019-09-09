
<?php

  include_once("Index.html");

  require("mysqli_oop_connect.php");
  $q = "INSTER INTO Persons values (NULL, 'Jake')";
  $r = @$mysqli->query($q);
?>
