<?php
    $local_body     = Modules::run("Settings/getLocal",$result->local_body);
    $state          = Modules::run("Settings/getState",$result->state);
    $ward           = Modules::run("Settings/getWard",$result->ward);
    $district       = Modules::run("Settings/getDistrict",$result->district);
    $old_place      = Modules::run("Settings/getOldNewAddress",$result->old_place);

    if($result->gender == 1)
    {
        $gender = "छोरा";
    }
    else
    {
        $gender = "छोरी";
    }
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
        <div class="text-right" style="margin-left: 605px">
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

    <div class="text-center font-28 mt-3 pb-5 mb-5 pt-5" style="margin-top: 120px; margin-bottom: 70px;">
        <p style="font-size:26px;"><span style="border-bottom: 1px solid black; margin-bottom: 5px;"> <span class="red">  बिषय:  </span>अविवाहित प्रमाणित। </span>
        </p>
    </div>
    <div class="text-justify" style="text-indent: 120px;">
                       <p style="font-size:18px; text-align: justify;"> <?= $local_body->name ?> वडा नं. <?= $ward->name ?> (साबिकको
                        ठेगाना <?= $old_place->name ?>) निवासी श्री <?= $result->father_name ?> तथा
                        श्रीमती <?= $result->mother_name ?> को <?= $gender ?> श्री <?= $result->child_name ?>
                        आजको
                        मितिसम्म यस कार्यालयबाट स्थलगत सर्जमिन गरिबुझ्दा 
                        अविवाहित रहेको व्यहोरा प्रमाणित गरिन्छ । </p>
                    </div>
    <div class="space4"> </div>
    <div class="mt-5 pt-5">
        <div class="row">

            <div class="offset-9 col-3 signature">
                <?= $ward_worker->name?><br />
                <?= $worker_post->name?>
            </div>
        </div>
    </div>
</div>
