<?php
require __DIR__ . '/vendor/autoload.php';

  $options = array(
    'cluster' => 'ap2',
    'useTLS' => true
  );
  $pusher = new Pusher\Pusher(
    '305ce60b19649c2fd770',
    '84d30e227c9cfe09d9aa',
    '2018828',
    $options
  );


?>