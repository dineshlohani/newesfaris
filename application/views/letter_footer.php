<footer style="border-top: 2px solid red;">
    <div class="text-center"><q><?php echo SITE_SLOGAN?></q></div>
    <div class="text-center">
         <?php if(SITE_PHONE_ALIGNMENT == 'footer'): ?>
                फोन नं: <i class="fa fa-phone"></i>: <?php echo SITE_PHONE?>
            <?php endif;?>
            <?php if(SITE_EMAIL_ALIGNMENT == 'footer'): ?>
                <span class="numbers">इमेल <i class="fa fa-envelope"></i>: <?php echo SITE_EMAIL?></span>
            <?php endif;?>
            <?php if(SITE_WEBSITE_ALIGNMENT == 'footer'): ?>
               वेभसाईट <i class="fa fa-globe"></i>: <?php echo SITE_WEBSITE ?>
            <?php endif;?>       
    </div>
</footer>
