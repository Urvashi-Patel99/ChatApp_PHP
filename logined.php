<?php

session_start();
include 'db.php';
if($_POST['login']) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  $query = 'SELECT * FROM users where email="' . $email . '" AND password="' . $password . '"';
  $result = mysqli_query($db, $query);
  if (mysqli_num_rows($result) > 0) {
    $row=mysqli_fetch_assoc($result);
    print_r($row);
    $_SESSION['userId']=$row['id'];
    $_SESSION['userName']=$row['username'];
    header('location: index.php');
    //echo '1';
  } else {
    echo 'not logined';
    $_SESSION['errormsg']= "Username and password wrong";
    header('location: login.php');
  //  echo '0';
  }
}


?>