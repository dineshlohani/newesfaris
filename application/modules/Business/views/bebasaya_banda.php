<?php
    if($this->uri->segment(2)== "create")
    {
    $action_page = "bebasaya-banda/create";
    }
    if($this->uri->segment(2)=="edit")
    {
    $action_page = "bebasaya-banda/edit/".$this->uri->segment(3);
    }
    if(!empty($result->documents))
    {
        $documents      = explode("+",$result->documents);

    }
    $path           = base_url()."assets/documents/business/bebasaya_banda/";
?>
<section class="content ">

       <div class="container-fluid">
           <div class="row">
               <div class="col-12">
                   <?php if(!empty($this->session->flashdata('msg'))): ?>
                       <div  class="alert alert-success alert-dismissible" >    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span><?=$this->session->flashdata('msg');?></span></div>
                   <?php endif; ?>
                   <?php if(!empty($this->session->flashdata('err_msg'))): ?>
                       <div  class="alert alert-danger alert-dismissible" >    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span><?=$this->session->flashdata('err_msg');?></span></div>
                   <?php endif; ?>
               </div>
           </div>
       </div>
           <div class="container-fluid ">
               <nav aria-label="breadcrumb" class="bg-shadow">
                   <ol class="breadcrumb px-3 py-2">
                       <li class="breadcrumb-item ml-1"><a href="/">गृह</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url()?>bebasaya-banda"> व्यवसाय बन्द बारे </a></li>
                       <li class="breadcrumb-item active">नयाँ</li>

                   </ol>
               </nav>
           </div>
   <div class="container-fluid">
       <div class="card">
           <div class="card-body">
               <div class="row">
                   <div class="col-lg-12">
                   </div>
               </div>
              <?php echo form_open_multipart($action_page); ?>
                   <div class="row">
                       <div class="col-md-6 offset-md-6">
                           <div class="form-group row">
                               <label class="col-sm-4 col-form-label"><span
                                       class="float-right">आवेदन गरिएको मिति<span
                                       class="text-danger">&nbsp;*</span></span></label>
                                   <div class="col-sm-8">
                                       <div class="input-group">
                                           <input type="text" name="nepali_date" maxlength="10" class="form-control" required id="nepaliDate4" value="<?= isset($result) ? $result->nepali_date : DateEngToNep(date('Y-m-d'))?>"/>
                                       </div>
                                   </div>
                           </div>
                        </div>
                   </div>
                   <div class="row">
                       <div class="col-md-12 mb-3">
                           <h4>
                               व्यवसाय / फार्मको विवरण
                           </h4>
                           <hr style="border: 1px solid #adadad">
                       </div>
                       <div class="col-md-12">
                           <div class="row">
                               <div class="col-md-4">
                                   <div class="form-group row">
                                       <label class="col-md-4 col-form-label">
                                           <span class="float-right">
                                               व्यवसायको नाम <span class="text-danger">&nbsp;*</span>
                                           </span>
                                       </label>
                                           <div class="col-sm-6">
                                               <input type="text" name="org_name" maxlength="120" class="form-control" required id="id_org_name" value="<?= isset($result) ? $result->org_name : ''?>"/>
                                           </div>
                                   </div>
                               </div>
                               <div class="col-md-8">
                                <div class="row">
                                  <div class="col-ms-4" style="margin-right: 24px">
                                                <select name="gender_spec" class="form-control" id="gender_spec" required>
                                                    <option selected>---Select---</option>
                                                    <option value="श्री" >श्री</option>
                                                    <option value="सुश्री" >सुश्री</option>                        
                                                    <option value="श्रीमती" >श्रीमती</option>
                                                </select>
                                    </div>
                                    <div class="col-md-4">
                                   <div class="form-group row" style="margin-right: -295px">
                                       <label class="col-md-2 col-form-label">
                                           <span class="float-right">
                                               व्यवसायीको नाम <span class="text-danger">&nbsp;*
                                               </span>
                                           </span>
                                       </label>
                                           <div class="col-sm-10">
                                               <input type="text" name="owner_name" maxlength="120" class="form-control" required id="id_owner_name" value="<?= isset($result) ? $result->owner_name : ''?>"/>
                                           </div>
                                   </div>
                                 </div>
                               </div>
                           </div>
                       </div>
                       <div class="col-md-12">
                           <div class="row">
                               <div class="col-md-6">
                                   <div class="form-group row">
                                       <label class="col-md-4 col-form-label">
                                           <span class="float-right">
                                               दर्ता नं. <span class="text-danger">&nbsp;*</span>
                                           </span>
                                       </label>
                                           <div class="col-sm-8">
                                               <input type="text" name="darta_no" maxlength="16" class="form-control" required id="id_darta_no" value="<?= isset($result) ? $result->darta_no : ''?>"/>
                                           </div>
                                   </div>
                               </div>
                               <div class="col-md-6">
                                   <div class="form-group row">
                                       <label class="col-md-4 col-form-label">
                                           <span class="float-right">
                                               नागरिकता नं. <span class="text-danger">&nbsp;*</span>
                                           </span>
                                       </label>
                                           <div class="col-sm-8">
                                               <input type="text" name="cit_no" maxlength="16" class="form-control" required id="cit_no" value="<?= isset($result) ? $result->cit_no : ''?>"/>
                                           </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="col-md-12">
                           <div class="row">
                               <div class="col-md-6">
                                   <div class="form-group row">
                                       <label class="col-md-4 col-form-label">
                                           <span class="float-right">
                                               व्यवसायको प्रकार <span
                                                   class="text-danger">&nbsp;*</span>
                                           </span>
                                       </label>
                                           <div class="col-sm-8">
                                               <input type="text" name="org_type" maxlength="120" class="form-control" required id="id_org_type" value="<?= isset($result) ? $result->org_type : ''?>" />
                                           </div>
                                   </div>
                               </div>
                               <div class="col-md-6">
                                   <div class="form-group row">
                                       <label class="col-md-4 col-form-label">
                                           <span class="float-right">
                                               व्यवसायको प्रकृति <span
                                                   class="text-danger">&nbsp;*</span>
                                           </span>
                                       </label>
                                           <div class="col-sm-8">
                                               <input type="text" name="org_size" maxlength="32" class="form-control" required id="id_org_size" value="<?= isset($result) ? $result->org_size : ''?>" />
                                           </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="col-md-12">
                           <div class="form-group row">
                               <label class="col-md-2 col-form-label">
                                           <span class="float-right">
                                               ठेगाना<span class="text-danger">&nbsp;*</span>
                                           </span>
                               </label>
                                   <div class="col-md-2 mb-sm-2">
                                       <select name="org_state" class="form-control state select2 state_selected" required id="state_selected-1">
                                             <option value="">प्रदेश</option>
                                         <?php foreach($states as $state): ?>
                                             <option value="<?= $state->id ?>"
                                                 <?php
                                                    if(isset($result) && $result->org_state == $state->id)
                                                    {
                                                        echo 'selected= "selected"';
                                                    }
                                                    elseif($state->id==$default[0])
                                                    {
                                                        echo 'selected="selected"';
                                                    }
                                                 ?>
                                             ><?= $state->name ?></option>
                                         <?php endforeach;?>
                                        </select>
                                   </div>
                                   <div class="col-md-3 mb-sm-2">
                                       <select name="org_district" class="form-control district select2 district_selected" required id="district_selected-1">
                                           <option value="" >जिल्ला</option>
                                        <?php  foreach($districts as $district): ?>
                                           <option value="<?= $district->id ?>"
                                               <?php
                                                  if(isset($result) && $result->org_district == $district->id)
                                                  {
                                                      echo 'selected= "selected"';
                                                  }
                                                  elseif($district->name==$default[1])
                                                      {
                                                          echo 'selected="selected"';
                                                      }
                                               ?>
                                           ><?= $district->name ?></option>
                                        <?php endforeach;?>
                                        </select>
                                   </div>
                                   <div class="col-md-3 mb-sm-2">
                                       <select name="org_local_body" class="form-control local-body select2 local_body_selected" required id="local_body_selected-1">
                                           <option value="">गा.पा/न.पा </option>
                                           <?php foreach($locals as $local): ?>
                                               <option value="<?=$local->id?>"
                                                   <?php
                                                      if(isset($result) && $result->org_local_body == $local->id)
                                                      {
                                                          echo 'selected= "selected"';
                                                      }
                                                      elseif($local->name==$default[2])
                                                          {
                                                              echo 'selected="selected"';
                                                          }
                                                   ?>
                                               ><?= $local->name ?></option>
                                           <?php endforeach;?>
                                       </select>
                                   </div>
                                   <div class="col-md-2 mb-sm-2">
                                       <select name="org_ward" class="form-control ward-no select2 ward_selected" required id="ward_selected-1">
                                             <option value="" selected>वडा नं</option>
                                         <?php foreach($wards as $ward) : ?>
                                             <option value="<?= $ward->id ?>"
                                                 <?php
                                                    if(isset($result) && $result->org_ward == $ward->id)
                                                    {
                                                        echo 'selected= "selected"';
                                                    }
                                                    elseif($ward->id==$default[3])
                                                    {
                                                            echo 'selected="selected"';
                                                    }
                                                 ?>
                                             ><?= $ward->name ?></option>
                                         <?php endforeach;?>
                                        </select>
                                   </div>
                           </div>
                       </div>
                       <div class="col-md-12">
                           <div class="row">
                               <div class="col-md-6">
                                   <div class="form-group row">
                                       <label class="col-md-4 col-form-label">
                                           <span class="float-right">
                                               साबिक ठेगाना <span class="text-danger">&nbsp;*</span>
                                           </span>
                                       </label>
                                           <div class="col-sm-8">
                                               <select name="old_new_address" class="form-control " required id="id_old_new_address">
                                                   <option value="">छान्नुहोस्</option>
                                                 <?php foreach($addresses as $address) : ?>
                                                     <option value="<?= $address->id ?>"
                                                         <?php
                                                            if(isset($result) && $result->old_new_address == $address->id)
                                                            {
                                                                echo 'selected= "selected"';
                                                            }
                                                         ?>
                                                     ><?= $address->name?></option>
                                                 <?php endforeach;?>

                                                </select>
                                           </div>
                                   </div>
                               </div>
                               <div class="col-6">
                                   <div class="form-group row">
                                       <label class="col-md-4 col-form-label">
                                           <span class="float-right">
                                               हालको ठेगाना <span class="text-danger">&nbsp; *</span>
                                           </span>
                                       </label>

                                           <div class="col-sm-8">
                                               <input type="text" name="new_place" class="form-control" required id="id_new_place" value="<?= isset($result) ? $result->new_place : ''?>" />
                                           </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="col-md-12">
                           <div class="row">
                               <div class="col-md-6">
                                   <div class="form-group row">
                                       <label class="col-md-4 col-form-label">
                                           <span class="float-right">
                                               टोलको नाम <span
                                                   class="text-danger">&nbsp;*</span>
                                           </span>
                                       </label>
                                           <div class="col-sm-8">
                                               <input type="text" name="tole" maxlength="128" class="form-control" required id="id_tole"  value="<?= isset($result) ? $result->tole : ''?>"/>
                                           </div>
                                   </div>
                               </div>
                               <div class="col-md-6">
                                   <div class="form-group row">
                                       <label class="col-md-4 col-form-label">
                                           <span class="float-right">
                                               बाटोको नाम <span
                                                   class="text-danger">&nbsp;*</span>
                                           </span>
                                       </label>
                                           <div class="col-sm-8">
                                               <input type="text" name="road_name" maxlength="128" class="form-control" required id="id_road_name" value="<?= isset($result) ? $result->road_name : ''?>" />
                                           </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="col-md-12">
                           <div class="row">
                               <div class="col-md-6">
                                   <div class="form-group row">
                                       <label class="col-md-4 col-form-label">
                                           <span class="float-right">
                                               घर नं <span
                                                   class="text-danger">&nbsp;&nbsp;</span>
                                           </span>
                                       </label>
                                           <div class="col-sm-8">
                                               <input type="text" name="home_no" maxlength="16" class="form-control" required id="id_home_no"  value="<?= isset($result) ? $result->home_no : ''?>"/>
                                           </div>
                                   </div>
                               </div>
                               <div class="col-md-6">
                                   <div class="form-group row">
                                       <label class="col-md-4 col-form-label">
                                           <span class="float-right">
                                               सम्पर्क नं <span
                                                   class="text-danger">&nbsp;&nbsp;</span>
                                           </span>
                                       </label>
                                           <div class="col-sm-8">
                                               <input type="text" name="con_no" maxlength="16" class="form-control" required id="con_no"  value="<?= isset($result) ? $result->con_no : ''?>"/>
                                           </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="col-md-12">
                           <div class="row">
                               <div class="col-md-6 ">
                                   <div class="form-group row">
                                       <label class="col-sm-4 col-form-label"><span
                                               class="float-right">व्यवसाय बन्द गरिएको <br>मिति<span
                                               class="text-danger">&nbsp;*</span></span></label>
                                           <div class="col-sm-8">
                                               <div class="input-group">
                                                   <input type="text" name="nepali_closed_date" maxlength="10" class="form-control" required id="nepaliDate5" value="<?= isset($result) ? $result->nepali_closed_date : ''?>" />
                                                </div>
                                           </div>
                                   </div>
                               </div>
                               <div class="col-md-6 ">
                                   <div class="form-group row">
                                       <label class="col-sm-4 col-form-label"><span
                                               class="float-right">सर्जमिन गरेको मिति<span
                                               class="text-danger">&nbsp;*</span></span></label>
                                           <div class="col-sm-8">
                                               <div class="input-group">
                                                   <input type="text" name="nepali_observed_date" maxlength="10" class="form-control" required id="nepaliDate6" value="<?= isset($result) ? $result->nepali_observed_date : ''?>"/>
                                               </div>
                                           </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
                   <hr class="mt-5 mb-4" style="border: 1px solid #adadad">
                   <div class="row">
                       <div class="col-lg-10">
                            <div class="row">
                               <div class="col-sm-3 text-right">
                                   <label>कागजातहरू <span class="text-danger">*</span> </label>
                               </div>
                               <div class="col-sm-9">
                                   <div class="mb-3 documents" id="doc_div_0">
                                       <input type="file" name="documents[]" id="documents_0" />
                                       <select name="documents_type[]" id="documents_type_0">
                                           <option value="">प्रकार छान्नुहोस्</option>
                                           <?php foreach($documents as $doc):?>
                                               <option value="<?= $doc->id ?>"><?= $doc->name?></option>
                                           <?php endforeach;?>
                                       </select>
                                       <button type="button"
                                               class="float-right btn btn-danger delete-form doc_remove"
                                               id="documents_remove_0"><i
                                               class="fa fa-times"></i></button>
                                   </div>
                                   <div id="document_div"></div>
                                           <!-- This button will add a new form when clicked -->
                                   <button type="button" class="btn btn-success" data-formset-add><i
                                           id ="documents" class="fa fa-plus"></i></button>
                                           <?php
                                               if(isset($result) && !empty($result->documents))
                                               {

                                                   echo "<br/><br/><div style='border-style: groove;'><h6>कागजातहरु</h6>";
                                                   foreach($documents as $doc)
                                                   {
                                                       echo "<a href='".$path.$doc."' target='_blank'>".$doc."</a><br/>";
                                                   }
                                                   echo " </div>";
                                               }
                                           ?>
                               </div>
                            </div>
                       </div>
                   </div><hr class="mt-5 mb-4">
                   <div class="form-group row">
                       <div class="col-lg-6 offset-lg-6">
                           <div class="row">
                       <span class="col-sm-9 offset-sm-3">
                         <button type="submit" class='btn btn-submit btn-block btn-primary'
                                 name="submit">पेश गर्नुहोस्</button>
                       </span>
                           </div>
                       </div>
                   </div>
               </form>
           </div>
       </div>
   </div>
   </section>
