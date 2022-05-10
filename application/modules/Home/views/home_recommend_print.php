<?php
    $local_body     = Modules::run("Settings/getLocal",$result->local_body);
    $state          = Modules::run("Settings/getState",$result->state);
    $ward           = Modules::run("Settings/getWard",$result->ward);
    $district       = Modules::run("Settings/getDistrict",$result->district);
    $old_new_address    = Modules::run("Settings/getOldNewAddress",$result->old_new_address);
    $home_type      =   Modules::run("Settings/getHomeType",$result->home_type);
    $office         = Modules::run("Settings/getOffice",$result->office);
    //print_r($office);
    $current_session    = Modules::run('Settings/getCurrentSession',$result->session_id);
    //print_r($current_session);
    $worker_post        = Modules::run('Settings/getPost',$ward_worker->post_id);
?>
<div class="letter_print">
        <hr>
        <div class="row">
            <div class="col-3 letter-head-left">
                <p style="font-size:18px;"><span class="red"> पत्र संख्या: </span> <?= $current_session->name ?><br></p>
                <p style="font-size:18px;"><span class="red"> चलानी नं.:  </span> <?= $chalani_no ?></p>
            </div>
            <div class="col-3 text-right letter-head-right" style="margin-left: 730px">
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
    <div class="space4"></div>
    <div class="text-center mt-5 mb-5" style="margin-bottom:160px;">
        <p style="font-size:26px; margin-top: -95px;"><span
                    style="border-bottom: 1px solid black; margin-bottom: 3px;"> <span class="red">बिषय:</span> घर कायम सिफारिस। </span>
        </p>
    </div>
    <div class="text-justify">
        <p style="font-size: 18px;">
        <b><?= $local_body->name ?></b> वडा नं <b><?= $ward->name ?></b> (साबिक
        ठेगाना <b><?= $old_new_address->name ?>)</b> अन्तर्गत बस्ने
        <b><?=$result->gender_spec?> <?= $result->applicant_name?></b>को नाममा त्यस कार्यालयमा श्रेस्ता दर्ता कायम रहेको
        निम्नमा उल्लेखित
        जग्गामा घर निर्माण गरि यस वडा
        कार्यालयमा निजले चालु आर्थिक वर्ष सम्मको घरजग्गा कर / सम्पत्ति कर चुक्ता गरिसकेको
        हुनाले निजको जग्गा
        धनी प्रमाणपुर्जामा घर कायम गरि दिनहुन सिफारिस साथ अनुरोध गरिन्छ ।
    </p>
    </div>
    <div class="mt-4 pt-2">
        <table class="table table-bordered text-center mytableborder">
            <thead>
                <tr class="text-bold">
                    <th style="font-size:18px;">क्र.स.</th>
                    <th style="font-size:18px;">
                        वडा नं
                    </th>
                    <th style="font-size:18px;">
                        सिट नं
                    </th>
                    <th style="font-size:18px;">
                        कि नं
                    </th>
                    <th style="font-size:18px;">
                        क्षेत्रफल(रो.आ. पै. दा.)
                    </th>
                    <th style="font-size:18px;">
                        घर नं
                    </th>
                    <th style="font-size:18px;">
                        घरको प्रकार
                    </th>
                    <th style="font-size:18px;">
                        घर निर्माण भएको साल /<br>अनुमति लिएको
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="font-normal">
                    <td class="font-kalimati">
                       <p style="font-size:18px;"> १</p>
                    </td>
                    <td>
                     <p style="font-size:18px;">   <?= (getonlyNumber($old_new_address->new_name));?></p>
                    </td>
                    <td>
                      <p style="font-size:18px;"><?= $result->map_sheet_no ?></p>
                    </td>
                    <td>
                     <p style="font-size:18px;"> <?= $result->kitta_no?></p>
                    </td>
                    <td>
                      <p style="font-size:18px;">  <?= $result->biggha."-".$result->kattha."-".$result->dhur?><?= ($result->land_type=="hill") ? "-".$result->paisa : '' ?></p>
                    </td>
                    <td>
                      <p style="font-size:18px;"><?= $result->home_no ?></p>
                    </td>
                    <td>
                       <p style="font-size:18px;"> <?= $home_type->name ?></p>
                    </td>
                    <td>
                      <p style="font-size:18px;">  <?= $result->home_created_year?></p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="space5"></div>
    <div>
       <div class="row">
           <div class="col-md-3 offset-9 text-center"> 
                <div class="signature">
                   <p style="font-size:18px;"> <?= $ward_worker->name?><br/>
                    <?= $worker_post->name?>
                </p>
                </div>
           </div>
       </div>
    </div>
    
</div>
