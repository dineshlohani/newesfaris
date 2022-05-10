<?php
    $b_local_body     = Modules::run("Settings/getLocal",$result->b_local_body);
    $b_ward           = Modules::run("Settings/getWard",$result->b_ward);
    $b_state          = Modules::run("Settings/getState",$result->b_state);
    $b_district       = Modules::run("Settings/getDistrict",$result->b_district);

    $p_local_body     = Modules::run("Settings/getLocal",$result->p_local_body);
    $p_ward           = Modules::run("Settings/getWard",$result->p_ward);
    $p_state          = Modules::run("Settings/getState",$result->p_state);
    $p_district     = Modules::run("Settings/getDistrict",$result->p_district);

    $f_local_body     = Modules::run("Settings/getLocal",$result->f_local_body);
    $f_ward           = Modules::run("Settings/getWard",$result->f_ward);
    $f_state          = Modules::run("Settings/getState",$result->f_state);
    $f_district       = Modules::run("Settings/getDistrict",$result->f_district);

    $m_local_body     = Modules::run("Settings/getLocal",$result->m_local_body);
    $m_ward           = Modules::run("Settings/getWard",$result->m_ward);
    $m_state          = Modules::run("Settings/getState",$result->m_state);
    $m_district       = Modules::run("Settings/getDistrict",$result->m_district);

    $hw_local_body     = Modules::run("Settings/getLocal",$result->hw_local_body);
    $hw_ward           = Modules::run("Settings/getWard",$result->hw_ward);
    $hw_state          = Modules::run("Settings/getState",$result->hw_state);
    $hw_district       = Modules::run("Settings/getDistrict",$result->hw_district);

    $s_local_body     = Modules::run("Settings/getLocal",$result->s_local_body);
    $s_ward           = Modules::run("Settings/getWard",$result->s_ward);
    $s_state          = Modules::run("Settings/getState",$result->s_state);
    $s_district       = Modules::run("Settings/getDistrict",$result->s_district);
   $birthdate_nep = explode("-",$result->nep_dob);
   $birthdate_eng = explode("-",$result->eng_dob);
   $from = new DateTime($result->eng_dob);
    $to   = new DateTime();
    $age= $to->diff($from)->y;
    if(!empty($result->documents))
    {
        $documents      = explode("+",$result->documents);

    }
    $path           = base_url()."assets/documents/certificate/citcertificate_pratilipi/";
    $current_session    = Modules::run('Settings/getCurrentSession',$result->session_id);
    switch($result->gender)
    {
      case 'Male' :
        $gender = 'पुरुष';
        break;
      case 'Female':
        $gender = 'महिला';
        break;
      case 'Other':
        $gender = 'अन्य';
        break;
    }
