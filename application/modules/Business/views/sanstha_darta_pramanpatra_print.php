<?php
    $org_local_body     = Modules::run("Settings/getLocal",$result->org_local_body);
    $org_state          = Modules::run("Settings/getState",$result->org_state);
    $org_ward           = Modules::run("Settings/getWard",$result->org_ward);
    $org_district       = Modules::run("Settings/getDistrict",$result->org_district);
    $own_local_body     = Modules::run("Settings/getLocal",$result->own_local_body);
    $own_state          = Modules::run("Settings/getState",$result->own_state);
    $own_ward           = Modules::run("Settings/getWard",$result->own_ward);
    $own_district       = Modules::run("Settings/getDistrict",$result->own_district);
    if(!empty($result->documents))
    {
        $documents      = explode("+",$result->documents);

    }
    $path           = base_url()."assets/documents/business/sanstha_darta_pramanpatra/";
    if($result->nationality == 1)
    {
        $nationality    = "स्वदेशी";
    }
    elseif($result->nationality == 2)
    {
        $nationality    = "विदेशी";
    }
    $current_session    = Modules::run('Settings/getCurrentSession',$result->session_id);
    $worker_post        = Modules::run('Settings/getPost',$ward_worker->post_id);
?>
<div class="letter_print">
    
    <hr>
    <div class="row">
    <div class="col-3 letter-head-left">
        <p style="font-size:18px;"><span class="red"> पत्र संख्या: </span> <?= $current_session->name ?><br></p>
        <p style="font-size:18px;"><span class="red"> चलानी नं.:  </span> <?= $chalani_no ?></p>
    </div>
    <div class="col-3 text-right letter-head-right" style="margin-left: 635px">
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
    <div class="text-center mt-4 pb-4 font-28">
         <p style="font-size:26px;"><span class="red">  बिषय: </span> गैर नाफामुलक संस्था दर्ता प्रमाणपत्र। </span>
        </p>
    </div>
    <div class="row">
        <div class="col-8 mt-5">
            <div>
                <p class="text-body" style="font-size: 18px; text-align: justify;"> <span class="font-bold">संस्थाको दर्ता नं:</span> <?= $result->darta_no ?>
                <br>
                <span class="font-bold">संस्थाको दर्ता मिति:</span> <?= $result->nepali_darta_miti ?></p>
            </div>
        </div>
        <div class="col-4 text-center font-16">
            <div class="py-5 mt-1" style="border: 2px solid black; margin-left: 80px; height: 180px; width: 180px;">
                संस्थाको छाप वा फोटो
            </div>
        </div>
    </div>
    <div class="space2"></div>
    <div class="pl-1" style="margin-top: 0">
        <div class="font-kalimati">
           <p style="font-size:22px;"> 1)</p>
        </div>
        <div class="pl-5" style="margin-top: -45px;">
           <p style="font-size:22px;"> संस्थाको नाम: श्री <?= $result->org_name ?> <br>
            ठेगाना: <?= $org_local_body->name.", वार्ड-".$org_ward->name.", ".$org_district->name.", ".$org_state->name ?><br>
            स्वदेशी / बिदेशी: <?= $nationality ?><br>
            बिषयगत क्षेत्र: <?= $result->subjected_area ?><br>
            संस्थाको कारोवार शुरु भएको मिति: <?= $result->nepali_transact_date ?>
            <br>
            ई-मेल: <?= $result->org_email ?> <br>
            सम्पर्क फोन नं.: <?= $result->org_contact_no ?> <br>
        </p>
        </div>
    </div>

    <div class="pl-1 mt-4">
        <div class="font-kalimati">
           <p style="font-size:22px;"> 2)</p>
        </div>
        <div class="pl-5" style="margin-top: -45px;">
            <p style="font-size:22px;">
            संचालक / अध्यक्ष / मुख्य व्यक्तिको नाम, थर: <?=$result->gender_spec?> <?= $result->owner_name ?><br>
            ठेगाना: <?= $own_local_body->name.", वार्ड-".$own_ward->name.", ".$own_district->name.", ".$own_state->name ?><br>
            ई-मेल: <?= $result->own_email ?><br>
            सम्पर्क फोन नं.: <?= $result->own_contact_no ?> <br>
            नागरिकता नं : <?=$result->cit_no?></p>
        </div>
    </div>

    <div class="mt-3 pt-3" style="font-size:22px;">
        <div class="row">
            <div class="space2"></div>
            <div class="offset-9 col-3 signature">
                <?= $ward_worker->name?><br />
                वडा <?= $worker_post->name?>
            </div>
        </div>
    </div>
</div>