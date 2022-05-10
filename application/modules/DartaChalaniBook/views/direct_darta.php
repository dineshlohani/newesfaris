<?php
    $actionpage = "darta-direct";
    if(!empty($this->uri->segment(2)))
    {
        $actionpage .= "/".$this->uri->segment(2);
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


                        <li class="breadcrumb-item active">दर्ता</li>

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
                                    <label class="col-md-3 col-form-label">
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
                                                        if(isset($result) && $result->session_id == $session->id)
                                                        {
                                                            echo 'selected="selected"';
                                                        }
                                                        else if($session->id == $curr_session->id)
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
                                            <input type="text" name="nepali_darta_miti" class="form-control" required id="nepaliDate5" value="<?= isset($result) ? $result->nepali_darta_miti : generateCurrDate() ?>"  />
                                            </div>
                                        </div>

                                </div>
                            </div>
                        </div>
                        <?php if(!isset($result)) :?>
                            <div class="row" id="reserved_div" <?php if($reserved_nos == FALSE):?> style="display:none" <?php endif;?>>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">
                                                <span class="float-right">
                                                     रिजभ दर्ता नं<span class="text-danger">&nbsp;*</span>
                                                </span>

                                        </label>
                                            <div class="col-sm-8">
                                                <select name="reserved_darta_no" class="form-control" id="reserved_darta_no">
                                                    <option value=''>छान्नुहोस्</option>
                                                    <?php foreach($reserved_nos as $data):?>
                                                        <option value="<?= $data->darta_no?>"><?= $data->darta_no?></option>
                                                    <?php endforeach;?>
                                                </select>
                                            </div>

                                    </div>
                                </div>
                            </div>
                        <?php endif;?>
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
                                             पठाउने कार्यलयको नाम<span class="text-danger">&nbsp;*</span>
                                            </span>

                                    </label>

                                        <div class="col-sm-8">
                                            <input type="text" name="applicant_name" class="form-control" required id="id_applicant_name" value="<?= isset($result) ? $result->applicant_name : ''?>" />
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
                                                <input type="text" name="patra_miti_nep" class="form-control" required id="nepaliDate4"  value="<?= isset($result) ? $result->patra_miti_nep : ''?>" />
                                            </div>
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
                                    <select name="state" class="form-control state select2 state_selected" id="state_selected-1">
                                          <option value="">प्रदेश</option>
                                      <?php foreach($states as $state): ?>
                                          <option value="<?= $state->id ?>"
                                                    <?php if(isset($result->state)&&$result->state == $state->id)
                                                    {
                                                        echo "selected='selected'";
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
                                    <select name="district" class="form-control district select2 district_selected" id="district_selected-1">
                                        <option value="" >जिल्ला</option>
                                     <?php  foreach($districts as $district): ?>
                                        <option value="<?= $district->id ?>"
                                                <?php if(isset($result->district)&&$result->district == $district->id)
                                                {
                                                    echo "selected='selected'";
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
                                            <option value="<?= $local->id ?>"
                                                <?php if(isset($result->local_body)&&$result->local_body == $local->id)
                                                {
                                                    echo "selected='selected'";
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
                                    <select name="ward" class="form-control ward-no select2 ward_selected" id="ward_selected-1">
                                          <option value="" selected>वडा नं</option>
                                      <?php foreach($wards as $ward) : ?>
                                          <option value="<?= $ward->id ?>"
                                                <?php if(isset($result->ward)&&$result->ward == $ward->id)
                                                    {
                                                        echo "selected='selected'";
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
                                               पत्रको चलानी नं<span class="text-danger">&nbsp;*</span>
                                            </span>

                                    </label>

                                        <div class="col-sm-8">
                                            <input type="number" name="patra_chalani_no" class="form-control" required id=""  value="<?= isset($result) ? $result->patra_chalani_no : ''?>"/>
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
                                            <input type="text" name="letter_subject" class="form-control" required id="id_letter_subject" value="<?= isset($result) ? $result->letter_subject : ''?>" />
                                        </div>

                                </div>
                            </div>


                        <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">
                                            <span class="float-right">
                                                पत्रको किसिम
                                            </span>
                                    </label>
                                    <div class="col-sm-8">
                                        <select name="letter_type" id="letter_type" class="form-control" required>
                                            <option value=''>छान्नुहोस्</option>
                                            <option value='important' <?= isset($result) && $result->letter_type == 'important' ? 'selected="selcted"' : ''?>>जरुरि</option>
                                            <option value='most_important' <?= isset($result) && $result->letter_type == 'most_important' ? 'selected="selcted"' : ''?>>अति जरुरि</option>
                                            <option value='deadlined' <?= isset($result) && $result->letter_type == 'deadlined' ? 'selected="selcted"' : ''?>>म्याद तोकिएको</option>
                                        </select>
                                        <?php if(isset($result) && $result->letter_type == 'deadlined'):?>
                                            <input name="deadline_nep" id="deadline" class="form-control deadline-date" style="margin-top:15px;" placeholder='yyyy-mm-dd' value="<?= $result->deadline_nep?>">
                                        <?php else:?>
                                            <input name="deadline_nep" id="deadline" class="form-control hidden deadline-date" style="margin-top:15px;" placeholder='yyyy-mm-dd'>
                                        <?php endif;?>

                                    </div>
                                </div>
                            </div>
                            </div>

                    </div>
                    <?php if(isset($result)) :
                        $departs = explode("+", $result->department);
                        $karmachari = explode("+", $result->karmachari_name);
                        $i = 0;
                        foreach($departs as $depart):
                    ?>
                        <div class="col-md-12">
                            <div class="department row">
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
                                                            <option value="<?= $department->id?>"
                                                                <?= ($depart == $department->id) ? 'selected="selected"' :''?>
                                                            ><?= $department->name?></option>
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
                                            <input type="text" name="karmachari_name[]" class="form-control" value="<?= $karmachari[$i]?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                    <?php
                                $i++;
                            endforeach;
                        else:
                    ?>
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
                        <?php endif;?>
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
                                                    लिंक
                                                </span>
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="text" name='link' class="form-control" value="<?= isset($result) ? $result->link : ''?>">
                                        </div>
                                    </div>
                                </div>
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
                                <label>कागजातहरू</label>
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
                    param.nepali_darta_miti = nep_dob;
                    JQ.ajax({
                        url: "<?= base_url()?>DartaChalaniBook/getReservedDartaNos",
                        method: "POST",
                        data: param,
                        success: function (data) {
                            var obj = JSON.parse(data);
                            if(obj.msg == 'true')
                            {
                                JQ("#reserved_div").show();
                                JQ("#reserved_darta_no").empty().append(obj.html);
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
            JQ(".department").last().remove();
        });
    });
</script>
