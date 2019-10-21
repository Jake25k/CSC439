<?php
$pageTitle = 'Best Books';
include('includes/header.php');
include_once ("Index.html");
$db_con = pg_connect("host=ec2-54-235-100-99.compute-1.amazonaws.com port=5432 dbname=db8u3gdkjq4l6i user=oihnrigiktbsug password=03f8fa546db912cfc133c1faa898ef14cd26324691f4ba13ee09d89db73c9e8f");
$query = pg_query($db_con, "SELECT COUNT(*) from books");
$query2 = pg_query($db_con, "SELECT COUNT(*) from users");
$result = pg_fetch_row($query);
$result2 = pg_fetch_row($query);
?>
