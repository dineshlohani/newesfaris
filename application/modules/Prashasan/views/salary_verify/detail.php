
   
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
                <li class="breadcrumb-item ml-1"><a href="<?=base_url()?>">गृह</a></li>


                <li class="breadcrumb-item"><a href="<?=base_url()?>salary-verify">आयश्रोत प्रमाणित</a>
                </li>

                <li class="breadcrumb-item active">आवेदकको विवरण</li>

            </ol>
        </nav>
    </div>
    <div class="container-fluid font-kalimati">
        <div class="bd-example bd-example-tabs">
            <nav class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link <?php if($result->status == 1){ echo 'active';}?>" id="nav-home-tab" data-toggle="tab" href="#details" role="tab" aria-controls="home" aria-expanded="true">बिस्तृत</a>
                <?php if($result->status != 1): ?>
                <a class="nav-item nav-link <?php if($result->status !=1){ echo 'active';}?>" id="nav-profile-tab" data-toggle="tab" href="#sifaris" role="tab" aria-controls="profile" aria-expanded="false">सिफारिस</a>
                <?php endif;?>
            </nav>

            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade <?php if($result->status == 1){ echo 'active show';}?> font-kalimati" id="details" role="tabpanel" aria-labelledby="nav-home-tab" aria-expanded="true">
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
                                             कर्मचारी विवरण
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            नाम
                                        </td>
                                        <td><?=$result->name?></td>
                                    </tr>
                                   

                                    <tr>
                                        <td>
                                            संकेत नं.
                                        </td>
                                        <td><?php echo !empty($result->cit_no) ? $result->cit_no : '-';?></td>
                                    </tr>

                                    <tr>
                                        <td>
                                           तह
                                        </td>
                                        <td>
                                            <?=$result->taha?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>पद</td>
                                        <td>
                                           <?=$result->position?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>आधारभूत तलब</td>
                                        <td>
                                            <?=$result->basic_salary?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>ग्रेड</td>
                                        <td>
                                            <?=$result->grade?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>भत्ता</td>
                                        <td>
                                            <?=$result->bhatta?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>स्थानीय भत्ता</td>
                                        <td>
                                            <?=$result->local_bhatta?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>संचय कोष कट्टी</td>
                                        <td>
                                            <?=$result->pf?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>विमा</td>
                                        <td>
                                            <?=$result->bima?>
                                        </td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="offset-lg-4 col-lg-8">
                            <table class="table table-borderless ">
                                <tbody>

                                    <tr>
                                        <?php if(isset($result) && $result->status==1):?>
                                        <td colspan="4" class="text-center" align="center">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <a class="btn btn-warning  btn-submit btn-secondary mt-3" href="<?=  base_url()?>salary-verify/edit/<?=$result->id?>" style="color:#000">
                                                        सम्पादन
                                                        गर्नुहोस्
                                                    </a>
                                                    <a class="btn btn-info  btn-submit btn-secondary mt-3" href="<?=  base_url()?>salary-verify/darta/<?=$result->id?>" style="color:#000">
                                                        दर्ता गर्नुहोस
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <?php endif;?>
                                        <?php if(isset($result) && $result->status==2):?>
                                        <td colspan="4" class="text-center" align="center">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <a class="btn btn-warning  btn-submit btn-secondary mt-3" href="<?=  base_url()?>salary-verify/edit/<?=$result->id?>" style="color:#000">
                                                        सम्पादन
                                                        गर्नुहोस्
                                                    </a>
                                                    <a class="btn btn-info  btn-submit btn-secondary mt-3" href="<?=  base_url()?>salary-verify/chalani/<?=$result->id?>" style="color:#000">
                                                        चलानी गर्नुहोस
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

                <?php if($result->status != 1): ?>
                <div class="tab-pane fade <?php if($result->status != 1){ echo 'active show';}?>" id="sifaris" role="tabpanel" aria-labelledby="nav-profile-tab" aria-expanded="false">
                    <div class="text-right">
                        <?php if($result->status == 3  ) : ?>
                            <?php echo form_open(base_url().'salary-verify/print/'.$result->id ,'target="_blank"'); ?>
                            <button type="submit" class="btn  btn-success  mb-4"><i class="fa fa-print"></i> &nbsp; &nbsp; छाप्नुहोस्</button>
                        <?php endif; ?>
                    </div>

                    <div class="letter">
                        <div class="letter-head">
                            <!-- Letter head -->
                            <div class="row">
                                <div class="col-3 letter-head-left">
                                    <img src="<?=base_url()?>assets/images/icons/logo.png" alt="logo.png">
                                    <span class="red"> पत्र संख्या: </span> <?= $current_session->name ?><br>
                                    <span class="red"> चलानी नं.: </span> <?php echo !empty($chalani_no)?$chalani_no:'चलानी गरिएको छैन ' ?>
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

                        <!-- <div class="col-md-3">
                          
                            
                        </div> -->
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
                                <span style="border-bottom: 1px solid black; margin-bottom: 5px;"> <span class="red"> बिषय : </span> आयश्रोत प्रमाणित गरिएको ।
                                </span>

                            </h4>
                        </div>

                        <div class="col-md-3">
                            <p>श्री जो जससँग सम्बन्धित छ ।</p>
                        </div>
                        <div class="space1"> </div>
                        <div class="text-justify" style="margin-top: 10px; text-indent: 150px;">

                          प्रस्तुत विषयका सम्बन्धमा यस कार्यालयमा <b><?php echo $result->taha?></b> तहमा कार्यरत कर्मचारी <b><?php echo $result->gender?> <?php echo $result->name?>को</b> वार्षिक आम्दानी तपशिल बमोजिम रहेको ब्यहोरा  प्रमाणित गरिएको गरिन्छ । 

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-justify  mt-5">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>क्र.स.</th>
                                                <th> आधारभूत तलब</th>
                                                <th> ग्रेड</th>
                                                <th>भत्ता</th>
                                                <th>स्थानिय भत्ता</th> 
                                                <th>संचय कोष कट्टी</th>
                                                <th> बीमा</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td><?php echo $result->basic_salary?></td>
                                                <td><?php echo $result->grade?></td>
                                                <td><?php echo $result->bhatta?></td>
                                                <td><?php echo $result->local_bhatta?></td>
                                                <td><?php echo $result->pf?></td>
                                                <td><?php echo $result->bima?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="mt-5 pt-5">
                            <div class="row">
                                <div class="offset-9 col-3 signature">
                                    <select name='office_worker' class="form-control office_worker" id="office_worker">
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
                                                        ?>
                                                    ><?= $worker->name ?></option>
                                        <?php endforeach;?>
                                    </select>
                                    <input type="text" name="office_post" id="office_post" class="form-control" style="margin-top:15px;" value="<?php if(!empty($print_detail)){ echo $print_detail->office_id;}?>" readonly="true" >
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
<script src="<?=base_url()?>assets/bower_components/jquery/dist/jquery.min.js">
    $(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });

</script>
