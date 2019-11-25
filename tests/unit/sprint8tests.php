<?php
namespace tests\unit;
class UnitTests4 extends \PHPUnit\Framework\TestCase
{
  function testUserEdit(){
    $dbc = pg_connect("host=ec2-54-235-100-99.compute-1.amazonaws.com port=5432 dbname=db8u3gdkjq4l6i
        user=oihnrigiktbsug password=03f8fa546db912cfc133c1faa898ef14cd26324691f4ba13ee09d89db73c9e8f");
    $q = "SELECT * FROM users WHERE user_id=3";
    $r = @pg_query($dbc, $q); // Run the query.

    if (!$r) {
      echo "Database error.";
      exit;
    }

    else{
      while ($row = pg_fetch_row($r)) {
        //change name to "newName"
        $newName = "newName";
        $fname = $row[0];
        $lname = $row[1];
        updateUser($newName, $fname, $lname);

        //see if it worked
        $q2 = "SELECT username FROM users WHERE user_id=3";
        $r2 = @pg_query($dbc, $q2); // Run the query.

        if (!$r2) {
          echo "Database error.";
          exit;
        }

        else{
          while ($row = pg_fetch_row($r)) {

            //test to see if name change worked
            $this->assertEquals($row[2], "newName");
          }
        }
      }

      //change name back
      $newName = "testman";
      updateUser($newName, $fname, $lname);

      //see if it worked
      $q3 = "SELECT username FROM users WHERE user_id=3";
      $r3 = @pg_query($dbc, $q3); // Run the query.

      if (!$r3) {
        echo "Database error.";
        exit;
      }

      else{
        while ($row = pg_fetch_row($r)) {

          //test to see if name changed back worked
          $this->assertEquals($row[2], "testman");
        }
      }
    }
  }
}
?>
