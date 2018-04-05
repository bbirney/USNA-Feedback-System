<?php
  if (!isset($_POST['query'])) die();

  $stmt = build_query($db, $_POST['query'], array());
  $result = $stmt->execute();
  $result = stmt_to_assoc_array($result);
  $stmt->close();

  echo json_encode($result);
?>
