<?php
$b_local_body     = Modules::run("Settings/getLocal",$result->b_local_body);
$b_ward           = Modules::run("Settings/getWard",$result->b_ward);
$b_state          = Modules::run("Settings/getState",$result->b_state);
$b_district       = Modules::run("Settings/getDistrict",$result->b_district);

$p_local_body     = Modules::run("Settings/getLocal",$result->p_local_body);
$p_ward           = Modules::run("Settings/getWard",$result->p_ward);
$p_state          = Modules::run("Settings/getState",$result->p_state);
$p_district       = Modules::run("Settings/getDistrict",$result->p_district);

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
$worker_post        = Modules::run('Settings/getPost',$ward_worker->post_id);
//$user             = Modules::run("User");
$birthdate_nep = explode("-",$result->nep_dob);
$birthdate_eng = explode("-",$result->eng_dob);
$from = new DateTime($result->eng_dob);
$to   = new DateTime();
$age= $to->diff($from)->y;
if(!empty($result->documents))
{
    $documents      = explode("+",$result->documents);
}
$path           = base_url()."assets/documents/certificate/citcertificate/";
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
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">-->
<section class="content ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <?php if(!empty($this->session->flashdata('msg'))): ?>
                    <div  class="alert alert-success alert-dismissible" >    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span><?=$this->session->flashdata('msg');?></span></div>
                <?php endif; ?>
                <?php if(!empty($this->session->flashdata('err_msg'))): ?>
                    <div  class="alert alert-danger alert-dismissible" >    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span><?=$this->session->flashdata('err_msg');?></span></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="container-fluid ">
        <nav aria-label="breadcrumb" class="bg-shadow">
            <ol class="breadcrumb px-3 py-2">
                <li class="breadcrumb-item ml-1"><a href="<?=base_url()?>certificate-dashboard">गृह</a></li>
                <li class="breadcrumb-item"><a href="<?=base_url()?>citizenship-certificate/">नागरिकता प्रमाण पत्र</a></li>
                <li class="breadcrumb-item active">आवेदकको विवरण</li>
            </ol>
        </nav>
    </div>
    <div class="container-fluid font-kalimati">
        <div class="bd-example bd-example-tabs">
            <nav class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#details" role="tab"
             aria-controls="home" aria-expanded="true">बिस्तृत</a>
             <?php if($result->status != 1): ?>
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#sifaris" role="tab"
                aria-controls="profile" aria-expanded="false">सिफारिस</a>
            <?php endif; ?>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div  class="tab-pane fade active show" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"
                aria-expanded="true">
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
                                        <br><strong>Full Name(In Block) :- </strong><span
                                        class="text-uppercase"><?=$result->eng_first_name." ".$result->eng_middle_name." ".$result->eng_last_name?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>२</td>
                                    <td><strong>लिङ्ग :-</strong> <?= $gender ?> <span
                                        class="ml-5 pl-4"> <strong> Gender :-</strong> <?=$result->gender ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        ३
                                    </td>
                                    <?php if(!empty($result->country_name)){?>
                                    <td>
                                                    <strong>जन्मस्थान :-</strong> <span
                                                    class="mx-1"><?php echo $result->country_name;?>,</span>
                                                    <span class="mx-1"><?php echo $result->country_address;?></span> 
                                                    <br>
                                                    <strong>Place Of Birth :-</strong><span
                                                    class="mx-4"><?php echo $result->country_name_eng;?>,</span>
                                                    <span class="mx-1"><?php echo $result->country_address_eng;?></span>
                                    </td>
                                    <?php }else{?>
                                    
                                                <td>
                                                    <strong>जन्मस्थान :-</strong> <span
                                                    class="mx-1"><?=$b_state->name?>,</span>
                                                    <span class="mx-1"><?=$b_district->name?> जिल्ला,</span> <span
                                                    class="mx-1"> <?=$b_local_body->name?></span>
                                                    <span class="mx-1"> वडा नं: <?=convertedcit($result->p_eng_ward)?>,</span> टोल: <?php  echo $result->nep_bp_tole;?>
                                                    <br>
                                                    <strong>Place Of Birth :-</strong><span
                                                    class="mx-4"><?= $result->b_eng_state?>,</span>
                                                    <span class="mx-1"><?= $result->b_eng_district?> District,</span>
                                                    <span class="mx-1"><?= $result->b_eng_local_body?>, </span>
                                                    <span class="mx-1">Ward:<?=($result->p_eng_ward)?>,</span>
                                                    Tole: <?php  echo $result->eng_bp_tole; ?>
                                                </td>
                                    <?php }?>            
                                </tr>
                                <tr>
                                    <td>
                                        ४
                                    </td>
                                    <td>
                                                    <strong>स्थायी ठेगाना :-</strong></strong> <span
                                                    class="mx-4">प्रदेश: <?=$p_state->name?></span>
                                                    <span class="">जिल्ला: <?=$p_district->name?></span> <span
                                                    class="">गा.पा./न.पा.: <?=$p_local_body->name?></span>
                                                    <span class="">वडा नं: <?=convertedcit($b_ward->name)?> </span>टोल: <?=$result->nep_tole?>
                                                    <br>
                                                    <strong>Permanent Address :-</strong></strong><span
                                                    class="mx-4"><?= $result->p_eng_state?>,</span>
                                                    <span class="mx-1"><?= $result->p_eng_district?> District,</span> <span
                                                    class="mx-1"><?= $result->p_eng_local_body?>,</span>
                                                    <span class="mx-1">Ward: <?= $result->p_eng_ward?>,</span>
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
                                            <span class="mr-4 font-bold">Year</span> <?=$birthdate_eng[1]?> <span
                                            class="mr-4 font-bold">Month</span> <?=$birthdate_eng[2]?> <span
                                            class="mr-4 font-bold">Day</span>
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
                                            <strong> बाबुको नाम, थर :- </strong> <?=$result->father_name?>
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
                                            <span class="mx-4">जिल्ला: <?php if(!empty($result->husband_wife_name)){  echo $hw_district->name;}?></span>
                                            <span class="mx-4">गा.पा./न.पा.: <?php if(!empty($result->husband_wife_name)){  echo $hw_local_body->name;}?></span>
                                            <span class="mx-4">वार्ड नं: <?php if(!empty($result->husband_wife_name)){  echo $hw_ward->name;}?> </span>
                                            टोल:<?php if(!empty($result->husband_wife_name)){ echo $result->hw_tole; }?>

                                            <br>
                                            <strong>नागरिकता :- <?php if(!empty($result->husband_wife_name)){  echo $result->hw_citizenship_no; }?></strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            ९
                                        </td>
                                        <td>
                                            <strong> संरक्षकको नाम, थर :- </strong> <?= $result->protector_name ?>
                                            <br>
                                            <strong>ठेगाना :-</strong>
                                            <span class="mx-4">प्रदेश: <?=$s_state->name?></span>
                                            <span class="mx-4">जिल्ला: <?=$s_district->name?></span>
                                            <span class="mx-4">गा.पा./न.पा.: <?=$s_local_body->name?></span>
                                            <span class="mx-4">वार्ड नं: <?=$s_ward->name?> </span>
                                            टोल: <?=$result->p_tole?></strong>
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

                                            <a href="<?=  base_url()?>assets/documents/land/citcertificate/<?=$doc?>"
                                             target="_blank"><?=$doc?></a>
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
                                    <!--    <div class="row">-->
                                    <!--        <div class="col-lg-6 offset-lg-6">-->
                                    <!--            <a class="btn btn-warning  btn-submit btn-secondary mt-3"-->
                                    <!--            href="<?=  base_url()?>citizenship-certificate/edit/<?=$result->id?>">-->
                                    <!--            सम्पादन-->
                                    <!--            गर्नुहोस्-->
                                    <!--        </a>-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                </td>
                            <?php endif;?>
                            <?php if(isset($result) && $result->status==2):?>
                                <td colspan="2">
                                    <div class="row">

                                        <div class="col-lg-6 offset-lg-6">
                                                <a class="btn btn-warning  btn-submit btn-secondary mt-3"
                                                href="<?=  base_url()?>citizenship-certificate/edit/<?=$result->id?>">
                                                सम्पादन
                                                गर्नुहोस्
                                            </a>
                                        </div>

                                        <div class="col-lg-6 offset-lg-6">
                                            <a class="btn btn-info  btn-submit btn-secondary mt-3"
                                            href="<?=  base_url()?>citizenship-certificate/chalani/<?=$result->id?>">
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
                                        <a class="btn btn-warning  btn-submit btn-secondary mt-3"
                                        href="<?=  base_url()?>citizenship-certificate/edit/<?=$result->id?>">
                                        सम्पादन
                                        गर्नुहोस्
                                    </a>
                                </div>
                                    <div class="col-lg-6 offset-lg-6">
                                        <a class="btn btn-info  btn-submit btn-secondary mt-3"
                                        href="<?=  base_url()?>citizenship-certificate/darta/<?=$result->id?>">
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
<div class="tab-pane fade" id="sifaris" role="tabpanel" aria-labelledby="nav-profile-tab"
aria-expanded="false">
<div class="accordion" id="accordionExample">
    <div class="card mb-0">
        <div class="card-header" id="headingOne">
            <div class="row">
                <div  class="col-md-10" data-toggle="collapse"
                data-target="#collapseOne" aria-expanded="true"
                aria-controls="collapseOne">
                <button class="btn btn-link" type="button">
                    पहिलो पृष्ठ
                </button>
            </div>
            <div class="col-md-2">
                <div class="text-right">

                    <?php echo form_open(base_url().'citizenship-certificate/print/first/'.$result->id ,'target="_blank"'); ?>
                            <button type="submit" class="btn  btn-success  mb-4">
                            <i class="fa fa-print"></i> &nbsp; &nbsp; छाप्नुहोस्</button>
            </div>
        </div>
    </div>
