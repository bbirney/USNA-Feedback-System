<?php
  ###############################################################
  #              Security and Navbar Configuration              #
  ###############################################################
  $MODULE_DEF = array('name'       => 'Welcome Page',
                      'version'    => 1.0,
                      'display'    => '0',
                      'tab'        => '',
                      'position'   => 0,
                      'student'    => true,
                      'instructor' => true,
                      'guest'      => true,
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
?>
  <div class="row">
    <h1 class="text-center">Feedback System</h1>
    <div class="col-md-3"></div>
    <div class="col-md-6 jumbotron j-title">
        Welcome to Ben Birney's USNA Feedback System! I thought new
        feedback system where real comments can be used instead of a rank and
        single-word comment. Please log in to use the feedback system. If you
        have any questions, comments, concerns, or complains please contact me
        via the link in the top right!
    </div>
  </div>
  <?php
  // echo "<pre>";
  // print_r($NAVBAR);
  // echo "</pre>";
  ?>
</body>
</html>
