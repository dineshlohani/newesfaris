<?php
$local_body     = Modules::run("Settings/getLocal",$result->local_body);
$state          = Modules::run("Settings/getState",$result->state);
//print_r($state);
$ward           = Modules::run("Settings/getWard",$result->ward);
//print_r($ward);
$district       = Modules::run("Settings/getDistrict",$result->district);

switch($result->gender)
{
    case 1:
    $gender = 'पुरुष';
    break;
    case 2:
    $gender = 'महिला';
    break;
}
switch($result->relation)
{
    case 'son':
    $relation = 'छोरा';
    break;
    case 'daughter':
    $relation = 'छोरी';
    break;
    case 'wife':
    $relation = 'श्रीमती';
    break;
}
if(!empty($result->documents))
{
    $documents      = explode("+",$result->documents);

}
$path           = base_url()."assets/documents/certificate/citizenship_sifaris/";
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
                <li class="breadcrumb-item"><a href="<?= base_url()?>citizenship-sifaris">नागरिकताको सिफारिस</a></li>
                <li class="breadcrumb-item active">आवेदकको विवरण</li>
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
                                    <tr>
                                        <td>निवेदकको नाम</td>
                                        <td><?=$result->gender_spec?> <?= $result->applicant_name?></td>
                                    </tr>
                                    <tr>
                                        <td>सम्पर्क नं</td>
                                        <td><?= $result->con_no ?></td>
                                    </tr>
                                    <tr>
                                        <td>जन्ममिति</td>
                                        <td><?= $result->janmamiti ?></td>
                                    </tr>
                                    <tr>
                                        <td>बाबुको नाम</td>
                                        <td><?= $result->name ?></td>
                                    </tr>
                                    <tr>
                                        <td>नागरिकता नं </td>
                                        <td><?= $result->cit_no_1 ?></td>
                                    </tr>
                                    <tr>
                                        <td>लिङ्ग</td>
                                        <td><?= $gender ?></td>
                                    </tr>
                                    <tr>
                                        <td>उमेर</td>
                                        <td><?= $result->age ?></td>
                                    </tr>
                                    <tr>
                                        <td>नाता</td>
                                        <td><?= $relation ?></td>
                                    </tr>
                                    <tr>
                                        <td>ठेगाना</td>
                                        <td>
                                            <?= $local_body->name." वडा-".$ward->name.", ".$district->name.", ".$state->name?>
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
                                                        <a class="btn btn-warning btn-submit mt-3 btn-block  " href="<?= base_url() ?>citizenship-sifaris/edit/<?= $result->id ?>/">सम्पादन
                                                        गर्नुहोस्</a>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <a class="btn btn-success btn-submit  mt-3 btn-block  " href="<?= base_url() ?>citizenship-sifaris/darta/<?= $result->id ?>/">
                                                        दर्ता गर्नुहोस</a>
                                                    </div>
                                                    <?php
                                                }
                                                elseif ($result->status == 2) {
                                                    ?>
                                                    <div class="col-lg-6">
                                                        <a class="btn btn-warning btn-submit mt-3 btn-block  " href="<?= base_url() ?>citizenship-sifaris/edit/<?= $result->id ?>/">सम्पादन
                                                        गर्नुहोस्</a>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <a class="btn btn-success btn-submit mt-3 btn-block  " href="<?= base_url() ?>citizenship-sifaris/chalani/<?= $result->id ?>/">
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
                            <?php echo form_open(base_url().'citizenship-sifaris/print/'.$result->id ,'target="_blank"'); ?>
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
                                    <div class="text-center font-28" style="margin-bottom: 40px;">
                                        <h4><span style="border-bottom: 1px solid black; margin-bottom: 5px;"> <span class="red"> बिषय : </span> नागरिकता सिफारिस गरि पठाइएको बारे।</span>
                                        </h4>
                                    </div>
                                    <div class="text-justify">
                                        उपरोक्त सम्बन्धमा यस <strong><?= $local_body->name ?></strong> वडा नं <?= $ward->name?> बस्ने श्री <strong><?= $result->name?>को</strong> <?= $relation?>
                                        वर्ष <strong><?= $result->age ?></strong> को 
                                        <?php if($result->gender!= 2)
                                        { 
                                            echo 'निवेदक';
                                        }
                                        else  {
                                           echo 'निवेदिका'; 
                                       };
                                       ?>
                                       <b>
                                       <?= $result->gender_spec?> <?= $result->applicant_name.'ले'?></b> हालसम्म नेपाल अधिराज्यको कुनै पनि स्थानबाट
                                       नेपाली नागरिकताको प्रमाण-पत्र प्राप्त नगरेकोले नेपाली नागरिकता प्रमाण-पत्र प्राप्त गर्नको लागि सम्बन्धित कार्यालयलाई सिफारिस गरि पाउँ भनि यस
                                       कार्यालयमा निवेदन दिएकाले निजसँग निम्न कागजातहरु बुझी यसैसाथ संगलग्न राखी नेपाली नागरिकता
                                       प्रमाण-पत्र उपलब्ध गरि दिन सिफारिस गरि पठाएको व्यहोरा सादर अनुरोध गरिन्छ ।
                                   </div>
                                  
                                   <div class="row">
                                    <div class="col-md-4" style="margin-top: -31px; margin-left:1px;">
                                        <div class="clearfix"></div>
                                        <div class="text-justify  mt-5"></div>
                                        जन्म स्थान : <?=$local_body->name?> वडा नं <?=$ward->name?>, <?php echo $district->name;?>
                                        <div class="clearfix"></div>
                                        बाबुको नाम थर : <?php echo $result->name;?>
                                        <div class="clearfix"></div>
                                        स्थायी ठेगाना : <?=$local_body->name?> वडा नं <?=$ward->name?>, <?php echo $district->name;?>
                                        <div class="clearfix"></div>
                                        जन्ममिति : <?=$result->janmamiti?>
                                        <div class="clearfix"></div>
                                        टोलीबाट बनाएको भए दर्ता मिति :
                                        <div class="clearfix"></div>
                                        हस्ताक्षर :
                                    </div>
                                    <div class="col-md-4">
                                       <div class="col-3 text-center font-12">
                                        <div class="py-4" style="border: 2px solid #555; margin-left: 427px; height: 160px; margin-top:23px; width: 145px;">
                                            निवेदकको दुवै कान <br> देखिने पासपोर्ट <br> साइजको फोटो
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            
                                <div class="row">
                                    <div class="col-md-4" style="margin-top:10px">
                                        <div class="text-justify  mt-5" style="margin-right:-136px;">
                                            <h4 class="font-underline">कागजातहरु</h4>
                                            <div class="clearfix"></div>
                                            <input type="checkbox" name="check[]" value="बाबु वा पतिको नागरिकता प्रमाण-पत्रको प्रतिलिपी-१" />
                                            बाबु वा पतिको नागरिकता प्रमाण-पत्रको प्रतिलिपी-१
                                            
                                            <div class="clearfix"></div>
                                            <input type="checkbox" name="check[]" value="बाबु वा पतिको नामको ज.ध. प्रमाण-पुर्जा(लालपुर्जा) को प्रतिलिपी" />
                                            बाबु वा पतिको नामको ज.ध. प्रमाण-पुर्जा(लालपुर्जा) को प्रतिलिपी
                                            
                                            <div class="clearfix"></div>
                                            <input type="checkbox" name="check[]" value="बाबु वा पतिको मृत्युदर्ताको प्रमाण-पत्रको प्रतिलिपी-१" />
                                            बाबु वा पतिको मृत्युदर्ताको प्रमाण-पत्रको प्रतिलिपी-१
                                            
                                            <div class="clearfix"></div>
                                            <input type="checkbox" name="check[]" value="जन्मदर्ता प्रमाण-पत्रको प्रतिलिपी-१" />
                                            जन्मदर्ता प्रमाण-पत्रको प्रतिलिपी-१
                                            
                                            <div class="clearfix"></div>
                                            <input type="checkbox" name="check[]" value="शैक्षिक योग्यता प्रमाण-पत्रको प्रतिलिपी-१" />
                                            शैक्षिक योग्यता प्रमाण-पत्रको प्रतिलिपी-१
                                            
                                            <div class="clearfix"></div>
                                            <input type="checkbox" name="check[]" value="बसाई सराई प्रमाण-पत्रको प्रतिलिपी-१" />
                                            बसाई सराई प्रमाण-पत्रको प्रतिलिपी-१
                                            
                                            <div class="clearfix"></div>
                                            <input type="checkbox" name="check[]" value="विवाहदर्ता प्रमाण-पत्रको प्रतिलिपी-१" />
                                            विवाहदर्ता प्रमाण-पत्रको प्रतिलिपी-१
                                            
                                            <div class="clearfix"></div>
                                            <input type="checkbox" name="check[]" value="विवाहित महिलाको माइतीतर्फाको नागरिकता प्रतिलिपी-१" />
                                            विवाहित महिलाको माइतीतर्फाको नागरिकता प्रतिलिपी-१
                                            
                                            <div class="clearfix"></div>
                                            <input type="checkbox" name="check[]" value="निवेदक निवेदीकाको नामको जग्गाधनि प्रमाण-पुर्जा प्रतिलिपी-१" />
                                            निवेदक निवेदीकाको नामको जग्गाधनि प्रमाण-पुर्जा प्रतिलिपी-१
                                            
                                        </div>
                                    </div>
                                </div>
                            
                            <div class="myspacer20"></div>
                            <div style="margin-left:432px" class="text-justify  mt-5"><u><b>सनाखत</b></u></div>
                            <p> <?php if($result->gender!= 2)
                                        { 
                                            echo 'निवेदक';
                                        }
                                        else  {
                                           echo 'निवेदिका'; 
                                       };
                                       ?> <?=$result->applicant_name;?> मेरो  
                                       <?php if($result->gender!= 2)
                                        { 
                                            echo 'छोरा';
                                        }
                                        else  {
                                           echo 'छोरी'; 
                                       };
                                       ?> नाता हुन् । निजले हालसम्म कहीँ कतैबाट नेपाली नागरिकताको प्रमाण-पत्र लिएको छैन । व्यहोरा झुट्ठा ठहरेमा कानुन बमोजिम सहुँला बुझाउला भनि सनाखत र सहिछाप गर्नेको</p>
                            <div class="spaceer20"></div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div>नाम: <?=$result->name?></div>
                                        <div>ना.प्र.नं: <?= $result->cit_no_1?> </div>
                                        <div>सही छाप: </div>
                                        <div>मिति:  <?= $chalani_result->nepali_chalani_miti?> </div>  
                                    </div>
                                    <div class="col-md-6">
                                        <div class="col-6 offset text-center">
                                        औठाको छाप
                                        <table class="finger-table table">
                                        <tr>
                                            <td> दायाँ </td>
                                            <td> बायाँ </td>
                                        </tr>
                                        <tr>
                                            <td style="height: 90px;"> </td>
                                            <td> </td>
                                        </tr>
                                        </table>
                                     </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="col-3 offset-9 signature">
                                <div>
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
                                    <input type="text" name="post" id="ward_post" class="form-control" style="margin-top:15px;" value="">
                                    <?php echo form_close();?>
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