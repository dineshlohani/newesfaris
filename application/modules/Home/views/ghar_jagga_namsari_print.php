<style type="text/css">
    

  .signature{
        position: fixed;
        bottom: 80px;
        width: 100% !important;
         break-inside: avoid;
    }

  /*  .letter_print, p {
        page-break-inside: avoid;
    }*/

   /* html, body {
        width: 210mm;
        height: 297mm;
    }*/
}
</style>

<?php
    $applicant_relation     = Modules::run("Settings/getRelation",$result->applicant_relation);
    $hakdar_ko_nata         = Modules::run("Settings/getRelation",$result->hakdar_ko_nata);
    $road_type              = Modules::run("Settings/getRoadType",$result->road_type);
    $ward                   = Modules::run("Settings/getWard",$result->ward);
    if(!empty($result->description))
    {
        $description        = $result->description;
    }
    else
    {
        $description        = "-";
    }
    $current_session    = Modules::run('Settings/getCurrentSession',$result->session_id);
    $worker_post        = Modules::run('Settings/getPost',$ward_worker->post_id);
 ?>
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
   <!--  <div class="col-md-4">
        <?php
            $this_office   = Modules::run('Settings/getOffice', $print_office->id);
        ?>
        <div class='row'>
            <?= !empty($this_office->sambodhan) ? $this_office->sambodhan."," : ''?>
        </div>
        <div class="row">
            <?= $this_office->name?>,
        </div>
        <div class="row">
            <?= !empty($this_office->address) ? $this_office->address."," : ''?>
        </div>
    </div> -->
    <div class="text-center mt-3 pb-2 font-28">
        <p style="font-size:26px;"><span style="border-bottom: 1px solid black; margin-bottom: 5px;"> <span class="red"> बिषय : </span> घर जग्गा नामसारी सिफारिस। </span>
        </p>
    </div>
    <div class="text-justify" style="margin-top: 30px;">
       <p class="text-body" style="font-size: 18px; text-align: justify;">

       निवेदक <?=$result->gender_spec?> <?= $result->applicant_name ?>
                            को <?= $applicant_relation->name ?>
                            नाता पर्ने
                            श्री <?= $result->owner_name ?> को मिति <?=$result->nepali_dod?> मा मृत्यु भएको
                            हुनाले
                            निज मृतकका नाममा
                            दर्ता कायम रहेको तल उल्लेखित विवरणको घरजग्गा नामसारीको लागि <?=$result->gender_spec?> <?= $result->applicant_name?> ले निबेदन दिनु भएकोमा मृतकका हकदारहरु नाता प्रमाणित प्रमाणपत्रमा
                            उल्लेखित भएअनुसार रहेकोले निज मृतकको नाममा रहेको सो घर/जग्गा त्यहाँको
                            नियमानुसार हकदारहरुको
                            नाममा नामसारीको लागि सिफारिस साथ अनुरोध गरिन्छ ।
        </p>
                        </div>
    <div class="space1"></div>
    <div class="text-center black b">
        <p style="font-size: 22px; text-decoration: underline;"> <b>मृतकका हकदारको विवरण</b></p>
    </div>
    <div class="">

        <table class="table table-bordered text-center" >
            <thead>

                <tr>
                    <td>क्र.स.</td>
                    <th>हकदारको नाम</th>
                    <th>मृतक सँगको नाता</th>
                    <th>बुवा/पतिको नाम</th>
                    <th>नागरिकता नं.</th>

                </tr>
            </thead>
            <tbody>

                <?php $i =1; if(!empty($hakdar)) :
                foreach($hakdar as $key => $h) : ?>
                    <tr class="">
                        <td><?php echo $i++?></td>
                        <td><?php echo $h->hakdar_ko_name?></td>
                        <td><?php echo $h->hakdar_ko_nata?></td>
                        <td><?php echo $h->father_husband_name?></td>
                        <td><?php echo $h->citizenship_no?></td>
                    </tr>
                <?php endforeach; endif;?>
            </tbody>
        </table>
       <!--  <table class="table table-bordered text-center">
            <tbody>
                <tr class="text-bold">
                    <td style="font-size: 18px; text-align: justify;">क्र.स.</td>
                    <td style="font-size: 18px; text-align: justify;">
                        हकदारहरुको नाम
                    </td>
                    <td style="font-size: 18px; text-align: justify;">
                        नाता
                    </td>
                    <td style="font-size: 18px; text-align: justify;">
                        बुवा/पति को नाम
                    </td>
                    <td style="font-size: 18px; text-align: justify;">
                        नागरिकता नं.
                    </td>
                    <td style="font-size: 18px; text-align: justify;">
                        घर नं.
                    </td>
                    <td style="font-size: 18px; text-align: justify;">
                        कित्ता नं.
                    </td>
                    <td style="font-size: 18px; text-align: justify;">
                        बाटोको नाम
                    </td>
                </tr>
                <tr class="font-normal">
                    <td class="font-kalimati">
                      <p style="font-size:18px;">  1 </p>
                    </td>
                    <td>
                        <p style="font-size:18px;"><?= $result->hakdar_ko_name ?></p>
                    </td>
                    <td>
                        <p style="font-size:18px;"><?= $hakdar_ko_nata->name ?></p>
                    </td>
                    <td>
                       <p style="font-size:18px;"> <?= $result->father_husband_name ?></p>
                    </td>
                    <td>
                      <p style="font-size:18px;">  <?= $result->citizenship_no ?></p>
                    </td>
                    <td>
                        <p style="font-size:18px;"><?= $result->home_no ?></p>
                    </td>
                    <td>
                       <p style="font-size:18px;"> <?= $result->kitta_no ?></p>
                    </td>
                    <td>
                       <p style="font-size:18px;"> <?= $result->road_name ?></p>
                    </td>
                </tr>
            </tbody>
        </table> -->
    </div>
    <div class="text-center black b">
        <p style="font-size: 22px; text-decoration: underline;"><b>नामसारी गर्ने घर/जग्गाको विवरण</b></p>
    </div>
    <div class="">
      <!--   <table class="table table-bordered text-center">
            <tbody>
                <tr class="text-bold">
                    <td style="font-size: 18px; text-align: justify;">क्र.स.</td>
                    <td style="font-size: 18px; text-align: justify;">
                        वडा
                    </td>
                    <td style="font-size: 18px; text-align: justify;">
                        सिट.नं.
                    </td>
                    <td style="font-size: 18px; text-align: justify;">
                        कित्ता
                    </td>
                    <td style="font-size: 18px; text-align: justify;">
                        क्षेत्रफल
                    </td>
                    <td style="font-size: 18px; text-align: justify;">
                        घर नं
                    </td>
                    <td style="font-size: 18px; text-align: justify;">
                        कित्ता नं
                    </td>
                    <td style="font-size: 18px; text-align: justify;">
                        बाटोको नाम / बाटोको प्रकार
                    </td>
                    <td style="font-size: 18px; text-align: justify;">
                        कैफियत
                    </td>
                </tr>
                <tr class="font-normal">
                    <td class="font-kalimati">
                       <p style="font-size:18px;"> 1</p>
                    </td>
                    <td>
                       <p style="font-size:18px;"> <?= $ward->name ?></p>
                    </td>
                    <td>
                       <p style="font-size:18px;"> <?= $result->map_sheet_no ?></p>
                    </td>
                    <td>
                       <p style="font-size:18px;"> <?= $result->kitta ?></p>
                    </td>
                    <td>
                        <p style="font-size:18px;"><?= $result->biggha."-".$result->kattha."-".$result->dhur?><?= ($result->land_type=="hill") ? "-".$result->paisa : '' ?></p>
                    </td>
                    <td>
                       <p style="font-size:18px;"> <?= $result->home_no ?></p>
                    </td>
                    <td>
                       <p style="font-size:18px;"> <?= $result->kitta_no ?></p>
                    </td>
                    <td>
                       <p style="font-size:18px;"> <?= $result->road_name.", ".$road_type->name ?></p>
                    </td>
                    <td>
                       <p style="font-size:18px;"> <?= $description?></p>
                    </td>
                </tr>
            </tbody>
        </table> -->

        <table class="table table-bordered text-center" >
            <thead>
               
                <tr>
                    <td>क्र.स.</td>
                    <th >न सि नं.</th>
                    <th>कित्ता नं.</th>
                    <th>घर नं</th>
                    <th>क्षेत्रफल<br>(रोपनी. आना. पैसा. दाम)</th>
                    <th >बाटोको प्रकार</th>
                    <th >बाटोको नाम</th>
                    <th >वडा नं.</th>
                    <th >कैफियत</th>
                    
                </tr>
            </thead>
            <tbody>

                <?php $i =1; if(!empty($jaggawiwaran)) :
                foreach($jaggawiwaran as $key => $jn) : ?>
                    <tr class="">

                        <td><?php echo $i++?></td>
                        <td><?php echo $jn->map_sheet_no?></td>
                        <td><?php echo $jn->kitta?></td>
                        <td><?php echo $jn->home_no?></td>
                        <td><?php echo $jn->biggha.'-'.$jn->kattha.'-'.$jn->paisa.'-'.$jn->dhur?></td>
                        <td><?php echo $jn->road_type?></td>
                        <td><?php echo $jn->road_name?></td>
                        <td><?php echo $jn->ward?></td>
                        <td><?php echo $jn->description?></td>
                    </tr>
                <?php endforeach; endif;?>
            </tbody>
        </table>
    </div>
    <div class="space4"></div>
    <div class="">
        <div class="row">
            <div class="offset-9 col-3 signature">
                <?= $ward_worker->name?><br />
                <?= $worker_post->name?>
            </div>
        </div>
    </div>
</div>

