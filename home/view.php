<?php
  ###############################################################
  #              Security and Navbar Configuration              #
  ###############################################################
  $MODULE_DEF = array('name'       => 'Give Feedback',
                      'version'    => 1.0,
                      'display'    => '',
                      'tab'        => 'give_feedback',
                      'position'   => 2,
                      'student'    => true,
                      'instructor' => true,
                      'guest'      => false,
                      'access'     => array());
  ###############################################################

  $PAGE_TITLE = "View Feedback";

  # Load in Configuration Parameters
  require_once("../etc/config.inc.php");

  # Load in template, if not already loaded
  require_once(LIBRARY_PATH.'template.php');

  # Load in The NavBar
  # Note: You too will have automated NavBar generation
  #       support in your future templates...
  require_once(WEB_PATH.'navbar.php');

  function assoc_arr_to_table($data, $header=false) {
    $table = "<table class=\"table table-striped table-bordered table-condensed\">";

    if ($header) {
      $table .= "<thead><tr>";

      $keys = array_keys($data);
      for ($i=0;$i<sizeof($keys);$i++) $table .= "<th>".$keys[$i]."</th>";

      $table .= "</tr></thead>";
    }

    $table .= "<tbody>";
    foreach ($data as $i => $val) {
      $table .= "<tr><td>".$i."</td>";
      foreach ($val as $key => $value) {
        $table .= "<td>".$value."</td>";
      }
      $table .= "</tr>";
    }
    $table .= "</tbody></table>";

    return $table;
  }

    $query_fields = array(USER['user']);

    $stmt = build_query($db, "SELECT * FROM feedback WHERE user = ?", $query_fields);
    $stmt->store_result();
    $stmt->bind_result($alpha, $msg, $giver, $timestamp);

    $recieved = array();
    for ($i=0; $stmt->fetch(); $i++) {
      // $recieved[$i]['alpha'] = $alpha;
      $recieved[$i]['msg'] = $msg;
      $recieved[$i]['giver'] = $giver;
      $recieved[$i]['timestamp'] = $timestamp;
    }

    $stmt->close();
    $stmt = build_query($db, "SELECT * FROM feedback WHERE giver = ?", $query_fields);

    $stmt->store_result();
    $stmt->bind_result($alpha, $msg, $giver, $timestamp);

    $given = array();
    for ($i=0; $stmt->fetch(); $i++) {
      $given[$i]['alpha'] = $alpha;
      $given[$i]['msg'] = $msg;
      $given[$i]['giver'] = $giver;
      $given[$i]['timestamp'] = $timestamp;
    }

    $stmt->close();

    echo "<br><br><br>";

    $table = assoc_arr_to_table($recieved, false);
    $table2 = assoc_arr_to_table($given, false);

    echo $table;
    echo "<br><br>";
    echo $table2;

    die();
?>

</body>
</html>
