<?php
namespace tests\unit;
class UnitTests5 extends \PHPUnit\Framework\TestCase
{
//tests the function to add books to the database as an admin
  function testBookEdit(){

    //set test variables for function
    $id = 1000000;
    $newTitle = "test";
    $newAuthor = "test";
    $newIsbn = 100;

    //run function with variables
    editBook($id, $newTitle, $newAuthor, $newIsbn);

    //connect to database
    $dbc = pg_connect("host=ec2-54-235-100-99.compute-1.amazonaws.com port=5432 dbname=db8u3gdkjq4l6i
        user=oihnrigiktbsug password=03f8fa546db912cfc133c1faa898ef14cd26324691f4ba13ee09d89db73c9e8f");
    $q = "SELECT book_id, title, author, isbn FROM books WHERE book_id=$id;";

    //run query
    $r = @pg_query($dbc, $q);

    //if error
    if (!$r) {
      echo "Database error.";
      exit;
    }

    //see if result was correct and matches all data
    else{
      while ($row = pg_fetch_row($r)) {
        $this->assertEquals($row[0], "test");
        $this->assertEquals($row[1], "test");
        $this->assertEquals($row[2], 100);
        $this->assertEquals($row[3], "test");
      }
    }

    //clean up - delete the test book
    $q2 = "delete from books where book_id=$id;";
    $r2 = @pg_query($dbc, $q2);
  }
}
?>
