<?php

  ###############################################################
  #              Security and Navbar Configuration              #
  ###############################################################
  $MODULE_DEF = array('name'       => 'Test-Part1',
                      'version'    => 1.0,
                      'display'    => '',
                      'tab'        => '',
                      'position'   => 1,
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

?>
<div class="container">
  <div class="jumbotron">
    <h4>This page should have pretty Bootstrap CSS</h4>
    <p>
      Does it?  View the source and make sure that all of the files
      are accessible.
    </p>
  </div>
  <div class="jumbotron">
    <pre><?php print_r(USER); ?></pre>
  </div>
</div>
