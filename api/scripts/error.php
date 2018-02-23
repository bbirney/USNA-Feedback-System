<?php
  if(!isset($API_FUNC)) { echo "Invalid Script Requested"; die(); }
  $cmd = "";
  if (isset($API_PATH[0])) {
    if(isset($API_PATH[1])) {
      $cmd = "tail -1000 /var/log/apache2/error.log | grep -m".$API_PATH[1]." ".$API_PATH[0];
    } else {
      $cmd = "tail -1000 /var/log/apache2/error.log | grep -m 10 ".$API_PATH[0];
    }
  } else {
    $cmd = "tail -1000 /var/log/apache2/error.log | grep -m 10 ".USER['user'];
  }

  $output = preg_split("/((\r?\n)|(\r\n?))/", shell_exec($cmd));

  echo json_encode($output);
?>
