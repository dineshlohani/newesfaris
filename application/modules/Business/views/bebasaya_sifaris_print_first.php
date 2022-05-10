<?php
    $local_body     = Modules::run("Settings/getLocal",$result->org_local_body);
    $state          = Modules::run("Settings/getState",$result->state);
    $ward           = Modules::run("Settings/getWard",$result->ward);
    $district       = Modules::run("Settings/getDistrict",$result->district);
    $old_new_address    = Modules::run("Settings/getOldNewAddress",$result->old_new_address);
    $current_session    = Modules::run('Settings/getCurrentSession',$result->session_id);
    //print_r($surrent_session);
    $worker_post        = Modules::run('Settings/getPost',$ward_worker->post_id);
    //print_r($users);
?>
<div class="letter_print">
   
    <hr><br>
    <div class="row">
        <div class="col-3 letter-head-left">
                <p style="font-size:20px;"><span class="red"> पत्र संख्या: </span> <?= $current_session->name ?><br></p>
                <p style="font-size:20px;"><span class="red"> चलानी नं.:  </span> <?= $chalani_no ?></p>
        </div>
        <div class="col-3 text-right letter-head-right" style="margin-left: 605px">
            <div class="myclear"> </div>
             <p style="font-size:20px; margin-top: -39px;"><span class="red">मिति : </span> <?= $chalani_result1->nepali_chalani_miti?><p>
        </div>
    </div><br>
     <div class="col-md-4">
        <?php
            $this_office   = Modules::run('Settings/getOffice', $print_office->id);
        ?>
        <div class='row'>
            <p style="font-size:20px; margin-top: 30px;"><?= !empty($this_office->sambodhan) ? $this_office->sambodhan : ''?></p>
        </div>
        <div class="row">
           <p style="font-size:20px;"> <?= $this_office->name?></p>
        </div>
        <div class="row">
           <p style="font-size:20px;"> <?= !empty($this_office->address) ? $this_office->address : ''?></p>
        </div>
    </div>
    <div class="space2"></div>
    <div class="text-center font-28" style="margin-top: 70px; margin-bottom: 70px;">
        <p style="font-size:26px;">
            <span class="span red"> बिषय :</span> सिफारिस सम्बन्धमा ।
            </span>
        </p>
    </div>
    <div class="text-justify">
         <p style="font-size:20px;">उपरोक्त सम्बन्धमा यस <?= $prop_local_body->name ?>  वडा नं <?= $prop_ward->name?>
        बस्ने <?= $result->prop_name ?>ले <?= $result->home_owner ?>को नाममा रहेको साबिक <?= $org_local_body->name?> वडा नं. <?= $org_ward->name ?> कि.नं. <?= $result->kitta_no ?> क्षे.फ. <?=$result->biggha."-".$result->kattha."-".$result->dhur ?><?php if($result->paisa != 0){ echo '-'.$result->paisa; } ?> को जग्गामा "<b><?= $result->org_name?></b>" <?= $result->org_type ?> कारोबार पाना दर्ताका लागि सिफारिस गरिपाउँ भनि यस वडा कार्यालयमा निवेदन दिनु भएकोले निजलाई उक्त कारोबार तहको पाना दर्ताका लागि सिफारिस साथ अनुरोध गरिन्छ | </p>
    </div>
    </div>
    <div class="mt-5 pt-3">
        <div class="row">
            <div class="space4"></div>
            <div class="offset-9 col-3 signature">
                <?= $ward_worker->name?><br />
                <?= $worker_post->name?>
            </div>
        </div>
    </div>

</div>
<footer style="margin-top: 320px;  border-top: 2px solid red;">
    <div class="text-center"><q><?php echo SITE_SLOGAN?></q></div>
    <div class="text-center">
         <?php if(SITE_PHONE_ALIGNMENT == 'footer'): ?>
                फोन नं: <i class="fa fa-phone"></i>: <?php echo SITE_PHONE?>
            <?php endif;?>
            <?php if(SITE_EMAIL_ALIGNMENT == 'footer'): ?>
                इमेल <i class="fa fa-envolp"></i>: <?php echo SITE_EMAIL?>
            <?php endif;?>
            <?php if(SITE_WEBSITE_ALIGNMENT == 'footer'): ?>
               वेभसाईट<i class="fa fa-globe"></i>: <?php echo SITE_WEBSITE ?>
            <?php endif;?>       
    </div>
</footer>