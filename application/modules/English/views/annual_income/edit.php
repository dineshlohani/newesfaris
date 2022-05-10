

<?php
$this->load->helper('functions_helper');
if($this->uri->segment(2)== "edit")
{
  $action_page = "annual-income-en/update";
  $name = "नवीनतम डाटा";
}
if($this->uri->segment(2)=="edit")
{

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

  /*.select2-container--default .select2-selection--single{
    border:none;
    background: #7d6c6c08;
  }*/
  .select2 {
    font-family: Arial;
    border-top-style: hidden;
    border-right-style: hidden;
    border-left-style: hidden;
   /* border-bottom-style: 1px solid #7d6c6c08;
    background-color: #fff;*/
  /*border-top-style: hidden;
        border-right-style: hidden;
        border-left-style: hidden;
        border-bottom-style: dotted;
        background-color: #eee;*/
      }

     /* input 
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
      }*/
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
            <li class="breadcrumb-item ml-1"><a href="<?=  base_url()?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?=  base_url()?>annual-income-en">Annual Income Certificate</a></li>z
            <li class="breadcrumb-item active">Create</li>
          </ol>
        </nav>
      </div>

      <div class="container-fluid ">
        <div class="card">
          <div class="card-body">
            <?php echo form_open_multipart($action_page)?>
            <input type="hidden" name="id" value="<?php echo $detail->id?>">
              
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label"><span
                    class="float-right">Date(BS)<span
                    class="text-danger">&nbsp;*</span></span></label>
                    <div class="col-sm-8">
                      <input type="text" name="nepali_date" class="form-control" id="" value="<?=isset($result->nepali_date) ? $result->nepali_date : DateEngToNep(date('Y-m-d')) ?>" required readonly="true" />

                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-md-4 col-form-label">
                      <span class="float-right">
                       Date(AD)<span class="text-danger">&nbsp;*</span>
                     </span>
                   </label>
                   <div class="col-sm-8">
                    <input type="text" name="nepali_date" class="form-control" id="" value="<?=isset($result->eng_date) ? $result->eng_date: date('Y-m-d') ?>" required  readonly="true"/>
                  </div>
                </div>
              </div>
            </div>
            <hr>
           <div class="row">
              <div class="col-md-12 mb-3 pt-3">
                <h4 style="margin-left: 10px; border-bottom: 2px solid #333;" class="pb-2">
                 Applicant Details
                </h4>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group row">
                  <label class="col-md-2 col-form-label">
                    <span class="float-right">
                      Applicant Name<span class="text-danger">&nbsp;*</span>
                    </span>
                  </label>
                  <div class="col-sm-2">
                    <select name="gender" class="form-control" required="required">
                      <option value="1" <?php if($detail->gender == 1){echo 'selected';}?>>Mr</option>
                      <option value="2" <?php if($detail->gender == 2){echo 'selected';}?>>Mrs</option>
                    </select>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" name="applicant_name" placeholder="" value="<?php echo $detail->app_name?>" class="form-control" required="required" value="">
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group row">
                  <label class="col-md-2 col-form-label">
                    <span class="float-right">
                      Father Name<span class="text-danger">&nbsp;*</span>
                    </span>
                  </label>
                  <div class="col-sm-8">
                    <input type="text" name="father_name" placeholder=""  class="form-control" required="required" value="<?php echo $detail->father_name?>">
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group row">
                  <label class="col-md-2 col-form-label">
                    <span class="float-right">
                      Mother Name<span class="text-danger">&nbsp;*</span>
                    </span>
                  </label>
                  <div class="col-sm-8">
                    <input type="text" name="mother_name" placeholder=""  class="form-control" required="required"value="<?php echo $detail->mother_name?>">
                  </div>
                </div>
              </div>
            </div>
              
            <div class="row">
              <div class="col-md-12">
                <h4 style="margin-left: 10px; border-bottom: 2px solid #333;" class="pb-2">
                  Permant Address
                </h4>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label"><span
                    class="float-right">Province<span
                    class="text-danger">&nbsp;*</span></span></label>
                    <div class="col-sm-8">
                      <select name="per_state" class="form-control select2 state_selected_en" id="state_selected_en-1">
                        <option value="">--select--</option>
                        <?php if(!empty($states)) : 
                          foreach ($states as $key => $state) :?>
                            <option value="<?php echo $state->id?>" <?php if($detail->per_state == $state->id){ echo 'selected';}?>><?php echo $state->english_name?></option>
                          <?php endforeach; endif;?>
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
                  <div class="col-sm-8">
                    <select name="per_dis" class="form-control select2 district_selected_en" id="selected_district_en-1" required="required">
                      <option value="">--select</option>
                      <?php if(!empty($districts)) :
                        foreach($districts as $key => $district) :?>
                          <option value="<?php echo $district->id?>" <?php if($detail->per_district == $district->id){ echo 'selected';}?>><?php echo $district->english_name?></option>
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
                      class="float-right">Gapa/Napa<span
                      class="text-danger">&nbsp;*</span></span></label>
                      <div class="col-sm-8">
                        <select name="per_gapanapa" class="form-control select2 select_local_body" id="local_body_selected_en-1" required >
                          <option value="">--select--</option>
                          <?php if(!empty($locals)) :
                            foreach($locals as $key => $l) :?>
                            <option value="<?php echo $l->id?>" <?php if($detail->per_ganapa == $l->id){ echo 'selected';}?>><?php echo  $l->english_name?></option>
                          <?php endforeach;endif;?>
                        </select>
                    </div>
               </div>
             </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-form-label">
                    <span class="float-right">
                      Ward<span class="text-danger">&nbsp;*</span>
                    </span>
                  </label>
                  <div class="col-sm-8">
                    <select name="per_ward" class="form-control select2 " id="selected_ward-1">
                      <option value="">--select--</option>
                     <?php if(!empty($wards)) :
                        foreach($wards as $key => $w) :?>
                        <option value="<?php echo $w->name?>" <?php if($detail->per_ward == $w->id){ echo 'selected';}?>><?php echo  $w->name?></option>
                      <?php endforeach;endif;?>
                    </select>
                    </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <h4 style="margin-left: 10px; border-bottom: 2px solid #333;" class="pb-2">
                  Source of Income
                </h4>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <table class="table table-bordered" id="add_new_fields">
                  <thead>
                    <tr>
                     <?php 
                     $current = date('Y');
                     $first = date('Y', strtotime('-1 year'));
                     $secondYear = date('Y',strtotime('-2 year'));
                     $thirdYear = date('Y',strtotime('-3 year'));
                     ?>
                     <th>Income Source<span style="color:red">*</span></th>
                     <th>Annual Income of <br>Fiscal Year <br><?php echo $thirdYear.'/'.$secondYear?><span style="color:red">*</span></th>
                     <th>Annual Income of <br>Fiscal Year <br><?php echo $secondYear.'/'.$first?><span style="color:red">*</span></th>
                     <th>Annual Income of <br>Fiscal Year <br><?php echo $first.'/'.$current?> <span style="color:red">*</span></th>
                     <th></th>
                   </tr>
                 </thead>
                 <tbody>
                  <?php if(!empty($sources)) : 
                    foreach($sources as $key=> $source) :?>
                  <tr>
                    <input type="hidden" name="rel_id[]" value="<?php echo $source->id?>">
                    <td><textarea name="income_source[]" class="form-control" style="height:37px;"><?php echo $source->income_source?></textarea></td>
                    <td><input type="text" name="fy_i[]" class="form-control" value="<?php echo $source->fy_i?>"></td>
                    <td><input type="text" name="fy_ii[]" class="form-control" value="<?php echo $source->fy_ii?>"></td>
                    <td><input type="text" name="fy_iii[]" class="form-control" value="<?php echo $source->fy_iii?>"></td>
                    <td><a href="<?php echo base_url()?>English/AnnualIncome/removeData/<?php echo $source->main_id?>/<?php echo $source->id?>" class="btn  btn-danger"><i class="fa fa-minus" style="color:#FFF"></i></a></td>
                  </tr>
                <?php endforeach;endif;?>
                </tbody>
              </table>
              <button type= "button" class="btn btn-info btnAddNew pull-right"><i class="fa fa-plus"></i> Add New Income Source</button>
            </div>
          </div>
            <hr class="mt-5 mb-4">
            <div class="form-group row">
              <div class="col-sm-6 offset-sm-6 mt-4">
                <button type="submit" class='btn btn-block btn-submit btn-primary' name="submit">पेश गर्नुहोस्</button>
              </div>
            </div>
            <?php echo form_close();?>
          </div>
        </div>
      </div>
    </section>
  </div>
  <script src="<?=base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>
  <script src="<?=base_url()?>assets/bower_components/select2/dist/js/select2.min.js"></script>
  <script src="<?=base_url()?>assets/bower_components/select2/dist/js/select2.min.js"></script>
  <script>
    $(document).ready(function(){
      $('.btnAddNew').click(function(e) {
        e.preventDefault();
        var trOneNew = $('.nagadi_rasid_frm').length+1;
        var new_row =  '<tr class="nagadi_rasid_frm">'+
        '<td><textarea name="income_source_new[]" class="form-control" style="height:37px;"></textarea></td>'+
        '<td><input type="text" name="fy_i_new[]" class="form-control"></td>'+
        '<td><input type="text" name="fy_ii_new[]" class="form-control"></td>'+
        '<td><input type="text" name="fy_iii_new[]" class="form-control"></td>'+
        '<td><button type ="button" class="btn  btn-danger remove-row"><i class="fa fa-minus"></i></button></td>'+
        '</tr>';
        $("#add_new_fields").append(new_row);
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