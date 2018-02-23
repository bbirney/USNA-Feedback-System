<?php
  // Define configuration options below, although normally you would do this
  // in a separate configuration file outside of the academy-credentials repo.
  // You will need to modify the values below to test locally, pointing
  // to a server which has already been set up, and from which you have
  // generated a token identifier / secret pair, this should be done by
  // going to the server website and running server/token.php
  // define('AUTH_SERVER',     '../server/');
  // define('AUTH_MESSAGE',    'Please log into the Authentication Server');
  // define('AUTH_TITLE',      'Example Title');
  // define('AUTH_TOKEN_TIME', 100);
  // define('AUTH_IDENTIFIER', '7d6b9398-776f-4a76-8992-48830cfcf227');
  // define('AUTH_SECRET',     '2d654eca-d651-492b-b0d2-66ffd4a5b582');
  // Redirect to the login page (returning here if guest allowed,
  // or when returning from the remote authenticator).
  require_once('lib_auth_usna.php');
  // If a real login was performed then the users information would now be
  // available in the $USER_CREDENTIALS variable.  The
  // resulting values within $USER_CREDENTIALS should look like:
  // $USER_CREDENTIALS = array('user'          => 'm123456',
  //                           'fullname'      => 'MIDN John Paul Jones',
  //                           'first'         => 'John',
  //                           'last'          => 'Jones',
  //                           'department'    => 'Computer Science',
  //                           'time'          => 1234567890);
  // To assist with your debugging, this example script will display
  // the information that was returned for your review.
  echo "<pre>";
  print_r($USER_CREDENTIALS);
  echo "</pre>";
  // You will need to create some mechanism within your scripts that stores
  // the information regarding a successful log in, I suggest using sessions.
  // You will only want to run this library if the user is not currently
  // logged on.
?>
