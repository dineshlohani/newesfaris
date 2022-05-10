<?php
    $local_body     = Modules::run("Settings/getLocal",$result->local_body);
    $state          = Modules::run("Settings/getState",$result->state);
    $ward           = Modules::run("Settings/getWard",$result->ward);
    $district       = Modules::run("Settings/getDistrict",$result->district);
    $death_local_body     = Modules::run("Settings/getLocal",$result->death_local_body);
    $death_state          = Modules::run("Settings/getState",$result->death_state);
    $death_ward           = Modules::run("Settings/getWard",$result->death_ward);
    $death_district       = Modules::run("Settings/getDistrict",$result->death_district);
    $citizen_district     = Modules::run("Settings/getDistrict",$result->citizenship_district);

    if(!empty($result->documents))
    {
        $documents      = explode("+",$result->documents);

    }
    $path           = base_url()."assets/documents/others/mirtyu_darta/";
    if($result->gender == 1)
    {
        $gender = "पुरुष";
        $grandrelate = "नाति";
        $child       = "छोरा";
        $marital     = "पति";
    }
    else
    {
        $gender = "महिला";
        $grandrelate = "नातिनी";
        $child       = "छोरी";
        $marital     = "पत्नी";
    }

    $current_session    = Modules::run('Settings/getCurrentSession',$result->session_id);
    $worker_post        = Modules::run('Settings/getPost',$ward_worker->post_id);
?>
<div class="font-24 text-black " style="line-height: 2;">
    <div>
        <img src="<?=base_url()?>assets/images/icons/logo.png" alt="logo.png" style="height: auto; width: 16%; ">
        <p class=" pt-3 font-20 font-bold">
            पत्र संख्या: <?= $current_session->name ?><br>
            चलानी नं.: <?= $chalani_no ?>
        </p>
    </div>
    <div class="text-center font-bold" style="margin-top: -240px;">
        <h2 style="font-size: 36px; font-weight:500; "><?= SITE_OFFICE ?></h2>
        <?php if($this->session->userdata('is_muncipality') == 1):?>
            <h3 style="font-size: 34px; font-weight:500; margin-top: -5px;">
                 <?= SITE_PALIKA ?>
            </h3>
        <?php else: ?>
            <h3 style="font-size: 34px; font-weight:500; margin-top: -5px;">
                 <?=$this->session->userdata('ward_no')?> <?= SITE_WARD_OFFICE ?>
            </h3>
        <?php endif; ?>
        <?php if($this->session->userdata('is_muncipality')==0):?>
            <h3 style="margin-top: -5px; font-weight:500; font-size:28px "><?=  $this->session->userdata('address').", ".SITE_DISTRICT?> </h3>
         <?php else: ?>
             <h3 style="margin-top: -5px; font-weight:500; font-size:28px "><?= SITE_ADDRESS ?></h3>
         <?php endif;?>
        <p style="font-size:24px; font-weight: 500; margin-top:-5px;">
            <?= SITE_STATE ?> </p>
    </div>

    <div>
        <p class="text-right">
            मिति : <?= $chalani_result->nepali_chalani_miti?>
        </p>
    </div>
    <div class="col-md-4">
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

    </div>
    <div class="text-center font-28" style="margin-top: 120px; margin-bottom: 70px;">
        <h4><span
                style="border-bottom: 1px solid black; margin-bottom: 5px; font-size:18px"> बिषय: मृत्यु दर्ताको प्रमाणपत्र |</span>
        </h4>
    </div>


    <div class="text-justify" style="text-indent: 120px;font-size:18px">
        यस कार्यालयमा खडा गरिएको मृत्यु दर्ता किताब अनुसार प्रमाणित गरिन्छ कि सूचक श्री/श्रीमती <?= $result->applicant_name ?>ले
        भरेको अनुसूची ३, को सूचना फारम बमोजिम श्री <?= $result->grandfather_name ?>को नाति/नातिनी श्री <?= $result->father_name?>को
        छोरा/छोरी
            <?php if(!empty($result->husband_wife_name)):?>
                श्री <?= $result->husband_wife_name  ?>को पति/पत्नी
            <?php endif;?>
        <?= $state->name ?> <?= $district->name ?> जिल्ला <?= $local_body->name ?>
        वडा नं <?= $ward->name ?> मा बस्ने वर्ष <?= $result->age?> को श्री/श्रीमती <?= $result->death_person_name ?>को मिति वि.स. <?= $result->nep_dod ?> (ई.स. <?= $result->eng_dod?>) गते
        <?php   ?> वडा नं <?php ?>मा मृत्यु भएको हो |
    </div>

    <?php if(!empty($result->citizenship_no)): ?>
        <div class="col-md-6" style="margin-top:30px;font-size:18px">
          <table class="boderless">
              <tr>
                   <td>नागरिकताको प्रमाणपत्र नं </td>
                   <td >&nbsp;<?= $result->citizenship_no ?></td>
               </tr>
               <tr>
                   <td>जारी मिति र जिल्ला</td>
                   <td><?= $result->citizenship_nep_date ?> / <?= $citizen_district->name ?></td>
               </tr>
          </table>
        </div>
    <?php endif;?>
    <div class="col-md-4 pull-right " >
        <table class="borderless " style="font-size:18px!important;position:relative;top:-78px">
            <tr>
                <td>
                    <div class="text-center">
                        ................................. <br>
                        <?= $ward_worker->name?><br/>
                         <?= $worker_post->name?>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>
