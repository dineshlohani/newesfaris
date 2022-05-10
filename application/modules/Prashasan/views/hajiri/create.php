<?php
    if($this->uri->segment(2)== "create")
    {
    $action_page = "hajiri/create";
    }
    if($this->uri->segment(2)=="edit")
    {
    $action_page = "hajiri/edit/".$this->uri->segment(3);
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
                    <li class="breadcrumb-item"><a href="<?= base_url()?>hajiri/">स्थायी नियुक्ति पत्र </a></li>
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
                                           <input type="text" name="nepali_date" class="form-control" required id="nepaliDate1" value="<?= isset($result) ? $result->date : DateEngToNep(date('Y-m-d'))?>" readonly/>
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
                                  </div>
                              </div>
                         </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group row">
                        <div class="col-md-6 mb-sm-2">
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
                        <div class="col-md-6 mb-sm-2">
                          <div class="form-group row">
                              <label class="col-sm-4 col-form-label"><span
                                     class="float-right">समुह<span
                                     class="text-danger">&nbsp;*</span></span></label>
                              <div class="col-sm-8">
                                <div class="input-group">
                                  <input type="text" name="samuha" class="form-control" required id="" value="<?= isset($result) ? $result->samuha : ''?>" />
                                </div>
                              </div>
                          </div>
                        </div>

                        <div class="col-md-6 mb-sm-2">
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
                      </div>
                    </div>

                    <div class="col-md-12">
                        <hr style="border: 1px solid #adadad">
                         <div class="row">
                             <div class="col-md-6">
                                 <div class="form-group row">
                                     <label class="col-md-4 col-form-label">
                                         <span class="float-right">
                                             पत्राचार गर्ने कार्यालय <span class="text-danger">&nbsp;*</span>
                                         </span>
                                     </label>
                                         <div class="col-sm-8">
                                            <input type="text" name="partachar_office" class="form-control" value="<?= isset($result) ? $result->partachar_office : ''?>">
                                         </div>
                                 </div>
                             </div>
                             <div class="col-6">
                                 <div class="form-group row">
                                    <label class="col-md-4 col-form-label">
                                         <span class="float-right">
                                             पत्राचार मिति<span class="text-danger">&nbsp;*</span>
                                         </span>
                                    </label>
                                    <div class="col-sm-8">
                                      <div class="input-group">
                                        <input type="text" name="patrachar_date" class="form-control" required id="nepaliDate2" value="<?= isset($result) ? $result->patrachar_date : ''?>" />
                                        
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
                                  ऐन / कार्यविधि / अध्यादेश <span class="text-danger">&nbsp;*</span>
                                </span>
                              </label>
                              <div class="col-sm-8">
                                <select class="form-control select2" name="yain">
                                  <option></option>
                                  <?php if(!empty($yain)) :
                                    foreach($yain as $key=> $yn) : ?>
                                      <option value="<?php echo $yn->name?>"><?php echo $yn->name?></option>
                                  <?php endforeach;endif?>
                                </select>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-6">
                           <div class="form-group row">
                             <label class="col-md-4 col-form-label">
                               <span class="float-right">
                                 रमाना दिने कार्यालय <span
                                 class="text-danger">&nbsp;*</span>
                               </span>
                             </label>
                             <div class="col-sm-8">
                               <input type="text" name="ramana_office" class="form-control" required id="id_ramana_office" value="<?= isset($result) ? $result->ramana_office : ''?>" />
                             </div>
                           </div>
                         </div>
                         <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-4 col-form-label">
                             <span class="float-right">
                              रमाना दिने कार्यालय ठेगाना <span
                              class="text-danger">&nbsp;*</span>
                            </span>
                          </label>
                          <div class="col-sm-8">
                            <input type="text" name="ramana_office_address" class="form-control" required id="id_ramana_office_address" value="<?= isset($result) ? $result->ramana_office_address : ''?>" />
                          </div>
                        </div>
                      </div>


                      <div class="col-md-6">
                       <div class="form-group row">
                         <label class="col-md-4 col-form-label">
                           <span class="float-right">
                             रमाना कार्यरत पद <span
                             class="text-danger">&nbsp;*</span>
                           </span>
                         </label>
                         <div class="col-sm-8">
                           <input type="text" name="working_position" class="form-control" required id="id_working_position" value="<?= isset($result) ? $result->working_position : ''?>" />
                         </div>
                       </div>
                     </div>
                     <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-4 col-form-label">
                         <span class="float-right">
                           रमाना पत्रको च.नं. <span
                           class="text-danger">&nbsp;*</span>
                         </span>
                       </label>
                       <div class="col-sm-8">
                        <input type="text" name="ramana_chalani_no" class="form-control" required id="id_ramana_chalani_no" value="<?= isset($result) ? $result->ramana_chalani_no : ''?>" />
                      </div>
                    </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-4 col-form-label">
                         <span class="float-right">
                           रमाना मिति. <span
                           class="text-danger">&nbsp;*</span>
                         </span>
                       </label>
                       <div class="col-sm-8">
                        <div class="input-group">
                          <input type="text" name="ramana_miti" class="form-control" required id="nepaliDate6" value="<?= isset($result) ? $result->ramana_miti : ''?>" />
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-md-4 col-form-label">
                       <span class="float-right">
                         पदास्थापना निर्यण मिति <span
                         class="text-danger">&nbsp;*</span>
                       </span>
                     </label>
                     <div class="col-sm-8">
                      <div class="input-group">
                        <input type="text" name="nirnaya_miti" class="form-control" required id="nepaliDate4" value="<?= isset($result) ? $result->nirnaya_miti : ''?>" />
                        
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-md-4 col-form-label">
                     <span class="float-right">
                       लागू मितिः<span
                       class="text-danger">&nbsp;*</span>
                     </span>
                   </label>
                   <div class="col-sm-8">
                    <div class="input-group">
                      <input type="text" name="lagu_miti" class="form-control" required id="nepaliDate5" value="<?= isset($result) ? $result->lagu_miti : ''?>" />
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