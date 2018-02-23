<?php

  // This function reads in a CSV, Comma Separated file, and returns a
  // 2D array indexed like, $table[ROW_ID][COLUMN_ID] = CELL_VALUE
  // Inputs:
  //   $filename = 'test.csv' // specific file
  //   $withHeaders = True    // Is their a header row
  //   $withLeftID = True     // Can a row be determined by the leftmost column
  //   $withDelimiter = ','   // What is the default delimiter
  function read_csv($filename, $withHeaders=True, $withLeftID=True, $withDelimiter=',') {
    $table = array();
    if ($fp = fopen($filename, 'r')) {
      $counter = 0;
      while($row = fgetcsv($fp, 0, $withDelimiter)) {
        if (!isset($headers) && !$withHeaders) {
          $headers = array_keys($row);
        }
        if (!isset($headers)) {
          $headers = array();
          foreach ($row as $header) {
            $headers[] = trim($header);
          }
        } else {
          foreach ($row as $i => $value) {
            if ($withLeftID) {
              $table[$row[0]][$headers[$i]] = trim($value);
            } else {
              $table[$counter][$headers[$i]] = trim($value);
            }
          }
        }
        $counter++;
      }
    }
    return $table;
  }

  // This function writes a CSV, Comma Separated file,
  // and returns a Boolean that refers to the success of the write.
  // Inputs:
  //   $filename = 'test.csv' // specific file
  //   $data = {}             // data in the format as received by read_csv
  //                          // $table[ROW_ID][COLUMN_ID] = CELL_VALUE
  //   $withHeaders = True    // Is their a header row
  //   $withLeftID = True     // Can a row be determined by the leftmost column
  //   $leftID = ''           // What is the identifier of the leftmost column
  //   $withDelimiter = ','   // What is the default delimiter
  function write_csv($filename, $data, $withDelimiter = ',', $headers = true, $withLeftID=false) {
    $i = 0;
    if($fp = fopen($filename, 'w')) {
      if ($headers) {
        fwrite($fp, implode($withDelimiter." ",array_keys($data))."\n");
      }
      if ($withLeftID) {
        foreach ($data as $row) {
            fwrite($fp, $i.$withDelimiter." ".implode($withDelimiter." ",$row)."\n");
            $i++;
        }
      } else {
        foreach ($data as $row) {
            fwrite($fp, implode($withDelimiter." ",$row)."\n");
        }
      }
      fclose($fp);
      return true;
    }
    return false;
  }

 ?>
