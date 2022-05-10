<?php

function getDefault()
{
    $ci = &get_instance();
    $ward = $ci->session->userdata('ward_no');
    $default = array();
    $default[0] = 3;
    $default[1] = 'चितवन';
    $default[2] = 'इच्छाकामना गाउँपालिका';
    $default[3] =   $ward;
    return $default;
}
function getonlyNumber($str)
{
    $array = preg_split('//u', $str, -1, PREG_SPLIT_NO_EMPTY);
    $number = '';
    foreach($array as $ltr)
    {
        switch($ltr)
        {
            case '१':
                $number .= '1';
                break;
            case '२':
                $number .= '2';
                break;
            case '३':
                $number .= '3';
                break;
            case '४':
                $number .= '4';
                break;
            case '५':
                $number .= '5';
                break;
            case '६':
                $number .= '6';
                break;
            case '७':
                $number .= '7';
                break;
            case '८':
                $number .= '8';
                break;
            case '९':
                $number .= '9';
                break;
            case '०':
                $number .= '0';
                break;
            case '1':
                $number .= '1';
                break;
            case '2':
                $number .= '2';
                break;
            case '3':
                $number .= '3';
                break;
            case '4':
                $number .= '4';
                break;
            case '5':
                $number .= '5';
                break;
            case '6':
                $number .= '6';
                break;
            case '7':
                $number .= '7';
                break;
            case '8':
                $number .= '8';
                break;
            case '9':
                $number .= '9';
                break;
            case '0':
                $number .= '0';
                break;
            default:
                break;
        }
    }
    return $number;
}
function calculateDays($start,$end)
{
    $start = strtotime("2010-01-31");
    $datediff = $end - $start;
    return round($datediff / (60 * 60 * 24));
}
$this->load->helper('string_helper');
$this->load->library('email');
$two_digit=array(0=>"",1=>"एक",2=>"दुइ",3=>"तीन",4=>"चार",5=>"पाच",6=>"छ",7=>"सात",8=>"आठ",9=>"नौ",10=>"दश",11=>"एघार",12=>"बाह्र",13=>"तेह्र",14=>"चौध",15=>"पन्ध्र" ,16=>"सोह्र",
    17=>"सत्र",18=>"अठार",19=>"उन्नाइस",20=>"बिस",21=>"एक्काइस", 22=>"बाइस", 23=>"तेईस", 24=>"चौविस", 25=>"पच्चिस", 26=>"छब्बिस", 27=>"सत्ताइस", 28=>"अठ्ठाईस", 29=>"उनन्तिस",
    30=>"तिस", 31=>"एकत्तिस", 32=>"बत्तिस", 33=>"तेत्तिस" ,34=>"चौँतिस", 35=>"पैँतिस", 36=>"छत्तिस", 37=>"सैँतीस", 38=>"अठतीस", 39=>"उनन्चालीस",
    40=>"चालीस", 41=>"एकचालीस", 42=>" बयालीस", 43=>"त्रियालीस", 44=>"चवालीस", 45=>"पैँतालीस", 46=>"छयालीस", 47=>"सच्चालीस", 48=>"अठचालीस", 49=>"उनन्चास",
    50=>"पचास", 51=>"एकाउन्न", 52=>"बाउन्न", 53=>"त्रिपन्न", 54=>"चउन्न", 55=>"पचपन्न", 56=>"छपन्न", 57=>"सन्ताउन्न", 58=>"अन्ठाउन्न", 59=>"उनन्साठी",
    60=>"साठी", 61=>"एकसट्ठी", 62=>"बयसट्ठी", 63=>"त्रिसट्ठी", 64=>"चौंसट्ठी", 65=>"पैंसट्ठी", 66=>"छयसट्ठी", 67=>"सतसट्ठी", 68=>"अठसट्ठी", 69=>"उनन्सत्तरी",
    70=>"सत्तरी", 71=>"एकहत्तर", 72=>"बहत्तर", 73=>"त्रिहत्तर", 74=>"चौहत्तर", 75=>"पचहत्तर", 76=>"छयहत्तर", 77=>"सतहत्तर", 78=>"अठहत्तर", 79=>"उनासी",
    80=>"असी", 81=>"एकासी", 82=>"बयासी", 83=>"त्रियासी", 84=>"चौरासी", 85=>"पचासी", 86=>"छयासी", 87=>"सतासी", 88=>"अठासी", 89=>"उनान्नब्बे",
    90=>"नब्बे", 91=>"एकान्नब्बे", 92=>"बयानब्बे", 93=>"त्रियान्नब्बे", 94=>"चौरान्नब्बे", 95=>"पन्चानब्बे", 96=>"छयान्नब्बे", 97=>"सन्तान्नब्बे", 98=>"अन्ठान्नब्बे", 99=>"उनान्सय");
