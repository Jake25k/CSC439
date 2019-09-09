
<?php

  include_once("Index.html");

  require("mysqli_oop_connect.php");
  $q = "INSERT INTO Persons values (NULL, 'Jake')";
  $r = @$mysqli->query($q);
?>
