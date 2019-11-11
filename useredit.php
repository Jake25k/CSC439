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
<head>
  <meta charset="UTF-8" />
  <title>User page</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
    crossorigin="anonymous" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
    crossorigin="anonymous">
  <link rel="stylesheet" href="styles/Style.css" />

  <?php include("includes/userpage_functions.php"); ?>
</head>

<body>
  <header>
      <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg">
          <a class="navbar-brand" href="index.php">
            <i class="fas fa-book-reader fa-2x mx-3"></i>Best Books</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
            aria-label="Toggle navigation">
            <i class="fas fa-align-right text-light"></i>
          </button>
        <div class="search">
          <form action="search.php" method="post">
              <input type="text" name="term" placeholder="Search..."/>
              <input type="submit" value="Search" />
          </form>
        </div>
          <div class="collapse navbar-collapse" id="navbarNav">
            <div class="mr-auto"></div>
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="books.php">BOOK INVENTORY
  				<span class="sr-only">(current)</span>
  			  </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="about.html">ABOUT</a>
              </li>
              <?php
                if (isset($_SESSION['user'])) {
                  echo '<li class="nav-item"><a class="nav-link" href="logout.php">LOGOUT</a></li>';
                  echo '<li class="nav-item"><a class="nav-link" href="userpage.php">' . $_SESSION['user'] . '<br>Cart: '. count($_SESSION['user_cart']) .' Books</a></li>';
                }
                else {
                  echo '<li class="nav-item"><a class="nav-link" href="login.php">LOGIN</a></li>';
                }
              ?>
            </ul>
          </div>
        </nav>
      </div>
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