$matra="मात्र |";
function createDateRange($startDate, $endDate, $format = "Y-m-d")
{
//    echo $startDate.'<br>';
//    echo $endDate; exit;
    $range = [];
    $a=0;
    if($endDate=="")
    {
        array_push($range, $startDate);
        $a=1;
    }
    elseif($startDate=="")
    {
        array_push($range, $endDate);
        $a=1;
    }
    if($a==0)
    {
        $begin = new DateTime($startDate);
        $end = new DateTime($endDate);
        $interval = new DateInterval('P1D'); // 1 Day
        $dateRange = new DatePeriod($begin, $interval, $end);

        foreach ($dateRange as $date) {
            $range[] = $date->format($format);
        }
    }
    return $range;
}
function alertBox($alert_msg, $redirect_link)
{
    $alert = '<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>';
    $alert .= '<script type="text/javascript">alert("'.$alert_msg.'");';
    if(!empty($redirect_link)):
        $alert .='window.location="'.$redirect_link.'";';
    endif;
    $alert .='</script>;';
    return $alert;
}

function backup_upload($file_name)
{
    global $database;
    // Temporary variable, used to store current query
    $templine = '';
    // Read in entire file
    $lines = file($file_name);
    // Loop through each line
    $i=0;
    // print_r($lines);exit;
    foreach ($lines as $line)
    {
        // Skip it if it's a comment
        if (substr($line, 0, 2) == '--' || $line == '')
            continue;

        // Add this line to the current segment
        $templine .= $line;
        //echo $templine; exit;
        // If it has a semicolon at the end, it's the end of the query
        if (substr(trim($line), -1, 1) == ';')
        {

            // Perform the query
            $database->query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysqli_error($database->connection) . '<br /><br />');
            // $database->query($templine);
            // Reset temp variable to empty
            $templine = '';
        }
    }
    return TRUE;
}
function twoDigit($num)
{
    global $two_digit;
    if(intval($num)==0)
    {
        return "";
    }
    else{
        $new = intval($num);

        return $two_digit[$new];
    }
}
function threeDigit($num)
{
    if(substr($num,0,1)==0)
    {
        $output = twoDigit(substr($num,1,2));
    }
    elseif(intval(substr($num,1,2)!=0))
    {
        $result = twoDigit(substr($num,0,1));
        $result2 = twoDigit(substr($num,1,2));
        $output = $result. " सय ". $result2;
    }
    elseif(intval(substr($num,1,2)==0))
    {
        $result = twoDigit(substr($num,0,1));
        $result2 = twoDigit(substr($num,1,2));
        $output = $result. " सय ". $result2;
    }
    return $output ;
}
function fiveDigit($num)
{
    if(intval(substr($num,0,2)==0))
    {
        $output= threeDigit(substr($num,2,3));
    }
    elseif(intval(substr($num,0,2)!=0))
    {
        $output=  twoDigit(substr($num,0,2))." हजार ".threeDigit(substr($num,2,3));
    }
    elseif((substr($num,0,5)==0))
    {
        $output="";
    }
    return $output ;
}
function sevenDigit($num)
{
    if(intval(substr($num,0,2)==0))
    {
        $output= fiveDigit(substr($num,2,5));
    }
    elseif(intval(substr($num,0,2)!=0))
    {
        $output=  twoDigit(substr($num,0,2))." लाख ".fiveDigit(substr($num,2,5));
    }
    elseif((substr($num,0,7)==0))
    {
        $output="";
    }
    return $output ;
}

