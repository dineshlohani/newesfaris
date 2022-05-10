<?php
   $a_local_body     = Modules::run("Settings/getLocal",$result->a_local_body);
    $l_local_body     = Modules::run("Settings/getLocal",$result->l_local_body);
    $a_state          = Modules::run("Settings/getState",$result->a_state);
    $l_state          = Modules::run("Settings/getState",$result->l_state);
    $a_ward           = Modules::run("Settings/getWard",$result->a_ward);
    $l_ward           = Modules::run("Settings/getWard",$result->l_ward_no);
    $a_district       = Modules::run("Settings/getDistrict",$result->a_district);
    $l_district       = Modules::run("Settings/getDistrict",$result->l_district);
    if(!empty($result->documents))
    {
        $documents      = explode("+",$result->documents);
    }
     $path           = base_url()."assets/documents/land/lalpurja/";
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
    <div class="col-3 text-right letter-head-right" style="margin-left: 650px">
                <div class="myclear"> </div>
                 <p style="font-size:18px; margin-top: -39px; margin-right: -72px;"><span class="red"> मिति : </span> <?= $chalani_result->nepali_chalani_miti?></p>
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
    <div class="text-center font-26" style="margin-top: 20px; margin-bottom: 20px;">
       <p style="font-size:26px;">
            <span style="border-bottom: 1px solid black; margin-bottom: 5px;"> <span class="red"> बिषय : </span> सिफारिस सम्बन्धमा ।
            </span>
        </p>
    </div>
    <div class="text-justify"></div>
   <p style="font-size:18px; text-align: justify;">प्रस्तुत विषयमा <?= SITE_DISTRICT?> जिल्ला <b><?= $l_local_body->name;?>
                            </b> वडा नं. <?=$l_ward->name?> (<?=$result->l_old_place?>) निवासी <?=$result->gender_spec?> <b><?=$result->applicant_name?>
                                </b>को नाममा समेत <?=$result->lo_type?> दर्ता श्रेस्ता भएको निम्न व्यहोरा भएको जग्गाको जग्गाधनी प्रमाण
                                पूर्जा <?=$result->copy_reason?> हुदाँ सोको प्रतिलिपीको सिफारीस पाउँ भनी यस वडा कार्यालयमा
                                निवेदन दिनु भएको हुदाँ सो सम्बन्धमा त्यहाँको कार्यालयको अभिलेख अनुसार जग्गाधनी 
                                प्रमाण पूर्जामा फोटो टाँस गरी नागरीकता प्रमाणपत्र नं. <?=$result->citizenship_no?>
                                समेत उल्लेख गरी प्रतिलिपी सिफारिस गराइ दिनुहुन सिफारिस गरीन्छ । </p>
                            </div> 
<br> 
<table class="table-bordered table-responsive">
    <thead>
        <th style="width: 8.33%" style="font-size:18px;">साबिकको ठेगाना</th>                                
        <th style="font-size:18px;">हालको ठेगाना</th>                                
        <th style="font-size:18px;">कित्ता नं</th>                                
        <th style="font-size:18px;">क्षेत्रफल (रो.आ.पै.दा.)</th>                               
        <th style="font-size:18px;">कैफियत</th>                               
    </thead>
    <tbody>
        <td style="font-size:18px;"><?=$result->l_old_place?></td>
        <td style="font-size:18px;"><?=$result->a_old_place?></td>
        <td style="font-size:18px;"><?=$result->kitta_no?></td>
        <td style="font-size:18px;"><?=$result->biggha."-".$result->kattha."-".$result->dhur?><?= ($result->land_type=="hill") ? "-".$result->paisa : '' ?></td>
        <td style="font-size:18px;"></td>
    </tbody>
</table>  
<br>
    <div style="line-height: 1.6" class="mt-4">
        <div class="text-left"><strong> <u>जग्गाको विवरण</u></strong></div>
       <span style="font-size: 18px;">निवेदक: <?=$result->gender_spec?> <?=$result->applicant_name?></span> <br>
       
       <span style="font-size: 18px;"> जारि जिल्ला: <?=$result->jari_jilla ?></span><br>

       <span style="font-size: 18px;"> ना.प्र.नं.: <?=$result->citizenship_no ?></span><br>

        <span style="font-size: 18px;">जरिमिति: <?=$result->nep_citizenship_date ?></span><br>

        <span style="font-size: 18px;">पिता: <?=$result->father_name  ?></span><br>

        <span style="font-size: 18px;">बाजे: <?=$result->grandfather_name ?></span><br>
    </div>
    <div class="mt-3">
        <div class="row">
            <div class="space4"> </div>
            <div class="offset-9 col-3 signature">
                <?= $ward_worker->name?><br />
                 <?= $worker_post->name?>
            </div>
        </div>
    </div>
</div>