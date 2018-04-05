<?php
  if (!isset($API_PATH)) die();

  $character = array($API_PATH[0]);

  $stmt = build_query($db, "SELECT * from matchups WHERE character=?", $character);
  $stmt->execute();
  $result = stmt_to_assoc_array($stmt);

  echo json_encode($result);
?>
