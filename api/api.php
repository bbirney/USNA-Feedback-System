<?php
  if (!isset($_GET['path'])) { die(); }

  const type_arr = array(' USMC'=>'MARINE OFFICER', ' USN' =>'NAVY OFFICER',
      ' USA' =>'ARMY OFFICER',   ' USAF'=>'AIR FORCE OFFICER',
      ' CIV' =>'CIVILIAN',       ' MIDN'=>'MIDN');
  const user_arr = array('73bbae7d-917a-4999-83b2-0968e7a8091d' =>
                         array('user'=>"m181234", 'fullname'=>"MIDN John P. Jones",
                               'department'=>"IT", 'first'=> "John", 'last'=>"Jones"),
                         'a442a166-1484-4cd7-9a69-abdcee195627' =>
                         array('user'=>"instructor", 'fullname'=>"General USA George Washington",
                              'department'=>"IT", 'first'=> "George", 'last'=>"Washington",
                              'priviledges' => array('admin' => array('become', 'site'))));

  $temp = explode("/", $_GET['path']);
  $API_ROLE = "default";
  $API_KEY = $temp[0];
  $API_FUNC = $temp[1];
  $API_PATH = array();
  for ($i = 2; $i < sizeof($temp); $i++) {
    $API_PATH[$i-2] = $temp[$i];
  }

  if (isset(user_arr[$API_KEY])) {
    define('USER', user_arr[$API_KEY]);

    if (isset(USER['priviledges'])) { define('ADMIN', true); }
    else { define('ADMIN', false); }
    if (preg_match("/(m|M)[0-9]{6}/", USER['user'])) { define('STUDENT', true); define('INSTRUCTOR', false); define('GUEST', false); }
    else { define('STUDENT', false); define('INSTRUCTOR', true); define('GUEST', false); }

    foreach (type_arr as $type) {
      if (strpos(USER['fullname'], $type) !== false) {
        define('TYPE', $type);
      }
    }
  } else {
    echo "Invalid API Token";
    die();
  }

  if (!file_exists("scripts/".$API_FUNC.".php")) { echo "Invalid Script Requested"; die(); }
  require_once("scripts/".$API_FUNC.".php");
?>
