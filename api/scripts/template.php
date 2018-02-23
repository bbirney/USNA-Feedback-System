<?php
  if(!isset($API_FUNC)) { echo "Invalid Script Requested"; die(); }
  $debugInfo['method'] = $_SERVER['REQUEST_METHOD'];
  $debugInfo['script'] = $API_FUNC;
  $debugInfo['key'] = $API_KEY;
  $debugInfo['args'] = $API_PATH;
  $debugInfo['get'] = $_GET;
  $debugInfo['post'] = $_POST;
  $debugInfo['type'] = array('Guest' => GUEST, 'Student' => STUDENT, 'Instructor' => INSTRUCTOR, 'Admin' => ADMIN, 'Type' => TYPE);
  $debugInfo['user'] = USER;
  $debugInfo['role'] = $API_ROLE;
  echo json_encode($debugInfo);
?>
