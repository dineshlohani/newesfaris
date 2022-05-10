<?php

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
    <div class="text-center font-28 mt-5 pb-5 mb-5 pt-5" style="margin-top: 20px; margin-bottom: 50px;">
        <p style="font-size:26px;">
            <span style="border-bottom: 1px solid black; margin-bottom: 5px;"><span class="red">  बिषय:</span> खुलाई पठाएको ।
            </span>

        </p>
    </div>

    <div class="text-justify" style="text-indent: 150px;">
        <p style="font-size:18px; text-align: justify;">तहाँ सम्मानित अदालतको मिति <b><?= $result->nepali_chalani_date ?></b>
        च.नं. <b><?= $result->chalani_no ?></b> को पत्रानुसार यस वडा कार्यालयबाट प्रविधिक
        मुल्यांकन गरी यसै पत्र साथ कार्यरत प्राविधिकको सक्कल प्रतिबेदन संलग्न राखी पठाईएको
        व्यहोरा अनुरोध छ।</p>
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
