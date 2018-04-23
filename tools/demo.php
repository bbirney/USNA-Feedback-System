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
                      'guest'      => true,
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
?>
<br><br>
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8 revealable">
      <canvas id="myCanvas" width="640" height="480">
        <p>Apparently your browser doesn't support this... oh well, go upgrade...</p>
      </canvas>
      <script type="text/javascript">
        var myCanvas = $('#myCanvas');
      </script>
    </div>
  </div>

</body>
</html>
<script type="text/javascript">
  myCanvas.drawPolygon({
    strokeStyle: 'black',
    strokeWidth: 4,
    x: 200, y: 100,
    radius: 50,
    sides: 3
  });
</script>
