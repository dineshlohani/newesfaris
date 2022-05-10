

<?php
$this->load->helper('functions_helper');
if($this->uri->segment(2)== "edit")
{
  $action_page = "address-verification-en/update";
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
            <li class="breadcrumb-item"><a href="<?=  base_url()?>address-verification-en"> Address Verification</a></li>
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
              <div class="col-md-12 mb-3 pt-3">
                <h4 style="margin-left: 10px; border-bottom: 2px solid #333;" class="pb-2">
                  Address Verification
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
                  <div class="col-sm-8">
                    <input type="text" name="applicant_name" placeholder=""  class="form-control" required="required" value="<?php echo $detail->app_name?>">
                  </div>
                </div>
              </div>
            </div>
              <hr>
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
                        <select name="per_state" class="form-control select2">
                          <option value="">--select--</option>
                          <?php if(!empty($states)) : 
                            foreach ($states as $key => $state) :?>
                              <option value="<?php echo $state->id?>" <?php if($state->id == $detail->per_state){echo 'selected';}?>><?php echo $state->english_name?></option>
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
                      <select name="per_dis" class="form-control select2" required="required">
                        <option value="">--select</option>
                        <?php if(!empty($districts)) :
                          foreach($districts as $key => $district) :?>
                            <option value="<?php echo $district->id?>" <?php if($district->id == $detail->per_dis){echo 'selected';}?>><?php echo $district->english_name?></option>
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
                          <select name="per_gapanapa" class="form-control select2 " id="state_selected-1" required >
                            <option value="">--select--</option>
                            <?php if(!empty($locals)) :
                              foreach($locals as $key => $l) :?>
                              <option value="<?php echo $l->id?>" <?php if($l->id == $detail->per_ganapa){echo 'selected';}?>><?php echo  $l->english_name?></option>
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
                      <select name="per_ward" class="form-control select2">
                        <option value="">--select--</option>
                       <?php if(!empty($wards)) :
                          foreach($wards as $key => $w) :?>
                          <option value="<?php echo $w->name?>" <?php if($w->name == $detail->per_ward){echo 'selected';}?>><?php echo  $w->name?></option>
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
                        class="float-right">Old Gapa Name<span
                        class="text-danger">&nbsp;*</span></span></label>
                        <div class="col-sm-8">
                         <input type="text" name="old_name" class="form-control" value="<?php echo $detail->old_name?>">
                      </div>
                 </div>
               </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-md-4 col-form-label">
                      <span class="float-right">
                        Old Ward<span class="text-danger">&nbsp;*</span>
                      </span>
                    </label>
                    <div class="col-sm-8">
                      <select name="old_ward" class="form-control select2">
                        <option value="">--select--</option>
                       <?php if(!empty($wards)) :
                          foreach($wards as $key => $w) :?>
                          <option value="<?php echo $w->name?>" <?php if($w->name == $detail->old_ward){echo 'selected';}?>><?php echo  $w->name?></option>
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
  </div>
  <script src="<?=base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>
  <script src="<?=base_url()?>assets/bower_components/select2/dist/js/select2.min.js"></script>
