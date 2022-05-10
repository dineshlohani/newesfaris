<?php
    $local_body     = Modules::run("Settings/getLocal",$result->local_body);
    $state          = Modules::run("Settings/getState",$result->state);
    $ward           = Modules::run("Settings/getWard",$result->ward);
    $district       = Modules::run("Settings/getDistrict",$result->district);
    $old_place      = Modules::run("Settings/getOldNewAddress",$result->old_place);

    if($result->resident_type == "Permanent")
    {
        $resident_type = "स्थायी";
    }
    else
    {
        $resident_type = "अस्थायी";
    }
    if($result->finance_condition == "Weak")
    {
        $finance_condition = "आर्थिक अवस्था कमजोर";
    }
    else
    {
        $finance_condition = "आयश्रोत न्युन";
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
            <div class="col-3 text-right letter-head-right" style="margin-left: 605px">
                <div class="myclear"> </div>
                <span class="red"> मिति : </span> <?= $chalani_result->nepali_chalani_miti?>
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
<!--header part ends-->

    <div class="text-center font-28 mt-5 pb-5 mb-5 pt-5" style="margin-bottom: 40px;">
        <p style="font-size:26px; margin-left:328px;"><span style="border-bottom: 1px solid black; margin-bottom: 5px;"> <span class="red"> बिषय : </span> छात्रवृत्ति सिफारिस ।</span>
        </p>
    </div>
    <div class="text-justify">
        <p style="font-size:18px; text-align: justify;">प्रस्तुत बिषयमा <b><?= $local_body->name ?></b> वडा नं <b><?= $ward->name ?></b> (साबिकको ठेगाना
        <b><?= $old_place->name ?></b>) अन्तर्गत <?=$resident_type?> बसोबास गर्ने
        श्री <b><?= $result->father_name ?></b>
        तथा श्रीमती <b><?= $result->mother_name ?></b> को <b><?= $finance_condition ?></b> भएको हुँदा
        निजहरु
        का
        देहय
        बमोजिमका छोरा / छोरी लाई नियम अनुसार छात्रवृत्तिको लागि सिफारिस गरिन्छ । </p>
    </div>
    <div class="mt-4 text-center font-bold">
        छोरा / छोरीको नाम विवरण
    </div>
    <table class="table letter-table table-bordered mybordertable mt-4">
        <thead>
            <tr>
                <th style="width:5%;">
                    क्र.स.
                </th>
                <th style="font-size:18px;">
                    नाम थर
                </th>
                <th style="font-size:18px;">
                    नाता
                </th>
                <th style="font-size:18px;">
                    घर नं
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
                 $i = 1;
                 foreach($details as $data):
                     $relation = Modules::run("Settings/getRelation",$data->relation);
            ?>
            <tr>
                <td style="font-size:18px;"><?= $i ?></td>
                <td>
                    <?= $data->name ?>
                </td>
                <td style="font-size:18px;">
                    <?= $relation->name ?>
                </td>
                <td style="font-size:18px;">
                    <?= $data->ghar_no ?>
                </td>
            </tr>
            <?php $i++; endforeach;?>

        </tbody>
    </table>

    <div class="space5"></div>
    <div class="col-3 offset-9 signature">
        <div>
            <?= $ward_worker->name?><br />
             <?= $worker_post->name?>
        </div>
    </div>
</div>
