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

  if (!isset(USER['user']) || USER['user'] == 'guest' || USER['user'] == 'no-one' || USER['user'] == '') {
    $user = '';
    $NAVBAR[] = array('url'=>'../home/welcome_page.php', 'type'=>'url', 'title'=>'Home', 'ltext'=>'Feedback v3.0');
    $NAVBAR[] = array('url'=>'../home/faq.php', 'type'=>'url', 'title'=>'FAQ', 'icon'=>'glyphicon-question-sign');
    $NAVBAR[] = array('type'=>'seperator');
    $NAVBAR[] = array('url'=>'?login=1', 'type'=>'url', 'title'=>'Login', 'icon'=>'glyphicon-log-in');
    $NAVBAR[] = array('url' =>'../home/contact_us.php', 'type'=>'url', 'title'=>'Contact Us!', 'rtext'=>'Contact Us');
  } else if (USER['user'] == 'm200516') {
    $NAVBAR[] = array('url'=>'../home/welcome_page.php', 'type'=>'url', 'title'=>'Home', 'ltext'=>'Feedback v3.0');
    $NAVBAR[] = array('url'=>'../home/faq.php', 'type'=>'url', 'title'=>'FAQ', 'icon'=>'glyphicon-question-sign');
    $NAVBAR[] = array('url' =>'../home/give_feedback.php', 'type'=>'url', 'title'=>'Give Feedback', 'icon'=>'glyphicon-comment');
    $NAVBAR[] = array('url' =>'../home/view.php', 'type'=>'url', 'title'=>'View Feedback', 'icon'=>'glyphicon-inbox');
    $NAVBAR[] = array('type'=>'dropdown', 'title'=>'Admin Spaces', 'icon'=>'glyphicon-cog',
    'options'=>array(
      array('url'=>'../admin/view_all.php', 'text'=>'View All Feedback', 'type'=>'url'),
      array('url'=>'../admin/stats.php', 'text'=>'Statistics', 'type'=>'url')
    ));
    $NAVBAR[] = array('type'=>'seperator');
    $NAVBAR[] = array('url'=>'../home/welcome_page.php?logoff=1','type'=>'url', 'title'=>'Logout', 'icon'=>'glyphicon-log-out');
    $NAVBAR[] = array('url' =>'../home/contact_us.php', 'type'=>'url', 'title'=>'Contact Us!', 'rtext'=>'Contact Us');
  } else {
    $NAVBAR[] = array('url'=>'../home/welcome_page.php', 'type'=>'url', 'title'=>'Home', 'ltext'=>'Feedback v3.0');
    $NAVBAR[] = array('url'=>'../home/faq.php', 'type'=>'url', 'title'=>'FAQ', 'icon'=>'glyphicon-question-sign');
    $NAVBAR[] = array('url' =>'../home/give_feedback.php', 'type'=>'url', 'title'=>'Give Feedback', 'icon'=>'glyphicon-comment');
    $NAVBAR[] = array('url' =>'../home/view.php', 'type'=>'url', 'title'=>'View Feedback', 'icon'=>'glyphicon-inbox');
    $NAVBAR[] = array('type'=>'seperator');
    $NAVBAR[] = array('url'=>'../home/welcome_page.php?logoff=1','type'=>'url', 'title'=>'Logout', 'icon'=>'glyphicon-log-out');
    $NAVBAR[] = array('url' =>'../home/contact_us.php', 'type'=>'url', 'title'=>'Contact Us!', 'rtext'=>'Contact Us');
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
