<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

require APPPATH.'/libraries/NepaliCalendar.php';
if ( !function_exists('convertDate') ) {
	
	/**
	 * /
	 * @param  date $date Date in english format
	 * @return date       Date in Nepali format 
	 */
	function convertDate($date)
	{
		$calendar = new NepaliCalendar();
		//$date = date('Y-m-d');	
		$timestamp  = strtotime($date);        
		$year 		= date('Y', $timestamp);
		$month 		= date('m', $timestamp);
		$day 		= date('d', $timestamp);

		$nepdate = $calendar->eng_to_nep($year,$month,$day);
		
		$nepali_month = $nepdate['month'];
		$nepali_date  = $nepdate['date'];

		if (strlen($nepali_month) == 1) {
			$nepali_month = '0'.$nepali_month;
		} elseif (strlen($nepali_month) == 2) {
			$nepali_month;
		}

		if (strlen($nepali_date) == 1) {
			$nepali_date = '0'.$nepali_date;
		} elseif (strlen($nepali_date) == 2) {
			$nepali_date;
		}

		$finaldate = $nepdate['year'].'-'.$nepali_month.'-'.$nepali_date;
		// $finaldate = $nepdate['date'].' '.ucwords($nepdate['nmonth']).', '.$nepdate['year'];

		return $finaldate;
	}
}

//get current month
if( !function_exists('get_current_month')) {
	function get_current_month() {
		$current_date = convertDate(date('Y-m-d'));
		$exp = explode('-', $current_date);
		$month = $exp[1];
		return $month;
	}
}

if ( !function_exists('getNepaliMonthName') ) {
	
	
	function getNepaliMonthName($num)
	{
		if ($num == 1) {
			$month = 'Baishakh';

		} elseif ($num == 2) {
			$month = 'Jestha';

		} elseif ($num == 3) {
			$month = 'Aasad';

		} elseif ($num == 4) {
			$month = 'Shrawan';

		} elseif ($num == 5) {
			$month = 'Bhadra';

		} elseif ($num == 6) {
			$month = 'Aaswin';

		} elseif ($num == 7) {
			$month = 'Kartik';

		} elseif ($num == 8) {
			$month = 'Mangsir';

		} elseif ($num == 9) {
			$month = 'Paush';

		} elseif ($num == 10) {
			$month = 'Magh';

		} elseif ($num == 11) {
			$month = 'Falgun';

		} elseif ($num == 12) {
			$month = 'Chaitra';
		}

		return $month;
	}
}



if ( !function_exists('get_colors') ) {
	
	function get_colors()
	{
		$color	= array("#1E90FF", "#DC143C", "#F0FFFF", "#0000FF", "#8A2BE2", "#A52A2A", "#DEB887", "#5F9EA0", "#7FFF00", "#D2691E", "#FF7F50", "#6495ED", "#7FFFD4", "#00FFFF", "#008B8B", "#B8860B", "#A9A9A9", "#006400", "#BDB76B", "#8B008B", "#556B2F", "#FF8C00", "#9932CC", "#8B0000", "#E9967A", "#8FBC8F", "#483D8B", "#2F4F4F", "#9400D3", "#FF1493", "#CD5C5C", "#B22222", "#228B22", "#FF00FF", "#FFD700", "#00008B", "#FF69B4", "#4B0082");

		$color_json	= json_encode($color);

		return $color_json;
	}
}



// if ( !function_exists('convert_to_base64') ) {
	
// 	function convert_to_base64($path, $consignment_id)
// 	{
// 		$type = pathinfo($path, PATHINFO_EXTENSION);
// 		$filename = pathinfo($path, PATHINFO_BASENAME);
		
// 		$final_path = 'D:\wamp\wamp64\www\dri\assets\uploads\documents'.DIRECTORY_SEPARATOR.$consignment_id.DIRECTORY_SEPARATOR.$filename;
// 		$data = @file_get_contents($final_path);
// 		$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

