<?php
$this->load->helper('functions_helper');
    if($this->uri->segment(2)== "create")
    {
    $action_page = "relationship/save";
    $name = "नवीनतम डाटा";
    }
    if($this->uri->segment(2)=="edit")
    {
    $action_page = "relationship/update/";
    $name = "साच्याउनुहोस";
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
                <li class="breadcrumb-item active"><a href="" >Relationship certificate</a></li>
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
                        <input type="hidden" name="id" value="<?=isset($detail->id) ? $detail->id: '' ?>">
                    </div>   
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label">
                                <span class="float-right">
                                    Applicant Name<span class="text-danger">&nbsp;*</span>
                                </span>
                            </label>
                            <div class="col-sm-2">
                                <select name="gender" required="required" class="form-control">
                                  <option value="1" <?php if($detail->gender == 1){echo 'selected';}?>>Mr</option>
                                  <option value="2" <?php if($detail->gender == 2){echo 'selected';}?>>Mrs</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" name="applicant_name" placeholder=""  class="form-control" required="required" value="<?php echo $detail->app_name?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label">
                                <span class="float-right">
                                    Relation<span class="text-danger">&nbsp;*</span>
                                </span>
                            </label>
                            <div class="col-sm-8">
                                <select name="f_relation" style="width:280px; height: 30px" required="required" class="form-control select2">
                                    <?php if(!empty($relation)) {
                                    foreach ($relation as $key => $rel) { ?>
                                       <option value="<?php echo $rel->english_name?>" <?php if($detail->relation == $rel->english_name){echo 'selected';}?>><?php echo $rel->english_name?></option>
                                    <?php  }  } ?>
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
                            Permanent  Residence
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
                                <select name="per_state" class="form-control state_selected_en" id="state_selected_en-1" required="true">
                                    <option value="">Select</option>
                                  <?php if(!empty($states)) : 
                                    foreach ($states as $key => $state) :?>
                                        <option value="<?php echo $state->id?>" <?php if($state->id == $detail->per_state){ echo 'selected';}?>><?php echo $state->english_name?></option>
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
                            <select name="per_dis" class="form-control district_selected_en" id="selected_district_en-1"  required="required">
                            <?php if(!empty($districts)) :
                              foreach($districts as $key => $district) :?>
                                  <option value="<?php echo $district->id?>" <?php if($detail->per_district == $district->id){echo 'selected';}?>><?php echo $district->english_name?></option>
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
                            <select name="per_gapanapa" class="form-control select_local_body" id="local_body_selected_en-1" required >
                              <?php if(!empty($locals)) :
                                foreach($locals as $key => $l) :?>
                                    <option value="<?php echo $l->id?>" <?php if($detail->per_gapana == $l->id){echo 'selected';}?> ><?php echo  $l->english_name?></option>
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
                                <select name="per_ward" class="form-control select2" id="selected_ward-1" >
                                    <option value="">Select </option>
                                    <?php if(!empty($wards)) :
                                       for ($x = 1; $x <= $wards->no_of_ward; $x++) { ?>
                                        <option value="<?php echo $x?>" <?php if($detail->per_ward == $x){ echo 'selected';}?>><?php echo $x;?></option>';
                                    <?php }
                                endif;
                                    ?>
                                  </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label"><span
                                class="float-right">Recommend Ward<span
                                class="text-danger">&nbsp;*</span></span></label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <select name="rem_ward" class="form-control select2" id="selected_ward-1" >
                                        <option value="">Select Ward</option>
                                        <?php if(!empty($wards)) :
                                          
                                              for ($x = 1; $x <= $wards->no_of_ward; $x++) { ?>
                                        <option value="<?php echo $x?>" <?php if($detail->rem_ward == $x){ echo 'selected';}?>><?php echo $x;?></option>';
                                          <?php } endif;?>
                                      </select>
                             
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                 <div class="row">
                    <div class="col-md-12 mb-3 pt-3">
                        <h4 style="margin-left: 10px; border-bottom: 2px solid #333;" class="pb-2">
                            Famaily Members
                        </h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered" id="add_new_fields">
                            <thead>
                                <tr>
                                    <td>Gender*</td>
                                    <th>Name*</th>
                                    <th>Relation*</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($members)) : 
                                    foreach($members as $key => $member) : ?>
                                <tr>
                                    <td>
                                        <input type="hidden" name = "rel_id[]" value="<?php echo $member->id?>">
                                        <select name="rel_gender[]"  required="required" class="form-control">
                                            <option value=""> Select </option>
                                            <option value="Mr" <?php if($member->gender == 'Mr'){echo 'selected';}?>>Mr</option>
                                            <option value="Mrs" <?php if($member->gender == 'Mrs'){echo 'selected';}?>>Mrs</option>
                                        </select>
                                    </td>
                                    <td><input type="text" name="rel_name[]" class="form-control" value="<?php echo $member->name?>"></td>
                                    <td>
                                        <select name="relation[]" required="required" class="form-control">
                                            <option value="">Select </option>
                                            <?php if(!empty($relation)) {
                                                foreach ($relation as $key => $rel) { ?>
                                                <option value="<?php echo $rel->english_name?>"<?php if($member->relation == $rel->english_name){echo 'selected';}?>><?php echo $rel->english_name?></option>
                                            <?php  } } ?>
                                        </select>
                                    </td>
                                    <td><a href="<?php echo base_url()?>English/Relationship/RemoveMembers/<?php echo $member->id.'/'.$detail->id?>" class = "btn btn-danger" onclick="return confirm('Are you sure you want delete member?')"><i class="fa fa-minus" style="color:#fff"></i></a></td>
                                </tr>
                            <?php endforeach; endif;?>
                            </tbody>
                        </table>
                         <button type= "button" class="btn  btn-info pull-right btnAddNew"><i class="fa fa-plus"></i> Add New Member </button>
                    </div>
                </div>

                <hr class="mt-5 mb-4">
                <div class="form-group row">
                    <div class="col-sm-6 offset-sm-6 mt-4">
                        <button type="submit" class='btn btn-block btn-submit btn-primary' name="submit">पेश गर्नुहोस्
                        </button>
                    </div>
                </div>
            <?php echo form_close();?>
            </div>
        </div>
    </div>
