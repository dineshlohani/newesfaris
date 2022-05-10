<?php
if($this->uri->segment(2)== "create")
{
    $action_page = "tin-pusta-pramanit/create";
}
if($this->uri->segment(2)=="edit")
{
    $action_page = "tin-pusta-pramanit/edit/".$this->uri->segment(3);
}
if(!empty($result->documents))
{
    $documents      = explode("+",$result->documents);

}
$path           = base_url()."assets/documents/others/tin_pusta_pramanit/";
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
                            <label class="col-sm-4 col-form-label"><span
                                    class="float-right">आवेदन गरिएको मिति<span
                                        class="text-danger">&nbsp;*</span></span></label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="text" name="nepali_date" maxlength="10" class="form-control" required id="nepaliDate4" value="<?= isset($result) ? $result->nepali_date : ''?>" />
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
                                               नाम<span class="text-danger">&nbsp;*</span>
                                            </span>

                                    </label>

                                    <div class="col-sm-8">
                                        <input type="text" name="applicant_name" maxlength="128" class="form-control" required id="id_name" value="<?= isset($result) ? $result->applicant_name : ''?>" />
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
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">
                                            <span class="float-right">
                                               ठेगाना<span class="text-danger">&nbsp;*</span>
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
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">
                                            <span class="float-right">
                                               साबिक ठेगाना<span class="text-danger">&nbsp;*</span>
                                            </span>

                                    </label>

                                    <div class="col-sm-8">
                                        <select name="old_new_address" class="select2 form-control" id="id_old_new_address">
                                            <option value="">छानुहोस</option>
                                            <?php foreach ($old_new_addresses as $data):?>
                                                <option value="<?= $data->id ?>"
                                                    <?php
                                                    if(isset($result)&& $result->old_new_address == $data->id)
                                                    {
                                                        echo 'selected="selected"';
                                                    }
                                                    ?>
                                                ><?= $data->name?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-4">
                        <h5 class="text-center">तीन पुस्ते विवरण</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">क्र.स.</th>
                                    <th class="text-center">नाम</th>
                                    <th class="text-center">नाता</th>
                                    <th class="text-center">नागरिकता नं.</th>
                                    <th class="text-center">जारी मिति</th>
                                    <th class="text-center">जिल्ला</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="tin_pusta">
                                    <td>१</td>
                                    <td><input type="text" class="form-control" name="name_1" value="<?= isset($result) ? $result->name_1 : ''?>" required> </td>
                                    <td>
                                        <input type="text" name="relation_1" value="बाजे" readonly/>
                                    </td>
                                    <td><input type="text" class="form-control" name="citizenship_no_1" value="<?= isset($result) ? $result->citizenship_no_1 : '' ?>" required></td>
                                    <td><div class="input-group"><input type="text" class="form-control" name="citizenship_date_1" id="nepaliDate5" value="<?= isset($result) ? $result->citizenship_date_1 : '' ?>" required></div></td>
                                    <td>
                                        <select name="citizenship_district_1" class="form-control select2" required>
                                            <option value="">छानुहोस</option>
                                            <?php foreach ($districts as $district):?>
                                                <option value="<?= $district->id ?>"
                                                    <?php
                                                    if(isset($result) && $result->citizenship_district_1 == $district->id)
                                                    {
                                                        echo 'selected ="selected"';
                                                    }elseif($district->name==$default[1])
                                                    {
                                                        echo 'selected="selected"';
                                                    }
                                                    ?>
                                                > <?= $district->name?> </option>
                                            <?php endforeach;?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>२</td>
                                    <td><input type="text" class="form-control" name="name_2" value="<?= isset($result) ? $result->name_2 : ''?>" required> </td>
                                    <td>
                                        <input type="text" name="relation_2" value="वाबु" readonly/>
                                    </td>
                                    <td><input type="text" class="form-control" name="citizenship_no_2"  value="<?= isset($result) ? $result->citizenship_no_2 : ''?>" required></td>
                                    <td><div class="input-group"><input type="text" class="form-control" name="citizenship_date_2" id="nepaliDate6" value="<?= isset($result)? $result->citizenship_date_2 : ''?>" required></div></td>
                                    <td>
                                        <select name="citizenship_district_2" class="form-control select2" required>
                                            <option value="">छानुहोस</option>
                                            <?php foreach ($districts as $district):?>
                                                <option value="<?= $district->id ?>"
                                                    <?php
                                                    if(isset($result) && $result->citizenship_district_2 == $district->id)
                                                    {
                                                        echo 'selected ="selected"';
                                                    }elseif($district->name==$default[1])
                                                    {
                                                        echo 'selected="selected"';
                                                    }
                                                    ?>
                                                > <?= $district->name?> </option>
                                            <?php endforeach;?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>३</td>
                                    <td><input type="text" class="form-control" name="name_3" value="<?= isset($result) ? $result->name_3 : ''?>" required> </td>
                                    <td>
                                        <input type="text" name="relation_3" value="आफै" readonly/> 
                                    </td>
                                    <td><input type="text" class="form-control" name="citizenship_no_3" value="<?= isset($result) ? $result->citizenship_no_3 : ''?>" required></td>
                                    <td><div class="input-group"><input type="text" class="form-control" name="citizenship_date_3" id="nepaliDate7" value="<?= isset($result) ? $result->citizenship_date_3 : ''?>" required></div></td>
                                    <td>
                                        <select name="citizenship_district_3" class="form-control select2" required>
                                            <option value="">छानुहोस</option>
                                            <?php foreach ($districts as $district):?>
                                                <option value="<?= $district->id ?>"
                                                    <?php
                                                    if(isset($result) && $result->citizenship_district_3 == $district->id)
                                                    {
                                                        echo 'selected ="selected"';
                                                    }elseif($district->name==$default[1])
                                                    {
                                                        echo 'selected="selected"';
                                                    }
                                                    ?>
                                                > <?= $district->name?> </option>
                                            <?php endforeach;?>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <h4 class="text-center mt-5">जग्गाको विवरण</h4>
                        <div class="text-center mt-3">
                            <label for="terai" style="font-size:17px"><b>तराई</b></label>
                            <input type="radio" name="land_type" value="terai" <?= (isset($result) && $result->land_type =="terai") ? 'checked' : 'checked'; ?>>
                            <label for="hill" style="font-size:17px"><b>पहाड</b></label>
                            <input type="radio" name="land_type" id="hill" value="hill" <?= (isset($result) && $result->land_type =="hill") ? 'checked' : ''; ?>>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <table class="table form-table table-bordered">
                            <thead class="text-center">
                                <tr>
                                    <td class="text-center">कित्ता नं.</td>
                                    <td class="text-center">सिट नं.</td>
                                    <td class="text-center" id="biggha_span">बिग्घा</td>
                                    <td class="text-center" id="kattha_span">कट्ठा</td>
                                    <td class="text-center" id="dhur_span">धुर</td>
                                    <td class="paisa_div text-center" style="display:none;">पैसा</td>
                                    <td>&nbsp;</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(isset($result)):?>
                                    <?php $i=1; foreach($details as $detail) :?>
                                        <tr class="tin_pusta" id="tin_pusta_<?=$i?>">
                                            <td>
                                                <input class="form-control" type="text" name="kitta_no[]" value="<?= $detail->kitta_no?>" required>
                                            </td>
                                            <td>
                                                <input class="form-control" type="text" name="sheet_no[]" value="<?= $detail->sheet_no?>" required>
                                            </td>
                                            <td>
                                                <input type="number" name="biggha[]"  class="form-control biggha" value="<?= $detail->biggha?>" id="biggha-1" min="0" />
                                            </td>
                                            <td>
                                                <input type="number" name="kattha[]" class="form-control kattha"  value="<?= $detail->kattha?>" id="kattha-1" min="0" max="20" />
                                            </td>
                                            <td>
                                                <input type="number" name="dhur[]" class="form-control dhur" value="<?= $detail->dhur?>" id="dhur-1" min="0" max="20" />
                                            </td>
                                            <td class="paisa_div"  <?php if($result->land_type == 'terai') echo 'style="display:none;"';?>>
                                                <input type="number" name="paisa[]" class="form-control paisa" value="<?= $detail->paisa?>" id="paisa-<?=$i?>" min="0" max="4"  />
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm remove" id="remove_<?= $i?>"  >
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php $i++; endforeach;?>
                                <?php else: ?>
                                    <tr>
                                        <td>
                                            <input class="form-control" type="text" name="kitta_no[]" required>
                                        </td>
                                        <td>
                                            <input class="form-control" type="text" name="sheet_no[]" required>
                                        </td>
                                        <td>
                                            <input type="number" name="biggha[]" value="0" class="form-control biggha" id="biggha-1" min="0" />
                                        </td>
                                        <td>
                                            <input type="number" name="kattha[]" value="0" class="form-control kattha" id="kattha-1" min="0" max="20" />
                                        </td>
                                        <td>
                                            <input type="number" name="dhur[]" value="0" class="form-control dhur" id="dhur-1" min="0" max="20" />
                                        </td>
                                        <td class="paisa_div" style="display:none;">
                                            <input type="number" name="paisa[]" value="0" class="form-control paisa" id="paisa-<?=$i?>" min="0" max="4"  />
                                        </td>
                                        <td>&nbsp;</td>
                                    </tr>
                                <?php endif;?>

                                    <tbody id="tin_pusta_div">

                                    </tbody>
                                    <tr>
                                        <td colspan="6"
                                            style="border-left: none!important; border-right: none !important; border-bottom: none!important;">
                                            <button id="add_more" type="button" class="btn btn-sm btn-success add_more">
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
    var JQ = jQuery.noConflict();
    JQ(document).ready(function() {

        JQ(document).on('click','#add_more', function(){
            var land_type = JQ("input[name=land_type]:checked").val();
            var  count = JQ(".tin_pusta").length + 1;
            param = {};
            param.count = count;
            param.land_type = land_type;
            JQ.ajax({
                url: "<?= base_url()?>getTinPustaHTML",
                method: "POST",
                data: param,
                success: function (data) {
                    var obj = JSON.parse(data);
                    JQ("#tin_pusta_div").append(obj.html);
                },
                error: function (error) {
                    console.log(JSON.stringify(error));
                }
            });
        });

        JQ(document).on('click', '.remove', function(){
            var id_selected = JQ(this).attr('id');
            var id = id_selected.replace('remove_', '');
            JQ("#tin_pusta_"+id).remove();
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
