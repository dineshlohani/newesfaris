<?php
     $p_local_body     = Modules::run("Settings/getLocal",$result->p_local_body);
     $j_local_body     = Modules::run("Settings/getLocal",$result->j_local_body);
     $relation          = Modules::run("Settings/getRelation",$result->relationship);
    $p_ward           = Modules::run("Settings/getWard",$result->p_ward);
    $j_ward           = Modules::run("Settings/getWard",$result->j_ward);
    $p_state          = Modules::run("Settings/getState",$result->p_state);
    $j_state          = Modules::run("Settings/getState",$result->j_state);
    $j_district     = Modules::run("Settings/getDistrict",$result->j_district);
    $p_district     = Modules::run("Settings/getDistrict",$result->p_district);
     $birthdate_eng = explode("-",$result->eng_dob);
    if(!empty($result->documents))
    {
        $documents      = explode("+",$result->documents);

    }
    $path           = base_url()."assets/documents/others/nabalak_pramanit/";
    $current_session    = Modules::run('Settings/getCurrentSession',$result->session_id);
?>
<section class="content ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="django-messages">

                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid ">
        <nav aria-label="breadcrumb" class="bg-shadow">
            <ol class="breadcrumb px-3 py-2">
                <li class="breadcrumb-item ml-1"><a href="/">गृह</a></li>


                <li class="breadcrumb-item"><a href="<?=base_url()?>nabalak-pramanit">नाबालक परिचयपत्र</a></li>

                <li class="breadcrumb-item active">आवेदकको विवरण</li>

            </ol>
        </nav>
    </div>
    <div class="container-fluid font-kalimati">
        <div class="bd-example bd-example-tabs">
            <nav class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#details" role="tab" aria-controls="home" aria-expanded="true">बिस्तृत</a>
                <?php if($result->status!=1):?>
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#sifaris" role="tab" aria-controls="profile" aria-expanded="false">सिफारिस</a>
                <?php endif;?>

            </nav>
            <div class="tab-content" id="nav-tabContent">

                <div class="tab-pane fade active show" id="details" role="tabpanel" aria-labelledby="nav-home-tab" aria-expanded="true">
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
                                                <?=$result->form_id?>
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
                                                निवेदकको विवरण
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>नाम</td>
                                            <td>
                                                <?=$result->applicant_name?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>नाता</td>
                                            <td>
                                                <?=$relation->name?>
                                            </td>
                                        </tr>

                                        <tr class="text-center font-bold font-20">
                                            <td colspan="2">
                                                नाबालकको विवरण
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>नाम</td>
                                            <td>
                                                <?=$result->nep_first_name." ".$result->nep_middle_name." ".$result->nep_last_name?>
                                                (<?=$result->eng_first_name." ".$result->eng_middle_name." ".$result->eng_last_name?>)
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                लिङ्ग
                                            </td>
                                            <td>
                                                <?php if($result->gender=="Male"){echo "पुरुष";}elseif($result->gender=="Female"){ echo "महिला ";}else{ echo "अन्य ";}?> (<?=$result->gender?>)
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                जन्म मिति
                                            </td>
                                            <td>
                                            <?=$result->nep_dob?> 
                                            (<?=$birthdate_eng[0]?>
                                            <span class="mr-4 font-bold">Year</span> <?=$birthdate_eng[1]?>
                                            <span class="mr-4 font-bold">Month</span> <?=$birthdate_eng[2]?> 
                                            <span class="mr-4 font-bold">Day</span>)
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                जन्मस्थान
                                            </td>
                                            <td>
                                                <?=$j_local_body->name?>, वडा -<?=$j_ward->name?>, <?=$j_district->name?>, <?=$j_state->name;?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                स्थाई ठेगाना
                                            </td>
                                            <td>
                                                <?=$p_local_body->name?>, वडा-<?=$p_ward->name?>, <?=$p_district->name?>, <?=$p_state->name?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>बुबाको नाम</td>
                                            <td>
                                                <?=$result->father_name_nep?> (<?=$result->father_name_eng?>)
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                आमाको नाम
                                            </td>
                                            <td>
                                                <?=$result->mother_name_nep?> (<?=$result->mother_name_eng?>)
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>संरक्षकको नाम</td>
                                            <td>
                                                <?=$result->gurdians_name_nep?> (<?=$result->gurdians_name_eng?>)
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                संरक्षकको ठेगाना
                                            </td>
                                            <td>
                                                <?=$result->gurdians_address?>
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

                                                    <a href="<?=  base_url()?>assets/documents/others/nabalak_pramanit<?=$doc?>" target="_blank"><?=$doc?></a>
                                                    <?php } ?>
                                                </div>



                                            </td>
                                        </tr>

                                        <tr class="text-center font-bold font-20">
                                            <td colspan="2">ओ.सी. कागजात</td>
                                        </tr>
                                        <tr>
                                            <td>निबेदन</td>
                                            <td>

                                                नभएको

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>सिफारिस</td>
                                            <td>

                                                नभएको

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


                                                <div class="row">
                                                    <div class="col-lg-6 offset-lg-6">
                                                        <a class="btn btn-warning  btn-submit btn-secondary mt-3" href="<?=  base_url()?>nabalak-pramanit/edit/<?=$result->id?>">
                                                            सम्पादन
                                                            गर्नुहोस्
                                                        </a>
                                                    </div>
                                                </div>


                                            </td>
                                            <?php endif;?>
                                            <?php if(isset($result) && $result->status==2):?>
                                            <td colspan="2">

                                                <div class="col-lg-6 ">
                                                        <a class="btn btn-warning  btn-submit btn-secondary mt-3" href="<?=  base_url()?>nabalak-pramanit/edit/<?=$result->id?>">
                                                            सम्पादन
                                                            गर्नुहोस्
                                                        </a>
                                                    </div>
                                                <div class="row">
                                                    <div class="col-lg-6 ">
                                                        <a class="btn btn-info  btn-submit btn-secondary mt-3" href="<?=  base_url()?>nabalak-pramanit/chalani/<?=$result->id?>">
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
                                                        <a class="btn btn-info  btn-submit btn-secondary mt-3" href="<?=  base_url()?>nabalak-pramanit/darta/<?=$result->id?>">
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
                </div>


                <div class="tab-pane fade" id="sifaris" role="tabpanel" aria-labelledby="nav-profile-tab" aria-expanded="false">
                    <div class="accordion" id="accordionExample">
                        <div class="card mb-0">
                            <div class="card-header" id="headingOne">
                                <div class="row">
                                    <div class="col-md-10" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <button class="btn btn-link" type="button">
                                            पहिलो पृष्ठ
                                        </button>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="text-right">
                                            <?php if($result->status == 3 ) : ?>
                                            <?php echo form_open(base_url().'nabalak-pramanit/print/first/'.$result->id ,'target="_blank"'); ?>
                                            <button type="submit" class="btn  btn-success  mb-4"><i class="fa fa-print"></i> &nbsp; &nbsp; छाप्नुहोस्</button>
                                        <?php endif;?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="collapseOne" class="collapse hide" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">
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
                                        <div class="row">
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
                                       
                    <div class="col-6 offset-3">
                        <div class="text-center" style="float:right;">
                            <div class="py-5" style="border: 2px solid black; margin-left: 20px; height: 150px; width: 150px;">
                                निवेदकको दुवै कान <br> देखिने पासपोर्ट <br> साइजको
                                फोटो
                            </div>
                        </div>
                    </div>
                </div>


                                        <div class="text-center my-5 ">
                                            <h4 class="font-21">
                                                <span style="border-bottom: 1px solid black; margin-bottom: 5px;"> <span class="red"> बिषय: </span> नाबालक परिचयपत्र पाउँ ।
                                                </span>
                                            </h4>
                                        </div>

                                        <div>
                                            <div class="my-4">महोदय,</div>

                                            <div class="text-justify" style="text-indent: 50px;">
                                                मेरो निम्नानुसारको विवरण भएको 
                                                <?php 
                                                    if ($result->gender=="Male") {
                                                        echo छोरा ;
                                                    }else{
                                                        echo छोरी;
                                                    }
                                                ?>को नाबालक परिचयपत्र बनाउनु
                                                परेकोले
                                                सिफारिस साथ रु.१० को टिकट टाँसी
                                                यो निबेदन पेश 
                                                <?php 
                                                    if ($result->gender=="Male") {
                                                        echo गरेको ;
                                                    }else{
                                                        echo गरेकी;
                                                    }?>
                                                छु। मेरो सम्बन्धले निजको नामबाट यस अघि
                                                नाबालक
                                                परिचयपत्र लिएको छैन।
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="my-4">१. नाबालकको नाम/थर :</div>
                                                <table class="table table-bordered text-center">
                                                    <thead>
                                                        <th style="width:5%;">क्र.स.</th>
                                                        <th>नाता/सम्बन्ध</th>
                                                        <th>नाबालकको नाम</th>
                                                        <th><span class="font-18">Full Name</span></th>
                                                    </thead>
                                                    <tbody>
                                                        <td>१</td>
                                                        <td>
                                                            <?=$result->relationship?>
                                                        </td>
                                                        <td>
                                                            <?=$result->nep_first_name.' '.$result->nep_middle_name.' '.$result->nep_last_name ?>
                                                        </td>
                                                        <td class="text-capitalize">
                                                            <?=$result->eng_first_name.' '.$result->eng_middle_name.' '.$result->eng_last_name ?>
                                                        </td>
                                                    </tbody>
                                                </table>

                                                २. लिङ्ग: <?php if($result->gender=="Male"){echo "पुरुष";}elseif($result->gender=="Female"){ echo "महिला ";}else{ echo "अन्य ";}?> <br>
                                                <span class="font-19" style="margin-left: 30px">Sex: <?=$result->gender?></span>
                                                <br>

                                                ३. जन्मस्थान: <?=$j_local_body->name?>, वडा <?=$j_ward->name?>, <?=$j_district->name?>, <?=$j_state->name?><br>
                                                <span class="font-19" style="margin-left: 30px">Place of Birth(In Block): <?=$result-> 	birthplace_eng ?></span>
                                                <br>

                                                ४. बाबुको नाम थर: <?=$result->father_name_nep?> <br>
                                                <span class="font-19 text-capitalize" style="margin-left: 30px">Father's Name (In Block): <?=$result->father_name_eng?></span>
                                                <br>

                                                ५. आमाको नाम थर: <?=$result->mother_name_nep?> <br>
                                                <span class="font-19 text-capitalize" style="margin-left: 30px">Mother's Name (In Block): <?=$result->mother_name_eng?></span>
                                                <br>

                                                ६. संरक्षकको नाम थर: <?=$result->gurdians_name_nep?><br>
                                                <span class="font-19 text-capitalize" style="margin-left: 30px">Guardian's Name (In Block): <?=$result->gurdians_name_eng?></span>
                                                <br>
                                                <span style="margin-left: 30px">संरक्षकको ठेगाना: <?=$result->gurdians_address?></span>
                                                <br>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <?php echo form_close();?>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingTwo">
                                <div class="row">
                                    <div class="col-md-10" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                        <button class="btn btn-link" type="button">
                                            दोस्रो पृष्ठ
                                        </button>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="text-right">
                                            <?php echo form_open(base_url().'nabalak-pramanit/print/second/'.$result->id ,'target="_blank"'); ?>
                                            <button type="submit" class="btn  btn-success  mb-4"><i class="fa fa-print"></i> &nbsp; &nbsp; छाप्नुहोस्</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="letter">
                                        <div class="row">
                                            <div class="col-12">
                                                ७. स्थायी बासस्थान: जिल्ला: <?=$p_district->name?> <br>
                                                <div style="margin-left: 30px">
                                                    गाउँपालिका / नगरपालिका : <?=$p_local_body->name?>
                                                    <br>
                                                    वडा नं.: <?=$p_ward->name?> <br>
                                                </div>

                                                ८. जन्म मिति: <?=$result->nep_dob?> <br>
                                                <span class="font-19" style="margin-left: 30px">Date of Birth (AD): <?=$result->eng_dob?></span>
                                                <br>

                                                ९. नाबालकको औंठा छाप:
                                                <div class="row mt-3">
                                                    <div class="col-3 text-center">
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
                                                                <td style="height: 100px;">

                                                                </td>
                                                                <td>

                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center mt-4">
                                            मैले माथि लेखेको व्यहोरा ठिक साँचो हो । झुठ्ठा ठहरे कानुन बमोजिम
                                            सहुँला
                                            बुझाउला भनी सहि गर्ने ।
                                        </div>
                                        <div class="row">
                                            <div class="col-3 offset-9 mt-4">
                                                <div class="b">निवेदक,</div>
                                                दस्तखत: <br>
                                                नाम थर: <?=$result->applicant_name?><br>
                                                नाता सम्बन्ध: <?=$result->relationship?><br>
                                                मिति: <?= $result->nepali_date?>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="text-center"><y77u><strong>पालिकाको सिफारिस</strong></u></div>
                                            <div class="mt-5">
                                                <?=$p_district->name?> जिल्ला <?=$p_local_body->name." वडा नं ".$p_ward->name?>( साबिकको
                                                ठेगाना ............... ) वडामा स्थायी बसोबास गरि बस्ने यसमा
                                                लेखिएको
                                                श्री/सुश्री/श्रीमती <?= $result->applicant_name ?> को
                                                सम्बन्ध श्री/सुश्री/श्रीमती <?=$result->nep_first_name.' '.$result->nep_middle_name.' '.$result->nep_last_name ?> लाई म
                                                राम्ररी
                                                चिन्दछु। माथि लेखिए बमोजिम निजको
                                                व्यहोरा मैले
                                                बुझेसम्म साँचो हो। निजलाई नाबालक परिचयपत्र उपलब्ध गराउने सिफारिस
                                                गर्दछु।
                                                उक्त्त्त विवरण झुठ्ठा ठहरे
                                                कानुन बमोजिम सहुँला बुझाउला।
                                            </div>
                                        </div>
                                        <div class="row mt-5">
                                            <div class="col-4">
                                                <div class="date"> मिति :- </div>
                                                <div class="foofice-stamp"> कार्यालयको छाप :- </div>
                                            </div>
                                            <div class="col-3 offset-5">
                                                <div class="b"> सिफारिस गर्नेको :- </div>
                                                <div class="my-3">
                                                    दस्तखत: ...............................
                                                </div>
                                                <div class="mt-5 signature">
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
                            <?php echo form_close();?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</div>