function convert($post)
{
    $length= strlen($post);
    $num = $post;
    $output = twoDigit(substr($num,-2));

    if($length==3)
    {
        $output = threeDigit($num);
    }
    if($length==4)
    {

        $result = threeDigit(substr($num,1,3));
        $res = twoDigit(substr($num,0,1));
        $output = $res. " हजार ".$result;
    }
    if($length==5)
    {
        $result=twoDigit(substr($num,0,2));
        $res=threeDigit(substr($num,2,3));
        $output = $result. " हजार ".$res;
    }
    if($length==6)
    {
        $result=twoDigit(substr($num,0,1));
        $res= fiveDigit(substr($num,1,5));
        $output=$result." लाख ".$res;
    }
    if($length==7)
    {
        $result=twoDigit(substr($num,0,2));
        $res= fiveDigit(substr($num,2,5));
        $output=$result." लाख ".$res;
    }
    if($length==8)
    {
        $result=twoDigit(substr($num,0,1));
        $res= sevenDigit(substr($num,1,7));
        $output=$result." क्रोर ".$res;
    }
    if($length==9)
    {
        $result=twoDigit(substr($num,0,2));
        $res= sevenDigit(substr($num,2,7));
        $output=$result." क्रोर ".$res;

    }
    return $output;

}
function calcTotalLpltr($up, $ltr)
{
    return $ltr * ((100-$up)/100);

}
function getUpId($uptype)
{
    $up_info = UpInfo::find_by_up_type($uptype);
    return $up_info->id;
}
function getUserType()
{
    if(isset($_SESSION[KEYMODE]))
    {
        return $_SESSION[KEYMODE];
    }
    else
    {
        return false;
    }
}
function getUser()
{
    if(isset($_SESSION[KEYID]))
    {
        $user = User::find_by_id($_SESSION[KEYID]);
        return $user;
    }
    else
    {
        return false;
    }
}
function getQuestionGroup($user)
{
    $student = Students::find_by_id($user->student_id);

    $group_id = $student->group_id;

    $question_group = Qgroups::find_by_group_id_status($group_id);
    return $question_group;
}
function startTimer()
{
    $basename = basename($_SERVER['PHP_SELF']);
    if($basename==="entrance.php")
    {
        return true;
    }
    return false;
}

function getTickImageForRightChoice($data)
{
    $result_array = array();
    $option_array = array('opt1','opt2','opt3','opt4');
    foreach ($option_array as $option)
    {
        //$result_array[$option] = '';
        if($data->correct===$option)
        {
            $result_array[$option] = '<span><img src="images/right.png" width="40" height="40"></a></span>';
        }
        else
        {
            $result_array[$option] = '';
        }
    }
    return $result_array;
}
function setAnswerSession()
{
    $_SESSION['answers'] = array();
}

//function getStartEndMonth()
//{

//}
function updateIsCurrent()
{
    $fiscals = Fiscalyear::find_all();
    foreach($fiscals as $fiscal)
    {
        $fiscal->is_current = 0;
        $fiscal->save();
    }
}

function getVendorId()
{
    $user = User::find_by_id($_SESSION['auth_id']);
    return $user->vendor_id;
}
function getUserMode()
{
    $user = User::find_by_id($_SESSION['auth_id']);
    return $user->mode;
}

