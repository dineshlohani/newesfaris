<div class="letter_print">
    <hr>
    <div class="row">
        <div class="col-3 letter-head-left">
            <p style="font-size:18px;"><span class="red"> पत्र संख्या: </span> <?= $current_session->name ?><br></p>
            <p style="font-size:18px;"><span class="red"> चलानी नं.:  </span> <?= $chalani_no ?></p>
        </div>
        <div class="col-3 text-right letter-head-right" style="margin-left: 704px">
            <div class="myclear"> </div>
            <p style="font-size:18px; margin-top: -39px;"><span class="red"> मिति : </span> <?= $chalani_result->nepali_chalani_miti?></p>
        </div>
    </div>
</div>

<div class="text-center font-28 pt-3 pb-3" style="margin-bottom: 20px;">
    <p style="font-size:26px;"><span style="border-bottom: 1px solid black; margin-bottom: 5px;"><span class="red"> बिषय: </span> सेवा करार नियुक्ति सम्बन्धमा ।</span>
    </p>
</div>
<div class="space2"> </div>
<div>
    <p style="font-size:18px;"><b><?= $result->position?> <?php echo $result->gender?>
    <?= $result->name ?></b><br>
    <?= SITE_OFFICE ?><br>
    <?= SITE_PALIKA?> <br>
    <?= SITE_ADDRESS?>,<?= SITE_DISTRICT ?> । <br></p>
</div>

<div class="space1"> </div>
<div class="text-justify" style="margin-top: 10px; text-indent: 150px;">
   <p style="font-size:18px; text-align: justify;">    तपाईलाई <b><?= $result->reason_for?></b>, <b><?= $result->yain?></b> बमोजिम <b><?= $result->responsbility?></b> लगायत कामका लागि <b><?= $result->assigned_sakha?></b>मा <b><?= $result->position?></b> पदको कामकाज गर्ने गरी यसैसाथ संलग्न करार सम्झौता बमोजिम मिति <b><?= $result->niyukta_miti?></b> गते देखि <b><?= $result->karar_period?></b> सम्म सेवा करारमा नियुक्ति गरिएको हुँदा संलग्न कार्यशर्त अनुरुप आफ्नो काम इमान्दारी पूर्वक र व्यवसायिक मूल्य मान्यता अनुरुप गर्नुहुन जानाकारी गराईन्छ । साथै आफ्नो काम कर्तव्य पालना गर्दा यस गाउँपालिकाको कर्मचारीले पालना गर्नुपर्ने आचार संहिता र आचरणको समेत परिपालना गर्नु हुन सूचित गरिन्छ  ।</p>
</div>

<?php if(!empty($bod)) : ?>
<div class="row">
    <div class="col-md-4">
        <div class="text-justify  mt-5" style="margin-right:-136px;">
            <h4 class="font-underline">बोद्यार्थ</h4>
                foreach($bod as $bd) : ?>
                    <div class="clearfix"></div>
                    <?php echo $bd->name?>
                <?php endforeach;?>
            </div>
        </div>
    </div>
<?php endif;?>
<div class="space4"> </div>

 <div class="mt-5 pt-5" style="font-size: 18px">
        <div class="row">
            <div class="space4"> </div>
            <div class="offset-9 col-3 signature">
                <?= $workers->name?><br />
                <?= $post->name?>
            </div>
        </div>
    </div>