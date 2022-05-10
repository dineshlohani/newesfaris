<?php
    if($this->uri->segment(2)== "create")
    {
    $action_page = "approve-wiwaran/create";
    }
    if($this->uri->segment(2)=="edit")
    {
    $action_page = "approve-wiwaran/edit/".$this->uri->segment(3);
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
                    <li class="breadcrumb-item"><a href="<?= base_url()?>approve-wiwaran/">विवरण प्रमाणित</a></li>
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
                        
                         <div class="row">
                             <div class="col-md-6">
                                 <div class="form-group row">
                                     <label class="col-md-4 col-form-label">
                                         <span class="float-right">
                                            कार्यरत शाखा / कार्यालय <span class="text-danger">&nbsp;*</span>
                                         </span>
                                     </label>
                                         <div class="col-sm-8">
                                            <input type="text" name="working_office" class="form-control" value="<?= isset($result) ? $result->working_office : ''?>">
                                         </div>
                                 </div>
                             </div>
                             <div class="col-6">
                                 <div class="form-group row">
                                    <label class="col-md-4 col-form-label">
                                         <span class="float-right">
                                             ऐन / कार्यविधि / अध्यादेश<span class="text-danger">&nbsp;*</span>
                                         </span>
                                    </label>
                                    <div class="col-sm-8">
                                      <div class="input-group">
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
                             </div>
                         </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-md-4 col-form-label">
                                <span class="float-right">
                                नियुक्ति मितिः-<span class="text-danger">&nbsp;*</span>
                                </span>
                              </label>
                              <div class="col-sm-8">
                                <div class="input-group">
                                 <input type="text" name="from_date" class="form-control" required id="nepaliDate4" value="<?= isset($result) ? $result->from_date : ''?>" />
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-6">
                           <div class="form-group row">
                             <label class="col-md-4 col-form-label">
                               <span class="float-right">
                                अवकाश मिति <span
                                 class="text-danger">&nbsp;*</span>
                               </span>
                             </label>
                             <div class="col-sm-8">
                              <div class="input-group">
                                <input type="text" name="end_date" class="form-control" required id="nepaliDate5" value="<?= isset($result) ? $result->end_date : ''?>" />
                              </div>
                             </div>
                           </div>
                         </div>
                         <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-4 col-form-label">
                             <span class="float-right">
                              अवकासको किसिम <span
                              class="text-danger">&nbsp;*</span>
                            </span>
                          </label>
                          <div class="col-sm-8">
                              <input type="text" name="retirement_type" class="form-control" required  value="<?= isset($result) ? $result->retirement_type : ''?>" />
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                       <div class="form-group row">
                         <label class="col-md-4 col-form-label">
                           <span class="float-right">
                            अन्य विवरण <span
                             class="text-danger">&nbsp;*</span>
                           </span>
                         </label>
                         <div class="col-sm-8">
                           <input type="text" name="other_details" class="form-control" required id="id_other_details" value="<?= isset($result) ? $result->other_details : ''?>" />
                         </div>
                       </div>
                     </div>
                     
            </div>
          </div>       
         </div>
         <div class="col-md-12 mb-3">
          <hr style="border: 1px solid #adadad">
           <h4 class="text-center">
            तपशिल
           </h4>
           <hr style="border: 1px solid #adadad">
         </div>
         <div class="col-md-12">
          <div class="row">
            <div class="col-md-12">

              <table class="table table-bordered" id="add_new_fields_jagga">
                <thead>
                  <tr>
                    <th>विदाको विवरण</th>
                    <th>जम्मा दिन</th>
                    <th>खर्च भएको </th>
                    <th>वाँकी.</th>
                    <th>कैफियत</th>
                    <th> <button type="button" id="hakdar" class="btn btn-success tapasil"><i class="fa fa-plus"></i></button></th>
                  </tr>
                </thead>
                <tbody>
                  <?php if(!empty($tapasil)) : 
                    foreach($tapasil as $tp) : ?>
                  <tr class="row_hakdar" id="row_hakdar_0">
                    <input type="hidden" name="tapasi_update_id[]" value="<?php echo $tp->id?>">
                    <td><input type="text" name="bida_wiwaran[]" class="form-control" id="id_bida_wiwaran_0" value="<?php echo $tp->bida_wiwaran?>" required=""></td>
                    <td><input type="text" name="jamma_din[]" class="form-control" id="id_jamma_din_name_0" value="<?php echo $tp->jamma_din?>" required=""></td>
                    <td><input type="text" name="kharcha[]" class="form-control" id="id_kharcha_0" value="<?php echo $tp->kharcha?>" required=""></td>
                    <td><input type="text" name="baki[]" class="form-control" id="id_baki_0" value="<?php echo $tp->baki?>" required=""></td>
                    <td><input type="text" name="remarks[]" class="form-control" id="id_remarks_0" value="<?php echo $tp->remarks?>" required=""></td>
                    <td><button type="button" class="btn btn-danger" id="hakdar_rm_0">
                        <i class="fa fa-times"></i></button>
                      </td>
                    </tr>
                  <?php endforeach;endif;?>
                  </tbody>
                </table>
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

<script type="text/javascript">
    var JQ = jQuery.noConflict();
    JQ(document).ready(function()
    {
        JQ('.tapasil').click(function(e) {
          e.preventDefault();
          var new_row =  '<tr>'+
                            '<td><input type="text" name="bida_wiwaran_new[]" class="form-control" id="id_bida_wiwaran_0" value="" required=""></td>'+
                            '<td><input type="text" name="jamma_din_new[]" class="form-control" id="id_jamma_din_name_0" value="" required=""></td>'+
                            '<td><input type="text" name="kharcha_new[]" class="form-control" id="id_kharcha_0" value="" required=""></td>'+
                            '<td><input type="text" name="baki_new[]" class="form-control" id="id_baki_0" value="" required=""></td>'+
                            '<td><input type="text" name="remarks_new[]" class="form-control" id="id_remarks_0" value="" required=""></td>'+
                            '<td><button type="button" class="btn btn-danger hakdar_remove" id="hakdar_rm_121"><i class="fa fa-times"></i></button> </td>'+
                          '<tr>';
          JQ("#add_new_fields_jagga").append(new_row);
        });

        JQ(document).on("click", ".doc_remove", function () {
            var id_selected     = JQ(this).attr("id");
            var res             = id_selected.split("_");
            var id              = res[res.length - 1];
            JQ("#doc_div_"+id).remove();
        });

        JQ("body").on("click",".hakdar_remove", function(e){
            e.preventDefault();
            var id = JQ(this).data('id');
            if (confirm('के तपाइँ  यसलाई हटाउन निश्चित हुनुहुन्छ ?')) {
              JQ(this).parent().parent().remove();
            }
        });

        JQ(document).on('click','#hakdar_rm_0', function(){
            alert('First row is not removable');
            return false;
        });

       
    });
</script>
</script>