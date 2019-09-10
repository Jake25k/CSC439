<?php
$conn = pg_connect("host=ec2-54-235-100-99.compute-1.amazonaws.com port=5432 dbname=db8u3gdkjq4l6i user=oihnrigiktbsug password=03f8fa546db912cfc133c1faa898ef14cd26324691f4ba13ee09d89db73c9e8f");
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
