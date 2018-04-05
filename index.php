<?php 
// From date to Date get exclude week ends and holidays 

 /*You take your start date and calculate the rest time on this day (if it is a business day)
 You take your end date and calculate the time on this day and
 take the days in between and multiply them with your business hours (just those,   that are business days)
 Day start is 08:30 and day end is 17:30 so 9 hour working days and Holidays */
function working_hours($start, $end)
{
    $startDate = new DateTime($start);
    $endDate = new DateTime($end);
    $periodInterval = new DateInterval( "PT1H" );
	$period = new DatePeriod( $startDate, $periodInterval, $endDate );
    $count = 0;
    foreach($period as $date)
	{
      $startofday = clone $date;
      $startofday->setTime(8,30);
      $endofday = clone $date;
      $endofday->setTime(17,30);
      if($date > $startofday && $date <= $endofday && !in_array($date->format('l'), array('Sunday','Saturday')))
	  {
        $count++;
      }

      // Excluded Holidays
      $holidays = array('2017-11-14','2017-11-15'); 
      if($date > $startofday && $date <= $endofday && in_array($date->format('Y-m-d'), $holidays))
	  {
        $count--;
      }     
	  $wrk[] = $date->format('Y-m-d');  
	}
		
	//Get seconds of Start time
	$start_d = date("Y-m-d H:00:00", strtotime($start));
	$start_d_seconds = strtotime($start_d);
	$start_t_seconds = strtotime($start);
	$start_seconds = $start_t_seconds - $start_d_seconds;
							
	//Get seconds of End time
	$end_d = date("Y-m-d H:00:00", strtotime($end));
	$end_d_seconds = strtotime($end_d);
	$end_t_seconds = strtotime($end);
	$end_seconds = $end_t_seconds - $end_d_seconds;
									
	$diff = $end_seconds-$start_seconds;
 
	if($diff!=0):
		$count--;
	endif;  
	$total_min_sec = date('i:s',$diff);
	return $count .":".$total_min_sec;
	// return $date->format('Y-m-d'); 
}

$start = '2017-11-10 08:30:00';
$end = '2017-11-16 17:45:00';

$go = working_hours($start,$end);
echo 'Work Hours :'.$go.'<bR>';  

?> 