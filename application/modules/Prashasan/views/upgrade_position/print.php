<div class="letter_print">
    <hr>
    <div class="row">
        <div class="col-3 letter-head-left">
            <p style="font-size:18px;"><span class="red"> पत्र संख्या: </span> <?= $current_session->name ?><br></p>
            <p style="font-size:18px;"><span class="red"> चलानी नं.:  </span> <?= $chalani_no ?></p>
        </div>
        <div class="col-3 text-right letter-head-right" style="margin-left: 710px">
            <div class="myclear"> </div>
            <p style="font-size:18px; margin-top: -39px;"><span class="red"> मिति : </span> <?= $chalani_result->nepali_chalani_miti?></p>
        </div>
    </div>
</div>

<div class="text-center font-28 pt-3 pb-3" style="margin-bottom: 20px;">
    <p style="font-size:26px;"><span style="border-bottom: 1px solid black; margin-bottom: 5px;"><span class="red"> बिषय: </span>  स्तर वृद्धि सम्वन्धमा ।</span>
    </p>
</div>
<div class="space2"> </div>
<div>
    <div>
   <p style="font-size:18px;"> <?= $office->sambodhan?> <br>
    <?= $office->name?><br>
    <?= $office->address?>,
</div>
</div>

<div class="space2"> </div>
<div class="text-justify" style="margin-top: 10px; text-indent: 150px;">
   <p style="font-size:18px; text-align: justify;">    यस गाउँपालिका अन्तर्गत <b><?php echo $result->working_office?></b>मा <b><?php echo $result->position?> <?php echo $result->taha?></b> तहको पदमा कार्यरत <b><?php echo $result->gender .' '. $result->name ?></b> 

                        मिति <b>

                            <?php echo $result->from_date?></b> मा स्थायी नियूक्ति भई मिति <b><?php echo $result->start_date?></b> मा <b><?php echo $result->position?> <?php echo $result->taha?></b> तहको पदमा <b><?php echo $result->working_office?></b> पदस्थापन भई निरन्तर रुपमा सेवा गर्दै आएको र मिति <b><?php echo $result->period_date?></b> मा निजको सेवा अवधि <b><?php echo $result->period?></b> वर्ष पुरा भएकोले नियमानुसार <b><?php echo $result->upgrade_position?> <?php echo $result->upgrade_taha?></b> तहमा स्तरवृद्धिका लागि सिफारिस गरिएको व्यहोरा अनुरोध छ । </p>
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