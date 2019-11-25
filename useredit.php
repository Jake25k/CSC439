<?php
    //function takes in new user information and updates the database with the info they requested
    function updateUser($uname, $fname, $lname){

      $q = "update users set username = '" . pg_escape_string($uname) . "', firstname = '" . pg_escape_string($fname) .
            "', lastname = '" . pg_escape_string($lname) . "' WHERE username = '" . $uname . "';";
      $r = @pg_query($dbc, $q); // Run the query.
      pg_close($dbc); // Close the database connection.

      //Set session variables to new information
      $_SESSION['user'] = $uname;
      $_SESSION['fname'] = $fname;
      $_SESSION['lname'] = $lname;
    }

    session_start();
    /* Check if the form has been submitted: */
    if (isset($_POST['sub'])) {

      $uname = $_POST['uname'];
      $fname = $_POST['fname'];
      $lname = $_POST['lname'];

      updateUser($uname, $fname, $lname);
    }
?>
<?php
	include("includes/header.php");
?>
  </header>

<?php
    echo "<br>";
    echo "<h1>Edit Profile: " . $_SESSION['user'] . "</h1>";
    if (isset($_POST['sub'])) {
      echo '<h2 style="color: green"> Information Updated!</h2>';
    }
?>

<form action="useredit.php" method="post">
  <ul style="list-style-type: none";>
    <li><label><b>Username</b></label></li>
    <input type="text" name="uname" value="<?php echo $_SESSION['user'];?>">
    <li><label><b>First Name</b></label></li>
    <input type="text" name="fname" value="<?php echo $_SESSION['fname'];?>">
    <li><label><b>Last Name</b></label></li>
    <input type="text" name="lname" value="<?php echo $_SESSION['lname'];?>">
    <br><br><li><button type="submit" name="sub">Submit</button></li>
  </ul>
</form>
