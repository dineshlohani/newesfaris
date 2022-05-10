<?php
    if($this->uri->segment(2)== "create")
    {
    $action_page = "antarik-basai-sarai/create"; }
    if($this->uri->segment(2)=="edit")
    {
    $action_page = "antarik-basai-sarai/edit/".$this->uri->segment(3);
    }
    if(!empty($result->documents))
    {
        $documents      = explode("+",$result->documents);

    }
    $path           = base_url()."assets/documents/settlement/antarik_basaisarai/";
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


                            <li class="breadcrumb-item"><a href="<?= base_url()?>antarik-basai-sarai"> आन्तरिक बसाई सराई </a></li>

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



            <?php echo form_open_multipart($action_page); ?>
            <div class="row">
                    <div class="col-md-6 offset-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label"><span
                                    class="float-right">आवेदन गरिएको मिति<span
                                    class="text-danger">&nbsp;*</span></span></label>


                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="text" name="nepali_date" maxlength="10" class="form-control" required id="nepaliDate4"  value="<?= isset($result) ? $result->nepali_date : DateEngToNep(date('Y-m-d'))?>"/>
                                    </div>
                                </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <h4>
                            आबदेकको विवरण
                        </h4>
                        <hr style="border: 1px solid #adadad">
                    </div>

                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label" style="margin-left: 55px">
                                            <span class="float-right">
                                                नाम<span class="text-danger">&nbsp;* 
                                                </span>
                                            </span>
                                    </label>
                                    <label class="col-md-4 col-form-label" style="margin-left: -1px;">
                                    <div class="col-sm-38">
                                    <select name="gender_spec" class="form-control" id="gender_spec" required>
                                                    <option selected>---Select---</option>
                                                    <option value="श्री" >श्री</option>
                                                    <option value="सुश्री" >सुश्री</option>                        
                                                    <option value="श्रीमती" >श्रीमती</option>
                                    </select>
                                    </div>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                
                                        <div class="col-sm-8">
                                            <input type="text" name="applicant_name" maxlength="128" class="form-control" required id="id_applicant_name" value="<?= isset($result) ? $result->applicant_name : ''?>"  />
                                        </div>
                                    
                            </div>
                          <div class="col-md-4">
                              <div class="form-group row">
                                    <label class="col-md-4 col-form-label">
                                            <span class="float-right">
                                                नागरिकता नं <span class="text-danger">&nbsp;*</span>
                                            </span>

                                    </label>
                                    <div class="col-sm-8">
                                            <input type="text" name="cit_no" maxlength="128" class="form-control" required id="cit_no" value="<?= isset($result) ? $result->cit_no : ''?>" />
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
                                                सम्पर्क नं <span class="text-danger">&nbsp;*</span>
                                            </span>

                                    </label>
                                    <div class="col-sm-8">
                                            <input type="text" name="con_no" maxlength="128" class="form-control" required id="con_no" value="<?= isset($result) ? $result->con_no : ''?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">
                                            <span class="float-right">
                                                पुरानो स्थानमा बसोबास गर्न <br> थालेको मिति<span class="text-danger">&nbsp;*</span>
                                            </span>

                                    </label>

                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input type="text" name="from_nepali_date" maxlength="10" class="form-control" required id="nepaliDate5" value="<?= isset($result) ? $result->from_nepali_date : ''?>"/>
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
                                            <input type="text" name="mother_name" maxlength="128" class="form-control" required id="id_mother_name" value="<?= isset($result) ? $result->mother_name : ''?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">
                                            <span class="float-right">
                                                पुरानो ठेगाना<span class="text-danger">&nbsp;*</span>
                                            </span>

                            </label>

                                <div class="col-md-2 mb-sm-2">
                                    <select name="old_state" class="form-control select2 state_selected" required id="state_selected-1">
                                      <option value="" selected>प्रदेश</option>
                                        <?php foreach($states as $state): ?>
                                            <option value="<?= $state->id?>"
                                                <?php
                                                    if(isset($result) && $state->id == $result->old_state)
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
                                <div class="col-md-2 mb-sm-2">
                                    <select name="old_district" class="form-control select2 district_selected" required id="district_selected-1">
                                      <option value="" selected>जिल्ला</option>
                                      <?php foreach($districts as $district): ?>
                                          <option value="<?= $district->id?>"
                                              <?php
                                                  if(isset($result) && $district->id == $result->old_district)
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
                                    <select name="old_local_body" class="form-control select2 local_body_selected" required id="local_body_selected-1">
                                      <option value="" selected>गा.वि.स./न.पा </option>
                                      <?php foreach($locals as $local): ?>
                                          <option value="<?= $local->id?>"
                                              <?php
                                                  if(isset($result) && $local->id == $result->old_local_body)
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
                                <div class="col-md-1 mb-sm-2">
                                    <select name="old_ward" class="form-control select2 ward_selected" required id="ward_selected-1">
                                      <option value="" selected>वडा नं</option>
                                      <?php foreach($wards as $ward): ?>
                                          <option value="<?= $ward->id?>"
                                              <?php
                                                  if(isset($result) && $ward->id == $result->old_ward)
                                                  {
                                                      echo 'selected= "selected"';
                                                  }elseif($ward->id==$default[3])
                                                  {
                                                          echo 'selected="selected"';
                                                  }
                                              ?>
                                          ><?= $ward->name ?></option>
                                      <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="col-md-2 mb-sm-2">
                                    <input type="text" name="old_tole" class='form-control' value="<?= isset($result) ? $result->old_tole : ''?>" placeholder="टोल">
                                </div>

                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">
                                <span class="float-right">
                                    हालको ठेगाना<span class="text-danger">&nbsp;*</span>
                                </span>

                            </label>

                                <div class="col-md-2 mb-sm-2">
                                    <select name="present_state" class="form-control select2 state_selected" required id="state_selected-2">
                                      <option value="" selected>प्रदेश</option>
                                      <?php foreach($states as $state): ?>
                                          <option value="<?= $state->id?>"
                                              <?php
                                                  if(isset($result) && $state->id == $result->present_state)
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
                                <div class="col-md-2 mb-sm-2">
                                <select name="present_district" class="form-control select2 district_selected" required id="district_selected-2">
                                  <option value="" selected>जिल्ला</option>
                                  <?php foreach($districts as $district): ?>
                                      <option value="<?= $district->id?>"
                                          <?php
                                              if(isset($result) && $district->id == $result->present_district)
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
                                    <select name="present_local_body" class="form-control select2 local_body_selected" required id="local_body_selected-2">
                                      <option value="" selected>गा.वि.स./न.पा </option>
                                      <?php foreach($locals as $local): ?>
                                          <option value="<?= $local->id?>"
                                              <?php
                                                  if(isset($result) && $local->id == $result->present_local_body)
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
                                <div class="col-md-1 mb-sm-2">
                                    <select name="present_ward" class="form-control select2 ward_selected" required id="ward_selected-2">
                                      <option value="" selected>वडा नं</option>
                                      <?php foreach($wards as $ward): ?>
                                          <option value="<?= $ward->id?>"
                                              <?php
                                                  if(isset($result) && $ward->id == $result->present_ward)
                                                  {
                                                      echo 'selected= "selected"';
                                                  }elseif($ward->id==$default[3])
                                                  {
                                                          echo 'selected="selected"';
                                                  }
                                              ?>
                                          ><?= $ward->name ?></option>
                                      <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="col-md-2 mb-sm-2">
                                    <input type="text" name="present_tole" class='form-control' value="<?= isset($result) ? $result->present_tole : ''?>" placeholder="टोल">
                                </div>
                        </div>
                    </div>

                </div>
                <div class="row mt-3">
                    <div class="col-md-12 mb-3">
                        <h4>
                            परिवारको विवरण
                        </h4>
                        <hr style="border: 1px solid #adadad">
                    </div>

                    <div class="table-responsive col-md-12">

                        <table class="table form-table table-bordered table-sm">
                            <thead class="text-center">
                            <tr>
                                <th>नाम</th>
                                <th>नाता</th>
                                <th>ना.प्र.नं / <br> जन्मदर्ता नं</th>
                                <th>घर नं</th>
                                <th>बाटोको नाम</th>
                                <th>उमेर</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                if(isset($result))
                                {
                                    $i = 0;
                                    $total_form = count($details);
                                    foreach($details as $data) :
                            ?>
                                <tr class="item" id="item_<?= $i?>">
                                    <td>
                                        <input type="text" name="name_<?= $i ?>" maxlength="120" class="form-control formset-field" id="id_details-<?=$i?>-name" required value="<?= $data->name ?>" />
                                    </td>
                                    <td>
                                        <select name="relation_<?= $i?>" class="form-control select2" required>
                                            <option value="">छान्नुहोस्</option>
                                            <?php foreach($relations as $relation): ?>
                                                <option value="<?= $relation->id ?>"
                                                    <?php if($data->relation == $relation->id){ echo 'selected="selected"';}?>
                                                ><?= $relation->name ?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="citizenship_no_<?=$i?>" maxlength="32" class="form-control formset-field" id="id_details-<?=$i?>-citizenship_no" value="<?= $data->citizenship_no?>" />
                                    </td>
                                    <td><input type="text" name="ghar_no_<?=$i?>" maxlength="16" class="form-control formset-field" id="id_details-<?=$i?>-ghar_no" value="<?= $data->ghar_no ?>" /></td>
                                    <td><input type="text" name="road_name_<?=$i?>" maxlength="128" class="form-control formset-field" id="id_details-<?=$i?>-road_name" value="<?= $data->road_name ?>" /></td>
                                    <td><input type="number" name="age_<?=$i?>" class="form-control formset-field" id="id_details-0-age" min="1" required  value="<?= $data->age ?>"/></td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm remove"
                                                id="remove_0">
                                                <i class="fa fa-minus"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php
                                    $i++;
                                    endforeach;
                                }
                                else
                                {
                            ?>
                                    <tr class="item" id="item_0">
                                        <td>
                                            <input type="text" name="name_0" maxlength="120" class="form-control formset-field" id="id_details-0-name" required />
                                        </td>
                                        <td>
                                            <select name="relation_0" class="form-control select2" required>
                                                <option value="">छान्नुहोस्</option>
                                                <?php foreach($relations as $relation): ?>
                                                    <option value="<?= $relation->id ?>"><?= $relation->name ?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" name="citizenship_no_0" maxlength="32" class="form-control formset-field" id="id_details-0-citizenship_no" />
                                        </td>
                                        <td><input type="text" name="ghar_no_0" maxlength="16" class="form-control formset-field" id="id_details-0-ghar_no" /></td>
                                        <td><input type="text" name="road_name_0" maxlength="128" class="form-control formset-field" id="id_details-0-road_name" /></td>
                                        <td><input type="number" name="age_0" class="form-control formset-field" id="id_details-0-age" min="1" required /></td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm remove"
                                                    id="remove_0">
                                                    <i class="fa fa-minus"></i>
                                            </button>
                                        </td>
                                    </tr>
                            <?php
                                }
                            ?>
                                <tbody id="form_div"></tbody>
                            <tr>
                                <td colspan="9" style="border-left: none!important; border-right: none !important; border-bottom: none!important;">
                                    <input type="text" name="total_forms" id="total_forms" value="<?= isset($result) ? $total_form : 1 ?>" hidden>
                                    <button type="button" class="btn btn-sm btn-success add" id="add">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
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

                </div><hr class="mt-5 mb-4">

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

    var JQ = jQuery.noConflict();
    JQ(document).ready(function() {
        JQ(document).on("click", "#add", function (){
            var  count = JQ(".item").length;
            param = {};
            param.count = count;
            JQ.ajax({
                url: "<?= base_url()?>getAntarikBasaiSaraiHTML",
                method: "POST",
                data: param,
                success: function (data) {
                    var obj = JSON.parse(data);
                    JQ("#total_forms").val(count + 1);
                    JQ("#form_div").append(obj.html);

                },
                error: function (error) {
                    console.log(JSON.stringify(error));
                }
            });
        });
        JQ(document).on("click", ".remove", function () {
            var id_selected     = JQ(this).attr("id");
            var res             = id_selected.split("_");
            var id              = res[res.length - 1];
            JQ("#item_"+id).remove();
        });

        JQ(document).on("click", "#documents", function (){
            var  count = JQ(".documents").length;
            param = {};
            param.count = count;
            param.patra_id = <?= $patra_id?>;
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
