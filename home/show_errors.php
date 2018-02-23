<?php

  ###############################################################
  #              Security and Navbar Configuration              #
  ###############################################################
  $MODULE_DEF = array('name'       => 'Error Log',
                      'version'    => 1.0,
                      'display'    => '',
                      'tab'        => '',
                      'position'   => 0,
                      'student'    => true,
                      'instructor' => true,
                      'guest'      => false,
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

  $db = connect_db(DATABASE_MYSQL['default']['host'], DATABASE_MYSQL['default']['user'],
                   DATABASE_MYSQL['default']['password'], DATABASE_MYSQL['default']['name']);

  $temp = retrieve_apikey($db, USER['user']);
  unset($db);
  $temp = $temp['api_key'];
?>

<head>
  <meta charset="UTF-8">
  <meta name="description" content="View error log">
  <meta name="keywords" content="cs, it, usna, it452, lab">
  <meta name="author" content="Ben Birney">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Error Log</title>
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
  <script type="text/javascript" src="../lib/scripts.js"></script>
</head>
<body onload="universalAjax(null, error_log, '../api/<?php echo $temp ?>/error', 'get', 'output');">
  <br>
  <div class="row">
    <h1 class="text-center">Customized Error Log</h1>
  </div>
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10" id="output"></div>
    <div class="col-md-1"></div>
  </div>
</body>
