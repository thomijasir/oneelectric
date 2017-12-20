<?php
  require __DIR__ . '/vendor/autoload.php';

  $options = array(
    'cluster' => 'ap1',
    'encrypted' => true
  );
  $pusher = new Pusher\Pusher(
    '7106608cddcc977d6465',
    '2060ea966fe8aa38e3f8',
    '339062',
    $options
  );

  $data['message'] = 'hello world';
  $pusher->trigger('my-channel', 'my-event', $data);
  echo "Motion Detected!";
?>