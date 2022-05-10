
   
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


                <li class="breadcrumb-item"><a href="<?=base_url()?>approve-wiwaran">कामकाज गर्न खटाईएको</a>
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
                                        <td>सेवा</td>
                                        <td>
                                            <?=$result->sewa?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>समुह</td>
                                        <td>
                                            <?=$result->samuha?>
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
                                            कार्यरत शाखा / कार्यालय
                                        </td>
                                        <td><?= $result->working_ofice?></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            ऐन / कार्यविधि / अध्यादेश
                                        </td>
                                        <td>
                                            <?=$result->yain?>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>नियुक्ति मिति</td>
                                        <td>
                                            <?=$result->from_date?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>अवकाश मिति</td>
                                        <td>
                                            <?=$result->end_date?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>अवकासको किसिम</td>
                                        <td>
                                            <?=$result->retirement_type?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>अन्य विवरण</td>
                                        <td>
                                            <?=$result->other_details?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <h3>तपशिल</h3>
                            <?php if(!empty($tapasil)): ?>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>क्र.सं.</th>          
                                        <th>विदाको विवरण</th>    
                                        <th>जम्मा दि</th>
                                        <th>खर्च भएको</th>
                                        <th>वाँकी</th>                  
                                        <th>कैफियत</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1;foreach($tapasil as $tp) : ?>
                                    <tr>
                                        <td><?php echo $i++?></td>
                                        <td><?php echo $tp->bida_wiwaran?></td>
                                        <td><?php echo $tp->jamma_din?></td>
                                        <td><?php echo $tp->kharcha?></td>
                                        <td><?php echo $tp->baki?></td>
                                        <td><?php echo $tp->remarks?></td>
                                    </tr>
                                <?php endforeach;?>
                                </tbody>
                            </table>
                            <?php else : ?>
                                <div class="alert alert-warning">no records founds</div>
                            <?php endif;?>
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
                                                    <a class="btn btn-warning  btn-submit btn-secondary mt-3" href="<?=  base_url()?>approve-wiwaran/edit/<?=$result->id?>" style="color:#000" onclick="return confirm('Are you sure to update?')">
                                                        सम्पादन
                                                        गर्नुहोस्
                                                    </a>
                                                    <a class="btn btn-info  btn-submit btn-secondary mt-3" href="<?=  base_url()?>approve-wiwaran/darta/<?=$result->id?>" style="color:#000" onclick="return confirm('विवरण सुनिस्चित गर्नुहोस')">
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
                                                    <a class="btn btn-warning  btn-submit btn-secondary mt-3" href="<?=  base_url()?>approve-wiwaran/edit/<?=$result->id?>" style="color:#000" onclick="return confirm('Are you sure to update?')">
                                                        सम्पादन
                                                        गर्नुहोस्
                                                    </a>
                                                    <a class="btn btn-info  btn-submit btn-secondary mt-3" href="<?=  base_url()?>approve-wiwaran/chalani/<?=$result->id?>" style="color:#000" onclick="return confirm('विवरण सुनिस्चित गर्नुहोस')">
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
                            <?php echo form_open(base_url().'approve-wiwaran/print/'.$result->id ,'target="_blank"'); ?>
                            <button type="submit" class="btn  btn-success  mb-4"><i class="fa fa-print"></i> &nbsp; &nbsp; छाप्नुहोस्</button>
                        <?php endif; ?>
                        <?php if($result->status == 2  ) : ?>
                        <a class="btn btn-info  btn-submit btn-secondary mt-3" href="<?=  base_url()?>approve-wiwaran/chalani/<?=$result->id?>" style="color:#000" onclick="return confirm('विवरण सुनिस्चित गर्नुहोस')">
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
                                <span style="border-bottom: 1px solid black; margin-bottom: 5px;"> <span class="red"> बिषय : </span> सेवा करार नियुक्ति सम्बन्धमा ।
                                </span>

                            </h4>
                        </div>
                       
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
                        <div class="space1"> </div>
                        <div class="text-justify" style="margin-top: 10px; text-indent: 150px;">

                        यस कार्यालय अन्तर्गत <b><?= $result->working_office?></b> <b><?= $result->position?></b> <b><?= $result->taha?></b> पदमा कार्यरत  <b><?= $result->gender.' '.$result->name?></b>(संकेत नं. <b><?= $result->cit_no?></b>), <b><?= $result->yain?></b> मिति <b><?= $result->end_date?></b> गते देखि लागू हुने गरी अनिवार्य अवकास हुनु भएको र निजको शुरु नियुक्ति मिति <b><?= $result->from_date?></b> देखि अवकास हुने मिति सम्ममा उपचार खर्च वापत कुनै पनि रकम नलिएको, गयल कट्टी तथा विभागिय कारवाही नभएको र निजले वरवुझारथ गरिसकेको व्यहोरा अनुरोध छ । 
                        <div class="space1"></div>
                        निजको सञ्चित घर विदा र विरामी विदाको विवरण तपशिल बमोजिम रहेको र उक्त विवरण नि.से.नि. को अनुसूचि १४ को ढाँचामा प्रमााणित गरि यसै साथ संलग्न राखीएको व्यहोरा अनुरोध छ। 
                        </div>
                        <div class="space1"></div>
                        <div class="text-justify" style="margin-top: 10px;">
                            <h3 class="text-center">तपशिल</h3>
                            <?php if(!empty($tapasil)): ?>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>क्र.सं.</th>          
                                        <th>विदाको विवरण</th>    
                                        <th>जम्मा दि</th>
                                        <th>खर्च भएको</th>
                                        <th>वाँकी</th>                  
                                        <th>कैफियत</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1;foreach($tapasil as $tp) : ?>
                                    <tr>
                                        <td><?php echo $i++?></td>
                                        <td><?php echo $tp->bida_wiwaran?></td>
                                        <td><?php echo $tp->jamma_din?></td>
                                        <td><?php echo $tp->kharcha?></td>
                                        <td><?php echo $tp->baki?></td>
                                        <td><?php echo $tp->remarks?></td>
                                    </tr>
                                <?php endforeach;?>
                                </tbody>
                            </table>
                            <?php else : ?>
                                <div class="alert alert-warning">no records founds</div>
                            <?php endif;?>
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
                                                       

                                                ?>
                                                    <option value="<?= $worker->id ?>" <?php
                                                            if($selected_workers != FALSE)
                                                            {
                                                                if($worker->id == $selected_workers->id){
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
                                    <input type="text" name="office_post" id="office_post" class="form-control" style="margin-top:15px;" value="<?php if(!empty($selected_post)){ echo $selected_post->name;}?>" readonly="true" >
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
