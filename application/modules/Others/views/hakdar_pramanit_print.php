<?php
    $local_body     = Modules::run("Settings/getLocal",$result->local_body);
    $state          = Modules::run("Settings/getState",$result->state);
    $ward           = Modules::run("Settings/getWard",$result->ward);
    $district       = Modules::run("Settings/getDistrict",$result->district);
    $relation       = Modules::run("Settings/getRelation",$result->relation);
    $home_type      = Modules::run("Settings/getHomeType",$result->home_type);
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
            <div class="col-3 text-right letter-head-right" style="margin-left: 719px">
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
    <div class="text-center font-26" style="margin-top: 100px;">
        <p style="font-size:26px;"><span style="border-bottom: 1px solid black; margin-bottom: 5px;"> बिषय : सिफारिस सम्बन्धमा ।</span>
        </p>
    </div>
    <div class="text-justify mt-5">
         <p style="font-size:18px; text-align: justify;">उपरोक्त सम्बन्धमा <b><?= $local_body->name ?></b> वडा नं <b><?= $ward->name ?>
        (साबिकको ठेगाना
        <?= $result->old_place ?>)</b> बस्ने
        <?php if ($gender!=1) {
            echo श्री;
        }else{
            echo सुश्री;
        }
        ?>
        <b><?= $result->applicant_name ?></b> ले हकदार प्रमाणित गरी पाउँ भनी यस
        वडा कार्यालयमा निवेदन दिनुभएको हुँदा सो सम्बन्धमा <b><?= SITE_OFFICE ?></b> बाट मिति
        <b><?= $result->nep_darta_date ?></b> मा गरिएको
        द.नं. <b><?= $result->darta_no ?></b> को नाता प्रमाणित प्रमाणपत्र अनुसार मृतक
        <?php if ($gender!=1) {
            echo श्री;
        }else{
            echo सुश्री;
        }
        ?>
        <b><?= $result->mritak_ko_name ?></b> का हकदारहरु देहाय बमोजिम उल्लेखित 1
        जना मात्र भएको व्यहोराको
        सिफारिस गरिन्छ । </p>
    </div>
    <div class="mt-3 mb-2 font-bold text-center">
        <div class="b">मृतकका हकदारको विवरण</div>
    </div>

    <table class="table table-bordered mybordertable">
        <thead>
            <th style="font-size:18px;">क्र.सं</th>
            <th style="font-size:18px;">हकदारहरुको नाम</th>
            <th style="font-size:18px;">नाता</th>
            <th style="font-size:18px;">बाबु/पति को नाम</th>
            <th style="font-size:18px;">नागरिकता नं</th>
            <th style="font-size:18px;">घर नं</th>
            <th style="font-size:18px;">किता नं</th>
            <th style="font-size:18px;">घरको प्रकार</th>
        </thead>
        <tbody>
            <td style="font-size:18px;">
                १
            </td>
            <td style="font-size:18px;">
                <?= $result->hakdar_ko_name ?>
            </td>
            <td style="font-size:18px;">
                <?= $relation->name ?>
            </td>
            <td style="font-size:18px;">
                <?= $result->father_husband_name ?>
            </td>
            <td style="font-size:18px;">
                <?= $result->citizenship_no ?>
            </td>
            <td style="font-size:18px;">
                <?= $result->ghar_no ?>
            </td>
            <td style="font-size:18px;">
                <?= $result->kitta_no ?>
            </td>
            <td style="font-size:18px;">
                <?= $home_type->name ?>
            </td>
        </tbody>
    </table>
    <div class="space5"></div>
    <div class="mt-5 pt-5">
        <div class="row">

            <div class="offset-9 col-3 signature">
                <?= $ward_worker->name?><br />
                <?= $worker_post->name?>
            </div>
        </div>
    </div>
</div>