</div>
<div id="collapseOne" class="collapse hide" aria-labelledby="headingOne"
data-parent="#accordionExample">
<div class="card-body myfontcolor">
    <div class="font-14 font-bold text-black" style="line-height: 1.6">
        <div class="text-center mb-3">
            अनुसुची-१ <br>
            (नियम ३ को उपनियम (१) र (३) नियम ४ को उपनियम (१) र नियम १६ को उपनियम
            (१)
            सँग
            सम्बन्धित)
        </div>
        <div class="container-fluid" style="margin-top: -10px;">
            <div class="row">
                <div class="col-9">
                    <div style="padding-top: 60px">
                        <p>श्री प्रमुख जिल्ला अधिकारी ज्यु, <br>
                            जिल्ला प्रशासन कार्यालय <br>
                            <span class="font-normal">
                                <?=SITE_DISTRICT;?><br>
                                <?=SITE_STATE;?>, नेपाल ।
                            </span>
                        </p>
                    </div>
                    <div class="col-3 text-center font-14">
                        <div class="py-5"
                        style="border: 2px solid #555; margin-left: 50px; height: 160px; width: 145px;">
                        निवेदकको दुवै कान <br> देखिने पासपोर्ट <br> साइजको फोटो
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mb-2" style="margin-top: -10px;">
            <h4>
                <u>विषय : नेपाली नागरिकताको प्रमाणपत्र पाउँ ।</u>
            </h4>
        </div>
        <div>
            महोदय,
            <br>
            <div class="text-justify" style="text-indent: 50px;">
                म <?=$result->cit_type;?>को आधारले नेपाली नागरिक भएकोले देहायको विवरण खोली
                नेपाली नागरिकताको प्रमाणपत्र पाउनको लागि सिफारिस साथ रु १० को टिकट टाँसी यो निवेदन पत्र पेश गरेको छु । मैले यसअघि नेपाली नागरिकताको प्रमाणपत्र लिएको छैन ।
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-6"
                style="border: 2px solid black; border-right: none;">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <td>
                                १
                            </td>
                            <td>
                                <strong>नाम, थर :-</strong> <?=$result->nep_first_name." ".$result->nep_middle_name." ".$result->nep_last_name?>
                                <br><strong>Full Name(In Block) :- </strong><span
                                class="text-uppercase"><?=$result->eng_first_name." ".$result->eng_middle_name." ".$result->eng_last_name?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>२</td>
                            <td><strong>लिङ्ग :-</strong> <?= $gender ?> <span
                                class="ml-5 pl-4"> <strong> Gender :-</strong> <?=$result->gender ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                ३
                            </td>
                            <?php if(!empty($result->country_name)){?>
                                    <td>
                                                    <strong>जन्मस्थान :-</strong> <span
                                                    class="mx-1"><?php echo $result->country_name;?>,</span>
                                                    <span class="mx-1"><?php echo $result->country_address;?></span> 
                                                    <br>
                                                    <strong>Place Of Birth :-</strong><span
                                                    class="mx-4"><?php echo $result->country_name_eng;?>,</span>
                                                    <span class="mx-1"><?php echo $result->country_address_eng;?></span>
                                    </td>
                                    <?php }else{?>
                                    
                                                <td>
                                                    <strong>जन्मस्थान :-</strong> <span
                                                    class="mx-1"><?=$b_state->name?>,</span>
                                                    <span class="mx-1"><?=$b_district->name?> जिल्ला,</span> <span
                                                    class="mx-1"> <?=$b_local_body->name?></span>
                                                    <span class="mx-1"> वडा नं: <?=convertedcit($result->p_eng_ward)?>,</span> टोल: <?php  echo $result->nep_bp_tole;?>
                                                    <br>
                                                    <strong>Place Of Birth :-</strong><span
                                                    class="mx-4"><?= $result->b_eng_state?>,</span>
                                                    <span class="mx-1"><?= $result->b_eng_district?> District,</span>
                                                    <span class="mx-1"><?= $result->b_eng_local_body?>, </span>
                                                    <span class="mx-1">Ward:<?=($result->p_eng_ward)?>,</span>
                                                    Tole: <?php  echo $result->eng_bp_tole; ?>
                                                </td>
                                    <?php }?>
                        </tr>
                        <tr>
                            <td>
                                ४
                            </td>
                            <td>
                                <strong>स्थायी ठेगाना :-</strong></strong> <span
                                class="mx-4">प्रदेश:<?=$p_state->name?></span>
                                <span class="">जिल्ला: <?=$p_district->name?></span> <span
                                class="">गा.पा./न.पा.: <?=$p_local_body->name?></span>
                                <span class="">वडा नं: <?=$b_ward->name?></span>टोल: <?=$result->nep_tole?>
                                <br>
                                <strong>Permanent Address :-</strong></strong><span
                                class="mx-4">Province: <?= $result->p_eng_state?></span>
                                <span class="">District: <?= $result->p_eng_district?></span> <span
                                class="">R.Municipality: <?= $result->p_eng_local_body?></span>
                                <span class="">Ward: <?= $result->p_eng_ward?></span>
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
                                    <span
                                    class="mr-4 font-bold">Year</span> <?=$birthdate_eng[1]?> <span
                                    class="mr-4 font-bold">Month</span> <?=$birthdate_eng[2]?> <span
                                    class="mr-4 font-bold">Day</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6 font-14" style="border:2px solid #555;">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td>६</td>
                                <td>
                                    <strong> बाबुको नाम, थर :- </strong> <?=$result->father_name?>
                                    <br>
                                    <strong>ठेगाना :-</strong>
                                    <span class="">प्रदेश: <?=$f_state->name?></span>
                                    <span class="">जिल्ला: <?=$f_district->name?></span>
                                    <span class="">गा.पा./न.पा.: <?=$f_local_body->name?></span>
                                    <span class="">वडा नं: <?=$f_ward->name?></span>
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
                                    <span class="">प्रदेश: <?=$m_state->name?></span>
                                    <span class="">जिल्ला: <?=$m_district->name?></span>
                                    <span class="">गा.पा./न.पा.: <?=$m_local_body->name?></span>
                                    <span class="">वडा नं: <?=$m_ward->name?></span>
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

                                    <span class="">प्रदेश: <?php if(!empty($result->husband_wife_name)){ echo $hw_state->name;}?></span>
                                    <span class="">जिल्ला: <?php if(!empty($result->husband_wife_name)){ echo $hw_district->name;}?></span>
                                    <span class="">गा.पा./न.पा.: <?php if(!empty($result->husband_wife_name)){ echo $hw_local_body->name;}?></span>
                                    <span class="">वडा नं: <?php if(!empty($result->husband_wife_name)){ echo $hw_ward->name;}?> </span>
                                    टोल:<?php if(!empty($result->husband_wife_name)){ echo $result->hw_tole; }?>

                                    <br>
                                    <strong>नागरिकता :- <?php if(!empty($result->husband_wife_name)){ echo $result->hw_citizenship_no; }?></strong>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    ९
                                </td>
                                <td>
                                    <strong> संरक्षकको नाम, थर :- </strong> <?= $result->protector_name?>
                                    <br>
                                    <strong>ठेगाना :-</strong>

                                    <span class="">प्रदेश: <?=$s_state->name?></span>
                                    <span class="">जिल्ला: <?=$s_district->name?></span>
                                    <span class="">गा.पा./न.पा.: <?=$s_local_body->name?></span>
                                    <span class="">वडा नं: <?=$s_ward->name?> </span>
                                    टोल: <?=$result->p_tole?></strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="text-center mt-2">
            मैले माथि लेखिदिएको व्यहोरा ठीक साँचो हो । झुठ्ठा ठहरे कानुन बमोजिम
            सहुँला
            बुझाउँला ।
        </div>
        <div class="row">
            <div class="col-4 offset-1 text-center">
                औठाको छाप
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
            <div class="col-4 offset-3" style="margin-left:180px;">
                <br>
                <u>भवदीय</u> <br>
                निवेदकको नाम : <?=$result->nep_first_name." ".$result->nep_middle_name." ".$result->nep_last_name?><br>
                दस्तखत : <br>
                मिति : <?=$result->nepali_date?>
            </div>
        </div>
        <div>
            <div class="text-center">
                <h2>
                    कार्यालयको सिफारिस
                </h2>
            </div>
            <div style="line-height: 1.8" class="text-justify">
              <?=$b_local_body->name." वडा नं ".$b_ward->name?>  मा
              मिति <?=$result->nep_dob?> मा जन्म भई हालसम्म
              <?=$p_local_body->name." वडा नं ".$p_ward->name?>
              मा स्थायी रुपमा वसोवास गरी आएका
              यसमा लेखिएका श्रीमान् 
              <?=$result->father_name?>  को
              <?php if($result->gender==Male){
                echo 'छोरा'; 
              }else{
                  echo 'छोरी';
              }?>
              वर्ष <?=round($age)?> को
              <?php if($result->gender==Male){
                echo ' श्री '; 
              }else{
                  echo ' सुश्री ';
              }?>
              <?=$result->nep_first_name." ".$result->nep_middle_name." ".$result->nep_last_name?>
              लाई
              म राम्ररी चिन्दछु । उपयुक्त लेखिए बमोजिमका निजको व्यहोरा जाने
              बुझे
              सम्म
              सांचो हो । निजलाई <?=$result->cit_type?>
              को आधारले
              नागरिकता प्रमाण पत्र दिए हुन्छ । उक्त विवरण झुठ्ठा ठहरे कानुन
              वमोजिम
              सहुला बुझौला / बुझाउला ।
          </div>
      </div>
      <div style="line-height: 2">
        <table class="table table-borderless">
            <tr>
                <td>
                    <p>मिति :-<?php echo $result->nepali_date?></p>
                    <p>कार्यालयको नाम :- 
                    <strong><?=convertedcit($result->b_ward)?> नं. वडा कार्यालय, <?=$b_local_body->name?></strong></p>
                </td>
                <td>
                    <label>
                    <div class="col-10 offset-9 signature">
                                <div>
                                    <select name='ward_worker' class="form-control" id="ward_worker">
                                        <option value=''>छान्नुहोस्</option>
                                        <?php
                                        foreach($workers as $worker):
                                            if($print_detail != FALSE)
                                            {
                                                $this_worker = Modules::run('Settings/getWardWorker',$print_detail->worker_id);
                                                $this_post   = Modules::run('Settings/getPost',$this_worker->post_id);
                                            }
                                            else {
                                                $this_post = FALSE;
                                            }

                                            ?>
                                            <option value="<?= $worker->id ?>" <?php
                                            if($print_detail != FALSE)
                                            {
                                                if($worker->id == $print_detail->worker_id){
                                                    echo 'selected="selected"';
                                                }
                                            }
                                            else
                                            {
                                                if($worker->post_id == 1){
                                                    echo 'selected="selected"';
                                                }
                                            }
                                            ?>><?= $worker->name ?></option>
                                        <?php endforeach;?>
                                    </select>
                                    <input type="text" name="post" id="ward_post" class="form-control" style="margin-top:15px;" value="">
                                    <?php echo form_close();?>
                                </div>
                            </div>
                        </label>    
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>
</div>
</div>
</div>
<div class="card">
    <div class="card-header" id="headingTwo">
        <div class="row">
            <div class="col-md-10" data-toggle="collapse"
            data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <button class="btn btn-link" type="button">
                दोस्रो पृष्ठ
            </button>
        </div>
        <div class="col-md-2">
            <div class="text-right">
                 <a class="btn  btn-success"
                href="<?=  base_url()?>citizenship-certificate/print/second/<?=$result->id?>"
                target="_blank"> <i class="fa fa-print"></i> &nbsp; &nbsp;
            छाप्नुहोस्</a>
        </div>
    </div>
