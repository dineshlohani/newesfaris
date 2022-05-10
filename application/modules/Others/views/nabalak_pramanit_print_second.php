<?php
 $p_local_body     = Modules::run("Settings/getLocal",$result->p_local_body);
    $p_ward           = Modules::run("Settings/getWard",$result->p_ward);
    $p_state          = Modules::run("Settings/getState",$result->p_state);
    $p_district     = Modules::run("Settings/getDistrict",$result->p_district);
     $birthdate_eng = explode("-",$result->eng_dob);
     $current_session    = Modules::run('Settings/getCurrentSession',$result->session_id);
$worker_post        = Modules::run('Settings/getPost',$ward_worker->post_id);
     ?>
<div class="letter_print">

    <div>
        <div class="text-center"><p style="font-size:18px;"><u><strong>पालिकाको सिफारिस</strong></u></p></div>
        <div class="text-justify mt-5">
            <p style="font-size:18px; text-align: justify;"><?=$p_district->name?> जिल्ला <?=$p_local_body->name." वडा नं ".$p_ward->name?>( साबिकको
            ठेगाना ............... ) वडामा स्थायी बसोबास गरि बस्ने यसमा
            लेखिएको
            श्री/सुश्री/श्रीमती <?= $result->applicant_name ?> को
            सम्बन्ध श्री/सुश्री/श्रीमती <?=$result->nep_first_name.' '.$result->nep_middle_name.' '.$result->nep_last_name ?> लाई म
            राम्ररी
            चिन्दछु। माथि लेखिए बमोजिम निजको
            व्यहोरा मैले
            बुझेसम्म साँचो हो। निजलाई नाबालक परिचयपत्र उपलब्ध गराउने सिफारिस
            गर्दछु।
            उक्त्त्त विवरण झुठ्ठा ठहरे
            कानुन बमोजिम सहुँला बुझाउला।</p>
        </div>
    </div>
    <div class="space3"></div>
    <div class="row mt-5">
        <div class="col-4">
            <div class=""> मिति :- </div>
            <div class=""> कार्यालयको छाप :- </div>
        </div>
        <div class="col-3 offset-5">
            <div class="b"> सिफारिस गर्नेको :- </div>
            <div class="my-3">
     
            </div>
            <div class="mt-5 signature">
                
                <?= $ward_worker->name?><br/>
                <?= $worker_post->name?>
            </div>
        </div>
    </div>
</div>
