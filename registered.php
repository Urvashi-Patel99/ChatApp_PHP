<?php

include "db.php";
if($_POST['register']){
  $username=$_POST['username'];
  $email=$_POST['email'];
  $password=$_POST['password'];
  $query="INSERT INTO `users` (`id`, `userName`, `email`, `password`) VALUES (NULL, '$username', '$email', '$password')";
  if(mysqli_query($db,$query)){
    header('location: login.php');
  }else{
    echo 'something is going wrong!!';
  }
}


?>