<?php
    if($this->uri->segment(2)== "create")
    {
    $action_page = "upgrade-position/create";
    }
    if($this->uri->segment(2)=="edit")
    {
    $action_page = "upgrade-position/edit/".$this->uri->segment(3);
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
                    <li class="breadcrumb-item ml-1"><a href="<?= base_url()?>dashboard"> गृह </a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url()?>upgrade-position/"> आयश्रोत प्रमाणित </a></li>
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
                                           <input type="text" name="nepali_date" class="form-control" required id="nepaliDate4" value="<?= isset($result) ? $result->date : DateEngToNep(date('Y-m-d'))?>" readonly/>
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
                                                 संकेत नं. <span class="text-danger">&nbsp;*</span>
                                             </span>
                                            </label>
                                            <div class="col-sm-7">
                                                <input type="text" name="cit_no" class="form-control" required id="cit_no" value="<?= isset($result) ? $result->cit_no : ''?>"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-8">
                                        <div class="form-group row">
                                            <label class="col-md-5 col-form-label">
                                             <span class="float-right">
                                                 कार्यरत शाखा/कार्यालयः<span class="text-danger">&nbsp;*</span>
                                             </span>
                                            </label>
                                            <div class="col-sm-7">
                                                <input type="text" name="working_office" class="form-control" required id="working_office" value="<?= isset($result) ? $result->working_office : ''?>"/>
                                            </div>
                                        </div>
                                    </div>

                                </div>
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
                                                 तह<span
                                                     class="text-danger">&nbsp;*</span>
                                             </span>
                                         </label>
                                             <div class="col-sm-8">
                                                 <input type="text" name="taha" class="form-control" required id="taha" value="<?= isset($result) ? $result->taha : ''?>" />
                                             </div>
                                     </div>
                                 </div>

                                 <div class="col-md-6">
                                     <div class="form-group row">
                                         <label class="col-md-4 col-form-label">
                                             <span class="float-right">
                                                 पद<span
                                                     class="text-danger">&nbsp;*</span>
                                             </span>
                                         </label>
                                             <div class="col-sm-8">
                                                 <input type="text" name="position" class="form-control" required id="position" value="<?= isset($result) ? $result->position : ''?>" />
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
                                              नियुक्ति मिति<span
                                                   class="text-danger">&nbsp;*</span>
                                           </span>
                                       </label>
                                           <div class="col-sm-8">
                                              <div class="input-group">
                                                <input type="text" name="from_date" class="form-control" required id="nepaliDate2" value="<?= isset($result) ? $result->from_date : ''?>" />
                                              </div>
                                           </div>
                                   </div>
                               </div>
                               <div class="col-md-6">
                                   <div class="form-group row">
                                       <label class="col-md-4 col-form-label">
                                           <span class="float-right">
                                               पदास्थापना मिति<span
                                                   class="text-danger">&nbsp;*</span>
                                           </span>
                                       </label>
                                           <div class="col-sm-8">
                                              <div class="input-group">
                                                <input type="text" name="start_date" class="form-control" required id="nepaliDate1" value="<?= isset($result) ? $result->start_date : ''?>" />
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
                                               स्तरवृद्धि अवधिः<span
                                                   class="text-danger">&nbsp;*</span>
                                           </span>
                                       </label>
                                           <div class="col-sm-8">
                                               <input type="text" name="period"  class="form-control" required id="period" value="<?= isset($result) ? $result->period : ''?>" />
                                           </div>
                                   </div>
                               </div>

                               <div class="col-md-6">
                                   <div class="form-group row">
                                       <label class="col-md-4 col-form-label">
                                           <span class="float-right">
                                               मिति<span
                                                   class="text-danger">&nbsp;*</span>
                                           </span>
                                       </label>
                                           <div class="col-sm-8">
                                              <div class="input-group">
                                                <input type="text" name="period_date"  class="form-control" required id="nepaliDate5" value="<?= isset($result) ? $result->period_date : ''?>" />
                                              </div>
                                           </div>
                                   </div>
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
                                                 तह<span
                                                     class="text-danger">&nbsp;*</span>
                                             </span>
                                         </label>
                                             <div class="col-sm-8">
                                                 <input type="text" name="upgrade_taha" class="form-control" required id="upgrade_taha" value="<?= isset($result) ? $result->upgrade_taha : ''?>" />
                                             </div>
                                     </div>
                                 </div>

                                 <div class="col-md-6">
                                     <div class="form-group row">
                                         <label class="col-md-4 col-form-label">
                                             <span class="float-right">
                                                 पद<span
                                                     class="text-danger">&nbsp;*</span>
                                             </span>
                                         </label>
                                             <div class="col-sm-8">
                                                 <input type="text" name="upgrade_position" class="form-control" required id="upgrade_position" value="<?= isset($result) ? $result->upgrade_position : ''?>" />
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