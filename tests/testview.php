<?php
// test view recommendations section of view.php

include('../includes/userpage_functions.php');


function getabookid($cat, $dbc){
  /* get ONE book id of an book of category */
  $q = "SELECT book_id from books WHERE category = '$cat' LIMIT 1;";
  $eqr = pg_query($dbc, $q);
  if(!$eqr){
    echo "Database query error <br>";
    echo "$q";
    return -1;
  }else{
    $row = pg_fetch_row($eqr);
    if(empty($row)){
      echo "No book of that category";
      return -1;
    }
  }
  return $row[0];
}

function testCategory($cat, $dbc){
  $id = getabookid($cat, $dbc);
  if(!$id){
    echo "Bad book id";
    return -1;
  }
  $query = "SELECT title,book_id,book_cover from books WHERE category = '" . $cat . "' AND book_id != ". $id ." LIMIT 3;";
  
  echo "<br>";
  echo "Testing category $cat <br>";
  echo "Using Query: $query <br>";
  echo "Selected book id: $id <br>";
  
  $rec_result = pg_query($dbc, $query);
  if(!$rec_result){
    echo "Error fetching recommendations!";
    return -1;
  }

  $recbooks = pg_fetch_all($rec_result);
  foreach($recbooks as $b){
    echo $b['book_id'];
    if($b['book_id'] == $id){
      return -1;
    }
    echo " ";
  }
  return 0;
}

function runTests(){
  $dbc = pg_connect("host=ec2-54-235-100-99.compute-1.amazonaws.com port=5432 dbname=db8u3gdkjq4l6i user=oihnrigiktbsug password=03f8fa546db912cfc133c1faa898ef14cd26324691f4ba13ee09d89db73c9e8f");
  
  echo "Testing categories <br>";
  $categories = array(0 => 'Educational', 1 => 'Art', 2 => 'Historical Fiction', 3 => 'Science', 4 => '');
  foreach($categories as $cat){
    if(testCategory($cat, $dbc) != -1){
      echo "Passed <br>";
    }else{
      echo "Failed! <br>";
    }
  }
}
runTests();

?>