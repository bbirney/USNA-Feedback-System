<?php
  ###############################################################
  #              Security and Navbar Configuration              #
  ###############################################################
  $MODULE_DEF = array('name'       => 'Give Feedback',
                      'version'    => 1.0,
                      'display'    => '',
                      'tab'        => 'give_feedback',
                      'position'   => 99,
                      'student'    => true,
                      'instructor' => true,
                      'guest'      => true,
                      'access'     => array());
  ###############################################################

  $PAGE_TITLE = "Feedback for Feedback";

  # Load in Configuration Parameters
  require_once("../etc/config.inc.php");

  # Load in template, if not already loaded
  require_once(LIBRARY_PATH.'template.php');

  # Load in The NavBar
  # Note: You too will have automated NavBar generation
  #       support in your future templates...
  require_once(WEB_PATH.'navbar.php');

  if(isset($_REQUEST['name'])){
    $mailHeaders = "From: " . $_REQUEST['email'] . "\r\n";
    mail("m200516@usna.edu",$_REQUEST['name'],$_REQUEST['feedback'],$mailHeaders);
    unset($_REQUEST);
  }
?>

  <div class="row text-center">
    <div class="col-md-4"></div>
    <div class="col-md-4">
      <br><br><br>
      <div class="jumbotron text-center">
        <h2>We want to hear from you!</h2>
        <h4>Fill out the form below with questions, comments, concerns and<br> we will get back to you ASAP.</h4><br>
        <form id="myform">
          <div class="form-group">
            <input type="text" name="name" class="form-control" style="max-width:50%;margin-left:auto;margin-right:auto;" placeholder="Name">
            <br><input type="email" name="email" class="form-control" style="max-width:50%;margin-left:auto;margin-right:auto;" placeholder="Email">
            <br><textarea class="form-control" name="feedback" style="max-width:50%;margin-left:auto;margin-right:auto;" rows="4"placeholder="Questions, Comments, Concerns"></textarea>
            <br><button type="submit" class="btn btn-default">Submit Feedback</button>
          </div>
        </form>
    </div>
    </div>
  </div>
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
</body>
</html>
