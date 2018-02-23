<?php
/**
 * THIS LIBRARY ASSUMES LIB_MYSQL HAS BEEN LOADED
 **/

  function authenticate_api($db, $apikey) {
    $query = "SELECT user, expires FROM auth_api WHERE apikey=? AND expires > NOW()";

    $stmt = build_query($db, $query, array($apikey));
    if ($stmt->store_result()) {
      $results = stmt_to_assoc_array($stmt);
      return array('user'=>$results[0]['user'], 'expires'=>$results[0]['expires']);
    } else { echo "Invalid API key"; die(); }
  }

  function retrieve_user_information($db, $user) {
    $query = "SELECT user, session, fullname, department, first, last FROM auth_user WHERE user=?";
    $stmt = build_query($db, $query, array($user));
    if ($stmt->store_result()) {
      $results = stmt_to_assoc_array($stmt);
      define('USER', $results[0]);
      unset($results);

      if (isset($results[0]['privileges']['admin'])) {
        define('ADMIN', True);
      } else {
        define('ADMIN', False);
      }

      if (USER['user'] == 'guest') {
        define('GUEST', True);
        define('STUDENT', False);
        define('INSTRUCTOR', False);
      } elseif (preg_match("/^M[0-9]{6}/", $results[0]['user']) == 0
             && preg_match("/^m[0-9]{6}/", $results[0]['user']) == 0) {
        define('GUEST', False);
        define('STUDENT', False);
        define('INSTRUCTOR', True);
      } else {
        define('GUEST', False);
        define('STUDENT', True);
        define('INSTRUCTOR', False);
      }

      foreach (array(' USMC '=>'MARINE OFFICER', ' USN ' =>'NAVY OFFICER',
                     ' USA ' =>'ARMY OFFICER',   ' USAF '=>'AIR FORCE OFFICER',
                     ' CIV ' =>'CIVILIAN',
                     ' Midn '=>'MIDN',           ' MIDN '=>'MIDN')
               as $search => $report) {
          if (strpos(USER['fullname'], $search) !== false && !defined('TYPE')) {
            define('TYPE', $report);
          }
      }
      if (!defined('TYPE')) {
        define('TYPE', 'UNKNOWN');
      }

      return;

    } else { echo "Error fetching $user's database entry"; die(); }
  }

  function retrieve_apikey($db, $user)  {
    $query = "SELECT user, expires, apikey FROM auth_api WHERE user=? AND expires > NOW()";
    $stmt = build_query($db, $query, array($user));
    if ($stmt->store_result()) {
      $results = stmt_to_assoc_array($stmt);
      //print_r($results);

      if (!isset($results[0]['apikey']) || $results[0]['apikey'] == "") {
        generate_apikey($db, $user);
        //return retrieve_apikey($db, $user);
      }
      return array('user'=>$results[0]['user'], 'expires'=>$results[0]['expires'],
                   'api_key'=>$results[0]['apikey']);
    } else { echo "Error fetching $user's API key"; die(); }
  }

  function generate_apikey($db, $user) {
    require_once("../lib/lib_uuid.php");
    $api_key = generate_uuid();
    $query = "INSERT INTO auth_api (user, apikey) VALUES (?, ?) ON DUPLICATE KEY UPDATE apikey=?";
    $stmt = build_query($db, $query, array($user, $api_key, $api_key));
    if ($stmt->store_result()) {
      return;
    } else { echo "Error generating and storing $user's API key"; die(); }
  }

  /**
   * Fxn adds session data into data under the column 'session_data'
   * - Could be helpful to remember data user provides so you may "remember"
   *   things despite a logoff
   **/
  function store_session_data($db, $user) {
    if (!isset($_SESSION)) { echo "ERROR: No session"; die(); }
    $query = "INSERT INTO auth_user session VALUES (?) WHERE user=?";
    $stmt = build_query($db, $query, array($_SESSION, $user));
    if ($stmt->store_result()) {
      return;
    } else { echo "Error storing $user's session data"; die(); }
  }

  /**
   * Fxn fetches user's previous session data, removes row from table
   * - Works to provide previous $_SESSION array provided by store_session_data
   **/
   function fetch_session_data($db, $user) {
     $query = "SELECT session FROM auth_user WHERE user=?";
     $stmt = build_query($db, $query, array($user));
     if ($stmt->store_result()) {
       $results = stmt_to_assoc_array($stmt);
       return $results[0]['session'];
     } else { echo "Error fetching $user's session data"; die(); }
   }
?>
