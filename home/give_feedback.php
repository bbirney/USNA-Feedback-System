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

  # Load in Configuration Parameters
  require_once("../etc/config.inc.php");

  # Load in template, if not already loaded
  require_once(LIBRARY_PATH.'template.php');

  # Load in The NavBar
  # Note: You too will have automated NavBar generation
  #       support in your future templates...
  require_once(WEB_PATH.'navbar.php');

  $api_data = retrieve_apikey($db, USER['user']);
?>
<br>
  <div class="container text-center">
    <form id="myform">
      <input type="text" class="form-control small" name="alpha" placeholder="mAlpha"></input><br>
      <textarea class="form-control" name="feedback" rows="5" placeholder="Feedback!"></textarea><br>
      <button class="btn btn-default" type="submit">Submit</button>
    </form>
    <div id="output"></div>
  </div>
</body>
</html>

<script type="text/javascript">
  $("#myform").submit(function(e){
    var formData = new FormData($(this)[0]);
    $.ajax({
      url: '../api/<?php echo $api_data['apikey']; ?>/give',
      type: 'post',
      data: formData,
      async: false,
      cache: false,
      processData: false,
      success: function(result) {
        $("#output").html(result);
      }
    });
    e.preventDefault();
    return false;
  });
</script>