/*function createPrevStockPostData($post)
{
	$stock_array = array('prev_stock_L','prev_stock_Q','prev_stock_P','prev_stock_N','prev_stock_D');
	foreach ($stock_array as $stock) {

		if(!isset($post[$stock]))
		{
			$post[$stock] = 0;
		}
	}
	return $post;

}
*/
// for conversion of digit to characters
function generateCurrDate(){
    $nepdate = Modules::run('NepaliCalendar/eng_to_nep',date("Y", time()), date("m", time()), date("d", time()));
    $curr_date = $nepdate['year'].'-'.$nepdate['month'].'-'.$nepdate['date'];
    return $curr_date;
}
function DateNepToEng($nep_date)
{
    $nep_date = explode("-",$nep_date);
    $eng_date = Modules::run('NepaliCalendar/nep_to_eng',$nep_date[0],$nep_date[1],$nep_date[2]);
    if($eng_date['month'] < 10) {
        $month = '0'.$eng_date['month'];
    } else {
        $month = $eng_date['month'];
    }
    return $eng_date["year"]."-".$month."-".$eng_date["date"];

}
function getStartEndDates($fiscal_id,$month)
{
    $month_range = new Nepali_Calendar();
    $month_get = $month;
    $fiscal_get = Fiscalyear::find_by_id($fiscal_id);
    $fiscal_array = explode(".", $fiscal_get->year);



    if($month_get==1||$month_get==2||$month_get==3)
    {
        $start_date_nepali = "2".$fiscal_array[1]."-".$month_get."-"."01";
        $year_get = intval($fiscal_array[1]);

        $month_get_strip = intval($month_get);
        $end_day = $month_range->month_date_range[$year_get][$month_get_strip];
        //$end_day = $month_range->month_date_range[strip_zeros_from_month($fiscal_array[1])] ;

        $end_date_nepali = "2".$fiscal_array[1]."-".$month_get."-".$end_day;
        $sel_year = "2".$fiscal_array[1];
    }
    else
    {
        //DateNepToEng(
        $start_date_nepali = $fiscal_array[0]."-".$month_get."-"."01";
        $year_get = intval($fiscal_array[0]);
        $year_get = substr($year_get,2,2);
        $month_get_strip = intval($month_get);
        $end_day = $month_range->month_date_range[$year_get][$month_get_strip];
        //$end_day = $month_range->month_date_range[strip_zeros_from_month($fiscal_array[1])] ;

        $end_date_nepali = $fiscal_array[0]."-".$month_get."-".$end_day;
        $sel_year = $fiscal_array[0];
    }

    //echo $start_date_nepali." ".$end_date_nepali; exit;
    $start_date = DateNepToEng($start_date_nepali);
    $end_date  = DateNepToEng($end_date_nepali);
    $start_end_array = array($start_date,$end_date,$sel_year);
    return $start_end_array;
}
function DateEngToNep($eng_date)
{
//    $cal = new Nepali_Calendar();
    $eng_date = explode("-",$eng_date);

    $nep_date = Modules::run('NepaliCalendar/eng_to_nep',$eng_date[0],$eng_date[1],$eng_date[2]);
    return $nep_date["year"]."-".$nep_date["month"]."-".$nep_date["date"];

}
function placeholder($number)
{
    $result="";
    $data=explode('.',$number);
    $num=$data[0];
    $length=strlen($num);
    if($length==1)
    {
        $result=$num;
    }
    if($length==2)
    {
        $result=$num;
    }
    if($length==3)
    {
        $result=$num;
    }
    if($length==4)
    {
        $result.=substr($num,0,1);
        $result.=",";
        $result.=substr($num,1,3);

    }
    if($length==5)
    {
        $result.=substr($num,0,2);
        $result.=",";
        $result.=substr($num,2,3);

    }
    if($length==6)
    {
        $result.=substr($num,0,1);
        $result.=",";
        $result.=substr($num,1,2);
        $result.=",";
        $result.=substr($num,3,3);

    }
    if($length==7)
    {
        $result.=substr($num,0,2);
        $result.=",";
        $result.=substr($num,2,2);
        $result.=",";
        $result.=substr($num,4,3);
    }
    if($length==8)
    {
        $result.=substr($num,0,1);
        $result.=",";
        $result.=substr($num,1,2);
        $result.=",";
        $result.=substr($num,3,2);
        $result.=",";
        $result.=substr($num,5,3);
    }
    if($length==9)
    {
        $result.=substr($num,0,2);
        $result.=",";
        $result.=substr($num,2,2);
        $result.=",";
        $result.=substr($num,4,2);
        $result.=",";
        $result.=substr($num,6,3);

    }
    if($length==10)
    {
        $result.=substr($num,0,1);
        $result.=",";
        $result.=substr($num,1,2);
        $result.=",";
        $result.=substr($num,3,2);
        $result.=",";
        $result.=substr($num,5,2);
        $result.=",";
        $result.=substr($num,7,3);
    }
    if(isset($data[1]))
    {
        return $result.".".$data[1];
    }
    else
    {
        return $result;
    }
}
function total_letters(){
    $letter1 = Taxcert::count_all();
    $letter2 = Taxpersonal::count_all();
    $letter3 = Taxlabour::count_all();
    $letter4 = Taxrenewal::count_all();
    $total_letters = $letter1 + $letter2 + $letter3 +$letter4;
    return $total_letters;
}

