<?php
if($this->uri->segment(2)== "create")
{
  $action_page = "bebasaya-sifaris/create";
}
if($this->uri->segment(2)=="edit")
{
  $action_page = "bebasaya-sifaris/edit/".$this->uri->segment(3);
}
if(!empty($result->documents))
{
  $documents      = explode("+",$result->documents);

}
$path           = base_url()."assets/documents/business/bebasaya_darta/";
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
       <li class="breadcrumb-item"><a href="<?= base_url()?>/bebasaya-darta"> व्यवसाय दर्ता सिफारिस</a></li>


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
                   <input type="text" name="nepali_date" maxlength="10" class="form-control" required id="nepaliDate4" value="<?= isset($result) ? $result->nepali_date : DateEngToNep(date('Y-m-d'))?>" />
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
               <div class="col-md-8">
                 <div class="form-group row">
                   <label class="col-md-4 col-form-label">
                     <span class="float-right">
                       <strong>व्यवसायको नाम </strong><span
                       class="text-danger">&nbsp;*</span>
                     </span>
                   </label>
                   <div class="col-sm-8">
                     <input type="text" name="org_name" class="form-control" required id="id_org_name" value="<?= isset($result) ? $result->org_name : ''?>" />
                   </div>
                 </div>
               </div>
             </div>
           </div>
           <div class="col-md-12">
             <div class="form-group row">
               <label class="col-md-2 col-form-label">
                 <span class="float-right">
                   <strong>व्यवसायको ठेगाना</strong><span class="text-danger">&nbsp;*</span>
                 </span>

               </label>

               <div class="col-md-2 mb-sm-2">
                 <select name="org_state" class="form-control state select2 state_selected" required id="state_selected-1">
                   <option value="">प्रदेश</option>
                   <?php foreach($states as $state):?>
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
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-md-3 mb-sm-2">
                 <select name="org_district" class="form-control district select2 district_selected" required id="district_selected-1">
                   <option value="">जिल्ला</option>
                   <?php foreach ($districts as $district): ?>
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
                   <?php endforeach; ?>
                 </select>
               </div>
               <div class="col-md-3 mb-sm-2">
                 <select name="org_local_body" class="form-control local-body select2 local_body_selected" required id="local_body_selected-1">
                   <option value="">गा.पा/न.पा </option>
                   <?php foreach($locals as $local) : ?>
                     <option value="<?= $local->id?>"
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
                   <?php foreach($wards as $ward): ?>
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
                      > <?= $ward->name?></option>
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
                       <strong>सडकको नाम</strong><span class="text-danger">&nbsp;*</span>
                     </span>
                   </label>
                   <div class="col-sm-8">
                     <input type="text" name="org_road_name" class="form-control" id="id_org_road_name" value="<?= isset($result) ? $result->org_road_name : ''?>" required/>
                   </div>
                 </div>
               </div>
               <div class="col-md-2">
                 <div class="form-group row">
                   <label class="col-md-4 col-form-label">
                     <span class="float-right">
                       <strong>घर नं</strong><span class="text-danger"></span>
                     </span>

                   </label>
                   <div class="col-sm-8">
                     <input type="text" name="org_home_no" maxlength="12" class="form-control" id="id_org_home_no" value="<?= isset($result) ? $result->org_home_no : ''?>" />
                   </div>
                 </div>
               </div>
               <div class="col-md-4">
                 <div class="form-group row">
                   <label class="col-md-4 col-form-label">
                     <span class="float-right">
                       <strong>फोन नं</strong><span class="text-danger">&nbsp;*</span>
                     </span>

                   </label>
                   <div class="col-sm-8">
                     <input type="text" name="org_phone" class="form-control" required id="id_org_phone" value="<?= isset($result) ? $result->org_phone : ''?>" />
                   </div>
                 </div>
               </div>
             </div>
           </div>
           <div class="col-md-12">
             <div class="row">
               <div class="col-md-4">
                 <div class="form-group row">
                   <label class="col-md-4 col-form-label">
                     <span class="float-right">
                       <strong>किसिम</strong><span class="text-danger">&nbsp;*</span>
                     </span>
                   </label>
                   <div class="col-sm-8">
                     <input type="text" name="org_type"  class="form-control" id="id_org_type" value="<?= isset($result) ? $result->org_type : ''?>" required />
                   </div>
                 </div>
               </div>
               <div class="col-md-4">
                 <div class="form-group row">
                   <label class="col-md-4 col-form-label">
                     <span class="float-right">
                       <strong>संचालन मिति</strong><span class="text-danger">&nbsp;*</span>
                     </span>

                   </label>
                   <div class="col-sm-8">
                     <div class="input-group">
                       <input type="text" name="org_establish_nep_date" class="form-control" required id="nepaliDate5" value="<?= isset($result) ? $result->org_establish_nep_date : ''?>" />
                     </div>
                   </div>
                 </div>
               </div>
               <div class="col-md-4">
                 <div class="form-group row">
                   <label class="col-md-4 col-form-label">
                     <span class="float-right">
                       <strong>कुल पुँजी रु.</strong><span class="text-danger">&nbsp;*</span>
                     </span>

                   </label>
                   <div class="col-sm-8">
                     <input type="number" name="org_punji"  class="form-control" required id="id_org_punji" value="<?= isset($result) ? $result->org_punji : ''?>" />
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
                       <strong>स्वामित्व</strong><span class="text-danger">&nbsp;*</span>
                     </span>
                   </label>
                   <div class="col-sm-8">
                     <input type="text" name="org_ownership" class="form-control" id="id_org_ownership" value="<?= isset($result) ? $result->org_ownership : ''?>" required/>
                   </div>
                 </div>
               </div>
             </div>
           </div>
           <div class="col-md-12">
             <div class="row">
               <div class="col-md-4">
                 <div class="form-group row">
                   <label class="col-md-4 col-form-label">
                     <span class="float-right">
                       <strong>घरधनिको नाम</strong><span class="text-danger">&nbsp;*</span>
                     </span>

                   </label>
                   <div class="col-sm-8">
                     <input type="text" name="home_owner" class="form-control" required id="id_home_owner" value="<?= isset($result) ? $result->home_owner : ''?>" />
                   </div>
                 </div>
               </div>
               <div class="col-md-4">
                 <div class="form-group row">
                   <label class="col-md-4 col-form-label">
                     <span class="float-right">
                       <strong>घरधनिको फोन नं.</strong><span class="text-danger">&nbsp;*</span>
                     </span>

                   </label>
                   <div class="col-sm-8">
                     <input type="text" name="home_owner_phone" class="form-control" required id="id_home_owner_phone" value="<?= isset($result) ? $result->home_owner_phone : ''?>" />
                   </div>
                 </div>
               </div>
               <div class="col-md-4">
                 <div class="form-group row">
                   <label class="col-md-4 col-form-label">
                     <span class="float-right">
                       <strong>मासिक भाडा रकम रु.</strong><span class="text-danger"></span>
                     </span>

                   </label>
                   <div class="col-sm-8">
                     <input type="number" name="home_fare" class="form-control" id="id_home_fare" value="<?= isset($result) ? $result->home_fare : ''?>" />
                   </div>
                 </div>
               </div>
             </div>
           </div>
           <div class="col-md-12">
             <div class="row">
               <div class="col-md-4">
                 <div class="form-group row">
                   <label class="col-md-4 col-form-label">
                     <span class="float-right">
                       <strong>कित्ता नं</strong><span class="text-danger">&nbsp;*</span>
                     </span>
                   </label>
                   <div class="col-sm-8">
                     <input type="text" name="kitta_no" class="form-control" required id="id_kitta_no" value="<?= isset($result) ? $result->kitta_no : ''?>" />
                   </div>
                 </div>
               </div>
             </div>
           </div>
           <div class="col-md-12 mt-3 mb-3">
             <div class="text-center">
               <label for="terai" style="font-size:17px"><b>तराई</b></label>
               <input type="radio" name="land_type" value="terai" <?= (isset($result) && $result->land_type =="terai") ? 'checked' : 'checked'; ?>>
               <label for="hill" style="font-size:17px"><b>पहाड</b></label>
               <input type="radio" name="land_type" id="hill" value="hill" <?= (isset($result) && $result->land_type =="hill") ? 'checked' : ''; ?>>
             </div>

           </div>
           <div class="col-md-12">
             <div class="form-group row">
               <label class="col-md-2 col-form-label">
                 <span class="float-right">
                   क्षेत्रफल<span class="text-danger">&nbsp;*</span>
                 </span>
               </label>
               <div class="col-10">
                 <div class="input-group mb-3">
                   <input type="number" name="biggha"  class="form-control" required  id="id_biggha" value="<?= isset($result) ? $result->biggha : 0?>"/>
                   <div class="input-group-append ">
                     <span class="input-group-text" id="biggha_span"><?= (isset($result)&&$result->land_type=="hill") ? 'रोपनी' : 'बिग्घा' ?></span>
                   </div>
                   <input type="number" name="kattha"  class="form-control" required  id="id_kattha" value="<?= isset($result) ? $result->kattha : 0?>"/>
                   <div class="input-group-append ">
                     <span class="input-group-text" id="kattha_span"><?= (isset($result)&&$result->land_type=="hill") ? 'आना' : 'कट्ठा' ?></span>
                   </div>
                   <input type="text" name="dhur" class="form-control" required  id="id_dhur" value="<?= isset($result) ? $result->dhur : 0?>"/>
                   <div class="input-group-append ">
                     <span class="input-group-text" id="dhur_span"><?= (isset($result)&&$result->land_type=="hill") ? 'दाम' : 'धुर' ?></span>
                   </div>
                   <input type="number" name="paisa" class="paisa_div form-control "  id="id_paisa" value="<?= isset($result) ? $result->paisa : 0?>" <?= (isset($result)&&$result->land_type=="hill") ? '' :'style="display: none";'?>/>
                   <div class="paisa_div input-group-append " <?= (isset($result) && $result->land_type=="hill") ? '' : 'style="display: none";'?>>
                     <span class="input-group-text" id="paisa_dhur">पैसा</span>
                   </div>
                 </div>
               </div>
             </div>
           </div>
           <div class="col-md-12 mb-3">
             <h4>
               मुख्य संचालक व्यक्तिको विवरण
             </h4>
             <hr style="border: 1px solid #adadad">
           </div>
           <div class="col-md-12">
             <div class="row">
               <div class="col-md-6">
                 <div class="form-group row">
                   <label class="col-md-4 col-form-label">
                     <span class="float-right">
                       <strong>नाम</strong><span class="text-danger">&nbsp;*</span>
                     </span>
                   </label>
                   <div class="col-sm-8">
                     <input type="text" name="prop_name" class="form-control" id="id_prop_name" value="<?= isset($result) ? $result->prop_name : ''?>" required/>
                   </div>
                 </div>
               </div>
               <div class="col-md-6">
                 <div class="form-group row">
                   <label class="col-md-4 col-form-label">
                     <span class="float-right">
                       <strong>फोन नं.</strong><span class="text-danger">&nbsp;*</span>
                     </span>
                   </label>
                   <div class="col-sm-8">
                     <input type="text" name="prop_phone" class="form-control" id="id_prop_phone" value="<?= isset($result) ? $result->prop_phone : ''?>" required />
                   </div>
                 </div>
               </div>
             </div>
           </div>
           <div class="col-md-12">
             <div class="form-group row">
               <label class="col-md-2 col-form-label">
                 <span class="float-right">
                   <strong>ठेगाना</strong><span class="text-danger">&nbsp;*</span>
                 </span>
               </label>
               <div class="col-md-2 mb-sm-2">
                 <select name="prop_state" class="form-control state select2 state_selected" required id="state_selected-2">
                   <option value="">प्रदेश</option>
                   <?php foreach($states as $state):?>
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
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-md-3 mb-sm-2">
                 <select name="prop_district" class="form-control district select2 district_selected" required id="district_selected-2">
                   <option value="">जिल्ला</option>
                   <?php foreach ($districts as $district): ?>
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
                   <?php endforeach; ?>
                 </select>
               </div>
               <div class="col-md-3 mb-sm-2">
                 <select name="prop_local_body" class="form-control local-body select2 local_body_selected" required id="local_body_selected-2">
                   <option value="">गा.पा/न.पा </option>
                   <?php foreach($locals as $local) : ?>
                     <option value="<?= $local->id?>"
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
                 <select name="prop_ward" class="form-control ward-no select2 ward_selected" required id="ward_selected-2">
                   <option value="" selected>वडा नं</option>
                   <?php foreach($wards as $ward): ?>
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
                      > <?= $ward->name?></option>
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
                       <strong>सडकको नाम</strong><span class="text-danger">&nbsp;*</span>
                     </span>
                   </label>
                   <div class="col-sm-8">
                     <input type="text" name="prop_road_name" class="form-control" id="id_prop_road_name" value="<?= isset($result) ? $result->prop_road_name : ''?>"  required/>
                   </div>
                 </div>
               </div>
               <div class="col-md-6">
                 <div class="form-group row">
                   <label class="col-md-4 col-form-label">
                     <span class="float-right">
                       <strong>घर नं.</strong><span class="text-danger"></span>
                     </span>
                   </label>
                   <div class="col-sm-8">
                     <input type="number" name="prop_home_no" class="form-control" id="id_prop_home_no" value="<?= isset($result) ? $result->prop_home_no : ''?>" />
                   </div>
                 </div>
               </div>
             </div>
           </div>
           <div class="col-md-12 mb-3">
             <h4>
               निवेदकको विवरण
             </h4>
             <hr style="border: 1px solid #adadad">
           </div>
            <div class="col-md-12">
            <div  class="row">
              <div class="col-md-4">
                <select name="gender_spec" class="form-control" id="gender_spec" required>
                          <option selected>---Select---</option>
                          <option value="श्री" >श्री</option>
                          <option value="सुश्री" >सुश्री</option>                        
                          <option value="श्रीमती" >श्रीमती</option>
                </select>
              </div>
              <div class="col-md-4">
                <div class="form-group row">
                   <label class="col-md-4 col-form-label">
                     <span class="float-right">
                       <strong>नाम</strong><span class="text-danger">&nbsp;*
                      </span>
                    </span>
                  </label>
                  <div class="col-sm-8">
                   <input type="text" name="applicant_name" class="form-control" required id="id_applicant_name" value="<?= isset($result) ? $result->applicant_name : ''?>" />
                 </div>
               </div>
              </div>
              <div class="col-md-4">
                <div class="form-group row">
                 <label class="col-md-4 col-form-label">
                   <span class="float-right">
                     <strong>फोन नं</strong><span class="text-danger">&nbsp;*</span>
                   </span>
                 </label>
                 <div class="col-sm-8">
                   <input type="text" name="applicant_phone" class="form-control" required id="id_applicant_phone" value="<?= isset($result) ? $result->applicant_phone : ''?>" />
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
                     <strong>नागरिकता नं</strong><span class="text-danger">&nbsp;*</span>
                   </span>
                 </label>
                 <div class="col-sm-8">
                   <input type="text" name="cit_no" class="form-control" required id="cit_no" value="<?= isset($result) ? $result->cit_no : ''?>" />
                 </div>
               </div>
             </div>

             <div class="col-ms-6">
               <div class="form-group row">
                 <label class="col-md-4 col-form-label">
                   <span class="float-right">
                     <strong>ठेगाना</strong><span class="text-danger">&nbsp;*</span>
                   </span>
                 </label>
                 <div class="col-sm-8">
                   <input type="text" name="applicant_address" class="form-control" required id="id_applicant_address" value="<?= isset($result) ? $result->applicant_address : ''?>" />
                 </div>
               </div>
             </div> 
            </div>
          </div>
         </div>
       </div>
       <hr class="mt-5 mb-4" style="border: 1px solid #adadad">
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
                 echo "</div>";
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
      param.patra_id = <?= $patra_id ?>;
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
  });
</script>
