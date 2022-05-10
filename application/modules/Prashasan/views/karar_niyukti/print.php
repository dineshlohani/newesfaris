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
    <p style="font-size:26px;"><span style="border-bottom: 1px solid black; margin-bottom: 5px;"><span class="red"> बिषय: </span> कामकाज गर्न खटाईएको सम्बन्धमा ।</span>
    </p>
</div>
<div class="space2"> </div>
<div>
    <p style="font-size:18px;"><b><?= $reuslt->position?> <?php echo $result->gender?>
    <?= $result->name ?></b>(संकेत नं.<?= $result->cit_no?>)<br>
    <b><?= $result->taha?></b><br>
    <?= SITE_OFFICE?>। </p>
</div>

<div class="space1"> </div>
<div class="text-justify" style="margin-top: 10px; text-indent: 150px;">
   <p style="font-size:18px; text-align: justify;">   <b><?= $result->yain?></b> बमोजिम <b><?= $result->partachar_office?></b>  प्रस्तुत विषयमा तपाईले यस गाउँपालिका अन्तरगत <b><?= $result->working_sakha?></b> शाखाको <b><?= $result->other_sakha?>को</b> समेत कामकाज गर्दै आउनु भएकोमा यस कार्यालयको मिति <b><?= $result->nirnaya_miti?></b>को निर्णय अनुसार अर्को ब्यवस्था नभएसम्मका लागि तपाईलाई <b><?= $result->working_sakha?></b> शाखाको अतिरिक्त <b><?= $result->transfer_office?>को</b> <b><?= $result->transer_position?></b>को समेत जिम्मेवारी तोकी कामकाज गर्न खटाईएको ब्यहोरा अनुरोध छ । आफ्नो जिम्मामा रहेको <b><?= $result->transer_position?></b>को सम्पूर्ण <b><?= $result->jimma_sewa?></b> कामकाज गर्न खटिएका <b><?= $result->jimma_position?></b> <b><?= $result->jimma_name?></b>लाई बरवुझारथ गरी आफू खटिएको वडा कार्यालयमा हाजिर हुन जानु हुन अनुरोध छ ।</p>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="text-justify  mt-5" style="margin-right:-136px;">
            <h4 class="font-underline">बोद्यार्थ</h4>
            <?php if(!empty($bod)) :
                foreach($bod as $bd) : ?>
                    <div class="clearfix"></div>
                    <?php echo $bd->name?>
                <?php endforeach;endif;?>
            </div>
        </div>
    </div>
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