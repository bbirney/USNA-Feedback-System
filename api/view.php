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
                      'guest'      => false,
                      'access'     => array());
  ###############################################################

  # Load in Configuration Parameters
  require_once("../etc/config.inc.php");

  # Load in template, if not already loaded
  require_once('../lib/template.php');


  $results = retrieve_apikey($db, USER['user']);
  echo USER['user']."'s API key is <b>".$results['api_key']."</b>";
?>