</section>
<script src="<?=base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?=base_url()?>assets/bower_components/select2/dist/js/select2.min.js"></script>
<script type="text/javascript"></script>
<script>
$(document).ready(function(){

  $('.btnAddNew').click(function(e) {
         
          e.preventDefault();
          var trOneNew = $('.nagadi_rasid_frm').length+1;
          var new_row =  '<tr class="nagadi_rasid_frm">'+
                          '<td>'+
                           '<select name="rel_gender_new[]" required="required" class="form-control select2"><option value=""> Select </option><option value="Mr">Mr</option><option value="Mrs">Mrs</option></select></td>'+
                            '<td><input type="text" name="rel_name_new[]" class="form-control"></td>'+

                            '<td>'+
                            '<select name="relation_new[]" required="required" class="form-control rel"><option value="">Select </option><?php if(!empty($relation)) { foreach ($relation as $key => $rel) { ?><option value="<?php echo $rel->english_name?>"><?php echo $rel->english_name?></option><?php  }} ?></select></td>'+
                                '<td><button type ="button" class="btn  btn-danger remove-row"><i class="fa fa-minus"></i></button></td>'+
                          '</tr>';
          $("#add_new_fields").append(new_row);
          //$('.rel').select2();
      });


      $("body").on("click",".remove-row", function(e){
        e.preventDefault();
        var id = $(this).data('id');
        if (confirm('के तपाइँ  यसलाई हटाउन निश्चित हुनुहुन्छ ?')) {
         
          $(this).parent().parent().remove();
        }
      });

})
</script>
