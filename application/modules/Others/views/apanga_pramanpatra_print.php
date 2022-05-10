<?php
    $local_body     = Modules::run("Settings/getLocal",$result->local_body);
    $state          = Modules::run("Settings/getState",$result->state);
    $ward           = Modules::run("Settings/getWard",$result->ward);
    $district       = Modules::run("Settings/getDistrict",$result->district);
    $old_place      = Modules::run("Settings/getOldNewAddress",$result->old_place);
    $disable_type   = Modules::run("Settings/getDisableType",$result->disable_type);
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
       <p style="font-size:26px;"><span style="border-bottom: 1px solid black; margin-bottom: 5px;"> <span class="red"> बिषय : </span> सिफारिस सम्बन्धमा ।</span>
        </p>
    </div>
      <!--   <p style="font-size:18px; text-align: justify;">
            <span style="border-bottom: 1px solid black; margin-bottom: 5px;"> <span class="red"> बिषय :  </span>सिफारिस सम्बन्धमा ।
            </span>

        </p> -->
   
    <div class="text-justify">
        <p style="font-size:18px; text-align: justify;">उपरोक्त सम्बन्धमा <b><?= $local_body->name ?></b> वडा नं. <b><?= $ward->name ?></b> (
        साबिकको
        ठेगाना <b><?= $old_place->name ?></b>)
        बस्ने 
        <?php if ($result->gender==1) {
            echo "श्री";
        }else{
            echo "श्रीमती";
        }?>
        <b><?= $result->applicant_name ?>,
        <?= $disable_type->name ?></b> अपाङ्ग भएकोले अपाङ्ग परिचय
        पत्र
        बनाउनको लागि
        "सिफारिस गरी पाउँ" भनी यस वडा कार्यालयमा पर्न आएको निवेदन सम्बन्धमा त्यहाँको
        नियमानुसार
        अपाङ्ग परिचयपत्रको
        लागि सिफारिस गरिन्छ । </p>
    </div>
    <div class="mt-5 pt-3">
        <div class="row">
            <div class="space5"></div>
            <div class="offset-9 col-3 signature">
                <?= $ward_worker->name?><br />
                <?= $worker_post->name?>
            </div>
        </div>
    </div>
</div>

