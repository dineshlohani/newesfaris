<?php
$this->load->helper('functions_helper');
    if($this->uri->segment(2)== "edit")
    {
    $action_page = "birth-certificate/update";
    $name = "नवीनतम डाटा";
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
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div>

    <div class="container-fluid ">
    <div class="card">
        <div class="card-body">
            <div class="row"><div class="offset-lg-1 col-lg-10"></div></div>

                <?php if(!empty($this->session->flashdata('msg')))
                {?>
                    <div  class="alert alert-success alert-dismissible" >    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span><?=$this->session->flashdata('msg');?></span></div>


                <?php } ?>
                <?php if(!empty($this->session->flashdata('err_msg')))
                {?>
                    <div  class="alert alert-danger alert-dismissible" >    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span><?=$this->session->flashdata('err_msg');?></span></div>
                <?php } ?>

                <?php echo form_open_multipart($action_page)?>
                  <input type="hidden" name="id" value="<?php echo $detail->id?>">
                  <div class="row ">
                    <div class="col-md-12">
                      <div class="form-group row pull-right">
                          <label class="col-sm-4 col-form-label"><span
                                 class="float-right">Date</span></label>
                              <div class="col-sm-6">
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
                          Birth Certificate Details
                      </h4>
                    </div>
                    <div class="col-md-12">
                      <p>This is to certify that
                        <select name="gender" style="width:100px; height: 30px" required="required">
                          <option value=""> Select *</option>
                          <option value="1" <?php if($detail->gender == 1){echo 'selected';}?>>Mr</option>
                          <option value="2" <?php if($detail->gender == 2){echo 'selected';}?>>Mrs</option>
                        </select>
                        <input type="text" name="applicant_name" placeholder="Name *"  style="width:300px;height: 30px;" value="<?php echo $detail->app_name?>">
                        <select name="son_daughter" style="width:100px; height: 30px">
                          <option>Select *</option>
                          <option value="1" <?php if($detail->son_daughter == 1){echo 'selected';}?> >Son</option>
                          <option value="2" <?php if($detail->son_daughter == 2){echo 'selected';}?>>Daughter</option>
                        </select>
                        
                        <input type="text" name="father_name" placeholder="Father's Name *" style="width:280px;height: 30px;" required="required" value="<?php echo $detail->father_name?>">
                       &
                      
                      </p>

                      <p> <input type="text" name="mother_name" placeholder="Mother's Name *" style="width:280px; height: 30px;" value="<?php echo $detail->mother_name?>"> Was  born in
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

                        <select name="born_gapanapa" class="form-control select2" id="state_selected-1" style="width:250px;height: 30px">
                          <option value="">Gapa/Napa *</option>
                          <?php if(!empty($locals)) :
                            foreach($locals as $key => $l) :?>
                            <option value="<?php echo $l->id?>" <?php if($l->id == $detail->birth_gapana){echo 'selected';}?>><?php echo  $l->english_name?></option>
                          <?php endforeach;endif;?>
                        </select>

                        <select name="born_ward" class="form-control select2" id="state_selected-1" style="width:100px;height: 30px">
                         
                          <?php if(!empty($wards)) :
                            foreach($wards as $key => $wb) :?>
                            <option value="<?php echo $wb->id?>" <?php if($wb->name == $detail->birth_ward){echo 'selected';}?>><?php echo  $wb->name?></option>
                          <?php endforeach;endif;?>
                        </select>

                         <select name="born_dis" class="form-control select2" style="width:200px;height: 30px">
                          <option value="">Select District</option>
                          <?php if(!empty($districts)) :
                            foreach($districts as $key => $district) :?>
                          <option value="<?php echo $district->id?>"><?php echo $district->name?></option>
                          <?php endforeach;endif;?>
                        </select>
                         
                      </p>
                       
                      <p>
                        Permanent  resident of 
                        
                      <select name="per_dis" class="form-control select2" style="height: 30px; width: 200px;" required="required">
                        <option value="">District *</option>
                        <?php if(!empty($districts)) :
                          foreach($districts as $key => $district) :?>
                          <option value="<?php echo $district->id?>" <?php if($district->id == $detail->per_district){echo 'selected';}?>><?php echo $district->name?></option>
                        <?php endforeach;endif;?>
                      </select>
                       <select name="per_gapanapa" class="form-control select2" id="state_selected-1" required style="width:300px;height: 30px">
                          <option value="">Gapa/Napa *</option>
                          <?php if(!empty($locals)) :
                            foreach($locals as $key => $l) :?>
                            <option value="<?php echo $l->id?>" <?php if($l->id == $detail->per_gapana){echo 'selected';}?>><?php echo  $l->english_name?></option>
                          <?php endforeach;endif;?>
                        </select>

                      <select name="per_ward" class="form-control select2 "  style="height: 30px;width:70px;">
                        <option value="">Ward *</option>
                       <?php if(!empty($wards)) :
                          foreach($wards as $key => $w) :?>
                          <option value="<?php echo $w->name?>" <?php if($w->name == $detail->per_ward){echo 'selected';}?>><?php echo  $w->name?></option>
                        <?php endforeach;endif;?>
                      </select>
                     <select style="width:180px;height: 30px" name="per_state" class="form-control select2">
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
                              <input type="text" name="nep_dob" value="<?=isset($detail)?$detail->dob_np:''?>" maxlength="10" class="form-control nep_dob" required id="nepaliDate4" />
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
                    <div class="col-sm-6 offset-sm-6 mt-4">
                          <button type="submit" class='btn btn-block btn-submit btn-primary' name="submit">पेश
                              गर्नुहोस्
                          </button>
                      </div>
                  </div>
                 <?php echo form_close();?>
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