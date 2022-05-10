<?php
   $local_body     = Modules::run("Settings/getLocal",$result->local_body);
    $ward           = Modules::run("Settings/getWard",$result->ward);
    $state          = Modules::run("Settings/getState",$result->state);
     $district       = Modules::run("Settings/getDistrict",$result->district);

    if(!empty($result->documents))
    {
        $documents      = explode("+",$result->documents);

    }
    $path           = base_url()."assets/documents/land/bato/";
    $current_session    = Modules::run('Settings/getCurrentSession',$result->session_id);
    $worker_post        = Modules::run('Settings/getPost',$ward_worker->post_id);

  if($result->direction=="East")
    {
        $direction = "पूर्व ";
    }
    if($result->direction=="West")
    {
        $direction = "पश्चिम";
    }
    if($result->direction=="North")
    {
        $direction ="उत्तर ";
    }
    if($result->direction=="South")
    {
        $direction = "दक्षिण ";
    }
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
        <br>
    <div class="col-md-4" style="font-size: 18px">
        <?php
        $this_office   = Modules::run('Settings/getOffice', $print_office->id);
        ?>
        <div class='row'>
            <?= !empty($this_office->sambodhan) ? $this_office->sambodhan."," : ''?>
        </div>
        <div class="row">
            <?= $this_office->name?>,
        </div>
        <div class="row">
            <?= !empty($this_office->address) ? $this_office->address."" : ''?>
        </div>

    </div>
    <div class="text-center font-28" style="margin-top: 70px; margin-bottom: 70px;">
        <h4>
            <span style="border-bottom: 1px solid black; margin-bottom: 5px;"> <span class="red"> बिषय :</span> बाटो कायम सिफारिस सम्बन्धमा ।
            </span>

        </h4>
    </div>


    <div class="text-justify">
        <p style="font-size:18px; text-align: justify;">उपरोक्त सम्बन्धमा मेरो नाममा दर्ता श्रेष्ता भएको <b><?= $local_body->name.", वार्ड-".$ward->name?></b>(साबिकको
        ठेगाना <b><?=$result->old_place ?>)</b>
        कि.नं. <b><?=$result->kitta_no?></b> को
        क्षे.फ. <b><?=$result->biggha."-".$result->kattha."-".$result->dhur?><?= ($result->land_type=="hill") ? "-".$result->paisa : '' ?></b>
        जग्गामध्ये
        <?=$direction?>बाट <b><?=$result->road_width?></b> चौडाई
        र <b><?=$result->road_length?></b> फिट लम्बाई नेपाल सरकारको नाममा कित्ताकाट गरी
        नेपाल
        सरकारको नाममा बाटो
        कायम गर्न सिफारिस गरी पाउँ भनी जग्गाधनी
        <?=$result->gender_spec?> <b><?=$result->land_owner_name?></b>
        ले यस
        वडा कार्यालयमा
        निवेदन दिनुभएको हुँदा सो सम्बन्धमा प्राविधिक प्रतिवेदन अनुसार कित्ताकाट गर्न मिल्ने
        देखिएकोले प्राविधिक
        फिल्ड निरीक्षण प्रतिवेदन सहित पठाईएको छ । त्यहाँको नियमानुसार नेपाल सरकारको नाममा
        बाटो
        कायम
        गरिदिनुहुन
        सिफारिस गरिन्छ ।</p>
    </div>


    <div class="mt-5 pt-5" style="font-size: 18px">
        <div class="row">
            <div class="space4"> </div>
            <div class="offset-9 col-3 signature">
                <?= $ward_worker->name?><br />
                <?= $worker_post->name?>
            </div>
        </div>
    </div>
</div>

