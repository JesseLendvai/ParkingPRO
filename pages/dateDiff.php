<?php

  // set de tijdzone
  date_default_timezone_set("UTC");

  //calculate the time difference
  function dateDiff($time1, $time2, $precision = 6) {
    // If input not numeric then convert the texts into unix timestamps
    if (!is_int($time1)) {
      $time1 = strtotime($time1);
    }
    if (!is_int($time2)) {
      $time2 = strtotime($time2);
    }

    // If time1 > time2 then swap them
    if ($time1 > $time2) {
      $ttime = $time1;
      $time1 = $time2;
      $time2 = $ttime;
    }

    //Set date format and compare them
    $intervals = array('year','month','day','hour','minute','second');
    $diffs = array();

    // Loop all intervals
    foreach ($intervals as $interval) {
      // Create temporary time from time1 and interval
      $ttime = strtotime('+1 ' . $interval, $time1);
      // Set the values
      $add = 1;
      $looped = 0;
      //loop until time1 < interval
      while ($time2 >= $ttime) {
        //Create a new temp time from time1 and interval
        $add++;
        $ttime = strtotime("+" . $add . " " . $interval, $time1);
        $looped++;
      }

      $time1 = strtotime("+" . $looped . " " . $interval, $time1);
      $diffs[$interval] = $looped;
    }

    $count = 0;
    $times = array();
    //loop all of the diffs
    foreach ($diffs as $interval => $value) {
      // break if we need to have preciscion
      if ($count >= $precision) {

        break;

      }
      //Add values and intervals
      //if value > 0
      if ($value > 0) {
        // Add s if value is not 1
        if ($value != 1) {

          $interval .= "s";

        }
        //Add the value and intervals to the time array
        $times[] = $value . " " . $interval;

        $count++;
      }
    }

    //Return the string with the times
    return implode(", ", $times);
  }

?>
