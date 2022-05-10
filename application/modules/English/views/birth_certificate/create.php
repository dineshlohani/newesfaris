<?php

if($this->uri->segment(2)== "create")

{

    $action_page = "birth-certificate/save";

}

if($this->uri->segment(2)=="edit")

{

    $action_page = "birth-certificate/update/".$this->uri->segment(3);

}

?>

<style type="text/css">

    body {

      font-family: Arial;

  }

  .numbers {

      font-family: Tahoma;

      color: red;

  }

</style>

<section class="content">

    <div class="container-fluid">

        <div class="row">

            <div class="col-12">

                <?php if(!empty($this->session->flashdata('msg')))

                {?>

                    <div  class="alert alert-success alert-dismissible" >    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span><?=$this->session->flashdata('msg');?></span></div>

                <?php } ?>

                <?php if(!empty($this->session->flashdata('err_msg')))

                {?>

                    <div  class="alert alert-danger alert-dismissible" >    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span><?=$this->session->flashdata('err_msg');?></span></div>

                <?php } ?>

            </div>

        </div>

    </div>

    <div class="container-fluid ">

        <nav aria-label="breadcrumb" class="bg-shadow">

            <ol class="breadcrumb">

                <li class="breadcrumb-item ml-1"><a href="/">Home</a></li>

                <li class="breadcrumb-item active">Birth certificate</li>

                <li class="breadcrumb-item active">Add New</li>

            </ol>

        </nav>

    </div>

    <div class="container-fluid ">

        <div class="card">

            <div class="card-body">

                <?php echo form_open($action_page)?>

                <div class="row">

                    <div class="col-md-6">

                        <input type="hidden" name="id" value="<?=isset($result->id) ? $result->id: '' ?>">

                        <div class="form-group row">

                            <label class="col-sm-4 col-form-label"><span

                                class="float-right">Apply Date(BS)<span

                                class="text-danger">&nbsp;*</span></span></label>

                            <div class="col-sm-8">

                                <div class="input-group">

                                    <input type="text" name="nepali_date" class="form-control" id="" value="<?=isset($result->nepali_date) ? $result->nepali_date : DateEngToNep(date('Y-m-d')) ?>" required readonly="true" />

                                </div>

                            </div>

                        </div>

                    </div>



                    <div class="col-md-6">

                        <div class="form-group row">

                            <label class="col-md-4 col-form-label">

                                <span class="float-right">

                                    Apply Date(AD)<span class="text-danger">&nbsp;*</span>

                                </span>

                            </label>

                            <div class="col-sm-8">

                                <input type="text" name="nepali_date" class="form-control" id="" value="<?=isset($result->eng_date) ? $result->eng_date: date('Y-m-d') ?>" required  readonly="true"/>

                            </div>

                        </div>

                    </div>

                </div>



                <div class="row">

                    <div class="col-md-6">

                        <div class="form-group row">

                            <label class="col-md-4 col-form-label">

                                <span class="float-right">

                                    Child Name<span class="text-danger">&nbsp;*</span>

                                </span>

                            </label>

                            <div class="col-sm-8">

                                <input type="text" name="applicant_name" placeholder=""  class="form-control" required="required" value="">

                            </div>

                        </div>

                    </div>



                    <div class="col-md-6">

                        <div class="form-group row">

                            <label class="col-md-4 col-form-label">

                                <span class="float-right">

                                    Gender<span class="text-danger">&nbsp;*</span>

                                </span>

                            </label>

                            <div class="col-sm-8">

                                <select name="gender" class="form-control" required="required">

                                  <option value="">Select</option>

                                  <option value="1">Male</option>

                                  <option value="2">Female</option>

                              </select>

                            </div>

                        </div>

                    </div>

                </div>


                <div class="row">

                    <div class="col-md-6">

                        <div class="form-group row">

                            <label class="col-sm-4 col-form-label"><span

                                class="float-right">DOB(BS)<span

                                class="text-danger">&nbsp;*</span></span></label>

                            <div class="col-sm-8">

                                <div class="input-group">

                                    <input type="text" name="nep_dob" value="<?=isset($result)?$result->nep_dob:''?>" maxlength="10" class="form-control nep_dob" required id="nepaliDate4" />

                             

                                </div>

                            </div>

                        </div>

                    </div>



                    <div class="col-md-6">

                        <div class="form-group row">

                            <label class="col-md-4 col-form-label">

                                <span class="float-right">

                                    DOB(AD)<span class="text-danger">&nbsp;*</span>

                                </span>

                            </label>

                            <div class="col-sm-8">

                                <input type="text" name="eng_dob" readonly="true" value="<?=isset($result)?$result->eng_dob:''?>" class="form-control" required id="id_eng_dob" />

                            </div>

                        </div>

                    </div>

                </div>



                <div class="row">

                    <div class="col-md-6">

                        <div class="form-group row">

                            <label class="col-md-4 col-form-label">

                                <span class="float-right">

                                    Father's Name<span class="text-danger">&nbsp;*</span>

                                </span>

                            </label>

                            <div class="col-sm-8">

                                <input type="text" name="father_name" placeholder="" class="form-control" required="required">

                            </div>

                        </div>

                    </div>



                    <div class="col-md-6">

                        <div class="form-group row">

                            <label class="col-md-4 col-form-label">

                                <span class="float-right">

                                    Mother's Name<span class="text-danger">&nbsp;*</span>

                                </span>

                            </label>

                            <div class="col-sm-8">

                                <input type="text" name="mother_name" placeholder="" class="form-control">

                            </div>

                        </div>

                    </div>

                </div>



                <div class="row">

                    <div class="col-md-12 mb-3 pt-3">

                        <h4 style="margin-left: 10px; border-bottom: 2px solid #333;" class="pb-2">

                           Birth Address

                        </h4>

                    </div>

                </div>



                <div class="row">



                    <div class="col-md-6">

                        <div class="form-group row">

                            <label class="col-md-4 col-form-label">

                                <span class="float-right">

                                    Province<span class="text-danger">&nbsp;*</span>

                                </span>

                            </label>

                            <div class="col-md-8">

                                <select name="born_state" class="form-control select2 state_selected_en" id="state_selected_en-1" required>

                                  <option value=""> --select--</option>

                                  <?php if(!empty($states)) :

                                      foreach($states as $key => $state) :?>

                                          <option value="<?php echo $state->id?>" <?php if($state->id == SITE_STATE_ID_EN){ echo 'selected';}?>><?php echo $state->english_name?></option>

                                      <?php endforeach;endif;?>

                                </select>

                            </div>

                        </div>

                    </div>



                    <div class="col-md-6">

                        <div class="form-group row">

                            <label class="col-md-4 col-form-label">

                                <span class="float-right">

                                    District<span class="text-danger">&nbsp;*</span>

                                </span>

                            </label>

                            <div class="col-md-8">

                                <select name="born_district" class="form-control select2 district_selected_en" id="selected_district_en-1" required>
                                  <?php if(!empty($districts)) :
                                        foreach($districts as $key => $district) :?>
                                        <option value="<?php echo $district->id?>" <?php if($district->id == SITE_DISTRICT_ID_EN){echo 'selected';}?>><?php echo $district->english_name?></option>
                                    <?php endforeach;endif;?>
                                </select>

                            </div>

                        </div>

                    </div>



                    <div class="col-md-6">

                        <div class="form-group row">

                            <label class="col-md-4 col-form-label">

                                <span class="float-right">

                                    Gapa/Napa <span class="text-danger">&nbsp;*</span>

                                </span>

                            </label>

                            <div class="col-sm-8">

                                <select name="born_gapanapa" class="form-control select2 select_local_body" id="local_body_selected_en-1" required class="form-control">

                                <?php if(!empty($locals)) :

                                    foreach($locals as $key => $l) :?>

                                        <option value="<?php echo $l->id?>" <?php if($l->id == SITE_GAPA_ID_EN){echo 'selected';}?>><?php echo  $l->english_name?></option>

                                    <?php endforeach;endif;?>

                            </select>

                            </div>

                        </div>

                    </div>



                    <div class="col-md-6">

                        <div class="form-group row">

                            <label class="col-md-4 col-form-label">

                                <span class="float-right">

                                    Ward No<span class="text-danger">&nbsp;*</span>

                                </span>

                            </label>

                            <div class="col-sm-8">

                                <select name="born_ward" class="form-control select2" id="selected_ward-1" required >

                                    <option value="">--select--</option>

                                  <?php if(!empty($wards)) :

                                    foreach($wards as $key => $w) :?>

                                        <option value="<?php echo $w->name?>" <?php if($w->name == $this->session->userdata('ward_no')){echo 'selected';}?>><?php echo  $w->name?></option>

                                    <?php endforeach;endif;?>

                                </select>

                            </div>

                        </div>

                    </div>

                    

                </div>



                <div class="row">

                    <div class="col-md-12 mb-3 pt-3">

                        <h4 style="margin-left: 10px; border-bottom: 2px solid #333;" class="pb-2">

                            Permanent  Address <!--<span style="color:red;font-size: 14px;"><input type="checkbox" name="same_as_above" class=""> Same As Birth Address</span>-->

                        </h4>

                    </div>

                </div>



                <div class="row">



                     <div class="col-md-6">

                        <div class="form-group row">

                            <label class="col-md-4 col-form-label">

                                <span class="float-right">

                                    Province<span class="text-danger">&nbsp;*</span>

                                </span>

                            </label>

                            <div class="col-sm-8">

                                <select name="per_state" class="form-control select2 state_selected_en" id="state_selected_en-2" required="true">

                                    <option value="">--select--</option>

                                  <?php if(!empty($states)) : 

                                    foreach ($states as $key => $state) :?>

                                       <option value="<?php echo $state->id?>" <?php if($state->id == SITE_STATE_ID_EN){ echo 'selected';}?>><?php echo $state->english_name?></option>

                                    <?php endforeach; endif;?>

                                </select>

                            </div>

                        </div>

                    </div> 



                    <div class="col-md-6">

                        <div class="form-group row">

                            <label class="col-md-4 col-form-label">

                                <span class="float-right">

                                    District <span class="text-danger">&nbsp;*</span>

                                </span>

                            </label>

                            <div class="col-sm-8">

                               <select name="per_dis" class="form-control select2 district_selected_en" id="selected_district_en-2"  required="required">

                                    <?php if(!empty($districts)) :
                                        foreach($districts as $key => $district) :?>
                                        <option value="<?php echo $district->id?>" <?php if($district->id == SITE_DISTRICT_ID_EN){echo 'selected';}?>><?php echo $district->english_name?></option>
                                    <?php endforeach;endif;?>
                            
                              </select>

                            </div>

                        </div>

                    </div>



                    <div class="col-md-6">

                        <div class="form-group row">

                            <label class="col-md-4 col-form-label">

                                <span class="float-right">

                                    Gapa/Napa <span class="text-danger">&nbsp;*</span>

                                </span>

                            </label>

                            <div class="col-sm-8">

                                <select name="per_gapanapa" class="form-control select2 select_local_body" id="local_body_selected_en-2" required class="form-control">

                                  <option value="">--select--</option>

                                  <?php if(!empty($locals)) :

                                    foreach($locals as $key => $l) :?>

                                        <option value="<?php echo $l->id?>" <?php if($l->id == SITE_GAPA_ID_EN){echo 'selected';}?>><?php echo  $l->english_name?></option>

                                    <?php endforeach;endif;?>

                                </select>

                            </div>

                        </div>

                    </div>



                    <div class="col-md-6">

                        <div class="form-group row">

                            <label class="col-md-4 col-form-label">

                                <span class="float-right">

                                    Ward No<span class="text-danger">&nbsp;*</span>

                                </span>

                            </label>

                            <div class="col-sm-8">

                                <select name="per_ward" class="form-control select2" id="selected_ward-2" >

                                    <option value="">--select--</option>
                                         <?php if(!empty($wards)) :

                                    foreach($wards as $key => $w) :?>

                                        <option value="<?php echo $w->name?>" <?php if($w->name == $this->session->userdata('ward_no')){echo 'selected';}?>><?php echo  $w->name?></option>

                                    <?php endforeach;endif;?>

                                  </select>

                            </div>

                        </div>

                    </div>

                </div>




                <hr class="mt-5 mb-4">

                   <div class="form-group row">

                        <div class="col-sm-6 offset-sm-6 mt-4">

                            <button type="submit" class='btn btn-block btn-submit btn-primary' name="submit">पेश

                                गर्नुहोस्

                            </button>

                        </div>

                    </div>

                 <?php echo form_close();?>

            </div>

        </div>

    </div>

</section>

<script src="<?=base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>

<script>

    function checkMyDate(date_selected, id_selected)

    {

      if(id_selected=="nepaliDate4")

      {

       var  nep_dob = date_selected;

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

