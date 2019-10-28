<?php
  function getCurrentCart(){
    $db_con = pg_connect("host=ec2-54-235-100-99.compute-1.amazonaws.com port=5432 dbname=db8u3gdkjq4l6i user=oihnrigiktbsug password=03f8fa546db912cfc133c1faa898ef14cd26324691f4ba13ee09d89db73c9e8f");
    $result = pg_query($db_con, "SELECT cart FROM users WHERE username=" . $_SESSION['user'] . ";");
    pg_close($dbc);
    return $result;
  }
?>
