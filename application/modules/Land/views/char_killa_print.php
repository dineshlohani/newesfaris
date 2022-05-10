<?php
$s_local_body   = Modules::run("Settings/getLocal",$result->s_local_body);
$s_state        = Modules::run("Settings/getState",$result->s_state);
$s_ward         = Modules::run("Settings/getWard",$result->s_ward);
$s_district     = Modules::run("Settings/getDistrict",$result->s_district);
$local_body     = Modules::run("Settings/getLocal",$result->local_body);
$ward           = Modules::run("Settings/getWard",$result->ward);
$state          = Modules::run("Settings/getState",$result->state);
$district      = Modules::run("Settings/getDistrict",$result->district);
$office        = Modules::run("Settings/getOffice",$result->office);
$killa_result  = Modules::run("Land/getDetais",$result->id);
$old_adds = Modules::run("Settings/getOldNewAddress",$result->old_ward);
if(!empty($result->documents))
    {
        $documents      = explode("+",$result->documents);

    }
    $path           = base_url()."assets/documents/land/char_killa/";
    $current_session    = Modules::run('Settings/getCurrentSession',$result->session_id);
    $worker_post        = Modules::run('Settings/getPost',$ward_worker->post_id);
?>
<div class="letter_print">
    <div class="letter-head">
        <!-- Letter head -->
    <hr>
    <div class="row">
    <div class="col-3 letter-head-left">
               <p style="font-size:18px;"><span class="red"> पत्र संख्या: </span> <?= $current_session->name ?><br></p>
        <p style="font-size:18px;"><span class="red"> चलानी नं.:  </span> <?= $chalani_no ?></p>
            </div>
            <div class="col-3 text-right letter-head-right" style="margin-left: 600px">
                <div class="myclear"> </div>
                <span class="red"> मिति : </span> <?= $chalani_result->nepali_chalani_miti?>
            </div>
    </div><br>
   
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
    <div class="text-center my-4 py-2 mt-4">
        <p style="font-size:26px;"><span style="border-bottom: 1px solid black; margin-bottom: 3px;"><span class="red">विषय:</span> चार किल्ला प्रमाणित गरिएको बारे।</span></p>
    </div>
    <div class="text-justify">
        <?php
            $old_add = Modules::run("Settings/getOldNewAddress",$s_ward->old_address);
            $road_type = Modules::run("Settings/getRoadType",$killa->road_type);
        ?>
        
       
         <p  style="font-size:18px; text-align: justify;">
                                प्रस्तुत विषयमा  
                                <b><?= $s_state->name?>,  जिल्ला <?= $s_district->name?>, <?= $s_local_body->name?>, वडा नं. <?= $s_ward->name?></b> जन्मस्थान भई  हाल 
                                <b><?= $local_body->name?> वडा नं. </b> <?= $ward->name?>
                                (साविक ठेगाना <?= $old_adds->name?>)</b> बस्ने <?=$result->gender_spec?>
                                <?= $result->applicant_name?>को नाममा जिल्ला मालपोत कार्यालय, <?=$district->name?> श्रेष्ता दर्ता कायम रहेको तपशिलमा उल्लेखित कित्ताको जग्गा र जग्गामा निर्माण भएको घर/जग्गाको चारकिल्ला प्रमाणित सिफारीस पाउँ भनी <b><?=$result->ward?></b> 
                                नं. वडा कार्यालयमा सिफारीस माग गर्नु भएको हुदाँ तपशिलमा उल्लेखित कित्ता जग्गाको ट्रेस नक्सा / नापी नक्सा अनुसार निम्नानुसार चारकिल्ला भएको प्रमाणित सिफारिस गरीन्छ ।
                            </p>
        </div>
        <div class="text-center my-3 mt-5">
            <h5>तपशिल</h5>
        </div>
        <table class="table letter-table table-bordered mybordertable">
            <thead>
                <tr>
                    <td rowspan="2" style="font-size:18px;">क्र.स.</td>
                    <td rowspan="2" style="font-size:18px;">वडा नं.</td>
                    <td colspan="3" style="font-size:18px;">जग्गाको विवरण</td>
                    <td rowspan="2" style="font-size:18px;">बाटो</td>
                    <td rowspan="2" style="font-size:18px;">बाटोको प्रकार</td>
                    <td colspan="4" style="font-size:18px;"> चार किल्ला</td>
                    <td rowspan="2" style="font-size:18px;">कैफियत</td>
                </tr>
                <tr>
                    <td style="font-size:18px;">नक्सा सिट नं</td>
                    <td style="font-size:18px;">कि.नं</td>
                    <td>क्षेत्रफल<br>
                                <?php if($result->land_type=='hill'){
                                    echo "(रो.आ.पै.दा)";
                                }else{
                                    echo "(बि.क.धु)";
                                }?>
                    </td>
                    <td style="font-size:18px;">पुर्ब</td>
                    <td style="font-size:18px;">पश्चिम</td>
                    <td style="font-size:18px;">उत्तर</td>
                    <td style="font-size:18px;">दक्षिण</td>
                </tr>
            </thead>
            <tbody>

                <?php $i=1; foreach($killa_result as $killa){
                                    $old_add = Modules::run("Settings/getOldNewAddress",$killa->old_address);
                                    $road_type = Modules::run("Settings/getRoadType",$killa->road_type);
                                    ?>
                <tr class="item">
                    <td style="font-size:18px;"><?=$i?></td>
                    <td style="font-size:18px;"><?=getonlyNumber($old_add->new_name)?></td>
                    <td style="font-size:18px;"><?=$killa->map_sheet_no?></td>
                    <td style="font-size:18px;"><?=$killa->kitta_no?></td>
                    <td style="font-size:18px;"><?=$killa->biggha.'-'.$killa->kattha.'-'.$killa->dhur?><?= ($result->land_type=='hill') ? "-".$killa->paisa : '' ?></td>
                    <td style="font-size:18px;"><?php if($killa->road==1){ echo "भएको ";}else{ echo "नभएको";}?></td>
                    <td style="font-size:18px;"><?=$road_type->name?></td>
                    <td style="font-size:18px;"><?=$killa->east_piller?></td>
                    <td style="font-size:18px;"><?=$killa->west_piller?></td>
                    <td style="font-size:18px;"><?=$killa->north_piller?></td>
                    <td style="font-size:18px;"><?=$killa->south_piller?></td>
                    <td style="font-size:18px;"><?=$killa->description?></td>
                </tr>
                <?php $i++; } ?>
            </tbody>
        </table>
    </div>
    <div class="mt-5 pt-5">
        <div class="row">
            <div class="space2"></div>
            <div class="offset-9 col-3 signature">
                <?= $ward_worker->name?><br />
                <?= $worker_post->name?>
            </div>
        </div>
    </div>
</div>