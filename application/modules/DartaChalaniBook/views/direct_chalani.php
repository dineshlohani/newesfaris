<?php
    if(isset($result))
    {
        $actionpage = 'edit-chalani/'.$result->id;
    }
    else {
        $actionpage = 'chalani-direct';
    }
    $documents = [];
    if(isset($result) && !empty($result->documents))
    {
        $documents = explode("+", $result->documents);
    }
   $path = "assets/documents/chalani_direct" ;
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


                        <li class="breadcrumb-item active">चलानी</li>

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



            <?php echo form_open_multipart(base_url().$actionpage); ?>
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
                                            <select name="session_id" class="select2 form-control">
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
                                            चलानी मिति<span class="text-danger">&nbsp;*</span>
                                            </span>

                                    </label>

                                        <div class="col-sm-8">
                                        <div class="input-group">
                                            <input type="text" name="nepali_chalani_miti" class="form-control" required id="nepaliDate5" value="<?= isset($result) ? $result->nepali_chalani_miti : generateCurrDate() ?>"  />
                                        </div>
                                        </div>

                                </div>
                            </div>
                        </div>
                        <?php if(!isset($result)): ?>
                        <div class="row" id="reserved_div" <?php if($reserved_nos == FALSE):?> style="display:none" <?php endif;?>>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">
                                            <span class="float-right">
                                                 रिजभ चलानी नं<span class="text-danger">&nbsp;*</span>
                                            </span>

                                    </label>
                                        <div class="col-sm-8">
                                            <select name="reserved_chalani_no" class="form-control" id="reserved_chalani_no">
                                                <option value=''>छान्नुहोस्</option>
                                                <?php foreach($reserved_nos as $data):?>
                                                    <option value="<?= $data->id?>"><?= $data->chalani_no?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>

                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-3 mt-4">
                        <h4>

                        </h4>
                        <hr style="border: 1px solid #adadad">
                    </div>

                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">
                                            <span class="float-right">
                                               कार्यलयको नाम<span class="text-danger">&nbsp;*</span>
                                            </span>

                                    </label>

                                        <div class="col-sm-8">
                                            <input type="text" name="applicant_name" class="form-control" required id="id_applicant_name" value= "<?= isset($result) ? $result->applicant_name : ''?>"  />
                                        </div>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">
                                            <span class="float-right">
                                               पत्रको मिति<span class="text-danger">&nbsp;*</span>
                                            </span>

                                    </label>

                                        <div class="col-sm-8">
                                        <div class="input-group">
                                            <input type="text" name="patra_miti_nep" class="form-control" required id="nepaliDate4" value="<?= isset($result) ? $result->patra_miti_nep : ''?>" />
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
                                               पत्रको विषय<span class="text-danger">&nbsp;*</span>
                                            </span>

                                    </label>

                                        <div class="col-sm-8">
                                            <input type="text" name="letter_subject" class="form-control" required id="id_letter_subject" value="<?= isset($result) ? $result->letter_subject : ''?>"  />
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
                                           पत्र वाहकको नाम<span class="text-danger">&nbsp;*</span>
                                        </span>
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="text" name="patra_wahak_naam" class="form-control" value="<?= isset($result) ? $result->patra_wahak_naam : ''?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">
                                        <span class="float-right">
                                           सम्पर्क नं
                                        </span>
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="number" name="patra_wahak_contact" class="form-control" value="<?= isset($result) ? $result->patra_wahak_contact : ''?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">
                                            <span class="float-right">
                                                कैफियत
                                            </span>
                                    </label>
                                    <div class="col-sm-8">
                                        <textarea name="description" class="form-control"><?= isset($result) ? $result->description : ''?></textarea>
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
    function checkMyDate(date_selected, id_selected)
    {
        if(id_selected=="nepaliDate5")
          {
              var  nep_dob = date_selected;
//              alert(nep_dob);
                param = {};
                param.nepali_chalani_miti = nep_dob;
                JQ.ajax({
                    url: "<?= base_url()?>DartaChalaniBook/getReservedChalaniNos",
                    method: "POST",
                    data: param,
                    success: function (data) {
                        var obj = JSON.parse(data);
                        if(obj.msg == 'true')
                        {
                            JQ("#reserved_div").show();
                            JQ("#reserved_chalani_no").empty().append(obj.html);
                        }
                        else if(obj.msg == 'false')
                        {
                            JQ("#reserved_div").hide();
                        }

                    },
                    error: function (error) {
                        console.log(JSON.stringify(error));
                    }
                });
          }

    }
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

    });
</script>