</div>
</div>
<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
data-parent="#accordionExample">
<div class="card-body myfontcolor">
    <div class="font-14 font-bold text-black" style="line-height: 1.8">
        <div class="text-center b black font-18" style="border-bottom: 2px solid black;">
            <span class="font-normal">..............................................</span>
            <?=SITE_OFFICE_TYPE?>बाट सर्जमिन र सनाखतको लागि प्रोषित
        </div>
        <div class="text-justify mt-2">
            <span class="font-normal">...............................</span>
            <?=SITE_OFFICE_TYPE?> वडा नं <span class="font-normal">........</span>
            बस्ने
            <span
            class="font-normal">........................................................</span>
            को छोरा / छोरी  / पत्नी वर्ष <span class="font-normal">.......</span>
            को
            श्री
            / सुश्री / श्रीमती <span
            class="font-normal">.................................................................</span>
            ले एन र नियमले तोकेको प्रमाण पेश गर्न नसकेकाले निजलाई स्थलगत सर्जमिन
            र
            सनाखत
            प्रकृया अबलम्ब गरी बंशजको नाता
            / जन्मको आधारमा नागरिकता सम्बन्धी निर्माण हुन प्रेषित गरिएको छ।
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-6">
                    <div style="margin-left: -15px!important;">
                        मिति <span class="font-normal"></span><br>
                        कार्यालयको नाम <span class="font-normal">......</span>
                        <br>
                        <span class="font-normal">.................................................</span>
                    </div>
                </div>
                <div class="col-6">
                    <div style="margin-left: 100px;">
                        दस्तखत <span class="font-normal">.........................................</span>
                        <br>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-center black mt-4">
                    <h4 class="black font-18">कार्यालयले भर्ने</h4>
                </div>
                <div class="col-6"
                style="border: 2px solid black; border-right: none;">
                <div class="text-justify">
                    निवेदक / निबेदिका <span class="font-normal">..........................................</span>
                    मेरो आफ्नो
                    <span class="font-normal">........................</span>
                    नाताका
                    हुन् । निजलाई बंशजको नाताको /
                    जन्मको आधारले नेपाली
                    नागरिकताको प्रमाण पत्र दिएमा पछि सम्म फरक पर्नेछैन। फरक
                    परेमा
                    कानुन बमोजिम सहुल बुझाउला भनी
                    कार्यालयमा उपस्थित भई सनाखत सहिछाप गर्नेको
                </div>
                नाम <span
                class="font-normal">............................................................</span><br>
                ना.प्र.प.नं <span
                class="font-normal">.....................................................</span><br>
                सहिछाप <span class="font-normal">.......................................................</span><br>
                मिति <span
                class="font-normal"></span><br>
            </div>
            <div class="col-6" style="border: 2px solid black;">
                <div class="text-justify">
                    माथिको विवरण बमोजिम मेरो रोहवरमा सनाखत सहिछाप भएको ठिक
                    साचो
                    हो।
                    माथिको विवरण ठिक दुरुस्त छ फरक
                    छैन। फरक परेमा कानुन बमोजिम सहुला बुझाउन मञ्जुर छु भनी
                    सहिछाप
                    गर्ने निवेदकको
                </div>
                <br>
                <br>
                नाम <span
                class="font-normal">............................................................</span><br>
                सहिछाप <span class="font-normal">.......................................................</span><br>
                मिति <span
                class="font-normal"></span><br>
            </div>
        </div>
    </div>
    <div class="container-fluid ">
        <div class="row">
            <div class="col-6 mt-2 py-2" style="border: 2px solid black; line-height: 1.5">
                <div class="text-center">
                    <h2 class="font-14 black">
                        <u>सर्जमिनमा बस्नेको नाम, थर , ठेगाना</u>
                    </h2>
                </div>
                १. <br> २. <br> ३. <br> ४. <br> ५.
            </div>
            <div class="col-6 mt-2 py-2"
            style="border: 2px solid black; line-height: 1.5">
            <div class="text-center">
                <h2 class="font-14 black">
                    <u>सनाखत गर्ने व्यक्तिको नाम, थर , ठेगाना</u>
                </h2>
            </div>
            १. <br> २. <br> ३.
        </div>
    </div>
