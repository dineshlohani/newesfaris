<?php
    if($this->uri->segment(2)== "create")
    {
    $action_page = "char-killa/create";
    }
    if($this->uri->segment(2)=="edit")
    {
    $action_page = "char-killa/edit/".$this->uri->segment(3);
    }
?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <?php if(!empty($this->session->flashdata('msg'))): ?>
                    <div  class="alert alert-success alert-dismissible" >    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span><?=$this->session->flashdata('msg');?></span></div>
                <?php endif; ?>
                <?php if(!empty($this->session->flashdata('err_msg'))): ?>
                    <div  class="alert alert-danger alert-dismissible" >    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span><?=$this->session->flashdata('err_msg');?></span></div>

                <?php endif; ?>
            </div>
        </div>
    <div class="container-fluid ">
        <nav aria-label="breadcrumb" class="bg-shadow">
            <ol class="breadcrumb px-3 py-2">
                <li class="breadcrumb-item ml-1"><a href="<?=base_url()?>">गृह</a></li>
                <li class="breadcrumb-item active"><a href="<?= base_url()?>char-killa">चार किल्ला प्रमाणित</a></li>
                <li class="breadcrumb-item active">नयाँ</li>
            </ol>
        </nav>
    </div>
        <?php echo form_open_multipart($action_page);?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label"><span
                                class="float-right">आबदेन दिएको मिती<span
                                    class="text-danger">&nbsp;*</span></span></label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                    <input type="text" name="nepali_date" class="form-control" id="nepaliDate4"  placeholder="YYYY-MM-DD" value="<?= isset($result->nepali_date)? $result->nepali_date : '' ?>" required />
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">
                        </label>
                        <div class="col-sm-6">
    
                        </div>
                    </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label">
              <span class="float-right">
                जग्गा धनिको नाम
                <span class="text-danger">&nbsp;*</span>
                <label class="col-md-6 col-form-label">
                                            <select name="gender_spec" class="form-control" id="gender_spec" style="margin-top: -15px; margin-left: 90px;" required>
                                            		<option selected>---Select---</option>
                                                    <option value="श्री
                                                    "
                                                    <?php if(!empty($result)){
                                                        if($result->gender_spec == 'श्री'){
                                                            echo 'selected';
                                                        } else {
                                                            echo '';
                                                        }
                                                    }
                                                    
                                                    ?>>श्री</option>
                                                    <option value="श्रीमती"
                                                    <?php if(!empty($result)){
                                                        if($result->gender_spec == 'श्रीमती'){
                                                            echo 'selected';
                                                        } else {
                                                            echo '';
                                                        }
                                                    }
                                                    
                                                    ?>
                                                    >श्रीमती</option>
                                                    <option value="सुश्री"
                                                    <?php if(!empty($result)){
                                                        if($result->gender_spec == 'सुश्री'){
                                                            echo 'selected';
                                                        } else {
                                                            echo '';
                                                        }
                                                    }
                                                    
                                                    ?>
                                                    
                                                    
                                                    >सुश्री</option>                        
                                            </select>
                                        </label>
              </span>
            </label>
                        <div class="col-sm-6">
                            <input type="text" name="applicant_name" class="form-control" id="id_applicant_name" value="<?= isset($result->applicant_name)? $result->applicant_name : '' ?>" required />
                        </div>
        </div>
                    <div class="form-group row">
            <label class="col-sm-4 col-form-label">
              <span class="float-right">
                नागरिकता नं 
                <span class="text-danger">&nbsp;*</span>
              </span>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" name="cit_no" class="form-control" id="cit_no" value="<?= isset($result->applicant_name)? $result->cit_no : '' ?>" required />
                        </div>
                    </div>
                    <div class="form-group row">
            <label class="col-sm-4 col-form-label">
              <span class="float-right">
                सम्पर्क नं 
                <span class="text-danger">&nbsp;*</span>
              </span>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" name="con_no" class="form-control" id="con_no" value="<?= isset($result->applicant_name)? $result->con_no : '' ?>" required />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label mt-2"><span
                                class="float-right">स्थाई ठेगाना<span class="text-danger">&nbsp;*</span></span></label>
                        <div class="col-sm-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td><select name="s_state" class="form-control select2 state_selected" id="state_selected-1" required>
                                            <option value="" selected>प्रदेश</option>
                                         <?php
                                            foreach($states as $state)
                                            {
                                        ?>
                                                <option value="<?=$state->id ?>"
                                                    <?php
                                                        if(isset($result->state) && $result->state == $state->id)
                                                        {
                                                            echo "selected = 'selected'";
                                                        }
                                                        elseif($state->id==$default[0])
                                                        {
                                                            echo 'selected="selected"';
                                                        }
                                                    ?>
                                                ><?= $state->name ?></option>
                                        <?php
                                            }
                                        ?>
                                        </select></td>
                                    <td><select name="s_district" class="form-control select2 district_selected" id="district_selected-1" required>
                                            <option value="" selected>जिल्ला</option>
                                        <?php
                                            foreach($districts as $district) {
                                        ?>
                                                <option value="<?= $district->id ?>"
                                                    <?php
                                                        if(isset($result->district) && $result->district == $district->id)
                                                        {
                                                            echo "selected = 'selected'";
                                                        }
                                                        elseif($district->name==$default[1])
                                                            {
                                                                echo 'selected="selected"';
                                                            }
                                                    ?>
                                                ><?= $district->name ?></option>
                                        <?php
                                            }
                                        ?>
                                        </select></td>
                                    <td><select name="s_local_body" class="form-control select2 local_body_selected" id="local_body_selected-1" required>
                                            <option value="" selected>गा.वि.स./न.पा </option>
                                        <?php
                                            foreach($locals as $local) {
                                        ?>
                                                <option value="<?= $local->id ?>"
                                                    <?php
                                                        if(isset($result->local_body) && $result->local_body == $local->id)
                                                        {
                                                            echo "selected = 'selected'";
                                                        }
                                                        elseif($local->name==$default[2])
                                                            {
                                                                echo 'selected="selected"';
                                                            }
                                                    ?>
                                                ><?= $local->name?></option>
                                        <?php
                                            }
                                        ?>
                                        </select></td>
                                    <td>
                                        <select name="s_ward" class="form-control select2 ward_selected" id="ward_selected-1" required>
                                            <option value="" selected>वडा नं</option>
                                      <?php
                                            foreach($wards as $ward) {
                                      ?>
                                                <option value="<?= $ward->id ?>"
                                                    <?php
                                                        if(isset($result->ward) && $result->ward == $ward->id)
                                                        {
                                                            echo "selected = 'selected'";
                                                        }
                                                        elseif($ward->id==$default[3])
                                                        {
                                                                echo 'selected="selected"';
                                                        }
                                                    ?>
                                                ><?= $ward->name ?></option>
                                      <?php
                                            }
                                      ?>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label mt-2"><span
                                class="float-right">ठेगाना<span class="text-danger">&nbsp;*</span></span></label>
                        <div class="col-sm-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td><select name="state" class="form-control select2 state_selected" id="state_selected-1" required>
                                            <option value="" selected>प्रदेश</option>
                                         <?php
                                            foreach($states as $state)
                                            {
                                        ?>
                                                <option value="<?=$state->id ?>"
                                                    <?php
                                                        if(isset($result->state) && $result->state == $state->id)
                                                        {
                                                            echo "selected = 'selected'";
                                                        }
                                                        elseif($state->id==$default[0])
                                                        {
                                                            echo 'selected="selected"';
                                                        }
                                                    ?>
                                                ><?= $state->name ?></option>
                                        <?php
                                            }
                                        ?>
                                        </select></td>
                                    <td><select name="district" class="form-control select2 district_selected" id="district_selected-1" required>
                                            <option value="" selected>जिल्ला</option>
                                        <?php
                                            foreach($districts as $district) {
                                        ?>
                                                <option value="<?= $district->id ?>"
                                                    <?php
                                                        if(isset($result->district) && $result->district == $district->id)
                                                        {
                                                            echo "selected = 'selected'";
                                                        }
                                                        elseif($district->name==$default[1])
                                                            {
                                                                echo 'selected="selected"';
                                                            }
                                                    ?>
                                                ><?= $district->name ?></option>
                                        <?php
                                            }
                                        ?>
                                        </select></td>
                                    <td><select name="local_body" class="form-control select2 local_body_selected" id="local_body_selected-1" required>
                                            <option value="" selected>गा.वि.स./न.पा </option>
                                        <?php
                                            foreach($locals as $local) {
                                        ?>
                                                <option value="<?= $local->id ?>"
                                                    <?php
                                                        if(isset($result->local_body) && $result->local_body == $local->id)
                                                        {
                                                            echo "selected = 'selected'";
                                                        }
                                                        elseif($local->name==$default[2])
                                                            {
                                                                echo 'selected="selected"';
                                                            }
                                                    ?>
                                                ><?= $local->name?></option>
                                        <?php
                                            }
                                        ?>
                                        </select></td>
                                    <td>
                                        <select name="ward" class="form-control select2 ward_selected" id="ward_selected-1" required>
                                            <option value="" selected>वडा नं</option>
                                      <?php
                                            foreach($wards as $ward) {
                                      ?>
                                                <option value="<?= $ward->id ?>"
                                                    <?php
                                                        if(isset($result->ward) && $result->ward == $ward->id)
                                                        {
                                                            echo "selected = 'selected'";
                                                        }
                                                        elseif($ward->id==$default[3])
                                                        {
                                                                echo 'selected="selected"';
                                                        }
                                                    ?>
                                                ><?= $ward->name ?></option>
                                      <?php
                                            }
                                      ?>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="my-4">
            <div class="col-md-12">
                <div class="text-center">
                    <label for="terai" style="font-size:17px"><b>तराई</b></label>
                    <input type="radio" name="land_type" value="terai" <?= (isset($result) && $result->land_type =="terai") ? 'checked' : 'checked'; ?>>
                    <label for="hill" style="font-size:17px"><b>पहाड</b></label>
                    <input type="radio" name="land_type" id="hill" value="hill" <?= (isset($result) && $result->land_type =="hill") ? 'checked' : ''; ?>>
                </div>
            </div>
                <div class="table-responsive">
                <table class="table form-table table-bordered table-sm table-responsive">
                   <thead class="text-center">
                        <tr>
                            <td rowspan="3" style="width: 5%;">साबिक गा बि स / न पा</td>
                            <td rowspan="3">हाल गा बि स / न पा</td>
                            <td <?= (isset($result) && $result->land_type=="hill") ? 'colspan="6"' : 'colspan="5"'?> id="land_desc">जग्गाको विवरण</td>
                            <td rowspan="3">बाटो</td>
                            <td rowspan="3">बाटोको प्रकार</td>
                            <td colspan="4"> चार किल्ला</td>
                            <td rowspan="3">कैफियत</td>
                            <td rowspan="3"></td>
                        </tr>
                        <tr>
                            <td rowspan="2">नक्सा सिट नं</td>
                            <td rowspan="2">कि.नं</td>
                            <td <?= (isset($result) && $result->land_type=="hill") ? 'colspan="4"' : 'colspan="3"'?> id="land_area">क्षेत्रफल</td>
                            <td rowspan="2">पुर्ब</td>
                            <td rowspan="2">पश्चिम</td>
                            <td rowspan="2">उत्तर</td>
                            <td rowspan="2">दक्षिण</td>
                        </tr>
                        <tr>
                            <?php if(isset($result) && $result->land_type =="hill"):?>
                                <td id="biggha_span">रोपनी</td>
                                <td id="kattha_span">आना</td>
                                <td id="dhur_span">दाम</td>
                                <td class="paisa_div">पैसा</td>
                            <?php else: ?>
                                <td id="biggha_span">बिग्घा</td>
                                <td id="kattha_span">कट्ठा</td>
                                <td class="paisa_div" style="display:none;">पैसा</td>
                                <td id="dhur_span">धुर</td>
                                
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(isset($result))
                            {
                                $path           = base_url()."assets/documents/home/char_killa/";
                                $i = 0;
                    foreach($land_details as $details)
                                {
                        ?>
                        <tr <?php if($i!=1){ ?>class="item" id="item-<?=$i?>"<?php } ?>>
                             <td>
                                <select name="old_address[]" class="formset-field old-place" id="old_address-1" >
                                    <option value="" selected>छान्नुहोस्</option>
                                    <?php foreach($old_address as $add){?>
                                    <option value="<?=$add->id?>" <?php if($details->old_address==$add->id){ echo 'selected="selected"';}?>><?=$add->name?></option>
                                    <?php }?>
                                </select>
                            </td>
                            <td>
                                <input type="text" name="new_address[]" value="<?=$details->new_address?>" id="new_address-<?=$i?>" readonly="true" class="new-name formset-field">
                            </td>
                            <td>
                                <input type="text" name="map_sheet_no[]" value="<?=$details->map_sheet_no?>" maxlength="16" class="formset-field map-sheet-no" id="map_sheet_no-<?=$i?>" />
                            </td>
                            <td>
                                <input type="text" name="kitta_no[]" value="<?=$details->kitta_no?>" maxlength="16" class="formset-field kitta-no" id="kitta_no-<?=$i?>" />
                            </td>
                            <td>
                                <input type="number" name="biggha[]" value="<?=$details->biggha?>" class="formset-field biggha" id="biggha-<?=$i?>" min="0" />
                            </td>
                            <td>
                                <input type="number" name="kattha[]" value="<?=$details->kattha?>"  class="formset-field kattha" id="kattha-<?=$i?>" min="0" max="20" />
                            </td>
                            <td>
                                <input type="number" name="dhur[]" value="<?=$details->dhur?>" class="formset-field dhur" id="dhur-<?=$i?>" min="0" max="20" />
                            </td>
                            <td class="paisa_div" <?= (isset($result) && $result->land_type=="terai") ? 'style="display:none;"' : ''?> >
                                <input type="number" name="paisa[]" value="<?=$details->paisa?>" class="formset-field paisa" id="paisa-<?=$i?>" min="0" max="20"  />
                            </td>
                            <td>
                                <input type="checkbox" name="road[]" value="1" <?php if($details->road==1){ echo 'checked="checked"';}?> class="formset-field road-checkbox" id="road-<?=$i?>" />
                            </td>
                            <td>
                                <select name="road_type[]" class="formset-field  road-type"  id="road_type-<?=$i?>">
                                    <option value="" selected>छान्नुहोस्</option>
                                <?php foreach($road_type as $data){?>
                                    <option value="<?=$data->id?>" <?php if($details->road_type==$data->id){ echo 'selected="selected"';}?>><?=$data->name?></option>
                                <?php } ?>
                                </select>
                            </td>
                            <td>
                                <input type="text" name="east_piller[]" value="<?=$details->east_piller?>" maxlength="132" class="east-piller formset-field" id="east_piller-<?=$i?>" />
                            </td>
                            <td>
                                <input type="text" name="west_piller[]" value="<?=$details->west_piller?>" maxlength="132" class="formset-field west-piller" id="west_piller-<?=$i?>" />
                            </td>
                            <td>
                                <input type="text" name="north_piller[]" value="<?=$details->north_piller?>" maxlength="132" class="formset-field north-piller" id="north_piller-<?=$i?>" />
                            </td>
                            <td>
                                <input type="text" name="south_piller[]" value="<?=$details->south_piller?>" maxlength="132" class="formset-field south-piller" id="south_piller-<?=$i?>" />
                            </td>

                            <td>
                                <textarea name="description[]" cols="15"  maxlength="264" class=""  rows="2"><?=$details->description?></textarea>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm remove"
                                        id="details-<?=$i?>">
                                   <i class="fa fa-minus"></i>
                                </button>
                            </td>
                        </tr>
                        <?php
                                    $i++;
                                }
                            }
                            else
                            {
                        ?>
                        <tr>
                             <td>
                                <select name="old_address[]" class="formset-field old-place" id="old_address-1">
                                    <option value="" selected>छान्नुहोस्</option>
                                    <?php foreach($old_address as $add){?>
                                    <option value="<?=$add->id?>"><?=$add->name?></option>
                                    <?php }?>
                                </select>
                            </td>
                            <td>
                                <input type="text" name="new_address[]" id="new_address-1" readonly="true" class="new-name formset-field">
                            </td>
                            <td>
                                <input type="text" name="map_sheet_no[]" maxlength="16" class="formset-field map-sheet-no" id="map_sheet_no-1" />
                            </td>
                            <td>
                                <input type="text" name="kitta_no[]" maxlength="16" class="formset-field kitta-no" id="kitta_no-1" />
                            </td>
                            <td>
                                <input type="number" name="biggha[]" value="0" class=" formset-field biggha" id="biggha-1" min="0" />
                            </td>
                            <td>
                                <input type="number" name="kattha[]" value="0" class=" formset-field kattha" id="kattha-1" min="0" max="20" />
                            </td>
                            <td>
                                <input type="number" name="dhur[]" value="0" class=" formset-field dhur" id="dhur-1" min="0" max="20" />
                            </td>
                            <td class="paisa_div" style="display:none;">
                                <input type="number" name="paisa[]" value="0" class=" formset-field paisa" id="paisa-1" min="0" max="4"  />
                            </td>
                            <td>
                                <input type="checkbox" name="road[]" value="1" class="formset-field road-checkbox" id="road-1" />
                            </td>
                            <td>
                                <select name="road_type[]" class="formset-field  road-type" disabled id="road_type-1">
                                    <option value="" selected>छान्नुहोस्</option>
                                <?php foreach($road_type as $data){?>
                                    <option value="<?=$data->id?>"><?=$data->name?></option>
                                <?php } ?>
                                </select>
                            </td>
                            <td>
                                <input type="text" name="east_piller[]" maxlength="132" class="east-piller formset-field" id="east_piller-1" />
                            </td>
                            <td>
                                <input type="text" name="west_piller[]" maxlength="132" class=" formset-field west-piller" id="west_piller-1" />
                            </td>
                            <td>
                                <input type="text" name="north_piller[]" maxlength="132" class=" formset-field north-piller" id="north_piller-1" />
                            </td>
                            <td>
                                <input type="text" name="south_piller[]" maxlength="132" class="formset-field south-piller" id="south_piller-1" />
                            </td>

                            <td>
                                <textarea name="description[]" cols="15" maxlength="264" class="formset-field" id="description-1" rows="2">
                            </textarea>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm remove"
                                      id="details-1"  >
                                     <i class="fa fa-minus"></i>
                                </button>
                            </td>
                        </tr>
                    <?php
                        }
                    ?>
                    <tbody id="adddiv">

                    </tbody>
                    <tr>
                        <td colspan="9"
                            style="border-left: none!important; border-right: none !important; border-bottom: none!important;">
                            <button id="add_more" type="button" class="btn btn-sm btn-success add_more">
                                <i class="fa fa-plus"></i>
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <hr class="mt-5 mb-4">
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
                                    if(isset($result->document) && !empty($result->document))
                                    {
                                        $document   = explode("+",$result->document);
                                        echo "<br/><br/><h6>कागजातहरु</h6>";
                                        foreach($document as $doc)
                                        {
                                            echo "<a href='".$path.$doc."' target='_blank'>".$doc."</a><br/>";
                                        }
                                    }
                                ?>
                        </div>
                        </div>
                    </div>
                </div><hr class="mt-5 mb-4">
            </div>
            <div class="form-group row">
                       <div class="col-lg-6 offset-lg-6">
                           <div class="row">
                       <span class="col-sm-8 offset-sm-4">
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
<script src="<?=base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<script>
    var JQ = jQuery.noConflict();
    JQ(document).ready(function() {
            JQ(document).on("click", ".add_more", function (){
                //alert("alert");
                var land_type = JQ("input[name=land_type]:checked").val();
                var  count = JQ(".item").length;
                param = {};
                param.count = count;
                param.land_type = land_type;
                JQ.ajax({
                    url: "<?= base_url()?>getCharKillaHTML",
                    method: "POST",
                    data: param,
                    success: function (data) {
                        var obj = JSON.parse(data);
                        JQ("#adddiv").append(obj.html);
                    },
                    error: function (error) {
                        console.log(JSON.stringify(error));
                    }
                });
            });
    JQ(document).on("click", ".remove", function () {
//            alert("here");
        var id_selected = JQ(this).attr("id");
        var res = id_selected.split("-");
        var id  = res[res.length - 1];
        JQ("#item-"+id).remove();
    });
  JQ(document).on("change","select[name^='old_address[]']", function (){
                var id_selected = JQ(this).attr("id");
                var res = id_selected.split("-");
                var counter  = res[res.length - 1];
                var id = JQ(this).val();
                param = {};
                param.counter = counter;
                param.id = id;
                JQ.ajax({
                    url: "<?= base_url()?>getOldNew",
                    method: "POST",
                    data: param,
                    success: function (data) {
                        var obj = JSON.parse(data);
//                        alert(counter);return false;
                        JQ("#new_address-"+counter).val(obj.html);
                    },
                    error: function (error) {
                        console.log(JSON.stringify(error));
                    }
                });
            });
JQ(document).on("click","input[name*='road[]']", function () {
        var id_selected = JQ(this).attr("id");
        var res = id_selected.split("-");
        var id  = res[res.length - 1];
        if ($("#road-"+id).is(":checked"))
        {
           JQ("#road_type-"+id).prop('disabled', false);
        }
        else
        {
            JQ("#road_type-"+id).prop('disabled', 'disabled');
        }
    });
        JQ(document).on("click", "#documents", function (){
            //alert("alert");
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
