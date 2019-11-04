<?php
  /* returns true if the user is logged in */
  function loggedIn(){
    if(isset($_SESSION['user'])){
      return true;
    }
    return false;
  }
  function getMemberStatus($created_at){
    $usersYear = date('Y', strtotime($created_at));
    $currentYear = date("Y");
    $year = $currentYear - $usersYear;
    if ($year < 1){
      return "Newbie";
    }
    else if ($year < 3){
      return "Novice";
    }
    else{
        return "Master";
    }
  }

  /* displays the user's first, last name and their username */
  function displayInfo($usern, $firstn, $lastn, $created_at){
    if($usern == null ) return null;

    if($firstn == null) $firstn = "Unknown First Name";
    if($lastn == null) $lastn = "Unknown Last Name";

    echo "<h1>" . $firstn . " " . $lastn . "'s user page" . "</h1>";
    echo "<h6>Member Status: " . getMemberStatus($created_at) . "</h6>";
    echo "Username: " . $usern . "<br>";
    return true;
  }

  /* displays user's recommended books */
  function displayRecommends($books){
    echo "<h2>Recommended books: </h2>";
    foreach($books as $b){
      echo "<a href='view.php?id=" . $b['book_id'] . "'><img src='assets/covers/" . $b['book_cover'] . "' style='height: 120px; padding-right: 10px;'/></a>";
    }
    echo "<br>";
  }

  /* displays books in user's cart */
  function displayCart($books){
    echo "<h2>Cart: </h2>";
    echo "Count: " . count($books) . "<br>";
    foreach($books as $b){
      echo "<img src='assets/covers/" . $b['book_cover'] . "' style='height: 120px; padding-right: 10px;'/>";
    }
    echo "<br>";
  }
?>
