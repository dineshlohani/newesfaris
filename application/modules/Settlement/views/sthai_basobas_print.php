<?php
    $local_body     = Modules::run("Settings/getLocal",$result->local_body);
    $state          = Modules::run("Settings/getState",$result->state);
    $ward           = Modules::run("Settings/getWard",$result->ward);
    $district       = Modules::run("Settings/getDistrict",$result->district);
    $old_place      = Modules::run("Settings/getOldNewAddress",$result->old_place);
    $citizenship_district       = Modules::run("Settings/getDistrict",$result->citizenship_district);
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
            <p style="font-size:18px; margin-top: 30px;"><?= !empty($this_office->sambodhan) ? $this_office->sambodhan : ''?></p>
        </div>
        <div class="row">
           <p style="font-size:18px;"> <?= $this_office->name?></p>
        </div>
        <div class="row">
           <p style="font-size:18px;"> <?= !empty($this_office->address) ? $this_office->address : ''?></p>
        </div>
    </div>
    <div class="text-center font-28" style="margin-top: 80px; margin-bottom: 80px;">
        <p style="font-size:26px;"><span style="border-bottom: 1px solid black; margin-bottom: 5px;"><span class="red"> बिषय: </span> स्थायी बसोबास सिफारिस ।</span>
        </p>
    </div>


    <div class="text-justify" style="text-indent: 100px">
         <p style="font-size:18px; text-align: justify;">
             निवेदक  <?=$result->gender_spec?> <?= $result->resident_name ?>ले पेश गर्नुभएको निवेदनका
                            आधारमा
                            निज
                            <?=$result->gender_spec?> <?= $result->resident_name?> <?= $local_body->name."-".$ward->name.", ".$district->name.", ".$state->name?>
                            ( साबिक ठेगाना <?= $old_place->name?>)
                            अन्तर्गत तल
                            उल्लेखित स्थानमा विगत मिति <?= $result->nepali_permission_date ?> देखि स्थायी
                            बसोबास
                            गर्दै आउनु भएको
                            व्यहोरा सिफारिस साथ अनुरोध गरिन्छ ।


    </div>

    <div class="mt-3  font-italic">
         <p style="font-size:18px; text-align: justify;">बसोबास गर्नेको ना. प्र. प. नं.: <?= $result->citizenship_no ?>
        जिल्ला:- <?= $citizenship_district->name ?> / जारी
        मिति <?= $result->nepali_citizenship_date ?></p>
    </div>

    <div class="text-center  font-bold my-4 mt-5">
         <p style="font-size:18px; text-align: justify;"><span style="border-bottom: 1px solid black; margin-bottom: 5px;">
            बसोबास स्थान
        </span></p>
    </div>
    <div>
        <table class="table text-center table-bordered mybordertable">
            <tr>
                <td style="width:5% !important; font-size: 18px;">
                    क्र.सं.
                </td>
                <td style="font-size:18px;">
                    टोल
                </td>
                <td style="font-size:18px;">
                    बाटोको नाम
                </td>
                <td style="font-size:18px;">
                    घर नं
                </td>
            </tr>
            <tr>
                <td class="font-kalimati" style="font-size:18px;">
                    1
                </td>
                <td style="font-size:18px;">
                    <?= $result->tole ?>
                </td style="font-size:18px;">
                <td class="font-kalimati" style="font-size:18px;">
                    <?= $result->road ?>
                </td>
                <td style="font-size:18px;">
                    <?= $result->ghar_no ?>
                </td>
            </tr>
        </table>
    </div>
    <div class="mt-5 pt-5">
        <div class="row mt-5x">
            <div class="space2"></div>
            <div class="offset-9 col-3 signature">
                <?= $ward_worker->name?><br />
                <?= $worker_post->name?>
            </div>
        </div>
    </div>
</div>