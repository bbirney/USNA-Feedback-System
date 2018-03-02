<?php
  if (USER['user'] != "guest") {
    $NAVBAR = array(
      array(
        'type' => 'dropdown',
        'title' => 'logoff',
        'rtext' => USER['user'],
        'ltext' => ' ',
        'url' => ' ',
        'icon' => 'glyphicon-menu-hamburger',
        'caret' => 1,
        'options' => array(
          array(
            'type' => 'url',
            'url' => '../api/view.php',
            'title' => 'the keys',
            'text' => 'View API Key'
          ),
          array(
            'type' => 'url',
            'url' => '?logoff',
            'title' => 'logoff (dont\'t go!)',
            'text' => 'Log Off'
          )
        )
      )
    );
  }

  require_once("../web/navbar_builder.php");
?>
