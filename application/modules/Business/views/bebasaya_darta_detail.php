<?php
    $org_local_body     = Modules::run("Settings/getLocal",$result->org_local_body);
    $org_state          = Modules::run("Settings/getState",$result->org_state);
    $org_ward           = Modules::run("Settings/getWard",$result->org_ward);
    $org_district       = Modules::run("Settings/getDistrict",$result->org_district);
    $prop_local_body     = Modules::run("Settings/getLocal",$result->prop_local_body);
    $prop_state          = Modules::run("Settings/getState",$result->prop_state);
    $prop_ward           = Modules::run("Settings/getWard",$result->prop_ward);
    $prop_district       = Modules::run("Settings/getDistrict",$result->prop_district);
    if(!empty($result->documents))
    {
        $documents      = explode("+",$result->documents);
    }
    $path           = base_url()."assets/documents/business/bebasaya_darta/";
    $current_session    = Modules::run('Settings/getCurrentSession',$result->session_id);
?>
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
                        <li class="breadcrumb-item ml-1"><a href="/">गृह</a></li>
                        <?php if($is_logged_in === TRUE) {?>
                            <li class="breadcrumb-item"><a href="<?= base_url()?>/bebasaya-darta"> व्यवसाय दर्ता प्रमाणपत्र</a></li>
                        <?php }else{?>
                            <li class="breadcrumb-item active">व्यवसाय दर्ता प्रमाणपत्र</li>
                        <?php }?>

                            <li class="breadcrumb-item active">आवेदकको विवरण</li>
                    </ol>
                </nav>
            </div>
        <div class="container-fluid font-kalimati">
            <div class="bd-example bd-example-tabs">
            <?php if($is_logged_in === TRUE):?>
                <nav class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#details" role="tab"
                       aria-controls="home" aria-expanded="true">बिस्तृत</a>
                       <?php if($result->status != 1): ?>
                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#sifaris" role="tab"
                           aria-controls="profile" aria-expanded="false">सिफारिस</a>
                       <?php endif; ?>
                </nav>
            <?php endif;?>
                <div class="tab-content" id="nav-tabContent">

                    <div class="tab-pane fade active show" id="details" role="tabpanel" aria-labelledby="nav-home-tab"
                         aria-expanded="true">
                        <div class="row">
                            <div class="offset-lg-2 col-lg-8">
                                <table class="table table-bordered my-4 font-kalimati">
                                    <tbody>
                                    <tr>
                                        <td>
                                            फारम ID
                                        </td>
                                        <td>
                                            <?= $result->form_id ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            स्वीकृत
                                        </td>
                                        <td>
                                            <?php if($result->status == 1)
                                             {
                                            ?>
                                                 <h6 class="text-danger">नभएको</h6>
                                            <?php
                                             }
                                             else
                                             {
                                            ?>
                                                <h6 class="text-success">भएको</h6>
                                            <?php
                                                }
                                            ?>
                                        </td>
                                    </tr>

                                    <tr class="text-center font-bold font-20">
                                        <td colspan="2">व्यवसाय / फार्मको विवरण
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            व्यवसायको नाम
                                        </td>
                                        <td><?= $result->org_name ?></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            व्यवसायीको नाम
                                        </td>
                                        <td>
                                            <?= $result->owner_name ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>ना.प्रा.प.न.</td>
                                        <td><?= $result->citizenship_no?></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            व्यवसायको किसिम
                                        </td>
                                        <td>
                                            <?= $result->org_type ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            लागत पुँजी
                                        </td>
                                        <td>
                                            <?= $result->lagat_pungi ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>घरधनीको नाम</td>
                                        <td> <?= $result->house_own_name ?></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            व्यवसायीको स्थान
                                        </td>
                                        <td>
                                            <?= $prop_local_body->name.", वार्ड-".$prop_ward->name.", ".$prop_district->name.", ".$prop_state->name ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            व्यवसाय रहेको स्थान
                                        </td>
                                        <td>
                                            <?= $org_local_body->name.", वार्ड-".$org_ward->name.", ".$org_district->name.", ".$org_state->name ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            व्यवसाय रहेको घर नं
                                        </td>
                                        <td>
                                            <?= $result->home_no ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            व्यवसायीको ई-मेल
                                        </td>
                                        <td>
                                            <?= $result->org_email ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            फोन नं.
                                        </td>
                                        <td>
                                            <?= $result->org_contact_no ?>
                                        </td>
                                    </tr>
                                    <tr class="text-center font-bold font-20">
                                        <td colspan="2">कागजात</td>
                                    </tr>
                                    <tr>
                                        <td>कागजातहरू</td>
                                        <td>
                                            <div>
                                                <?php
                                                    if(!empty($result->documents))
                                                    {
                                                        foreach($documents as $doc)
                                                        {
                                                            echo "<a href='".$path.$doc."' target='_blank'>".$doc."</a><br/>";
                                                        }

                                                    }
                                                    if(empty($result->documents) && empty($result->darta_documents))
                                                    {
                                                            echo "नभएको";
                                                    }
                                                    if(!empty($result->darta_documents))
                                                    {
                                                        $darta_docs  = explode("+",$result->darta_documents);
                                                        foreach($darta_docs as $doc)
                                                        {
                                                            echo "<a href='".$path.$doc."' target='_blank'>".$doc."</a><br/>";
                                                        }
                                                    }
                                                ?>
                                            </div>
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    <?php if($is_logged_in === TRUE):?>
                        <div class="row">
                            <div class="offset-lg-2 col-lg-8">
                                <table class="table table-borderless ">
                                    <tbody>

                                    <tr>
                                        <td colspan="2">


                                            <div class="row">
                                                <?php
                                                    if($result->status == 1) {
                                                ?>
                                                        <div class="col-lg-6">
                                                            <a class="btn btn-warning btn-submit mt-3 btn-block  "
                                                               href="<?= base_url() ?>bebasaya-darta/edit/<?= $result->id ?>/">सम्पादन
                                                                गर्नुहोस्</a>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <a class="btn btn-success btn-submit  mt-3 btn-block  "
                                                               href="<?= base_url() ?>bebasaya-darta/darta/<?= $result->id ?>/">
                                                                दर्ता गर्नुहोस</a>
                                                        </div>
                                                <?php
                                                    }
                                                    elseif ($result->status == 2) {
                                                ?>
                                                        <div class="col-lg-6">
                                                            <a class="btn btn-warning btn-submit mt-3 btn-block  "
                                                               href="<?= base_url() ?>bebasaya-darta/edit/<?= $result->id ?>/">सम्पादन
                                                                गर्नुहोस्</a>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <a class="btn btn-success btn-submit mt-3 btn-block  "
                                                               href="<?= base_url() ?>bebasaya-darta/chalani/<?= $result->id ?>/">
                                                                चलानी गर्नुहोस</a>
                                                        </div>
                                                <?php
                                                    }
                                                ?>

                                            </div>


                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php endif;?>
                    </div>
                <?php if($is_logged_in === TRUE): ?>
                    <?php if($result->status != 1): ?>
                        <div class="tab-pane fade" id="sifaris" role="tabpanel" aria-labelledby="nav-profile-tab"
                             aria-expanded="false">

                            <div class="text-right">
                                <?php if($result->status == 3 ) : ?>
                                    <?php echo form_open(base_url().'bebasaya-darta/print/'.$result->id ,'target="_blank"'); ?>
                                    <button type="submit" class="btn  btn-success  mb-4" ><i class="fa fa-print"></i> &nbsp; &nbsp; छाप्नुहोस्</button>
                                <?php endif;?>
                            </div>

                            <div class="container-fluid font-kalimati">
                                       <div class="page">
                                           <div class="subpage">
                                               <div class="page-head"> <!-- page header -->
                                                   <div class="left-head">
                                                       <img src="<?= base_url()?>assets/images/icons/logo.png" alt="Logo">
                                                   </div>
                                                   <div class="center-head">
                                                       <h2><?= SITE_OFFICE ?></h2>
                                                       <h1><?=$this->session->userdata('ward_no')?> <?= SITE_WARD_OFFICE ?> </h1>
                                                       <h4><?= SITE_STATE ?></h4>
                                                       <h4> स्थानीय स्वायत शासन येन २०५५ को दफा १३८ बमोजिम </h4>

                                                       <h1 class="cert-title"> व्यवसाय दर्ता प्रमाण-पत्र </h1>
                                                   </div>
                                                   <div class="right-head mx-right">
                                                       <div class="photo-box">
                                                           दुवै कान देखिने हालसालै खिचेको फोटो
                                                       </div>
                                                   </div>
                                                   <div class="myclear"></div>
                                               </div> <!-- page header end -->
                                                <div class="cont mt-5 px-2"><!-- info -->
                                                    <div class="row">
                                                        <div class="col col-md-8"> <span class="b"> प्रमाण पत्र नं. :- </span> <?= $result->certificate_no ?></div>
                                                         <div class="col col-md-4 text-right"> <span class="b"> आर्थिक वर्ष :- </span>  <?= $current_session->name?> </div>
                                                        <div class="col-md-12"> <span class="b"> दर्ता मिति :- </span> <?= $this_darta->nepali_darta_miti ?></div>
                                                        <div class="col-md-12"> <span class="b"> उधोग / व्यवसाय / सघसस्थाको फर्मको नाम :- </span> <?= $result->org_name?> </div>
                                                        <div class="col-md-12"> <span class="b"> व्यवसाय रहने स्थान : </span> <?= $org_local_body->name?> वडा नं <?= $org_ward->name?> जिल्ला <?= $org_district->name ?> <?= $org_state->name?> नेपाल</div>
                                                        <div class="col-md-12"> <span class="b"> व्यवसायको किसिम :- </span> <?= $result->org_type?></div>
                                                        <div class="col-md-12"> <span class="b"> लागत पुर्जी :- </span> <?= $result->lagat_pungi ?> </div>
                                                        <div class="col-md-12"> <span class="b"> व्यवसाय रहने घर धनीको नाम :- </span> <?= $result->house_own_name?> </div>
                                                        <div class="col-md-12"> <span class="b"> व्यवसायीको नाम :- </span> <?= $result->owner_name ?> </div>
                                                        <div class="col-md-12"> <span class="b"> पिता वा पतिको नाम :- </span> <?= $result->father_name?> </div>
                                                        <div class="col-md-12"> <span class="b"> व्यवसायीको ठेगाना :- </span> <?= $prop_local_body->name?> वडा नं <?= $prop_ward->name?> जिल्ला <?= $prop_district->name ?> <?= $prop_state->name?> नेपाल </div>
                                                        <div class="col-md-12"> <span class="b"> ना. प्र. प. नं. :- </span> जारी मिति :- <?= $result->citizenship_date?> जिल्ला :- <?= $citizenship_district->name ?>  </div>
                                                        <div class="col-md-12"> <span class="b"> परिचय पाटी ( साईनबोर्ड) को साईज :- </span> <?= $result->sign_board?>    </div>
                                                        <div class="col-md-12 mb-5"> <span class="b"> अन्य विवरण :- </span> <?= $result->description ?>  </div>
                                                    </div>
                                                    <div class="row mt-5">
                                                        <div class="col-4 ">
                                                            <div class="sign b"> व्यवसायीको दस्तखत </div>
                                                        </div>
                                                        <div class="col-4 text-center">
                                                            <div class="sign b"> तयार गर्नेको दस्तखत </div>
                                                        </div>
                                                        <div class="col-4 text-right">
                                                            <div class="sign b"> वडा अध्यक्ष </div>
                                                        </div>
                                                    </div>
                                                    <div class="b-line mt-3"> </div>
                                                    <div class="myclear"></div>
                                                    <div class="row px-3 mt-4">
                                                        <h4> शर्तहरु :- </h4>
                                                        <div class="b">
                                                            १. प्रत्येक आ.व. को कर अषाढ मसान्त भित्र बुझाई सक्नु पर्नेछ । सो म्याद भित्र नबुझाएमा प्रत्येक महिना १० प्रतिशतको दरले जरिवाना लाग्ने छ । गाउँपालिका कार्यालयवाट कर असुली टोली खटाउदा सोहि समयमा नै व्यवसाय नविकरण गर्नुपर्नेछ । <br>
                                                            २. व्यवसाय गरी आएको स्थान बदल्नु परेमा गाउँपालिकावाट पूर्व स्वीकृती लिनु पर्नेछ । <br>
                                                            ३. आफुले संचालन गरेको व्यवसाय बन्द गर्नु परेमा वा छाडनु परेमा गाउँपालिका ३५ दिन भित्र लिखित जानकारी गराउनु पर्नेछ । <br>
                                                            ४. यो प्रमाण पत्र व्यवसाय गरेको स्थानमा सबैले देख्ने गरी राख्नु पर्दछ र गाउँपालिकाको कर्मचारीले हेर्न चाहेको वखत देखाउनु पर्नेछ । <br>
                                                            ५. आफुले संचालन गरेको व्यवसायमा वाल श्रमिकको प्रयोग गर्न पाईने छैन र गरेको देखिएमा कानुन बमोेजिम कारवाही गरिनेछ । <br>
                                                            ६. व्यवसायवाट निस्केको फोहोरमैललाहरु व्यवसायी आफैले व्यवस्थि तर्नु पर्नेछ । <br>
                                                            ७. उपरोक्त उल्लेखित शर्तहरु पालना नगरेमा गाउँपालिकाले जुनसुकै बखतमा पनि यो प्रमाण पत्र रद्ध गरी व्यवसाय बन्द गर्न सक्नेछ । <br>
                                                            ८. यस कार्यलयमा दर्ता भएपछि पनि सम्वन्धित व्यवसायीले सम्वन्धित निकायवाट अनिवार्य रुपमा अनुमती पत्र लिएर मात्र व्यवाशाय संचालन गर्नु पर्नेछ । <br>

                                                        </div>
                                                    </div>
                                                </div><!-- info end -->

                                           </div>
                                       </div>
                                    </div>

                        </div>
                        <?php endif;?>
                    <?php endif;?>

                </div>
            </div>
        </div>


    </section>
</div>
<script src="<?=base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>
