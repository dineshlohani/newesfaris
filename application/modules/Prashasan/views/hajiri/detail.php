
   
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


                <li class="breadcrumb-item"><a href="<?=base_url()?>hajiri">पदस्थापन तथा हाजिर</a>
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
                <a class="nav-item nav-link <?php if($result->status != 1){ echo 'active';}?>" id="nav-profile-tab" data-toggle="tab" href="#sifaris" role="tab" aria-controls="profile" aria-expanded="false">सिफारिस</a>
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
                                            कर्मचारीको विवरण
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            नाम
                                        </td>
                                        <td> <?=$result->gender?> <?=$result->name?></td>
                                    </tr>
                                 
                                    <tr>
                                        <td>
                                            संकेत नं.
                                        </td>
                                        <td>
                                            <?= $result->cit_no?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>सेवा</td>
                                        <td>
                                            <?=$result->sewa?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>तह</td>
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
                                        <td>
                                            पत्राचार गर्ने कार्यालय
                                        </td>
                                        <td><?= $result->partachar_office?></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            पत्राचार मिति
                                        </td>
                                        <td>
                                            <?=$result->patrachar_date?>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>ऐन / कार्यविधि / अध्यादेशः</td>
                                        <td>
                                            <?=$result->yain?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>रमाना दिने कार्यालय</td>
                                        <td>
                                            <?=$result->ramana_office.','.$result->ramana_office_address?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>कार्यरत पद</td>
                                        <td>
                                            <?=$result->working_position?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>रमाना पत्रको च.नं.</td>
                                        <td>
                                            <?=$result->ramana_chalani_no?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>मिति</td>
                                        <td>
                                            <?=$result->ramana_miti?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>पदास्थापना निर्यण मिति</td>
                                        <td>
                                            <?=$result->nirnaya_miti?>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>लागू मिति</td>
                                        <td>
                                            <?=$result->lagu_miti?>
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
                                                    <a class="btn btn-warning  btn-submit btn-secondary mt-3" href="<?=  base_url()?>hajiri/edit/<?=$result->id?>" style="color:#000" onclick="return confirm('Are you sure to update?')">
                                                        सम्पादन
                                                        गर्नुहोस्
                                                    </a>
                                                    <a class="btn btn-info  btn-submit btn-secondary mt-3" href="<?=  base_url()?>hajiri/darta/<?=$result->id?>" style="color:#000" onclick="return confirm('विवरण सुनिस्चित गर्नुहोस')">
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
                                                    <a class="btn btn-warning  btn-submit btn-secondary mt-3" href="<?=  base_url()?>hajiri/edit/<?=$result->id?>" style="color:#000" onclick="return confirm('Are you sure to update?')">
                                                        सम्पादन
                                                        गर्नुहोस्
                                                    </a>
                                                    <a class="btn btn-info  btn-submit btn-secondary mt-3" href="<?=  base_url()?>hajiri/chalani/<?=$result->id?>" style="color:#000" onclick="return confirm('विवरण सुनिस्चित गर्नुहोस')">
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
                            <?php echo form_open(base_url().'hajiri/print/'.$result->id ,'target="_blank"'); ?>
                            <button type="submit" class="btn  btn-success  mb-4"><i class="fa fa-print"></i> &nbsp; &nbsp; छाप्नुहोस्</button>
                        <?php endif; ?>
                        <?php if($result->status == 2  ) : ?>
                        <a class="btn btn-info  btn-submit btn-secondary mt-3" href="<?=  base_url()?>hajiri/chalani/<?=$result->id?>" style="color:#000" onclick="return confirm('विवरण सुनिस्चित गर्नुहोस')">
                            चलानी गर्नुहोस
                        </a>
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
                                <span style="border-bottom: 1px solid black; margin-bottom: 5px;"> <span class="red"> बिषय : </span> पदस्थापन तथा हाजिर भएको जानाकारी सम्वन्धमा ।
                                </span>

                            </h4>
                        </div>

                        <div>
                        <?php $re = explode(',', $result->ramana_office); ?>
                        <p style="font-size:18px;">श्री 
                            <?php if(!empty($re)): ?>
                            <?= $re[0]?> <br>
                            <?= $re[1] ?><br />
                            <?php else : ?>
                            <?= $result->ramana_office ?><br>
                        <?php endif;?>
                            <?= $result->ramana_office_address?>। 
                        </div>
                        <div class="space1"> </div>
                        <div class="text-justify" style="margin-top: 10px; text-indent: 150px;">

                           <b><?= $result->yain?></b> बमोजिम <b><?= $result->partachar_office?></b> मिति  <?= $result->patrachar_date?></b> को पत्र अनुसार यस गाउँपालिकामा <b><?= $result->sewa?></b>, <b><?= $result->samuha?></b>, <b><?= $result->taha?></b> तहको पदमा समायोजन हुनु भएका तहाँ कार्यालयमा कार्यरत विद्यालय निरिक्षक <b><?= $result->gender.' '.$result->name?></b>  (कर्मचारी संकेत नं. <b><?= $result->cit_no?></b>), तहाँ कार्यालयको च.नं. <b><?= $result->ramana_chalani_no?></b> मिति <b><?= $result->ramana->miti?></b> को रमाना पत्र अनुसार यस कार्यालयमा हाजिर हुन आउनु भएकोले यस कार्यालयको मिति <b><?= $result->nirnaya_miti?></b> को निर्णयवाट पदस्थापन भई मिति <b><?= $result->lagu_miti?></b> देखी यस कार्यालयमा हाजिर हुनुभएको व्यहोरा जानाकारीको लागि अनुरोध छ ।
                        </div>
                        <?php if($result->status == 3) : ?>
                        <div class="row">
                            <div class="col-md-4">
                                <?php $langs = explode(",", $result->bodartha); ?>
                                <div class="text-justify  mt-5" style="margin-right:-136px;">
                                    <h4 class="font-underline">बोद्यार्थ</h4>
                                    <?php if(!empty($bodartha)) :
                                        foreach($bodartha as $bd) : ?>
                                    <div class="clearfix"></div>
                                    <input type="checkbox" name="bd[]" value="<?php echo $bd->id?>"  <?php echo  (in_array($bd->id, $langs)?'checked="true"':NULL)?>/>
                                    <?php echo $bd->name?>
                                    <?php endforeach;endif;?>
                                </div>
                            </div>
                        </div>
                    <?php endif;?>
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
