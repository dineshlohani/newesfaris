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


                        <li class="breadcrumb-item active">मौजुदा सुची</li>

                        <li class="breadcrumb-item active">नयाँ</li>

                    </ol>
                </nav>
            </div>




    <div class="container-fluid ">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="offset-lg-1 col-lg-10">

                </div>
            </div>



            <?php echo form_open_multipart(base_url()."maujuda-suchi"); ?>
                <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">
                                            <span class="float-right">
                                           पत्र संख्या<span class="text-danger">&nbsp;*</span>
                                            </span>

                                    </label>

                                        <div class="col-sm-8">
                                            <select name="session_id" class="select2 form-control" required>
                                                <option value=''>छान्नुहोस्</option>
                                                <?php foreach($sessions as $session):?>
                                                <option value="<?= $session->id?>"
                                                    <?php
                                                        if($session->id == $curr_session->id)
                                                        {
                                                            echo 'selected="selected"';
                                                        }
                                                    ?>
                                                ><?= $session->name ?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">
                                            <span class="float-right">
                                           दर्ता मिति<span class="text-danger">&nbsp;*</span>
                                            </span>

                                    </label>

                                        <div class="col-sm-8">
                                        <div class="input-group">
                                            <input type="text" name="nepali_darta_miti" class="form-control" required id="nepaliDate5" value="<?= generateCurrDate() ?>"  />
                                        </div>
                                        </div>

                                </div>
                            </div>
                        </div>
                    </div>
                <div class="row">
                    <div class="col-md-12 mb-3 mt-4">
                        <h4>
                            व्यक्ति / फर्मको विवरण
                        </h4>
                        <hr style="border: 1px solid #adadad">
                    </div>

                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">
                                            <span class="float-right">
                                             नाम<span class="text-danger">&nbsp;*</span>
                                            </span>

                                    </label>

                                        <div class="col-sm-8">
                                            <input type="text" name="applicant_name" class="form-control" required id="id_applicant_name"  />
                                        </div>

                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">
                                        <span class="float-right">
                                            ठेगाना
                                        </span>

                            </label>

                                <div class="col-md-2 mb-sm-2">
                                    <select name="state" class="form-control state select2 state_selected"  id="state_selected-1">
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
                                    <select name="district" class="form-control district select2 district_selected"  id="district_selected-1">
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
                                    <select name="local_body" class="form-control local-body select2 local_body_selected"  id="local_body_selected-1">
                                        <option value="">गा.वि.स./न.पा </option>
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
                                    <select name="ward" class="form-control ward-no select2 ward_selected"  id="ward_selected-1">
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
                                              सम्पर्क व्यक्तिको नाम<span class="text-danger">&nbsp;*</span>
                                            </span>

                                    </label>

                                        <div class="col-sm-8">
                                            <input type="text" name="contact_name" class="form-control" required id=""  />
                                        </div>

                                </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">
                                                <span class="float-right">
                                                  सम्पर्क नं<span class="text-danger">&nbsp;*</span>
                                                </span>

                                        </label>

                                            <div class="col-sm-8">
                                                <input type="number" name="contact_number" class="form-control" required id=""  />
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
                                             निवेदन दर्ता मिति<span class="text-danger">&nbsp;*</span>
                                           </span>

                                   </label>

                                       <div class="col-sm-8">
                                       <div class="input-group">
                                           <input type="text" name="niwedan_darta_miti_nep" class="form-control" required id="nepaliDate6"  />
                                       </div>
                                       </div>

                               </div>
                               </div>
                               <div class="col-md-6">
                                   <div class="form-group row">
                                       <label class="col-md-4 col-form-label">
                                               <span class="float-right">
                                                 संस्था दर्ता नं<span class="text-danger">&nbsp;*</span>
                                               </span>

                                       </label>

                                           <div class="col-sm-8">
                                               <input type="number" name="sanstha_darta_no" class="form-control" required id=""  />
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
                                            पान / भ्याट दर्ता<span class="text-danger">&nbsp;*</span>
                                          </span>

                                  </label>

                                      <div class="col-sm-8">
                                          <select class="form-control" name="darta_type" required>
                                              <option value="pan">पान दर्ता</option>
                                              <option value="vat">भ्याट दर्ता</option>
                                          </select>
                                      </div>

                              </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="form-group row">
                                      <label class="col-md-4 col-form-label">
                                              <span class="float-right">
                                                पान / भ्याट नं<span class="text-danger">&nbsp;*</span>
                                              </span>

                                      </label>

                                          <div class="col-sm-8">
                                              <input type="number" name="pan_vat_no" class="form-control" required id=""  />
                                          </div>

                                  </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="form-group row">
                                      <label class="col-md-4 col-form-label">
                                              <span class="float-right">
                                                संस्था दर्ता नवीकरण<span class="text-danger">&nbsp;*</span>
                                              </span>

                                      </label>

                                          <div class="col-sm-8">
                                              <select class="form-control" name="is_renewed" required>
                                                  <option value='yes'>छ</option>
                                                  <option value="no">छैन</option>
                                              </select>
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
                                               कामको विवरण
                                            </span>

                                    </label>

                                        <div class="col-sm-8">
                                            <select class="select2 form-control" name="work_type" >
                                                <option value=''>छान्नुहोस्</option>
                                                <?php foreach($works as $work) :?>
                                                    <option value="<?= $work->id?>"><?= $work->name?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                </div>
                            </div>


                        <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">
                                            <span class="float-right">
                                                मालसामान / सेवाको प्रकृति
                                            </span>
                                    </label>
                                    <div class="col-sm-8">
                                        <select class="select2 form-control" name="service_type">
                                            <option value="">छान्नुहोस्</option>
                                            <?php foreach($services as $service): ?>
                                                <option value="<?= $service->id?>"><?= $service->name?></option>
                                            <?php endforeach; ?>
                                        </select>
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
                                               कार्यानुभव
                                           </span>

                                   </label>

                                       <div class="col-sm-8">
                                           <input type="text" name="karyanubhab" class="form-control" >
                                       </div>

                               </div>
                               </div>
                               <div class="col-md-6">
                                   <div class="form-group row">
                                       <label class="col-md-4 col-form-label">
                                               <span class="float-right">
                                                 काम गर्न चाहेको लक्षित समुह
                                               </span>

                                       </label>

                                           <div class="col-sm-8">
                                               <input type="text" name="lakshit_group" class="form-control" id=""  />
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
                                           फाँट<span class="text-danger">&nbsp;*</span>
                                        </span>
                                    </label>
                                    <div class="col-sm-8">
                                        <select name="department[]" class="form-control select2" required>
                                            <option value=''>छान्नुहोस्</option>
                                            <?php if($departments != FALSE):
                                                    foreach($departments as $department):
                                            ?>
                                                        <option value="<?= $department->id?>"><?= $department->name?></option>
                                            <?php
                                                    endforeach;
                                                  endif;
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">
                                        <span class="float-right">
                                           कर्मचारीको नाम<span class="text-danger">&nbsp;*</span>
                                        </span>
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="text" name="karmachari_name[]" class="form-control" value="" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="col-md-12" id="department_div">

                        </div>
                        <div class="col-md-12">
                            <div class="text-center" style="margin-bottom:20px;">
                                <div class="col-5">
                                    <button type="button" class="btn btn-success" data-formset-add>
                                        <i id ="add_department" class="fa fa-plus"></i></button>
                                        <button type="button" class="btn btn-danger" data-formset-add>
                                            <i id ="remove_department" class="fa fa-close"></i></button>
                                </div>
                            </div>
                        </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">
                                            <span class="float-right">
                                                कैफियत
                                            </span>
                                    </label>
                                    <div class="col-sm-8">
                                        <textarea name="description" class="form-control"></textarea>
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
                                <label>कागजातहरू </label>
                            </div>
                            <div class="col-sm-9">
                                <div class="mb-3 documents" id="doc_div_0">
                                    <input type="file" name="documents[]" id="documents_0" />
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

                                        }
                                    ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div><hr class="mt-5 mb-4">

                <div class="form-group row">
                    <div class="col-sm-6 offset-sm-6 mt-4">
                        <button type="submit" class='btn btn-block btn-submit btn-primary' name="submit">सेभ
                            गर्नुहोस्
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>

    </section>
</div>
<script src="<?=base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<script>
    var JQ =jQuery.noConflict();
    JQ(document).ready(function()
    {
        JQ(document).on("click", "#documents", function (){
            var  count = JQ(".documents").length;
            param = {};
            param.count = count;
            JQ.ajax({
                url: "<?= base_url()?>getGharJaggaDocumentHTML",
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
        JQ(document).on('change',"#letter_type",function(){
            if(JQ(this).val() == "deadlined")
            {
                JQ(".deadline-date").show();
            }
            else {
                JQ(".deadline-date").val('');
                JQ(".deadline-date").hide();
            }
        });
        JQ(document).on('click','#add_department',function(){
            JQ.ajax({
                url: "<?= base_url()?>DartaChalaniBook/getDepartmentHTML",
                method: "POST",
                success: function (data) {

                    var obj = JSON.parse(data);
                    JQ("#department_div").append(obj.html);
                },
                error: function (error) {
                    console.log(JSON.stringify(error));
                }
            });
        });
        JQ(document).on('click',"#remove_department",function(){
            alert(JQ(".department").last());
            JQ(".department").last().remove();
        });
    });
</script>
