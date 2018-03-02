<?php

  ###############################################################
  #              Security and Navbar Configuration              #
  ###############################################################
  $MODULE_DEF = array('name'       => 'Test-Part3',
                      'version'    => 1.0,
                      'display'    => '',
                      'tab'        => '',
                      'position'   => 3,
                      'student'    => true,
                      'instructor' => true,
                      'guest'      => true,
                      'access'     => array());
  ###############################################################

  # Load in Configuration Parameters
  require_once("../etc/config.inc.php");

  # Load in template, if not already loaded
  require_once(LIBRARY_PATH.'template.php');

  # Load in the css
  require_once(WEB_PATH.'css.php');

  # Load in the NavBar
  require_once(WEB_PATH.'navbar.php');

?>
<div class="container">
  <div class="jumbotron">
    <h4>This page should have an <b>auto-generated</b> NavBar</h4>
    <p>
      Does it?
    </p>
  </div>
  <div class="jumbotron">
    <pre><?php print_r(USER); ?></pre>
  </div>
</div>
