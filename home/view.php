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

  require_once(LIBRARY_PATH.'lib_feedback.php');

  function assoc_arr_to_table($data, $header=false) {
    $table = "<table class=\"table table-striped table-bordered table-condensed\">";

    if ($header) {
      $table .= "<thead><tr>";

      $keys = array_keys($data[0]);
      for ($i=0;$i<sizeof($keys);$i++) $table .= "<th>".$keys[$i]."</th>";

      $table .= "</tr></thead>";
    }

    $table .= "<tbody>";
    foreach ($data as $i => $val) {
      $table .= "<tr>";
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
    $stmt->bind_result($alpha, $msg, $giver, $status, $timestamp);

    $recieved = array();
    for ($i=0; $stmt->fetch(); $i++) {
      $recieved[$i] = create_blurb(new Feedback(USER['user'], $msg, $giver, $status, $timestamp));
    }

    $stmt->close();
    $stmt = build_query($db, "SELECT * FROM feedback WHERE giver = ?", $query_fields);

    $stmt->store_result();
    $stmt->bind_result($alpha, $msg, $giver, $status, $timestamp);

    $given = array();
    for ($i=0; $stmt->fetch(); $i++)
      $given[$i] = create_blurb(new Feedback($alpha, $msg, USER['user'], $status, $timestamp));

    $stmt->close();

?>
  <br>
  <div class="row clean">
    <div class="col-md-1"></div>
    <div class="col-md-5">
      <h3 class="text-center">Recieved Feedback</h3>
      <div class="scrollable">
        <?php for ($i=sizeof($recieved)-1;$i>=0;$i--) echo $recieved[$i]; ?>
      </div>
    </div>
    <div class="col-md-5">
      <h3 class="text-center">Given Feedback</h3>
      <div class="scrollable">
        <?php for ($i=sizeof($given)-1;$i>=0;$i--) echo $given[$i]; ?>
      </div>
    </div>
    <div class="col-md-1"></div>
</body>
</html>
