<?php

namespace tests\unit;

include('D:\wapp\apache2\htdocs\functions.php');

class UnitTests extends \PHPUnit\Framework\TestCase
{

  function testGetSession(){
    $dbc = pg_connect("host=ec2-54-235-100-99.compute-1.amazonaws.com port=5432 dbname=db8u3gdkjq4l6i
        user=oihnrigiktbsug password=03f8fa546db912cfc133c1faa898ef14cd26324691f4ba13ee09d89db73c9e8f");
    $q = "SELECT firstname, lastname FROM users WHERE username='Test' AND password=crypt('Test', password)";
    $r = @pg_query($dbc, $q); // Run the query.
    $expected = 'The username and password entered do not match!!.';
    $this->assertEquals($expected, getSession($r, 'Test'));
  }

  function testGetNumUsers(){
    $expected = 7;
    $this->assertEquals($expected, getNumUsers());
  }

  function testGetNumBooks(){
    $expected = 29;
    $this->assertEquals($expected, getNumBooks());
  }

  function testIsRegistered(){
    $expected = true;
    $email = 'test123@gmail.com';
    $this->assertEquals($expected, isRegistered($email));
  }

}

?>
