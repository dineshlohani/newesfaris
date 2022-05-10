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
$path           = base_url()."assets/documents/others/farak_janma_miti/";
$current_session    = Modules::run('Settings/getCurrentSession',$result->session_id);

?>
<div class="letter_print">
    <hr>
    <div class="row">
        <div class="col-3 letter-head-left">
            <p style="font-size:18px;"><span class="red"> पत्र संख्या: </span> <?= $current_session->name ?></p>
            <p style="font-size:18px;"><span class="red"> चलानी नं.:  </span> <?= $chalani_no ?></p>
        </div>
            <div class="col-3 text-right letter-head-right" style="margin-left: 719px">
                <div class="myclear"> </div>
               <p style="font-size:18px; margin-top: -39px;"> <span class="red"> मिति : </span> <?= $chalani_result->nepali_chalani_miti?></p>
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
    <div class="text-center font-28" style="margin-bottom: 40px;">
       <p style="font-size:26px;"><span style="border-bottom: 1px solid black; margin-bottom: 5px;"> <span class="red"> बिषय : </span> फरक फरक जन्म मिति प्रमाणित ।</span>
        </p>
    </div>

    <div class="text-justify">
        <p style="font-size:18px; text-align: justify;">प्रस्तुत बिषयमा 
        <b><?= $local_body->name ?></b> वडा नं <b><?= $ward->name ?> (साबिकको ठेगाना
            <?= $old_new_address->name ?>)</b> निवासी 
        <?php if ($gender!=1) {
            echo श्री;
        }else
        echo सुश्री;
        ?>
        <b><?= $result->name ?></b>को निम्न उल्लेखित विवरण अनुसारको कागजातमा जन्म
        मिति फरक हुन गएको हुनाले सो  फरक हुन गएको जन्म मिति भएको व्यक्ति एकै भएको प्रमाणित गरि पाउन भनि यस कार्यालयमा पेश गरेको व्यहोरा
        मनासिव भएकोले सो फरक जन्म मिति भएको व्यक्ति एकै भएको व्यहोरा सिफारिस गरिन्छ । </p>
    </div>
    <div class='col-12'>
        <h4 class="text-center mb-5" style="margin-top:120px;text-decoration: underline;">फरक फरक जन्म मिति प्रमाणित ।</h4>
        <div class="row">
            <div class="col-4 text-center">
                <span class="font-18 font-weight-bold font-underline">हुनु पर्ने जन्म मिति</span>
                <div class="clearfix"></div>
                <?= $result->right_birthdate?>
            </div>
            <div class="col-4 text-center">
                <span class="font-18 font-weight-bold font-underline">फरक भएको जन्म मिति</span>
                <div class="clearfix"></div>
                <?= $result->wrong_birthdate?>
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