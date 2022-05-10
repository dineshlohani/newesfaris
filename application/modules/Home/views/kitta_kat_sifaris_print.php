<?php
    $local_body     = Modules::run("Settings/getLocal",$result->local_body);
    $state          = Modules::run("Settings/getState",$result->state);
    $ward           = Modules::run("Settings/getWard",$result->ward);
    $district       = Modules::run("Settings/getDistrict",$result->district);
    $old_place      = Modules::run("Settings/getOldNewAddress",$result->old_place);
    $direction      = Modules::run("Settings/getDirection",$result->direction);
    if(!empty($result->documents))
    {
        $documents      = explode("+",$result->documents);

    }
    $path           = base_url()."assets/documents/home/kitta_kat_sifaris/";
    $current_session    = Modules::run('Settings/getCurrentSession',$result->session_id);
    $worker_post        = Modules::run('Settings/getPost',$ward_worker->post_id);
?>
<div class="letter_print">
    
    <hr><br>
    <div class="row">
    <div class="col-3 letter-head-left">
        <p style="font-size:18px;"><span class="red"> पत्र संख्या: </span> <?= $current_session->name ?><br></p>
        <p style="font-size:18px;"><span class="red"> चलानी नं.:  </span> <?= $chalani_no ?></p>
    </div>
    <div class="col-3 text-right letter-head-right" style="margin-left: 705px">
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
    <div class="text-center font-28 pt-3" style="margin-bottom: 30px;">
        <p style="font-size:26px;"><span class="red">बिषय:</span> : घरबाटो प्रमाणित ।</p>
    </div>

    <div class="text-justify">
         <p class="text-body" style="font-size: 18px; text-align: justify;">
         उपरोक्त बिषयमा <b><?=$local_body->name?></b> वडा नं <b><?=$ward->name?></b> (साबिकको
                            ठेगाना <b><?=$old_place->name?>)</b> अन्तर्गत
                            <b><?=$result->gender_spec?> <?= $result->owner_name ?></b> को नाममा
                            श्रेस्ता दर्ता कायम रहेको तल उल्लेखित विवरणको घर-जग्गामध्ये पश्चिम
                            तर्फबाट <b><?= $result->kittakat_area ?></b> क्षेत्रफल
                            जग्गा कित्ताकाट/प्लट मिलन गर्नु प्राविधिक निरिक्षण गर्दा मापदण्ड अनुसार मिल्ने
                            देखिएको
                            हुनाले सोको लागि
                            सिफारिस गरिन्छ ।
                        </p>
                        </div>
    <br>
    <div class="text-center font-24 font-bold my-2">
        <p class="text-body" style="font-size: 18px; text-align: justify;"> <span>
            घर रहेको जग्गाको विवरण
        </span></p>
    </div>
    <div>
        <table class="table text-center table-bordered">
            <tr>
                <td  style="font-size: 18px; text-align: justify;">
                    क्र.सं.
                </td  style="font-size: 18px; text-align: justify;">
                <td  style="font-size: 18px; text-align: justify;">
                    सिट.नं.
                </td>
                <td  style="font-size: 18px; text-align: justify;">
                    कित्ता नं.
                </td>
                <td  style="font-size: 18px; text-align: justify;">
                    क्षेत्रफल
                </td>
            </tr>
            <tr>
                <td class="font-kalimati">
                   <p class="text-body" style="font-size: 18px; text-align: justify;"> 1 </p>
                </td>
                <td>
                   <p class="text-body" style="font-size: 18px; text-align: justify;"> <?= $result->map_sheet_no ?></p>
                </td>
                <td>
                   <p class="text-body" style="font-size: 18px; text-align: justify;"> <?= $result->kitta_no ?></p>
                </td>
                <td>
                  <p class="text-body" style="font-size: 18px; text-align: justify;">  <?= $result->biggha."-".$result->kattha."-".$result->dhur ?><?= ($result->land_type=="hill") ? "-".$result->paisa : '' ?></p>
                </td>
            </tr>
        </table>
    </div>

    <div class="text-center font-bold mt-5">
       <p class="text-body" style="font-size: 18px; text-align: justify;"> कित्ताकाट सिफारिस फिल्ड निरीक्षण प्रतिवेदन</p>
    </div>
    <div class="mt-3" style="line-height: 1.6">
       <p class="text-body" style="font-size: 18px; text-align: justify;"> घर बनेको जग्गाको
        क्षेत्रफल: <?= $result->biggha."-".$result->kattha."-".$result->dhur ?>
        <br>

        घरको जम्मा क्षेत्रफल : <?= $result->ghar_area ?><br>

        घरको भुई तल्लाको क्षेत्रफल: <?= $result->first_floor_home_area ?> <br>

        पाउने फार: <?= $result->paune_far ?> <br>

        सिफारिस दिन मिल्ने कारण: <?= $result->reason ?> <br></p>

    </div>

    <div class="my-3">
        
    </div>

    <div style="line-height: 2.3">
        <p class="text-body" style="font-size: 18px; text-align: justify;"><b> सिफारिस गर्ने </b><br>
        प्राविधिकको नाम: <?= $result->technician_name ?> <br>

        प्राविधिकको हस्ताक्षर: ..................... <br></p>
    </div>
    <div class="space3"> </div>
    <div class="mt-3">
        <div class="row mt-5x">

            <div class="offset-9 col-3 signature">
                <?= $ward_worker->name?><br />
                वडा <?= $worker_post->name?>
            </div>
        </div>
    </div>
</div>