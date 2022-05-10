<?php
    if($this->uri->segment(2)== "create")
    {
    $action_page = "sthai-niyukti/create";
    }
    if($this->uri->segment(2)=="edit")
    {
    $action_page = "sthai-niyukti/edit/".$this->uri->segment(3);
    }
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
                    <li class="breadcrumb-item ml-1"><a href="<?= base_url()?>dashboard">गृह</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url()?>sthai-niyukti/">स्थायी नियुक्ति पत्र </a></li>
                    <li class="breadcrumb-item active">नयाँ</li>

                </ol>
            </nav>
        </div>
        <div class="container-fluid">
             <?php echo form_open_multipart($action_page); ?>
                   <div class="row">
                       <div class="col-md-6 offset-md-6">
                           <div class="form-group row">
                               <label class="col-sm-5 col-form-label"><span
                                       class="float-right">आवेदन गरिएको मिति<span
                                       class="text-danger">&nbsp;*</span></span></label>
                                   <div class="col-sm-7">
                                       <div class="input-group">
                                           <input type="text" name="nepali_date" class="form-control" required id="nepaliDate4" value="<?= isset($result) ? $result->date : DateEngToNep(date('Y-m-d'))?>"/>
                                       </div>
                                   </div>
                           </div>
                        </div>
                   </div>
                   <div class="row">
                       <div class="col-md-12 mb-3">
                           <h4>
                               कर्मचारीको विवरण
                           </h4>
                           <hr style="border: 1px solid #adadad">
                       </div>
                      
                       <div class="col-md-12">
                           <div class="row">
                                <div class="col-md-12">
                                   <div class="form-group row">
                                        <label class="col-md-3 col-form-label">
                                           <span class="float-right">
                                               कर्मचारीको नामः <span class="text-danger">&nbsp;*</span>
                                           </span>
                                        </label>
                                        <div class="col-sm-2">
                                            <select name="gender" class="form-control" id="gender" required="">
                                                <option value="श्री" selected="">श्री</option>
                                                <option value="सुश्री" >सुश्री</option>                        
                                                <option value="श्रीमती" >श्रीमती</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                           <input type="text" name="name" class="form-control" required id="id_darta_no" value="<?= isset($result) ? $result->name : ''?>"/>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group row">
                                                <label class="col-md-5 col-form-label">
                                                 <span class="float-right">
                                                     न प्रा नं. <span class="text-danger">&nbsp;*</span>
                                                 </span>
                                                </label>
                                                <div class="col-sm-7">
                                                    <input type="text" name="cit_no" class="form-control" required id="cit_no" value="<?= isset($result) ? $result->cit_no : ''?>"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-md-6">
                                   <div class="form-group row">
                                       <label class="col-md-4 col-form-label">
                                           <span class="float-right">
                                               नागरिकता नं. <span class="text-danger">&nbsp;*</span>
                                           </span>
                                       </label>
                                           <div class="col-sm-8">
                                               <input type="text" name="cit_no" class="form-control" required id="cit_no" value="<?= isset($result) ? $result->cit_no : ''?>"/>
                                           </div>
                                   </div>
                                </div> -->
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
                                       <select name="state" class="form-control state select2 state_selected" required id="state_selected-1">
                                             <option value="">प्रदेश</option>
                                         <?php foreach($states as $state): ?>
                                             <option value="<?= $state->id ?>"
                                                 <?php
                                                    if(isset($result) && $result->state == $state->id)
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
                                       <select name="district" class="form-control district select2 district_selected" required id="district_selected-1">
                                           <option value="" >जिल्ला</option>
                                        <?php  foreach($districts as $district): ?>
                                           <option value="<?= $district->id ?>"
                                               <?php
                                                  if(isset($result) && $result->district == $district->id)
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
                                       <select name="ganapa" class="form-control local-body select2 local_body_selected" required id="local_body_selected-1">
                                           <option value="">गा.वि.स./न.पा </option>
                                           <?php foreach($locals as $local): ?>
                                               <option value="<?=$local->id?>"
                                                   <?php
                                                      if(isset($result) && $result->ganapa == $local->id)
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
                                       <select name="ward" class="form-control ward-no select2 ward_selected" required id="ward_selected-1">
                                             <option value="" selected>वडा नं</option>
                                         <?php foreach($wards as $ward) : ?>
                                             <option value="<?= $ward->id ?>"
                                                 <?php
                                                    if(isset($result) && $result->ward == $ward->id)
                                                    {
                                                        echo 'selected= "selected"';
                                                    }
                                                 ?>
                                             ><?= $ward->name ?></option>
                                         <?php endforeach;?>
                                        </select>
                                   </div>
                           </div>
                       </div>
                       <div class="col-md-12">
                       <hr style="border: 1px solid #adadad">
                           <div class="row">
                               <div class="col-md-6">
                                   <div class="form-group row">
                                       <label class="col-md-4 col-form-label">
                                           <span class="float-right">
                                               लोक सेवा कार्यालय <span class="text-danger">&nbsp;*</span>
                                           </span>
                                       </label>
                                           <div class="col-sm-8">
                                              <input type="text" name="loksewa_office" class="form-control" value="<?= isset($result) ? $result->loksewa_office : ''?>">
                                           </div>
                                   </div>
                               </div>
                               <div class="col-6">
                                   <div class="form-group row">
                                       <label class="col-md-4 col-form-label">
                                           <span class="float-right">
                                               ठेगाना <span class="text-danger">&nbsp; *</span>
                                           </span>
                                       </label>

                                           <div class="col-sm-8">
                                               <input type="text" name="loksewaoffice_address" class="form-control" required id="id_new_place" value="<?= isset($result) ? $result->loksewaoffice_address : ''?>" />
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
                                               विज्ञापन नं<span
                                                   class="text-danger">&nbsp;*</span>
                                           </span>
                                       </label>
                                           <div class="col-sm-8">
                                               <input type="text" name="add_no" class="form-control" required id="id_add_no"  value="<?= isset($result) ? $result->add_no : ''?>"/>
                                           </div>
                                   </div>
                               </div>
                               <div class="col-md-6">
                                   <div class="form-group row">
                                       <label class="col-md-4 col-form-label">
                                           <span class="float-right">
                                               विज्ञापन मिति  <span
                                                   class="text-danger">&nbsp;*</span>
                                           </span>
                                       </label>
                                           <div class="col-sm-8">
                                               <input type="text" name="add_date" class="form-control" required id="id_add_date" value="<?= isset($result) ? $result->add_date : ''?>" />
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
                                               कार्यालयको च.नं<span
                                                   class="text-danger">&nbsp;*</span>
                                           </span>
                                       </label>
                                           <div class="col-sm-8">
                                               <input type="text" name="office_chalani_no" class="form-control" required id="id_add_no"  value="<?= isset($result) ? $result->office_chalani_no : ''?>"/>
                                           </div>
                                   </div>
                               </div>
                               <div class="col-md-6">
                                   <div class="form-group row">
                                       <label class="col-md-4 col-form-label">
                                           <span class="float-right">
                                                कार्यालयको च मिति  <span
                                                   class="text-danger">&nbsp;*</span>
                                           </span>
                                       </label>
                                           <div class="col-sm-8">
                                               <div class="input-group">
                                                   <input type="text" name="office_chalani_date" class="form-control" required id="nepaliDate2" value="<?= isset($result) ? $result->office_chalani_date : ''?>" />
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
                                               ऐन <span
                                                   class="text-danger">&nbsp;&nbsp;</span>
                                           </span>
                                       </label>
                                           <div class="col-sm-8">
                                              <select class="form-control select2" name="yain">
                                                <option value="">छान्नुहोस्</option>
                                                <?php if(!empty($yain)) : 
                                                    foreach ($yain as $key => $y) :?>
                                                    <option value="<?php echo $y->name?>"><?php echo $y->name?></option>
                                                <?php endforeach;endif;?>
                                              </select>
                                           </div>
                                   </div>
                               </div>
                               <div class="col-md-6">
                                   <div class="form-group row">
                                       <label class="col-md-4 col-form-label">
                                           <span class="float-right">
                                               गा.पा.को निर्णय मिति <span
                                                   class="text-danger">&nbsp;&nbsp;</span>
                                           </span>
                                       </label>
                                           <div class="col-sm-8">
                                                <div class="input-group">
                                                   <input type="text" name="gapa_miti" class="form-control" required id="nepaliDate5" value="<?= isset($result) ? $result->gapa_miti : ''?>" />
                                                </div>
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
                                               class="float-right">लागू मितिः<span
                                               class="text-danger">&nbsp;*</span></span></label>
                                           <div class="col-sm-8">
                                               <div class="input-group">
                                                   <input type="text" name="lagu_miti" class="form-control" required id="nepaliDate6" value="<?= isset($result) ? $result->lagu_miti : ''?>" />
                                                </div>
                                           </div>
                                   </div>
                               </div>
                               <div class="col-md-6 ">
                                   <div class="form-group row">
                                       <label class="col-sm-4 col-form-label"><span
                                               class="float-right">सेवा<span
                                               class="text-danger">&nbsp;*</span></span></label>
                                           <div class="col-sm-8">
                                               <div class="input-group">
                                                   <input type="text" name="sewa" class="form-control" required id="sewa" value="<?= isset($result) ? $result->sewa : ''?>"/>
                                               </div>
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
                                               class="float-right">समुहः<span
                                               class="text-danger">&nbsp;*</span></span></label>
                                           <div class="col-sm-8">
                                               <div class="input-group">
                                                   <input type="text" name="samuha" class="form-control" required id="" value="<?= isset($result) ? $result->samuha : ''?>" />
                                                </div>
                                           </div>
                                   </div>
                               </div>
                               <div class="col-md-6 ">
                                   <div class="form-group row">
                                       <label class="col-sm-4 col-form-label"><span
                                               class="float-right">तह<span
                                               class="text-danger">&nbsp;*</span></span></label>
                                           <div class="col-sm-8">
                                               <div class="input-group">
                                                   <input type="text" name="taha" class="form-control" required id="taha" value="<?= isset($result) ? $result->taha : ''?>"/>
                                               </div>
                                           </div>
                                   </div>
                               </div>
                               <div class="col-md-6 ">
                                   <div class="form-group row">
                                       <label class="col-sm-4 col-form-label"><span
                                               class="float-right">पद<span
                                               class="text-danger">&nbsp;*</span></span></label>
                                           <div class="col-sm-8">
                                               <div class="input-group">
                                                   <input type="text" name="position" class="form-control" required id="position" value="<?= isset($result) ? $result->position : ''?>"/>
                                               </div>
                                           </div>
                                   </div>
                               </div>
                           </div>
                        </div>
                   </div>
                   <hr class="mt-5 mb-4">
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
    </section>
</div>