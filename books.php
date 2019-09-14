<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
    crossorigin="anonymous" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
    crossorigin="anonymous">
  <link rel="stylesheet" href="styles/Style.css" />
  <style>
    header{
      padding-left: 5px;
      background: var(--bggradient);
      width: 100%;
    }
    table{
      margin: 10px;
      padding: 5px;
    }
    td{
      padding-right: 15px;
    }
  </style>
</head>

<body>

<header>
<h1>All Books</h1>
<a href="index.php">return to main page</a>
</header>

<main>
<?php

$db_con = pg_connect("host=ec2-54-235-100-99.compute-1.amazonaws.com port=5432 dbname=db8u3gdkjq4l6i user=oihnrigiktbsug password=03f8fa546db912cfc133c1faa898ef14cd26324691f4ba13ee09d89db73c9e8f");

$query = pg_query($db_con, "SELECT * from books");
if(!$query){
  echo "Query error";
}else{
  echo "<table>";
  echo "<tr><th>Title</th><th>Author</th><th>ISBN</th></tr>";
  while($results = pg_fetch_array($query, NULL, PGSQL_ASSOC)){
    echo "<tr>";
    echo "<td>" . $results['title'] . "</td>";
    echo "<td>" . $results['author'] . "</td>";
    echo "<td>" . $results['isbn'] . "</td>";
    echo "</tr>";
  }
  echo "</table>";
}

?>
</main>
</body>
</html>