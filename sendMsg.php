<?php

include 'pusher.php';
include "db.php";
if ($_POST['url'] == 'sendMsg') {
  $id = $_POST['userId'];
  $name = $_POST['userName'];
  $msg = $_POST['msg'];
  $query = "INSERT INTO `msgs` (`id`, `userId`, `userName`, `message`) VALUES (NULL, '$id', '$name', '$msg');";
  if (mysqli_query($db, $query)) {
    $data['id'] = $_POST['userId'];
    $data['name'] = $_POST['userName'];
    $data['msg'] = $_POST['msg'];
    $pusher->trigger('my-channel', 'my-event', $data);
  } else {
    return false;
  }
}
?>