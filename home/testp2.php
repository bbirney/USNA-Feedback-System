<?php

  ###############################################################
  #              Security and Navbar Configuration              #
  ###############################################################
  $MODULE_DEF = array('name'       => 'Test-Part2',
                      'version'    => 1.0,
                      'display'    => '',
                      'tab'        => '',
                      'position'   => 2,
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

  $test = 'a:5:{i:0;a:6:{s:4:"type";s:8:"dropdown";s:5:"title";s:10:"User Tools";s:4:"icon";s:14:"glyphicon-user";s:5:"rtext";s:7:" kenney";s:7:"options";a:7:{i:0;a:4:{s:3:"url";s:15:"../api/view.php";s:4:"type";s:3:"url";s:5:"title";s:0:"";s:4:"text";s:20:"View / Reset API Key";}i:1;a:4:{s:3:"url";s:15:"../api/docs.php";s:4:"type";s:3:"url";s:5:"title";s:0:"";s:4:"text";s:17:"API Documentation";}i:2;a:4:{s:3:"url";s:25:"../tools/admin-become.php";s:4:"type";s:3:"url";s:5:"title";s:13:"Query Builder";s:4:"text";s:11:"Switch User";}i:3;a:1:{s:4:"type";s:9:"seperator";}i:4;a:4:{s:3:"url";s:9:"?debug=on";s:4:"type";s:3:"url";s:5:"title";s:0:"";s:4:"text";s:17:"Turn Debugging On";}i:5;a:1:{s:4:"type";s:9:"seperator";}i:6;a:4:{s:3:"url";s:9:"?logoff=1";s:4:"type";s:3:"url";s:5:"title";s:0:"";s:4:"text";s:7:"Log Off";}}s:5:"caret";b:1;}i:1;a:6:{s:4:"type";s:8:"dropdown";s:5:"title";s:8:"Database";s:4:"icon";s:14:"glyphicon-list";s:5:"rtext";s:12:" Query Tools";s:5:"caret";b:1;s:7:"options";a:2:{i:0;a:4:{s:3:"url";s:24:"../tools/query-mysql.php";s:4:"type";s:3:"url";s:5:"title";s:13:"Query Builder";s:4:"text";s:19:"MySQL Query Builder";}i:1;a:4:{s:3:"url";s:25:"../tools/query-oracle.php";s:4:"type";s:3:"url";s:5:"title";s:19:"Query MIDS Database";s:4:"text";s:27:"Oracle (MIDS) Query Builder";}}}i:2;a:1:{s:4:"type";s:9:"seperator";}i:3;a:5:{s:4:"type";s:3:"url";s:3:"url";s:16:"../home/home.php";s:5:"title";s:10:"is a title";s:5:"ltext";s:6:"Click ";s:4:"icon";s:12:"glyphicon-th";}i:4;a:6:{s:4:"type";s:8:"dropdown";s:5:"caret";b:1;s:5:"title";s:5:"drop1";s:4:"icon";s:13:"glyphicon-cog";s:5:"rtext";s:5:" Test";s:7:"options";a:5:{i:0;a:4:{s:3:"url";s:19:"../events/event.php";s:4:"type";s:3:"url";s:5:"title";s:0:"";s:4:"text";s:17:"Add Item to Watch";}i:1;a:4:{s:3:"url";s:1:"#";s:4:"type";s:3:"url";s:5:"title";s:0:"";s:4:"text";s:12:"Manage Nodes";}i:2;a:4:{s:3:"url";s:1:"#";s:4:"type";s:3:"url";s:5:"title";s:0:"";s:4:"text";s:12:"Manage Users";}i:3;a:1:{s:4:"type";s:9:"seperator";}i:4;a:4:{s:3:"url";s:18:"../hello/hello.php";s:4:"type";s:3:"url";s:5:"title";s:0:"";s:4:"text";s:5:"Hello";}}}}';

  $NAVBAR = unserialize($test);
  $NAVBAR_TITLE = 'Hi there';

  # Load in the navbar_builder
  require_once(WEB_PATH.'navbar_builder.php');

?>
<div class="container">
  <div class="jumbotron">
    <h4>This page should have a NavBar</h4>
    <p>
      Does it?
    </p>
  </div>
  <div class="jumbotron">
    <pre><?php print_r($NAVBAR); ?></pre>
  </div>
</div>
