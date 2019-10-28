<?php 
$pageTitle = 'Book Description';
include('includes/header.php'); ?>

<!DOCTYPE html>
<html>
<head>
<style>
	header{
      padding-left: 5px;
      background: var(--bggradient);
      width: 100%;
    }
	h1 {
		text-align: center;
	}
    table{
      margin: auto;
      padding: 5px;
	  width: 100% !important;
    }
    td{
      padding-right: 15px;
    }
	centered-table{
		margin-left: auto;
		margin-right: auto;
	}
	.column-head{
		text-align: center;
	}
	table.table-bordered{
		border:2px solid black;
		margin-top:20px;
	}
	table.table-bordered > thead > tr > th{
		width: 75% !important;
		border:2px solid black;
	}
	table.table-bordered > tbody > tr > td{
		width: 75% !important;
		border:2px solid black;
	}


  </style>
</head>
<body>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
  <script src="js/main.js"></script>

	<h3>Price: </h3>
<p>20.99</p>
<h3>Description: </h3>
 <p> The theory of everything is a proposed notion in the scientific community which states that there is
  one all-encompassing theory that proposes a framework of understanding of all of physics,
  combining the quantum mechanics and classical physics into a unified approach which explains the laws of the universe.
 </p>
<main>
<?php
$db_con = pg_connect("host=ec2-54-235-100-99.compute-1.amazonaws.com port=5432 dbname=db8u3gdkjq4l6i user=oihnrigiktbsug password=03f8fa546db912cfc133c1faa898ef14cd26324691f4ba13ee09d89db73c9e8f");
$query = pg_query($db_con, "SELECT * from books");

if(!$query){
  echo "Query error";
}
else{
			echo "<table class=\"centered-table table-bordered table-striped table-hover table-responsive\">";
			echo"<thead>";
			echo "<tr class=\"column-head\"><th>Title</th><th>Author</th><th>ISBN</th><th>Description</th><th>Price</th></tr>";
			echo "</thead>";
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
  <script src="js/main.js"></script>
</body>
</html>
