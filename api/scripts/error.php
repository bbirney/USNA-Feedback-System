<?php

  # Location of Error Log
  $apache = '/var/log/apache2/error.log';

  # Read the end of a file
  # https://stackoverflow.com/questions/2961618/how-to-read-only-5-last-line-of-the-text-file-in-php
  function read_end($filename, $maxlines=1000) {
    $lines=array();
    $fp = fopen($filename, "r");
    while(!feof($fp))
    {
      $line = fgets($fp, 4096);
      array_push($lines, $line);
      if (count($lines)>$maxlines) {
        array_shift($lines);
      }
    }
    fclose($fp);
    return array_reverse($lines);
    return $lines;
  }

  # results
  $by_student = array();
  $student_order = array();
  $mids = array();

  if (!empty($API_PATH)) {
    $mids[] = $API_PATH[0];
  }

  $maxlines = 1000;
  if (count($API_PATH) == 2) {
    $maxlines = intval($API_PATH[1]);
  }

  # Read the file
  $el = read_end($apache, $maxlines);

  # Walk through the results from the file
  foreach ($el as $key => $line) {
    if (strpos($line, '/home/mids/') !== False) {
      $alpha = explode('/', explode('/home/mids/', $line)[1])[0];
      preg_match_all('/(\[[^\]]*\]*)/', $line, $sections);
      preg_match('/client\s[0-9]*.[0-9]*.[0-9]*.[0-9]*/', $line, $client);
      preg_match('/\sPHP.*/', $line, $phperr);
      if (isset($sections[0]) && count($sections[0]) > 0) {
        $dtg = explode('.', substr($sections[0][0], 5,-1))[0];
        $client = explode(' ',$client[0])[1];
        if(!isset($student_order[$alpha])) {
          $student_order[$alpha] = $dtg;
        }
        if (count($phperr) > 0) {
          $php_error_type = trim(explode(': ', $phperr[0])[0]);
          $php_error_mesg = explode(' in ', $phperr[0])[0];
          $php_error_mesg = substr($php_error_mesg, strpos($php_error_mesg, ':')+3);
          $php_error_file = explode(' ', explode(' in ', $phperr[0])[1])[0];
          $php_error_line = trim(explode(',', explode(' on line ', $phperr[0])[1])[0]);
          $output = array('time'=>$dtg,
                          'client'=>$client,
                          'type'=>$php_error_type,
                          'error'=>$php_error_mesg,
                          'file'=>$php_error_file,
                          'line'=>$php_error_line);
          if (empty($mids) || in_array($alpha, $mids)) {
            $by_student[$alpha][] = $output;
          }
        } else {
          $access_error = '';
          if (strpos($line, ' (13)Permission denied: ') !== False) {
            $access_error = 'AH'.trim(explode('] AH', $line)[1]);
          } elseif (strpos($line, ' client denied by server configuration: ') !== False) {
            $access_error = 'AH'.trim(explode('] AH', $line)[1]);
          }
          $output = array('time'=>$dtg,
                          'client'=>$client,
                          'access'=>$access_error);
          if (empty($mids) || in_array($alpha, $mids)) {
            $by_student[$alpha][] = $output;
          }
        }
      }
    }
  }

  echo json_encode($by_student);

?>
