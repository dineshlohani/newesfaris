

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

.select2-container--default .select2-selection--single{
  border:none;
  background: #7d6c6c08;
}
.select2 {
  font-family: Arial;
        border-top-style: hidden;
        border-right-style: hidden;
        border-left-style: hidden;
       border-bottom-style: 1px solid #7d6c6c08;
        background-color: #fff;
  /*border-top-style: hidden;
        border-right-style: hidden;
        border-left-style: hidden;
        border-bottom-style: dotted;
        background-color: #eee;*/
}

input 
{       
        font-family: Arial;
        border-top-style: hidden;
        border-right-style: hidden;
        border-left-style: hidden;
        border-bottom: 1px solid #1b0d0d3b;
        background-color: #7d6c6c08;
}
      
.no-outline:focus {
  outline: none;
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
          <li class="breadcrumb-item active">Create</li>
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
                              <div class="col-sm-8">
                                 <div class="input-group">
                                     <input type="text" name="date" class="form-control" required  value="<?php echo date('Y-m-d')?>" style="border:none"/>
                                 </div>
                              </div>
                      </div>
                    </div> 
                  </div>
                  <div class="row">
                    <div class="col-md-12 mb-3 pt-3">
                      <h4 style="margin-left: 10px; border-bottom: 2px solid #333;" class="pb-2">
                          Relationship Certificate Details
                      </h4>
                    </div>
                    <div class="col-md-12">
                      <p>This is to certify that
                        <select name="gender" style="width:100px; height: 30px" required="required" class="form-control select2">
                          <option value=""> Select *</option>
                          <option value="1" <?php if($detail->gender == 1){echo 'selected';}?>>Mr</option>
                          <option value="2" <?php if($detail->gender == 2){echo 'selected';}?>>Mrs</option>
                        </select>
                        <input type="text" name="applicant_name" placeholder="Name *"  style="width:400px;height: 35px;" required="required" value="<?php echo $detail->app_name?>">
                        <select name="f_relation" style="width:280px; height: 30px" required="required" class="form-control select2">
                          <option value="">Relation *</option>
                          <?php if(!empty($relation)) {
                            foreach ($relation as $key => $rel) { ?>
                             <option value="<?php echo $rel->english_name?>" <?php if($detail->relation == $rel->english_name){echo 'selected';}?>><?php echo $rel->english_name?></option>
                          <?php  }
                          } ?>
                        </select>
                      </p>
                      <p>
                      <p>
                        Mr. <input type="text" name="father_name" placeholder="Name *"  style="width:430px;height: 35px;" required="required" value="<?php echo $detail->father_name?>"> & Mrs.
                        <input type="text" name="mother_name" placeholder="Name *"  style="width:430px;height: 35px;" required="required" value="<?php echo $detail->mother_name?>">
                      </p>
                        Permanent  resident of 
                        
                      <select name="per_dis" class="form-control select2" style="height: 30px; width: 220px;" required="required">
                        <option value="">District *</option>
                        <?php if(!empty($districts)) :
                          foreach($districts as $key => $district) :?>
                          <option value="<?php echo $district->id?>" <?php if($detail->per_district == $rel->district){echo 'selected';}?>><?php echo $district->name?></option>
                        <?php endforeach;endif;?>
                      </select>
                       <select name="per_gapanapa" class="form-control select2 " id="state_selected-1" required style="width:300px;height: 30px">
                          <option value="">Gapa/Napa *</option>
                          <?php if(!empty($locals)) :
                            foreach($locals as $key => $l) :?>
                            <option value="<?php echo $l->id?>" <?php if($detail->per_gapana == $l->id){echo 'selected';}?> ><?php echo  $l->english_name?></option>
                          <?php endforeach;endif;?>
                        </select>

                      <select name="per_ward" class="form-control select2" style="height: 30px;width:100px;">
                        <option value="">Ward *</option>
                       <?php if(!empty($wards)) :
                          foreach($wards as $key => $w) :?>
                          <option value="<?php echo $w->name?>"<?php if($detail->per_ward == $w->name){echo 'selected';}?>><?php echo  $w->name?></option>
                        <?php endforeach;endif;?>
                      </select>
                     <select style="width:150px;height: 30px" name="per_state" class="form-control select2">
                          <option value="">Province*</option>
                          <?php if(!empty($states)) : 
                            foreach ($states as $key => $state) :?>
                            <option value="<?php echo $state->id?>" <?php if($detail->per_state == $state->id){echo 'selected';}?>><?php echo $state->english_name?></option>
                          <?php endforeach; endif;?>
                        </select> Nepal.
                     </p>

                     <p>
                      <hr>
                       
                        As per her application and recommendation made by ward No.
                        <select name="rem_ward" class="form-control select2" style="height: 30px;width:100px;">
                        <option value="">Ward *</option>
                       <?php if(!empty($wards)) :
                          foreach($wards as $key => $w) :?>
                          <option value="<?php echo $w->name?>"><?php echo  $w->name?></option>
                        <?php endforeach;endif;?>
                      </select>
                        <?php echo SITE_OFFICE_ENG?> Office <?php echo SITE_DISTRICT_ENG?>, Nepal, the following members are the family members of the applicant as mentioned below:<br><hr>
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
                              <?php if(!empty($reldetail)): 
                                foreach($reldetail as $key => $rel): ?>
                              <tr>
                                <td>
                                  <input type="hidden" name = "rel_id[]" value="<?php echo $rel->id?>">
                                  <select name="rel_gender[]"  required="required" class="form-control">
                                    <option value=""> Select </option>
                                    <option value="Mr" <?php if($rel->gender == 'Mr'){echo 'selected';}?> >Mr</option>
                                    <option value="Mrs" <?php if($rel->gender == 'Mrs'){echo 'selected';}?>>Mrs</option>
                                  </select>
                                </td>
                                <td><input type="text" name="rel_name[]" class="form-control" value ="<?php echo $rel->name?>"></td>
                                <td>
                                  <select name="relation[]" required="required" class="form-control">
                                    <option value="">Select </option>
                                    <?php if(!empty($relation)) {
                                      foreach ($relation as $key => $rel) { ?>
                                       <option value="<?php echo $rel->english_name?>" <?php if($rel->relation == $relation->english_name){echo 'selected';}?>><?php echo $rel->english_name?></option>
                                     <?php  }
                                   } ?>
                                 </select>
                                </td>
                                <td><button type = "button" class="btn  btn-info btnAddNew"><i class="fa fa-plus"></i></button></td>
                              </tr>
                            <?php endforeach;endif?>
                            </tbody>
                          </table>
                        
                      </p>

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
    </section>
</div>
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
                           '<select name="rel_gender[]" required="required" class="form-control select2"><option value=""> Select </option><option value="Mr">Mr</option><option value="Mrs">Mrs</option></select></td>'+
                            '<td><input type="text" name="rel_name[]" class="form-control"></td>'+

                            '<td>'+
                            '<select name="relation[]" required="required" class="form-control rel"><option value="">Select </option><?php if(!empty($relation)) { foreach ($relation as $key => $rel) { ?><option value="<?php echo $rel->english_name?>"><?php echo $rel->english_name?></option><?php  }} ?></select></td>'+
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