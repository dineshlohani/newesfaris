<?php
$s_local_body   = Modules::run("Settings/getLocal",$result->s_local_body);
$s_state        = Modules::run("Settings/getState",$result->s_state);
$s_ward         = Modules::run("Settings/getWard",$result->s_ward);
$s_district     = Modules::run("Settings/getDistrict",$result->s_district);
$local_body     = Modules::run("Settings/getLocal",$result->local_body);
$ward           = Modules::run("Settings/getWard",$result->ward);
$state          = Modules::run("Settings/getState",$result->state);
$district      = Modules::run("Settings/getDistrict",$result->district);
$office        = Modules::run("Settings/getOffice",$result->office);
$killa_result  = Modules::run("Land/getDetais",$result->id);
$old_adds = Modules::run("Settings/getOldNewAddress",$result->old_ward);
if(!empty($result->documents))
{
    $documents      = explode("+",$result->documents);

}
$path           = base_url()."assets/documents/land/char_killa/";
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
                <li class="breadcrumb-item ml-1"><a href="<?=base_url()?>land-dashboard">गृह</a></li>
                <li class="breadcrumb-item"><a href="<?=base_url()?>char-killa">चार किल्ला प्रमाणित </a>
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
                                        अनुमोदित
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
                                        आवेदन गरिएको कार्यालय
                                    </td>
                                    <td> <?=$office->name?></td>
                                </tr>

                                <tr>
                                    <td>
                                        आवेदन दिएको मिती
                                    </td>
                                    <td>
                                        <?=$result->nepali_date?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        जग्गा धनिको नाम
                                    </td>
                                    <td><?=$result->gender_spec?> <?=$result->applicant_name?></td>
                                </tr>
                                <tr>
                                    <td>
                                        नागरिकता नं 
                                    </td>
                                    <td>
                                        <?= $result->cit_no?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        सम्पर्क नं 
                                    </td>
                                    <td>
                                        <?= $result->con_no?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                       स्थाई ठेगाना
                                    </td>
                                    <td>
                                        <?= $s_local_body->name.", वार्ड-".$s_ward->name.", ".$s_district->name.", ".$s_state->name ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        ठेगाना
                                    </td>
                                    <td>
                                        <?= $local_body->name.", वार्ड-".$ward->name.", ".$district->name.", ".$state->name ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-sm text-center">
                            <thead class="text-center">
                            <tr>
                                <td rowspan="2">क्र.स.</td>
                                <td rowspan="2">वडा नं.</td>
                                <td colspan="3">जग्गाको विवरण</td>
                                <td rowspan="2">बाटो</td>
                                <td rowspan="2">बाटोको प्रकार</td>
                                <td colspan="4"> चार किल्ला</td>
                                <td rowspan="2">कैफियत</td>
                            </tr>
                            <tr>
                                <td>नक्सा सिट नं</td>
                                <td>कि.नं</td>
                                <td>क्षेत्रफल<br>
                                <?php if($result->land_type=='hill'){
                                    echo "(रो.आ.पै.दा)";
                                }else{
                                    echo "(बि.क.धु)";
                                }?>
                                </td>
                                <td>पुर्ब</td>
                                <td>पश्चिम</td>
                                <td>उत्तर</td>
                                <td>दक्षिण</td>
                            </tr>

                            </thead>
                            <tbody>
                            <?php $i =1; foreach($killa_result as $killa){
                                $old_add = Modules::run("Settings/getOldNewAddress",$killa->old_address);
                                $road_type = Modules::run("Settings/getRoadType",$killa->road_type);
                                ?>
                                <tr class="item">
                                    <td><?=$i?></td>
                                    <td><?=getonlyNumber($old_add->new_name)?></td>
                                    <td><?=$killa->map_sheet_no?></td>
                                    <td><?=$killa->kitta_no?></td>
                                    <td><?=$killa->biggha.'-'.$killa->kattha.'-'.$killa->dhur?><?= ($result->land_type=='hill') ? "-".$killa->paisa : '' ?></td>
                                    <td><?php if($killa->road==1){ echo "भएको ";}else{ echo "नभएको";}?></td>
                                    <td><?=$road_type->name?></td>
                                    <td><?=$killa->east_piller?></td>
                                    <td><?=$killa->west_piller?></td>
                                    <td><?=$killa->north_piller?></td>
                                    <td><?=$killa->south_piller?></td>
                                    <td><?=$killa->description?></td>

                                </tr>
                                <?php $i++; } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="offset-lg-3 col-lg-6">
                            <table class="table table-borderless ">
                                <tbody>
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

                                                <a href="<?=  base_url()?>assets/documents/land/char_killa/<?=$doc?>" target="_blank"><?=$doc?></a>
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
                                        <a class="btn btn-warning btn-submit mt-3 btn-block  " href="<?= base_url() ?>char-killa/edit/<?= $result->id ?>/">सम्पादन
                                            गर्नुहोस्</a>
                                    </div>
                                    <div class="col-lg-6">
                                        <a class="btn btn-success btn-submit  mt-3 btn-block  " href="<?= base_url() ?>char-killa/darta/<?= $result->id ?>/">
                                            दर्ता गर्नुहोस</a>
                                    </div>
                                    <?php
                                }
                                elseif ($result->status == 2) {
                                    ?>
                                    <div class="col-lg-6">
                                        <a class="btn btn-warning btn-submit mt-3 btn-block  " href="<?= base_url() ?>char-killa/edit/<?= $result->id ?>/">सम्पादन
                                            गर्नुहोस्</a>
                                    </div>
                                    <div class="col-lg-6">
                                        <a class="btn btn-success btn-submit mt-3 btn-block  " href="<?= base_url() ?>char-killa/chalani/<?= $result->id ?>/">
                                            चलानी गर्नुहोस</a>
                                    </div>
                                    <?php
                                }
                                ?>

                            </div>
                        </div>
                    </div>

                </div>
            </div>


        </div>

        <?php if($result->status != 1): ?>
            <div class="tab-pane fade" id="sifaris" role="tabpanel" aria-labelledby="nav-profile-tab" aria-expanded="false">

                <div class="text-right">
                    <?php if($result->status == 3) : ?>
                        <?php echo form_open(base_url().'char-killa/print/'.$result->id ,'target="_blank"'); ?>
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
                        <span style="border-bottom: 1px solid black; margin-bottom: 5px;"> <span class="red"> बिषय : </span> चार किल्ला प्रमाणित गरिएको बारे ।
                        </span>

                        </h4>
                    </div>

                    <div class="text-justify">
                        <div>
                            
                            <p class="text-body">
                                प्रस्तुत विषयमा  
                                <b><?= $s_state->name?>,  जिल्ला <?= $s_district->name?>, <?= $s_local_body->name?>, वडा नं. <?= $s_ward->name?></b> जन्मस्थान भई  हाल 
                                <b><?= $local_body->name?> वडा नं. </b> <?= $ward->name?>
                                (साविक ठेगाना <?= $old_adds->name?>)</b> बस्ने <?=$result->gender_spec?>
                                <?= $result->applicant_name?>को नाममा जिल्ला मालपोत कार्यालय, <?=$district->name?> श्रेष्ता दर्ता कायम रहेको तपशिलमा उल्लेखित कित्ताको जग्गा र जग्गामा निर्माण भएको घर/जग्गाको चारकिल्ला प्रमाणित सिफारीस पाउँ भनी <b><?=$result->ward?></b> 
                                नं. वडा कार्यालयमा सिफारीस माग गर्नु भएको हुदाँ तपशिलमा उल्लेखित कित्ता जग्गाको ट्रेस नक्सा / नापी नक्सा अनुसार निम्नानुसार चारकिल्ला भएको प्रमाणित सिफारिस गरीन्छ ।
                            </p>
                        </div>
                        <div class="text-center my-3">
                            <h5>तपशिल</h5>
                        </div>
                        <table class="table letter-table table-bordered">
                            <thead>
                            <tr>
                                <td rowspan="2">क्र.स.</td>
                                <td rowspan="2">वडा नं.</td>
                                <td colspan="3">जग्गाको विवरण</td>
                                <td rowspan="2">बाटो</td>
                                <td rowspan="2">बाटोको प्रकार</td>
                                <td colspan="4"> चार किल्ला</td>
                                <td rowspan="2">कैफियत</td>
                            </tr>
                            <tr>
                                <td>नक्सा सिट नं</td>
                                <td>कि.नं</td>
                                <td>क्षेत्रफल<br>
                                <?php if($result->land_type=='hill'){
                                    echo "(रो.आ.पै.दा)";
                                }else{
                                    echo "(बि.क.धु)";
                                }?>
                                </td>
                                <td>पुर्ब</td>
                                <td>पश्चिम</td>
                                <td>उत्तर</td>
                                <td>दक्षिण</td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i= 1; foreach($killa_result as $killa){
                                $old_add = Modules::run("Settings/getOldNewAddress",$killa->old_address);
                                $road_type = Modules::run("Settings/getRoadType",$killa->road_type);
                                ?>
                                <tr class="item">
                                    <td><?=$i?></td>
                                    <td><?=getonlyNumber($old_add->new_name)?></td>
                                    <td><?=$killa->map_sheet_no?></td>
                                    <td><?=$killa->kitta_no?></td>
                                    <td><?=$killa->biggha.'-'.$killa->kattha.'-'.$killa->dhur?><?= ($result->land_type=='hill') ? "-".$killa->paisa : '' ?></td>
                                    <td><?php if($killa->road==1){ echo "भएको ";}else{ echo "नभएको";}?></td>
                                    <td><?=$road_type->name?></td>
                                    <td><?=$killa->east_piller?></td>
                                    <td><?=$killa->west_piller?></td>
                                    <td><?=$killa->north_piller?></td>
                                    <td><?=$killa->south_piller?></td>
                                    <td><?=$killa->description?></td>

                                </tr>
                            <?php $i++; } ?>
                            </tbody>
                        </table>
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
