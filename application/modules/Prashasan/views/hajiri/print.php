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
    <p style="font-size:26px;"><span style="border-bottom: 1px solid black; margin-bottom: 5px;"><span class="red"> बिषय: </span> पदस्थापन तथा हाजिर भएको जानाकारी सम्वन्धमा ।</span>
    </p>
</div>
<div class="space2"> </div>
<div>
    <?php $re = explode(',', $result->ramana_office); ?>
    <p style="font-size:18px;">श्री 
        <?php if(!empty($re)): ?>
            <?= $re[0]?> <br>
            <?= $re[1] ?><br />
            <?php else : ?>
                <?= $result->ramana_office ?><br>
            <?php endif;?>
            <?= $result->ramana_office_address?>। 
        </div>

<div class="space1"> </div>
<div class="text-justify" style="margin-top: 10px; text-indent: 150px;">
   <p style="font-size:18px; text-align: justify;">   <b><?= $result->yain?></b> बमोजिम <b><?= $result->partachar_office?></b> मिति  <?= $result->patrachar_date?></b> को पत्र अनुसार यस गाउँपालिकामा <b><?= $result->sewa?></b>, <b><?= $result->samuha?></b>, <b><?= $result->taha?></b> तहको पदमा समायोजन हुनु भएका तहाँ कार्यालयमा कार्यरत विद्यालय निरिक्षक <b><?= $result->gender.' '.$result->name?></b>  (कर्मचारी संकेत नं. <b><?= $result->cit_no?></b>), तहाँ कार्यालयको च.नं. <b><?= $result->ramana_chalani_no?></b> मिति <b><?= $result->ramana->miti?></b> को रमाना पत्र अनुसार यस कार्यालयमा हाजिर हुन आउनु भएकोले यस कार्यालयको मिति <b><?= $result->nirnaya_miti?></b> को निर्णयवाट पदस्थापन भई मिति <b><?= $result->lagu_miti?></b> देखी यस कार्यालयमा हाजिर हुनुभएको व्यहोरा जानाकारीको लागि अनुरोध छ ।</p>
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