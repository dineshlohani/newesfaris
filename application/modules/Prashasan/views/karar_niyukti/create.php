<?php
    if($this->uri->segment(2)== "create")
    {
    $action_page = "karar-niyukti/create";
    }
    if($this->uri->segment(2)=="edit")
    {
    $action_page = "karar-niyukti/edit/".$this->uri->segment(3);
    }
?>
<style type="text/css">
  .select2-selection { overflow: hidden; }
.select2-selection__rendered { white-space: normal; word-break: break-all; }
</style>
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
                    <li class="breadcrumb-item"><a href="<?= base_url()?>karar-niyukti/">सेवा करार नियुक्ति</a></li>
                    <li class="breadcrumb-item active">नयाँ</li>

                </ol>
            </nav>
        </div>
        <div class="container-fluid">
             <?php echo form_open_multipart($action_page); ?>
                   <div class="row">
                       <div class="col-md-6 offset-lg-6">
                           <div class="form-group row">
                               <label class="col-sm-5 col-form-label"><span
                                       class="float-right">आवेदन गरिएको मिति<span
                                       class="text-danger">&nbsp;*</span></span></label>
                                   <div class="col-sm-7">
                                       <div class="input-group">
                                           <input type="text" name="nepali_date" class="form-control" required id="nepaliDate1" value="<?= isset($result) ? $result->date : DateEngToNep(date('Y-m-d'))?>" readonly/>
                                       </div>
                                   </div>
                           </div>
                        </div>

                     
                   </div>


                  <div class="row">
                      <div class="col-md-12 mb-3">
                         <hr style="border: 1px solid #adadad">
                      </div>
                    <div class="col-md-12">
                         <div class="row">
                              <div class="col-md-12 mb-sm-2">
                                 <div class="form-group row">
                                      <label class="col-md-3 col-form-label">
                                         <span class="float-right">
                                             कर्मचारीको नाम <span class="text-danger">&nbsp;*</span>
                                         </span>
                                      </label>
                                      <div class="col-sm-3 ">
                                          <select name="gender" class="form-control" id="gender" required="">
                                              <option value="श्री" <?php if(!empty($result)){ if($result->gender == 'श्री') { echo 'selected';}}?>>श्री</option>
                                              <option value="सुश्री" <?php if(!empty($result)){ if($result->gender == 'सुश्री') { echo 'selected';}}?> >सुश्री</option>                        
                                              <option value="श्रीमती" <?php if(!empty($result)){ if($result->gender == 'श्रीमती') { echo 'selected';}}?>>श्रीमती</option>
                                          </select>
                                      </div>
                                      <div class="col-sm-6">
                                         <input type="text" name="name" class="form-control" required id="id_darta_no" value="<?= isset($result) ? $result->name : ''?>"/>
                                      </div>

                                      </div>
                                  </div>
                              </div>
                         </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group row">
                        <div class="col-md-6 mb-sm-2">
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
                        <div class="col-md-6 mb-sm-2">
                          <div class="form-group row">
                              <label class="col-sm-4 col-form-label"><span
                                     class="float-right">करार नियुक्तिको कारण<span
                                     class="text-danger">&nbsp;*</span></span></label>
                              <div class="col-sm-8">
                                <div class="input-group">
                                  <input type="text" name="reason_for" class="form-control" required id="" value="<?= isset($result) ? $result->reason_for : ''?>" />
                                </div>
                              </div>
                          </div>
                        </div>

                        <div class="col-md-6 mb-sm-2">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label"><span
                             class="float-right">ऐन / कार्यविधि / अध्यादेशः<span
                             class="text-danger">&nbsp;*</span></span></label>
                             <div class="col-sm-8">
                               <select class="form-control select2" name="yain">
                                <option value="">छान्नुहोस्</option>
                                <?php if(!empty($yain)) :
                                  foreach ($yain as $key => $y):?>
                                    <option value="<?php  echo $y->name?>" <?php if(!empty($result)){ if($result->yain == $y->name){echo 'selected';}}?>><?php echo $y->name?></option>
                                <?php endforeach;endif;?>
                               </select>
                             </div>
                          </div>
                        </div>

                        <div class="col-md-6 mb-sm-2">
                          <div class="form-group row">
                           <label class="col-sm-4 col-form-label"><span
                             class="float-right">गर्नुपर्ने काम<span
                             class="text-danger">&nbsp;*</span></span></label>
                             <div class="col-sm-8">
                               <div class="input-group">
                                 <input type="text" name="responsbility" class="form-control" required id="responsbility" value="<?= isset($result) ? $result->responsbility : ''?>"/>
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
                                             जिम्मा दिइएको शाखा / कार्यालय <span class="text-danger">&nbsp;*</span>
                                         </span>
                                     </label>
                                         <div class="col-sm-8">
                                            <input type="text" name="assigned_sakha" class="form-control" value="<?= isset($result) ? $result->assigned_sakha : ''?>">
                                         </div>
                                 </div>
                              </div>
                              <div class="col-6">
                                 <div class="form-group row">
                                    <label class="col-md-4 col-form-label">
                                         <span class="float-right">
                                             ठेगाना<span class="text-danger">&nbsp;*</span>
                                         </span>
                                    </label>
                                    <div class="col-sm-8">
                                      <div class="input-group">
                                        <input type="text" name="sakha_address" class="form-control" required id="sakha_address" value="<?= isset($result) ? $result->sakha_address : ''?>" />
                                        
                                      </div>
                                    </div>
                                 </div>
                             </div>

                              <div class="col-6">
                                 <div class="form-group row">
                                    <label class="col-md-4 col-form-label">
                                         <span class="float-right">
                                             करार नियुक्ति / सम्झौता मिति<span class="text-danger">&nbsp;*</span>
                                         </span>
                                    </label>
                                    <div class="col-sm-8">
                                      <div class="input-group">
                                        <input type="text" name="niyukta_miti" class="form-control" required id="nepaliDate4" value="<?= isset($result) ? $result->niyukta_miti : ''?>" />
                                        
                                      </div>
                                    </div>
                                 </div>
                              </div>

                              <div class="col-6">
                                 <div class="form-group row">
                                    <label class="col-md-4 col-form-label">
                                         <span class="float-right">
                                             करार अवधि<span class="text-danger">&nbsp;*</span>
                                         </span>
                                    </label>
                                    <div class="col-sm-8">
                                      <div class="input-group">
                                        <input type="text" name="karar_period" class="form-control" required id="karar_period" value="<?= isset($result) ? $result->karar_period : ''?>" />
                                        
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