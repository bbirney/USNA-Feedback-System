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

  $api_data = retrieve_apikey($db, USER['user']);

  if (isset($_REQUEST['feedback']) && isset($_REQUEST['alpha'])) {
    $query_fields = array($_REQUEST['alpha'], $_REQUEST['feedback'], USER['user']);

    // $stmt = build_query($db, "INSERT INTO feedback (user, feedback, giver) VALUES (?, ?, ?)", $query_fields);
    // $stmt->execute();

    $response = "<div class=\"col-md-4 col-md-offset-4 alert alert-success text-center\" role=\"alert\">
                  <strong>Feedback submitted to ".$_REQUEST['alpha']."!</strong>
                 </div>";

    echo $response;
    die();
  }
?>
<br>
  <div class="container text-center">
    <form id="myform">
      <input type="text" class="form-control small" name="alpha" placeholder="mAlpha" autofocus required></input><br>
      <textarea class="form-control" name="feedback" rows="5" placeholder="Feedback!" required></textarea><br>
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
