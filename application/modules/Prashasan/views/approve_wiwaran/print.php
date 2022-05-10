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
   <p style="font-size:18px;"> <?= $office->sambodhan?>,  <br>
    <?= $office->name?>,<br>
    <?= $office->address?> 
</div>
<div class="space1"> </div>
<div class="text-justify" style="margin-top: 10px; text-indent: 150px;">
    <p style="font-size:18px; text-align: justify;">  
      यस कार्यालय अन्तर्गत <b><?= $result->working_office?></b> <b><?= $result->position?></b> <b><?= $result->taha?></b> पदमा कार्यरत  <b><?= $result->gender.' '.$result->name?></b>(संकेत नं. <b><?= $result->cit_no?></b>), <b><?= $result->yain?></b> मिति <b><?= $result->end_date?></b> गते देखि लागू हुने गरी अनिवार्य अवकास हुनु भएको र निजको शुरु नियुक्ति मिति <b><?= $result->from_date?></b> देखि अवकास हुने मिति सम्ममा उपचार खर्च वापत कुनै पनि रकम नलिएको, गयल कट्टी तथा विभागिय कारवाही नभएको र निजले वरवुझारथ गरिसकेको व्यहोरा अनुरोध छ । 
        <div class="space1"></div>
        निजको सञ्चित घर विदा र विरामी विदाको विवरण तपशिल बमोजिम रहेको र उक्त विवरण नि.से.नि. को अनुसूचि १४ को ढाँचामा प्रमााणित गरि यसै साथ संलग्न राखीएको व्यहोरा अनुरोध छ। 
        </div> 
    </p>
</div>
<div class="space1"></div>
<div class="text-justify" style="margin-top: 10px;">
    <h3 class="text-center">तपशिल</h3>
    <?php if(!empty($tapasil)): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>क्र.सं.</th>          
                    <th>विदाको विवरण</th>    
                    <th>जम्मा दि</th>
                    <th>खर्च भएको</th>
                    <th>वाँकी</th>                  
                    <th>कैफियत</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1;foreach($tapasil as $tp) : ?>
                <tr>
                    <td><?php echo $i++?></td>
                    <td><?php echo $tp->bida_wiwaran?></td>
                    <td><?php echo $tp->jamma_din?></td>
                    <td><?php echo $tp->kharcha?></td>
                    <td><?php echo $tp->baki?></td>
                    <td><?php echo $tp->remarks?></td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
    <?php else : ?>
        <div class="alert alert-warning">no records founds</div>
    <?php endif;?>
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
            <div class="offset-9 col-3 signature" style=";margin-top: -150px;">
                <?= $workers->name?><br />
                <?= $post->name?>
            </div>
        </div>
    </div>