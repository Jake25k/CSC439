<?php
include 'loginFunctions.php';

/* User logged in */
function loggedIn(){
    if (isset($_SESSION['user'])){
      return true;
    }
    return false;
  }


function testGetSession()
    if (isset($_SESSION['user']) && isset($_SESSION['fname']) && isset($_SESSION['lname'])){
        return true;
    }
    return false;

?>