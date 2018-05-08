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

  $positive = 0;
  $negative = 0;
  $neutral = 0;
  $good = 0;
  $bad = 0;
  $reported_num = 0;
  $avg_words = 0;

  $api_data = retrieve_apikey($db, USER['user']);
  if (count($api_data) < 1) {
    generate_apikey($db, USER['user']);
    $api_data = retrieve_apikey($db, USER['user']);
  }

  $stmt = build_query($db, "SELECT * FROM feedback", array());

  $stmt->store_result();
  $stmt->bind_result($user, $do_well, $improve, $giver, $status, $time, $know, $id);

  $feedback = array();
  for ($i=0; $stmt->fetch(); $i++) {
    $feedback[$i] = new Feedback($user, $do_well, $improve, $giver, $status, $time, $know, $id);
    if ($status == 1) $positive++;
    else if ($status == 0) $negative++;
    else $neutral++;

    $avg_words += str_word_count($improve." ".$do_well);
  }

  $avg_words /= sizeof($feedback);
  $stmt->close();

  for ($i=0;$i<sizeof($feedback);$i++) {
    $stmt = build_query($db, "SELECT * FROM feedback_id WHERE id = ?", array($feedback[$i]->id));

    $stmt->store_result();
    $stmt->bind_result($id, $approval);
    $stmt->fetch();

    if ($approval == 1) $good++;
    else if ($approval == 0) $bad++;
    else if ($approval == 2) {
      $reported[$reported_num] = $feedback[$i];
      $reported_num++;
    }

    $feedback[$i]->setApp($approval);
    $stmt->close();
  }
?>
  <div class="row clean">
    <div class="col-md-1"></div>
    <div class="col-md-10">
      <h1 class="text-center">Statistics</h1>
      Total Feedback: <?php echo sizeof($feedback); ?><br>
      Total Positive: <?php echo $positive; ?><br>
      Total Negative: <?php echo $negative; ?><br>
      Total Neutral: <?php echo $neutral; ?><br>
      Avg Words per Feedback: <?php printf("%.2f", $avg_words); ?><br><br>

      Total Good: <?php echo $good; ?><br>
      Total Bad: <?php echo $bad; ?><br><br>

      <h3 class="text-center">Reported (<?php echo $reported_num; ?>)</h3>
      <div class="reported col-md-8 col-md-offset-2">
        <?php for ($i=sizeof($reported)-1;$i>=0;$i--) echo $reported[$i]->reported(); ?>
      </div>

    </div>
    <div class="col-md-1"></div>
  </div>
</body>
</html>
