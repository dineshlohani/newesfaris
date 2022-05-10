<?php
$a_local_body     = Modules::run("Settings/getLocal",$result->a_local_body);
$l_local_body     = Modules::run("Settings/getLocal",$result->l_local_body);
$a_state          = Modules::run("Settings/getState",$result->a_state);
$l_state          = Modules::run("Settings/getState",$result->l_state);
$a_ward           = Modules::run("Settings/getWard",$result->a_ward);
$l_ward           = Modules::run("Settings/getWard",$result->l_ward_no);

$a_district       = Modules::run("Settings/getDistrict",$result->a_district);
$l_district       = Modules::run("Settings/getDistrict",$result->l_district);
if(!empty($result->documents))
{
    $documents      = explode("+",$result->documents);

}
$path           = base_url()."assets/documents/land/lalpurja/";
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
            <ol class="breadcrumb">
                <li class="breadcrumb-item ml-1"><a href="<?=base_url()?>land-dashboard">गृह</a></li>


                <li class="breadcrumb-item"><a href="<?=base_url()?>lalpurja-pratilipi">जग्गाधनी लाल पुर्जा प्रतिलिपि </a>
                </li>

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
                <?php endif;?>
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
                                            <?=$result->form_id;?>
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
                                            आबदेकको विवरण
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            नाम
                                        </td>
                                        <td><?=$result->gender_spec?> <?=$result->applicant_name?></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            ना.प्र.नं.
                                        </td>
                                        <td>
                                            <?=$result->citizenship_no?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            ना.प्र. जारी मिति
                                        </td>
                                        <td><?=$result->nep_citizenship_date?></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            बुवाको नाम
                                        </td>
                                        <td>
                                            <?=$result->father_name ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            बाजेको नाम
                                        </td>
                                        <td>
                                            <?=$result->grandfather_name ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            ठेगाना
                                        </td>
                                        <td>
                                            <?= $a_local_body->name.", वार्ड-".$a_ward->name.", ".$a_district->name.", ".$a_state->name ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            साबिक ठेगाना
                                        </td>
                                        <td>
                                            <?=$result->a_old_place ?>
                                        </td>
                                    </tr>

                                    <tr class="text-center font-bold font-20">
                                        <td colspan="2">
                                            जग्गाको विवरण
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            जग्गा धनिको नाम
                                        </td>
                                        <td><?=$result->land_owner_name ?></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            कित्ता नं.
                                        </td>
                                        <td>
                                            <?=$result->kitta_no?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            क्षेत्रफल
                                        </td>
                                        <td>
                                            <?=$result->biggha."-".$result->kattha."-".$result->dhur?><?= ($result->land_type=="hill") ? "-".$result->paisa : '' ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            ठेगाना
                                        </td>
                                        <td>
                                            <?= $l_local_body->name.", वार्ड-".$l_ward->name.", ".$l_district->name.", ".$l_state->name ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            साबिक ठेगाना
                                        </td>
                                        <td>
                                            <?=$result->l_old_place?>
                                        </td>
                                    </tr>

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

                                                    <a href="<?=  base_url()?>assets/documents/land/lalpurja/<?=$doc?>" target="_blank"><?=$doc?></a>
                                                <?php } ?>
                                            </div>



                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                            <div class="row">
                                <?php
                                if($result->status == 1) {
                                    ?>
                                    <div class="col-lg-6">
                                        <a class="btn btn-warning btn-submit mt-3 btn-block  " href="<?= base_url() ?>lalpurja-pratilipi/edit/<?= $result->id ?>/">सम्पादन
                                        गर्नुहोस्</a>
                                    </div>
                                    <div class="col-lg-6">
                                        <a class="btn btn-success btn-submit  mt-3 btn-block  " href="<?= base_url() ?>lalpurja-pratilipi/darta/<?= $result->id ?>/">
                                        दर्ता गर्नुहोस</a>
                                    </div>
                                    <?php
                                }
                                elseif ($result->status == 2) {
                                    ?>

                                    <div class="col-lg-6">
                                        <a class="btn btn-warning btn-submit mt-3 btn-block  " href="<?= base_url() ?>lalpurja-pratilipi/edit/<?= $result->id ?>/">सम्पादन
                                        गर्नुहोस्</a>
                                    </div>

                                    <div class="col-lg-6">
                                        <a class="btn btn-success btn-submit mt-3 btn-block  " href="<?= base_url() ?>lalpurja-pratilipi/chalani/<?= $result->id ?>/">
                                        चलानी गर्नुहोस</a>
                                    </div>
                                    <?php
                                }
                                ?>

                            </div>
                        </div>
                    </div>


                </div>

                <?php if($result->status != 1): ?>
                    <div class="tab-pane fade" id="sifaris" role="tabpanel" aria-labelledby="nav-profile-tab" aria-expanded="false">

                        <div class="text-right">
                            <?php echo form_open(base_url().'lalpurja-pratilipi/print/'.$result->id ,'target="_blank"'); ?>
                            <button type="submit" class="btn  btn-success  mb-4"><i class="fa fa-print"></i> &nbsp; &nbsp; छाप्नुहोस्</button>
                        </div>

                        <div class="letter">
                            <div class="letter-head">
                                <!-- Letter head -->
                                <div class="row">
                                    <div class="col-3 letter-head-left">
                                        <img src="<?=base_url()?>assets/images/icons/logo.png" alt="logo.png">
                                        <span class="red"> पत्र संख्या: </span> <?= $current_session->name ?><br>
                                        <span class="red"> चलानी नं.: </span> <?php echo  !empty($chalani_no)?$chalani_no:'चलानी गरिएको छैन' ?>
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

                                    <div class="text-center font-28" style="margin-top: 70px; margin-bottom: 70px;">
                                        <h4>
                                            <span style="border-bottom: 1px solid black; margin-bottom: 5px;"> <span class="red"> बिषय : </span> सिफारिस सम्बन्धमा ।
                                        </span>

                                    </h4>
                                </div>


                                <div class="text-justify"></div>
                                प्रस्तुत विषयमा <?= SITE_DISTRICT?> जिल्ला <b><?= $l_local_body->name;?>
                                </b> वडा नं. <?=$l_ward->name?> (<?=$result->l_old_place?>) निवासी <?=$result->gender_spec?> <b><?=$result->applicant_name?>
                                </b>को नाममा समेत <?=$result->lo_type?> दर्ता श्रेस्ता भएको निम्न व्यहोरा भएको जग्गाको जग्गाधनी प्रमाण
                                पूर्जा <?=$result->copy_reason?> हुदाँ सोको प्रतिलिपीको सिफारीस पाउँ भनी यस वडा कार्यालयमा
                                निवेदन दिनु भएको हुदाँ सो सम्बन्धमा त्यहाँको कार्यालयको अभिलेख अनुसार जग्गाधनी 
                                प्रमाण पूर्जामा फोटो टाँस गरी नागरीकता प्रमाणपत्र नं. <?=$result->citizenship_no?>
                                समेत उल्लेख गरी प्रतिलिपी सिफारिस गराइ दिनुहुन सिफारिस गरीन्छ । 
                            </div> 
                            <br>
                            <table class="table-bordered table-responsive">
                                <thead>
                                    <th style="width: 8.33%" style="font-size:18px;">साबिकको ठेगाना</th>                                
                                    <th style="font-size:18px;">हालको ठेगाना</th>                                

                                    <th style="font-size:18px;">कित्ता नं</th>                                
                                    <th style="font-size:18px;">क्षेत्रफल (रो.आ.पै.दा.)</th>                               
                                    <th style="font-size:18px;">कैफियत</th>                               
                                </thead>
                                <tbody>
                                    <td style="font-size:18px;"><?=$result->l_old_place?></td>
                                    <td style="font-size:18px;"><?=$result->a_old_place?></td>

                                    <td style="font-size:18px;"><?=$result->kitta_no?></td>
                                    <td style="font-size:18px;"><?=$result->biggha."-".$result->kattha."-".$result->dhur?><?= ($result->land_type=="hill") ? "-".$result->paisa : '' ?></td>
                                    <td style="font-size:18px;"></td>
                                </tbody>
                            </table>  
                            <br>
                        </div>
                        <div style="line-height: 1.6" class="mt-4">
                            <div class="text-left"><u><strong>जग्गाको विवरण</strong></u></div>
                            निवेदक: <?=$result->gender_spec?> <?=$result->applicant_name?> <br>

                            ना.प्र.नं.: <?=$result->citizenship_no ?> <br>
                            
                            जारि जिल्ला: <?=$result->jari_jilla ?><br>

                            जरिमिति: <?=$result->nep_citizenship_date ?><br>

                            पिता: <?=$result->father_name  ?><br>

                            बाजे: <?=$result->grandfather_name ?><br>
                        </div>
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
