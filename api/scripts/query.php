<?php
  if (!isset($_POST['query'])) die();

  $stmt = build_query($db, $_POST['query'], array());
  $stmt->bind_result($results);

  while($stmr->fetch());
  $stmt->close();

  echo json_encode($results);
?>
