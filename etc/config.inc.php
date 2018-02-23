<?php

  ################################################################
  # Define the high level directories for this project
  ################################################################

  # Set the location to where the PHP library files are located
  define('LIBRARY_PATH', '../lib/');

  # Location of the web and CSS files
  define('WEB_PATH', '../web/');

  ################################################################
  # Define the High Level definitions for this project
  ################################################################
  define('PAGE_TITLE',       'Building a Framework');
  define('NAVBAR_TITLE',     '');
  define('NAVBAR_TITLE_URL', '#');

  ################################################################
  # Standard (and Safe) Configuration Section                    #
  ################################################################

  # Academy Authentication Configuration
  define('AUTH_SERVER',     'https://intranet.usna.edu/CS/AUTH/');
  define('AUTH_MESSAGE',    'Log on (pls)');
  define('AUTH_TITLE',      'Building a Framework');
  define('AUTH_IDENTIFIER', '7d6b9398-776f-4a76-8992-48830cfcf227');
  define('AUTH_SECRET',     '2d654eca-d651-492b-b0d2-66ffd4a5b582');
  define('AUTH_TOKEN_TIME', 100);
  define('AUTH_LIBRARY',    LIBRARY_PATH.'lib_auth_usna.php');

  # When should a user be forced to log in again.
  define('AUTH_MAX_TIME_SINCE_LAST_LOGIN', '7 DAY');
  define('AUTH_MAX_TIME_IDLE_SESSION',     '4 DAY');

  # Allow the Administrator to become other users
  # Comment this out to block.
  define('AUTH_BECOME_LIBRARY', LIBRARY_PATH.'lib_auth_developer.php');

  # Database Configuration, default yields the primary database,
  # and holds the Authentication Database
  # Additional Databases can be added.
  # NOTE: Recommend creating a 'low' level account, if using
  # API queries or similar functions.
  define('DATABASE_MYSQL',
          array('default'=>array('host'=>'midn.cs.usna.edu',
                                 'user'=>'m200516',
                                 'password'=>'now',
                                 'name'=>'m200516_IT452')));

  ################################################################
  # DANGER # DANGER # DANGER # DANGER # DANGER # DANGER # DANGER #
  ################################################################
  # Development System information (Development Server)          #
  # Only Define these if you want logon-less Development         #
  # on a private test web server.  Authentication                #
  # will not be enforced if running on a development machine.    #
  # For this to work the DB_HOST must be listed as something     #
  # like localhost or 127.0.0.1 so it works with both            #
  # production and development environments                      #
  ################################################################
  define('DEVELOPER_HOSTNAME', array('t5810','mich331csd00u'));
  define('AUTH_DEV_LIBRARY', LIBRARY_PATH.'lib_auth_developer.php');

?>
