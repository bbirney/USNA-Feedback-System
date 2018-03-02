<?php
  if (!isset($_GET['path']) || sizeof($_GET['path']) < 2) { echo "Invalid API Token"; die(); }
  require_once("../etc/config.inc.php");
  require_once("../lib/lib_mysql.php");
  require_once("../lib/lib_api.php");
  require_once("../lib/lib_csv.php");

  $temp = explode("/", $_GET['path']);
  $API_ROLE = "default";
  $API_KEY = $temp[0];
  $API_FUNC = $temp[1];
  $API_PATH = array();
  for ($i = 2; $i < sizeof($temp); $i++) {
    $API_PATH[$i-2] = $temp[$i];
  }

  $db = connect_db(DATABASE_MYSQL['default']['host'], DATABASE_MYSQL['default']['user'],
                   DATABASE_MYSQL['default']['password'], DATABASE_MYSQL['default']['name']);

  if (isset($API_KEY)) {
    //echo $API_KEY."<br>";
    $temp_user = authenticate_api($db, $API_KEY);
    if (empty($temp_user)) { echo "Invalid API Token"; die(); }
    retrieve_user_information($db, $temp_user['user']);
  } else {
    echo "Invalid API Token";
    die();
  }

  if (!file_exists("scripts/".$API_FUNC.".php")) { echo "Invalid Script Requested"; die(); }
  require_once("scripts/".$API_FUNC.".php");
?>
