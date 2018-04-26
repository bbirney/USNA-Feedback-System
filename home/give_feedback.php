<?php
  ###############################################################
  #              Security and Navbar Configuration              #
  ###############################################################
  $MODULE_DEF = array('name'       => 'Give Feedback',
                      'version'    => 1.0,
                      'display'    => '',
                      'tab'        => 'give_feedback',
                      'position'   => 1,
                      'student'    => true,
                      'instructor' => true,
                      'guest'      => false,
                      'access'     => array());
  ###############################################################


  $PAGE_TITLE = "Give Feedback";

  # Load in Configuration Parameters
  require_once("../etc/config.inc.php");

  # Load in template, if not already loaded
  require_once(LIBRARY_PATH.'template.php');

  # Load in The NavBar
  # Note: You too will have automated NavBar generation
  #       support in your future templates...
  require_once(WEB_PATH.'navbar.php');

  if (isset($_REQUEST['do_well']) && isset($_REQUEST['alpha'])&& isset($_REQUEST['improve'])) {
    if (!isset($_REQUEST['good_bad'])) $_REQUEST['good_bad'] = 2;
      $query_fields = array($_REQUEST['alpha'], $_REQUEST['do_well'], $_REQUEST['improve'], USER['user'], $_REQUEST['good_bad'], $_REQUEST['know']);

    $stmt = build_query($db, "INSERT INTO feedback (user, do_well, improve, giver, status, know) VALUES (?, ?, ?, ?, ?, ?)", $query_fields);

    $response = "<div class=\"col-md-4 col-md-offset-4 alert alert-success text-center\" role=\"alert\">
                  <strong>Feedback submitted to ".$_REQUEST['alpha']."!</strong>
                 </div>";

    $stmt = build_query($db, "SELECT LAST_INSERT_ID()", array());
    $stmt->bind_result($id);
    $stmt->fetch();
    $stmt->close();

    $stmt = build_query($db, "INSERT INTO feedback_id (id) VALUES (?)", array($id));
    $stmt->close();






    echo $response;
    die();
  }
?>
  <h1 class="text-center">Give Feedback</h1><br>
  <div class="container text-center">
    <form id="myform">
      <input type="text" class="form-control small" name="alpha" placeholder="mAlpha" autofocus required autocomplete="off"></input><br>
      <b>How well do you know this person?</b><br>
      <label class="feedback_option">1 <input type="radio" name="know" value="1" ></label>
      <label class="feedback_option"><input type="radio" name="know" value="2" ></label>
      <label class="feedback_option"><input type="radio" name="know" value="3" ></label>
      <label class="feedback_option"><input type="radio" name="know" value="4" ></label>
      <label class="feedback_option"><input type="radio" name="know" value="5"> 5</label><br><br>
      <textarea class="form-control" name="do_well" rows="5" placeholder="What does he/she do well?" required autocomplete="off"></textarea><br>
      <textarea class="form-control" name="improve" rows="5" placeholder="What could he/she improve?" required autocomplete="off"></textarea><br>
      <b>Overall, is your feedback positive or negative? (Optional)</b><br>
      <label class="feedback_option"><input type="radio" name="good_bad" value="1"> Positive </label>
      <label class="feedback_option"><input type="radio" name="good_bad" value="0"> Negative</label>
      <label class="feedback_option"><input type="radio" name="good_bad" value="2" checked> N/A</label><br>
      <button class="btn btn-default" type="submit">Submit</button>
    </form>
    <div id="output"></div>
  </div>
</body>
</html>

<script type="text/javascript">
  $("#myform").submit(function(e){
  $.ajax({
    data: $("#myform").serialize(),
    success: function(result) {
      $("#output").html(result);
    }
  });
  e.preventDefault();
  });
</script>
