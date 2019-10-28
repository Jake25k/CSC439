<?php
namespace tests\unit;
class UnitTests2 extends \PHPUnit\Framework\TestCase
{

  function howManyBooksFromAuthorTest(){
    //currently, stephen hawking only has 2 books in our database so the return value should only be 2
    $dbc = pg_connect("host=ec2-54-235-100-99.compute-1.amazonaws.com port=5432 dbname=db8u3gdkjq4l6i
        user=oihnrigiktbsug password=03f8fa546db912cfc133c1faa898ef14cd26324691f4ba13ee09d89db73c9e8f");
    $q = "SELECT book_id FROM books WHERE author='Stephen Hawking'";
    $r = @pg_query($dbc, $q); // Run the query.

    if (!$r) {
      echo "Database error.";
      exit;
    }
    else{
      while ($row = pg_fetch_row($r)) {
        $count++;
      }
    }

    $expected = 2;
    $this->assertEquals($expected, $count);
  }
}
?>
