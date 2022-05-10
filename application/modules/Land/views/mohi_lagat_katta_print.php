<?php
   $local_body     = Modules::run("Settings/getLocal",$result->local_body);
    $ward           = Modules::run("Settings/getWard",$result->ward);
    $state          = Modules::run("Settings/getState",$result->state);
     $district       = Modules::run("Settings/getDistrict",$result->district);

    if(!empty($result->documents))
    {
        $documents      = explode("+",$result->documents);

    }
    $path           = base_url()."assets/documents/land/mohi/";
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
    <div class="col-3 text-right letter-head-right" style="margin-left: 600px">
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

    <div class="text-center font-28" style="margin-top: 70px; margin-bottom: 70px;">
        <p style="font-size:26px;">
            <span style="border-bottom: 1px solid black; margin-bottom: 5px;"> <span class="red"> बिषय : </span> सिफारिस सम्बन्धमा ।
            </span>

        </p>
    </div>


    <div class="text-justify">
       <p style="font-size:18px; text-align: justify;">उपरोक्त सम्बन्धमा मेरो नाममा दर्ता श्रेष्ता भएको <?= $local_body->name.", वार्ड-".$ward->name?>
                            (साबिकको ठेगाना <?=$result->old_place ?>) स्थित
                            सिट
                            नं. <?=$result->map_sheet_no?> को
                            कि.नं. <?=$result->kitta_no?>
                            क्षे.फ. <?=$result->biggha."-".$result->kattha."-".$result->dhur?><?= ($result->land_type=="hill") ? "-".$result->paisa : '' ?> भएको जग्गाधनी श्रेष्ता पुर्जाको मोही
                            <?=$result->gender_spec_1?> <?=$result->mohi_name?> कायम भएको र मोहीले जोत कमोद केहि नगरेकोले
                            मोही
                            लागत
                            कट्टा गर्न मोही
                            स्वंयको मञ्जुरी सनाखत रहेकाले मोही लागत कट्टाको लागि सिफारिस गरी पाउँ भनी जग्गाधनी
                            <?=$result->gender_spec?> <?=$result->land_owner_name?> ले यस वडा कार्यालयमा निवेदन दिनु
                            भएकोमा
                            सो
                            सम्बन्धमा
                            मिति <?=$result->nepali_visit_date ?> मा गरिएको सर्जमिन तथा मोही स्वंयको
                            मञ्जुरी
                            सनाखतको आधारमा त्यस
                            कार्यालयको नियमानुसार मोही लागत कट्टा गरिदिनुहुन सिफारिस गरिन्छ । </p>
                        </div>


    <div class="mt-5 pt-5">
        <div class="row">
            <div class="space4"></div>
            <div class="offset-9 col-3 signature">
                <?= $ward_worker->name?><br />
                <?= $worker_post->name?>
            </div>
        </div>
    </div>
</div>