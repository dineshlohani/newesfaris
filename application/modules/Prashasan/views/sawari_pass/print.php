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
    <p style="font-size:26px;"><span style="border-bottom: 1px solid black; margin-bottom: 5px;"><span class="red"> बिषय: </span>  सवारी पास उपलब्ध गराईदिने सम्वन्धमा ।</span>
    </p>
</div>
<div class="space2"> </div>
<div>
   <p style="font-size:18px;"> <?= $office->sambodhan?>,  <br>
    <?= $office->name?>,<br>
    <?= $office->address?> 
</div>

<div class="space2"> </div>
<div class="text-justify" style="margin-top: 10px; text-indent: 150px;">
   <p style="font-size:18px; text-align: justify;">  प्रस्तुत विषयमा यस कार्यालयका <?php echo $result->name?> लगायत अन्य ब्यक्तिहरु कार्यालयको कामको सिलसिलामा <?php echo $result->destination?> सम्म जानुपर्ने भएकोले मिति <?php echo $result->from_date?> देखि मिति <?php echo $result->to_date?> गते सम्म आवतजावतका लागि देहाय बमोजिमको सवारी साधनलाई पास उपलब्ध गराईदिनुहुन आदेशानुसार अनुरोध छ । </p>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="text-justify  mt-5" style="margin-right:-136px;">
            <h4 class="font-underline">तपशिल</h4>
            <p><?php echo $result->vehicle_no?></p>
            <p><?php echo $result->driver_name?></p>
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