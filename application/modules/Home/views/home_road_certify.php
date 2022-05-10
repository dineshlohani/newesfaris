<?php
    if($this->uri->segment(2)== "create")
    {
    $action_page = "home-road-certify/create";
    }
    if($this->uri->segment(2)=="edit")
    {
    $action_page = "home-road-certify/edit/".$this->uri->segment(3);
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


                <li class="breadcrumb-item active"><a href="<?= base_url()?>home-road-certify">घर बाटो प्रमाणित</a></li>

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
                                <input type="text" name="nepali_date" class="form-control" id="nepaliDate4" maxlength="10" placeholder="YYYY-MM-DD" required />
                            </div>
                        </div>

                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">
              <span class="float-right">
                कार्यालय
                <span class="text-danger">&nbsp;*</span>
              </span>
                        </label>

                        <div class="col-sm-6">
                            <select name="office" class="form-control" id="id_office" required>
                                <option value="" selected>कार्यालय छान्नुहोस्</option>
                                 <?php
                                    foreach($offices as $office)
                                    {
                                 ?>
                                        <option value="<?= $office->id ?>"
                                            <?php
                                                if(isset($result->office) && $result->office == $office->id)
                                                {
                                                    echo "selected = 'selected'";
                                                }
                                            ?>
                                        ><?= $office->name ?></option>
                                 <?php
                                    }
                                 ?>
                            </select>
                        </div>

                    </div>
                    
                    
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">
                          <span class="float-right">
                            जग्गा धनिको नाम
                            <span class="text-danger">&nbsp;* </span>
                          </span>
                        </label>
                        <div class="col-md-1">
                            <select name="gender_spec" class="form-control" id="gender_spec" required>
                                <option value="श्री">श्री</option>
                                <option value="सुश्री" >सुश्री</option>                        
                                <option value="श्रीमती">श्रीमती</option>
                            </select>
                        </div>
                        <div class="col-sm-5">
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
                            <input type="text" name="cit_no" class="form-control" id="cit_no" value="<?= isset($result->cit_no)? $result->cit_no : '' ?>" required />
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
                            <input type="text" name="con_no" class="form-control" id="con_no" value="<?= isset($result->con_no)? $result->con_no : '' ?>"/>
                        </div>

                    </div>


                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label mt-2"><span
                                class="float-right">ठेगाना<span class="text-danger">&nbsp;*</span></span></label>

                        <div class="col-sm-8">
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
                                    <td><select name="district" class="form-control select2 district_selected" id="district_selected-1" required style="width:150px;">
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
                                        <select name="ward" class="form-control select2" id="id_ward_no" required>
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
                <table class="table form-table table-bordered table-sm">
                    <thead class="text-center">
                    <tr>
                        <td rowspan="5" style="width: 178px;">साबिक गा.बि.स/न.पा</td>
                       
                        <td rowspan="3">हाल गा.बि.स/न.पा</td>
                       <td rowspan = "3">जग्गाको किसिम/वर्ग</td>
                        <td <?= (isset($result) && $result->land_type=="hill") ? 'colspan="6"' : 'colspan="5"'?> id="land_desc">जग्गाको विवरण</td>
                        <td rowspan="3">घर</td>
                        <td rowspan="3">घरको प्रकार</td>
                        <td rowspan="3">अनुमानित मुल्य</td>
                        <td rowspan="3">बाटो</td>
                        <td rowspan="3">बाटोको प्रकार</td>
                        <td rowspan="3">कैफियत</td>
                        <td rowspan="3"></td>
                    </tr>
                    <tr>
                    
                        <td rowspan="2">नक्सा सि.नं</td>
                        <td rowspan="2">कि.नं</td>
                        <td <?= (isset($result) && $result->land_type=="hill") ? 'colspan="4"' : 'colspan="3"'?>id="land_area">क्षेत्रफल</td>
                    </tr>
                    <tr>
                        <?php if(isset($result) && $result->land_type =="hill"):?>
                            <td id="biggha_span">रोपनी</td>
                            <td id="kattha_span">आना</td>
                            
                            <td id="dhur_span">दाम</td>
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
                                $path           = base_url()."assets/documents/home/road/";
                                $i = 0;
                                foreach($land_details as $details)
                                {
                        ?>
                        <tr class="item" id="item-<?=$i?>">
                            <td style="width:178px;">
                                <select name="old_new_address[]" class="select2 old-place" id="old_new_address_<?=$i?>">
                                    <option value="" selected>छान्नुहोस्</option>
                                <?php
                                    foreach($addresses as $address) {
                                ?>
                                    <option value="<?= $address->id ?>"
                                        <?php
                                            if($details->old_new_address == $address->id)
                                            {
                                                echo "selected='selected'";
                                            }
                                        ?>
                                    ><?= $address->name ?></option>
                                <?php
                                    }
                                ?>


                                </select>
                            </td>
                         
                            <td>
                                <input type="text" id="new_place_<?=$i?>" disabled class="form-control new-name">
                            </td>
                               <td>
                                <select name ="land_category"  class="select2 form-control" id="land_category_<?=$i?>">
                                   <?php
                                if(!empty($land_types)):
                                    print_r($land_types);
                                    foreach($land_types as $type) {
                                ?>
                                    <option value="<?= $type->id ?>"
                                      
                                    <?php if($type->id == $details->land_area_type){echo 'selected';}?>><?= $type->category ?></option>
                                <?php
                                    } endif;
                                ?>
                                </select>
                            </td>
                            <td>
                                <input type="text" name="map_sheet_no[]" class="formset-field map-sheet-no" id="map_sheet_no_<?=$i?>" maxlength="32" value="<?= $details->map_sheet_no?>" />
                            </td>
                            <td>
                                <input type="text" name="kitta_no[]" class=" formset-field kitta-no" id="kitta_no_<?=$i?>" maxlength="32" value="<?= $details->kitta_no?>" />
                            </td>
                            <td>
                                <input type="number" name="biggha[]" class="formset-field biggha" min="0" id="biggha_<?=$i?>" value="<?= $details->biggha?>" />
                            </td>
                            <td>
                                <input type="number" name="kattha[]" class="formset-field kattha" min="0" max="20" id="kattha_<?=$i?>"  value="<?= $details->kattha?>"/>
                            </td>
                            <td>
                                <input type="number" name="dhur[]" class="formset-field dhur" min="0" max="20" id="dhur_<?=$i?>" value="<?= $details->dhur?>"/>
                            </td>
                            <td class="paisa_div" <?= (isset($result) && $result->land_type=="terai") ? 'style="display:none;"' : ''?> >
                                <input type="number" name="paisa[]" value="<?=$details->paisa?>" class="formset-field paisa" id="paisa-<?=$i?>" min="0" max="20"  />
                            </td>
                            <td>
                                <input type="checkbox" value="1" class="formset-field home-checkbox" id="home_check_<?=$i?>" <?= $details->home == 1 ? "checked='checked'" : ""?>  />
                                <input type="hidden" name="home[]" value="1" class="formset-field " id="home_<?=$i?>" value="<?=$details->home?>"  />
                            </td>
                            <td>
                                <select name="home_type_<?= $i ?>" class="formset-field home-type" <?= $details->home != 1 ? "disabled" :"" ?> id="home_type_<?=$i?>">
                                   


                                <?php
                                    foreach($home_types as $type) {
                                ?>
                                        <option value="<?= $type->id ?>"
                                            <?php
                                                if($details->home_type==$type->id && $details->home == 1)
                                                {
                                                    echo "selected= 'selected'";
                                                }
                                            ?>
                                        > <?= $type->name ?></option>
                                <?php
                                    }
                                ?>

                                </select>
                            </td>
                            <td>
                                <input type="number" name="estimated_cost_<?=$i?>" class="estimated-cost" <?= $details->home != 1 ? "disabled" : "" ?> step="0.01" id="estimated_cost_<?=$i?>" value="<?= $details->home == 1 ? $details->estimated_cost : "" ?>" />
                            </td>
                            <td>
                                <input type="checkbox" value="1" class="road-checkbox" id="road_check_<?=$i?>" <?= $details->road == 1 ? "checked='checked'" : ""?> />
                                <input type="hidden" name="road[]" value="1" class="road-checkbox" id="road_<?=$i?>" value="<?= $details->road?>"/>
                            </td>
                            <td>
                                <select name="road_type_<?=$i?>" class="road-type" <?= $details->road != 1 ? "disabled" : "" ?> id="road_type_<?=$i?>">
                                    <option value="" selected>छान्नुहोस्</option>
                                <?php
                                    foreach($road_types as $type) {
                                ?>
                                        <option value="<?= $type->id ?>"
                                            <?php
                                                if($details->road_type==$type->id && $details->road == 1)
                                                {
                                                    echo "selected= 'selected'";
                                                }
                                            ?>
                                        > <?= $type->name ?></option>
                                <?php
                                    }
                                ?>

                                </select>
                            </td>
                            <td>
                                    <textarea name="description[]" rows="2" class="description" cols="10" maxlength="250" id="description_<?=$i?>">
                                    <?= $details->description?></textarea>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm remove"
                                        id="remove-<?= $i ?>">
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
                        <tr class="item" id="item-1">
                            <td>
                                <select name="old_new_address[]" class="select2 old-place" id="old_new_address_0">
                                    <option value="" selected>छान्नुहोस्</option>
                                <?php
                                    foreach($addresses as $address) {
                                ?>
                                    <option value="<?= $address->id ?>"><?= $address->name ?></option>
                                <?php
                                    }
                                ?>


                                </select>
                            </td>
                            <td>
                                <input type="text" id="new_place_0" disabled class="new-name">
                            </td>
                            <td>
                                 <select name="land_area_type[]" class="select2 old-place" id="land_type<?=$i?>">
                                    <option value="" selected>छान्नुहोस्</option>
                                <?php
                                if(!empty($land_types)):
                                    foreach($land_types as $type) {
                                ?>
                                    <option value="<?= $type->id ?>"
                                      
                                    ><?= $type->category ?></option>
                                <?php
                                    } endif;
                                ?>


                                </select>
                               <!--  <input type="text" id="new_place_<?=$i?>" disabled class="form-control new-name"> -->
                            </td>
                            <td>
                                <input type="text" name="map_sheet_no[]" class="formset-field map-sheet-no" id="map_sheet_no_0" maxlength="32" />
                            </td>
                            <td>
                                <input type="text" name="kitta_no[]" class="formset-field kitta-no" id="id_details-0-kitta_no" maxlength="32" />
                            </td>
                            <td>
                                <input type="number" name="biggha[]" value="0" class="formset-field biggha" min="0" id="biggha_0" />
                            </td>
                            <td>
                                <input type="number" name="kattha[]" value="0" class="formset-field kattha" min="0" max="20" id="kattha_0" />
                            </td>
                            <td>
                                <input type="number" name="dhur[]" value="0" class="formset-field dhur" min="0" max="20" id="dhur_0" />
                            </td>
                            <td class="paisa_div" style="display:none;">
                                <input type="number" name="paisa[]" value="0" class=" formset-field paisa" id="paisa-0" min="0" max="4"  />
                            </td>
                            <td>
                                <input type="checkbox" name="home[]" value="1" class="formset-field home-checkbox" id="home_check_0" />
                                <input type="hidden" name="home[]"  class="formset-field" id="home_0" />
                            </td>
                            <td>
                                <select name="home_type_0" class="formset-field home-type" disabled id="home_type_0">
                                    <option value="" selected>छान्नुहोस्</option>

                                <?php
                                    foreach($home_types as $type) {
                                ?>
                                        <option value="<?= $type->id ?>"> <?= $type->name ?></option>
                                <?php
                                    }
                                ?>

                                </select>
                            </td>
                            <td>
                                <input type="number" name="estimated_cost_0" class="estimated-cost" disabled step="0.01" id="estimated_cost_0" />
                            </td>
                            <td>
                                <input type="checkbox" value="1" class="road-checkbox" id="road_check_0" />
                                <input type="hidden" name="road[]" id="road_0" />
                            </td>
                            <td>
                                <select name="road_type_0" class="road-type" disabled id="road_type_0">
                                    <option value="" selected>छान्नुहोस्</option>
                                <?php
                                    foreach($road_types as $type) {
                                ?>
                                        <option value="<?= $type->id ?>"> <?= $type->name ?></option>
                                <?php
                                    }
                                ?>

                                </select>
                            </td>
                            <td>
                                    <textarea name="description[]" rows="2" class="description" cols="10" maxlength="250" id="description_0"></textarea>
                            </td>
                            <td>
                                &nbsp;
                            </td>
                        </tr>
                    <?php
                        }
                    ?>
                    <tbody id="bodydiv">

                    </tbody>

                    <tr>
                        <td colspan="9"
                            style="border-left: none!important; border-right: none !important; border-bottom: none!important;">
                            <button id="add" type="button" class="btn btn-sm btn-success add-form-row">
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
                        <hr class="mt-5 mb-4">
                    </div>

                    
                </div>
            </div>
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

<script src="<?=base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<script>

    var JQ = jQuery.noConflict();
    JQ(document).ready(function() {
        JQ(document).on("change", ".old-place", function (){
                    var  id_selected = JQ(this).attr("id");
                    var  res         = id_selected.split("_");
                    var i            = res[res.length - 1];
                    var sabik_address = JQ(this).val();
                    param = {};
                    param.sabik = sabik_address;
                    JQ.ajax({
                        url: "<?= base_url()?>getHaalAddress",
                        method: "POST",
                        data: param,
                        success: function (data) {
                            var obj = JSON.parse(data);
                            JQ("#new_place_"+i).val(obj.haal);
                        },
                        error: function (error) {
                            console.log(JSON.stringify(error));
                        }
                    });
                });
        JQ(document).on("click", "#add", function (){
            var  count = JQ(".item").length;
            var land_type = JQ("input[name=land_type]:checked").val();
            param = {};
            param.count = count;
            param.land_type = land_type;
            JQ.ajax({
                url: "<?= base_url()?>getRoadCertifyHTML",
                method: "POST",
                data: param,
                success: function (data) {
                    var obj = JSON.parse(data);
                    JQ("#bodydiv").append(obj.html);
                },
                error: function (error) {
                    console.log(JSON.stringify(error));
                }
            });
        });
            JQ(document).on("click", ".remove", function () {
                var id_selected = JQ(this).attr("id");
                var res = id_selected.split("-");
                var id  = res[res.length - 1];
                JQ("#item-"+id).remove();
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



        JQ(document).on("click",".road-checkbox",function()
        {
            var id_selected     = JQ(this).attr("id");
            var res             = id_selected.split("_");
            var i               = res[res.length - 1];
            if(JQ(this).is(":checked"))
            {
                JQ("#road_"+i).val("1");
                JQ("#road_type_" + i).attr("disabled", false);
            }
            else
            {
                JQ("#road_type_" + i).val("0");
                JQ("#road_type_" + i).attr("disabled", true);
            }
        });
        JQ(document).on("click",".home-checkbox",function()
        {
            var id_selected = JQ(this).attr("id");
            var res = id_selected.split("_");
            var i = res[res.length - 1];
            if(JQ(this).is(":checked"))
            {
                JQ("#home_"+i).val("1");
                JQ("#home_type_" + i).attr("disabled", false);
                JQ("#estimated_cost_"+i).attr("disabled",false);
            }
            else
            {
                JQ("#home_"+i).val("0");
                JQ("#home_type_" + i).val("");
                JQ("#estimated_cost_"+i).val("");
                JQ("#home_type_" + i).attr("disabled", true);
                JQ("#estimated_cost_"+i).attr("disabled",true);
            }
        });
    });
</script>
