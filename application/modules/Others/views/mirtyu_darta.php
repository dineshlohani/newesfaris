<?php
    if($this->uri->segment(2)== "create")
    {
    $action_page = "mirtyu-darta/create";
    }
    if($this->uri->segment(2)=="edit")
    {
    $action_page = "mirtyu-darta/edit/".$this->uri->segment(3);
    }
    if(!empty($result->documents))
    {
        $documents      = explode("+",$result->documents);

    }
    $path           = base_url()."assets/documents/others/mirtyu_darta/";
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


                        <li class="breadcrumb-item"><a href="<?= base_url()?>mirtyu-darta/">मृत्यु दर्ता</a></li>

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



            <?php echo form_open_multipart($action_page);?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label">
                                    <span class="float-right">
                                       निवेदकको नाम<span class="text-danger">&nbsp;*</span>
                                    </span>

                            </label>

                                <div class="col-sm-8">
                                    <input type="text" name="applicant_name" maxlength="128" class="form-control" required id="id_applicant_name" value="<?= isset($result) ? $result->applicant_name : ''?>" />
                                </div>

                        </div>
                    </div>
                    <div class="col-md-6">
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
                        <hr style="border: 1px solid #adadad">
                    </div>

                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">
                                            <span class="float-right">
                                               मृतकको नाम<span class="text-danger">&nbsp;*</span>
                                            </span>

                                    </label>

                                        <div class="col-sm-8">
                                            <input type="text" name="death_person_name" maxlength="128" class="form-control" required id="id_death_person_name" value="<?= isset($result) ? $result->death_person_name : ''?>" />
                                        </div>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">
                                            <span class="float-right">
                                                लिङ्ग<span class="text-danger">&nbsp;*</span>
                                            </span>

                                    </label>

                                        <div class="col-sm-8">
                                            <select name="gender" class="form-control" required id="id_gender">
                                                <option value="" selected>छान्नुहोस्</option>

                                                <option value="1" <?php if(isset($result) && $result->gender == 1){ echo 'selected="selected"';}?>>पुरुष</option>

                                                <option value="2" <?php if(isset($result) && $result->gender == 2){ echo 'selected="selected"';}?>>महिला</option>

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
                                                उमेर<span class="text-danger">&nbsp;*</span>
                                            </span>

                                    </label>

                                        <div class="col-sm-8">
                                            <input type="number" name="age" maxlength="128" class="form-control" required id="id_age"  value="<?= isset($result) ? $result->age : ''?>"/>
                                        </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">
                                      <span class="float-right">
                                            मृत्यु भएको मिति (Date of death)
                                        <span class="text-danger">&nbsp;*</span>
                                      </span>
                                    </label>

                                        <div class="col-sm-7">
                                            <div class="input-group mb-sm-2">

                                                <input type="text" name="nep_dod" value="<?=isset($result)?$result->nep_dod:''?>" maxlength="10" class="form-control nep_dob" required id="nepaliDate5" />
                                                <div class="input-group-append">
                                                    <span class="input-group-text">B.S.</span>
                                                </div>

                                                <input type="text" name="eng_dod" readonly="true" value="<?=isset($result)?$result->eng_dod:''?>" class="form-control" required id="id_eng_dob" />
                                                <div class="input-group-append">
                                                    <span class="input-group-text">A.D.</span>
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
                                                बुवाको नाम<span class="text-danger">&nbsp;*</span>
                                            </span>

                                    </label>

                                        <div class="col-sm-8">
                                            <input type="text" name="father_name" maxlength="128" class="form-control" required id="id_father_name" value="<?= isset($result) ? $result->father_name : ''?>" />
                                        </div>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">
                                            <span class="float-right">
                                                आमाको नाम<span class="text-danger">&nbsp;*</span>
                                            </span>

                                    </label>

                                        <div class="col-sm-8">
                                            <input type="text" name="mother_name" maxlength="128" class="form-control" required id="id_mother_name"  value="<?= isset($result) ? $result->mother_name : ''?>"/>
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
                                                बजेको नाम<span class="text-danger">&nbsp;*</span>
                                            </span>

                                    </label>

                                        <div class="col-sm-8">
                                            <input type="text" name="grandfather_name" maxlength="128" class="form-control" required id="id_grandfather_name"  value="<?= isset($result) ? $result->grandfather_name : ''?>"/>
                                        </div>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">
                                            <span class="float-right">
                                                पति/पत्नीको नाम
                                            </span>

                                    </label>

                                        <div class="col-sm-8">
                                            <input type="text" name="husband_wife_name" maxlength="128" class="form-control" required id="id_husband_wife_name"  value="<?= isset($result) ? $result->husband_wife_name : ''?>"/>
                                        </div>

                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">
                                            <span class="float-right">
                                               स्थायी ठेगाना<span class="text-danger">&nbsp;*</span>
                                            </span>

                            </label>

                                <div class="col-md-2 mb-sm-2">
                                    <select name="state" class="form-control select2 state_selected" required id="state_selected-1">
                                        <option value="" selected>प्रदेश</option>
                                        <?php foreach($states as $state) : ?>
                                        <option value="<?= $state->id ?>"
                                            <?php
                                                if(isset($result)&& $result->state == $state->id)
                                                {
                                                    echo 'selected="selected"';
                                                }
                                                elseif($state->id==$default[0])
                                                {
                                                    echo 'selected="selected"';
                                                }
                                            ?>
                                        ><?= $state->name?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-sm-2">
                                    <select name="district" class="form-control select2 district_selected" required id="district_selected-1">
                                        <option value="" selected>जिल्ला</option>
                                        <?php foreach($districts as $district) : ?>
                                        <option value="<?= $district->id ?>"
                                            <?php
                                                if(isset($result)&& $result->district == $district->id)
                                                {
                                                    echo 'selected="selected"';
                                                }
                                                elseif($district->name==$default[1])
                                                    {
                                                        echo 'selected="selected"';
                                                    }
                                            ?>
                                        ><?= $district->name?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-sm-2">
                                    <select name="local_body" class="form-control select2 local_body_selected" required id="local_body_selected-1">
                                        <option value="" selected>गा.वि.स./न.पा </option>
                                        <?php foreach($locals as $local) : ?>
                                        <option value="<?= $local->id ?>"
                                            <?php
                                                if(isset($result)&& $result->local_body == $local->id)
                                                {
                                                    echo 'selected="selected"';
                                                }
                                                elseif($local->name==$default[2])
                                                    {
                                                        echo 'selected="selected"';
                                                    }
                                            ?>
                                        ><?= $local->name?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="col-md-2 mb-sm-2">
                                    <select name="ward" class="form-control select2 ward_selected" required id="ward_selected-1">
                                        <option value="" selected>वडा नं</option>
                                        <?php foreach($wards as $ward) : ?>
                                        <option value="<?= $ward->id ?>"
                                            <?php
                                                if(isset($result)&& $result->ward == $ward->id)
                                                {
                                                    echo 'selected="selected"';
                                                }
                                                elseif($ward->id==$default[3])
                                                {
                                                        echo 'selected="selected"';
                                                }
                                            ?>
                                        ><?= $ward->name?></option>
                                        <?php endforeach;?>

                                    </select>
                                </div>

                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">
                                            <span class="float-right">
                                                मृत्यु भएको स्थान <span class="text-danger">&nbsp;*</span>
                                            </span>

                            </label>

                                <div class="col-md-2 mb-sm-2">
                                    <select name="death_state" class="form-control select2 state_selected" required id="state_selected-2">
                                        <option value="" selected>प्रदेश</option>
                                        <?php foreach($states as $state) : ?>
                                        <option value="<?= $state->id ?>"
                                            <?php
                                                if(isset($result)&& $result->state == $state->id)
                                                {
                                                    echo 'selected="selected"';
                                                }
                                                elseif($state->id==$default[0])
                                                {
                                                    echo 'selected="selected"';
                                                }
                                            ?>
                                        ><?= $state->name?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-sm-2">
                                    <select name="death_district" class="form-control select2 district_selected" required id="district_selected-2">
                                        <option value="" selected>जिल्ला</option>
                                        <?php foreach($districts as $district) : ?>
                                        <option value="<?= $district->id ?>"
                                            <?php
                                                if(isset($result)&& $result->district == $district->id)
                                                {
                                                    echo 'selected="selected"';
                                                }
                                                elseif($district->name==$default[1])
                                                    {
                                                        echo 'selected="selected"';
                                                    }
                                            ?>
                                        ><?= $district->name?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-sm-2">
                                    <select name="death_local_body" class="form-control select2 local_body_selected" required id="local_body_selected-2">
                                        <option value="" selected>गा.वि.स./न.पा </option>
                                        <?php foreach($locals as $local) : ?>
                                        <option value="<?= $local->id ?>"
                                            <?php
                                                if(isset($result)&& $result->local_body == $local->id)
                                                {
                                                    echo 'selected="selected"';
                                                }
                                                elseif($local->name==$default[2])
                                                    {
                                                        echo 'selected="selected"';
                                                    }
                                            ?>
                                        ><?= $local->name?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="col-md-2 mb-sm-2">
                                    <select name="death_ward" class="form-control select2 ward_selected" required id="ward_selected-2">
                                        <option value="" selected>वडा नं</option>
                                        <?php foreach($wards as $ward) : ?>
                                        <option value="<?= $ward->id ?>"
                                            <?php
                                                if(isset($result)&& $result->ward == $ward->id)
                                                {
                                                    echo 'selected="selected"';
                                                }
                                                elseif($ward->id==$default[3])
                                                {
                                                        echo 'selected="selected"';
                                                }
                                            ?>
                                        ><?= $ward->name?></option>
                                        <?php endforeach;?>

                                    </select>
                                </div>

                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">
                                            <span class="float-right">
                                                नागरिकता नं
                                            </span>

                                    </label>

                                        <div class="col-sm-8">
                                            <input type="text" name="citizenship_no" maxlength="128" class="form-control" id="id_citizenship_no" value="<?= isset($result) ? $result->citizenship_no : ''?>" />
                                        </div>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">
                                            <span class="float-right">
                                                जारी मिति
                                            </span>

                                    </label>

                                    <div class="col-sm-8">
                                        <input type="text" name="citizenship_nep_date" maxlength="128" class="form-control" id="nepaliDate6"  value="<?= isset($result) ? $result->citizenship_nep_date : ''?>"/>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">
                                            <span class="float-right">
                                                जारी जिल्ला
                                            </span>

                                    </label>

                                    <div class="col-sm-8">
                                        <select name="citizenship_district" class="form-control select2">
                                            <option value="">छान्नुहोस्</option>
                                            <?php foreach($districts as $district):?>
                                                <option value="<?= $district->id?>"
                                                    <?php
                                                        if(!empty($result) && $result->citizenship_district == $district->id)
                                                        {
                                                            echo 'selected = "selected"';
                                                        }
                                                        elseif($district->name==$default[1])
                                                        {
                                                            echo 'selected="selected"';
                                                        }
                                                    ?>
                                                ><?= $district->name?></option>
                                            <?php endforeach;?>
                                        </select>
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
                                    <label>कागजातहरू <span class="text-danger">*</span> </label>
                                </div>

                                <div class="col-sm-9">
                                    <div class="mb-3 documents" id="doc_div_0">
                                       <input type="file" name="documents[]" id="documents_0" />
                                       <select name="documents_type[]" id="documents_type_0">
                                           <option value="">प्रकार छान्नुहोस्</option>

                                           <?php foreach($documents as $doc):?>
                                               <option value="<?= $doc->id?>"><?= $doc->name ?></option>
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
                                                   echo " </div>";
                                               }
                                           ?>
                                </div>
                            </div>

                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6 offset-sm-6 mt-4">
                        <button type="submit" class='btn btn-block btn-submit btn-primary' name="submit">पेश
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
function checkMyDate(date_selected, id_selected)
    {
      if(id_selected=="nepaliDate5")
      {
       var  nep_dob = date_selected;
//              alert(nep_dob);
                param = {};
                param.nep_dob = nep_dob;
                JQ.ajax({
                    url: "<?= base_url()?>getConvertedDate",
                    method: "POST",
                    data: param,
                    success: function (data) {
                        var obj = JSON.parse(data);
                        JQ("#id_eng_dob").val(obj.html);
                    },
                    error: function (error) {
                        console.log(JSON.stringify(error));
                    }
                });
            }
    }
</script>
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
