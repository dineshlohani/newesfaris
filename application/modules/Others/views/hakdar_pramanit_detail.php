<?php
    $local_body     = Modules::run("Settings/getLocal",$result->local_body);
    $state          = Modules::run("Settings/getState",$result->state);
    $ward           = Modules::run("Settings/getWard",$result->ward);
    $district       = Modules::run("Settings/getDistrict",$result->district);
    $relation       = Modules::run("Settings/getRelation",$result->relation);
    $home_type      = Modules::run("Settings/getHomeType",$result->home_type);

   switch($result->gender)
{
    case 1:
        $gender = 'पुरुष';
        break;
    case 2:
        $gender = 'महिला';
        break;
}

    if(!empty($result->documents))
    {
        $documents      = explode("+",$result->documents);

    }
    $path           = base_url()."assets/documents/others/hakdar_pramanit/";
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


                <li class="breadcrumb-item"><a href="<?= base_url()?>hakdar-pramanit">हकदार प्रमाणित </a></li>

                <li class="breadcrumb-item active">आवेदकको विवरण</li>

            </ol>
        </nav>
    </div>
    <div class="container-fluid font-kalimati">
        <div class="bd-example bd-example-tabs">
            <nav class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#details" role="tab" aria-controls="home" aria-expanded="true">बिस्तृत</a>
                <?php if($result->status != 1): ?>

                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#sifaris" role="tab" aria-controls="profile" aria-expanded="false">सिफारिस</a>
                <?php endif; ?>
            </nav>

            <div class="tab-content" id="nav-tabContent">

                <div class="tab-pane fade active show font-kalimati" id="details" role="tabpanel" aria-labelledby="nav-home-tab" aria-expanded="true">
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

                                    <tr class="text-center font-bold font-20">
                                        <td colspan="2">
                                            आवेदकको विवरण
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            नाम
                                        </td>
                                        <td><?= $result->applicant_name ?></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            मृतकको नाम
                                        </td>
                                        <td>
                                            <?= $result->mritak_ko_name ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            हकदारको संख्या
                                        </td>
                                        <td><?= $result->hakdar_ko_no ?></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            ठेगाना
                                        </td>
                                        <td>
                                            <?= $local_body->name.", वडा नं.-".$ward->name.", ".$district->name.", ".$state->name ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            साबिक ठेगाना
                                        </td>
                                        <td>
                                            <?= $result->old_place ?>
                                        </td>
                                    </tr>

                                    <tr class="text-center font-bold font-20">
                                        <td colspan="2">
                                            हकदारको विवरण
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            नाम
                                        <td><?= $result->hakdar_ko_name ?></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            हकदारको ना.नं.
                                        </td>
                                        <td>
                                            <?= $result->citizenship_no ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>नाता</td>
                                        <td><?= $relation->name ?></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            बुवा / पति को नाम
                                        </td>
                                        <td>
                                            <?= $result->father_husband_name ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>घर नं</td>
                                        <td>
                                            <?= $result->ghar_no ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            कित्ता नं
                                        </td>
                                        <td>
                                            <?= $result->kitta_no ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>घरको प्रकार</td>
                                        <td>
                                            <?= $home_type->name ?>
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
                                                    <a class="btn btn-warning btn-submit mt-3 btn-block  " href="<?= base_url() ?>hakdar-pramanit/edit/<?= $result->id ?>/">सम्पादन
                                                        गर्नुहोस्</a>
                                                </div>
                                                <div class="col-lg-6">
                                                    <a class="btn btn-success btn-submit  mt-3 btn-block  " href="<?= base_url() ?>hakdar-pramanit/darta/<?= $result->id ?>/">
                                                        दर्ता गर्नुहोस</a>
                                                </div>
                                                <?php
                                                   }
                                                   elseif ($result->status == 2) {
                                               ?>
                                               <div class="col-lg-6">
                                                    <a class="btn btn-warning btn-submit mt-3 btn-block  " href="<?= base_url() ?>hakdar-pramanit/edit/<?= $result->id ?>/">सम्पादन
                                                        गर्नुहोस्</a>
                                                </div>
                                                <div class="col-lg-6">
                                                    <a class="btn btn-success btn-submit mt-3 btn-block  " href="<?= base_url() ?>hakdar-pramanit/chalani/<?= $result->id ?>/">
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
                <div class="tab-pane fade" id="sifaris" role="tabpanel" aria-labelledby="nav-profile-tab" aria-expanded="false">

                    <div class="text-right">
                        <?php if($result->status == 3 ) : ?>
                        <?php echo form_open(base_url().'hakdar-pramanit/print/'.$result->id ,'target="_blank"'); ?>
                        <button type="submit" class="btn  btn-success  mb-4"><i class="fa fa-print"></i> &nbsp; &nbsp; छाप्नुहोस्</button>
                    <?php endif;?>
                    </div>

                    <div class="letter">
                        <div class="letter-head">
                            <!-- Letter head -->
                            <div class="row">
                                <div class="col-3 letter-head-left">
                                    <img src="<?=base_url()?>assets/images/icons/logo.png" alt="logo.png">
                                    <span class="red"> पत्र संख्या: </span> <?= $current_session->name ?><br>
                                    <span class="red"> चलानी नं.: </span> <?php !empty($chalani_no)? $chalani_no:'चलानी गरिएको छैन' ?>
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
                            <div class="row" style="margin-bottom:10px;">
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
                        <div class="text-center font-26" style="margin-top: 100px;">
                            <h4><span style="border-bottom: 1px solid black; margin-bottom: 5px;"> <span class="red"> बिषय : </span> सिफारिस सम्बन्धमा ।</span>

                            </h4>
                        </div>



                        <div class="text-justify mt-5">
                            उपरोक्त सम्बन्धमा <b><?= $local_body->name ?></b> वडा नं <b><?= $ward->name ?>
                            (साबिकको ठेगाना
                            <?= $result->old_place ?>)</b> बस्ने
                            <?php if ($gender!=1) {
                                echo श्री;
                            }else{
                                echo सुश्री;
                            }
                            ?>
                            <b><?= $result->applicant_name ?></b> ले हकदार प्रमाणित गरी पाउँ भनी यस
                            वडा कार्यालयमा निवेदन दिनुभएको हुँदा सो सम्बन्धमा <b><?= SITE_OFFICE ?></b> बाट मिति
                            <b><?= $result->nep_darta_date ?></b> मा गरिएको
                            द.नं. <b><?= $result->darta_no ?></b> को नाता प्रमाणित प्रमाणपत्र अनुसार मृतक
                            <?php if ($gender!=1) {
                                echo श्री;
                            }else{
                                echo सुश्री;
                            }
                            ?>
                            <b><?= $result->mritak_ko_name ?></b> का हकदारहरु देहाय बमोजिम उल्लेखित 1
                            जना मात्र भएको व्यहोराको
                            सिफारिस गरिन्छ ।
                        </div>

                        <div class=" mt-3 mb-2 font-bold text-center">
                            <div class="b">मृतकका हकदारको विवरण</div>
                        </div>

                        <table class="table table-bordered text-center">
                            <thead>
                                <th>क्र.सं</th>
                                <th>हकदारहरुको नाम</th>
                                <th>नाता</th>
                                <th>बाबु/पति को नाम</th>
                                <th>नागरिकता नं</th>
                                <th>घर नं</th>
                                <th>किता नं</th>
                                <th>घरको प्रकार</th>
                            </thead>
                            <tbody>
                                <td>
                                    १
                                </td>
                                <td>
                                    <?= $result->hakdar_ko_name ?>
                                </td>
                                <td>
                                    <?= $relation->name ?>
                                </td>
                                <td>
                                    <?= $result->father_husband_name ?>
                                </td>
                                <td>
                                    <?= $result->citizenship_no ?>
                                </td>
                                <td>
                                    <?= $result->ghar_no ?>
                                </td>
                                <td>
                                    <?= $result->kitta_no ?>
                                </td>
                                <td>
                                    <?= $home_type->name ?>
                                </td>
                            </tbody>
                        </table>

                        <div class="mt-5 pt-5">
                            <div class="row">

                                <div class="offset-9 col-3 signature">
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

            </div>
        </div>
    </div>


</section>
</div>
<script src="<?=base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>
