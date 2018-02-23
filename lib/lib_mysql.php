<?php

  ##############################################################################
  # Note: This library expects, at a minimum the following constants
  #       to be defined prior to loading the library
  #
  # define('DATABASE_MYSQL',
  #         array('default'=>array('host'=>'midn.cs.usna.edu',
  #                                'user'=>'database username',
  #                                'password'=>'users password',
  #                                'name'=>'database name')));
  ##############################################################################
  # Used to establish a link to a database
  function connect_db($hostname, $username, $password, $schema) {
    # Connect to MySQL
    $db = new mysqli($hostname, $username, $password, $schema);

    # Provide Failure data if unsuccessful
    if (mysqli_connect_errno()) {
        echo "<hr><h1><font color=red>Database Connection Failure:</font></h1>";
        echo "<pre>ERROR: " . mysqli_connect_errno() . "</pre><pre>" . mysqli_connect_error() . "</pre><hr>";
    }

    ##############################################################################
    # Let there be UTF-8
    $db->query("set character_set_client='utf8'");
    $db->query("set character_set_results='utf8'");
    $db->query("set collation_connection='utf8_general_ci'");

    return $db;
  }

  ##############################################################################
  # Connect to default database (if defined)
  if (defined('DATABASE_MYSQL') && isset(DATABASE_MYSQL['default'])) {
    $db = connect_db(DATABASE_MYSQL['default']['host'], DATABASE_MYSQL['default']['user'], DATABASE_MYSQL['default']['password'], DATABASE_MYSQL['default']['name']);
  } else {
    echo "<hr><h1><font color=red>Database Information NOT Configured</font></h1>";
    die;
  }

  ##############################################################################
	// Return an associative array of the MySQLi results, given a returned $stmt object
	//
	//  Results will be returned in the following format
	// 	Array
	// (
	//     [0] => Array
	//         (
	//             [user] => jpjones
	//             [displayname] => Professor John Paul Jones
	//             [first] => John Paul
	//             [last] => Jones
	//             [department] => Computer Science
	//             [session] => user|s:6:"jpjones";
	//             [id] => fknibxx97m2gq6ehk4a1rpaki7
	//             [valid] => 1472867262
	//             [login] => 1472861282
	//         )
	//
	// )
  function stmt_to_assoc_array($stmt) {
    $meta = $stmt->result_metadata();
    while ($field = $meta->fetch_field()) {
      $params[] = &$row[$field->name];
    }
    call_user_func_array(array($stmt, 'bind_result'), $params);
    while ($stmt->fetch()) {
      foreach($row as $key => $val) {
        $c[$key] = $val;
      }
      $results[] = $c;
    }
    if (!isset($results)) {
      return array();
    }
    return $results;
  }

  ##############################################################################
  # return a single row (from results assuming that there was only one row)
  function array_2d_to_1d($results) {
    if (isset($results[0])) {
      return $results[0];
    } else {
      return array();
    }
  }

  ##############################################################################
	# Dynamically Build a MySQL Prepared Query...
	# Returns an executed $stmt, that can then be stepped though or processed
	#
	# Example Usage:
	#  $query = "SELECT * FROM auth_user WHERE user=? AND last=?";
	#  $bind_fields = array("jpjones", "Jones");
	#  $stmt = build_query($db, $query, $bind_fields);
	# Example Usage:
	#  $stmt = build_query($db, "SELECT * FROM auth_user");
	function build_query($db, $query, $bind_fields=array()) {
    $check = true;

		# Determine the bind types of variables, and build the string
		$bind_string = '';
		foreach ($bind_fields as $bf) {
			$bind_string .= 's';
		}

		# Build the parameter array
		$mysql_bind_string = array();
		$mysql_bind_string[] = & $bind_string;
		for ($i = 0; $i < count($bind_fields); $i++) {
			$mysql_bind_string[] = & $bind_fields[$i];
		}

		# Initialize a new DB query
		$stmt = $db->stmt_init();

		# Error in initialization
		if($stmt === false && $check) {
      debug_errors($db, 1, "Initialization", $query, $bind_fields);
      $check = false;
		}

		# Build MySQL PREPARED statement
		$stmt->prepare($query);

		# Error in prepare
		if ($db->errno  && $check) {
      debug_errors($db, 2, "Prepare", $query, $bind_fields);
      $check = false;
		}

		# Bind the fields to the query
		if ($bind_string != '') {
			$result = call_user_func_array(array($stmt, 'bind_param'), $mysql_bind_string);

			# Error in the number of ? in the prepared query statement
			if (count($bind_fields) != substr_count($query, '?')  && $check) {
        debug_errors($db, 3, "Binding Parameters", $query, $bind_fields);
        $check = false;
			}

			# Binding errors
			if (!$result  && $check) {
        debug_errors($db, 4, "Binding", $query, $bind_fields);
        $check = false;
			}
		}

		# Execute MySQL PREPARE statement
		$result = $stmt->execute();

		# Execution Error
		if (!$result  && $check) {
      debug_errors($db, 5, "Execution", $query, $bind_fields);
      $check = false;
		}

		# Return the SQL $stmt object.
		return $stmt;
	}

  function debug_errors($db, $no, $text, $query, $bind_fields) {
    $arr = debug_backtrace();
    echo "<br><div class=\"col-md-2\"></div><div class=\" col-md-8 jumbotron alert-danger alert-dismissible\" style=\"border-radius:15px !important;padding: 15px;\">";
    echo "<b><h1>Database Error (Step $no - $text): </b></h1><br>";

    echo "The following query was provided to the <b>build_query()</b> function: <br>";
    echo "".$query."<br><br>";

    echo "This query would have been interpreted, via PREPARE procedures, as: <br>";
    if (sizeof($bind_fields) == 1) { echo str_replace("?", "<b><u>".$bind_fields[0]."</u></b>", $query)."<br><br>"; }
    else { echo str_replace("?", "<b><u>".$bind_fields."</u></b>", $query)."<br><br>"; }


    echo "<h3><b>Location of DB Function Call(s): </b></h3><br>";
    for ($i=0; $i < sizeof($arr); $i++) {
      $shortfile = explode("/", $arr[$i]['file']);
      $shortfile = $shortfile[sizeof($shortfile)-1];
      if ($arr[$i]['function'] == "build_query") {
        echo "".$shortfile." -- ".$arr[$i]['line']." -- ".$arr[$i]['function']."() -- ".realpath($arr[$i]['file'])."<br><br>";
      }
    }

    echo "<h3><b>Additional Error Data: </b></h3><br>";

    for ($i=0; $i < sizeof($arr); $i++) {
      $shortfile = explode("/", $arr[$i]['file']);
      $shortfile = $shortfile[sizeof($shortfile)-1];
      if ($arr[$i]['function'] != "build_query") {
        echo "".$shortfile." -- ".$arr[$i]['line']." -- ".$arr[$i]['function']."() -- ".realpath($arr[$i]['file'])."<br>";
      }
    }


    echo "<h3><br><b>The following debugging data is provided by the SQL library functions: </b></h3><br>";
    echo $db->errno.": ".$db->error."<br>";

    echo "<h3><br><b>Please contact the database or web administrator to report this error</b><br></h3></div>";
  }
?>
