<?php
    $local_body     = Modules::run("Settings/getLocal",$result->local_body);
    $state          = Modules::run("Settings/getState",$result->state);
    $ward           = Modules::run("Settings/getWard",$result->ward);
    $district       = Modules::run("Settings/getDistrict",$result->district);
    $court       = Modules::run("Settings/getDistrict",$result->court_name);
    $old_place = Modules::run("Settings/getOldNewAddress",$result->old_place);

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

    <div class="text-center font-28 mt-5 pb-5 mb-3 pt-5" style="margin-top: 70px; margin-bottom: 70px;">
       <p style="font-size:26px;">
            <span style="border-bottom: 1px solid black; margin-bottom: 5px;"> <span class="red"> बिषय : </span> सिफारिस सम्बन्धमा ।
            </span>
        </p>
    </div>
    <div class="text-justify">
        <p style="font-size:18px; text-align: justify;">
       उपरोक्त सम्बन्धमा वडा नं. <b><?= $ward->name ?></b> (साबिकको
                            ठेगाना <b>
                            <?= $old_place->name ?></b> )
                            बस्ने
                            <?php
                            if($result->gender==1){
                                echo "श्री";
                            }else{
                                echo "श्रीमती";
                            }?>
                            <b><?= $result->applicant_name ?></b> ले
                            <?php
                            if($result->gender==1){
                                echo "पत्नी श्रीमती";
                            }else{
                                echo "पति श्रीमान";
                            }?>
                            <b><?= $result->husband_wife_name ?></b> सँग
                            श्री <b><?= $court->name ?></b> जिल्ला अदालतमा <b><?= $result->case_type ?></b> मुद्दा चलिरहेकोमा
                            आयश्रोत
                            केही नभई आर्थिक
                            अवस्था कमजोर भई कोर्ट -फि राख्न असमर्थ भएकोले तत्कालको लागि कोर्ट-फि नराखी पछि
                            मुद्दा
                            फैसला भएपछि उक्त कोर्ट
                            -फि लिने गरी आवश्यक कारवाहीको लागि "सिफारिस गरी पाउँ " भनी यस वडा कार्यालयमा निवेदन
                            दिनुभएको हुँदा सो
                            सम्बन्धमा मिति <b><?= $result->nepali_visit_date ?></b> मा गरिएको सर्जमिन अनुसार
                            व्यहोरा
                            मनासिब बुझिएकोले त्यहाँको नियमानुसार
                            गरिदिनुहुन सिफारिस गरिन्छ ।
                        </div>
    <div class="space5"> </div>
    <div class="mt-5 pt-5">
        <div class="row">
            <div class="offset-9 col-3 signature">
                 <p style="font-size:18px; text-align: justify;"><?= $ward_worker->name?><br />
                <?= $worker_post->name?></p>
            </div>
        </div>
    </div>
</div>