?>
<section class="content ">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="django-messages">

                </div>
            </div>
        </div>
    </div>



    <div class="container-fluid ">
        <nav aria-label="breadcrumb" class="bg-shadow">
            <ol class="breadcrumb px-3 py-2">
                <li class="breadcrumb-item ml-1"><a href="<?=base_url()?>certificate-dashboard">गृह</a></li>


                <li class="breadcrumb-item"><a href="<?=base_url()?>citizenship-certificate-pratilipi">नागरिकता
                        प्रमाणपत्रको
                        प्रतिलिपि</a></li>

                <li class="breadcrumb-item active">आवेदकको विवरण</li>

            </ol>
        </nav>
    </div>




    <div class="container-fluid font-kalimati">
        <div class="bd-example bd-example-tabs">
            <nav class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#details" role="tab" aria-controls="home" aria-expanded="true">बिस्तृत</a>
                <?php if($result->status ==3) :?>
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nibedan" role="tab" aria-controls="profile" aria-expanded="false">नागरिकताको प्रतिलिपि सिफारिस</a>
                <?php  endif;?>

            </nav>
            <div class="tab-content" id="nav-tabContent">

                <div class="tab-pane fade active show" id="details" role="tabpanel" aria-labelledby="nav-home-tab" aria-expanded="true">
                    <div class="row px-3">
                        <div class="col-md-12 mb-4  text-center">
                            <span class="font-25 font-bold">
                                फारम
                            </span>
                            <span id="myInput" class="font-18 font-bold mx-5"><?=$result->form_id?></span>


                        </div>

                        <div class="col-md-6 font-18" style="border: 1px solid #a7a4a4;">
                            <table class="table table-borderless my-4">
                                <tbody>

                                    <tr>
                                        <td>
                                            १
                                        </td>
                                        <td>
                                            <strong>नाम, थर :-</strong> <?=$result->nep_first_name." ".$result->nep_middle_name." ".$result->nep_last_name?>
                                            <br><strong>Full Name(In Block) :- </strong><span class="text-uppercase"><?=$result->eng_first_name." ".$result->eng_middle_name." ".$result->eng_last_name?></span>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td>२</td>
                                        <td><strong>लिङ्ग :-</strong> <?= $gender ?> <span class="ml-5 pl-4"> <strong> Gender :-</strong> <?=$result->gender ?></span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            ३
                                        </td>
                                        <td>
                                            <strong>जन्मस्थान :-</strong> <span class="mx-4">प्रदेश: <?=$b_state->name?></span>
                                            <span class="mx-4">जिल्ला: <?=$b_district->name?></span> <span class="mx-4">गा.पा./न.पा.: <?=$b_local_body->name?></span>
                                            <span class="mx-4">वार्ड नं:<?=$b_state->name?> </span>टोल: <?php if(empty($result->nep_bp_tole)){ echo "NONE";}else{ echo $result->nep_bp_tole;}?>
                                            <br>
                                            <strong>Place Of Birth :-</strong><span class="mx-4">Province: <?= $result->b_eng_state?></span>
                                            <span class="mx-4">District: <?= $result->b_eng_district?></span> <span class="mx-4">R.Mun/Mun: <?= $b_eng_local_body?></span>
                                            <span class="mx-4">Ward: <?= $result->b_eng_ward?></span>
                                            Tole: <?php if(empty($result->eng_bp_tole)){ echo "NONE";}else{ echo $result->eng_bp_tole;}?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            ४
                                        </td>
                                        <td>
                                            <strong>स्थाई ठेगाना :-</strong></strong> <span class="mx-4">प्रदेश:<?=$p_state->name?></span>
                                            <span class="mx-4">जिल्ला: <?=$p_district->name?></span> <span class="mx-4">गा.पा./न.पा.: <?=$p_local_body->name?></span>
                                            <span class="mx-4">वार्ड नं: <?=$b_ward->name?></span>टोल: <?=$result->nep_tole?>
                                            <br>
                                            <strong>Permanent Address :-</strong></strong><span class="mx-4">Province: <?= $result->p_eng_state?></span>
                                            <span class="mx-4">District: <?= $result->p_eng_district?></span> <span class="mx-4">R.Mun/Mun: <?= $result->p_eng_local_body?></span>
                                            <span class="mx-4">Ward: <?= $result->p_eng_ward?></span>
                                            Tole: <?=$result->eng_tole?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            ५
                                        </td>
                                        <td>
                                            <strong class="mr-4">जन्म मिति
                                                :-</strong> <?=$birthdate_nep[0]?>
                                            <span class="mr-4 font-bold">साल</span> <?=$birthdate_nep[1]?>
                                            <span class="mr-4 font-bold">महिना</span> <?=$birthdate_nep[2]?>
                                            <span class="mr-4 font-bold">गते</span>
                                            <br>
                                            <strong class="mr-4">Date Of Birth :- </strong><?=$birthdate_eng[0]?>
                                            <span class="mr-4 font-bold">Year</span> <?=$birthdate_eng[1]?> <span class="mr-4 font-bold">Month</span> <?=$birthdate_eng[2]?> <span class="mr-4 font-bold">Day</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-md-6 font-18" style="border: 1px solid #a7a4a4">
                            <table class="table table-borderless my-4">
                                <tbody>

                                    <tr>
                                        <td>६</td>
                                        <td>
                                            <strong> बुबाको नाम, थर :- </strong> <?=$result->father_name?>
                                            <br>
                                            <strong>ठेगाना :-</strong>

                                            <span class="mx-4">प्रदेश: <?=$f_state->name?></span>
                                            <span class="mx-4">जिल्ला: <?=$f_district->name?></span>
                                            <span class="mx-4">गा.पा./न.पा.: <?=$f_local_body->name?></span>
                                            <span class="mx-4">वार्ड नं: <?=$f_ward->name?></span>
                                            टोल: <?=$result->f_tole?>

                                            <br>
                                            <strong>नागरिकता :- <?=$result->f_citizenship_no?></strong>



                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            ७
                                        </td>
                                        <td>
                                            <strong> आमाको नाम, थर :- </strong> <?php echo $result->mother_name?>
                                            <br>
                                            <strong>ठेगाना :-</strong>

                                            <span class="mx-4">प्रदेश: <?=$m_state->name?></span>
                                            <span class="mx-4">जिल्ला: <?=$m_district->name?></span>
                                            <span class="mx-4">गा.पा./न.पा.: <?=$m_local_body->name?></span>
                                            <span class="mx-4">वार्ड नं: <?=$m_ward->name?></span>
                                            टोल:<?=$result->m_tole?>

                                            <br>
                                            <strong>नागरिकता :- <?=$result->m_citizenship_no?></strong>



                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            ८
                                        </td>
                                        <td>
                                            <strong> पति / पत्नीको नाम, थर :- </strong> <?=$result->husband_wife_name?>
                                            <br>
                                            <strong>ठेगाना :-</strong>

                                            <span class="mx-4">प्रदेश: <?php if(!empty($result->husband_wife_name)){ echo $hw_state->name;}?></span>
                                            <span class="mx-4">जिल्ला: <?php if(!empty($result->husband_wife_name)){ echo $hw_district->name;}?></span>
                                            <span class="mx-4">गा.पा./न.पा.: <?php if(!empty($result->husband_wife_name)){ echo $hw_local_body->name;}?></span>
                                            <span class="mx-4">वार्ड नं: <?php if(!empty($result->husband_wife_name)){ echo $hw_ward->name;}?> </span>
                                            टोल:<?php  if(!empty($result->husband_wife_name)){ echo $result->hw_tole; }?>

                                            <br>
                                            <strong>नागरिकता :- <?php  if(!empty($result->husband_wife_name)){ echo $result->hw_citizenship_no ;}?></strong>



                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            ९
                                        </td>
                                        <td>
                                            <strong> संरक्षकको नाम, थर :- </strong><?=$result->father_name?>         
                                                                              <br>
                                            <strong>ठेगाना :-</strong>

                                            <span class="mx-4">प्रदेश: <?=$s_state->name?></span>
                                            <span class="mx-4">जिल्ला: <?=$s_district->name?></span>
                                            <span class="mx-4">गा.पा./न.पा.: <?=$s_local_body->name?></span>
                                            <span class="mx-4">वार्ड नं: <?=$s_ward->name?> </span>
                                            टोल: <?=empty($result->p_tole)?'None':$result->p_tole?></strong>

                                        </td>
                                    </tr>


                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 offset-md-2">

                            <table class="table table-bordered my-4">
                                <tr class="text-center font-bold font-20">
                                    <td colspan="2">कागजात</td>
                                </tr>
                                <tr>
                                    <td>कागजातहरू</td>
                                    <td>



                                        <div>
                                            <?php $documents = explode("+", $result->documents);
                                                            foreach($documents as $doc)
                                                            {
                                                            ?>

                                            <a href="<?=  base_url()?>assets/documents/land/citcertificate_pratilipi/<?=$doc?>" target="_blank"><?=$doc?></a>
                                            <?php } ?>
                                        </div>



                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>


                    <div class="row">
                        <div class="offset-lg-2 col-lg-8">
                            <table class="table table-borderless ">
                                <tbody>

                                    <tr>

                                        <?php if(isset($result) && $result->status==1):?>
                                        <td colspan="2">


                                            <div class="row">
                                                <div class="col-lg-6 offset-lg-6">
                                                    <a class="btn btn-warning  btn-submit btn-secondary mt-3" href="<?=  base_url()?>citizenship-certificate-pratilipi/edit/<?=$result->id?>">
                                                        सम्पादन
                                                        गर्नुहोस्
                                                    </a>
                                                </div>
                                            </div>


                                        </td>
                                        <?php endif;?>
                                        <?php if(isset($result) && $result->status==2):?>
                                        <td colspan="2">


                                            <div class="row">
                                                <div class="col-lg-6 offset-lg-6">
                                                    <a class="btn btn-info  btn-submit btn-secondary mt-3" href="<?=  base_url()?>citizenship-certificate-pratilipi/chalani/<?=$result->id?>">
                                                        चलानी गर्नुहोस
                                                    </a>
                                                </div>
                                            </div>


                                        </td>
                                        <?php endif;?>
                                        <?php if(isset($result) && $result->status==1):?>
                                        <td colspan="2">


                                            <div class="row">
                                                <div class="col-lg-6 offset-lg-6">
                                                    <a class="btn btn-info  btn-submit btn-secondary mt-3" href="<?=  base_url()?>citizenship-certificate-pratilipi/darta/<?=$result->id?>">
                                                        दर्ता गर्नुहोस
                                                    </a>
                                                </div>
                                            </div>


                                        </td>
                                        <?php endif;?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <?php if($result->status == 3) :?>
                <div class="tab-pane fade" id="sifaris" role="tabpanel" aria-labelledby="nav-dropdown1-tab">
                    <div class="text-right">
                        <a class="btn   btn-success  mb-4" href="<?=  base_url()?>citizenship-certificate-pratilipi/print/<?=$result->id?>" target="_blank"> <i class="fa fa-print"></i> &nbsp; &nbsp; छाप्नुहोस्</a>
                    </div>

                    <div class="font-14 myfontcolor text-capitalize" style="line-height: 1.4">
                        <div>

                            <p>श्री प्रमुख जिल्ला अधिकारी ज्यु, <br>
                                जिल्ला प्रशासन कार्यालय <br>
                                <span class="font-normal">
                                    ..................................
                                </span>
                            </p>

                        </div>


                        <div class="text-center mb-2">
                            <h5 class="letter-subject">
                                <span style="border-bottom: 2px solid black;"> विषय : नेपाली नागरिकताको प्रमाणपत्रको प्रतिलिपि पाँऊ।</span>
                            </h5>
                        </div>

                        <div style="">
                            महोदय,
                            <br>
                            <div class="text-justify" style="text-indent: 50px;">
                                मैले मेजिष्टेट अफिस <span class="font-normal">........................../............................</span>
                                अञ्चलाधीशको कार्यालय <span class="font-normal">/...............................</span>
                                गोश्वारा कार्यालय र
                                यसै कार्यालयबाट दैहायको विवरण भएको नेपाली नागरिकता प्रमाणपत्र लिएकोमा सो
                                प्रमाणपत्रको
                                सक्कल झुत्रो भएको
                                हराएको नयाँ ढाँचाको आवश्यक भएको हुँदा सोको प्रतिलिपि पाउनका लागि सो नागरिकता
                                प्रमाणपत्रको सक्कल नक्कल
                                प्रति संलग्न राखि रु १० (दश) को टिकट टाँसी सिफारिस सहित यो निवेदन पेश गरेको छु ।
                            </div>
                        </div>
                        <h5 class="text-center mt-3"> <span class="border-b"> मैले नागरिकताको प्रमाण-पत्र लिदाको विवरण एस प्रकार छ । </span></h5>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12" style="border: 2px solid black; margin-top: 15px; padding-top: 15px; padding-bottom: 10px ;border-radius:15px;">
                                    <table class="table-borderless table" style="margin: 1px">
                                        <tbody>
                                            <tr>
                                                <td>१.</td>
                                                <td>ना.प्रा.प. नं : <?=$result->citizenship_no?>
                                                    <span class="mx-5">मिति : <?=$result->citizenship_reg_date?></span>
                                                    किसिम : <span class="font-normal font-16"><?php if($result->citizenship_type==1){ ?>वंसज<?php } ?></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>२.</td>
                                                <td> नाम, थर :<?=$result->nep_first_name." ".$result->nep_middle_name." ".$result->nep_last_name?>
                                            </tr>

                                            <tr>
                                                <td></td>
                                                <td class="font-normal font-16">Full Name (In block) :-
                                                    <span class="text-capitalize"> <?=$result->eng_first_name." ".$result->eng_middle_name." ".$result->eng_last_name?> </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>३.</td>
                                                <td>लिंग :- <?= $gender ?><span class="font-normal font-16 mx-5"> Sex:- <?=$result->gender?></span>
                                                    ४.
                                                    जन्मस्थान
                                                    :
                                                    वार्ड नं:<?=$b_ward->name.' '.$b_local_body->name.' '.$b_district->name?>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td class="font-normal font-16">
                                                    Place of Birth (In block ) : District: <?= $result->b_eng_district?> Rural/ Mun. : <?= $result->b_eng_local_body?> Ward No.: <?=$result->b_eng_ward?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>५.</td>
                                                <td>स्थायी वास्स्थान : जिल्ला :<?=$p_district->name?>
                                                    <span class="mx-5">गा.पा/ न.पा :<?=$p_local_body->name?></span>वडा
                                                    नं.
                                                    : <?=$b_ward->name?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td class="font-normal font-16">Permanent address :
                                                    District: <?= $result->p_eng_district?>
                                                    <span class="mx-5">Rural/ Mun. : <?= $result->p_eng_local_body?> </span>Ward
                                                    No.: <?= $result->p_eng_ward?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>६.</td>
                                                <td>
                                                    जन्म मिति : <?=$birthdate_nep[0]?> साल
                                                    <?=$birthdate_nep[1]?>
                                                    महिना <?=$birthdate_nep[2]?> गते/ <span class="font-normal font-16 mx-5">
                                                        Date of Birth (AD) : <?=$birthdate_eng[0]?> year <?=$birthdate_eng[1]?> Month <?=$birthdate_eng[2]?> Day
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>७.</td>
                                                <td>
                                                    बाबुको नामथर, वतन
                                                    : <?=$result->father_name?> , वार्ड-<?=$f_ward->name.' '.$f_local_body->name.' '.$f_district->name?>
                                                    <span class="ml-4">नागरिकता नं :

                                                        <?=$result->f_citizenship_no?>

                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>८.</td>
                                                <td>
                                                    आमाको नामथर, वतन : <?php echo $result->mother_name?>, वार्ड-<?=$m_ward->name.' '.$m_local_body->name.' '.$m_district->name?>
                                                    <span class="ml-4">नागरिकता नं :

                                                        <?=$result->m_citizenship_no?>

                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>९.</td>
                                                <td>
                                                    पतिको नामथर, वतन
                                                    : <?=$result->husband_wife_name?>
                                                    <span class="ml-4">नागरिकता नं:

                                                        <?=$result->hw_citizenship_no?>

                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="mt-2 text-justify" style="text-indent: 70px;">
                            माथि लेखिएको विवरण मैले <span class="font-normal">............................................</span>
                            कार्यालयबाट लिएको नं. <span class="font-normal">....................</span> को
                            ना.प्र.प.को
                            व्यहोरासंग दुरुस्त छ ।
                            फरक छैन । लेखिएको व्यहोरा झुठ्ठा ठहरेमा कानुन बमोजिम सहुँला बुझाउँला ।
                        </div>

                        <div class="row mt-4">
                            <div class="col-3 text-center">
                                <div class="b"> औठाको छाप </div>
                                <table class="finger-table table">
                                    <tr>
                                        <td>
                                            दायाँ
                                        </td>
                                        <td>
                                            बायाँ
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="height: 150px;">

                                        </td>
                                        <td>

                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-3 offset-6">
                                <div class="b text-center"> निवेदकको </div> <br>
                                दस्तखत :<br>
                                नाम, थर :<br>
                                मिति :

                            </div>
                        </div>

                        <div>
                            <!--
                                <div class="text-center" style="margin-top:-10px">
                                    <h5>
                                        <span style="border-bottom: 2px solid black;">
                                            ( प्रतिलिपि ना.प्र.य.का लागि सिफारिस )
                                        </span>
                                    </h5>
                                </div>
