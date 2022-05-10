<?php
    if($this->uri->segment(2)== "create")
    {
    $action_page = "nabalak-pramanit/create";
    $name = "नवीनतम डाटा";
    }
    if($this->uri->segment(2)=="edit")
    {
    $action_page = "nabalak-pramanit/edit/".($this->uri->segment(3));
    $name = "साच्याउनुहोस";
    }
    if(isset($result) && !empty($result->documents))
    {
        $documents = explode("+",$result->documents);
    }
//    echo $action_page;exit;
$path = base_url()."assets/documents/others/nabalak_pramanit";
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
                    <ol class="breadcrumb px-3 py-2">
                        <li class="breadcrumb-item ml-1"><a href="<?=  base_url()?>others-dashboard">गृह</a></li>


        <li class="breadcrumb-item"><a href="<?=  base_url()?>nabalak-pramanit"> नाबालक प्रमाण पत्र </a></li>

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
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label"><span
                                        class="float-right">आवेदन गरिएको मिति<span
                                        class="text-danger">&nbsp;*</span></span></label>




                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <input type="text" name="nepali_date" placeholder="YYYY-MM-DD" maxlength="10" class="form-control" required id="nepaliDate5" />
                                            <div class="input-group-append">

                                            </div>
                                        </div>
                                    </div>

                            </div>
                           </div>
                </div>
            <div class="row mt-4">
                        <div class="col-md-12 mb-3">
                            <h4>
                                निवेदकको विवरण
                            </h4>
                            <hr style="border: 1px solid #adadad">
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">
                                          <span class="float-right">
                                                <strong>नाम</strong>
                                            <span class="text-danger">&nbsp;*</span>
                                          </span>
                                        </label>

                                            <div class="col-sm-8">
                                                <input type="text" name="applicant_name" value="<?=isset($result)?$result->applicant_name:''?>" maxlength="128" class="form-control" required id="id_applicant_name" />
                                            </div>

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">
                                          <span class="float-right">
                                                <strong>नाता</strong>
                                            <span class="text-danger">&nbsp;*</span>
                                          </span>
                                        </label>
                                            <div class="col-sm-8">
                                            <select name="relationship" class="form-control select2" required>
                                                <option value="" selected>---छानुहोस---</option>
                                                <?php foreach ($relations as $relation):?>
                                                    <option value="<?= $relation->id ?>"
                                                        <?php
                                                            if(isset($result) && $result->relationship == $relation->id)
                                                            {
                                                                echo 'selected ="selected"';
                                                            }
                                                        ?>><?= $relation->name?> </option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12 mb-3">
                            <h4>
                                नाबालकको विवरण
                            </h4>
                            <hr style="border: 1px solid #adadad">
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label">
                                            <span class="float-right">
                                                <strong>नाम (नेपालीमा)</strong><span class="text-danger">&nbsp;*</span>
                                            </span>

                                        </label>
                                            <div class="col-md-3 mb-sm-2">
                                                <input type="text" name="nep_first_name" value="<?=isset($result)?$result->nep_first_name:''?>" maxlength="64" class="form-control" required id="id_nep_first_name" />
                                            </div>
                                            <div class="col-md-3 mb-sm-2">
                                                <input type="text" name="nep_middle_name" value="<?=isset($result)?$result->nep_middle_name:''?>" maxlength="64" class="form-control" id="id_nep_middle_name" />
                                            </div>
                                            <div class="col-md-3 mb-sm-2">
                                                <input type="text" name="nep_last_name" value="<?=isset($result)?$result->nep_last_name:''?>" maxlength="64" class="form-control" required id="id_nep_last_name" />
                                            </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label">
                                      <span class="float-right">
                                        <Strong>Name(In English)</Strong>
                                        <span class="text-danger">&nbsp;*</span>
                                      </span>
                                        </label>
                                            <div class="col-md-3 mb-sm-2">
                                                <input type="text" name="eng_first_name" value="<?=isset($result)?$result->eng_first_name:''?>" maxlength="64" class="form-control" required id="id_eng_first_name" />
                                            </div>
                                            <div class="col-md-3 mb-sm-2">
                                                <input type="text" name="eng_middle_name" value="<?=isset($result)?$result->eng_middle_name:''?>" maxlength="64" class="form-control" id="id_eng_middle_name" />
                                            </div>
                                            <div class="col-md-3 mb-sm-2">
                                                <input type="text" name="eng_last_name" value="<?=isset($result)?$result->eng_last_name:''?>" maxlength="64" class="form-control" required id="id_eng_last_name" />
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label class="col-sm-6 col-form-label">
                                          <span class="float-right">
                                                <strong>लिङ्ग (Gender)</strong>
                                            <span class="text-danger">&nbsp;*</span>
                                          </span>
                                        </label>
                                            <div class="col-sm-6">
                                                 <select name="gender" class="form-control" required id="id_gender">
                                                    <option value="" selected>छान्नुहोस्</option>

                                                    <option value="Male" <?php if(isset($result) && $result->gender=="Male"){ echo 'selected="selected"';}?>>पुरुष</option>

                                                    <option value="Female" <?php if(isset($result) && $result->gender=="Female"){ echo 'selected="selected"';}?>>महिला</option>

                                                    <option value="Other" <?php if(isset($result) && $result->gender=="Other"){ echo 'selected="selected"';}?>>अन्य</option>

                                                  </select>
                                            </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">
                                          <span class="float-right">
                                                <strong>जन्म मिति (Date of birth)</strong>
                                            <span class="text-danger">&nbsp;*</span>
                                          </span>
                                        </label>
                                            <div class="col-sm-7">
                                                <div class="input-group mb-sm-2">
                                                    <input type="text" name="nep_dob"  placeholder="YYYY-MM-DD" value="<?=isset($result)?$result->nep_dob:''?>" maxlength="10" class="form-control" required id="nepaliDate4" />
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">B.S.</span>
                                                    </div>
                                                    <input type="text" readonly="true" placeholder="YYYY-MM-DD" name="eng_dob" value="<?=isset($result)?$result->eng_dob:''?>"  class="form-control" required id="id_eng_dob" />
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">A.D.</span>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12 mb-3">
                            <h4>
                                जन्मस्थान (Place Of Birth)
                            </h4>
                            <hr style="border: 1px solid #adadad">
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label">
                                            <span class="float-right">
                                                <strong>ठेगाना </strong><span class="text-danger">&nbsp;*</span>
                                            </span>
                                        </label>
                                            <div class="col-md-3 mb-sm-2">
                                               <select name="j_state" class="form-control select2 state_selected" required id="state_selected-1">
                                                    <option value="" selected>प्रदेश</option>

                                                    <?php foreach($states as $data):?>
                                                    <option value="<?=$data->id?>"
                                                            <?php
                                                            if(isset($result) && $result->j_state == $data->id)
                                                            {
                                                                echo 'selected = "selected"';
                                                            }
                                                            elseif($data->id==$default[0])
                                                            {
                                                                echo 'selected="selected"';
                                                            }
                                                          ?>
                                                            ><?=$data->name?></option>
                                                    <?php endforeach;?>
                                                  </select>
                                            </div>
                                            <div class="col-md-3 mb-sm-2">
                                                <select name="j_district" class="form-control select2 district_selected" id="district_selected-1" required>
                                                    <option value="" selected>जिल्ला</option>
                                                <?php
                                                    foreach($districts as $district) {
                                                ?>
                                                        <option value="<?= $district->id ?>"
                                                            <?php if(isset($result->j_district)&&$result->j_district == $district->id)
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
                                                <select name="j_local_body" class="form-control select2 local_body_selected" id="local_body_selected-1" required>
                                                    <option value="" selected>गा.वि.स./न.पा </option>
                                                <?php
                                                    foreach($locals as $local)
                                                    {
                                                ?>
                                                        <option value="<?= $local->id ?>"
                                                            <?php if(isset($result->j_local_body)&&$result->j_local_body == $local->id)
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
                                            <div class="col-md-1 mb-sm-2">
                                                <select name="j_ward" class="form-control select2 ward_selected" id="ward_selected-1" required>
                                                    <option value="" selected>वडा नं</option>
                                                <?php
                                                    foreach($wards as $ward) {
                                                ?>
                                                        <option value="<?= $ward->id ?>"
                                                            <?php if(isset($result->j_ward)&&$result->j_ward == $ward->id)
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
                            </div>
                        </div>
                        <!--<div class="col-md-12">-->
                        <!--    <div class="row">-->
                        <!--        <div class="col-md-6">-->
                        <!--            <div class="form-group row">-->
                        <!--                <label class="col-md-4 col-form-label">-->
                        <!--                    <span class="float-right">-->
                        <!--                        <strong>(नेपालीमा)</strong><span class="text-danger">&nbsp;*</span>-->
                        <!--                    </span>-->
                        <!--                </label>-->
                        <!--                    <div class="col-sm-8">-->
                        <!--                        <input type="text" name="birthplace_nep" value="<?=isset($result)?$result->birthplace_nep:''?>"  maxlength="512" class="form-control" required id="id_birthplace_nep" />-->
                        <!--                    </div>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--        <div class="col-md-6">-->
                        <!--            <div class="form-group row">-->
                        <!--                <label class="col-md-4 col-form-label">-->
                        <!--              <span class="float-right">-->
                        <!--                <Strong>(In English)</Strong>-->
                        <!--                <span class="text-danger">&nbsp;*</span>-->
                        <!--              </span>-->
                        <!--                </label>-->
                        <!--                    <div class="col-sm-8">-->
                        <!--                        <input type="text" name="birthplace_eng" value="<?=isset($result)?$result->birthplace_eng:''?>"  maxlength="512" class="form-control" required id="id_birthplace_eng" />-->
                        <!--                    </div>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12 mb-3">
                            <h4>
                                स्थाई ठेगाना (Permanent Address)
                            </h4>
                            <hr style="border: 1px solid #adadad">
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label">
                                            <span class="float-right">
                                                <strong>ठेगाना </strong><span class="text-danger">&nbsp;*</span>
                                            </span>
                                        </label>
                                            <div class="col-md-3 mb-sm-2">
                                               <select name="p_state" class="form-control select2 state_selected" required id="state_selected-1">
                                                    <option value="" selected>प्रदेश</option>

                                                    <?php foreach($states as $data):?>
                                                    <option value="<?=$data->id?>"
                                                            <?php
                                                            if(isset($result) && $result->p_state == $data->id)
                                                            {
                                                                echo 'selected = "selected"';
                                                            }
                                                            elseif($data->id==$default[0])
                                                            {
                                                                echo 'selected="selected"';
                                                            }
                                                          ?>
                                                            ><?=$data->name?></option>
                                                    <?php endforeach;?>
                                                  </select>
                                            </div>
                                            <div class="col-md-3 mb-sm-2">
                                                <select name="p_district" class="form-control select2 district_selected" id="district_selected-1" required>
                                                    <option value="" selected>जिल्ला</option>
                                                <?php
                                                    foreach($districts as $district) {
                                                ?>
                                                        <option value="<?= $district->id ?>"
                                                            <?php if(isset($result->p_district)&&$result->p_district == $district->id)
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
                                                <select name="p_local_body" class="form-control select2 local_body_selected" id="local_body_selected-1" required>
                                                    <option value="" selected>गा.वि.स./न.पा </option>
                                                <?php
                                                    foreach($locals as $local)
                                                    {
                                                ?>
                                                        <option value="<?= $local->id ?>"
                                                            <?php if(isset($result->p_local_body)&&$result->p_local_body == $local->id)
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
                                            <div class="col-md-1 mb-sm-2">
                                                <select name="p_ward" class="form-control select2 ward_selected" id="ward_selected-1" required>
                                                    <option value="" selected>वडा नं</option>
                                                <?php
                                                    foreach($wards as $ward) {
                                                ?>
                                                        <option value="<?= $ward->id ?>"
                                                            <?php if(isset($result->p_ward)&&$result->p_ward == $ward->id)
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
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <h4>
                                बुबाको नाम (Father's Name)
                            </h4>
                            <hr style="border: 1px solid #adadad">
                        </div>

                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">
                                            <span class="float-right">
                                                <strong>(नेपालीमा)</strong><span class="text-danger">&nbsp;*</span>
                                            </span>

                                        </label>

                                            <div class="col-sm-8">
                                                <input type="text" name="father_name_nep" value="<?=isset($result)?$result->father_name_nep:''?>"  maxlength="164" class="form-control" id="id_father_name_nep" />
                                            </div>

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">
                                      <span class="float-right">
                                        <Strong>(In English)</Strong>
                                        <span class="text-danger">&nbsp;*</span>
                                      </span>
                                        </label>

                                            <div class="col-sm-8">
                                                <input type="text" name="father_name_eng" value="<?=isset($result)?$result->father_name_eng:''?>"  maxlength="164" class="form-control" id="id_father_name_eng" />
                                            </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <h4>
                                आमाको नाम (Mother's Name)
                            </h4>
                            <hr style="border: 1px solid #adadad">
                        </div>

                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">
                                            <span class="float-right">
                                                <strong>(नेपालीमा)</strong><span class="text-danger">&nbsp;*</span>
                                            </span>

                                        </label>

                                            <div class="col-sm-8">
                                                <input type="text" name="mother_name_nep" value="<?=isset($result)?$result->mother_name_nep:''?>"  maxlength="164" class="form-control" id="id_mother_name_nep" />
                                            </div>

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">
                                      <span class="float-right">
                                        <Strong>(In English)</Strong>
                                        <span class="text-danger">&nbsp;*</span>
                                      </span>
                                        </label>

                                            <div class="col-sm-8">
                                                <input type="text" name="mother_name_eng" value="<?=isset($result)?$result->mother_name_eng:''?>"  maxlength="164" class="form-control" id="id_mother_name_eng" />
                                            </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <h4>
                                संरक्षकको विवरण (Guardian's Detail)
                            </h4>
                            <hr style="border: 1px solid #adadad">
                        </div>

                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">
                                            <span class="float-right">
                                                <strong>नाम (नेपालीमा)</strong><span class="text-danger">&nbsp;*</span>
                                            </span>

                                        </label>

                                            <div class="col-sm-8">
                                                <input type="text" name="gurdians_name_nep" value="<?=isset($result)?$result->gurdians_name_nep:''?>"  maxlength="164" class="form-control" required id="id_gurdians_name_nep" />
                                            </div>

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">
                                      <span class="float-right">
                                        <Strong>Name (In English)</Strong>
                                        <span class="text-danger">&nbsp;*</span>
                                      </span>
                                        </label>

                                            <div class="col-sm-8">
                                                <input type="text" name="gurdians_name_eng" value="<?=isset($result)?$result->gurdians_name_eng:''?>"  maxlength="164" class="form-control" required id="id_gurdians_name_eng" />
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
                                                <strong>ठेगाना</strong><span class="text-danger">&nbsp;*</span>
                                            </span>

                                        </label>

                                            <div class="col-sm-8">
                                                <input type="text" name="gurdians_address" value="<?=isset($result)?$result->gurdians_address:''?>"  maxlength="512" class="form-control" required id="id_gurdians_address" />
                                            </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="mt-5 mb-4" style="border: 1px solid #adadad">

                    <div class="row">
                        <div class="col-lg-5">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h5>संलग्न प्रमाणहरु :-</h5>
                                    <ul>
                                        <li>नाता ........................ को ना.प्र.प. प्रतिलिपि</li>
                                        <li>सनाखत गर्ने प्रतिलिपि</li>
                                        <li>शैशिक योग्यता प्र.प. / जन्म दर्ता प्र.प. प्रतिलिपि</li>
                                        <li>मतदाता नामावली प्र.पत्र / पारिवारिक लागतको प्र.प. प्रतिलिपि</li>
                                        <li>बिबाह दर्ता प्र.प. / बसाई सराई दर्ता प्र.प. प्रतिलिपि</li>
                                        <li>घर जग्गा कर, व्यवसायी प्रमाण पत्र प्रतिलिपि</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7" style="border-left: 2px solid #d4d4d4">


<div class="row">
    <div class="col-sm-3 text-right">
        <label>कागजातहरू <span class="text-danger">*</span> </label>
    </div>

    <div class="col-sm-9">
        <div class="mb-3 documents" id="doc_div_0">
                                       <input type="file" name="documents[]" id="documents_0" style="width:300px;" />
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
                        <div class="col-lg-6 offset-lg-6">
                            <div class="row">
                        <span class="col-sm-9 offset-sm-3">
                          <button type="submit" class='btn btn-submit btn-block btn-primary'
                                  name="submit">पेश गर्नुहोस्</button>
                        </span>
                            </div>
                        </div>
                    </div>

                 <?php echo form_close();?>

        </div>
    </div>

    </section>
</div>
<script src="<?=base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<script>
    function checkMyDate(date_selected, id_selected)
    {
      if(id_selected=="nepaliDate4")
      {
//        console.log(obj);
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
