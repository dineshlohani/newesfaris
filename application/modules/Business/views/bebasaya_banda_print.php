<?php
    $org_local_body     = Modules::run("Settings/getLocal",$result->org_local_body);
    $org_state          = Modules::run("Settings/getState",$result->org_state);
    $org_ward           = Modules::run("Settings/getWard",$result->org_ward);
    $org_district       = Modules::run("Settings/getDistrict",$result->org_district);
    $old_new_address    = Modules::run("Settings/getOldNewAddress",$result->old_new_address);
    $current_session    = Modules::run('Settings/getCurrentSession',$result->session_id);
    $worker_post        = Modules::run('Settings/getPost',$ward_worker->post_id);
?>
<div class="letter_print">
    
    <hr>
    <div class="row">
     <div class="col-3 letter-head-left">
        <p style="font-size:18px;"><span class="red"> पत्र संख्या: </span> <?= $current_session->name ?></p>
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
<div class="space2"></div>
    <div class="text-center mt-2 mb-5 pb-2">
        <p style="font-size:26px;"><span style="border-bottom: 1px solid black; margin-bottom: 3px;"> <span class="red"> बिषय:  </span> व्यवसाय बन्द बारे। </span>
        </p>
    </div>

    <div class="text-justify" style="text-indent: 60px;">
        <p style="font-size:18px; text-align: justify;"> <?= $org_local_body->name ?> वडा नं <?= $org_ward->name ?>
        को <?= $result->org_name ?> (साबिकको
        ठेगाना <?= $old_new_address->name ?>) मा रहेको <?=$result->gender_spec?> <?= $result->owner_name?> को
        नाममा रहेको निम्न उल्लेखित व्यवसाय मिति <?= $result->nepali_closed_date ?>
        देखि
        बन्द
        भएको भनी निजले
        पेश गरेको निबेदन उपर स्थल सर्जमिन बुझ्दा
        मिति <?= $result->nepali_observed_date ?>को
        स्थलगत सर्जमिन
        बमोजिम निजले पेश गरेको व्यहोरा मनासिब देखिएको हुँदा सोहि प्रमाणित गरिन्छ।</p>
    </div>

    <div class="mt-4">
        <table class="table table-bordered text-center mybordertable">
            <tbody>
                <tr class="text-bold">
                    <td style="width:3%; font-size: 18px" >क्र.स.</td>
                    <td style="font-size:18px;">
                        व्यवसायको <br> प्रकार
                    </td >
                    <td style="font-size:18px;">
                        व्यवसायको <br> प्रकृति
                    </td>
                    <td style="font-size:18px;">
                        वडा नं
                    </td>
                    <td style="font-size:18px;">
                        दर्ता नं
                    </td>
                    <td style="font-size:18px;">
                         टोलको नाम
                    </td>
                    <td style="font-size:18px;">
                        बाटोको नाम
                    </td>
                    <td style="font-size:18px;">
                        घर नं
                    </td>
                </tr>
                <tr class="font-normal">
                    <td class="font-kalimati" style="font-size:18px;">
                        1
                    </td>
                    <td style="font-size:18px;">
                        <?= $result->org_type ?>
                    </td>
                    <td style="font-size:18px;">
                        <?= $result->org_size ?>
                    </td>
                    <td style="font-size:18px;">
                        <?= $org_ward->name ?>
                    </td>
                    <td style="font-size:18px;">
                        <?= $result->darta_no ?>
                    </td>
                    <td style="font-size:18px;">
                        <?= $result->tole ?>
                    </td>
                    <td style="font-size:18px;">
                        <?= $result->road_name ?>
                    </td>
                    <td style="font-size:18px;">
                        <?= $result->home_no ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div>
        <div class="row">
            <div class="space5"></div>
            <div class="col-3 offset-9 signature">
                <?= $ward_worker->name?><br />
                <?= $worker_post->name?>
            </div>
        </div>
    </div>
   
</div>
<footer style="margin-top: 320px;  border-top: 2px solid red;">
    <div class="text-center"><q><?php echo SITE_SLOGAN?></q></div>
    <div class="text-center">
         <?php if(SITE_PHONE_ALIGNMENT == 'footer'): ?>
                फोन नं: <i class="fa fa-phone"></i>: <?php echo SITE_PHONE?>
            <?php endif;?>
            <?php if(SITE_EMAIL_ALIGNMENT == 'footer'): ?>
                इमेल <i class="fa fa-envolp"></i>: <?php echo SITE_EMAIL?>
            <?php endif;?>
            <?php if(SITE_WEBSITE_ALIGNMENT == 'footer'): ?>
               वेभसाईट<i class="fa fa-globe"></i>: <?php echo SITE_WEBSITE ?>
            <?php endif;?>       
    </div>
</footer>
