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
  define('PAGE_TITLE',       'Template');
  define('NAVBAR_TITLE',     '');
  define('NAVBAR_TITLE_URL', '#');

  ################################################################
  # Standard (and Safe) Configuration Section                    #
  ################################################################

  # Academy Authentication Configuration
  define('AUTH_SERVER',     'https://intranet.usna.edu/CS/AUTH/');
  define('AUTH_MESSAGE',    'Please log on');
  define('AUTH_TITLE',      'Template');
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
  # Dynamic Navbar Building                                      #
  ################################################################

  # What is the order that modules should appear, and what
  # navbar options are available.
  define('MODULE_NAV',
        array('api'      =>array('type'=>'dropdown', 'title'=>'Application Interface', 'icon'=>'glyphicon-globe',       'rtext'=>" API",            'caret'=>true),
              'review'   =>array('type'=>'dropdown', 'title'=>'Review',                'icon'=>'glyphicon-th-large',    'rtext'=>" Review",         'caret'=>true),
              'database' =>array('type'=>'dropdown', 'title'=>'Database',              'icon'=>'glyphicon-list',        'rtext'=>" Query Tools",    'caret'=>true),
              'tasks'    =>array('type'=>'dropdown', 'title'=>'Tasks',                 'icon'=>'glyphicon-cog',         'rtext'=>" Tasks",          'caret'=>true),
              'grades'   =>array('type'=>'dropdown', 'title'=>'Grades',                'icon'=>'glyphicon-signal',      'rtext'=>" Grades",         'caret'=>true),
              'tools'    =>array('type'=>'dropdown', 'title'=>'System Tools',          'icon'=>'glyphicon-wrench',      'rtext'=>" Tools",          'caret'=>true),
              'admin'    =>array('type'=>'dropdown', 'title'=>'Administrative Tools',  'icon'=>'glyphicon-floppy-open', 'rtext'=>" Administration", 'caret'=>true),
              'debug'    =>array('type'=>'dropdown', 'title'=>'Project Debugging',     'icon'=>'glyphicon-send',        'rtext'=>" Debugging",      'caret'=>true),
              'matchups' =>array('type'=>'dropdown', 'title'=>'Matchups',              'icon'=>'glyphicon-apple',       'rtext'=>" Matchups",       'caret'=>true)
            ));

  # What directories should we search through for NavBar modules?
  define('MODULE_DIRS',
    array('../review',
          '../student',
          '../api',
          '../tools',
          '../db',
          '../home'));

  # Manually Specify Certain Files to be processed:
  define('MODULE_FILES',
    array('../review/test.php',
         '../api/docs.php'));

  # What Files should not be processed?
  define('MODULE_IGNORE',
    array('api.php','home.php'));

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