// 		return $base64;
// 	}
// }



if ( !function_exists('moneyFormat') ) {
	function moneyFormat($num) 
	{
		$explrestunits = "" ;
	
			if(strrchr($num, ".")){
				$dec = strrchr($num, ".");
				$int = $num - $dec;
		
				if(strlen($int)>3) {
				
				$num = $num - $dec;
			$lastthree = substr($num, strlen($num)-3, strlen($num));
			$restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
			$restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
			$expunit = str_split($restunits, 2);
			for($i=0; $i<sizeof($expunit); $i++) {
				// creates each of the 2's group and adds a comma to the end
				if($i==0) {
					$explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
				} else {
					$explrestunits .= $expunit[$i].",";
				}
			}
			
			$thecash = $explrestunits.$lastthree.$dec;
				} else {
			$thecash = $num;
		}
			
			} else {
				if(strlen($num)>3) {
				$lastthree = substr($num, strlen($num)-3, strlen($num));
		
			$restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
			$restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
			$expunit = str_split($restunits, 2);
			for($i=0; $i<sizeof($expunit); $i++) {
				// creates each of the 2's group and adds a comma to the end
				if($i==0) {
					$explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
				} else {
					$explrestunits .= $expunit[$i].",";
				}
			}
		
			$thecash = $explrestunits.$lastthree;
				} else {
			$thecash = $num;
			}
	
			}
			
		return $thecash; // writes the final format where $currency is the currency symbol.
	}
}

if ( !function_exists('time_since') ) {

	function time_since($since) 
	{
		$chunks = array(
			array(60 * 60 * 24 * 365 , 'year'),
			array(60 * 60 * 24 * 30 , 'month'),
			array(60 * 60 * 24 * 7, 'week'),
			array(60 * 60 * 24 , 'day'),
			array(60 * 60 , 'hr'),
			array(60 , 'min'),
			array(1 , 'sec')
		);

		for ($i = 0, $j = count($chunks); $i < $j; $i++) {
			$seconds = $chunks[$i][0];
			$name = $chunks[$i][1];
			if (($count = floor($since / $seconds)) != 0) {
				break;
			}
		}

		$print = ($count == 1) ? '1 '.$name : "$count {$name}s";
		return $print;
	} 

}



if ( !function_exists('remaining_days') ) {

	function remaining_days($eventdate)
	{
		$date = date('Y-m-d');
		$date = strtotime($date);

		$datediff = $eventdate - $date;
		$status = floor($datediff / (60 * 60 * 24));

		if($status == 0){
			$message = "Today is the event day.";

		} elseif($status > 0) {
			$message = $status." day/s to go.";

		} else {
			$message = "Event finished";
		}

		return $message;
	}

}

if( !function_exists('pp')) {
	function pp($data) {
		echo '<pre>'.print_r($data, true).'</pre>';
		exit;
	}
}

if(!function_exists('current_fiscal_year')) {
	function current_fiscal_year() {
		$CI =& get_instance();
		$CI->db->where('is_current', 1);
		$year = $CI->db->get('fiscal_year');
		return $year->row_array();
	}
}

if(!function_exists('arrayRecursiveDiff')) {
	function arrayRecursiveDiff($aArray1, $aArray2) { 
        $aReturn = array();
        foreach ($aArray1 as $mKey => $mValue) { 
            if (array_key_exists($mKey, $aArray2)) { 
                if (is_array($mValue)) { 
                    $aRecursiveDiff = arrayRecursiveDiff($mValue, $aArray2[$mKey]); 
                    if (count($aRecursiveDiff)) { $aReturn[$mKey] = $aRecursiveDiff; } 
                } else { 
                    if ($mValue != $aArray2[$mKey]) { 
                        $aReturn[$mKey] = $mValue; 
                    } 
                } 
            } else { 
                $aReturn[$mKey] = $mValue; 
            } 
        } 

        return $aReturn; 
    }
}