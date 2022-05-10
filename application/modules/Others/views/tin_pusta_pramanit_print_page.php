<?php
$local_body     = Modules::run("Settings/getLocal",$result->local_body);
$state          = Modules::run("Settings/getState",$result->state);
$ward           = Modules::run("Settings/getWard",$result->ward);
$district       = Modules::run("Settings/getDistrict",$result->district);
$old_new_address      = Modules::run("Settings/getOldNewAddress",$result->old_new_address);

$relation1  = Modules::run('Settings/getRelation', $result->relation_1);
$relation2  = Modules::run('Settings/getRelation', $result->relation_2);
$relation3  = Modules::run('Settings/getRelation', $result->relation_3);
$citizenship_district_1 = Modules::run("Settings/getDistrict",$result->citizenship_district_1);
$citizenship_district_2 = Modules::run("Settings/getDistrict",$result->citizenship_district_2);
$citizenship_district_3 = Modules::run("Settings/getDistrict",$result->citizenship_district_3);
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
if(!empty($result->documents))
{
    $documents      = explode("+",$result->documents);

}
$path           = base_url()."assets/documents/others/tin_pusta_pramanit/";
$current_session    = Modules::run('Settings/getCurrentSession',$result->session_id);

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
                <p style="font-size:18px; "><span class="red"> मिति : </span> <?= $chalani_result->nepali_chalani_miti?></p>
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
    <div class="text-center font-28" style="margin-bottom: 40px;">
       <p style="font-size:26px;"><span style="border-bottom: 1px solid black; margin-bottom: 5px;"> <span class="red"> बिषय : </span> तीन पुस्ते प्रमाणित ।</span>
        </p>
    </div>

    <div class="text-justify">

         <p style="font-size:18px; text-align: justify;">
              प्रस्तुत बिषयमा <b><?= $local_body->name ?></b> वडा नं <b><?= $ward->name ?> (साबिकको ठेगाना
                                <?= $old_new_address->name ?>)</b> निवासी 
                                <?php if ($gender!=1) {
                                    echo श्री;
                                }else
                                {
                                  echo सुश्री;  
                                }
                                ?>
                                <?= $result->applicant_name ?>को तीन पुस्ते तपसिलमा उल्लेख भए अनुसार
                                रहेको व्यहोरा प्रमाणित साथ अनुरोध गरिन्छ । साथै निजको नाममा मालपोत कार्यालयमा दर्ता रहेको जग्गाको विवरण तपसिल बमोजिम रहेको व्यहोरा
                                समेत अनुरोध गरिन्छ ।</p>
                            </div>


    
    <div class="mt-4 text-center font-bold">
        तीन पुस्ते विवरण
    </div>
     <table class="table letter-table table-bordered mt-4">
        <thead>
        <tr>
            <th class="text-center"style="font-size:18px; text-align: justify;">क्र.स.</th>
            <th class="text-center"style="font-size:18px; text-align: justify;">नाम</th>
            <th class="text-center"style="font-size:18px; text-align: justify;">नाता</th>
            <th class="text-center"style="font-size:18px; text-align: justify;">नागरिकता नं.</th>
            <th class="text-center"style="font-size:18px; text-align: justify;">जारी मिति</th>
            <th class="text-center"style="font-size:18px; text-align: justify;">जिल्ला</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td style="font-size:18px; text-align: justify;">१</td>
            <td style="font-size:18px; text-align: justify;"><?= $result->name_1?> </td>
            <td style="font-size:18px; text-align: justify;">
                <?= $result->relation_1?>
            </td>
            <td style="font-size:18px; text-align: justify;"><?= $result->citizenship_no_1?></td>
            <td style="font-size:18px; text-align: justify;"><?= $result->citizenship_date_1 ?></td>
            <td style="font-size:18px; text-align: justify;"><?= $citizenship_district_1->name ?></td>
        </tr>
        <tr>
            <td style="font-size:18px; text-align: justify;">२</td>
            <td style="font-size:18px; text-align: justify;"><?= $result->name_2?> </td>
            <td style="font-size:18px; text-align: justify;">
                <?= $result->relation_2?>
            </td>
            <td style="font-size:18px; text-align: justify;"><?= $result->citizenship_no_2?></td>
            <td style="font-size:18px; text-align: justify;"><?= $result->citizenship_date_2 ?></td>
            <td style="font-size:18px; text-align: justify;"><?= $citizenship_district_2->name ?></td>
        </tr>
        <tr>
            <td style="font-size:18px; text-align: justify;">३</td>
            <td style="font-size:18px; text-align: justify;"><?= $result->name_3?> </td>
            <td style="font-size:18px; text-align: justify;">
                <?= $result->relation_3?>
            </td>
            <td style="font-size:18px; text-align: justify;"><?= $result->citizenship_no_3?></td>
            <td style="font-size:18px; text-align: justify;"><?= $result->citizenship_date_3 ?></td>
            <td style="font-size:18px; text-align: justify;"><?= $citizenship_district_3->name ?></td>
        </tr>
        </tbody>
    </table>

    <div class="mt-4 text-center font-bold">
        जग्गाको विवरण
    </div>
   
   <table class="table letter-table table-bordered mt-4">
        <thead>
        <tr>
            <th class="text-center" style="font-size:18px; text-align: justify;">क्र.स.</th>
            <th class="text-center" style="font-size:18px; text-align: justify;">कित्ता नं.</th>
            <th class="text-center" style="font-size:18px; text-align: justify;">सिट नं.</th>
            <th class="text-center" style="font-size:18px; text-align: justify;">क्षेत्रफल</th>
        </tr>
        </thead>
        <tbody>

        <?php $i =1; foreach($details as $data): ?>
            <tr>
                <td style="font-size:18px; text-align: justify;"><?= $i?></td>
                <td style="font-size:18px; text-align: justify;"><?= $data->kitta_no?></td>
                <td style="font-size:18px; text-align: justify;"><?= $data->sheet_no ?></td>
                <td style="font-size:18px; text-align: justify;"><?= $data->biggha.'-'.$data->kattha.'-'.$data->dhur?><?= $result->land_type =='hill' ? '-'.$data->paisa : ''?></td>
            </tr>
            <?php $i++; endforeach;?>

        </tbody>
    </table>

    <div class="space3"></div>
    <div class="col-3 offset-9 signature">
        <div>
            <?= $ward_worker->name?><br />
            <?= $worker_post->name?>
        </div>
    </div>
</div>