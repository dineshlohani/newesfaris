<?php
    $org_local_body     = Modules::run("Settings/getLocal",$result->org_local_body);
    $org_state          = Modules::run("Settings/getState",$result->org_state);
    $org_ward           = Modules::run("Settings/getWard",$result->org_ward);
    $org_district       = Modules::run("Settings/getDistrict",$result->org_district);
    $old_new_address    = Modules::run("Settings/getOldNewAddress",$result->old_new_address);
    if(!empty($result->documents))
    {
        $documents      = explode("+",$result->documents);
    }
    $path               = base_url()."assets/documents/business/bebasaya_banda/";
    $current_session    = Modules::run('Settings/getCurrentSession',$result->session_id);
?>
<section class="content ">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <?php if(!empty($this->session->flashdata('msg'))): ?>
                <div class="alert alert-success alert-dismissible"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span><?=$this->session->flashdata('msg');?></span></div>
                <?php endif; ?>
                <?php if(!empty($this->session->flashdata('err_msg'))): ?>
                <div class="alert alert-danger alert-dismissible"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span><?=$this->session->flashdata('err_msg');?></span></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="container-fluid ">
        <nav aria-label="breadcrumb" class="bg-shadow">
            <ol class="breadcrumb px-3 py-2">
                <li class="breadcrumb-item ml-1"><a href="<?= base_url()?>dashboard">गृह</a></li>
                <?php if($is_logged_in === TRUE) {?>
                <li class="breadcrumb-item"><a href="<?= base_url()?>bebasaya-banda"> व्यवसाय बन्द बारे </a></li>
                <?php }else{?>
                <li class="breadcrumb-item active">व्यवसाय बन्द बारे</li>
                <?php }?>
                <li class="breadcrumb-item active">आवेदकको विवरण</li>
            </ol>
        </nav>
    </div>
    <div class="container-fluid font-kalimati">
        <div class="bd-example bd-example-tabs">
            <?php if($is_logged_in === TRUE):?>
            <nav class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#details" role="tab" aria-controls="home" aria-expanded="true"><i class="fa fa-info-circle"></i> बिस्तृत</a>
                <?php if($result->status != 1): ?>
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#sifaris" role="tab" aria-controls="profile" aria-expanded="false"><i class="fa fa-print"></i>सिफारिस प्रिन्ट गर्नुहोस </a>
                <?php endif; ?>
            </nav>
            <?php endif;?>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade active show" id="details" role="tabpanel" aria-labelledby="nav-home-tab" aria-expanded="true">
                    <div class="row">
                        <div class="offset-lg-2 col-lg-8">
                            <table class="table table-bordered my-4 font-kalimati">
                                <tbody>
                                    <tr>
                                        <td>
                                            फारम ID
                                        </td>
                                        <td>
                                            <?= $result->form_id?>
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
                                           <?=$result->gender_spec?> <?= $result->owner_name ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            दर्ता नं.
                                        </td>
                                        <td>
                                            <?= $result->darta_no ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            नागरिकता नं.
                                        </td>
                                        <td>
                                            <?= $result->cit_no ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            व्यवसायीको प्रकार
                                        </td>
                                        <td>
                                            <?= $result->org_type ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>व्यवसायीको प्रकृति</td>
                                        <td>
                                            <?= $result->org_size ?>
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
                                            टोल
                                        </td>
                                        <td>
                                            <?= $result->tole ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            व्यवसाय रहेको बाटोको नाम
                                        </td>
                                        <td>
                                            <?= $result->road_name ?>
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
                                            व्यवसाय बन्द गरिएको मिति
                                        </td>
                                        <td>
                                            <?= $result->nepali_closed_date ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            सर्जमिन गरेको मिति
                                        </td>
                                        <td>
                                            <?= $result->nepali_observed_date ?>
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
                                                    <a class="btn btn-warning btn-submit mt-3 btn-block  " href="<?= base_url() ?>bebasaya-banda/edit/<?= $result->id ?>/">सम्पादन
                                                        गर्नुहोस्</a>
                                                </div>
                                                <div class="col-lg-6">
                                                    <a class="btn btn-success btn-submit  mt-3 btn-block  " href="<?= base_url() ?>bebasaya-banda/darta/<?= $result->id ?>/">
                                                        दर्ता गर्नुहोस</a>
                                                </div>
                                                <?php
                                                   }
                                                   elseif ($result->status == 2) {
                                               ?>
                                               <div class="col-lg-6">
                                                    <a class="btn btn-warning btn-submit mt-3 btn-block  " href="<?= base_url() ?>bebasaya-banda/edit/<?= $result->id ?>/">सम्पादन
                                                        गर्नुहोस्</a>
                                                </div>
                                                <div class="col-lg-6">
                                                    <a class="btn btn-success btn-submit mt-3 btn-block  " href="<?= base_url() ?>bebasaya-banda/chalani/<?= $result->id ?>/">
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
                <?php if($is_logged_in === TRUE):?>
                <?php if($result->status != 1): ?>
                <div class="tab-pane fade" id="sifaris" role="tabpanel" aria-labelledby="nav-profile-tab" aria-expanded="false">

                    <div class="text-right">
                        <?php if($result->status == 3 ) : ?>
                            <?php echo form_open(base_url().'bebasaya-banda/print/'.$result->id ,'target="_blank"'); ?>
                            <button type="submit" class="btn  btn-success  mb-4"><i class="fa fa-print"></i> &nbsp; &nbsp; छाप्नुहोस्</button>
                        <?php endif;?>
                    </div>
                    <div class="letter_print">
                        <div class="letter-head">
                            <!-- Letter head -->
                            <div class="row">
                                <div class="col-3 letter-head-left">
                                    <img src="<?=base_url()?>assets/images/icons/logo.png" alt="logo.png">
                                    <span class="red"> पत्र संख्या: </span> <?= $current_session->name ?><br>
                                    <span class="red"> चलानी नं.: </span> <?php  echo !empty($chalani_no)?$chalani_no:'चलानी गरिएको छैन' ?>
                                </div>
                                <div class="col-6 letter-head-center red">
                                    <h2><?= SITE_OFFICE ?></h2>
                                    <div>
                                        <?php if($this->session->userdata('is_muncipality') == 1):?>
                                        <h3> <?= SITE_PALIKA ?> </h3>
                                        <?php else: ?>
                                        <h3><?=$this->session->userdata('ward_no')?> <?= SITE_WARD_OFFICE ?></h3>
                                        <?php endif; ?>
                                        <?php if($this->session->userdata('is_muncipality')==0):?>
                                        <h3><?=  $this->session->userdata('address').", ".SITE_DISTRICT?> </h3>
                                        <?php else: ?>
                                        <h3><?= SITE_ADDRESS ?></h3>
                                        <?php endif;?>
                                        <h4><?= SITE_STATE ?> </h4>
                                    </div>
                                </div>
                                <div class="col-3 text-right letter-head-right">
                                    <div class="myclear"> </div>
                                    <span class="red"> मिति : </span> <?= $chalani_result->nepali_chalani_miti?>
                                </div>
                            </div>
                        </div><!-- Letter head end -->
                        <div class="col-md-3">
                            <?php
                                       if($print_detail != FALSE)
                                       {
                                           $this_office = Modules::run('Settings/getOffice',$print_detail->office_id);
                                       }
                                   ?>
                            <div class="row non-border-input">
                                <input type="text" id="office_sambodhan" class="form-control" value="<?= $print_detail != FALSE ? $this_office->sambodhan : ''?>">
                            </div>
                            <div class="row">
                                <select name="office_id" id="office_id" class="select2" style="width:100%;">
                                    <option value="">छान्नुहोस्</option>';
                                    <?php foreach($offices as $office):?>
                                    <option value="<?=$office->id?>" <?php if($print_detail->office_id == $office->id){echo 'selected="selected"';}?>><?=$office->name?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <div class="row non-border-input">
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
                        <div class="text-center mt-2 mb-5 pb-2">
                            <h4><span style="border-bottom: 1px solid black; margin-bottom: 3px;"> <span class="red"> बिषय: </span> व्यवसाय बन्द बारे। </span>
                            </h4>
                        </div>
                        <div class="text-justify" style="text-indent: 60px;">
                            <?= $org_local_body->name ?> वडा नं <?= $org_ward->name ?>
                            को <?= $result->org_name ?> (साबिकको
                            ठेगाना <?= $old_new_address->name ?>) मा रहेको <?=$result->gender_spec?> <?= $result->owner_name?> को
                            नाममा रहेको निम्न उल्लेखित व्यवसाय मिति <?= $result->nepali_closed_date ?>
                            देखि
                            बन्द
                            भएको भनी निजले
                            पेश गरेको निबेदन उपर स्थल सर्जमिन बुझ्दा
                            मिति <?= $result->nepali_observed_date ?>को
                            स्थलगत सर्जमिन
                            बमोजिम निजले पेश गरेको व्यहोरा मनासिब देखिएको हुँदा सोहि प्रमाणित गरिन्छ।
                        </div>
                        <div class="mt-4">
                            <table class="table table-bordered text-center">
                                <tbody>
                                    <tr class="text-bold">
                                        <td>क्र.स.</td>
                                        <td>
                                            व्यवसायको <br> प्रकार
                                        </td>
                                        <td>
                                            व्यवसायको <br> प्रकृति
                                        </td>
                                        <td>
                                            वार्ड नं
                                        </td>
                                        <td>
                                            दर्ता नं
                                        </td>
                                        <td>
                                            टोलको नाम
                                        </td>
                                        <td>
                                            बाटोको नाम
                                        </td>
                                        <td>
                                            घर नं
                                        </td>
                                    </tr>
                                    <tr class="font-normal">
                                        <td class="font-kalimati">
                                            1
                                        </td>
                                        <td>
                                            <?= $result->org_type ?>
                                        </td>
                                        <td>
                                            <?= $result->org_size ?>
                                        </td>
                                        <td>
                                            <?= $org_ward->name ?>
                                        </td>
                                        <td>
                                            <?= $result->darta_no ?>
                                        </td>
                                        <td>
                                            <?= $result->tole ?>
                                        </td>
                                        <td>
                                            <?= $result->road_name ?>
                                        </td>
                                        <td>
                                            <?= $result->home_no ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div style="margin-top: 300px">
                            <div class="row">
                                <div class="col-3 offset-9 signature">
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
                                    <input type="text" name="post" id="ward_post" class="form-control" style="margin-top:15px;" value="<?= ($this_post != FALSE) ? 'वडा '.$this_post->name : 'वडा अध्यक्ष'?>">
                                    <?php echo form_close();?>
                                </div>
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