</div>
<div style="line-height: 1.5;">
    <div class="text-center mt-3">
        <h4 class="black font-18"><u> निर्णय </u></h4>
    </div>
    <div class="text-justify" style="text-indent: 70px;">
        यो आनुसुचिमा भएको सिफारिस, निवेदनको <span class="font-normal">.................................................</span>
        को सनाखत सहिछाप र संलग्न निम्न प्रमाणहरुका आधारमा निवेदकलाई
        बंशजको
        नाताले / जन्मको आधारले नेपाली
        नागरिकताको प्रमाण-पत्र दिन उपयुक्त हुने देखि निर्णयार्थ पेश
        गरेको
        छु।
    </div>
</div>
<div style="line-height: 1.5; ">
    <div class="text-center mt-3">
        <h4 class="black font-18"><u> संलग्न प्रमाणहरु  </u></h4>
    </div>
    <div class="container-fluid" style="margin-left: -15px;">
        <div class="row">
            <div class="col-6">
                १. <br> ३. <br> ५.
            </div>
            <div class="col-6">
                २. <br> ४. <br> ६.
            </div>
            <div class="col-12">
                <span>वितरित ना.प्र.प.नं.</span>
                <span style="margin-left: 250px;">सनाखत गराउने</span>
                <span style="margin-left: 130px;">पेश गर्ने</span>
                <span style="margin-left: 150px;">सदर गर्ने</span>
            </div>
            <div class="col-md-12">
                मिति <span class="font-normal"></span>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
</div>
<script src="<?=base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>