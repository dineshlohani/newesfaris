<?php

 $org_local_body_g     = Modules::run("Settings/getLocal",$result->g_local_body);
    $org_state_g          = Modules::run("Settings/getState",$result->g_state);
    $org_ward_g           = Modules::run("Settings/getWard",$result->g_ward);
    $org_district_g       = Modules::run("Settings/getDistrict",$result->g_district);
    $org_old_new_g        = Modules::run("Settings/getOldNewAddress",$result->g_old_address);

    $org_local_body_b     = Modules::run("Settings/getLocal",$result->b_local_body);
    $org_state_b          = Modules::run("Settings/getState",$result->b_state);
    $org_ward_b           = Modules::run("Settings/getWard",$result->b_ward);
    $org_district_b       = Modules::run("Settings/getDistrict",$result->b_district);
    $org_old_new_b        = Modules::run("Settings/getOldNewAddress",$result->b_old_address);
    $current_session    = Modules::run('Settings/getCurrentSession',$result->session_id);
    $worker_post        = Modules::run('Settings/getPost',$ward_worker->post_id);
?>
<div class="letter_print">
    <hr>
    <br>
    <div class="row">
    <div class="col-3 letter-head-left">
        <p style="font-size:18px;"><span class="red"> पत्र संख्या: </span> <?= $current_session->name ?><br></p>
        <p style="font-size:18px;"><span class="red"> चलानी नं.:  </span> <?= $chalani_no ?></p>
    </div>
    <div class="col-3 text-right letter-head-right" style="margin-left: 605px">
                <div class="myclear"> </div>
                <p style="font-size:18px; margin-top: -39px;"><span class="red"> मिति : </span> <?= $chalani_result->nepali_chalani_miti?></p>
    </div>
</div>
<br>
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
    <div class="text-center mt-5 pb-5 mb-1 pt-5">
        <p style="font-size:26px;"><span style="border-bottom: 1px solid black; margin-bottom: 3px;"> <span class="red"> बिषय:</span> विवाह प्रमाणित । </span>
        </p>
    </div>
    <div class="row">
        <div class="col-12">
            <p style="font-size:18px; text-align: justify;"> श्री <b><?= $result->g_grand_father_name ?></b> को नाति श्री <b><?= $result->g_father_name ?></b> तथा श्रीमती <b><?= $result->g_mother_name ?> </b>को छोरा <b><?= $org_district_g->name?>, <?= $org_local_body_g->name ?>,</b> वार्ड-<b><?= $org_ward_g->name ?></b> (साबिकको ठेगाना <b><?= $org_old_new_g->name ?></b>) निबासी श्री <b><?= $result->g_name ?></b> संग श्री <b><?= $result->b_grand_father_name ?></b> को नातिनी श्री <b><?= $result->b_father_name ?></b> तथा श्रीमती <b><?= $result->b_mother_name ?></b> को
            छोरी <b><?=$org_district_b->name?>, <?= $org_local_body_b->name ?></b> वडा-<b><?= $org_ward_g->name ?></b> निबासी
            सुश्री <b><?= $result->b_name ?></b> बीच मिति <b><?= $result->marriage_date_nepali ?></b> मा विवाह भई यस वडा कार्यालयमा मिति <?=$result->nepali_date?> मा भएको व्यहोरा प्रमाणित गरिन्छ। </p>
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