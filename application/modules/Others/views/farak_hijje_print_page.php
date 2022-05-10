<?php
$local_body     = Modules::run("Settings/getLocal",$result->local_body);
$state          = Modules::run("Settings/getState",$result->state);
$ward           = Modules::run("Settings/getWard",$result->ward);
$district       = Modules::run("Settings/getDistrict",$result->district);
$old_new_address      = Modules::run("Settings/getOldNewAddress",$result->old_new_address);

switch($result->gender)
{
    case 1:
        $gender = 'पुरुष';
        break;
    case 2:
        $gender = 'महिला';
        break;
}
if(!empty($result->documents))
{
    $documents      = explode("+",$result->documents);

}
$path           = base_url()."assets/documents/others/farak_hijje/";
$current_session    = Modules::run('Settings/getCurrentSession',$result->session_id);

?>
<div class="letter_print">
    <hr>
    <div class="row">
    <div class="col-3 letter-head-left">
               <p style="font-size:18px;"><span class="red"> पत्र संख्या: </span> <?= $current_session->name ?></p>
            <p style="font-size:18px;"><span class="red"> चलानी नं.:  </span> <?= $chalani_no ?></p>
            </div>
            <div class="col-3 text-right letter-head-right" style="margin-left: 605px">
                <div class="myclear"> </div>
               <p style="font-size:18px; margin-top: -39px;"><span class="red"> मिति : </span> <?= $chalani_result->nepali_chalani_miti?></p>
            </div>
        </div>
    <div class="col-md-4">
        <?php
            $this_office   = Modules::run('Settings/getOffice', $print_office->id);
        ?>
        <div class='row'>
            <p style="font-size:18px; margin-top: 30px;"><?= !empty($this_office->sambodhan) ? $this_office->sambodhan : ''?></p>
        </div>
        <div class="row">
           <p style="font-size:18px;"> <?= $this_office->name?></p>
        </div>
        <div class="row">
           <p style="font-size:18px;"> <?= !empty($this_office->address) ? $this_office->address : ''?></p>
        </div>
    </div>
    <div class="text-center font-28" style="margin-top: 50px;margin-bottom: 40px;">
      <!--   <p style="font-size:18px;"><span style="border-bottom: 1px solid black; margin-bottom: 5px;"> <span class="red"> बिषय : </span> फरक फरक अंग्रेजी हिज्जे ।</span>
        </P> -->
        <p style="font-size:26px;"><span style="border-bottom: 1px solid black; margin-bottom: 5px;"> <span class="red"> बिषय : </span> फरक फरक अंग्रेजी हिज्जे ।</span>
        </p>
    </div>

    <div class="text-justify"><p style="font-size:18px; text-align: justify; margin-top: 50px;">प्रस्तुत बिषयमा 
         <b><?= $local_body->name ?></b> वडा नं <b><?= $ward->name ?> (साबिकको ठेगाना
            <?= $old_new_address->name ?>)</b> निवासी 
        <?php 
        if ($gender!=1) {
            echo श्री;
        }else{
            echo सुश्री;
        }
        ?>
        <b><?= $result->name ?></b>को नाम थर मा अंग्रेजी हिज्जे <b><?= $result->right_spelling?></b> हुनुपर्नेमा
        निजको तल उल्लेखित कागजातमा निजको अंग्रेजी हिज्जे फरक हुन गएको पेश गरेको प्रमाण कागजातका आधारमा व्यहोरा मनासिव भएको खुल्न आएकोले सो फरक, फरक अंग्रेजी
        हिज्जे भएको व्यक्ति एकै भएको प्रमाणित गरिन्छ । </p>
    </div>
    <div class='col-12'>
        <h4 class="text-center mb-5" style="margin-top:120px;">फरक अंग्रेजी हिज्जे र कागजातको विवरण</h4>
        <div class="row">
            <div class="col-4 text-center">
                <span class="font-18 font-weight-bold font-underline">हुनु पर्ने अंग्रेजी हिज्जे</span>
                <div class="clearfix"></div>
                <?= $result->right_spelling?>
            </div>
            <div class="col-4 text-center">
                <span class="font-18 font-weight-bold font-underline">फरक अंग्रेजी हिज्जे</span>
                <div class="clearfix"></div>
                <?= $result->wrong_spelling?>
            </div>
            <div class="col-4 text-center">
                <span class="font-18 font-weight-bold font-underline">फरक भएको कागजात</span>
                <div class="clearfix"></div>
                <?= $result->wrong_document?>
            </div>
        </div>
    </div>


    <div class="space5"></div>
    <div class="col-3 offset-9 signature">
        <div>
            <?= $ward_worker->name?><br />
             <?= $worker_post->name?>
        </div>
    </div>
</div>
