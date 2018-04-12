<?php

  #############################################################################
  # Load in template, if not already loaded
  #############################################################################
  if (defined('LIBRARY_PATH')) {
    require_once(LIBRARY_PATH.'template.php');
  } else {
    require_once('../lib/template.php');
  }

  #############################################################################
  # Set Default Page Title / Information
  #############################################################################
  if (!isset($PAGE_TITLE)) {
    $PAGE_TITLE = 'USNA';
    if (defined('PAGE_TITLE')) {
      $PAGE_TITLE = PAGE_TITLE;
    }
  }
  if (!isset($NAVBAR_TITLE)) {
    $NAVBAR_TITLE = '';
    if (defined('NAVBAR_TITLE')) {
      $NAVBAR_TITLE = NAVBAR_TITLE;
    }
  }
  if (!isset($NAVBAR_TITLE_URL)) {
    $NAVBAR_TITLE_URL = '#';
    if (defined('NAVBAR_TITLE_URL')) {
      $NAVBAR_TITLE_URL = NAVBAR_TITLE_URL;
    }
  }

  #############################################################################
  # Build the NavBar (NavBar version 3 format)
  #############################################################################
  $NAVBAR = array();

  #############################################################################
  # Build the user menu options (Do they need to login - always first option)
  #############################################################################
  $USER_OPTIONS = array();
  $user = USER['user'];

  #############################################################################
  # Modules based Menu Options (USER SECTION)
  #############################################################################
  // if (defined('NAVBAR_MODULES') && isset(NAVBAR_MODULES['user'])) {
  //   foreach(NAVBAR_MODULES['user'] as $pos => $rows) {
  //     foreach ($rows as $irow => $row) {
  //       $USER_OPTIONS[] = array('url'=>$row['file'], 'type'=>'url', 'title'=>$row['display'], 'text'=>$row['name']);
  //     }
  //   }
  // }


  if (!isset(USER['user']) || USER['user'] == 'guest' || USER['user'] == 'no-one' || USER['user'] == '') {
    $user = '';
    $NAVBAR[] = array('url'=>'?login=1', 'type'=>'url', 'title'=>'Login', 'icon'=>'glyphicon-log-in');
    $NAVBAR[] = array('type'=>'seperator');
    $NAVBAR[] = array('url' =>'../home/contact_us.php', 'type'=>'url', 'title'=>'Contact Us!', 'rtext'=>'Contact Us');
  } else {
    $NAVBAR[] = array('url'=>'?logoff=1','type'=>'url', 'title'=>'Logout', 'icon'=>'glyphicon-log-out');
    $NAVBAR[] = array('url' =>'../home/give_feedback.php', 'type'=>'url', 'title'=>'Give Feedback', 'icon'=>'glyphicon-comment');
    $NAVBAR[] = array('url' =>'../home/view.php', 'type'=>'url', 'title'=>'View Feedback', 'icon'=>'glyphicon-inbox');
    $NAVBAR[] = array('type'=>'seperator');
    $NAVBAR[] = array('url' =>'../home/contact_us.php', 'type'=>'url', 'title'=>'Contact Us!', 'rtext'=>'Contact Us');
  }


  #############################################################################
  # Modules based Menu Options (other sections)
  #############################################################################
  foreach(MODULE_NAV as $heading => $config) {
  if (defined('MODULE_NAV') && defined('NAVBAR_MODULES')) {
      if ($heading == 'seperator') {
        $NAVBAR[] = array('type'=>'seperator');
      } elseif ($heading != 'user' && isset(NAVBAR_MODULES[$heading])) {
        if (isset(NAVBAR_MODULES[$heading])) {
          $options = array();
          foreach(NAVBAR_MODULES[$heading] as $pos => $rows) {
            foreach ($rows as $irow => $row) {
              $options[] = array('url'=>$row['file'], 'type'=>'url', 'title'=>$row['display'], 'text'=>$row['name']);
            }
          }
        }
      }
    }
  }

  #############################################################################
  # Manual NavBar functions
  #############################################################################

  #############################################################################
  # Load in the appropriate CSS and Navbar Display libraries.
  #############################################################################
  require_once('css.php');
  require_once('navbar_builder.php');

?>