function getMaxLetterNo($cert){
    if($cert==1)
    {
        $letter = Taxcert::count_all();
        $letter = $letter+1;

    }
    if($cert==2){ $letter = Taxlabour::count_all(); $letter=$letter+1; }
    if($cert==3){ $letter = Taxpersonal::count_all();  $letter=$letter+1; }
    if($cert==4){ $letter = Taxrenewal::count_all(); $letter=$letter+1; }
    if($cert==5){ $letter = Taxdisc::count_all(); $letter=$letter+1; }
    return $letter;
}
/* function max_letter_no(){
    $letter_no1 = Taxcert::find_max_letter_no();
    $letter_no2 = Taxpersonal::find_max_letter_no();
    $letter_no3 = Taxlabour::find_max_letter_no();
    $letter_no4 = Taxrenewal::find_max_letter_no();
    $letter_no5 = Taxdisc::find_max_letter_no();
    $letter_array = array($letter_no1,$letter_no2,$letter_no3,$letter_no4,$letter_no5);
    return max($letter_array);
}*/

function convert_date($date){

    $date = explode("-",$date);
    $final_date = '';
    $i=1;
    $count = count($date);
    foreach($date as $datestring)
    {
        if($i==$count){
            $final_date.= convertedNOs($datestring);
        }
        else{
            $final_date.= convertedNOs($datestring)."/";
        }
        $i++;
    }
    return $final_date;

}
function convertNos($nos)
{
    $n = '';
    switch($nos){
        case "०": $n = 0; break;
        case "१": $n = 1; break;
        case "२": $n= 2; break;
        case "३": $n = 3; break;
        case "४": $n = 4; break;
        case "५": $n = 5; break;
        case "६": $n = 6; break;
        case "७": $n = 7; break;
        case "८": $n = 8; break;
        case "९": $n = 9; break;
        case "0": $n = "०"; break;
        case "1": $n = "१"; break;
        case "2": $n = "२"; break;
        case "3": $n = "३"; break;
        case "4": $n = "४"; break;
        case "5": $n = "५"; break;
        case "6": $n = "६"; break;
        case "7": $n = "७"; break;
        case "8": $n = "८"; break;
        case "9": $n = "९"; break;
    }
    return $n;
}
function convertedcit($string)
{
    $string = str_split($string);
    $out = '';
    foreach($string as $str)
    {
        if(is_numeric($str))
        {
            $out .= convertNos($str);

        }
        else
        {
            $out .=$str;
        }
    }
    return $out;

}

