<?php
$pageTitle = 'View Author';
include('includes/header.php');
$id = $_GET['author']; //get the book id from the url

$db_con = pg_connect("host=ec2-54-235-100-99.compute-1.amazonaws.com port=5432 dbname=db8u3gdkjq4l6i user=oihnrigiktbsug password=03f8fa546db912cfc133c1faa898ef14cd26324691f4ba13ee09d89db73c9e8f");
$result = pg_query($db_con, "SELECT author FROM books WHERE book_id=" . $id . ";");
if (!$result) {
  echo "An error occurred.\n";
  exit;
}
else{
  $row = pg_fetch_row($result);
}
?>
</header>
<div style="display: flex; justify-content: center;">
  <div class="panel panel-default">
    <div class="panel-heading">
      <?php
        echo "<br><div style='text-align: center;'><h1> Author: $row[0]</h1></div>";
        $result2 = pg_query($db_con, "SELECT book_id, title FROM books WHERE author='" . $row[0] . "';");
        if (!$result2) {
          echo "An error occurred.\n";
          exit;
        }
        else{
          while ($row = pg_fetch_row($result2)) {
            echo "<a href='view.php?id=$row[0]'>$row[1]</a><br />\n";
          }
        }
      ?>
    </div>
    <div class="panel-body">

    </div>
  </div>
</div>
