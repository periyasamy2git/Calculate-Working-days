===== Exclud Weekends and Holidays ======
<?php
$start = new DateTime('2017-11-10');
$end = new DateTime('2017-11-16');
$oneday = new DateInterval("P1D");

$holidays = array('2017-11-14','2017-11-15');
$days = array(); 

/* Iterate from $start up to $end+1 day, one day in each iteration.
   We add one day to the $end date, because the DatePeriod only iterates up to,
   not including, the end date. */
foreach(new DatePeriod($start, $oneday, $end->add($oneday)) as $day) {
    $day_num = $day->format("N"); /* 'N' number days 1 (mon) to 7 (sun) */
    if($day_num < 6) { /* weekday */
          $days[$day->format("Y-m-d")] = $day->format("Y-m-d");
    } 
} 
// Delete Holidays
foreach($holidays as $leave)
{
  if(array_search($leave,$days)!== false)
  {
    unset($days[$leave]);
  }
}

echo '<pre>';
print_r($days);
echo 'Working Days : '.count($days).'<br><br>';


