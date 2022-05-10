<?php
    $local_body     = Modules::run("Settings/getLocal",$result->local_body);
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
    <hr>
    <div class="row">
    <div class="col-3 letter-head-left">
                <p style="font-size:18px;"><span class="red"> पत्र संख्या: </span> <?= $current_session->name ?><br></p>
                <p style="font-size:18px;"><span class="red"> चलानी नं.:  </span> <?= $chalani_no ?></p>
            </div>
            <div class="col-3 text-right letter-head-right" style="margin-left: 605px">
                <div class="myclear"> </div>
                <p style="font-size:18px; margin-top: -39px;"><span class="red"> मिति : </span> <?= $chalani_result->nepali_chalani_miti?></p>
            </div>
        </div><br>
    <div class="col-md-4">
        <?php
                    $this_office   = Modules::run('Settings/getOffice', $print_office->id);
                ?>
        <div class='row'>
            <?= !empty($this_office->sambodhan) ? $this_office->sambodhan."," : ''?>
        </div>
        <div class="row">
            <?= $this_office->name?>,
        </div>
        <div class="row">
            <?= !empty($this_office->address) ? $this_office->address."," : ''?>
        </div>
    </div>
    <div class="space2"></div>
    <div class="text-center font-28" style="margin-top: 70px; margin-bottom: 70px;">
        <p style="font-size:26px;">
            <span style="border-bottom: 1px solid black; margin-bottom: 5px;"> <span class="span red"> बिषय :</span> सिफारिस सम्बन्धमा ।
            </span>
        </p>
    </div>
    <div class="text-justify"><div class="mt-2 mb-5 pb-2">
       <p style="font-size:18px;">
                            प्रस्तुत बिषयमा  <b><?=$district->name;?></b> जिल्ला <b><?=$local_body->name ?></b> वडा नं <b><?= $result->ward?></b> साबिकको <b>(<?= $old_new_address->name ?>)</b> मा रहेको व्यवसाय <b><?= $result->org_name ?></b> यस कार्यालयमा मिति <?=$result->nepali_date_1?> दर्ता भएको र चालु आ.व. <b><?= $current_session->name ?></b> मा संस्था नविकरणको लागि यस कार्यालयमा दिनु भएको निवेदन अनुसार संस्था नविकरण गरिदिनु हुन सिफारीस साथ अनुरोध गरीन्छ ।
                        </div> </p>
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

<footer style="margin-top: 450px;  border-top: 2px solid red; position: fixed;">
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