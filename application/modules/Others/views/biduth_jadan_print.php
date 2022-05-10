<?php
$org_local_body    = Modules::run("Settings/getLocal",$result->local_body);
    $org_state          = Modules::run("Settings/getState",$result->state);
    $org_ward           = Modules::run("Settings/getWard",$result->ward_no);
    $org_district       = Modules::run("Settings/getDistrict",$result->district);
    $org_old_new        = Modules::run("Settings/getOldNewAddress",$result->old_address);
    $house_type_view    = Modules::run("Settings/getHomeType",$result->house_type);
    $eutype_view        = Modules::run("Settings/getEutype",$result->electricity_use_type);
    $current_session    = Modules::run('Settings/getCurrentSession',$result->session_id);
    $worker_post        = Modules::run('Settings/getPost',$ward_worker->post_id);
?>
<div class="letter_print">
    <hr><br>
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
    <div class="text-center mt-5 pb-1 mb-5 pt-5">
        <p style="font-size:26px; margin-top: -90px;"><span style="border-bottom: 1px solid black; margin-bottom: 3px;"> <span class="red"> बिषय: </span> बिजुली जडान सिफारिस । </span>
        </p>
    </div>
    <div class="row">
        <div class="col-12">
             <p style="font-size:18px; text-align: justify;margin-top:-40px;">
                 <b><?= $org_local_body->name ?></b>
                                वडा नं. <?= $result->ward_no ?> (<?=$result->hal_sabik?>)
                                बस्ने <?=$result->gender_spec?> <b><?= $result->name ?>को </b> नाममा दर्ता कायम रहेको कित्ता नं <b><?= $result->kitta_no ?></b>
                                को जग्गामा मिति <?=$result->nepali_date_1?> मा भवन निर्माण स्वीकृती लिनु भई <?=$result->ghar_sampann?>
                                गर्नु भएको हुदाँ निजलाई 
                               <b><?= $result->ampere ?>
                               </b> एम्पिएर क्षमताको <b><?= $eutype_view->name ?></b> विजुलीको लाइन जडान गरिदिनु हुन सिफारीस साथ अनुरोध गरिन्छ ।
                            </div>
    </div>
    <div class="text-center mt-5">
        
        <div class="col-4 offset-4">
            <p style="font-size:18px;" class="text-center">कित्ता नं को विवरण</p>
            <table class="table table-bordered mt-4 ">
                                    <tr>
                                        <th style="width:5%;">क्र.सं.</th>
                                        <th>कित्ता नं.</th>
                                        <th>घरको प्रकार</th>
                                    </tr>
                                    <tr>
                                        <td>१</td>
                                        <td><?= $result->kitta_no ?></td>
                                        <td><b><?= $house_type_view->name ?></b></td>
                                    </tr>
                                   
                                </table>
        </div>
    </div>
    <div class="space4"> </div>
    <div class="mt-5 pt-3">
        <div class="row">
            <div class="col-3">
                <u>बोधार्थ:- </u><br>
                <div><?=$_POST['name1']?></div>
                <div><?=$_POST['name2']?></div>
                <div><?=$_POST['name3']?></div>
                <div><?=$_POST['name4']?></div>
                <div><?=$_POST['name5']?></div>
            </div>
            <div class="col-3 offset-6 signature">
                <?= $ward_worker->name?><br />
                <?= $worker_post->name?>
            </div>
        </div>
    </div>
</div>