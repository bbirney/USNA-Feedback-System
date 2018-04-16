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

  if (isset($_REQUEST['feedback']) && isset($_REQUEST['alpha'])) {
    $query_fields = array(USER['user']);

    $stmt = build_query($db, "SELECT * FROM feedback WHERE alpha = ?", $query_fields);

    print_r($stmt);

    // $response = "<div class=\"col-md-4 col-md-offset-4 alert alert-success text-center\" role=\"alert\">
    //               <strong>Feedback submitted to ".$_REQUEST['alpha']."!</strong>
    //              </div>";
    //
    // echo $response;
    die();
  }
?>

</body>
</html>
