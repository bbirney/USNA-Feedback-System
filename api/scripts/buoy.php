<?php
  if(!isset($API_PATH)) { echo "Specify Station ID"; die(); }
  if(!isset($_GET['startdate']) || !isset($_GET['enddate'])) { echo "Choose a start and end date"; die(); }

  require_once("../library/lib_csv.php");
  $temp = read_csv("../data/buoy_data.txt", false, false, "\n");
  $i = 0;
  $output = array();

  $headers = explode(" ", str_replace("  ", " ", str_replace("  ", " ", $temp[0][0])));
  // $units = explode(" ", str_replace("  ", " ", $temp[1][0]));

  foreach ($temp as $row) {
    if ($i > 1) {
      $data[$i-2] = array_combine($headers, explode(" ", str_replace("  ", " ", str_replace("  ", " ", $row[0]))));
    }
    $i++;
  }


  if($API_PATH[0] == "TPLM2") {
    for($i=1,$j=0; $i < sizeof($data); $i++) {
      $date = $data[$i]['#YY']."-".$data[$i]['MM']."-".$data[$i]['DD'];
      //echo $date." vs. ".$_GET['startdate']." and ".$_GET['enddate']."<br>";
      if ($date >= $_GET['startdate'] && $date <= $_GET['enddate']) {
        $output[$j] = $data[$i];
        $j++;
      }
    }

    // echo "<pre>";
    // print_r($output);
    // echo "</pre>";

    echo json_encode($output);
  } else {
    echo "Invalid Buoy Specified";
    die();
  }
?>
