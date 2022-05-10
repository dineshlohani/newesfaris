<?php
if($this->uri->segment(2)== "create")
{
    $action_page = "lalpurja-pratilipi/create";
    $name = "नयाँ";
}
if($this->uri->segment(2)=="edit")
{
    $action_page = "lalpurja-pratilipi/edit/".($this->uri->segment(3));
    $name = "साच्याउनुहोस";
}
//    echo $action_page;exit;
$path = base_url()."assets/documents/land/lalpurja/";
?>
<section class="content ">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="django-messages">

                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid ">
        <nav aria-label="breadcrumb" class="bg-shadow">
            <ol class="breadcrumb">
                <li class="breadcrumb-item ml-1"><a href="<?=  base_url()?>land-dashboard">गृह</a></li>
                <li class="breadcrumb-item"><a href="<?=  base_url()?>lalpurja-pratilipi">जग्गाधनी लाल पुर्जा प्रतिलिपि </a></li>
                <li class="breadcrumb-item active"><?=$name?></li>
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
                <?php if(!empty($this->session->flashdata('msg')))
                {?>
                    <div  class="alert alert-success alert-dismissible" >    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span><?=$this->session->flashdata('msg');?></span></div>
                <?php } ?>
                <?php if(!empty($this->session->flashdata('err_msg')))
                {?>
                    <div  class="alert alert-danger alert-dismissible" >    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span><?=$this->session->flashdata('err_msg');?></span></div>
                <?php } ?>
                <?php echo form_open_multipart($action_page)?>
                <div class="row">
                    <div class="col-md-6 offset-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label"><span
                                class="float-right">आवेदन गरिएको मिति<span
                                class="text-danger">&nbsp;*</span></span></label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="text" name="nepali_date" maxlength="10" class="form-control" required id="nepaliDate4" placeholder="YYYY-MM-DD"/>
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
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">
                                            <span class="float-right">
                                                नाम<span class="text-danger">&nbsp;* 
                                                </span>
                                            </span>
                                        </label>
                                        <label class="col-md-4 col-form-label">
                                            <select name="gender_spec" class="form-control" id="gender_spec" required>
                                                <option selected>---Select---</option>
                                                <option value="श्री" >श्री</option>
                                                <option value="सुश्री" >सुश्री</option>                        
                                                <option value="श्रीमती" >श्रीमती</option>
                                            </select>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">

                                    <div class="col-sm-8">
                                        <input type="text" name="applicant_name" maxlength="128" class="form-control" required id="id_applicant_name" value="<?= isset($result) ? $result->applicant_name : ''?>"  />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">
                                            <span class="float-right">
                                                जग्गाधनीको किसिम <span class="text-danger">&nbsp;*</span>
                                            </span>
                                        </label>
                                        <label class="col-md-4 col-form-label">
                                            <select name="lo_type" class="form-control" id="lo_type" required>
                                                <option selected>---Select---</option>
                                                <option value="एकल" >एकल</option>
                                                <option value="संयुक्त" >संयुक्त</option>
                                            </select>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">
                                            <span class="float-right">
                                                प्रतिलिपि लिनुपर्ने कारण <span class="text-danger">&nbsp;*</span>
                                            </span>
                                        </label>
                                        <label class="col-md-4 col-form-label">
                                            <select name="copy_reason" class="form-control" id="copy_reason" required>
                                                <option selected>---Select---</option>
                                                <option value="हराएको" >हराएको</option>
                                                <option value="झुत्रो भएको" >झुत्रो भएको</option>
                                            </select>
                                        </label>
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
                                                ना.प्र.नं.<span class="text-danger">&nbsp;*</span>
                                            </span>
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="text" name="citizenship_no" maxlength="32" class="form-control" required id="id_citizenship_no" value="<?= isset($result) ? $result->citizenship_no : ''?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">
                                            <span class="float-right">
                                                जारि जिल्ला<span class="text-danger">&nbsp;*</span>
                                            </span>
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="text" name="jari_jilla" maxlength="32" class="form-control" required id="id_jari_jilla" value="<?= isset($result) ? $result->jari_jilla : ''?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">
                                            <span class="float-right">
                                                ना.प्र. जारी मिति<span class="text-danger">&nbsp;*</span>
                                            </span>
                                        </label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input type="text" name="nep_citizenship_date" maxlength="10" placeholder="YYYY-MM-DD" class="form-control" required id="nepaliDate5" value="<?= isset($result) ? $result->nep_citizenship_date : ''?>"/>
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
                                            <input type="text" name="father_name" maxlength="128" class="form-control" required id="id_father_name" value="<?= isset($result) ? $result->father_name : ''?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">
                                            <span class="float-right">
                                                बाजेको नाम<span class="text-danger">&nbsp;*</span>
                                            </span>
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="text" name="grandfather_name" maxlength="128" class="form-control" required id="id_grandfather_name" value="<?= isset($result) ? $result->grandfather_name : ''?>"/>
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
                                    <select name="a_state" class="form-control select2 state_selected" required id="state_selected-1">
                                        <option value="" selected>प्रदेश</option>
                                        <?php foreach($states as $state):?>
                                            <option value="<?=$state->id?>"
                                                <?php
                                                if(isset($result) && $result->a_state == $state->id)
                                                {
                                                    echo 'selected = "selected"';
                                                }
                                                elseif($state->id==$default[0])
                                                {
                                                    echo 'selected="selected"';
                                                }
                                                ?>
                                                ><?=$state->name?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-sm-2">
                                       <select name="a_district" class="form-control select2 district_selected" id="district_selected-1" required>
                                        <option value="" selected>जिल्ला</option>
                                        <?php
                                        foreach($districts as $district) {
                                            ?>
                                            <option value="<?= $district->id ?>"
                                                <?php if(isset($result->a_district)&&$result->a_district == $district->id)
                                                {
                                                    echo "selected='selected'";
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
                                     <select name="a_local_body" class="form-control select2 local_body_selected" id="local_body_selected-1" required>
                                        <option value="" selected>गा.वि.स./न.पा </option>
                                        <?php
                                        foreach($locals as $local)
                                        {
                                            ?>
                                            <option value="<?= $local->id ?>"
                                                <?php if(isset($result->a_local_body)&&$result->a_local_body == $local->id)
                                                {
                                                    echo "selected='selected'";
                                                }
                                                elseif($local->name==$default[2])
                                                {
                                                    echo 'selected="selected"';
                                                }
                                                ?>
                                                ><?= $local->name ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2 mb-sm-2">
                                     <select name="a_ward" class="form-control select2 ward_selected" id="ward_selected-1" required>
                                        <option value="" selected>वडा नं</option>
                                        <?php
                                        foreach($wards as $ward) {
                                            ?>
                                            <option value="<?= $ward->id ?>"
                                                <?php if(isset($result->a_ward)&&$result->a_ward == $ward->id)
                                                {
                                                    echo "selected='selected'";
                                                }elseif($ward->id==$default[3])
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
                                                    साबिक ठेगाना<span class="text-danger">&nbsp;*</span>
                                                </span>

                                            </label>

                                            <div class="col-sm-8">
                                                <input type="text" name="a_old_place" maxlength="128" class="form-control" required id="id_a_old_place" value="<?= isset($result) ? $result->a_old_place : ''?>"/>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12 mb-3 mt-4">
                                <h4>
                                    जग्गाको विवरण
                                </h4>
                                <hr style="border: 1px solid #adadad">
                            </div>

                            <div class="col-md-12">
                                <div class="row">
                                    <!--<div class="col-md-6">-->
                                        <!--    <div class="form-group row">-->
                                            <!--        <label class="col-md-4 col-form-label">-->
                                                <!--                <span class="float-right">-->
                                                    <!--                    जग्गा धनिको नाम<span class="text-danger">&nbsp;*</span>-->
                                                    <!--                </span>-->

                                                    <!--        </label>-->

                                                    <!--            <div class="col-sm-8">-->
                                                        <!--                <input type="text" name="land_owner_name" maxlength="128" class="form-control" required id="id_land_owner_name" value="<?= isset($result) ? $result->land_owner_name : ''?>"/>-->
                                                        <!--            </div>-->

                                                        <!--    </div>-->
                                                        <!--</div>-->

                                                        <div class="col-md-6">
                                                            <div class="form-group row">
                                                                <label class="col-md-4 col-form-label">
                                                                    <span class="float-right">
                                                                        कित्ता नं.<span class="text-danger">&nbsp;*</span>
                                                                    </span>

                                                                </label>

                                                                <div class="col-sm-8">
                                                                    <input type="text" name="kitta_no" maxlength="32" class="form-control" required id="id_kitta_no" value="<?= isset($result) ? $result->kitta_no : ''?>"/>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="text-center">
                                                        <label for="terai" style="font-size:17px"><b>तराई</b></label>
                                                        <input type="radio" name="land_type" value="terai" <?= (isset($result) && $result->land_type =="terai") ? 'checked' : 'checked'; ?>>
                                                        <label for="hill" style="font-size:17px"><b>पहाड</b></label>
                                                        <input type="radio" name="land_type" id="hill" value="hill" <?= (isset($result) && $result->land_type =="hill") ? 'checked' : ''; ?>>
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
                                                                    <span class="input-group-text" id="biggha_span"><?= (isset($result)&&$result->land_type=="hill") ? 'रोपनी' : 'बिग्घा' ?></span>
                                                                </div>
                                                                <input type="number" name="kattha"  class="form-control" required min="0" id="id_kattha" value="<?= isset($result) ? $result->kattha : 0?>"/>
                                                                <div class="input-group-append ">
                                                                    <span class="input-group-text" id="kattha_span"><?= (isset($result)&&$result->land_type=="hill") ? 'आना' : 'कट्ठा' ?></span>
                                                                </div>
                                                                <input type="number" name="dhur" class="form-control" required min="0" id="id_dhur" value="<?= isset($result) ? $result->dhur : 0?>"/>
                                                                <div class="input-group-append ">
                                                                    <span class="input-group-text" id="dhur_span"><?= (isset($result)&&$result->land_type=="hill") ? 'दाम' : 'धुर' ?></span>
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
                                                    <div class="form-group row">
                                                        <label class="col-md-2 col-form-label">
                                                            <span class="float-right">
                                                                ठेगाना<span class="text-danger">&nbsp;*</span>
                                                            </span>

                                                        </label>

                                                        <div class="col-md-2 mb-sm-2">
                                                            <select name="l_state" class="form-control select2 state_selected" required id="state_selected-2">
                                                               <option value="" selected>प्रदेश</option>
                                                               <?php
                                                               foreach($states as $state) {
                                                                ?>
                                                                <option value="<?= $state->id ?>"
                                                                    <?php if(isset($result->l_state)&&$result->l_state == $state->id)
                                                                    {
                                                                        echo "selected='selected'";
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
                                                            </select>
                                                        </div>
                                                        <div class="col-md-3 mb-sm-2">
                                                            <select name="l_district" class="form-control select2 district_selected" required id="district_selected-2">
                                                              <option value="" selected>जिल्ला</option>
                                                              <?php
                                                              foreach($districts as $district) {
                                                                ?>
                                                                <option value="<?= $district->id ?>"
                                                                    <?php if(isset($result->l_district)&&$result->l_district == $district->id)
                                                                    {
                                                                        echo "selected='selected'";
                                                                    }elseif($district->name==$default[1])
                                                                    {
                                                                        echo 'selected="selected"';
                                                                    }
                                                                    ?>
                                                                    ><?= $district->name ?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </select>                                </div>
                                                            <div class="col-md-3 mb-sm-2">
                                                                <select name="l_local_body" class="form-control select2 local_body_selected" required id="local_body_selected-2">
                                                                  <option value="" selected>गा.वि.स./न.पा </option>
                                                                  <?php
                                                                  foreach($locals as $local)
                                                                  {
                                                                    ?>
                                                                    <option value="<?= $local->id ?>"
                                                                        <?php if(isset($result->l_local_body)&&$result->l_local_body == $local->id)
                                                                        {
                                                                            echo "selected='selected'";
                                                                        }
                                                                        elseif($local->name==$default[2])
                                                                        {
                                                                            echo 'selected="selected"';
                                                                        }
                                                                        ?>
                                                                        ><?= $local->name ?></option>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </select>

                                                            </div>

                                                            <div class="col-md-2 mb-sm-2">
                                                                <select name="l_ward_no" class="form-control select2 ward_selected" required id="ward_selected-2">
                                                                  <option value="" selected>वडा नं</option>
                                                                  <?php
                                                                  foreach($wards as $ward) {
                                                                    ?>
                                                                    <option value="<?= $ward->id ?>"
                                                                        <?php if(isset($result->l_ward_no)&&$result->l_ward_no == $ward->id)
                                                                        {
                                                                            echo "selected='selected'";
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
                                                                            साबिक ठेगाना<span class="text-danger">&nbsp;*</span>
                                                                        </span>

                                                                    </label>

                                                                    <div class="col-sm-8">
                                                                        <input type="text" name="l_old_place" maxlength="128" class="form-control" required id="id_l_old_place" value="<?= isset($result) ? $result->l_old_place : ''?>"/>
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
                                                </div><hr class="mt-5 mb-4">
                                                <input type="hidden" name="created_at" value="<?= isset($result) ? $result->created_at : ''?>"/>
                                                <div class="form-group row">
                                                    <div class="col-sm-6 offset-sm-6">
                                                        <button type="submit" class='btn btn-block btn-submit btn-primary' name="submit">पेश
                                                            गर्नुहोस्
                                                        </button>
                                                    </div>
                                                </div>
                                                <?php echo form_close();?>

                                            </div>
                                        </div>

                                    </section>
                                </div>
                                <script src="<?=base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>
                                <script>

                                    var JQ = jQuery.noConflict();
                                    JQ(document).ready(function() {
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
