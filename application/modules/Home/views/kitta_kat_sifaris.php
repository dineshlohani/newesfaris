<?php
    if($this->uri->segment(2)== "create")
    {
    $action_page = "kitta-kat-sifaris/create";
    }
    if($this->uri->segment(2)=="edit")
    {
    $action_page = "kitta-kat-sifaris/edit/".$this->uri->segment(3);
    }
    if(!empty($result->documents))
    {
        $documents      = explode("+",$result->documents);

    }
    $path           = base_url()."assets/documents/home/kitta_kat_sifaris/";
?>
<section class="content">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <?php if(!empty($this->session->flashdata('msg')))
                {?>
                    <div  class="alert alert-success alert-dismissible" >    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span><?=$this->session->flashdata('msg');?></span></div>


                <?php } ?>
                <?php if(!empty($this->session->flashdata('err_msg')))
                {?>
                    <div  class="alert alert-danger alert-dismissible" >    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span><?=$this->session->flashdata('err_msg');?></span></div>

                <?php } ?>
            </div>
        </div>
    </div>



    <div class="container-fluid ">
        <nav aria-label="breadcrumb" class="bg-shadow">
            <ol class="breadcrumb px-3 py-2">
                <li class="breadcrumb-item ml-1"><a href="/">गृह</a></li>


                <li class="breadcrumb-item active">कित्ताकाट सिफारिस</li>

                <li class="breadcrumb-item active">नयाँ</li>

            </ol>
        </nav>
    </div>
    <div class="container-fluid ">
        <div class="card">
            <div class="card-body">
                <?php echo form_open_multipart($action_page)?>
                    <div class="row">
                        <div class="col-md-6 offset-md-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label"><span
                                        class="float-right">आवेदन गरिएको मिति<span
                                            class="text-danger">&nbsp;*</span></span></label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="text" name="nepali_date" class="form-control" id="nepaliDate4" value="<?= isset($result) ? $result->nepali_date : DateEngToNep(date('Y-m-d')) ?>" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <h4>
                                घर रहेको जग्गाको विवरण
                            </h4>
                            <hr style="border: 1px solid #adadad">
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4" style="margin-left:149px">
                                    <label class="col-md-4 col-form-label">
                                        <select name="gender_spec" class="form-control" id="gender_spec" required>
                                            <option selected>---Select---</option>
                                            <option value="श्री" >श्री</option>
                                            <option value="सुश्री" >सुश्री</option>                        
                                            <option value="श्रीमती" >श्रीमती</option>
                                        </select>
                                    </label>
                                </div>
                                <div class="col-md-4" style="margin-left:-182px">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">
                                            <span class="float-right">
                                                जग्गाधनिको नाम  
                                                <span class="text-danger">&nbsp;* 
                                                </span>
                                            </span>

                                        </label>

                                        <div class="col-sm-8">
                                            <input type="text" name="owner_name" class="form-control" id="id_owner_name" maxlength="128" value="<?= isset($result) ? $result->owner_name : '' ?>" required />
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-4" style="margin-left:20px">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">
                                            <span class="float-right">
                                                नागरिकता नं <span class="text-danger">&nbsp;*</span>
                                            </span>

                                        </label>

                                        <div class="col-sm-8">
                                            <input type="text" name="cit_no" class="form-control" id="cit_no" maxlength="128" value="<?= isset($result) ? $result->cit_no : '' ?>" required />
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
                                            <input type="text" name="con_no" class="form-control" id="con_no" maxlength="128" value="<?= isset($result) ? $result->con_no : '' ?>" required />
                                        </div>

                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">
                                            <span class="float-right">
                                                जग्गा मिलन गर्नुपर्ने<br>क्षेत्रफल<span
                                                    class="text-danger">&nbsp;*</span>
                                            </span>

                                        </label>

                                        <div class="col-sm-8">
                                            <input type="text" name="kittakat_area" class="form-control" placeholder="(१-२-१)" required maxlength="32"  value="<?= isset($result) ? $result->kittakat_area : '' ?>" id="id_kittakat_area" />
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">
                                            <span class="float-right">
                                                जग्गा रहेको ठेगाना<span class="text-danger">&nbsp;*</span>
                                            </span>

                                </label>

                                <div class="col-md-2 mb-sm-2">
                                    <select name="state" class="form-control select2 state_selected" id="state_selected-1" required>
                                        <option value="" >प्रदेश</option>
                                    <?php
                                        foreach($states as $state) {
                                    ?>
                                        <option value="<?= $state->id ?>"
                                            <?php
                                                if(isset($result)&&$result->state == $state->id)
                                                {
                                                    echo "selected = 'selected'";
                                                }
                                                elseif($state->id==$default[0])
                                                {
                                                    echo 'selected="selected"';
                                                }
                                            ?>
                                        ><?= $state->name?></option>
                                    <?php
                                        }
                                     ?>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-sm-2">
                                    <select name="district" class="form-control select2 district_selected" id="district_selected-1" required>
                                        <option value="" >जिल्ला</option>
                                    <?php
                                        foreach($districts as $district)
                                        {
                                    ?>
                                            <option value="<?= $district->id ?>"
                                                <?php
                                                    if(isset($result)&&$result->district == $district->id)
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
                                    </select>
                                </div>
                                <div class="col-md-3 mb-sm-2">
                                    <select name="local_body" class="form-control select2 local_body_selected" id="local_body_selected-1" required>
                                        <option value="" selected>गा.वि.स./न.पा </option>
                                     <?php
                                        foreach($locals as $local) {
                                    ?>
                                        <option value="<?= $local->id ?>"
                                            <?php
                                                if(isset($result)&&$result->local_body == $local->id)
                                                {
                                                    echo "selected = 'selected'";
                                                }
                                                elseif($local->name==$default[2])
                                                    {
                                                        echo 'selected="selected"';
                                                    }
                                            ?>
                                        > <?=$local->name?> </option>
                                    <?php
                                        }
                                    ?>
                                    </select>
                                </div>
                                <div class="col-md-2 mb-sm-2">
                                    <select name="ward" class="form-control select2 ward_selected" id="ward_selected-1" required>
                                        <option value="" selected>वडा नं</option>
                                    <?php
                                        foreach($wards as $ward) {
                                    ?>
                                            <option value="<?= $ward->id ?>"
                                                <?php
                                                    if(isset($result)&&$result->ward == $ward->id)
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
                                </div>

                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">
                                            <span class="float-right">
                                                साबिक ठेगाना <span class="text-danger">&nbsp;*</span>
                                            </span>

                                        </label>

                                        <div class="col-sm-8">
                                            <select name="old_place" class="form-control" id="id_old_place" required>
                                                <option value="" selected>छान्नुहोस्</option>
                                                <?php
                                                    foreach($addresses as $address) {
                                                ?>
                                                    <option value="<?= $address->id ?>"
                                                        <?php
                                                            if(isset($result)&&$result->old_place == $address->id)
                                                            {
                                                                echo "selected = 'selected'";
                                                            }
                                                        ?>
                                                    ><?= $address->name ?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">
                                            <span class="float-right">
                                                कित्ता मिलान गर्न चाहेको <br> दिशा<span
                                                    class="text-danger">&nbsp;*</span>
                                            </span>

                                        </label>

                                        <div class="col-sm-8">
                                            <select name="direction" class="form-control" id="id_direction" required>
                                                <option value="" selected>--छान्नुहोस्--</option>
                                            <?php
                                                foreach($directions as $direction) {
                                            ?>
                                                 <option value="<?= $direction->id ?>"
                                                     <?php
                                                         if(isset($result)&&$result->direction == $direction->id)
                                                         {
                                                             echo "selected = 'selected'";
                                                         }
                                                     ?>
                                                 > <?= $direction->name?></option>
                                            <?php
                                                }
                                            ?>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="text-center">
                                <label for="terai" style="font-size:17px"><b>तराई</b></label>
                                <input type="radio" name="land_type" value="terai" <?= (isset($result) && $result->land_type =="terai") ? 'checked' : ''; ?>>
                                <label for="hill" style="font-size:17px"><b>पहाड</b></label>
                                <input type="radio" name="land_type" id="hill" value="hill" <?= (isset($result) && $result->land_type =="hill") ? 'checked' : 'checked'; ?>>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">
                                                <span class="float-right">
                                                    क्षेत्रफल<span class="text-danger">&nbsp;*</span>
                                                </span>

                                </label>

                                    <div class="col-10">
                                        <div class="input-group mb-3">
                                            <input type="number" name="biggha"  class="form-control" required min="0" id="id_biggha" value="<?= isset($result) ? $result->biggha : 0?>"/>
                                            <div class="input-group-append ">
                                                <span class="input-group-text" id="biggha_span"><?= (isset($result)&&$result->land_type=="hill") ? '' : 'रोपनी' ?></span>
                                            </div>
                                            <input type="number" name="kattha"  class="form-control" required min="0" id="id_kattha" value="<?= isset($result) ? $result->kattha : 0?>"/>
                                            <div class="input-group-append ">
                                                <span class="input-group-text" id="kattha_span"><?= (isset($result)&&$result->land_type=="hill") ? 'आना' : 'आना' ?></span>
                                            </div>
                                            <input type="number" name="dhur" class="form-control" required min="0" id="id_dhur" value="<?= isset($result) ? $result->dhur : 0?>"/>
                                            <div class="input-group-append ">
                                                <span class="input-group-text" id="dhur_span"><?= (isset($result)&&$result->land_type=="hill") ? '' : 'दाम' ?></span>
                                            </div>
                                            <input type="number" name="paisa" class="paisa_div form-control "  min="0" max="4" id="id_paisa" value="<?= isset($result) ? $result->paisa : 0?>" <?= (isset($result)&&$result->land_type=="hill") ? '' :'style="display: none";'?>/>
                                            <div class="paisa_div input-group-append " <?= (isset($result) && $result->land_type=="hill") ? '' : 'style="display: none";'?>>
                                                <span class="input-group-text" id="paisa_dhur">पैसा</span>
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
                                                सिट.नं.<span class="text-danger">&nbsp;*</span>
                                            </span>

                                        </label>

                                        <div class="col-sm-8">
                                            <input type="text" name="map_sheet_no" class="form-control" id="id_map_sheet_no" maxlength="32" value="<?= isset($result) ? $result->map_sheet_no : ''?>"required />
                                        </div>

                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">
                                            <span class="float-right">
                                                कित्ता नम्बर<span class="text-danger">&nbsp; *</span>
                                            </span>
                                        </label>

                                        <div class="col-sm-8">
                                            <input type="text" name="kitta_no" class="form-control" id="id_kitta_no" maxlength="32" value="<?= isset($result) ? $result->kitta_no : ''?>" required />
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <h4>
                                फिल्ड निरीक्षण प्रतिवेदन
                            </h4>
                            <hr style="border: 1px solid #adadad">
                        </div>

                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">
                                            <span class="float-right">
                                                घरको जम्मा क्षेत्रफल <span class="text-danger">&nbsp;*</span>
                                            </span>

                                        </label>

                                        <div class="col-sm-8">
                                            <input type="text" name="ghar_area" class="form-control" id="id_ghar_area" maxlength="32" value="<?= isset($result) ? $result->ghar_area : ''?>" required />
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">
                                            <span class="float-right">
                                                घरको भुई तल्लाको क्षेत्रफल<span class="text-danger">&nbsp;*</span>
                                            </span>

                                        </label>

                                        <div class="col-sm-8">
                                            <input type="text" name="first_floor_home_area" class="form-control" id="id_first_floor_home_area" maxlength="32" value="<?= isset($result) ? $result->first_floor_home_area : ''?>" required />
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
                                                पाउने फार <span class="text-danger">&nbsp;*</span>
                                            </span>

                                        </label>

                                        <div class="col-sm-8">
                                            <input type="text" name="paune_far" class="form-control" id="id_paune_far" maxlength="32"  value="<?= isset($result) ? $result->paune_far : ''?>" required />
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">
                                            <span class="float-right">
                                                सिफारिस दिन मिल्ने कारण<span class="text-danger">&nbsp;*</span>
                                            </span>

                                        </label>

                                        <div class="col-sm-8">
                                            <input type="text" name="reason" class="form-control" id="id_reason" maxlength="512" value="<?= isset($result) ? $result->reason : ''?>" required />
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">
                                            <span class="float-right">
                                                प्राबिधिकको नाम<span class="text-danger">&nbsp; *</span>
                                            </span>
                                        </label>

                                        <div class="col-sm-8">
                                            <input type="text" name="technician_name" class="form-control" id="id_technician_name" maxlength="128" value="<?= isset($result) ? $result->technician_name : ''?>" required />
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
                                                <option value="<?= $doc->id ?>"><?= $doc->name?></option>
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
                        <span class="col-sm-9 offset-sm-3">
                          <button type="submit" class='btn btn-submit btn-block btn-primary'
                                  name="submit">पेश गर्नुहोस्</button>
                        </span>
                            </div>
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
