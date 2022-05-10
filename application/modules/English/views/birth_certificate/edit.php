<?php
if($this->uri->segment(2)== "create")
{
    $action_page = "birth-certificate/save";
}
if($this->uri->segment(2)=="edit")
{
    $action_page = "birth-certificate/update/";
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
                 <input type="hidden" name="id" value="<?=isset($detail->id) ? $detail->id: '' ?>">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label">
                                <span class="float-right">
                                    Applicant Name<span class="text-danger">&nbsp;*</span>
                                </span>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" name="applicant_name" placeholder=""  class="form-control" required="required" value="<?=isset($detail->app_name) ? $detail->app_name: date('Y-m-d') ?>">
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
                                  <option value="1" <?php if($detail->gender == 1){echo 'selected';}?>>Son</option>
                                  <option value="2" <?php if($detail->gender == 2){echo 'selected';}?>>Daughter</option>
                              </select>
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
                                <input type="text" name="father_name" placeholder="" class="form-control" required="required" value="<?php echo $detail->father_name?>">
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
                                <input type="text" name="mother_name" placeholder="" class="form-control" value="<?php echo $detail->mother_name?>">
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
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label">
                                <span class="float-right">
                                    Gapa/Napa <span class="text-danger">&nbsp;*</span>
                                </span>
                            </label>
                            <div class="col-sm-8">
                                <select name="born_gapanapa" class="form-control select2" id="state_selected-1" required class="form-control">
                              <option value="">Select</option>
                              <?php if(!empty($locals)) :
                                foreach($locals as $key => $l) :?>
                                    <option value="<?php echo $l->id?>" <?php if($detail->birth_gapana == $l->id){echo 'selected';}?>><?php echo  $l->english_name?></option>
                                <?php endforeach;endif;?>
                            </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label">
                                <span class="float-right">
                                    Ward No<span class="text-danger">&nbsp;*</span>
                                </span>
                            </label>
                            <div class="col-sm-8">
                                <select name="born_ward" class="form-control select2 state_selected" id="state_selected-1" required >
                                    <option value="">Select</option>
                                  <?php if(!empty($wards)) :
                                    foreach($wards as $key => $w) :?>
                                        <option value="<?php echo $w->name?>" <?php if($detail->birth_ward == $w->id){echo 'selected';}?>><?php echo  $w->name?></option>
                                    <?php endforeach;endif;?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label">
                                <span class="float-right">
                                    District<span class="text-danger">&nbsp;*</span>
                                </span>
                            </label>
                            <div class="col-sm-8">
                                <select name="born_district" class="form-control select2" style="width:150px;height: 30px" required>
                                  <option value=""> District</option>
                                  <?php if(!empty($districts)) :
                                      foreach($districts as $key => $district) :?>
                                          <option value="<?php echo $district->id?>" <?php if($detail->birth_district  == $district->id){echo 'selected';}?>><?php echo $district->name?></option>
                                      <?php endforeach;endif;?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-3 pt-3">
                        <h4 style="margin-left: 10px; border-bottom: 2px solid #333;" class="pb-2">
                            Permanent  Address
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
                                <select name="per_state" class="form-control select2">
                                    <option value="">Select</option>
                                  <?php if(!empty($states)) : 
                                    foreach ($states as $key => $state) :?>
                                        <option value="<?php echo $state->id?>" <?php if($detail->per_state == $state->id){echo 'selected';}?>><?php echo $state->english_name?></option>
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
                               <select name="per_dis" class="form-control select2"  required="required">
                                <option value="">Select</option>
                                <?php if(!empty($districts)) :
                                  foreach($districts as $key => $district) :?>
                                      <option value="<?php echo $district->id?>" <?php if($detail->per_district == $district->id){echo 'selected';}?>><?php echo $district->name?></option>
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
                                <select name="per_gapanapa" class="form-control select2 " id="state_selected-1" required class="form-control">
                                  <option value="">Select</option>
                                  <?php if(!empty($locals)) :
                                    foreach($locals as $key => $l) :?>
                                        <option value="<?php echo $l->id?>" <?php if($detail->per_gapana == $l->id){echo 'selected';}?>><?php echo  $l->english_name?></option>
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
                                <select name="per_ward" class="form-control select2" >
                                    <option value="">Select </option>
                                    <?php if(!empty($wards)) :
                                      foreach($wards as $key => $w) :?>
                                          <option value="<?php echo $w->name?>" <?php if($detail->per_ward == $w->id){echo 'selected';}?>><?php echo  $w->name?></option>
                                      <?php endforeach;endif;?>
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
                                    <input type="text" name="nep_dob" value="<?=isset($detail)?$detail->dob_np:''?>" maxlength="10" class="form-control nep_dob" required id="nepaliDate4" />
                             
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
                                <input type="text" name="eng_dob" readonly="true" value="<?=isset($detail)?$detail->dob_en:''?>" class="form-control" required id="id_eng_dob" />
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