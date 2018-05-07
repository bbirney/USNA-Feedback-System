<?php
  if (!isset($API_PATH)) die();
  // if (!isset($_REQUEST['helpful'])) die();

  // print_r($_REQUEST);

  $feedback_info = explode("-", $_REQUEST['helpful']);

  $stmt = build_query($db, "UPDATE feedback_id SET approval = ? WHERE id = ?", $feedback_info);

  $result = "<div class=\"col-md-2 col-md-offset-5 alert alert-info alert-dismissible\" role=\"alert\">
      <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">×</span></button>
      <strong>Feedback judged!</strong>
    </div>";

  echo $result;
  die();
?>
