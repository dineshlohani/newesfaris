<style type="text/css">
    @media print {
        footer {
            position: fixed;
            bottom: 0;
            width: 100% !important;
        }

        .letter_print p {
            break-inside: avoid;
        }
       /*.letter-head{
            position: fixed;
            top: 0;
            width: 100% !important;
       }*/
    }
    hr{
        border-top: 3px solid red;
        margin-top: -3rem;
        /*color: red;*/
        /*border-bottom: 1px solid #8c8b8b;*/
    }

    p{
        margin-top: 0;
        margin-bottom: 0rem;
    }
    body{
        margin: 0px, auto;
    }
 </style>

 <div class="letter-head" style="margin-top: 10px;">
        <!-- Letter head -->
        <div class="row">
            <div class="col-3 letter-head-left">
                <img src="<?=base_url()?>assets/images/icons/logo.png" alt="logo.png" style="margin-left: 20px">
            </div>
          
            <div class="col-6 letter-head-center red">
                <p style="font-size:<?php echo SITE_OFFICE_FONT_ENG?>px;"><b><?= SITE_OFFICE_ENG?></b></p>
                <div>
                    <?php if($this->session->userdata('is_muncipality') == 1):?>
                    <p style="font-size:<?php echo SITE_PALIKA_FONT_ENG?>px"><b><?= SITE_PALIKA_ENG?></b></p>
                    <?php else: ?>
                    <p style="font-size:<?php echo SITE_PALIKA_FONT_ENG?>px"><b><?=$this->session->userdata('ward_no')?> <?= SITE_WARD_OFFICE_ENG?></b></p>
                    <?php endif; ?>
                    <?php if($this->session->userdata('is_muncipality')==0):?>
                    <p style="font-size: 26px;"><b><?=  $this->session->userdata('address_eng').", ".SITE_DISTRICT_ENG?></b></p>
                    <?php else: ?>
                    <p style="font-size: 26px;"><?= SITE_ADDRESS?>,<?php echo SITE_DISTRICT_ENG?></p>
                    <?php endif;?>
                    <p style="font-size:26px;"><?= SITE_STATE_ENG?>, Nepal</p>
                </div>
            </div>

            
            <div style="margin-left: 630px;">
                <?php //echo SITE_EMAIL_ALIGNMENT?>
                <?php if(SITE_EMAIL_ALIGNMENT_ENG == 'center'): ?>
                  e-mail: "<?php echo SITE_EMAIL?>"<br>
                <?php endif;?>
                <?php if(SITE_WEBSITE_ALIGNMENT_ENG == 'center'): ?>
                    website: <i class="fa fa-globe"></i>: <?php echo SITE_WEBSITE ?><br>
                <?php endif;?>
                <?php if(SITE_EMAIL_ALIGNMENT_ENG == 'center'): ?>
                    phone no: <i class="fa fa-phone"></i>: <?php echo SITE_PHONE?>
                <?php endif;?>
            </div>

            <?php if(SITE_PHONE_ALIGNMENT_ENG == 'top-right'): ?>
            <div style="margin-left: 790px;margin-top: -30px;">
                    <span class="red">Phone no:</span><i class="fa fa-phone"></i>: <?php echo SITE_PHONE?>
            </div>
            <?php endif;?>
            <?php if(SITE_EMAIL_ALIGNMENT_ENG == 'top-right'): ?>
            <div style="margin-left: 730px;margin-top: -80px;">
                  e-mail: "<?php echo SITE_EMAIL?>"<br>
            </div>
            <?php endif;?>
            <?php if(SITE_WEBSITE_ALIGNMENT_ENG == 'top-right'): ?>
            <div style="margin-left: 730px;margin-top: -60px;">
                    website: <i class="fa fa-globe"></i>: <?php echo SITE_WEBSITE ?>
            </div>
            <?php endif;?>
               
            </div>

            <?php if(SITE_PALIKA_LOGO != 'n/a') { ?>
                <img src="<?=base_url()?>assets/images/icons/<?php echo SITE_PALIKA_LOGO?>" alt="<?php echo SITE_PALIKA_LOGO?>" style =" width:150px;height:150px;margin-top:-183px; float:right;">
            <?php } ?>
        </div>
    </div><!-- Letter head end -->
   