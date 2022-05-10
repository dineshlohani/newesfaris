<?php
 $letter_subject = $this->Mdl_letter_subject->getById($result->letter_subject);
$session = Modules::run('Settings/getSession', $result->session_id);
//print_r($session);
$worker_post        = Modules::run('Settings/getPost',$ward_worker->post_id);
//print_r($user);
?>

<div class="letter_print">
   
    <hr>
    <div class="row">
    <div class="col-3 letter-head-left" style="font-size:20px;">
                <span class="red"> पत्र संख्या: </span> <?= $session->name ?><br>
                <span class="red"> चलानी नं.:  </span> <?= $chalani_no ?>
            </div>
            <div class="col-3 text-right letter-head-right" style="margin-left: 600px">
                <div class="myclear"> </div>
                <div style="font-size:20px;">
                <span class="red"> मिति : </span> <?= !empty($chalani_result->nepali_chalani_miti)?$chalani_result->nepali_chalani_miti:''?>
                </div>
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
        <div class="space2"></div>
        <p style="font-size:26px;"><span
            style="border-bottom: 0.5px solid black; margin-bottom: 1px; font-size:22px;"> <strong><span class="red">बिषय:</span> <?= $result->content_sub ?> </strong></span>
        </p>
    </div>
    <div class="text-justify" style="text-indent: 60px; font-size:24px;">
     <?php echo $result->content; ?>
   </div>
   <div class="space2"></div>
    <div class="mt-5 pt-5">
        <div class="row">
            <div class="space2"></div>
            <div class="offset-9 col-3 signature" style="font-size:24px;">
                <?= $ward_worker->name?><br />
                <?= $worker_post->name?>
            </div>
        </div>
    </div>
</div>

<footer style="margin-top: 490px;  border-top: 2px solid red;">
    <div class="text-center"><q><?php echo SITE_SLOGAN?></q></div>
    <div class="text-center">
         <?php if(SITE_PHONE_ALIGNMENT == 'footer'): ?>
                फोन नं: <i class="fa fa-phone"></i>: <?php echo SITE_PHONE?>
            <?php endif;?>
            <?php if(SITE_EMAIL_ALIGNMENT == 'footer'): ?>
                इमेल <i class="fa fa-envolp"></i>: <?php echo SITE_EMAIL?>
            <?php endif;?>
            <?php if(SITE_WEBSITE_ALIGNMENT == 'footer'): ?>
               वेभसाईट <i class="fa fa-globe"></i>: <?php echo SITE_WEBSITE ?>
            <?php endif;?>       
    </div>
</footer>