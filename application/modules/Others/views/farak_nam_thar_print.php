<?php
    $local_body     = Modules::run("Settings/getLocal",$result->local_body);
    $state          = Modules::run("Settings/getState",$result->state);
    $ward           = Modules::run("Settings/getWard",$result->ward);
    $district       = Modules::run("Settings/getDistrict",$result->district);
    $old_place      = Modules::run("Settings/getOldNewAddress",$result->old_place);
    $current_session    = Modules::run('Settings/getCurrentSession',$result->session_id);
    $worker_post        = Modules::run('Settings/getPost',$ward_worker->post_id);

    switch($result->gender)
{
    case 1:
        $gender = 'पुरुष';
        break;
    case 2:
        $gender = 'महिला';
        break;
}
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
            <span class="red"> मिति : </span> <?= $chalani_result->nepali_chalani_miti?>
        </div>
    </div>
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
    <div class="text-center font-28 mt-5 pb-5 mb-5 pt-5" style="margin-top: 50px; margin-bottom: 30px;">
        <h4><span style="border-bottom: 1px solid black; margin-bottom: 5px;"> <span class="red"> बिषय: </span> फरक फरक नाम र थर प्रमाणित सिफारिस।</span>
        </h4>
    </div>


    <div class="text-justify mt-5" style="text-indent: 150px;">प्रस्तुत बिषयमा
        <b><?= $local_body->name ?></b> वडा नं <b><?= $ward->name ?> (साबिकको
            ठेगाना <?= $old_place->name ?>)</b> निवासी
        <?php
        if ($gender!=1) {
            echo श्री;
        }else{
            echo सुश्री;
        }
        ?>
        <b><?= $result->applicant_name ?></b> को तल
        उल्लेखित विवरण अनुसारको कागजातमा <b><?= $result->farak_name ?></b> फरक हुन गएकोले सो फरक हुन गएको <b><?= $result->farak_name ?></b> भएको
        व्यक्ति
        एकै भएको प्रमाणित
        गरि पाउँ भनी निजले यस कार्यालयमा पेश गर्नुभएको निवेदन र सोसाथ संलग्न कागजातका आधारमा
        निजले
        पेश गरेको व्यहोरा
        मनासिव भएको खुल्न आएकोले सो फरक <b><?= $result->farak_name ?></b> भएको व्यक्ति एकै भएको व्यहोरा सिफारिस गरिन्छ
        ।
    </div>
    <div class="space1"> </div>
    <div class="text-center font-bold my-4 mt-3">
        <span style="border-bottom: 1px solid black; margin-bottom: 10px;">फरक नाम, थर र कागजजात विवरण</span>
    </div>
    <br>
    <div class="row text-center">
        <div class="col-3">
            <span class="text-bold b" style="border-bottom: 1px solid black; margin-bottom: 10px;">फरक भएको कागजजात</span>
            <br>
            <?= $result->farak_bhayeko_document ?>
        </div>
        <div class="col-3">
            <span class="text-bold b" style="border-bottom: 1px solid black; margin-bottom: 10px;">ठिक भएको कागजजात</span>
            <br>
            <?= $result->thik_bhayeko_document ?>
        </div>
        <div class="col-3">
            <span class="text-bold b" style="border-bottom: 1px solid black; margin-bottom: 10px;">फरक भएको</span>
            <br>
            <?= $result->farak_name ?>
        </div>
        <div class="col-3">
            <span class="text-bold b" style="border-bottom: 1px solid black; margin-bottom: 10px;">हुनु पर्ने</span>
            <br>
            <?= $result->thik_naam ?>
        </div>

    </div>
    <div class="space4"> </div>
    <div class="mt-5 pt-5">
        <div class="row mt-5x">

            <div class="offset-9 col-3 signature">
                <?= $ward_worker->name?><br />
                <?= $worker_post->name?>
            </div>
        </div>
    </div>
</div>