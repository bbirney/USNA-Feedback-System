<?php
  if (!isset($API_PATH) || !isset($_POST['feedback']) || !isset($_POST['alpha'])) die();


  // $query_fields = array($_POST['alpha'], $_POST['feedback'], USER['user']);
  //
  // $stmt = build_query($db, "INSERT INTO feedback (user, feedback, giver) VALUES (?, ?, ?)", $query_fields);
  // $stmt->execute();

  $result = "<div class=\"col-md-4 alert alert-success alert-dismissible\" role=\"alert\">
      <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">×</span></button>
      <strong>Feedback submitted!</strong>
    </div>";

  echo json_encode($result);
?>
