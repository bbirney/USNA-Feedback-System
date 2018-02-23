<?php

  ###############################################################
  #              Security and Navbar Configuration              #
  ###############################################################
  $MODULE_DEF = array('name'       => 'Default Home Page',
                      'version'    => 1.0,
                      'display'    => '',
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

  # Load in Template information
  # Note I have automated navbar generation support in my templates,
  # you should have this soon...
  //require_once(WEB_PATH.'navbar.php');

?>
<head>
  <link href="../web/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="../web/bootstrap/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
  <link type="text/css" rel="stylesheet" href="../web/default.css">
</head>
<div class=container>
  <br>
  <div class="row">
    <div class="col-md-2">
      <br><br>
      <center><img src="https://www.usna.edu/Users/cs/needham/ProjectPosters/CS-Logo-final-large.jpg" width=140></center>
    </div>
    <div class="col-md-8">
      <div class='jumbotron'>
        <h4>Welcome to the Default Template</h4>
        <font face='Arial' size=3>
          This template is available as a simple starting point for web
          based projects, providing database, API access, and web functionality.
        </font>
        <?php
        if (USER['user'] == 'guest' || USER['user'] == 'no-one' || USER['user'] == '') {
          echo "<br><br>";
          echo "Please use the menus above to logon to the system. <b>Note:</b>";
        } elseif (STUDENT) {
          echo "<br><br>";
          echo "Welcome Student";
        } elseif (INSTRUCTOR) {
          echo "<br><br>";
          echo "Welcome Faculty";
        }
        if (ADMIN) {
          echo "<br><br>";
          echo "Welcome Administrator";
        }
        ?>
      </div>
    </div>
    <div class="col-md-2">
      <br>
      <center><img src="http://www.freelogovectors.net/wp-content/uploads/2014/01/USNA_Logo_United_States_Naval_Academy-716x1024.jpg" width=140></center>
    </div>
  </div>
</div>
