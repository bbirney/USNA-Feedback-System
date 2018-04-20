<?php
  if (!isset($API_PATH)) die();
  if (!isset($_POST['msg']) || !isset(USER['user'])) die();

  $query_fields = array(USER['user'], $_POST['msg']);
  $stmt = build_query($db, "INSERT INTO message_board (user, msg) VALUES (?, ?)", $query_fields);
  $stmt->close();

  $stmt = build_query($db, "SELECT * FROM message_board", array());
  $stmt->bind_result($user, $time, $msg);

  $mb_content = array();
  for ($i=0;$stmt->fetch();$i++) {
    $mb_content[$i]['user'] = $user;
    $mb_content[$i]['time'] = $time;
    $mb_content[$i]['msg'] = $msg;
  }

  echo json_encode($mb_content);
  die();
?>
