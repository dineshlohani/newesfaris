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
    <p style="font-size:26px;"><span style="border-bottom: 1px solid black; margin-bottom: 5px;"><span class="red"> बिषय: </span>  आयश्रोत प्रमाणित गरिएको ।</span>
    </p>
</div>
<div class="space2"> </div>
<div>
   <p style="font-size:18px;"> श्री जो जससँग सम्बन्धित छ ।</p>
</div>

<div class="space2"> </div>
<div class="text-justify" style="margin-top: 10px; text-indent: 150px;">
   <p style="font-size:18px; text-align: justify;">   प्रस्तुत विषयका सम्बन्धमा यस कार्यालयमा <b><?php echo $result->taha?></b> तहमा कार्यरत कर्मचारी <b><?php echo $result->gender?> <?php echo $result->name?>को</b> वार्षिक आम्दानी तपशिल बमोजिम रहेको ब्यहोरा  प्रमाणित गरिएको गरिन्छ । </p>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="text-justify  mt-5">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>क्र.स.</th>
                        <th> आधारभूत तलब</th>
                        <th> ग्रेड</th>
                        <th>भत्ता</th>
                        <th>स्थानिय भत्ता</th> 
                        <th>संचय कोष कट्टी</th>
                        <th> बीमा</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td><?php echo $result->basic_salary?></td>
                        <td><?php echo $result->grade?></td>
                        <td><?php echo $result->bhatta?></td>
                        <td><?php echo $result->local_bhatta?></td>
                        <td><?php echo $result->pf?></td>
                        <td><?php echo $result->bima?></td>
                    </tr>
                </tbody>
            </table>
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