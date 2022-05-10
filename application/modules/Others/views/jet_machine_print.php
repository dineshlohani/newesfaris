<?php
    $local_body     = Modules::run("Settings/getLocal",$result->local_body);
    $state          = Modules::run("Settings/getState",$result->state);
    $ward           = Modules::run("Settings/getWard",$result->ward);
    $district       = Modules::run("Settings/getDistrict",$result->district);
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
    <div class="text-center font-28 mt-5 pb-5 mb-1 pt-5" style="margin-top: 50px; margin-bottom: 30px;">
        <p style="font-size:26px;"><span style="border-bottom: 1px solid black; margin-bottom: 5px;"> <span class="red"> बिषय :  </span> जेट मेशिन।</span>
        </p>
    </div>

    <div class="text-justify mt-2" style="margin-top: 10px; text-indent: 150px;">
       <p style="font-size:18px; text-align: justify;"> 
       <b><?= $local_body->name ?></b> वडा नं <b><?= $ward->name ?></b>
                                अन्तर्गत उल्लेखित स्थानमा
                                रहेको
                                <b><?=$result->work_status?></b>
                                ढल जाम भएको हुनाले सो स्थानको लागि जेट मेशिन उपलब्ध गराईदिन हुन
                                अनुरोध गरिन्छ।
                            </div>

    <div class="mt-5" style="font-style:italic;">
        <p style="font-size:18px; text-align: justify;">
           जेट मेशिन उपलब्ध गराउन पर्ने स्थान
                                : <b><?= $result->machine_dine_tham ?></b><br>
                                बाटोको नाम : <b><?= $result->road_name ?></b></p>
    </div>
    <div class="space4"></div>
    <div class="mt-5 pt-5">
        <div class="row mt-5x">

            <div class="offset-9 col-3 signature">
                <?= $ward_worker->name?><br />
                <?= $worker_post->name?>
            </div>
        </div>
    </div>
</div>