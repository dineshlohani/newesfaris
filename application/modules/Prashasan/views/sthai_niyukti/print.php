<div class="letter_print">
    <hr>
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
</div>

<div class="text-center font-28 pt-3 pb-3" style="margin-bottom: 20px;">
    <p style="font-size:26px;"><span style="border-bottom: 1px solid black; margin-bottom: 5px;"><span class="red"> बिषय: </span> स्थायी नियुक्ति पत्र ।</span>
    </p>
</div>
<div class="space2"> </div>
<div>
   <p style="font-size:18px;"> <?=$result->gender?> <?= $result->name ?> <br>
    <?= $local_body->name?>-<?= $result->ward?> <br />
</div>

<div class="space1"> </div>
<div class="text-justify" style="margin-top: 10px; text-indent: 150px;">
   <p style="font-size:18px; text-align: justify;">  लोक सेवा आयोग बागलुङ कार्यालय बागलुङको विज्ञापन नं. <b><?php echo $result->add_no?></b> र च.नं. <b><?php echo $result->office_chalani_no?></b> मिति <b><?php echo $result->office_chalani_date?></b> को सिफारिस पत्रानुसार, <?php echo $result->yain?>, बमोजिम यस जलजला गाउँपालिका गाउँ कार्यपालिकाको कार्यालयको मिति <b><?php echo $result->gapa_miti?></b> को निर्णयानुसार मिति <b><?php echo $result->lagu_miti?></b> देखि लागू हुने गरी तपाईलाई <b><?php echo $result->sewa?></b> सेवा, सिभिल समूह, <b><?php echo $result->taha?></b> तहको <b><?php echo $result->position?></b> पदमा एक (१) वर्षको परिक्षण कालमा रहने गरी स्थायी नियुक्ति गरिएको छ। 
                            तपाईको सेवा शर्त तथा सुविधाहरु स्थानीय तहको सेवा शर्त सुविधा सम्बन्धी कानून बमोजिम हुनेछ ।
                            <br> स्थानीय सेवाको पदमा स्थायी नियुक्ति हुनुभएकोमा हार्दिक बधाई छ । </p>
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