function convertedNos($num)
{
    $str_num = preg_split('//u', ("". $num), -1); // not explode('', ("". $num))

    // For each item in your exploded string, retrieve the Nepali equivalent or vice versa.
    $out = '';
    $out_arr = array_map('convertNos', $str_num);
    $out = implode('', $out_arr);
    return $out;

}
function strip_zeros_from_date($marked_string)
{
    // first remove the marked zeros
    $no_zeros=str_replace('*0','',$marked_string);
    // then remove any remaining marks
    $cleaned_string=str_replace('*','',$no_zeros);
    return $cleaned_string;
}
function strip_zeros_from_month($marked_string)
{
    // first remove the marked zeros
    $new_string = '';
    $str_len = strlen($marked_string);
    for($i=0; $i<$str_len; $i++)
    {
        if($i==0 && $marked_string[$i]==0)
        {
            $marked_string[$i]='';
        }
        $new_string = $new_string.$marked_string[$i];
    }
    return $new_string;
}
function redirect_to($location=NULL)
{
    if ($location != NULL)
    {
        ?>
        <script>window.location="<?php echo $location; ?>";</script>
        <?php
    }
}
function set_sort()
{
    if(!isset($_SESSION['sort']))
    {
        $_SESSION['sort'] = 1;


    }
    if(isset($_GET['sort']))
    {
        if(isset($_GET['sort']) && $_SESSION['sort']==1 )
        {

            $_SESSION['sort'] = 2;
            $i=1;
        }
        if(isset($_GET['sort']) && $_SESSION['sort']==2 && $i!=1 )
        {

            $_SESSION['sort'] = 1;

        }
    }
    $i='';
}
function output_message($message="")
{
    if (!empty($message))
    {
        return"<p class=\"message\">{$message}</p>";
    }
    else
    {
        return "";
    }
}
/*function __autoload($class_name)
{
    $class_name = strtolower($class_name);
    $path = "../includes/{$class_name}.php";
    if (file_exists($path))
    {
        require_once($path);
    }
    else
    {
        die("The file {$class_name}.php could not be found.");
    }
}
*/
function log_action($action, $message="")
{
    $logfile = SITE_ROOT.DS.'logs'.DS.'log.txt';
    $new = file_exists($logfile) ? false: true ;
    if ($handle = fopen($logfile, 'a'))//append
    {
        $timestamp = strftime("%Y-%m-%d %H:%M:%S" , time());
        $content = "{$timestamp} | {$action} | {$message}\n";
        fwrite($handle, $content);
        fclose($handle);
        if ($new)
        {
            chmod($logfile, 0755);
        }
        else
        {
            return "could not open the log file for writing";
        }
    }
}
function check_numeric($num)
{
    $return = "";
    if(is_numeric($num))
    {
        return $num;
    }
    else
    {
        return $return;
    }
}
function datetime_to_text($datetime="")
{
    $unixdatetime = strtotime($datetime);
    return strftime("%B %d, %Y at %I:%M %p", $unixdatetime);
}
function datetime_to_text_nosec($datetime="")
{
    $unixdatetime = strtotime($datetime);
    return strftime("%B %d, %Y", $unixdatetime);
}
function randname($filename)
{
    $name = explode(".", $filename);
    $ext_index_count = count($name)-1;
    $extension = $name[$ext_index_count];
    $firstname = time()*rand();
    $filename = $firstname.'.'.$extension;
    return $filename;
}
//function mailto($to, $subject, $body, $link='')
//{
//    //$to = $username;
//    $body = "Your Registration has been processed. Please click the link below to activate your account with Uptown Cars: \r\n";
//    $body.= $link;
//    $headers = 'From: http://uniwebdesignusa.com/uptown';
//    $headers .= "MIME-Version: 1.0\r\n";
//    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
//    $mail = mail($to, $subject, $body, $headers);
//    return $mail;
//}
    function genToken(){
        $month = date("m");
        $year = date("Y");
        $string = $month."-".$year."-". strtoupper(random_string('alpha', 6));
        return $string;
    }

    if(!function_exists('current_fiscal_year')) {

        function current_fiscal_year() {

            $CI =& get_instance();

            $CI->db->where('is_current', 1);

            $year = $CI->db->get('settings_session');

            return $year->row_array();

        }

    }

    if(!function_exists('get_us_currency_rate')) {

        function get_us_currency_rate() {

        $ch = curl_init('https://www.nrb.org.np/forex');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        /* 
         * XXX: This is not a "fix" for your problem, this is a work-around.  You 
         * should fix your local CAs 
         */
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        /* Set a browser UA so that we aren't told to update */
        //curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.116 Safari/537.36');
        $res = curl_exec($ch);

        if ($res === false) {
            die('error: ' . curl_error($ch));
        }

        curl_close($ch);

        $d = new DOMDocument();
        @$d->loadHTML($res);

        $output = array(
            'title' => '',
        );

        $x = new DOMXPath($d);
        //(/table[@class='attributes']//td[@class='value'])[2]
        //$title = $x->query("//table//td[4]");
        $title = $x->query("//table//td[4]");
        //pp($title);
        if ($title->length > 0) {
            $output['title'] = $title->item(1)->textContent;
        }
        return $output['title'];

        }

    }

?>
