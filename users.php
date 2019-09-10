<?php

$conn = pg_pconnect("dbname=db8u3gdkjq4l6i");
if (!$conn) {
  echo "An error occurred.\n";
  exit;
}

$result = pg_query($conn, "SELECT firstName FROM users");
if (!$result) {
  echo "An error occurred.\n";
  exit;
}

while ($row = pg_fetch_row($result)) {
  echo "First name: $row[0]";
  echo "<br />\n";
}

?>
