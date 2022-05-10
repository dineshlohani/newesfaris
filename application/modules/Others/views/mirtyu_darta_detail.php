<?php
    $local_body     = Modules::run("Settings/getLocal",$result->local_body);
    $state          = Modules::run("Settings/getState",$result->state);
    $ward           = Modules::run("Settings/getWard",$result->ward);
    $district       = Modules::run("Settings/getDistrict",$result->district);
    $death_local_body     = Modules::run("Settings/getLocal",$result->death_local_body);
    $death_state          = Modules::run("Settings/getState",$result->death_state);
    $death_ward           = Modules::run("Settings/getWard",$result->death_ward);
    $death_district       = Modules::run("Settings/getDistrict",$result->death_district);
    $citizen_district     = Modules::run("Settings/getDistrict",$result->citizenship_district);

    if(!empty($result->documents))
    {
        $documents      = explode("+",$result->documents);

    }
    $path           = base_url()."assets/documents/others/mirtyu_darta/";
    if($result->gender == 1)
    {
        $gender = "पुरुष";
        $grandrelate = "नाति";
        $child       = "छोरा";
        $marital     = "पति";
    }
    else
    {
        $gender = "महिला";
        $grandrelate = "नातिनी";
        $child       = "छोरी";
        $marital     = "पत्नी";
    }

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
                        <li class="breadcrumb-item ml-1"><a href="<?= base_url()?>dashboard">गृह</a></li>


                        <li class="breadcrumb-item"><a href="<?= base_url()?>mirtyu-darta/">मृत्यु दर्ता</a></li>

                        <li class="breadcrumb-item active">विवरण</li>

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

                    <div class="tab-pane fade active show font-kalimati" id="details" role="tabpanel"
                         aria-labelledby="nav-home-tab"
                         aria-expanded="true">
                        <div class="row">
                            <div class="offset-lg-2 col-lg-8">
                                <table class="table table-bordered my-4">
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
                                    <tr>
                                        <td>
                                            आवेदकको नाम
                                        </td>
                                        <td><?= $result->applicant_name?></td>
                                    </tr>
                                    <tr class="text-center font-bold font-20">
                                        <td colspan="2">
                                            मृतकको विवरण
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            नाम
                                        </td>
                                        <td><?= $result->death_person_name?></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            लिङ्ग
                                        </td>
                                        <td>
                                            <?= $gender ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            उमेर
                                        </td>
                                        <td>
                                            <?= $result->age ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            मृत्यु भएको मिति
                                        </td>
                                        <td>
                                            <?= $result->nep_dod ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            मृत्यु भएको स्थान
                                        </td>
                                        <td>
                                            <?= $death_local_body->name.", वडा नं ".$death_ward->name.", ".$death_district->name.", ".$state->name ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            बुवाको नाम
                                        </td>
                                        <td><?= $result->father_name ?></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            आमाको नाम
                                        </td>
                                        <td>
                                            <?= $result->mother_name ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            बाजेको नाम
                                        </td>
                                        <td>
                                            <?= $result->grandfather_name ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            स्थायी ठेगाना
                                        </td>
                                        <td>
                                            <?= $local_body->name."-".$ward->name.", ".$district->name.", ".$state->name ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            नागरिकता नं
                                        </td>
                                        <td>
                                            <?= !empty($result->citizenship_no) ? $result->citizenship_no : 'N/A' ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            नागरिकता जारी मिति
                                        </td>
                                        <td>
                                            <?= !empty($result->citizenship_no) ? $result->citizenship_nep_date : 'N/A' ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            नागरिकता जारी जिल्ला
                                        </td>
                                        <td>
                                            <?= !empty($result->citizenship_no) ? $result->citizenship_district : 'N/A' ?>
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
                                                 href="<?= base_url() ?>mirtyu-darta/edit/<?= $result->id ?>/">सम्पादन
                                               गर्नुहोस्</a>
                                             </div>
                                             <div class="col-lg-6">
                                               <a class="btn btn-success btn-submit  mt-3 btn-block  "
                                               href="<?= base_url() ?>mirtyu-darta/darta/<?= $result->id ?>/">
                                             दर्ता गर्नुहोस</a>
                                           </div>
                                           <?php
                                         }
                                         elseif ($result->status == 2) {
                                           ?>
                                           <div class="col-lg-6">
                                             <a class="btn btn-warning btn-submit mt-3 btn-block  "
                                             href="<?= base_url() ?>mirtyu-darta/edit/<?= $result->id ?>/">सम्पादन
                                           गर्नुहोस्</a>
                                         </div>
                                         <div class="col-lg-6">
                                           <a class="btn btn-success btn-submit mt-3 btn-block  "
                                           href="<?= base_url() ?>mirtyu-darta/chalani/<?= $result->id ?>/">
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

                </div>

                    <?php if($result->status != 1): ?>
                        <div class="tab-pane fade" id="sifaris" role="tabpanel" aria-labelledby="nav-profile-tab"
                             aria-expanded="false">

                            <div class="text-right">
                              <?php if($result->status ==3 ): ?>
                                <?php echo form_open(base_url().'mirtyu-darta/print/'.$result->id ,'target="_blank"'); ?>
                                <button type="submit" class="btn  btn-success  mb-4" ><i class="fa fa-print"></i> &nbsp; &nbsp; छाप्नुहोस्</button>
                              <?php endif;?>
                            </div>

                            <div class="font-24 text-black " style="line-height: 2;">
                                <div>
                                    <img src="<?=base_url()?>assets/images/icons/logo.png" alt="logo.png" style="height: auto; width: 16%; ">
                                    <p class=" pt-3 font-20 font-bold">
                                        पत्र संख्या: <?= $current_session->name ?><br>
                                        चलानी नं.: <?php echo  !empty($chalani_no)?$chalani_no:'चलानी गरिएको छैन' ?>
                                    </p>
                                </div>
                                <div class="text-center font-bold" style="margin-top: -240px;">
                                    <h2 style="font-size: 36px; font-weight:500; "><?= SITE_OFFICE ?></h2>
                                    <?php if($this->session->userdata('is_muncipality') == 1):?>
                                        <h3 style="font-size: 34px; font-weight:500; margin-top: -5px;">
                                             <?= SITE_PALIKA ?>
                                        </h3>
                                    <?php else: ?>
                                        <h3 style="font-size: 34px; font-weight:500; margin-top: -5px;">
                                             <?=$this->session->userdata('ward_no')?> <?= SITE_WARD_OFFICE ?>
                                        </h3>
                                    <?php endif; ?>
                                    <?php if($this->session->userdata('is_muncipality')==0):?>
                                        <h3 style="margin-top: -5px; font-weight:500; font-size:28px "><?=  $this->session->userdata('address').", ".SITE_DISTRICT?> </h3>
                                     <?php else: ?>
                                         <h3 style="margin-top: -5px; font-weight:500; font-size:28px "><?= SITE_ADDRESS ?></h3>
                                     <?php endif;?>
                                    <p style="font-size:24px; font-weight: 500; margin-top:-5px;">
                                        <?= SITE_STATE ?> </p>
                                </div>

                                <div>
                                    <p class="text-right">
                                        मिति : <?= $chalani_result->nepali_chalani_miti ?>
                                    </p>
                                </div>
                                <div class="col-md-3">
                                    <?php
                                        if($print_detail != FALSE)
                                        {
                                            $this_office = Modules::run('Settings/getOffice',$print_detail->office_id);
                                        }
                                    ?>
                                    <div class="row" style="margin-bottom:10px;">
                                        <input type="text" id="office_sambodhan" class="form-control" value="<?= $print_detail != FALSE ? $this_office->sambodhan : ''?>">
                                    </div>
                                    <div class="row" style="margin-bottom:10px;">
                                        <select name="office_id" id="office_id" class="select2" style="width:100%;">
                                            <option value="">छान्नुहोस्</option>';
                                        <?php foreach($offices as $office):?>
                                            <option value="<?=$office->id?>"
                                                <?php if($print_detail->office_id == $office->id){echo 'selected="selected"';}?>
                                            ><?=$office->name?></option>
                                        <?php endforeach;?>
                                        </select>
                                    </div>
                                    <div class="row" style="margin-bottom:10px;">
                                        <input type="text" id="office_address" class="form-control" value="<?= $print_detail != FALSE ? $this_office->address : ''?>">
                                    </div>
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                                <!-- The Modal Start -->
                                <div class="modal" id="myModal">
                                  <div class="modal-dialog">
                                    <div class="modal-content">

                                      <!-- Modal Header -->
                                      <div class="modal-header">
                                        <h4 class="modal-title ">कार्यालय थप</h4>
                                        <button type="button" class="close" data-dismiss="modal">&#10006;</button>
                                      </div>

                                      <!-- Modal body -->
                                      <div class="modal-body">

                                          <div class="col-md-10" style="font-size:17px; color:black;">
                                              <div class="form-group row">
                                                  सम्बोधन: <input type="text" id="sambodhan" name="sambodhan" class="form-control">
                                              </div>
                                              <div class="form-group row">
                                                  कार्यालयको नाम: <input type="text" id="office_name" name="office_name" class="form-control">
                                              </div>
                                              <div class="form-group row">
                                                  ठेगाना: <input type="text" id="address" name="address" class="form-control">
                                              </div>

                                          </div>
                                      </div>

                                      <!-- Modal footer -->
                                      <div class="modal-footer">
                                          <button type="button" id="submit_office" name="submit_office" class="btn btn-success">Save</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                      </div>

                                    </div>
                                  </div>
                                </div>
                                <!-- ----------------------Modal End-------------- -->
                                <div class="text-center font-28" style="margin-top: 120px; margin-bottom: 70px;">
                                    <h4><span
                                            style="border-bottom: 1px solid black; margin-bottom: 5px; font-size:18px"> बिषय: मृत्यु दर्ताको प्रमाणपत्र |</span>
                                    </h4>
                                </div>


                                <div class="text-justify" style="text-indent: 120px;font-size:18px">
                                    यस कार्यालयमा खडा गरिएको मृत्यु दर्ता किताब अनुसार प्रमाणित गरिन्छ कि सूचक श्री/श्रीमती <?= $result->applicant_name ?>ले
                                    भरेको अनुसूची ३, को सूचना फारम बमोजिम श्री <?= $result->grandfather_name ?>को नाति/नातिनी श्री <?= $result->father_name?>को
                                    छोरा/छोरी
                                        <?php if(!empty($result->husband_wife_name)):?>
                                            श्री <?= $result->husband_wife_name  ?>को पति/पत्नी
                                        <?php endif;?>
                                    <?= $state->name ?> <?= $district->name ?> जिल्ला <?= $local_body->name ?>
                                    वडा नं <?= $ward->name ?> मा बस्ने वर्ष <?= $result->age?> को श्री/श्रीमती <?= $result->death_person_name ?>को मिति वि.स. <?= $result->nep_dod ?> (ई.स. <?= $result->eng_dod?>) गते
                                    <?php   ?> वडा नं <?php ?>मा मृत्यु भएको हो |
                                </div>

                                <?php if(!empty($result->citizenship_no)): ?>
                                    <div class="col-md-6" style="margin-top:30px;font-size:18px">
                                      <table class="boderless">
                                          <tr>
                                               <td>नागरिकताको प्रमाणपत्र नं </td>
                                               <td >&nbsp;<?= $result->citizenship_no ?></td>
                                           </tr>
                                           <tr>
                                               <td>जारी मिति र जिल्ला</td>
                                               <td><?= $result->citizenship_nep_date ?> / <?= $citizen_district->name ?></td>
                                           </tr>
                                      </table>
                                    </div>
                                <?php endif;?>
                                <div class="col-md-6 pull-right" >
                                    <table class="borderless " style="font-size:18px!important;position:relative;top:-78px">
                                        <tr>
                                            <td>
                                                <span class="">नाता प्रमाणित गर्ने अधिकारीको:-</span>
                                                <div class="text-center">
                                                    ................................. <br>
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
                                                            <option value="<?= $worker->id ?>"
                                                                <?php
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
                                                                ?>
                                                            ><?= $worker->name ?></option>
                                                        <?php endforeach;?>
                                                    </select>
                                                    <input type="text" name="post" id="ward_post" class="form-control" style="margin-top:15px;" value="<?= ($this_post != FALSE) ? 'वडा '.$this_post->name : 'वडा अध्यक्ष'?>">
                                                    <?php echo form_close();?>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
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
