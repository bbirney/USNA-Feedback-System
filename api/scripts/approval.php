<?php
  if (!isset($API_PATH)) die();
  // if (!isset($_REQUEST['helpful'])) die();

  echo "<pre>";
  print_r($_REQUEST);
  echo "</pre>";
  die();

  $feedback_info = explode("-", $_REQUEST['helpful']);

  $stmt = build_query("INSERT INTO feedback_id approval VALUES (?) WHERE id = ?", $feedback_info);

  print_r($feedback_info);

  die();

  $result = "<div class=\"col-md-4 alert alert-success alert-dismissible\" role=\"alert\">
      <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">×</span></button>
      <strong>Feedback judged!</strong>
    </div>";

  echo $result;
  die();
?>
