<!DOCTYPE html>
<html lang="en">
<head>
    <title> <?=  $title ?></title>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url()?>assets/dist/images/nepal_logo.png"/>

    <link rel="stylesheet" href="<?= base_url()?>assets/dist/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url()?>assets/dist/css/select2-bootstrap.main.css">
    <link rel="stylesheet" href="<?= base_url()?>assets/dist/css/select2.main.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="<?= base_url()?>assets/dist/css/bootstrap.css">
    <link rel="stylesheet" href="<?= base_url()?>assets/dist/css/material.css">
    <link rel="stylesheet" href="<?= base_url()?>assets/dist/css/style.css">
    <link rel="stylesheet" href="<?= base_url()?>assets/dist/css/tree-style.css">
    <link rel="stylesheet" href="<?= base_url()?>assets/calendar/nepali.datepicker.v2.1.min.css">
    <script src="<?=base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
        base_url = "<?php echo base_url()?>";
    </script>

</head>

<body style="background:white;" class='  ls-opened  theme-violet '>
<div class="overlay"></div>

<div class="page-wrapper">
    <nav class="navbar navbar-expand-lg navbar-dark bg-deep-blue">
        <div class="visible-xs">
            <div class="button close_button" id="id_close_button" >
                <div class="bar top"></div>
                <div class="bar middle"></div>
                <div class="bar bottom"></div>
            </div>
        </div>

        <div class="hidden-xs mt-1">
            <div class="button  open_button  active " id="id_open_button" onclick="menuToggle()";>
                <div class="bar top"></div>
                <div class="bar middle"></div>
                <div class="bar bottom"></div>
            </div>
        </div>

        <!-- <img alt="logo" src="<?=base_url()?>assets/images/icons/logo.png" class="img-responsive ml-3" height="50px;"> -->
        <a class="navbar-brand ml-2 font-27 font-kalimati" href="<?=base_url()?>dashboard">दैनिक प्रशासन -ई-सिफारिस पत्र</a>


        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto"></ul>
        <?php
            if($this->session->userdata('logged_in') == TRUE):
        ?>
            <?php
                $user = Modules::run('User/getUser');
                if($user->is_muncipality == '1'):
                    if($user->is_sachib == '1'){
                        $notifications  = Modules::run('Notification/getNotSeenNotification',$user->id);
                    }else {
                        $notifications  = Modules::run('Notification/getNotSeenNotification',$user->department);
                    }

                    if($notifications != FALSE)
                    {
                        $no_of_notify   = count($notifications);
                    }
                    else {
                        $no_of_notify   = '';
                    }
            ?>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a style="color:white;" class="nav-link dropdown-toggle book" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-bell"></i> <span class="badge badge-danger"><?= $no_of_notify ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right book-div " aria-labelledby="navbarDropdown">
                        <?php if($notifications != FALSE):?>
                            <?php
                                $html = '';
                                foreach($notifications as $notify) :
                                    if($user->is_sachib == 1)
                                    {
                                        $this_darta = Modules::run('DartaChalaniBook/getSachiwalayaDartaByFormId',$notify->form_id);
                                        $this_user  = $this->Mdl_user->getById($this_darta->user_id);
                                        $html = '<a class="dropdown-item" href="'.base_url().'sachiwalaya-darta-detail/'.$this_darta->id.'">दर्ता नं. ' . convertedcit($this_darta->darta_no) .' '. $this_user->name .' द्वारा दर्ता गरिएको छ |';
                                    }else {
                                        $this_darta = Modules::run('DartaChalaniBook/getDartaByFormId', $notify->form_id);
                                        if($this_darta != FALSE)
                                        {
                                            $html = '<a class="dropdown-item" href="'.base_url().'darta-book/detail/'.$this_darta->id.'">दर्ता नं. ' . convertedcit($this_darta->darta_no) . ' को फायल यो फाँटमा पठाइएको छ</a>';
                                        }else{
                                            $this_sachib_darta = Modules::run('DartaChalaniBook/getSachiwalayaDartaByFormId', $notify->form_id);
                                          if(!empty($this->this_sachib_darta)) : 
                                            $html = '<a class="dropdown-item" href="'.base_url().'sachiwalaya-darta-detail/'.$this_sachib_darta->id.'">सचिवालय दर्ता नं. ' . convertedcit($this_sachib_darta->darta_no) . ' को फायल यो फाँटमा पठाइएको छ</a>';
                                        endif;
                                        }


                                    }
                            ?>
                                <?= $html ?>
                                <div class="dropdown-divider"></div>
                            <?php endforeach;?>
                            <a class="dropdown-item" href="<?= base_url()?>notifications" style="background-color:lightgrey;"><center>सम्पूर्ण नोटिफिकेसन हेर्नुहोस</center></a>
                        <?php else:?>
                            <a class="dropdown-item" href="#" style="background-color:lightgrey;"> <center>कुनै पनि नोटिफिकेसन छैन</center></a>
                        <?php endif;?>
                    </div>
                </li>
            </ul>
            <?php
                endif;
            ?>
            <?php if($this->session->userdata('is_sachib') == 0):?>
                <?php if($this->session->userdata('mode') == 'superadmin'):?>
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a style="color:white;" class="nav-link dropdown-toggle book" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-group"></i>
                                <?php
                                    if(!empty($this->session->userdata('department')))
                                    {
                                        $this_depart = $this->Mdl_department->getById($this->session->userdata('department'));
                                        echo $this_depart->name;
                                    }
                                    else {
                                        echo 'फाँट छान्नुहोस्';
                                    }

                                ?>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right book-div" aria-labelledby="navbarDropdown">
                                <?php
                                    $faants = $this->Mdl_department->getAll();
                                    $i = 0;
                                    if($faants != FALSE):
                                        foreach($faants as $faant):
                                ?>
                                <a class="dropdown-item" href="<?= base_url(). 'index/'. $faant->id?>"><?= $faant->name ?></a>
                                <?php       if($i != count($faants) - 1):?>
                                <div class="dropdown-divider"></div>
                                <?php       endif;?>
                                <?php
                                            $i++;
                                        endforeach;
                                    endif;
                                ?>

                            </div>
                        </li>

                    </ul>
                <?php endif;?>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a style="color:white;" class="nav-link dropdown-toggle book" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-book"></i> दर्ता / चलानी
                        </a>
                        <div class="dropdown-menu dropdown-menu-right book-div" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?= base_url()?>darta-book">दर्ता किताब</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?= base_url()?>chalani-book">चलानी किताब</a>
                        </div>
                    </li>

                </ul>
            <?php endif;?>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a style="color:white;" class="nav-link dropdown-toggle user" href="#" id="navbarDropdown" role="button" data-toggle="dropdown " aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user-circle"></i> <?= $user->name ?>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right user-div" aria-labelledby="navbarDropdown">
                        <?php if($this->session->userdata('id') == 1) : ?>
                        <a class="dropdown-item " href="<?= base_url()?>SiteSetting">Profile</a>
                        <div class="dropdown-divider"></div>
                        <?php endif;?>
                        <a class="dropdown-item " href="<?= base_url()?>change-password">Change Password</a>
                        <div class="dropdown-divider"></div>
                        <?php if($this->session->userdata('mode') == 'superadmin'):?>
                        <a class="dropdown-item" href="<?= base_url()?>user-view">View All User</a>
                        <div class="dropdown-divider"></div>
                        <?php endif; ?>
                        <a class="dropdown-item" href="<?= base_url()?>logout">Log Out</a>
                    </div>
                </li>
            </ul>
            <?php else: ?>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a style="color:white;" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user-circle"></i> Account
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?= base_url()?>login"> <i class="fa fa-sign-in"></i>&nbsp; Log In</a>
                    </div>
                </li>
            </ul>
        <?php endif; ?>


        </div>
    </nav>


    <!-- Side Bar Start -->
    <section>

        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar font-kalimati">
            <!-- User Info -->
            <div class="user-info bg-navy-blue">

                <div class="info-container text-white">
                    <div class="info-contact">
                        <span class="font-20"><i class="fa  fa-dollar"> 1</i> = NRs. <?php echo !empty(get_us_currency_rate())?get_us_currency_rate():'no internet connection';?></span>
                        <a class="text-warning" href=""> <i class="fa fa-undo"></i></a>
                    
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu" id="style-1">
                <ul class='list'>

                    <li id="id_templates">
                        <a href="<?= base_url()?>Templates/new_template">
                            <span> <i class="fa fa-tachometer sidebar-icon"></i> new</span>
                        </a>
                        <hr style="margin:0;padding:0;">
                    </li>
                    <li id="id_home">
                        <a href="<?= base_url()?>dashboard">
                            <span> <i class="fa fa-tachometer sidebar-icon"></i> गृह (Dashboard)</span>
                        </a>
                        <hr style="margin:0;padding:0;">
                    </li>
                    <?php if($this->session->userdata('is_muncipality') == 1): ?>
                    <li id="id_parent">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <span> <i class="fa fa-briefcase sidebar-icon"></i> प्रशासन सिफारिस </span>
                        </a>
                        <ul class="ml-menu">
                            <li id="sanstha-darta-pramanpatra">
                                <a href="<?= base_url()?>sthai-niyukti/">
                                    <span>स्थायी नियुक्ति पत्र</span>
                                </a>
                            </li>
                            <li id="bebasaya-sifaris">
                                <a href="<?= base_url()?>sawari-pass/">
                                    <span>सवारी पास उपलब्ध गराईदिने सम्वन्धमा </span>
                                </a>
                            </li>
                            <li id="bebasaya-darta">
                                <a href="<?= base_url()?>salary-verify">
                                    <span>आयश्रोत प्रमाणित गरिएको </span>
                                </a>
                            </li>

                            <li id="bebasaya-banda">
                                <a href="<?= base_url()?>upgrade-position/">
                                    <span>स्तर वृद्धि सम्वन्धमा </span>
                                </a>
                            </li>

                            <li id="bebasaya-banda">
                                <a href="<?= base_url()?>hajiri/">
                                    <span>पदस्थापन तथा हाजिर </span>
                                </a>
                            </li>

                            <li id="bebasaya-banda">
                                <a href="<?= base_url()?>kaam-kaz/">
                                    <span>कामकाज गर्न खटाईएको </span>
                                </a>
                            </li>

                            <li id="bebasaya-banda">
                                <a href="<?= base_url()?>karar-niyukti/">
                                    <span>सेवा करार नियुक्ति </span>
                                </a>
                            </li>

                             <li id="bebasaya-banda">
                                <a href="<?= base_url()?>approve-wiwaran/">
                                    <span>विवरण प्रमाणित  </span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <?php endif;?>
                    <?php if($this->session->userdata('is_muncipality') == 0): ?>
                    <li id="id_parent">
                        <a href="javascript:void(0);" class="menu-toggle">

                            <span> <i class="fa fa-id-card sidebar-icon"></i> नागरिकता सम्बन्धित</span>
                        </a>
                            
                        <ul class="ml-menu">
                          <li id="citizenship-sifaris">
                                <a href="<?= base_url()?>citizenship-sifaris">
                                    <span>नागरिकता सिफारिस</span>
                                </a>

                            </li>
                            <li id="citizenship-certificate">
                                <a href="<?= base_url()?>citizenship-certificate">
                                    <span>नागरिकता प्रमाण पत्र</span>
                                </a>

                            </li>
                            <li id="citizenship-certificate-pratilipi">
                                <a href="<?= base_url()?>citizenship-certificate-pratilipi">
                                    <span>नागरिकता प्रमाण पत्र(प्रतिलिपि)</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li id="id_parent">
                        <a href="javascript:void(0);" class="menu-toggle">

                            <span> <i class="fa fa-home sidebar-icon"></i> घर सम्बन्धित</span>
                        </a>
                        <ul class="ml-menu" id="yo" >
                            <li id="home-recommend">
                                <a id="home-recommend" href="<?= base_url()?>home-recommend">
                                    <span>घर कयामको सिफारिस</span>
                                </a>

                            </li>
                            <li id="home-road-certify">
                                <a id="home-road-certify" href="<?= base_url()?>home-road-certify">
                                    <span>घर बाटो प्रमाणित</span>
                                </a>
                            </li>
                            <li id="ghar-jagga-namsari">
                                <a id="ghar-jagga-namsari" href="<?= base_url()?>ghar-jagga-namsari/">
                                    <span>घर जग्गा नामसारी</span>
                                </a>
                            </li>
                            <li id="kitta-kat-sifaris">
                                <a href="<?= base_url()?>kitta-kat-sifaris/">
                                    <span>कित्ताकाट / प्लट मिलान</span>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li id="id_parent">
                        <a href="javascript:void(0);" class="menu-toggle">

                            <span> <i class="fa fa-map sidebar-icon"></i> जग्गा सम्बन्धित</span>
                        </a>
                        <ul class="ml-menu">
                            <li id="lalpurja-pratilipi">
                                <a href="<?= base_url()?>lalpurja-pratilipi">
                                    <span>जग्गाधनी लाल पुर्जा प्रतिलिपि</span>
                                </a>
                            </li>
                            <li id='bato-kayam'>
                                <a href="<?= base_url()?>bato-kayam" class="">
                                    <span>बाटो कायम</span>
                                </a>
                            </li>
                            <li id='purjama-ghar-kayam'>
                                <a href="<?= base_url()?>purjama-ghar-kayam/" class="">
                                    <span>जग्गाधनी पुर्जामा घर कायम</span>
                                </a>
                            </li>
                            <li id="char-killa">
                                <a href="<?= base_url()?>char-killa/" class="">
                                    <span>चार किल्ला सम्बन्दमा</span>
                                </a>
                            </li>
                            <li id="mohi-lagat-katta">
                                <a href="<?= base_url()?>mohi-lagat-katta/" class="">
                                    <span>मोही लागत कट्टा</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li id="id_parent">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <span> <i class="fa fa-briefcase sidebar-icon"></i> संस्था/व्यवसाय सम्बन्धित</span>
                        </a>
                        <ul class="ml-menu">
                            <li id="sanstha-darta-pramanpatra">
                                <a href="<?= base_url()?>sanstha-darta-pramanpatra/">
                                    <span>गैर नाफामुलक संस्था दर्ता <br> प्रमाणपत्र </span>
                                </a>
                            </li>
                            <li id="bebasaya-sifaris">
                                <a href="<?= base_url()?>bebasaya-sifaris/">
                                    <span>व्यवसाय दर्ता सिफारिस</span>
                                </a>
                            </li>
                            <li id="bebasaya-darta">
                                <a href="<?= base_url()?>bebasaya-darta/">
                                    <span>व्यवसाय दर्ता प्रमाणपत्र</span>
                                </a>
                            </li>

                            <li id="bebasaya-banda">
                                <a href="<?= base_url()?>bebasaya-banda/">
                                    <span>व्यवसाय बन्द बारे</span>
                                </a>
                            </li>

                            <li id="sanstha-darta">
                                <a href="<?= base_url()?>sanstha-darta/">
                                    <span>संस्था दर्ता सिफारिस</span>
                                </a>
                            </li>

                            <li id="sanstha-nabikaran">
                                <a href="<?= base_url()?>sanstha-nabikaran/">
                                    <span>संस्था नबिकरण सिफारिस</span>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li id="id_parent">
                        <a href="javascript:void(0);" class="menu-toggle">

                            <span> <i class="fa fa-file-code-o sidebar-icon"></i> बसोबास सम्बन्धित</span>
                        </a>
                        <ul class="ml-menu">
                            <li id="sthai-basobas">
                                <a href="<?= base_url()?>sthai-basobas/">
                                    <span>स्थायी बसोबास</span>
                                </a>

                            </li>
                            <li id="asthai-basobas">
                                <a href="<?= base_url()?>asthai-basobas/">
                                    <span>अस्थायी बसोबास</span>
                                </a>
                            </li>
                            <li id="antarik-basai-sarai">
                                <a href="<?= base_url()?>antarik-basai-sarai/">
                                    <span>आन्तरिक बसाई सराई</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li id="id_parent">
                        <a href="javascript:void(0);" class="menu-toggle">

                            <span> <i class="fa fa-file-code-o sidebar-icon"></i> पारिवारीक / सामाजिक सिफारीस</span>
                        </a>
                        <ul class="ml-menu">
                            <li id='nata-pramanit'>
                                <a href="<?= base_url()?>nata-pramanit/" class="">
                                    <span>नाता प्रमाणित </span>
                                </a>
                            </li>
                            <li id='janma-miti-pramanit'>
                                <a href="<?= base_url()?>janma-miti-pramanit" class="">
                                    <span>जन्म मिति प्रमाणित</span>
                                </a>
                            </li>
                            <li id="bibaha-pramanit">
                                <a href="<?= base_url()?>bibaha-pramanit/" class="">
                                    <span>विवाह प्रमाणित</span>
                                </a>
                            </li>
                            <li id='tin-pusta-pramanit'>
                                <a href="<?= base_url()?>tin-pusta-pramanit/" class="">
                                    <span>तीन पुस्ता प्रमाणित</span>
                                </a>
                            </li>
                            <li id='abibhahit-pramanpatra'>
                                <a href="<?= base_url()?>abibhahit-pramanpatra" class="">
                                    <span>अविवाहित प्रमाणपत्र</span>
                                </a>
                            </li>
                            <li id='nabalak-pramanit'>
                                <a href="<?= base_url()?>nabalak-pramanit/" class="">
                                    <span>नाबालक परिचयपत्र</span>
                                </a>
                            </li>
                            <li id='hakdar-pramanit'>
                                <a href="<?= base_url()?>hakdar-pramanit/" class="">
                                    <span>हकदार प्रमाणित</span>
                                </a>
                            </li>

                            <li id='farak-nam-thar'>
                                <a href="<?= base_url()?>farak-nam-thar/" class="">
                                    <span>फरक नाम थर सिफारिस</span>
                                </a>
                            </li>
                            <li id='farak-janma-miti'>
                                <a href="<?= base_url()?>farak-janma-miti/" class="">
                                    <span>फरक जन्म मिति सिफारिस</span>
                                </a>
                            </li>
                            <li id='farak-hijje'>
                                <a href="<?= base_url()?>farak-hijje/" class="">
                                    <span>फरक फरक अंग्रेजी हिज्जे</span>
                                </a>
                            </li>
                            <li id='apanga-pramanpatra'>
                                <a href="<?= base_url()?>apanga-pramanpatra/" class="">
                                    <span>अपाङ्ग प्रमाणपत्र </span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li id="id_parent">
                        <a href="javascript:void(0);" class="menu-toggle">

                            <span> <i class="fa fa-file-code-o sidebar-icon"></i> भौतिक पूर्वाधार निर्माण</span>
                        </a>
                        <ul class="ml-menu">
                            <li id='khanepani-jadan'>
                                <a href="<?= base_url()?>khanepani-jadan" class="">
                                    <span>खानेपानी जडान</span>
                                </a>
                            </li>

                            <li id='biduth-jadan'>
                                <a href="<?= base_url()?>biduth-jadan" class="">
                                    <span>बिधुत जडान</span>
                                </a>
                            </li>
                            <li id='jet-machine'>
                                <a href="<?= base_url()?>jet-machine/" class="">
                                    <span>जेट मेशिन</span>
                                </a>
                            </li>
                            <li id='sadak-khanne-swikriti'>
                                <a href="<?= base_url()?>sadak-khanne-swikriti/" class="">
                                    <span>सडक खन्ने स्विकृति </span>
                                </a>
                            </li>
                        </ul>
                    </li>
                 
                    <li id="id_parent">
                        <a href="javascript:void(0);" class="menu-toggle">

                            <span> <i class="fa fa-file-code-o sidebar-icon"></i> शिक्षा</span>
                        </a>
                        <ul class="ml-menu">
                            <li id='tin-pusta-pramanit'>
                                <a href="<?= base_url()?>scholarship/" class="">
                                    <span>छात्रवृत्ति सिफारिस</span>
                                </a>
                            </li>
                            <li id='add-classroom'>
                                <a href="<?= base_url()?>add-classroom/" class="">
                                    <span>कक्षा कोठा थप</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li id="id_parent">
                        <a href="javascript:void(0);" class="menu-toggle">

                            <span> <i class="fa fa-file-code-o sidebar-icon"></i> आर्थिक</span>
                        </a>
                        <ul class="ml-menu">
                           <li id='court-fee'>
                                <a href="<?= base_url()?>court-fee/" class="">
                                    <span>अदालत शुल्क मिनाह</span>
                                </a>
                            </li>
                            <li id='arthik-saheta'>
                                <a href="<?= base_url()?>arthik-saheta/" class="">
                                    <span>आर्थिक सहायता</span>
                                </a>
                            </li>
                            <li id='ghar-patala'>
                                <a href="<?= base_url()?>ghar-patala" class="">
                                    <span>घर पाताल भएको</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li id="id_parent">
                        <a href="javascript:void(0);" class="menu-toggle">

                            <span><i class="fa fa-info sidebar-icon"></i> अंग्रेजी (English)</span>
                        </a>
                        <ul class="ml-menu">
                            <li id="birth-certificatte">
                                <a href="<?= base_url()?>birth-certificate">
                                    <span>Birth Certificate</span>
                                </a>
                            </li>
                            <li id="birth-certificatte">
                                <a href="<?= base_url()?>relationship">
                                    <span>Relationship</span>
                                </a>

                            </li>
                            <li id="birth-certificatte">
                                <a href="<?= base_url()?>address-verification-en">
                                    <span>Address Verification</span>
                                </a>

                            </li>
                            <li id="birth-certificatte">
                                <a href="<?= base_url()?>tax-clearance-en">
                                    <span>Taxclearence</span>
                                </a>
                            </li>
                            <li id="birth-certificatte">
                                <a href="<?= base_url()?>annual-income-en">
                                    <span>Annual Income</span>
                                </a>
                            </li>
                            <li id="birth-certificatte">
                                <a href="<?= base_url()?>property-valuation-en">
                                    <span>Property Valuation</span>
                                </a>
                            </li>

                            <li id="birth-certificatte">
                                <a href="<?= base_url()?>name-verification-en">
                                    <span>Name Verification</span>
                                </a>
                            </li>

                            <li id="birth-certificatte">
                                <a href="<?= base_url()?>unmarried-en">
                                    <span>Unmarried Verification</span>
                                </a>
                            </li>

                            <li id="birth-certificatte">
                                <a href="<?= base_url()?>married-en">
                                    <span>Married Verification</span>
                                </a>
                            </li>
                          
                        </ul>
                    </li>
                    <li id="id_parent">
                        <a href="javascript:void(0);" class="menu-toggle">

                            <span> <i class="fa fa-file-code-o sidebar-icon"></i> अन्य</span>
                        </a>
                        <ul class="ml-menu">
                            <li id='kotha-khali-suchana'>
                                <a href="<?= base_url()?>kotha-khali-suchana/" class="">
                                    <span>कोठा खाली सूचना</span>
                                </a>
                            </li>
                            <li id='prabhidik-mulyankan'>
                                <a href="<?= base_url()?>prabhidik-mulyankan/" class="">
                                    <span>प्राबिधिक मुल्यांकन </span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li id="id_parent">
                        <a href="javascript:void(0);" class="menu-toggle">

                            <span> <i class="fa fa-file-code-o sidebar-icon"></i> खुल्ला ढाँचा</span>
                        </a>
                        <ul class="ml-menu">
                            <li id='kotha-khali-suchana'>
                                <a href="<?= base_url()?>letter-form">
                                    <span>नेपाली</span>
                                </a>
                            </li>
                            <li id='prabhidik-mulyankan'>
                                <a href="#" class="">
                                    <span>English </span>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif;?>
                    <?php if($this->session->userdata('is_sachib') == '1'): ?>
                        <li id="id_parent">
                            <a href="javascript:void(0);" class="menu-toggle">

                                <span>सचिवालय दर्ता</span>
                            </a>
                            <ul class="ml-menu">
                                <li id="sachiwalaya-darta">
                                    <a href="<?= base_url()?>sachiwalaya-darta">
                                        <span>नयाँ दर्ता</span>
                                    </a>

                                </li>
                                <li id="sachiwalaya-darta-book">
                                    <a href="<?= base_url()?>sachiwalaya-darta-book">
                                        <span>दर्ता किताब</span>
                                    </a>

                                </li>
                            </ul>
                        </li>
                    <?php endif;?>

                    <?php if($this->session->userdata('is_muncipality') == 1): ?>
                    <li id="id_parent">
                        <a href="javascript:void(0);" class="menu-toggle">

                            <span> <i class="fa fa-address-book-o sidebar-icon"></i> दर्ता / चलानी </span>
                        </a>
                        <ul class="ml-menu">
                            <?php if($this->session->userdata('mode')== "superadmin"):?>
                            <li id="darta-fix">
                                <a href="<?= base_url()?>darta-fix">
                                    <span>दर्ता नं. रिजभ</span>
                                </a>

                            </li>
                            <?php endif;?>
                            <li id="darta-direct">
                                <a href="<?= base_url()?>darta-direct">
                                    <span>अन्य दर्ता</span>
                                </a>
                            </li>
                            <li id="maujuda-suchi">
                                <a href="<?= base_url()?>maujuda-suchi">
                                    <span>मौजुदा सुची दर्ता</span>
                                </a>
                            </li>
                            <?php if($this->session->userdata('mode')== "superadmin"):?>
                            <li id="chalani-fix">
                                <a href="<?= base_url()?>chalani-fix">
                                    <span>चलानी नं. रिजभ</span>
                                </a>

                            </li>
                            <?php endif;?>
                            <li id="chalani-direct">
                                <a href="<?= base_url()?>chalani-direct">
                                    <span>अन्य चलानी</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <?php endif;?>

                    <li id="id_parent">
                        <a href="javascript:void(0);" class="menu-toggle">

                            <span><i class="fa fa-info-circle sidebar-icon"></i> रिपोर्ट हेर्नुहोस्</span>
                        </a>
                        <ul class="ml-menu">
                            <li id="darta-report">
                                <a href="<?= base_url()?>darta-report">
                                    <span>दर्ता रिपोर्ट</span>
                                </a>
                            </li>
                            <li id="chalani-report">
                                <a href="<?= base_url()?>chalani-report">
                                    <span>चलानी रिपोर्ट</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <?php if($this->session->userdata('is_muncipality') == 1): ?>
                        <li id="id_parent" style="">
                            <a href="javascript:void(0);" class="menu-toggle">
                                <span> <i class="fa fa-cogs sidebar-icon"></i> सेटिङ्हरू</span>
                            </a>
                            <ul class="ml-menu">

                                <li id="session">
                                    <a href="<?= base_url()?>yain">
                                        <span>ऐन</span>
                                    </a>
                                </li>

                                <li id="session">
                                    <a href="<?= base_url()?>bodartha">
                                        <span>बोद्यार्थ</span>
                                    </a>
                                </li>

                                <li id="session">
                                    <a href="<?= base_url()?>session">
                                        <span>आर्थिक वर्ष</span>
                                    </a>
                                </li>
                                <li id="department">
                                    <a href="<?= base_url()?>department">
                                        <span>फाँट</span>
                                    </a>
                                </li>
                                <li id="office">
                                    <a href="<?= base_url()?>office">
                                        <span>कार्यालय</span>
                                    </a>
                                </li>
                                <li id="documents">
                                    <a href="<?= base_url()?>documents">
                                        <span>कागजातको प्रकार</span>
                                    </a>
                                </li>
                                <li id="work-type">
                                    <a href="<?= base_url()?>work-type">
                                        <span>कामको प्रकार</span>
                                    </a>
                                </li>
                                <li id="service-type">
                                    <a href="<?= base_url()?>service-type">
                                        <span>सेवाको प्रकृति</span>
                                    </a>
                                </li>
                                <li id="state">
                                    <a href="<?= base_url()?>state">
                                        <span>प्रदेश</span>
                                    </a>
                                </li>
                                <li id="district">
                                    <a href="<?= base_url()?>district">
                                        <span>जिल्ला</span>
                                    </a>
                                </li>
                                <li id="local">
                                    <a href="<?= base_url()?>local">
                                        <span>न.पा./गा.वि.स.</span>
                                    </a>
                                </li>
                                <li id="ward">
                                    <a href="<?= base_url()?>ward">
                                        <span>वडा</span>
                                    </a>
                                </li>
                                <li id="old_new_address">
                                    <a href="<?= base_url()?>old_new_address">
                                        <span>साबिक / हाल ठेगाना</span>
                                    </a>
                                </li>

                                <li id="sifaris-type">
                                    <a href="<?= base_url()?>sifaris-type">
                                        <span>सिफारिसको प्रकार </span>
                                    </a>
                                </li>

                                <li id="post">
                                    <a href="<?= base_url()?>post">
                                        <span>पद</span>
                                    </a>
                                </li>
                                <li id="worker">
                                    <a href="<?= base_url()?>worker">
                                        <span>फाँट कर्मचारी</span>
                                    </a>
                                </li>
                                <li id="ward-worker">
                                    <a href="<?= base_url()?>ward-worker">
                                        <span>वडा कर्मचारी</span>
                                    </a>
                                </li>
                                <li id="home_type">
                                    <a href="<?= base_url()?>home_type">
                                        <span>घरको प्रकार</span>
                                    </a>
                                </li>
                                <li id="marriage-type">
                                    <a href="<?= base_url()?>marriage-type">
                                        <span>विवाह प्रकार </span>
                                    </a>
                                </li>
                                <li id="relation">
                                    <a href="<?= base_url()?>relation">
                                        <span>नाता</span>
                                    </a>
                                </li>
                                <li id="road_type">
                                    <a href="<?= base_url()?>road_type">
                                        <span>बाटोको प्रकार</span>
                                    </a>
                                </li>
                                <li id="disable_type">
                                    <a href="<?= base_url()?>disable-type">
                                        <span>अपाङ्गको किसिम</span>
                                    </a>
                                </li>
                                
                                <li id="land_type">
                                    <a href="<?= base_url()?>land-type">
                                        <span>जग्गाको किसिम/वर्ग</span>
                                    </a>
                                </li>

                                <li id="land_type">
                                    <a href="<?= base_url()?>LetterHeadSetting/Settings">
                                        <span>Letter Head Setting</span>
                                    </a>
                                </li>
                                
                            
                            </ul>
                        </li>
                    <?php endif;?>
                    
                </ul>
            </div>


            <div class="legal">
                <div class="copyright" id="id_copyright">
                    &copy; <b id="id_year"><?php echo date('Y')?> </b> &nbsp; <a target="_blank" href="https://bmsnepal.net">BMS</a>
                </div>
            </div>
        </aside>
    </section>
    <!-- Side Bar End -->
