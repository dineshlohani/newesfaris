<?php
    $org_local_body     = Modules::run("Settings/getLocal",$result->org_local_body);
    $org_state          = Modules::run("Settings/getState",$result->org_state);
    $org_ward           = Modules::run("Settings/getWard",$result->org_ward);
    $org_district       = Modules::run("Settings/getDistrict",$result->org_district);
    $prop_local_body     = Modules::run("Settings/getLocal",$result->prop_local_body);
    $prop_state          = Modules::run("Settings/getState",$result->prop_state);
    $prop_ward           = Modules::run("Settings/getWard",$result->prop_ward);
    $prop_district       = Modules::run("Settings/getDistrict",$result->prop_district);
    if(!empty($result->documents))
    {
        $documents      = explode("+",$result->documents);

    }
    $path           = base_url()."assets/documents/business/bebasaya_sifaris/";
    $current_session    = Modules::run('Settings/getCurrentSession',$result->session_id);
    $worker_post        = Modules::run('Settings/getPost',$ward_worker->post_id);
?>
<div class="font-24 text-black " style="line-height: 2;">
    <div>
        <img src="<?=base_url()?>assets/images/icons/logo.png" alt="logo.png" style="height: auto; width: 16%; ">
        <p class=" pt-3 font-20" style="font-weight:bold">
            <span class="">पत्र संख्या:</span> <?= $current_session->name ?><br>
            <span class="">चलानी नं.:</span> <?= $chalani_no2 ?>
        </p>
    </div>
    <div class="text-center font-bold" style="margin-top: -240px;">
        <h2 style="font-size: 36px; font-weight:500; "><?= SITE_OFFICE ?></h2>
        <?php if($this->session->userdata('is_muncipality') == 1):?>
            <h3 style="font-size: 34px; font-weight:500; margin-top: -5px;">
                 <?= SITE_PALIKA ?>
            </h3>
        <?php else: ?>
            <h3 style="font-size: 34px; font-weight:500; margin-top: -5px;">
                 <?=$this->session->userdata('ward_no')?> <?= SITE_WARD_OFFICE ?>
            </h3>
        <?php endif; ?>
        <?php if($this->session->userdata('is_muncipality')==0):?>
            <h3 style="margin-top: -5px; font-weight:500; font-size:28px "><?=  $this->session->userdata('address').", ".SITE_DISTRICT?> </h3>
         <?php else: ?>
             <h3 style="margin-top: -5px; font-weight:500; font-size:28px "><?= SITE_ADDRESS ?></h3>
         <?php endif;?>
        <p style="font-size:24px; font-weight: 500; margin-top:-5px;">
            <?= SITE_STATE ?> </p>
    </div>
    <div>
        <p class="text-right font-bold">
            मिति : <?= $chalani_result2->nepali_chalani_miti ?>
        </p>
    </div>
    <div class="col-md-4">
        <?php
            $this_office   = Modules::run('Settings/getOffice', $print_office->id);
        ?>
        <div class='row'>
            <?= !empty($this_office->sambodhan) ? $this_office->sambodhan : ''?>
        </div>
        <div class="row">
            <?= $this_office->name?>
        </div>
        <div class="row">
            <?= !empty($this_office->address) ? $this_office->address : ''?>
        </div>
    </div>
    <div class="text-center mt-2 pb-2">
        <h4><span
                style="border-bottom: 1px solid black; margin-bottom: 3px;"> बिषय: व्यवसाय दर्ता सिफारिस। </span>
        </h4>
    </div>
    <div class="text-justify">
        उपरोक्त सम्बन्धमा यस <?= $prop_local_body->name ?>  वडा नं <?= $prop_ward->name?>
        बस्ने <?= $result->prop_name ?>ले <?= $result->home_owner ?>को नाममा रहेको साबिक <?= $org_local_body->name?> वडा नं. <?= $org_ward->name ?> कि.नं. <?= $result->kitta_no ?> क्षे.फ. <?=$result->biggha."-".$result->kattha."-".$result->dhur ?><?php if($result->paisa != 0){ echo '-'.$result->paisa; } ?> को जग्गामा "<b><?= $result->org_name?></b>" <?= $result->org_type ?> कारोबार पाना दर्ताका लागि सिफारिस गरिपाउँ भनि यस वडा कार्यालयमा निवेदन दिनु भएकोले निजलाई उक्त कारोबार दर्ताका लागि बुझेको वडा सर्जमिन मुचुल्का पाना थान १(एक) यसै पत्र साथ संलगन राखी पठाईएको व्यहोरा सिफारिस साथ अनुरोध गरिन्छ |
    </div>
    <div style="margin-top: 300px">
        <div class="row">
            <div class="col-6 offset-6 text-right">
                ................................. <br>
                <?= $ward_worker->name?><br/>
                वडा <?= $worker_post->name?>
            </div>
        </div>
    </div>
</div>
