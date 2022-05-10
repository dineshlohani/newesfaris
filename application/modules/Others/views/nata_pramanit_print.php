<?php
$local_body     = Modules::run("Settings/getLocal",$result->local_body);
$state          = Modules::run("Settings/getState",$result->state);
$ward           = Modules::run("Settings/getWard",$result->ward);
$district       = Modules::run("Settings/getDistrict",$result->district);
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
     <div class="col-3 text-right letter-head-right" style="margin-left: 605px">
        <div class="myclear"> </div>
        <p style="font-size:18px; margin-top: -39px;"> <span class="red"> मिति : </span> <?= $chalani_result->nepali_chalani_miti?></p>
    </div>
</div>
<div class="col-md-4">
    
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
<div class="text-center font-26" style="margin-bottom: 20px;">
 <p style="font-size:26px;"><span class="red" style="border-bottom: 1px solid black; margin-bottom: 5px;">नाता प्रमाणित प्रमाणपत्र</span>
 </p>
</div>
<div style="font-size:18px;margin-top:5px;"> <?=$result->gender_spec?> <?= $result->applicant_name ?> <br>
        <?= $local_body->name ?> वडा नं <?= $ward->name  ?>
    </div>
    <div class="text-justify" style="margin-top: 5px; text-indent: 50px;">
       <p style="font-size:18px; text-align: justify;">
        प्रस्तुत बिषयमा देहायका व्यक्तिसँग देहाय बमोजिमको नाता  सम्बन्ध  कायम रहेको सो नाता सम्बन्ध प्रमाणित गरी
                            पाउँ
                            भनी 
                            न.प्र.नं <?=$result->cit_no?>
                            का <?=$result->gender_spec?> <?= $result->applicant_name ?>
                            <b><?= SITE_OFFICE ?></b>
                            <?=$this->session->userdata('ward_no')?> नं वडा कार्यालयमा
                            मिति <?= $result->nepali_date ?> मा दिनुभएको दरखास्त बमोजिम यस कार्यालयबाट आवश्यक जाँचबुझ गरी बुझ्दा तपाईको देहाय 
                            बमोजिमको व्यक्तिसँग देहाय बमोजिमको नाता सम्बन्ध कायम रहेको देखिएकोले <?=$this->session->userdata('ward_no')?></b> नं वडा 
                            कार्यालयवाट प्राप्त सिफारीस पत्रको आधारमा तपाइको तथा तपाइको सबै नातेदारहरुको फोटो तथा रेखांत्मक सहिछाप प्रमाणित गरी स्थानीय सरकार  
                            सञ्चालन ऐन 
                            २०७४ परिच्च्छेद-३ दफा १२ को उपदफा ङ १ बमोजिम नाता प्रमाणित गरी यो प्रमाणपत्र दिइएको छ ।
                        </p>
</div>
<table class="table letter-table table-bordered mybordertable mt-4">
    <thead>
        <tr>
            <th style="width:5%; font-size:18px;">
                क्र.स.
            </th>
            <th style="font-size: 18px;">
                नाता सम्बन्ध कायम गरेको व्यक्तिको नाम
            </th>
            <th style="font-size: 18px;">
                नाता
            </th>
            <th style="font-size: 18px;">
                नागरिकता नं
            </th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        foreach($details as $data) :
            $relation = Modules::run("Settings/getRelation",$data->relation);
            ?>
            <tr>
                <td style="font-size: 18px;"><?= $i ?></td>
                <td style="font-size: 18px;"><?= $data->name ?> <?php if(!empty($data->death_date)){ ?> (<?php echo $data->death_date;?>)<?php } ?> </td>
                
                <td style="font-size: 18px;"><?= $relation->name ?></td>
                <td style="font-size: 18px;"><?=$data->add_cit_no?></td>
            </tr>
            <?php $i++; endforeach;?>
        </tbody>
    </table>
    <div class="mt-3 mb-5 font-bold">
        <p style="font-size: 18px;">दरखास्तवालाको दस्तखत :-</p>
    </div>
    <div class="row">
        <div class="col-4">
            <div class="text-center b" style="margin-top: -36px;"> ल्याप्चे सहिछाप </div>
            <table class="finger-table text-center table">
                <tr>
                    <td>
                        दायाँ
                    </td>
                    <td>
                        बायाँ
                    </td>
                </tr>
                <tr>
                    <td style="width:150px; height: 150px;">
                    </td>
                    <td style="width:150px; height: 150px;">
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-3" style="margin-left:380px;">
            <div class="photo_box"> <span> फोटो </span> <br><br><span>(आवेदक)</span></div>
        </div>
        <div class="col-md-12">
            <div class="font-bold">नाता कायम भएको व्यक्तिको फोटो</div>
            <?php foreach($details as $data): 
            $relation = Modules::run("Settings/getRelation",$data->relation);
            ?>
                <div class="photo_box"> <span> फोटो </span><br><br><span>(<?=$relation->name?>)</span></div>
            <?php endforeach; ?>
            <div class="myclear"></div>
        </div>
        <div class="col-md-3 offset-9 signature">
            <div>
                <?= $ward_worker->name?><br />
                <?= $worker_post->name?>
            </div>
        </div>
    </div>
</div>
