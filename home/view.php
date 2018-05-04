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

  $api_data = retrieve_apikey($db, USER['user']);
  if (count($api_data) < 1) {
    generate_apikey($db, USER['user']);
    $api_data = retrieve_apikey($db, USER['user']);
  }

  $query_fields = array(USER['user']);

  $stmt = build_query($db, "SELECT * FROM feedback WHERE user = ?", $query_fields);
  $stmt->store_result();
  $stmt->bind_result($user, $do_well, $improve, $giver, $status, $time, $know, $id);

  $received = array();
  for ($i=0; $stmt->fetch(); $i++) {
    $received[$i] = new Feedback($user, $do_well, $improve, $giver, $status, $time, $know, $id);
  }

  $stmt->close();
  $stmt = build_query($db, "SELECT * FROM feedback WHERE giver = ?", $query_fields);

  $stmt->store_result();
  $stmt->bind_result($user, $do_well, $improve, $giver, $status, $time, $know, $id);

  $given = array();
  for ($i=0; $stmt->fetch(); $i++) {
    $given[$i] = new Feedback($user, $do_well, $improve, $giver, $status, $time, $know, $id);
  }

  $stmt->close();

  for ($i=0;$i<sizeof($given);$i++) {
    $stmt = build_query($db, "SELECT * FROM feedback_id WHERE id = ?", array($id));

    $stmt->store_result();
    $stmt->bind_result($id, $approval);
    $stmt->fetch();

    $given[$i]->setApp($approval);
    $stmt->close();
  }

  for ($i=0;$i<sizeof($received);$i++) {
    $stmt = build_query($db, "SELECT * FROM feedback_id WHERE id = ?", array($id));

    $stmt->store_result();
    $stmt->bind_result($id, $approval);
    $stmt->fetch();

    $received[$i]->setApp($approval);
    $stmt->close();
  }

?>
<h1 class="text-center">View Feedback</h1>
  <div class="row clean">
    <div class="col-md-1"></div>
    <div class="col-md-5">
      <h3 class="text-center">Received (<?php echo sizeof($received); ?>)</h3>
      <div class="scrollable">
        <?php for ($i=sizeof($received)-1;$i>=0;$i--) echo $received[$i]->create_blurb(USER['user']); ?>
      </div>
    </div>
    <div class="col-md-5">
      <h3 class="text-center">Given (<?php echo sizeof($given); ?>)</h3>
      <div class="scrollable">
        <?php for ($i=sizeof($given)-1;$i>=0;$i--) echo $given[$i]->create_blurb(USER['user']); ?>
      </div>
    </div>
    <div class="col-md-1"></div>
  </div>
  <br>
  <div class="col-md-4"></div>
  <div class="col-md-4" id="output"></div>
</body>
</html>
<script type="text/javascript">
  $(document).ready(function() {
    var hidden;
    $("#review").submit(function(e) {
      console.log(hidden);
      // $("#output").load('../api/<?php echo $api_data['apikey']; ?>/approval', $(this).serialize());
      e.preventDefault();
    });
  });
</script>
