<?php
// test view recommendations section of view.php

include('../includes/userpage_functions.php');

function viewRecommended($db_con, $querystr){
  echo "You might like: ";
  $rec_result = pg_query($db_con, $querystr);
  if(!$rec_result){
    echo "Error fetching recommendations!";
  }else{
    $recbooks = pg_fetch_all($rec_result);
    displayRecommends($recbooks);
  }
}

function testView(){
  $dbc = pg_connect("host=ec2-54-235-100-99.compute-1.amazonaws.com port=5432 dbname=db8u3gdkjq4l6i user=oihnrigiktbsug password=03f8fa546db912cfc133c1faa898ef14cd26324691f4ba13ee09d89db73c9e8f");

  $id = 29;
  $categories = array(0 => 'Educational', 1 => 'Art', 2 => 'Historical Fiction', 3 => 'Science');
  foreach($categories as $c){
    echo "Testing category $c <br>";
    $testqry = "SELECT title,book_id,book_cover from books WHERE category = '" . $c . "' and book_id != " . $id . " LIMIT 3;";
    echo $testqry;
    echo "<br>";
    viewRecommended($dbc, $testqry);
    echo "<br>";
  }
}

testView();

?>