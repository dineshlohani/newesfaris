<?php
    if($this->uri->segment(2)== "create")
    {
    $action_page = "sawari-pass/create";
    }
    if($this->uri->segment(2)=="edit")
    {
    $action_page = "sawari-pass/edit/".$this->uri->segment(3);
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
                    <li class="breadcrumb-item"><a href="<?= base_url()?>sawari-pass/">सवारी पास  </a></li>
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
                                        <label class="col-md-4 col-form-label">
                                           <span class="float-right">
                                               सवार कर्मचारी <span class="text-danger">&nbsp;*</span>
                                           </span>
                                        </label>
                                        
                                        <div class="col-sm-8">
                                           <input type="text" name="name" maxlength="16" class="form-control" required id="id_darta_no" value="<?= isset($result) ? $result->name : ''?>"/>
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
                                               पुग्ने स्थान   <span class="text-danger">&nbsp;*</span>
                                           </span>
                                       </label>
                                           <div class="col-sm-8">
                                              <input type="text" name="destination" class="form-control" value="<?= isset($result) ? $result->destination : ''?>">
                                           </div>
                                   </div>
                               </div>
                               <div class="col-6">
                                   <div class="form-group row">
                                       <label class="col-md-4 col-form-label">
                                           <span class="float-right">
                                               सवारी नं <span class="text-danger">&nbsp; *</span>
                                           </span> 
                                       </label>

                                           <div class="col-sm-8">
                                               <input type="text" name="vehicle_no" class="form-control" required id="id_new_place" value="<?= isset($result) ? $result->vehicle_no : ''?>" />
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
                                               लागु मिति(देखि)<span
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
                                               लागु मिति(सम्म) <span
                                                   class="text-danger">&nbsp;*</span>
                                           </span>
                                       </label>
                                           <div class="col-sm-8">
                                              <div class="input-group">
                                                <input type="text" name="to_date" class="form-control" required id="nepaliDate1" value="<?= isset($result) ? $result->to_date : ''?>" />
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
                                               चालकको नाम<span
                                                   class="text-danger">&nbsp;*</span>
                                           </span>
                                       </label>
                                           <div class="col-sm-8">
                                               <input type="text" name="driver_name" class="form-control" required id="driver_name" value="<?= isset($result) ? $result->driver_name : ''?>" />
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