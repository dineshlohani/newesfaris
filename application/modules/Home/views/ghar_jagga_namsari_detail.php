<?php
    $applicant_relation     = Modules::run("Settings/getRelation",$result->applicant_relation);
    $hakdar_ko_nata         = Modules::run("Settings/getRelation",$result->hakdar_ko_nata);
    $road_type              = Modules::run("Settings/getRoadType",$result->road_type);
    $ward                   = Modules::run("Settings/getWard",$result->ward);
    if(!empty($result->description))
    {
        $description        = $result->description;
    }
    else
    {
        $description        = "-";
    }
    if(!empty($result->documents))
    {
        $documents      = explode("+",$result->documents);

    }
    $path           = base_url()."assets/documents/home/ghar_jagga_namsari/";
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


                <li class="breadcrumb-item"><a href="<?= base_url()?>ghar-jagga-namsari">घर जग्गा नामसारी</a></li>

                <li class="breadcrumb-item active">आवेदकको विवरण</li>

            </ol>
        </nav>
    </div>





    <div class="container-fluid font-kalimati   ">
        <div class="bd-example bd-example-tabs">
            <nav class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#details" role="tab" aria-controls="home" aria-expanded="true">बिस्तृत</a>

                <?php if($result->status != 1): ?>

                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#sifaris" role="tab" aria-controls="profile" aria-expanded="false">सिफारिस</a>
                <?php endif; ?>

            </nav>

            <div class="tab-content" id="nav-tabContent">

                <div class="tab-pane fade active show" id="details" role="tabpanel" aria-labelledby="nav-home-tab" aria-expanded="true">
                    <div class="row">
                        <div class="offset-lg-2 col-lg-8">
                            <table class="table table-bordered my-4">
                                <tbody>
                                    <tr>
                                        <td>
                                            फारम ID
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
                                            <?php if($result->status == 1){ ?>

                                            <h6 class="text-danger">नभएको</h6>
                                            <?php
                                                }
                                                else
                                                {
                                            ?>
                                            <h6 class="text-success">भएको</h6>
                                            <?php }?>

                                        </td>
                                    </tr>

                                    <tr class="text-center font-bold font-20">
                                        <td colspan="2">
                                            निवेदकको विवरण
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            निवेदकको नाम
                                        </td>
                                        <td><?=$result->gender_spec?> <?= $result->applicant_name ?></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            नागरिकता नं 
                                        </td>
                                        <td><?= $result->cit_no ?></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            सम्पर्क नं 
                                        </td>
                                        <td><?= $result->con_no ?></td>
                                    </tr>
                                    <tr>
                                        <td> नाता </td>
                                        <td> <?= $applicant_relation->name ?> </td>
                                    </tr>

                                    <tr>
                                        <td> जग्गा धनीको नाम </td>
                                        <td> <?= $result->owner_name ?> </td>
                                    </tr>

                                    <tr>
                                        <td> मृत्यु भएको मिति </td>
                                        <td> <?= $result->nepali_dod ?> <?= "(".$result->english_dod.")" ?> </td>
                                    </tr>

                                   
                                  <!--   <tr class="text-center font-bold font-20">
                                        <td colspan="2">नामसारी गर्ने घर/जग्गाको विवरण</td>
                                    </tr>

                                    <tr>
                                        <td> घर नं. </td>
                                        <td> <?= $result->home_no ?> </td>
                                    </tr>

                                    <tr>
                                        <td> कित्ता </td>
                                        <td> <?= $result->kitta ?> </td>
                                    </tr>

                                    <tr>
                                        <td> क्षेत्रफल </td>
                                        <td> <?= $result->biggha."-".$result->kattha."-".$result->dhur?><?= ($result->land_type=="hill") ? "-".$result->paisa : '' ?></td>
                                    </tr>

                                    <tr>
                                        <td> नक्सा सिट नं </td>
                                        <td> <?= $result->map_sheet_no ?> </td>
                                    </tr>

                                    <tr>
                                        <td> कित्ता नं </td>
                                        <td> <?= $result->kitta_no ?> </td>
                                    </tr>

                                    <tr>
                                        <td> बाटोको नाम </td>
                                        <td> <?= $result->road_name ?> </td>
                                    </tr>

                                    <tr>
                                        <td> बाटोको प्रकार </td>
                                        <td> <?= $road_type->name ?> </td>
                                    </tr>

                                    <tr>
                                        <td> वडा नं. </td>
                                        <td> <?= $ward->name ?> </td>
                                    </tr>

                                    <tr>
                                        <td> कैफियत </td>
                                        <td> <?= $description?> </td>
                                    </tr> -->

                                    <!-- <tr class="text-center font-bold font-20">
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
                                    </tr> -->
                                </tbody>
                            </table>
                            <table class="table table-bordered" id="add_new_fields">
                                    <thead>
                                        <tr class="text-center font-bold font-20">
                                            <td colspan="4">मृतकका हकदारको विवरण</td>
                                        </tr>
                                        <tr>
                                            <th>हकदारको नाम</th>
                                            <th>मृतक सँगको नाता</th>
                                            <th>बुवा/पतिको नाम</th>
                                            <th>नागरिकता नं.</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php if(!empty($hakdar)) :
                                            foreach($hakdar as $key => $h) : ?>
                                                <tr class="">
                                                    <td><?php echo $h->hakdar_ko_name?></td>
                                                    <td><?php echo $h->hakdar_ko_nata?></td>
                                                    <td><?php echo $h->father_husband_name?></td>
                                                    <td><?php echo $h->citizenship_no?></td>
                                                </tr>
                                        <?php endforeach; endif;?>
                                    </tbody>
                            </table>

                            <table class="table table-bordered text-center" >
                                    <thead>
                                        <tr class="text-center font-bold font-20">
                                            <td colspan="9">मृतकका हकदारको विवरण</td>
                                        </tr>
                                        <tr>
                                            <th>सी.नं</th>
                                            <th>न सि नं.</th>
                                            <th>कित्ता नं.</th>
                                            <th>घर नं</th>
                                            <th>क्षेत्रफल<br>(रोपनि. आना. पैसा. दाम)</th>
                                            <th>बाटोको प्रकार.</th>
                                            <th>बाटोको नाम.</th>
                                            <th>वडा नं.</th>
                                            <th>कैफियत.</th>
                                          
                                            </tr>
                                    </thead>
                                    <tbody>

                                        <?php $i =1; if(!empty($jaggawiwaran)) :
                                            foreach($jaggawiwaran as $key => $jn) : ?>
                                                <tr class="">

                                                    <td><?php echo $i++?></td>
                                                    <td><?php echo $jn->map_sheet_no?></td>
                                                    <td><?php echo $jn->kitta?></td>
                                                    <td><?php echo $jn->home_no?></td>
                                                    <td><?php echo $jn->biggha.'-'.$jn->kattha.'-'.$jn->paisa.'-'.$jn->dhur.'-'?></td>
                                                    <td><?php echo $jn->road_type?></td>
                                                    <td><?php echo $jn->road_name?></td>
                                                    <td><?php echo $jn->ward?></td>
                                                    <td><?php echo $jn->description?></td>
                                                </tr>
                                        <?php endforeach; endif;?>
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
                                                    <a class="btn btn-warning btn-submit mt-3 btn-block  " href="<?= base_url() ?>ghar-jagga-namsari/edit/<?= $result->id ?>/">सम्पादन
                                                        गर्नुहोस्</a>
                                                </div>
                                                <div class="col-lg-6">
                                                    <a class="btn btn-success btn-submit  mt-3 btn-block  " href="<?= base_url() ?>ghar-jagga-namsari/darta/<?= $result->id ?>/">
                                                        दर्ता गर्नुहोस</a>
                                                </div>
                                                <?php
                                                    }
                                                    elseif ($result->status != 3) {
                                                ?>

                                                <div class="col-lg-6">
                                                    <a class="btn btn-warning btn-submit mt-3 btn-block  " href="<?= base_url() ?>ghar-jagga-namsari/edit/<?= $result->id ?>/">सम्पादन
                                                        गर्नुहोस्</a>
                                                </div>

                                                <div class="col-lg-6">
                                                    <a class="btn btn-success btn-submit mt-3 btn-block  " href="<?= base_url() ?>ghar-jagga-namsari/chalani/<?= $result->id ?>/">
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
                        <?php if($result->status == 3 ) :?>
                            <?php echo form_open(base_url().'ghar-jagga-namsari/print/'.$result->id ,'target="_blank"'); ?>
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
                                    <span class="red"> चलानी नं.: </span> <?php echo !empty($chalani_no)?$chalani_no:'चलानी गरिएको छैन' ?>
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
                            <div class="row non-border-input" >
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
                        <div class="text-center mt-2 pb-2 font-28">
                            <h4><span style="border-bottom: 1px solid black; margin-bottom: 5px;"> <span class="red">  बिषय :  </span> घर जग्गा नामसारी सिफारिस। </span>
                            </h4>
                        </div>


                        <div class="text-justify" style="line-height: 1.8">
                            निवेदक <?=$result->gender_spec?> <?= $result->applicant_name ?>
                            को <?= $applicant_relation->name ?>
                            नाता पर्ने
                            श्री <?= $result->owner_name ?> को मिति <?=$result->nepali_dod?> मा मृत्यु भएको
                            हुनाले
                            निज मृतकका नाममा
                            दर्ता कायम रहेको तल उल्लेखित विवरणको घरजग्गा नामसारीको लागि <?=$result->gender_spec?> <?= $result->applicant_name?> ले निबेदन दिनु भएकोमा मृतकका हकदारहरु नाता प्रमाणित प्रमाणपत्रमा
                            उल्लेखित भएअनुसार रहेकोले निज मृतकको नाममा रहेको सो घर/जग्गा त्यहाँको
                            नियमानुसार हकदारहरुको
                            नाममा नामसारीको लागि सिफारिस साथ अनुरोध गरिन्छ ।
                        </div>


                        <div class="text-center my-4 font-26 font-bold ">
                            मृतकका हकदारको विवरण
                        </div>
                        <div class="font-22">
                           <!--  <table class="table table-bordered text-center">
                                <tbody>
                                    <tr class="text-bold">
                                        <td>क्र.स.</td>
                                        <td>
                                            हकदारहरुको नाम
                                        </td>
                                        <td>
                                            नाता
                                        </td>
                                        <td>
                                            बुवा/पति को नाम
                                        </td>
                                        <td>
                                            नागरिकता नं.
                                        </td>
                                        <td>
                                            घर नं.
                                        </td>
                                        <td>
                                            कित्ता नं.
                                        </td>
                                        <td>
                                            बाटोको नाम
                                        </td>
                                    </tr>
                                    <tr class="font-normal">
                                        <td class="font-kalimati">
                                            1
                                        </td>
                                        <td>
                                            <?= $result->hakdar_ko_name ?>
                                        </td>
                                        <td>
                                            <?= $hakdar_ko_nata->name ?>
                                        </td>
                                        <td>
                                            <?= $result->father_husband_name ?>
                                        </td>
                                        <td>
                                            <?= $result->citizenship_no ?>
                                        </td>
                                        <td>
                                            <?= $result->home_no ?>
                                        </td>
                                        <td>
                                            <?= $result->kitta ?>
                                        </td>
                                        <td>
                                            <?= $result->road_name ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table> -->

                            <table class="table table-bordered text-center" >
                                    <thead>
                                       
                                        <tr>
                                            <td>क्र.स.</td>
                                            <th>हकदारको नाम</th>
                                            <th>मृतक सँगको नाता</th>
                                            <th>बुवा/पतिको नाम</th>
                                            <th>नागरिकता नं.</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php $i =1; if(!empty($hakdar)) :
                                            foreach($hakdar as $key => $h) : ?>
                                                <tr class="">
                                                    <td><?php echo $i++?></td>
                                                    <td><?php echo $h->hakdar_ko_name?></td>
                                                    <td><?php echo $h->hakdar_ko_nata?></td>
                                                    <td><?php echo $h->father_husband_name?></td>
                                                    <td><?php echo $h->citizenship_no?></td>
                                                </tr>
                                        <?php endforeach; endif;?>
                                    </tbody>
                            </table>
                        </div>

                        <div class="text-center my-4 font-26 font-bold ">
                            नामसारी गर्ने घर/जग्गाको विवरण
                        </div>
                        <div class="font-22">
                          <!--   <table class="table table-bordered text-center">
                                <tbody>
                                    <tr class="text-bold">
                                        <td>क्र.स.</td>
                                        <td>
                                            वडा
                                        </td>
                                        <td>
                                            सिट.नं.
                                        </td>
                                        <td>
                                            कित्ता
                                        </td>
                                        <td>
                                            क्षेत्रफल
                                        </td>
                                        <td>
                                            घर नं
                                        </td>
                                        <td>
                                            कित्ता नं
                                        </td>
                                        <td>
                                            बाटोको नाम / बाटोको प्रकार
                                        </td>
                                        <td>
                                            कैफियत
                                        </td>
                                    </tr>
                                    <tr class="font-normal">
                                        <td class="font-kalimati">
                                            1
                                        </td>
                                        <td>
                                            <?= $ward->name ?>
                                        </td>
                                        <td>
                                            <?= $result->map_sheet_no ?>
                                        </td>
                                        <td>
                                            <?= $result->kitta ?>
                                        </td>
                                        <td>
                                            <?= $result->biggha."-".$result->kattha."-".$result->dhur?><?= ($result->land_type=="hill") ? "-".$result->paisa : '' ?>
                                        </td>
                                        <td>
                                            <?= $result->home_no ?>
                                        </td>
                                        <td>
                                            <?= $result->kitta ?>
                                        </td>
                                        <td>
                                            <?= $result->road_name.", ".$road_type->name ?>
                                        </td>
                                        <td>
                                            <?= $description?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table> -->

                            <table class="table table-bordered text-center" >
                                    <thead>
                                     
                                        <tr>
                                            <td>क्र.स.</td>
                                            <th >न सि नं.</th>
                                            <th>कित्ता नं.</th>
                                            <th>घर नं</th>
                                            <th>क्षेत्रफल<br>(रोपनि. आना. पैसा. दाम)</th>
                                            <th >बाटोको प्रकार.</th>
                                            <th >बाटोको नाम.</th>
                                            <th >वडा नं.</th>
                                            <th >कैफियत.</th>
                                          
                                            </tr>
                                    </thead>
                                    <tbody>

                                        <?php $i =1; if(!empty($jaggawiwaran)) :
                                            foreach($jaggawiwaran as $key => $jn) : ?>
                                                <tr class="">

                                                    <td><?php echo $i++?></td>
                                                    <td><?php echo $jn->map_sheet_no?></td>
                                                    <td><?php echo $jn->kitta?></td>
                                                    <td><?php echo $jn->home_no?></td>
                                                    <td><?php echo $jn->biggha.'-'.$jn->kattha.'-'.$jn->dhur.'-'.$jn->paisa.'-'?></td>
                                                    <td><?php echo $jn->road_type?></td>
                                                    <td><?php echo $jn->road_name?></td>
                                                    <td><?php echo $jn->ward?></td>
                                                    <td><?php echo $jn->description?></td>
                                                </tr>
                                        <?php endforeach; endif;?>
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
