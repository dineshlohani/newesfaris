<?php
$local_body     = Modules::run("Settings/getLocal",$result->local_body);
$state          = Modules::run("Settings/getState",$result->state);
$ward           = Modules::run("Settings/getWard",$result->ward);
$district       = Modules::run("Settings/getDistrict",$result->district);
$old_place      = Modules::run("Settings/getOldNewAddress",$result->old_place);
$current_session    = Modules::run('Settings/getCurrentSession',$result->session_id);
$worker_post        = Modules::run('Settings/getPost',$ward_worker->post_id);
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
        <div class="text-center font-26 mt-5 pb-5 mb-5 pt-5" style="margin-top: 70px; margin-bottom: 70px;">
           <p style="font-size:26px;">
                <span
                style="border-bottom: 1px solid black; margin-bottom: 5px;"> <span class="red"> बिषय :</span> सिफारिस सम्बन्धमा ।
            </span>
        </p>
    </div>
    <div class="text-justify">
       <p style="font-size:18px; text-align: justify;"> उपरोक्त सम्बन्धमा <b><?= $local_body->name ?></b> वडा नं <b><?= $ward->name ?></b>
        स्थित
        <?=$result->gender_spec?> <b><?= $result->applicant_name ?></b> को नाममा रहेको
        कि.नं. <b><?= $result->kitta_no ?></b> क्षे.फ. <b><?= $result->biggha."-".$result->kattha."-".$result->dhur."-".$result->daam ?></b>
        मा बनेको घर भत्कीई पाताल भएको सोही अनुसारको सिफारिस गरी पाऊँ भनी यस वडा कार्यालयमा
        पर्न आएको निवेदन
        सम्बन्धमा उल्लेखित कि.नं. बनेको घर पाताल भएको व्यहोरा सिफारिस गरिन्छ ।</p>
    </div>
    <div class="space5"> </div>
    <div class="mt-5 pt-3">
        <div class="row">
            <div class="offset-9 col-3 signature">
                <?= $ward_worker->name?><br/>
                <?= $worker_post->name?>
            </div>
        </div>
    </div>
</div>