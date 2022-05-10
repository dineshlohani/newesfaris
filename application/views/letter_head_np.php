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
        border-top: 2px solid red;
        margin-top: -1rem;
        /*color: red;*/
        /*border-bottom: 1px solid #8c8b8b;*/
    }

    p{
        margin-top: 0;
        margin-bottom: 0rem;
    }
   /* body{
        margin: 0px, auto;
    }*/

   /**/
 </style>

 <div class="letter-head">
        <!-- Letter head -->
        <div class="row">
            <div class="col-3 letter-head-left">
                <img src="<?=base_url()?>assets/images/icons/logo.png" alt="logo.png" style="margin-left: 20px">
            </div>
            
           
            <div class="col-6 letter-head-center red">
                <p style="font-size:<?php echo SITE_OFFICE_FONT?>px;"><b><?= SITE_OFFICE?></b></p>
                <div>
                    <?php if($this->session->userdata('is_muncipality') == 1):?>
                    <p style="font-size:<?php echo SITE_PALIKA_FONT?>px"><b><?= SITE_PALIKA?></b></p>
                    <?php else: ?>
                    <p style="font-size:<?php echo SITE_PALIKA_FONT?>px"><?=$this->session->userdata('ward_no')?> <b><?= SITE_WARD_OFFICE?></b></p>
                    <?php endif; ?>
                    <?php if($this->session->userdata('is_muncipality')==0):?>
                    <p style="font-size: 26px;"><b><?=  $this->session->userdata('address').", ".SITE_DISTRICT?></b></p>
                    <?php else: ?>
                    <p style="font-size: 26px;"><?= SITE_ADDRESS?>,<?php echo SITE_DISTRICT_ENG?></p>
                    <?php endif;?>
                    <p style="font-size:26px;"><?= SITE_STATE?>, नेपाल</p>
                </div>
            </div>

            
            <div style="margin-left: 630px;">
                <?php //echo SITE_EMAIL_ALIGNMENT?>
                <?php if(SITE_EMAIL_ALIGNMENT == 'center'): ?>
                  इमेल: "<?php echo SITE_EMAIL?>"<br>
                <?php endif;?>
                <?php if(SITE_WEBSITE_ALIGNMENT == 'center'): ?>
                    वेभसाईट: <i class="fa fa-globe"></i>: <?php echo SITE_WEBSITE ?><br>
                <?php endif;?>
                <?php if(SITE_EMAIL_ALIGNMENT == 'center'): ?>
                    फोन नं: <i class="fa fa-phone"></i>: <?php echo SITE_PHONE?>
                <?php endif;?>
            </div>

            <?php if(SITE_PHONE_ALIGNMENT == 'top-right'): ?>
            <div style="margin-left: 830px;text-align: right; margin-top:-30px;">
                    <span class="red">फोन नं: <i class="fa fa-phone"></i>:</span> <?php echo SITE_PHONE?>
            </div>
            <?php endif;?>
            <?php if(SITE_EMAIL_ALIGNMENT == 'top-right'): ?>
            <div style="margin-left: 730px;margin-top: -80px;">
                  इमेल: "<?php echo SITE_EMAIL?>"<br>
            </div>
            <?php endif;?>
            <?php if(SITE_WEBSITE_ALIGNMENT == 'top-right'): ?>
            <div style="margin-left: 730px;margin-top: -60px;">
                    वेभसाईट: <i class="fa fa-globe"></i>: <?php echo SITE_WEBSITE ?>
            </div>
            <?php endif;?>
             
            </div>

            <?php if(SITE_PALIKA_LOGO != 'n/a') { ?>
                <img src="<?=base_url()?>assets/images/icons/<?php echo SITE_PALIKA_LOGO?>" alt="<?php echo SITE_PALIKA_LOGO?>" style =" width:150px;height:150px;margin-top:-183px; float:right;">
            <?php } ?>
            
    </div><!-- Letter head end -->
   