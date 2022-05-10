<?php
    $org_local_body     = Modules::run("Settings/getLocal",$result->org_local_body);
    $org_state          = Modules::run("Settings/getState",$result->org_state);
    $org_ward           = Modules::run("Settings/getWard",$result->org_ward);
    $org_district       = Modules::run("Settings/getDistrict",$result->org_district);
    $prop_local_body     = Modules::run("Settings/getLocal",$result->prop_local_body);
    $prop_state          = Modules::run("Settings/getState",$result->prop_state);
    $prop_ward           = Modules::run("Settings/getWard",$result->prop_ward);
    $prop_district       = Modules::run("Settings/getDistrict",$result->prop_district);
    $citizenship_district = Modules::run("Settings/getDistrict",$result->citizenship_district);
    $current_session    = Modules::run('Settings/getCurrentSession',$result->session_id);
    $worker_post        = Modules::run('Settings/getPost',$ward_worker->post_id);


?>
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
                           <?php if($this->session->userdata('is_muncipality')==0):?>
                            <p style="font-size: 26px;"><b><?=  $this->session->userdata('address').", ".SITE_DISTRICT?></b></p>
                            <?php else: ?>
                              <p style="font-size: 26px;"><?= SITE_ADDRESS?>,<?php echo SITE_DISTRICT_ENG?></p>
                            <?php endif;?>
                           <h4><?= SITE_STATE ?></h4>
                           <h4> स्थानीय स्वायत शासन येन २०५५ को दफा १३८ बमोजिम </h4>

                           <h1 class="cert-title mt-4"><span> व्यवसाय दर्ता प्रमाण-पत्र </span> </h1>
                       </div>
                       <div class="right-head mx-right">
                           <div class="photo-box">
                               दुवै कान देखिने हालसालै खिचेको फोटो
                           </div>
                       </div>
                       <div class="myclear mb-5"></div>
                   </div> <!-- page header end -->
                    <div class="cont mt-5 px-2" style="line-height: 28px"><!-- info -->
                          <div class="row">
                            <div class="col-md-12">
                                <div style="margin-top: -45px;">
                                   <span class="b"> दर्ता मिति :- </span> <?= $this_darta->nepali_darta_miti ?>
                                </div>

                                <div style="margin-top: 10px;">
                                  <span class="b"> प्रमाण पत्र नं. :- </span> <?= $result->certificate_no ?>
                                  <span class="b" style="margin-left: 300px;"> आर्थिक वर्ष :- </span>  <?= $current_session->name?>
                                </div>
                                <div style="margin-top: 10px;">
                                  <span class="b"> उधोग/व्यवसाय/सघसस्थाको फर्मको नाम :- </span> <?= $result->org_name?>
                                </div>
                                <div style="margin-top: 10px;">
                                 <span class="b"> व्यवसाय रहने स्थान : </span><?= $org_local_body->name?> <span class="b"> वडा नं </span>  <?= $org_ward->name?> <span class="b"> जिल्ला </span> <?= $org_district->name ?> <?= $org_state->name?> नेपाल
                                 
                                </div>
                                <div style="margin-top: 10px;">
                                  <span class="b"> व्यवसायको किसिम :- </span> <?= $result->org_type?>
                                  <span class="b"> लागत पुर्जी :- </span> <?= $result->lagat_pungi ?>
                                </div>
                                <div style="margin-top: 10px;">
                                  <span class="b"> व्यवसाय रहने घर धनीको नाम :- </span> <?= $result->house_own_name?>
                                  <span class="b"> व्यवसायीको नाम :- </span> <?= $result->owner_name ?>
                                </div>

                                <div style="margin-top: 10px;">
                                  <span class="b"> व्यवसायीको ठेगाना :- </span> <?= $prop_local_body->name?> <span class="b"> वडा नं </span> <?= $prop_ward->name?> <span class="b"> जिल्ला  </span><?= $prop_district->name ?> <?= $prop_state->name?> नेपाल 
                                </div>

                                <div style="margin-top: 10px;">
                                  <span class="b"> ना. प्र. प. नं. :- </span> जारी मिति :- <?= $result->citizenship_date?> <span class="b"> जिल्ला :- </span> <?= $citizenship_district->name ?>
                                </div>
                                <div style="margin-top: 10px;">
                                  <span class="b"> परिचय पाटी ( साईनबोर्ड) को साईज :- </span> <?= $result->sign_board?><br>
                                  <span class="b"> अन्य विवरण :- </span> <?= $result->description ?>
                                </div>
                                
                            </div>
                             <!--  <div class="col col-md-8"> <span class="b"> प्रमाण पत्र नं. :- </span> <?= $result->certificate_no ?></div>
                              <div class="col col-md-4 text-right"> <span class="b"> आर्थिक वर्ष :- </span>  <?= $current_session->name?> </div>
                              <div class="col-md-12"> <span class="b"> दर्ता मिति :- </span> <?= $this_darta->nepali_darta_miti ?></div>
                              <div class="col-md-12"> <span class="b"> उधोग / व्यवसाय / सघसस्थाको फर्मको नाम :- </span> <?= $result->org_name?> </div>
                              <div class="col-md-12"> <span class="b"> व्यवसाय रहने स्थान : </span> <?= $org_local_body->name?> <span class="b"> वडा नं </span>  <?= $org_ward->name?> <span class="b"> जिल्ला </span> <?= $org_district->name ?> <?= $org_state->name?> नेपाल</div>
                              <div class="col-md-12"> <span class="b"> व्यवसायको किसिम :- </span> <?= $result->org_type?></div>
                              <div class="col-md-12"> <span class="b"> लागत पुर्जी :- </span> <?= $result->lagat_pungi ?> </div>
                              <div class="col-md-12"> <span class="b"> व्यवसाय रहने घर धनीको नाम :- </span> <?= $result->house_own_name?> </div>
                              <div class="col-md-12"> <span class="b"> व्यवसायीको नाम :- </span> <?= $result->owner_name ?> </div>
                              <div class="col-md-12"> <span class="b"> पिता वा पतिको नाम :- </span> <?= $result->father_name?> </div>
                              <div class="col-md-12"> <span class="b"> व्यवसायीको ठेगाना :- </span> <?= $prop_local_body->name?> <span class="b"> वडा नं </span> <?= $prop_ward->name?> <span class="b"> जिल्ला  </span><?= $prop_district->name ?> <?= $prop_state->name?> नेपाल </div>
                              <div class="col-md-12"> <span class="b"> ना. प्र. प. नं. :- </span> जारी मिति :- <?= $result->citizenship_date?> <span class="b"> जिल्ला :- </span> <?= $citizenship_district->name ?>  </div>
                              <div class="col-md-12"> <span class="b"> परिचय पाटी ( साईनबोर्ड) को साईज :- </span> <?= $result->sign_board?>    </div>
                              <div class="col-md-12 mb-5"> <span class="b"> अन्य विवरण :- </span> <?= $result->description ?>  </div> -->
                             <!--  <div><span class="b"> प्रमाण पत्र नं. :- </span> <?= $result->certificate_no ?></div> -->
                           
                          </div>
                        <div class="row mt-5">
                            <div class="col-4">
                                <div class="sign b"> व्यवसायीको दस्तखत</div>
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
                            <div class="b" style="font-size: 14px;">
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
