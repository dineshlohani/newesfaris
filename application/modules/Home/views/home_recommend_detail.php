<?php
    $local_body         = Modules::run("Settings/getLocal",$result->local_body);
    $state              = Modules::run("Settings/getState",$result->state);
    $ward               = Modules::run("Settings/getWard",$result->ward);
    $district           = Modules::run("Settings/getDistrict",$result->district);
    $old_new_address    = Modules::run("Settings/getOldNewAddress",$result->old_new_address);
    $home_type          =   Modules::run("Settings/getHomeType",$result->home_type);
    $office             = Modules::run("Settings/getOffice",$result->office);
    $current_session    = Modules::run('Settings/getCurrentSession',$result->session_id);
?>

<?php
    if($result->status == 1) {
        $uri_accept     = base_url().$this->uri->segment(1)."/darta/".$this->uri->segment(3);
    } elseif($result->status == 2 ) {
        $uri_accept     = base_url().$this->uri->segment(1)."/chalani/".$id;
    } else {
        $uri_accept = "";
    }
    $uri_decline    = base_url().$this->uri->segment(1)."/detail/".$this->uri->segment(3);
?>
<section class="content ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <?php if(!empty($this->session->flashdata('msg')))
                {?>
                <div class="alert alert-success alert-dismissible"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span><?=$this->session->flashdata('msg');?></span></div>
                <?php } ?>
                <?php if(!empty($this->session->flashdata('err_msg')))
                {?>
                <div class="alert alert-danger alert-dismissible"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span><?=$this->session->flashdata('err_msg');?></span></div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="container-fluid ">
        <nav aria-label="breadcrumb" class="bg-shadow">
            <ol class="breadcrumb px-3 py-2">
                <li class="breadcrumb-item ml-1"><a href="<?=base_url()?>">गृह</a></li>
                <li class="breadcrumb-item"><a href="<?=base_url()?>home-recommend">घर कायमको सिफारिस</a></li>
                <li class="breadcrumb-item active">आवेदकको विवरण</li>
            </ol>
        </nav>
    </div>
    <div class="container-fluid font-kalimati">
        <div class="bd-example bd-example-tabs">
            <nav class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#details" role="tab" aria-controls="home" aria-expanded="true">बिस्तृत</a>
                <?php
                if($result->status == 3 || $result->status == 2)
                {
            ?>
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#sifaris" role="tab" aria-controls="profile" aria-expanded="false">सिफारिस</a>
                <?php
                }
            ?>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade active show" id="details" role="tabpanel" aria-labelledby="nav-home-tab" aria-expanded="true">
                    <?php //echo form_open_multipart($uri_accept)?>
                        <div class="row">
                            <div class="offset-lg-2 col-lg-8">
                                <table class="table table-bordered my-4 font-kalimati">
                                    <tbody>
                                        <tr>
                                            <td>
                                                 ID
                                            </td>
                                            <td>
                                                <?= $form_id ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                स्वीकृत
                                            </td>
                                            <td>
                                                <?php
                                                if($result->status == 1) {
                                            ?>
                                                <h6 class="text-danger">नभएको</h6>
                                                <?php
                                                }
                                                else {
                                            ?>
                                                <h6 class="text-success">भएको</h6>
                                                <?php
                                                }
                                            ?>
                                            </td>
                                        </tr>
                                        <tr class="text-center font-bold font-20">
                                            <td colspan="2">घर कायम सिफारिस विवरण
                                            </td>
                                        </tr>
                                        <?php $gend = $result->gender_spec; //print_r($gend);?>
                                        <tr>
                                            <td>
                                                आवेदकको नाम
                                            </td>
                                            <td> <?=$gend?> <?=$result->applicant_name?> </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                नागरिकता नं
                                            </td>
                                            <td> <?=$result->cit_no?> </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                ठेगाना
                                            </td>
                                            <td>
                                                <?php
                                                echo $local_body->name." , ".$ward->name." , ".$district->name." , ".$state->name;
                                            ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                साबिक ठेगाना
                                            </td>
                                            <td>
                                                <?= $old_new_address->name ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                हालको ठेगाना
                                            </td>
                                            <td>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                नक्सा सिट नं
                                            </td>
                                            <td> <?=$result->map_sheet_no?> </td>
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
                                            <td>
                                                क्षेत्रफल
                                            </td>
                                            <td>
                                                <?php
                                                echo $result->biggha."-".$result->kattha."-".$result->dhur;
                                           ?><?= ($result->land_type=="hill") ? "-".$result->paisa : '' ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                घर नं
                                            </td>
                                            <td>
                                                <?= $result->home_no ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                घरको प्रकार
                                            </td>
                                            <td>
                                                <?= $home_type->name ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                घर निर्माण भएको / आनुमति लिएको साल
                                            </td>
                                            <td>
                                                <?= $result->home_created_year ?>
                                            </td>
                                        </tr>
                                        <tr class="text-center font-bold font-20">
                                            <td colspan="2">कागजात</td>
                                        </tr>
                                        <tr>
                                            <td>कागजातहरू</td>
                                            <td>
                                                <?php
                                                $path           = base_url()."assets/documents/home/home_recommend/";
                                                if(!empty($result->darta_documents))
                                                {
                                                    $darta_docs  = explode("+",$result->darta_documents);
                                                    foreach($darta_docs as $doc)
                                                    {
                                                        echo "<a href='".$path.$doc."' target='_blank'>".$doc."</a><br/>";
                                                    }
                                                }
                                                else
                                                {
                                                        echo "नभएको";
                                                }
                                            ?>
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
                                                        <a class="btn btn-warning btn-submit mt-3 btn-block  " href="<?= base_url() ?>home-recommend/edit/<?= $result->id ?>/">सम्पादन
                                                            गर्नुहोस्</a>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <a class="btn btn-success btn-submit  mt-3 btn-block  " href="<?= base_url() ?>home-recommend/darta/<?= $result->id ?>/">
                                                            दर्ता गर्नुहोस</a>
                                                    </div>
                                                    <?php
                                                    }
                                                    elseif ($result->status == 2) {
                                                ?>

                                                    <div class="col-lg-6">
                                                        <a class="btn btn-warning btn-submit mt-3 btn-block  " href="<?= base_url() ?>home-recommend/edit/<?= $result->id ?>/">सम्पादन
                                                            गर्नुहोस्</a>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <a class="btn btn-success btn-submit mt-3 btn-block  " href="<?= base_url() ?>home-recommend/chalani/<?= $result->id ?>/">
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
                    <?php //echo form_close()?>
                </div>
                <?php
              if($result->status == 2 || $result->status == 3 )
              {
            ?>
                <div class="tab-pane fade" id="sifaris" role="tabpanel" aria-labelledby="nav-profile-tab" aria-expanded="false">
                    <div class="text-right">
                        <?php if($result->status == 3 ) { ?>
                            <?php echo form_open(base_url().'home-recommend/print/'.$result->id ,'target="_blank"'); ?>
                            <button type="submit" class="btn  btn-success  mb-4"><i class="fa fa-print"></i> &nbsp; &nbsp;छाप्नुहोस्</button>
                        <?php } ?>
                    </div>
                    <div class="font-14 text-black" style="line-height: 1.6;">
                        <div class="letter">
                            <div class="letter-head"><!-- Letter head -->
                                <div class="row">
                                    <div class="col-3 letter-head-left">
                                        <img src="<?=base_url()?>assets/images/icons/logo.png" alt="logo.png">
                                        <span class="red"> पत्र संख्या: </span> <?= $current_session->name ?><br>
                                        <span class="red"> चलानी नं.:  </span> <?= $chalani_no ?>
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
                        <div class="space4"></div>
                        <div class="text-center mt-2 mb-5">
                            <h4><span style="border-bottom: 1px solid black; margin-bottom: 3px;"> <span class="red"> बिषय: </span> घर कायम सिफारिस। </span>
                            </h4>
                        </div>
                        <div class="text-justify">
                            <b><?= $local_body->name ?></b> वडा नं <b><?= $ward->name ?></b> (साबिक
                            ठेगाना <b><?= $old_new_address->name ?>)</b> अन्तर्गत बस्ने
                             <b><?=$result->gender_spec?> <?= $result->applicant_name?></b>को नाममा त्यस कार्यालयमा श्रेस्ता दर्ता कायम रहेको
                            निम्नमा उल्लेखित
                            जग्गामा घर निर्माण गरि यस वडा
                            कार्यालयमा निजले चालु आर्थिक वर्ष सम्मको घरजग्गा कर / सम्पत्ति कर चुक्ता गरिसकेको
                            हुनाले निजको जग्गा
                            धनी प्रमाणपुर्जामा घर कायम गरि दिन हुन सिफारिस साथ अनुरोध गरिन्छ ।
                        </div>
                        <div class="mt-4">
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr class="text-bold">
                                        <th>क्र.स.</th>
                                        <th>
                                            वडा नं
                                        </th>
                                        <th>
                                            सिट नं
                                        </th>
                                        <th>
                                            कि नं
                                        </th>
                                        <th>
                                            क्षेत्रफल
                                        </th>
                                        <th>
                                            घर नं
                                        </th>
                                        <th>
                                            घरको प्रकार
                                        </th>
                                        <th>
                                            घर निर्माण भएको साल /<br>अनुमति लिएको
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="font-normal">
                                        <td class="font-kalimati">
                                            १
                                        </td>
                                        <td>
                                            <?= (getonlyNumber($old_new_address->new_name));?>
                                        </td>
                                        <td>
                                            <?= $result->map_sheet_no ?>
                                        </td>
                                        <td>
                                            <?= $result->kitta_no?>
                                        </td>
                                        <td>
                                            <?= $result->biggha."-".$result->kattha."-".$result->dhur?><?= ($result->land_type=="hill") ? "-".$result->paisa : '' ?>
                                        </td>
                                        <td>
                                            <?= $result->home_no ?>
                                        </td>
                                        <td>
                                            <?= $home_type->name ?>
                                        </td>
                                        <td>
                                            <?= $result->home_created_year?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-3 offset-9">
                                <div style="margin-top: 120px;">
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
                </div>
                </div><!-- Letter end -->
                <?php
          }
          ?>
            </div>
        </div>
    </div>
</section>
</div>