</div>
<script src="<?=base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<script>
    var JQ = jQuery.noConflict();
    JQ(document).ready(function() {
        JQ(document).on("click", "#documents", function (){
            var  count = JQ(".documents").length;
            param = {};
            param.count = count;
            param.patra_id = <?= $patra_id?>;
            JQ.ajax({
                url: "<?= base_url()?>getRoadDocumentHTML",
                method: "POST",
                data: param,
                success: function (data) {
                    var obj = JSON.parse(data);
                    JQ("#document_div").append(obj.html);
                },
                error: function (error) {
                    console.log(JSON.stringify(error));
                }
            });
        });
        JQ(document).on("click", ".doc_remove", function () {
            var id_selected     = JQ(this).attr("id");
            var res             = id_selected.split("_");
            var id              = res[res.length - 1];
            JQ("#doc_div_"+id).remove();
        });

            JQ(document).on("change", "#id_old_new_address", function (){
                var  value = JQ(this).val();
                param = {};
                param.id = value;
                JQ.ajax({
                    url: "<?= base_url()?>getNewAddress",
                    method: "POST",
                    data: param,
                    success: function (data) {
                        var obj = JSON.parse(data);
                        JQ("#id_new_place").val(obj.new_place);
                    },
                    error: function (error) {
                        console.log(JSON.stringify(error));
                    }
                });
            });
    });
</script>
