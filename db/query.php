<?php

  ###############################################################
  #              Security and Navbar Configuration              #
  ###############################################################
  $MODULE_DEF = array('name'       => 'Make-A-Query',
                      'version'    => 1.0,
                      'display'    => '',
                      'tab'        => 'Tools',
                      'position'   => 0,
                      'student'    => true,
                      'instructor' => true,
                      'guest'      => true,
                      'access'     => array(/*'admin', 'db' */));
  ###############################################################

  # Load in Configuration Parameters
  require_once("../etc/config.inc.php");

  # Load in template, if not already loaded
  require_once(LIBRARY_PATH.'template.php');
?>
<script>
  $("#form").submit(function(e){
    $.ajax({
      url: "api/<?php echo retrieve_apikey($db, USER['user'])['apikey'] ?>/query",
      data: $("#form").serialize(),
      success: function(result) {
        $("#output").html(result);
      }
    });
    e.preventDefault();
  });
</script>
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
      <form method="post" id="form">
        <textarea class="form-control" rows="8" name="query"></textarea>
        <button type="submit" class="btn">Submit</button>
      </form>
    </div>
    <div class="col-md-2"></div>
  </div>
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8" id="output"></div>
    <div class="col-md-2"></div>
  </div>
</body>
</html>