-->

                            <div style="line-height: 1.4" class="text-justify">
                                <?=$b_local_body->name." वडा नं ".$b_ward->name?> मा
                                मिति <?=$result->nep_dob?> मा जन्म भई हालसम्म स्थायी रुपमा वसोवास गरी
                                आएका
                                यसमा लेखिएका
                                श्रीमान् <?=$result->father_name?> को छोरा वर्ष <?=$age?> को श्री <?=$result->nep_first_name." ".$result->nep_middle_name." ".$result->nep_last_name?>
                                लाई म राम्ररी
                                चिन्दछु
                                । निजको माग बमोजिम
                                उपर्युक्त विवरण भएको नं. <?=$result->citizenship_no?>
                                मिति <?=$result->citizenship_reg_date?> को नागरिकता प्रमाणपत्रको
                                प्रतिलिपिको
                                सक्कल प्रति झुत्रो भएको
                                हराएको / नयाँ ढाँचाको आवश्यक भएको व्यहोरा
                                साँचो हुदाँ । प्रतिलिपि बनाई दिएमा फरक नपर्ने व्यहोरा सिफारिस गर्दछु । उक्त विवरण
                                झुट्टाठहरे कानुन
                                बमोजिम सहुला बुझौला / बुझाउँला ।
                            </div>
                        </div>

                        <div class="row" style="margin-top: 10px;line-height: 2">
                            <div class="col-2">
                                <p>मिति :-<br>कार्यालयको नाम :-</p>
                                <div class="py-4 text-center" style="border: 2px solid black; margin-top:-10px; height: 180px; width: 180px;">
                                    दुवै कान देखिने <br> हालसालै खिचेको <br> २.५ x ३ से.मि. <br>साइजको
                                    फोटो
                                </div>
                            </div>
                            <div class="col-3 offset-7">
                                <div class="text-center b">सिफारिस गर्नेको </div>
                                <p class="mt-2">दस्तखत : <span class="font-normal">.........................................</span>
                                </p>
                                <p>नाम, थर :
                                    <span class="font-normal">.........................................</span>
                                </p>
                                <p>पद : <span class="font-normal">................................................</span>
                                </p>
                            </div>

                        </div>


                    </div>
                </div>
                <?php endif;?>

            </div>
        </div>
    </div>

</section>
</div>
<script src="<?=base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>
