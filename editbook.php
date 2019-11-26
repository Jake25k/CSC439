<?php
    //function takes updated book information to edit a book
    function editBook($id, $title, $author, $isbn){
      $db_con = pg_connect("host=ec2-54-235-100-99.compute-1.amazonaws.com port=5432 dbname=db8u3gdkjq4l6i user=oihnrigiktbsug password=03f8fa546db912cfc133c1faa898ef14cd26324691f4ba13ee09d89db73c9e8f");
      $q = "update books set title = '" . pg_escape_string($title) . "', author = '" . pg_escape_string($author) . "', isbn = '" . pg_escape_string($isbn) . "' where book_id = '" . pg_escape_string($id) . "';";
      $r = @pg_query($db_con, $q); // Run the query.
      pg_close($dbc); // Close the database connection.
    }
?>

<?php
  session_start();
	include("includes/header.php");
?>
  </header>

<?php
$id = $_GET['id']; //get the book id from the url
if (isset($_POST['sub'])) {
  editBook($id, $_POST['title'], $_POST['author'], $_POST['isbn']);
  echo '<h2 style="color: green"> Information Updated!</h2>';
}

$db_con = pg_connect("host=ec2-54-235-100-99.compute-1.amazonaws.com port=5432 dbname=db8u3gdkjq4l6i user=oihnrigiktbsug password=03f8fa546db912cfc133c1faa898ef14cd26324691f4ba13ee09d89db73c9e8f");
$result = pg_query($db_con, "SELECT * FROM books WHERE book_id=" . $id . ";");
if (!$result) {
  echo "An error occurred.\n";
  exit;
}
else{
  $row = pg_fetch_row($result);
}
?>

<h2> Edit this book: </h2>

<form action="editbook.php?id=<?php echo $id; ?>" method="post">
  <ul style="list-style-type: none";>
    <li><label><b>Title:</b></label></li>
    <input type="text" name="title" value="<?php echo $row[0];?>">
    <li><label><b>Author:</b></label></li>
    <input type="text" name="author" value="<?php echo $row[1];?>">
    <li><label><b>ISBN:</b></label></li>
    <input type="text" name="isbn" value="<?php echo $row[2];?>">
    <br><br><li><button type="submit" name="sub">Submit</button></li>
  </ul>
</form>
