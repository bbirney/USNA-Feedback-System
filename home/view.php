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

  $query_fields = array(USER['user']);

  $stmt = build_query($db, "SELECT * FROM feedback WHERE user = ?", $query_fields);
  $stmt->store_result();
  $stmt->bind_result($user, $do_well, $improve, $giver, $status, $time, $know, $id);

  $received = array();
  for ($i=0; $stmt->fetch(); $i++) {
    $fb = new Feedback($user, $do_well, $improve, $giver, $status, $time, $know, $id);

    $stmt = build_query($db, "SELECT * FROM feedback_id WHERE id = ?", array($id));

    $stmt->store_result();
    $stmt->bind_result($id, $approval);
    $stmt->fetch();

    $fb->setApp($approval);
    $stmt->close();

    $received[$i] = $fb->create_blurb();
  }

  $stmt->close();
  $stmt = build_query($db, "SELECT * FROM feedback WHERE giver = ?", $query_fields);

  $stmt->store_result();
  $stmt->bind_result($user, $do_well, $improve, $giver, $status, $time, $know, $id);

  $given = array();
  for ($i=0; $stmt->fetch(); $i++) {
    $fb = new Feedback($user, $do_well, $improve, $giver, $status, $time, $know, $id);

    $stmt = build_query($db, "SELECT * FROM feedback_id WHERE id = ?", array($id));

    $stmt->store_result();
    $stmt->bind_result($id, $approval);
    $stmt->fetch();
    $fb->setApp($approval);
    $stmt->close();

    $given[$i] = $fb->create_blurb();
  }

  $stmt->close();

?>
<h1 class="text-center">View Feedback</h1>
  <div class="row clean">
    <div class="col-md-1"></div>
    <div class="col-md-5">
      <h3 class="text-center">Received (<?php echo sizeof($received); ?>)</h3>
      <div class="scrollable">
        <?php for ($i=sizeof($received)-1;$i>=0;$i--) echo $received[$i]; ?>
      </div>
    </div>
    <div class="col-md-5">
      <h3 class="text-center">Given (<?php echo sizeof($given); ?>)</h3>
      <div class="scrollable">
        <?php for ($i=sizeof($given)-1;$i>=0;$i--) echo $given[$i]; ?>
      </div>
    </div>
    <div class="col-md-1"></div>
</body>
</html>
<script type="text/javascript">
  $("#review").submit(function(e){
  $.ajax({
    data: $("#review").serialize(),
    success: function(result) {
      //NOTE: Nothing should happen
    }
  });
  e.preventDefault();
  });
</script>
