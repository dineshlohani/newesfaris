<style type="text/css">
body {
  font-family: Arial;
}
.numbers {
  font-family: Tahoma;
  color: red;
}
select{
  font-family: Arial;
}
</style>
<?php


$this->load->helper('functions_helper');
    if($this->uri->segment(2)== "create")
    {
    $action_page = "birth-certificate/save";
    $name = "नवीनतम डाटा";
    }
    if($this->uri->segment(2)=="edit")
    {
    $action_page = "citizenship-certificate/edit/".($this->uri->segment(3));
    $name = "साच्याउनुहोस";
    }
    $gender = ($detail->status == 1) ? 'MR' : 'MRS';
    $son_daughter = ($details->son_daughter == 1)? 'Son' : 'Daughter';
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
                <li class="breadcrumb-item ml-1"><a href="<?=  base_url()?>certificate-dashboard">Home</a></li>
                <li class="breadcrumb-item"><a href="<?=  base_url()?>citizenship-certificate"> Birth certificate </a></li>
                <li class="breadcrumb-item active">Create</li>
            </ol>
        </nav>
    </div>
    <div class="container-fluid font-kalimati">
        <div class="bd-example bd-example-tabs">
            <nav class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#details" role="tab" aria-controls="home" aria-expanded="true">बिस्तृत</a>
                <?php
                if($detail->status ==3)
                {
            ?>
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#sifaris" role="tab" aria-controls="profile" aria-expanded="false">सिफारिस</a>
                <?php
                }
            ?>
            </nav>
            <div class="tab-content" id="nav-tabContent">
              <div class="tab-pane fade active show" id="details" role="tabpanel" aria-labelledby="nav-home-tab" aria-expanded="true">
                <div class="row">
                    <div class="col-lg-12">
                        <?php echo form_open_multipart($action_page)?>
                          <div class="row ">
                            <div class="col-md-12">
                              <div class="form-group row pull-right">
                                  <label class="col-sm-4 col-form-label"><span
                                         class="float-right">Date</span></label>
                                      <div class="col-sm-8">
                                         <div class="input-group">
                                             <input type="text" name="date" class="form-control" required  value="<?php echo date('Y-m-d')?>" readonly/>
                                         </div>
                                      </div>
                              </div>
                            </div> 
                          </div>
                          <div class="row">
                            <div class="col-md-12 mb-3 pt-3">
                              <h4 style="margin-left: 10px; border-bottom: 2px solid #333;" class="pb-2">
                                  Birth Certificate Details <br>
                                  <span style="color: <?php if($detail->status != 1){ echo 'green'; } else {echo 'red';}?>"> स्वीकृत: <?php if($detail->status != 1) {
                                    echo 'भएको';
                                  } else {
                                    echo 'नभएको';
                                  }
                                  ?>
                              </span>
                              </h4>
                            </div>
                            <div class="col-md-12">
                              <p>This is to certify that
                                <select name="gender" style="width:100px; height: 30px" required="required" disabled>
                                  <option value=""> Select *</option>
                                  <option value="1" <?php if($detail->gender == 1){echo 'selected';}?>>Mr</option>
                                  <option value="2" <?php if($detail->gender == 2){echo 'selected';}?>>Mrs</option>
                                </select>
                                <input type="text" name="applicant_name" placeholder="Name *"  style="width:300px;height: 30px;" disabled value="<?php echo $detail->app_name?>">

                                <select name="son_daughter" style="width:100px; height: 30px" disabled>
                                  <option value="">Select *</option>
                                  <option value="1" <?php if($detail->son_daughter == 1){echo 'selected';}?> >Son</option>
                                  <option value="2" <?php if($detail->son_daughter == 2){echo 'selected';}?>>Daughter</option>
                                </select>
                                
                                <input type="text" name="father_name" placeholder="Father's Name *" style="width:280px;height: 30px;" required="required" value="<?php echo $detail->father_name?>" disabled>
                               &
                              
                              </p>

                              <p> <input type="text" name="mother_name" placeholder="Mother's Name *" style="width:280px; height: 30px;" value="<?php echo $detail->mother_name?>" disabled> Was  born in
                               <!--  <select name="born_state" style="height: 30px">
                                  <option value="">Select State</option>
                                  <?php //if(!empty($states)) : 
                                    //foreach ($states as $key => $state) :?>
                                    <option value="<?php //echo $state->id?>"><?php //echo $state->english_name?></option>
                                  <?php //endforeach; endif;?>
                                </select>  -->
                               <!--  <select name="born_dis" style=" height: 30px">
                                  <option value="">Select District</option>
                                  <?php //if(!empty($districts)) :
                                  //foreach($districts as $key => $district) :?>
                                  <option value="<?php //echo $district->id?>"><?php //echo $district->name?></option>
                                  <?php //endforeach;endif;?>
                                </select> -->

                                <select name="born_gapanapa" class="form-control select2" id="state_selected-1" disabled="true" style="width:270px;height: 30px">
                                  <option value="">Gapa/Napa *</option>
                                  <?php if(!empty($locals)) :
                                    foreach($locals as $key => $l) :?>
                                    <option value="<?php echo $l->id?>" <?php if($l->id == $detail->birth_gapana){echo 'selected';}?>><?php echo  $l->english_name?></option>
                                  <?php endforeach;endif;?>
                                </select>

                                <select name="born_ward" class="form-control select2 state_selected" id="state_selected-1" disabled="true" style="width:100px;height: 30px">
                                  <option value="">Ward*</option>
                                  <?php if(!empty($wards)) :
                                    foreach($wards as $key => $w) :?>
                                    <option value="<?php echo $lw->id?>" <?php if($w->name == $detail->birth_ward){echo 'selected';}?>><?php echo  $w->name?></option>
                                  <?php endforeach;endif;?>
                                </select>

                                <select name="born_dis" style=" height: 30px" disabled="true" style="width:200px;height: 30px">
                                 
                                  <?php if(!empty($districts)) :
                                  foreach($districts as $key => $district) :?>
                                  <option value="<?php echo $district->id?>" <?php if($district->id == $detail->birth_district){echo 'selected';}?>><?php echo $district->name?></option>
                                  <?php endforeach;endif;?>
                                </select>
                              </p>
                               
                              <p>
                              Permanent  resident of
                              <select name="per_dis" class="form-control select2 state_selected" style="height: 30px; width: 250px;" disabled="true" required="required">
                                <option value="">District *</option>
                                <?php if(!empty($districts)) :
                                  foreach($districts as $key => $district) :?>
                                  <option value="<?php echo $district->id?>" <?php if($district->id == $detail->per_district){echo 'selected';}?>><?php echo $district->name?></option>
                                <?php endforeach;endif;?>
                              </select>
                               <select name="per_gapanapa" class="form-control select2 state_selected" id="state_selected-1" disabled="true" required style="width:300px;height: 30px">
                                  <option value="">Gapa/Napa *</option>
                                  <?php if(!empty($locals)) :
                                    foreach($locals as $key => $l) :?>
                                    <option value="<?php echo $l->id?>" <?php if($l->id == $detail->per_gapana){echo 'selected';}?>><?php echo  $l->english_name?></option>
                                  <?php endforeach;endif;?>
                                </select>

                              <select name="per_ward" class="form-control select2 state_selected"  disabled="true" style="height: 30px;width:70px;">
                                <option value="">Ward *</option>
                               <?php if(!empty($wards)) :
                                  foreach($wards as $key => $w) :?>
                                  <option value="<?php echo $w->name?>" <?php if($w->name == $detail->per_ward){echo 'selected';}?>><?php echo  $w->name?></option>
                                <?php endforeach;endif;?>
                              </select>
                             <select style="width:180px;height: 30px; font-family: " name="per_state" class="form-control select2 state_selected" disabled="true">
                                  <option value="">Province*</option>
                                  <?php if(!empty($states)) : 
                                    foreach ($states as $key => $state) :?>
                                    <option value="<?php echo $state->id?>" <?php if($state->id == $detail->per_state){echo 'selected';}?>><?php echo $state->english_name?></option>
                                  <?php endforeach; endif;?>
                                </select> , Nepal.
                             </p>

                             <p>
                              <hr>
                              According to our record his/her date of birth is
                                <div class="input-group">
                                    <input type="text" name="nep_dob" value="<?=isset($detail)?$detail->dob_np:''?>" maxlength="10" class="form-control nep_dob" required id="nepaliDate4" disabled="true" />
                                    <div class="input-group-append">
                                        <span class="input-group-text">B.S. *</span>
                                    </div>

                                    <input type="text" name="eng_dob" readonly="true" value="<?=isset($detail)?$detail->dob_en:''?>" class="form-control" required id="id_eng_dob" />
                                    <div class="input-group-append">
                                        <span class="input-group-text">A.D. *</span>
                                    </div>
                                </div>
                              </p>
                            </div>
                          </div>
                          <hr class="mt-5 mb-4">
                          <div class="row">
                            <?php if($detail->status == 1 ) { ?>
                            <div class="col-sm-6 mt-4">
                                <a href="<?php echo base_url()?>birth-certificate/edit/<?php echo $detail->id?>" class='btn btn-block btn-warning'>सम्पादन गर्नुहोस्
                                </a>
                            </div>
                            <div class="col-sm-6 mt-4">
                                 <a href="<?php echo base_url()?>birth-certificate/darta/<?php echo $detail->id?>" class='btn btn-block btn-submit btn-success'>दर्ता गर्नुहोस
                                </a>
                            </div>
                            <?php } else if($detail->status == 2) { ?>
                            <div class="col-sm-6  offset-sm-6 mt-4">
                                <a href="<?php echo base_url()?>birth-certificate/chalani/<?php echo $detail->id?>" class='btn btn-block btn-success'>चलानी गर्नुहोस
                                </a>
                            </div>
                            <?php } else {

                            } ?>
                          </div>
                        <?php echo form_close();?>
                    </div>
                </div>
              </div>

              <!-- ----------------------------------------districts----------------------------------------------------------------------------- -->
              <?php if($detail->status == 3) {?>
              <div class="tab-pane fade" id="sifaris" role="tabpanel" aria-labelledby="nav-home-tab" aria-expanded="true">
                <div class="row">
                    <div class="col-lg-12">
                      <div class="text-right">
                        <?php echo form_open(base_url().'birth-certificate/print/'.$detail->id ,'target="_blank"'); ?>
                        <button type="submit" class="btn  btn-success  mb-4"><i class="fa fa-print"></i> &nbsp; &nbsp; छाप्नुहोस्</button>
                      </div>

                      <div class="font-14 text-black" style="line-height: 1.6;">
                        <div class="letter">
                            <div class="letter-head"><!-- Letter head -->
                                <div class="row">
                                    <div class="col-3 letter-head-left">
                                        <img src="<?=base_url()?>assets/images/icons/logo.png" alt="logo.png">
                                       <!--  <span class="red"> पत्र संख्या: </span> <?= $current_session->name ?><br>
                                        <span class="red"> चलानी नं.:  </span> <?= $chalani_details->chalani_no ?> -->
                                    </div>
                                    <div class="col-6 letter-head-center red">
                                        <h2><?= SITE_OFFICE_ENG ?></h2>
                                        <div>
                                          <?php if($this->session->userdata('is_muncipality') == 1):?>
                                            <h3> <?= SITE_PALIKA_ENG ?></h3>
                                            <?php else: ?>
                                              <h3><?=$this->session->userdata('ward_no')?> <?= SITE_WARD_OFFICE_ENG ?></h3>
                                            <?php endif; ?>
                                            <?php if($this->session->userdata('is_muncipality')==0):?>
                                              <h3><?=  $this->session->userdata('address').", ".SITE_DISTRICT_ENG?> </h3>
                                              <?php else: ?>
                                                <h3><?= SITE_ADDRESS_ENG ?></h3>
                                              <?php endif;?>
                                              <h4><?= SITE_STATE_ENG ?> </h4>
                                            </div>
                                    </div>
                                    <div class="col-3 text-right letter-head-right">
                                        <div class="myclear"> </div>
                                        <span class="red" style="font-family: Arial;"> Date :  <?= $detail->date?></span>
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
                          
                        </div>
                       
                        <div class="space4"></div>
                        <div class="text-center mt-2 mb-5">
                            <h4><span style="border-bottom: 1px solid black; margin-bottom: 3px;"> <span class="red"> SUB: </span> BIRTH CERTIFICATE </span>
                              <h4><span style="border-bottom: 1px solid black; margin-bottom: 3px;"> TO WHOM IT MAY CONCERN </span>
                            </h4>
                        </div>
                        <div class="text-justify" style=" font-family: Arial; ">
                          This is to certify that <b><?php echo $gender?>. <?php echo $detail->app_name?></b>, <?php echo $son_daughter?> of <b>Mr. <?php echo $detail->father_name?></b>, &amp; <b>Mrs.
                           <?php echo $detail->father_name?></b>, Was born in <?php echo $born_gapa->english_name?>, Ward No.  <?php echo $detail->birth_ward?>, <?php echo $born_dis->name?>, 
                           Permanent resident
                          of Jwalamukhi Rural Municipality Ward No. 05, Dhading, 3 No. Province, Nepal.
                          <br>
                          According to our record her date of birth is <?php echo $detail->dob_np?> B. S. (<?php echo $detail->dob_en?> A. D.).
                        </div>
                       
                        <div class="row">
                            <div class="col-3 offset-9">
                                <div style="margin-top: 120px;">
                                    <div class="text-center">
                                        ................................. <br>
                                        <?php echo $ward_worker->name?>
                                        <br>Chairperson
                                     
                                        <?php echo form_close();?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    </div>
                </div>
              </div>
              <!------------------------------------------districts----------------------------------------------------------------------------- -->
            <?php } ?>
            </div>
          </div>
    </section>
</div>
<script src="<?=base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<script type="text/javascript"></script>
<script>
function checkMyDate(date_selected, id_selected)
    {
      if(id_selected=="nepaliDate4")
      {
//        console.log(obj);
       var  nep_dob = date_selected;
//              alert(nep_dob);
                param = {};
                param.nep_dob = nep_dob;
                JQ.ajax({
                    url: "<?= base_url()?>getConvertedDate",
                    method: "POST",
                    data: param,
                    success: function (data) {
                        var obj = JSON.parse(data);
                        JQ("#id_eng_dob").val(obj.html);
                    },
                    error: function (error) {
                        console.log(JSON.stringify(error));
                    }
                });
            }
    }
</script>