<?php
    $old_local_body     = Modules::run("Settings/getLocal",$result->old_local_body);
    $old_state          = Modules::run("Settings/getState",$result->old_state);
    $old_ward           = Modules::run("Settings/getWard",$result->old_ward);
    $old_district       = Modules::run("Settings/getDistrict",$result->old_district);
    $present_local_body     = Modules::run("Settings/getLocal",$result->present_local_body);
    $present_state          = Modules::run("Settings/getState",$result->present_state);
    $present_ward           = Modules::run("Settings/getWard",$result->present_ward);
    $present_district       = Modules::run("Settings/getDistrict",$result->present_district);
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

    <div class="text-center font-28 pt-3 pb-3" style="margin-bottom: 20px;">
        <p style="font-size:26px;"><span style="border-bottom: 1px solid black; margin-bottom: 5px;"><span class="red"> बिषय: </span> आन्तरिक बसाई सराई ।</span>
        </p>
    </div>

    <div>
       <p style="font-size:26px;"> <?=$result->gender_spec?> <?= $result->applicant_name ?> <br>
        <?= $present_local_body->name?>-<?= $present_ward->name?> <br />
        <?= $present_district->name?>, नेपाल</p>

    </div>


    <div class="text-justify" style="margin-top: 10px; text-indent: 150px;">

       <p style="font-size:18px; text-align: justify;"> तपाई <?=$result->gender_spec?> <?= $result->applicant_name ?> <?= count($details) == 1 ? 'एक्लै' : 'तपसिल'?> उल्लेखित परिवार सहित मिति
        <?= $result->from_nepali_date ?> मा
        जिल्ला <?=$old_district->name?> <?= $old_local_body->name ?> वडा नं <?= $old_ward->name ?> बाट
        यस <?= $present_local_body->name ?>
        वडा नं <?= $present_ward->name ?> अन्तर्गत <?=$result->present_tole?> मा
        बसाई
        सरि आउनुभएको व्यहोरा
        प्रमाणित
        गरिन्छ । </p>
    </div>


    <div class="mt-4 text-center font-bold">
        तपसिल
    </div>

    <table class="table letter-table table-bordered text-center mybordertable">
        <thead>
            <tr>
                <th style="font-size:18px;">
                    क्र.स.
                </th>
                <th style="font-size:18px;">
                    नाम थर
                </th>
                <th style="font-size:18px;">
                    निवेदक सँगको नाता
                </th>
                <th style="font-size:18px;">
                    ना. प्र. नं / जन्मदर्ता नं
                </th>
                <th style="font-size:18px;">
                    घर नं
                </th>
                <th style="font-size:18px;">
                    बाटोको नाम
                </th>
                <th style="font-size:18px;">
                    उमेर
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
                $i=1;
                foreach($details as $data) :
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
                    <?= $data->citizenship_no ?>
                </td>
                <td style="font-size:18px;">
                    <?= $data->ghar_no ?>
                </td>
                <td style="font-size:18px;">
                    <?= $data->road_name ?>
                </td>
                <td style="font-size:18px;">
                    <?= $data->age ?>
                </td>
            </tr>
            <?php $i++; endforeach;?>
        </tbody>
    </table>

    <div class="space4"> </div>

    <div class="row">
        <div class="col-3">
            <div class="signature" style="margin-top:100px;">
                <?= $ward_worker->name?><br />
                 <?= $worker_post->name?>
            </div>
        </div>
        <div class="col-3 offset-6">
            <div style="border: solid 2px; width:200px; height:100px;">

            </div>
            <div class="text-center">
                कार्यालयको छाप
            </div>
        </div>
    </div>
</div>
