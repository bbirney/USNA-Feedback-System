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

  $PAGE_TITLE = "Statistics";

  # Load in Configuration Parameters
  require_once("../etc/config.inc.php");

  # Load in template, if not already loaded
  require_once(LIBRARY_PATH.'template.php');

  # Load in The NavBar
  # Note: You too will have automated NavBar generation
  #       support in your future templates...
  require_once(WEB_PATH.'navbar.php');

  require_once(LIBRARY_PATH.'lib_feedback.php');

  $api_data = retrieve_apikey($db, USER['user']);
  if (count($api_data) < 1) {
    generate_apikey($db, USER['user']);
    $api_data = retrieve_apikey($db, USER['user']);
  }

  $stmt->close();
  $stmt = build_query($db, "SELECT * FROM feedback", array());

  $stmt->store_result();
  $stmt->bind_result($user, $do_well, $improve, $giver, $status, $time, $know, $id);

  $feedback = array();
  for ($i=0; $stmt->fetch(); $i++) {
    $feedback[$i] = new Feedback($user, $do_well, $improve, $giver, $status, $time, $know, $id);
  }

  $stmt->close();

  for ($i=0;$i<sizeof($feedback);$i++) {
    $stmt = build_query($db, "SELECT * FROM feedback_id WHERE id = ?", array($feedback[$i]->id));

    $stmt->store_result();
    $stmt->bind_result($id, $approval);
    $stmt->fetch();

    $feedback[$i]->setApp($approval);
    $stmt->close();
  }
?>
<h1 class="text-center">View Feedback</h1>
  <div class="row clean">
    <div class="col-md-1"></div>
    <div class="col-md-10">
      <h3 class="text-center">Total Feedback (<?php echo sizeof($feedback); ?>)</h3>
      <div class="scrollable">
        <?php for ($i=sizeof($feedback)-1;$i>=0;$i--) echo $feedback[$i]->create_blurb(USER['user']); ?>
      </div>
    </div>
    <div class="col-md-1"></div>
  </div>
</body>
</html>
