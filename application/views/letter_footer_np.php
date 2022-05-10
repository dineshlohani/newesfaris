<footer style="border-top: 3px solid red;">
    <div class="text-center"><q><?php echo SITE_SLOGAN_ENG?></q></div>
    <div class="text-center">
         <?php if(SITE_PHONE_ALIGNMENT == 'footer'): ?>
                Phone No <i class="fa fa-phone"></i>:<?php echo SITE_PHONE?>
            <?php endif;?>
            <?php if(SITE_EMAIL_ALIGNMENT == 'footer'): ?>
              Email <i class="fa fa-envolp"></i>: <span class="numbers"><?php echo SITE_EMAIL?></span>
            <?php endif;?>
            <?php if(SITE_WEBSITE_ALIGNMENT == 'footer'): ?>
              Website <i class="fa fa-globe"></i>: <?php echo SITE_WEBSITE ?>
            <?php endif;?>       
    </div>
</footer>
