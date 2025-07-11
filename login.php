<?php
session_start();
if(isset($_SESSION['userId']) && isset($_SESSION['userName'])) {
  header('location: index.php');
}

include 'header.php';

?>
<?
if(isset($_SESSION['errormsg'])) {
   echo $_SESSION['errormsg'];
} $_SESSION['errormsg'] = '';
?>

<div class="row bg-dark vh-100 align-items-center">
  <div class="col-9 col-sm-7 col-md-6 col-lg-3 bg-info-subtle rounded shadow p-5 mx-auto">
    <div class="h2 text-center mb-4">Login Here</div>
    <form action="logined.php" method="post">
      <input type="email" name="email" class="form-control mb-3" placeholder="email">
      <input type="password" name="password" class="form-control mb-3" placeholder="password">
      <input type="submit" name="login" value="Login" class="btn  btn-primary w-100">
    </form>
  </div>
</div>




<?php
include 'footer.php';
?>