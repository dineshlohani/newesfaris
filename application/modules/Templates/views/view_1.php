<?php
    //if($this->uri->segment(2)== "create")
    // {
    $action_page = "Templates/submitFirstPage";
    // $name = "नवीनतम डाटा";
    // }
    // if($this->uri->segment(2)=="edit")
    // {
    // $action_page = "citizenship-certificate/edit/".($this->uri->segment(3));
    // $name = "सच्याउनुहोस";
    // }
//    echo $action_page;exit;
$path = base_url()."assets/documents/certificate/citcertificate/";
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
        <li class="breadcrumb-item ml-1"><a href="<?=  base_url()?>certificate-dashboard">गृह</a></li>
        <li class="breadcrumb-item"><a href="<?=  base_url()?>citizenship-certificate"> नागरिकता प्रमाण पत्र </a></li>
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
        <div class="alert alert-success alert-dismissible"> <a href="#" class="close" data-dismiss="alert"
            aria-label="close">&times;</a><span><?=$this->session->flashdata('msg');?></span></div>
        <?php } ?>
        <?php if(!empty($this->session->flashdata('err_msg')))
                {?>
        <div class="alert alert-danger alert-dismissible"> <a href="#" class="close" data-dismiss="alert"
            aria-label="close">&times;</a><span><?=$this->session->flashdata('err_msg');?></span></div>
        <?php } ?>
        <?php echo form_open_multipart($action_page)?>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-4 col-form-label"><span class="float-right">आवेदन गरिएको मिति<span
                    class="text-danger">&nbsp;*</span></span></label>
              <div class="col-sm-6">
                <div class="input-group">
                  <input type="text" name="nepali_date" placeholder="YYYY-MM-DD" maxlength="10" class="form-control"
                    required id="nepaliDate5"
                    value="<?=(isset($result))? $result->nepali_date:DateEngToNep(date('Y-m-d'))?>" />
                  <div class="input-group-append">
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="row">
              <div class="col-md-4">
                नागरिकताको आधार :
              </div>
              <div class="col-md-8">
                <select name="cit_type">
                  <option value="अंगीकृत"
                    <?php if(isset($result) && $result->cit_type == "अंगीकृत"){ echo 'selected';}?>>
                    अंगीकृत
                  </option>
                </select>
              </div>
            </div>
          </div>

        </div>
        <div class="row ">
          <div class="col-md-12 mb-3">
            <h4>
              व्यक्तिगत विवरण (Personal Detail)
            </h4>
            <hr style="border: 1px solid #adadad">
          </div>

          <div class="col-md-12">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group row">
                  <label class="col-md-2 col-form-label">
                    <span class="">
                      <strong>पुरा नाम, थर</strong><span class="text-danger">&nbsp;*</span>
                    </span>
                  </label>
                  <div class="col-md-3 mb-sm-2">
                    <input type="text" name="nep_first_name" value="<?=(isset($result))? $result->nep_first_name:''?>"
                      class="form-control" required placeholder="" id="id_nep_first_name" />
                  </div>

                  <label class="col-md-3 col-form-label">
                    <span class="">
                      <strong>Full Name (In Block)</strong><span class="text-danger">&nbsp;*</span>
                    </span>
                  </label>
                  <div class="col-md-4 mb-sm-2">
                    <input type="text" name="eng_first_name" value="<?=(isset($result))? $result->eng_first_name:''?>"
                      class="form-control" required placeholder="" id="id_eng_first_name" />
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
                    <span class="">
                      <strong>लिङ्ग (Gender)</strong>
                      <span class="text-danger">&nbsp;*</span>
                    </span>
                  </label>
                  <div class="col-sm-6">
                    <select name="gender" class="form-control" required id="id_gender">
                      <option value="" selected>छान्नुहोस्</option>
                      <option value="Male"
                        <?php if(isset($result) && $result->gender=="Male"){ echo 'selected="selected"';}?>>पुरुष
                      </option>
                      <option value="Female"
                        <?php if(isset($result) && $result->gender=="Female"){ echo 'selected="selected"';}?>>महिला
                      </option>
                      <option value="Other"
                        <?php if(isset($result) && $result->gender=="Other"){ echo 'selected="selected"';}?>>अन्य
                      </option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">
                    <span class="">
                      <strong>जन्म मिति (Date of birth)</strong>
                      <span class="text-danger">&nbsp;*</span>
                    </span>
                  </label>
                  <div class="col-sm-7">
                    <div class="input-group mb-sm-2">
                      <input type="text" name="nep_dob" placeholder="YYYY-MM-DD"
                        value="<?=isset($result)?$result->nep_dob:''?>" class="form-control nep_dob" required
                        id="nepaliDate4" />
                      <div class="input-group-append">
                        <span class="input-group-text">B.S.</span>
                      </div>
                      <input type="text" name="eng_dob" placeholder="YYYY-MM-DD"
                        value="<?=isset($result)?$result->eng_dob:''?>" class="form-control" required id="id_eng_dob" />
                      <div class="input-group-append">
                        <span class="input-group-text">A.D.</span>
                      </div>
                    </div>
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
                    <span class="">
                      <strong>पुरा गरेको उमेर</strong>
                      <span class="text-danger">&nbsp;*</span>
                    </span>
                  </label>
                  <div class="col-sm-6">
                    <input type="text" name="age" value="<?=(isset($result))? $result->nep_first_name:''?>"
                      class="form-control" required placeholder="" id="age" />
                  </div>
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">
                    <span class="float-right">
                      <strong>धर्म</strong>

                    </span>
                  </label>
                  <div class="col-sm-7">
                    <div class="input-group mb-sm-2">
                      <input type="text" name="religion" placeholder="" value="<?=isset($result)?$result->religion:''?>"
                        class="form-control" required id="religion" />
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
                    <span class="float-right">जन्म स्थान</strong><span class="text-danger">&nbsp;*</span>
                    </span>
                  </label>
                  <div class="col-md-2 mb-sm-2">
                    <select name="b_state" class="form-control select2 state_selected" id="state_selected-1">
                      <option value="" selected>प्रदेश</option>
                      <?php foreach($states as $bstate):?>
                      <option value="<?=$bstate->id?>" <?php
                                                            if(isset($result) && $result->b_state == $bstate->id)
                                                            {
                                                                echo 'selected = "selected"';
                                                            }
                                                            elseif($bstate->id==$default[0])
                                                            {
                                                                echo 'selected="selected"';
                                                            }
                                                          ?>><?=$bstate->name?></option>
                      <?php endforeach;?>
                    </select>
                  </div>
                  <div class="col-md-3 mb-sm-2">
                    <select name="b_district" class="form-control select2 district_selected" id="district_selected-1">
                      <option value="" selected>जिल्ला</option>
                      <?php
                                                    foreach($districts as $bdistrict) {
                                                ?>
                      <option value="<?= $bdistrict->id ?>" <?php if(isset($result->b_district)&&$result->b_district == $bdistrict->id)
                                                            {
                                                                echo "selected='selected'";
                                                            }
                                                            elseif($bdistrict->name==$default[1])
                                                                {
                                                                    echo 'selected="selected"';
                                                                }
                                                            ?>><?= $bdistrict->name ?></option>
                      <?php
                                                    }
                                                 ?>
                    </select>
                  </div>
                  <div class="col-md-3 mb-sm-2">
                    <select name="b_local_body" class="form-control select2 local_body_selected"
                      id="local_body_selected-1">
                      <option value="" selected>गा.पा./न.पा </option>
                      <?php
                                                    foreach($locals as $blocal)
                                                    {
                                                ?>
                      <option value="<?= $blocal->id ?>" <?php if(isset($result->b_local_body)&&$result->b_local_body == $blocal->id)
                                                            {
                                                                echo "selected='selected'";
                                                            }
                                                            elseif($blocal->name==$default[2])
                                                                {
                                                                    echo 'selected="selected"';
                                                                }
                                                            ?>><?= $blocal->name ?></option>
                      <?php
                                                    }
                                                ?>
                    </select>
                  </div>
                  <div class="col-md-2 mb-sm-2">
                    <select name="b_ward" class="form-control select2 ward_selected" id="ward_selected-1">
                      <option value="" selected>वडा नं</option>
                      <?php
                                                    foreach($wards as $bward) {
                                                ?>
                      <option value="<?= $bward->id ?>" <?php if(isset($result->b_ward)&&$result->b_ward == $bward->id)
                                                            {
                                                                echo "selected='selected'";
                                                            }
                                                            elseif($bward->id==$default[3])
                                                            {
                                                                    echo 'selected="selected"';
                                                            }
                                                            ?>><?= $bward->name ?></option>
                      <?php
                                                    }
                                                ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>

              <div class="col-md-8">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">
                    <span class="float-right">
                      <strong>टोल</strong>
                      <span class="text-danger">&nbsp;*</span>
                    </span>
                  </label>
                  <div class="col-sm-9">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">In Nepali</span>
                      </div>
                      <input type="text" name="nep_bp_tole" value="<?=isset($result)?$result->nep_bp_tole:''?>"
                        maxlength="64" class="form-control" id="id_nep_bp_tole" placeholder="टोल" />
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">In English</span>
                      </div>
                      <input type="text" name="eng_bp_tole" value="<?=isset($result)?$result->eng_bp_tole:''?>"
                        maxlength="64" class="form-control" id="id_eng_bp_tole" placeholder="Tole" />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-4">
          <div class="col-md-12">
            <h4>
              नेपाल भन्दा बाहिर जन्मिएको भए (Born Outside Of Nepal)
            </h4>
            <hr style="border: 1px solid #adadad">
          </div>

          <div class="col-md-12">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">
                    <span class="float-right">
                      <strong>( नेपालीमा )</strong>
                      <span class="text-danger">&nbsp;*</span>
                    </span>
                  </label>

                  <div class="col-sm-8">
                    <input type="text" name="country_name" placeholder="देशको नाम"
                      value="<?=isset($result)?$result->country_name:''?>" maxlength="164" class="form-control"
                      id="id_country_name" />
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">
                    <span class="float-right">
                      <strong></strong>
                      <span class="text-danger">&nbsp;*</span>
                    </span>
                  </label>

                  <div class="col-sm-8">
                    <input type="text" name="country_address" placeholder="पुरा ठेगाना"
                      value="<?=isset($result)?$result->country_address:''?>" maxlength="164" class="form-control"
                      id="id_country_address" />
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">
                    <span class="float-right">
                      <strong>( In English )</strong>
                      <span class="text-danger">&nbsp;*</span>
                    </span>
                  </label>

                  <div class="col-sm-8">
                    <input type="text" name="country_name_eng" placeholder="Country Name"
                      value="<?=isset($result)?$result->country_name_eng:''?>" maxlength="164" class="form-control"
                      id="id_country_name_eng" />
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">
                    <span class="float-right">
                      <strong></strong>
                      <span class="text-danger">&nbsp;*</span>
                    </span>
                  </label>

                  <div class="col-sm-8">
                    <input type="text" name="country_address_eng" placeholder="Full Address"
                      value="<?=isset($result)?$result->country_address_eng:''?>" maxlength="164" class="form-control"
                      id="id_country_address_eng" />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row mt-6">
          <div class="col-md-12">
            <h4>
              बुबाको विवरण (Father's Detail)<span>
              </span>
            </h4>
            <hr style="border: 1px solid #adadad">
          </div>

          <div class="col-md-12">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">
                    <span class="float-right">
                      <strong>नाम थर</strong>
                      <span class="text-danger">&nbsp;*</span>
                    </span>
                  </label>
                  <div class="col-sm-8">
                    <input type="text" name="father_name" value="<?=isset($result)?$result->father_name:''?>"
                      maxlength="164" class="form-control" id="id_father_name" />
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">
                    <span class="float-right">
                      <strong>नागरिकता नं.</strong>
                      <span class="text-danger">&nbsp;*</span>
                    </span>
                  </label>
                  <div class="col-sm-8">
                    <div class="input-group mb-sm-2">

                      <input type="text" name="f_citizenship_no"
                        value="<?=isset($result)?$result->f_citizenship_no:''?>" maxlength="64" class="form-control"
                        id="id_f_citizenship_no" />
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
                  <strong>(In Nepali) </strong><span class="text-danger">&nbsp;*</span>
                </span>
              </label>
              <div class="col-md-2 mb-sm-2">
                <select name="f_state" class="form-control select2 state_selected" id="state_selected-3">
                  <option value="" selected>प्रदेश</option>
                  <?php foreach($states as $fstate):?>
                  <option value="<?=$fstate->id?>" <?php
                                                            if(isset($result) && $result->f_state == $fstate->id)
                                                            {
                                                                echo 'selected = "selected"';
                                                            }
                                                            elseif($fstate->id==$default[0])
                                                            {
                                                                echo 'selected="selected"';
                                                            }
                                                          ?>><?=$fstate->name?></option>
                  <?php endforeach;?>
                </select>
              </div>
              <div class="col-md-2 mb-sm-2">
                <select name="f_district" class="form-control select2 district_selected" id="district_selected-3">
                  <option value="" selected>जिल्ला</option>
                  <?php
                                                    foreach($districts as $fdistrict) {
                                                ?>
                  <option value="<?= $fdistrict->id ?>" <?php if(isset($result->f_district)&&$result->f_district == $fdistrict->id)
                                                            {
                                                                echo "selected='selected'";
                                                            }
                                                            elseif($fdistrict->name==$default[1])
                                                                {
                                                                    echo 'selected="selected"';
                                                                }
                                                            ?>><?= $fdistrict->name ?></option>
                  <?php
                                                    }
                                                 ?>
                </select>
              </div>
              <div class="col-md-3 mb-sm-2">
                <select name="f_local_body" class="form-control select2 local_body_selected" id="local_body_selected-3">
                  <option value="" selected>गा.पा./न.पा </option>
                  <?php
                                                    foreach($locals as $flocal)
                                                    {
                                                ?>
                  <option value="<?= $flocal->id ?>" <?php if(isset($result->f_local_body)&&$result->f_local_body == $flocal->id)
                                                            {
                                                                echo "selected='selected'";
                                                            }
                                                            elseif($flocal->name==$default[2])
                                                                {
                                                                    echo 'selected="selected"';
                                                                }
                                                            ?>><?= $flocal->name ?></option>
                  <?php
                                                    }
                                                ?>
                </select>
              </div>
              <div class="col-md-1 mb-sm-2">
                <select name="f_ward" class="form-control select2 ward_selected" id="ward_selected-3">
                  <option value="" selected>वडा नं</option>
                  <?php
                                                    foreach($wards as $fatward) {
                                                ?>
                  <option value="<?= $fatward->id ?>" <?php if(isset($result->f_ward)&&$result->f_ward == $fatward->id)
                                                            {
                                                                echo "selected='selected'";
                                                            }
                                                            elseif($fward->id==$default[3])
                                                            {
                                                                    echo 'selected="selected"';
                                                            }
                                                            ?>><?= $fatward->name ?></option>
                  <?php
                                                    }
                                                ?>
                </select>
              </div>
              <div class="col-md-2 mb-sm-2">
                <input type="text" name="f_tole" value="<?=isset($result)?$result->f_tole:''?>" maxlength="64"
                  class="form-control" placeholder="टोल" id="id_f_tole" />
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-4">
          <div class="col-md-12">
            <h4>
              आमाको विवरण (Mother's Detail)
            </h4>
            <hr style="border: 1px solid #adadad">
          </div>

          <div class="col-md-12">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">
                    <span class="float-right">
                      <strong>नाम थर</strong>
                      <span class="text-danger">&nbsp;*</span>
                    </span>
                  </label>
                  <div class="col-sm-8">
                    <input type="text" name="mother_name" value="<?=isset($result)?$result->mother_name:''?>"
                      maxlength="164" class="form-control" id="id_mother_name" />
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">
                    <span class="float-right">
                      <strong>नागरिकता नं.</strong>
                      <span class="text-danger">&nbsp;*</span>
                    </span>
                  </label>
                  <div class="col-sm-8">
                    <div class="input-group mb-sm-2">

                      <input type="text" name="m_citizenship_no"
                        value="<?=isset($result)?$result->m_citizenship_no:''?>" maxlength="64" class="form-control"
                        id="id_m_citizenship_no" />
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
                  <strong>(In Nepali) </strong><span class="text-danger">&nbsp;*</span>
                </span>
              </label>
              <div class="col-md-2 mb-sm-2">
                <select name="m_state" class="form-control select2 state_selected" id="state_selected-4">
                  <option value="" selected>प्रदेश</option>

                  <?php foreach($states as $mstate):?>
                  <option value="<?=$mstate->id?>" <?php
                                                            if(isset($result) && $result->m_state == $mstate->id)
                                                            {
                                                                echo 'selected = "selected"';
                                                            }
                                                            elseif($mstate->id==$default[0])
                                                            {
                                                                echo 'selected="selected"';
                                                            }
                                                          ?>><?=$mstate->name?></option>
                  <?php endforeach;?>
                </select>
              </div>
              <div class="col-md-2 mb-sm-2">
                <select name="m_district" class="form-control select2 district_selected" id="district_selected-4">
                  <option value="" selected>जिल्ला</option>
                  <?php
                                                    foreach($districts as $mdistrict) {
                                                ?>
                  <option value="<?= $mdistrict->id ?>" <?php if(isset($result->m_district) && $result->m_district == $mdistrict->id)
                                                            {
                                                                echo "selected='selected'";
                                                            }
                                                            elseif($mdistrict->name==$default[1])
                                                                {
                                                                    echo 'selected="selected"';
                                                                }
                                                            ?>><?= $mdistrict->name ?></option>
                  <?php
                                                    }
                                                 ?>
                </select>
              </div>
              <div class="col-md-3 mb-sm-2">
                <select name="m_local_body" class="form-control select2 local_body_selected" id="local_body_selected-4">
                  <option value="" selected>गा.पा./न.पा </option>
                  <?php
                                                    foreach($locals as $mlocal)
                                                    {
                                                ?>
                  <option value="<?= $mlocal->id ?>" <?php if(isset($result->m_local_body)&&$result->m_local_body == $mlocal->id)
                                                            {
                                                                echo "selected='selected'";
                                                            }
                                                            elseif($mlocal->name==$default[2])
                                                                {
                                                                    echo 'selected="selected"';
                                                                }
                                                            ?>><?= $mlocal->name ?></option>
                  <?php
                                                    }
                                                ?>
                </select>
              </div>
              <div class="col-md-1 mb-sm-2">
                <select name="m_ward" class="form-control select2 ward_selected" id="ward_selected-4">
                  <option value="" selected>वडा नं</option>
                  <?php
                                                    foreach($wards as $mward) {
                                                ?>
                  <option value="<?= $mward->id ?>" <?php if(isset($result->m_ward)&&$result->m_ward == $mward->id)
                                                            {
                                                                echo "selected='selected'";
                                                            }
                                                            elseif($mward->id==$default[3])
                                                            {
                                                                    echo 'selected="selected"';
                                                            }
                                                            ?>><?= $mward->name ?></option>
                  <?php
                                                    }
                                                ?>
                </select>
              </div>
              <div class="col-md-2 mb-sm-2">
                <input type="text" name="m_tole" value="<?=isset($result)?$result->m_tole:''?>" maxlength="64"
                  class="form-control" placeholder="टोल" id="id_m_tole" />
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-4">
          <div class="col-md-12">
            <h4>
              पति / पत्नीको विवरण (Husband / Wife Detail)
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
                    </span>
                  </label>
                  <div class="col-sm-8">
                    <input type="text" name="husband_wife_name"
                      value="<?=isset($result)?$result->husband_wife_name:''?>" maxlength="164" class="form-control"
                      id="id_husband_wife_name" />
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">
                    <span class="float-right">
                      <strong>नागरिकता नं.</strong>
                    </span>
                  </label>
                  <div class="col-sm-8">
                    <div class="input-group mb-sm-2">

                      <input type="text" name="hw_citizenship_no"
                        value="<?=isset($result)?$result->hw_citizenship_no:''?>" maxlength="64" class="form-control"
                        id="id_hw_citizenship_no" />
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
                  <strong>(In Nepali) </strong>
                </span>
              </label>
              <div class="col-md-2 mb-sm-2">
                <select name="hw_state" class="form-control select2 state_selected" id="state_selected-5">
                  <option value="" selected>प्रदेश</option>
                  <?php foreach($states as $hwstate):?>
                  <option value="<?=$hwstate->id?>" <?php
                                                            if(isset($result) && $result->hw_state == $hwstate->id)
                                                            {
                                                                echo 'selected = "selected"';
                                                            }
                                                            elseif($hwstate->id==$default[0])
                                                            {
                                                                echo 'selected="selected"';
                                                            }
                                                          ?>><?=$hwstate->name?></option>
                  <?php endforeach;?>
                </select>
              </div>
              <div class="col-md-2 mb-sm-2">
                <select name="hw_district" class="form-control select2 district_selected" id="district_selected-5">
                  <option value="" selected>जिल्ला</option>
                  <?php
                                                    foreach($districts as $hwdistrict) {
                                                ?>
                  <option value="<?= $hwdistrict->id ?>" <?php if(isset($result->hw_district)&&$result->hw_district == $pwdistrict->id)
                                                            {
                                                                echo "selected='selected'";
                                                            } elseif($hwdistrict->name==$default[1])
                                                                {
                                                                    echo 'selected="selected"';
                                                                }
                                                            ?>><?= $hwdistrict->name ?></option>
                  <?php
                                                    }
                                                 ?>
                </select>
              </div>
              <div class="col-md-3 mb-sm-2">
                <select name="hw_local_body" class="form-control select2 local_body_selected"
                  id="local_body_selected-5">
                  <option value="" selected>गा.पा./न.पा </option>
                  <?php
                                                    foreach($locals as $hwlocal)
                                                    {
                                                ?>
                  <option value="<?= $hwlocal->id ?>" <?php if(isset($result->hw_local_body)&&$result->hw_local_body == $pwlocal->id)
                                                            {
                                                                echo "selected='selected'";
                                                            }  elseif($hwlocal->name==$default[2])
                                                                {
                                                                    echo 'selected="selected"';
                                                                }
                                                            ?>><?= $hwlocal->name ?></option>
                  <?php
                                                    }
                                                ?>
                </select>
              </div>
              <div class="col-md-1 mb-sm-2">
                <select name="hw_ward" class="form-control select2 ward_selected" id="ward_selected-5">
                  <option value="" selected>वडा नं</option>
                  <?php
                                                    foreach($wards as $hwward) {
                                                ?>
                  <option value="<?= $hwward->id ?>" <?php if(isset($result->hw_ward)&&$result->hw_ward == $pwward->id)
                                                            {
                                                                echo "selected='selected'";
                                                            } elseif($hwward->name==$default[3])
                                                                {
                                                                    echo 'selected="selected"';
                                                                }
                                                            ?>><?= $hwward->name ?></option>
                  <?php
                                                    }
                                                ?>
                </select>
              </div>
              <div class="col-md-2 mb-sm-2">
                <input type="text" name="hw_tole" value="<?=isset($result)?$result->hw_tole:''?>" maxlength="64"
                  class="form-control" placeholder="टोल" id="id_hw_tole" />
              </div>
            </div>
          </div>
        </div>

        <hr class="mt-5 mb-4" style="border: 1px solid #adadad">
        <div class="row">
          <div class="col-md-12">
            <h4>
              नेपालमा बसोबास गरेको विवरण
            </h4>
            <hr style="border: 1px solid #adadad">
          </div>
          <label class="col-sm-4 col-form-label">
            <span class="float-right">
              <strong>वर्ष</strong>
            </span>
          </label>
          <div class="col-sm-2">
            <div class="input-group mb-sm-2">

              <input type="text" name="hw_citizenship_no" value="<?=isset($result)?$result->hw_citizenship_no:''?>"
                maxlength="64" class="form-control" id="id_hw_citizenship_no" />
            </div>
          </div>
        </div>
        <hr class="mt-5 mb-4" style="border: 1px solid #adadad">
        <div class="row">
          <div class="col-md-12">
            <h4>
              नेपाली नागरिकताको छोरा वा छोरिको हकमा
            </h4>
            <hr style="border: 1px solid #adadad">
          </div>
          <label class="col-sm-1 col-form-label">
            <span class="float-right">
              <strong>राष्ट्रियता </strong>
            </span>
          </label>
          <div class="col-sm-3">
            <input type="text" name="hw_citizenship_no" value="<?=isset($result)?$result->hw_citizenship_no:''?>"
              class="form-control" id="id_hw_citizenship_no" />
          </div>

          <label class="col-sm-5 col-form-label">
            <span class="float-right">
              <strong>पिताको मुलुकबाट नागरिकता प्रमाणपत्र लिए नलिएको निस्सा</strong>
            </span>
          </label>
          <div class="col-sm-3">
            <input type="text" name="nissa_parmanpatra" value="<?=isset($result)?$result->nissa:''?>" maxlength="64"
              class="form-control" id="nissa_parmanpatra" />
          </div>

        </div>

        <hr class="mt-5 mb-4" style="border: 1px solid #adadad">
        <div class="row">
          <div class="col-md-12">
            <h4>
              नेपाली नागरिकसंग वैवाहिक संबन्ध भएकी विदेशी महिलाको हकमा
            </h4>
            <hr style="border: 1px solid #adadad">
          </div>
          <label class="col-sm-2 col-form-label">
            <span class="float-right">
              <strong>पतिको नाम </strong>
            </span>
          </label>
          <div class="col-sm-2">
            <input type="text" name="om_married" value="<?=isset($result)?$result->hw_citizenship_no:''?>"
              class="form-control" id="om_married" />
          </div>

          <label class="col-sm-2 col-form-label">
            <span class="float-right">
              <strong>विवाह भएको मिति</strong>
            </span>
          </label>
          <div class="col-sm-2">
            <input type="text" name="nissa_parmanpatra" value="<?=isset($result)?$result->nissa:''?>"
              class="form-control" id="nissa_parmanpatra" />
          </div>

          <label class="col-sm-4 col-form-label">
            <span class="float-right">
              <strong>अरु विदेशीको हकमा(कम्तिमा पन्ध्र वर्ष): <input type="checkbox" name="other_country"
                  value="<?=isset($result)?$result->other_country:1?>" class="" id="other_country" /></strong>
            </span>
          </label>

        </div>

        <hr style="border: 1px solid #adadad">
        <div class=" row mt-4">
          <div class="col-md-12 mb-3">
            <h4>
              नेपालमा स्थायी बसोबास गरेको ठाउँ र मिति
            </h4>
            <hr style="border: 1px solid #adadad">
          </div>
          <label class="col-md-2 col-form-label">
            <span class="float-right">
              <strong>(In Nepali) </strong><span class="text-danger">&nbsp;*</span>
            </span>
          </label>
          <div class="col-md-3 mb-sm-2">
            <select name="p_state" class="form-control select2 state_selected" required id="state_selected-2">
              <option value="" selected>प्रदेश</option>

              <?php foreach($states as $pstate):?>
              <option value="<?=$pstate->id?>" <?php
                                                                if(isset($result) && $result->p_state == $pstate->id)
                                                                {
                                                                    echo 'selected = "selected"';
                                                                }
                                                                elseif($pstate->id==$default[0])
                                                                {
                                                                    echo 'selected="selected"';
                                                                }
                                                              ?>><?=$pstate->name?></option>
              <?php endforeach;?>
            </select>
          </div>
          <div class="col-md-3 mb-sm-2">
            <select name="p_district" class="form-control select2 district_selected" id="district_selected-2" required>
              <option value="" selected>जिल्ला</option>
              <?php
                                                    foreach($districts as $pdistrict) {
                                                ?>
              <option value="<?= $pdistrict->id ?>" <?php if(isset($result->p_district)&&$result->p_district == $pdistrict->id)
                                                            {
                                                                echo "selected='selected'";
                                                            }
                                                            elseif($pdistrict->name==$default[1])
                                                                {
                                                                    echo 'selected="selected"';
                                                                }
                                                            ?>><?= $pdistrict->name ?></option>
              <?php
                                                    }
                                                 ?>
            </select>
          </div>
          <div class="col-md-3 mb-sm-2">
            <select name="p_local_body" class="form-control select2 local_body_selected" id="local_body_selected-2"
              required>
              <option value="" selected>गा.पा./न.पा </option>
              <?php
                                                    foreach($locals as $plocal)
                                                    {
                                                ?>
              <option value="<?= $plocal->id ?>" <?php if(isset($result->p_local_body)&&$result->p_local_body == $plocal->id)
                                                            {
                                                                echo "selected='selected'";
                                                            }
                                                            elseif($plocal->name==$default[2])
                                                                {
                                                                    echo 'selected="selected"';
                                                                }
                                                            ?>><?= $plocal->name ?></option>
              <?php
                                                    }
                                                ?>
            </select>
          </div>
          <div class="col-md-1 mb-sm-2">
            <select name="p_ward" class="form-control select2 ward_selected" id="ward_selected-2" required>
              <option value="" selected>वडा नं</option>
              <?php
                                                    foreach($wards as $pward) {
                                                ?>
              <option value="<?= $pward->id ?>" <?php if(isset($result->p_ward)&&$result->p_ward == $pward->id)
                                                            {
                                                                echo "selected='selected'";
                                                            }
                                                            elseif($pward->id==$default[3])
                                                            {
                                                                    echo 'selected="selected"';
                                                            }
                                                            ?>><?= $pward->name ?></option>
              <?php
                                                    }
                                                ?>
            </select>
          </div>

          <div class="col-md-8">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">
                <span class="float-right">
                  <strong>टोल</strong>
                  <span class="text-danger">&nbsp;*</span>
                </span>
              </label>
              <div class="col-sm-9">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">In Nepali</span>
                  </div>
                  <input type="text" name="nep_tole" value="<?=isset($result)?$result->nep_tole:''?>" maxlength="64"
                    class="form-control" id="id_nep_tole" placeholder="टोल" />
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">In English</span>
                  </div>
                  <input type="text" name="eng_tole" value="<?=isset($result)?$result->eng_tole:''?>" maxlength="64"
                    class="form-control" id="id_eng_tole" placeholder="Tole" />
                </div>
              </div>
            </div>
          </div>

          <label class="col-md-1 col-form-label">
            <span class="">
              <strong> मिति</strong><span class="text-danger">&nbsp;*</span>
            </span>
          </label>
          <div class="col-sm-3">
            <input type="text" name="hw_citizenship_no" value="<?=isset($result)?$result->hw_citizenship_no:''?>"
              class="form-control" id="id_hw_citizenship_no" />
          </div>

        </div>


        <div class="col-md-12 mb-3">
            <h4>
              हाल साथमा रहेको परिवारको बिबरण र संख्या 
            </h4>
            <hr style="border: 1px solid #adadad">
          </div>

              <table class="table" id="child_details">
                      <thead>
                        <tr>
                          <th>छोरा </th>
                          <th>छोरि</th>
                          <th>पति/पत्नी</th>
                          
                          <th style="width:50px;"></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><input type="text" class="form-control" name="member_name[]" value="" required></td>
                          <td><input type="text" class="form-control" name="member_name[]" value="" required></td>
                          <td><input type="text" class="form-control" name="member_name[]" value="" required></td>
                          <td><button type="button" class="btn btn-danger remove-row" data-toggle="tooltip" title="हटाउनुहोस्"><span class="fa fa-times" tabindex="-1"></span></button></td>
                        </tr>
                      </tbody>
                    </table>
                    <button type="button" class="btn btn-danger" id="new_add"><i class="fa fa-plus-circle"></i> नयाँ सदस्यको विवरण थप्नुहोस </button>
                    <!-- <input type=" id="name" class="btn btn-danger" value="addme"> -->
                </div><br>
                <div class="col-md-12 mb-3">
            <h4>
              भाषा 
            </h4>
            <hr style="border: 1px solid #adadad">
            <form action="/action_page.php">
  <input type="checkbox" id="language" name="language" value="नेपाली">
  <label for="language"><h5>नेपाली</h5></label>&nbsp&nbsp
  <input type="checkbox" id="language" name="language" value="नेपाली">
  <label for="language"><h5>नेवारी </h5></label>&nbsp&nbsp
  <input type="checkbox" id="language" name="language" value="नेपाली">
  <label for="language"> <h5>थारु </h5></label>&nbsp&nbsp
  <input type="checkbox" id="language" name="language" value="नेपाली">
  <label for="language"> <h5>मगर </h5></label>&nbsp&nbsp
  <input type="checkbox" id="language" name="language" value="नेपाली">
  <label for="language"> <h5>राई</h5></label>&nbsp&nbsp
  <input type="checkbox" id="language" name="language" value="नेपाली">
  <label for="language"> <h5>मैथली </h5></label>&nbsp&nbsp
  <input type="checkbox" id="language" name="language" value="नेपाली">
  <label for="language"> <h5>उर्दु</h5></label>&nbsp&nbsp
  <input type="checkbox" id="language" name="language" value="नेपाली">
  <label for="language"> <h5>तामाङ </h5></label>&nbsp&nbsp
  <input type="checkbox" id="language" name="language" value="नेपाली">
  <label for="language"> <h5>भोजपुरी </h5></label>
            <hr style="border: 1px solid #adadad">
          </div>
             <div class="col-md-12 mb-3">
            <h4>
             मेरो जिबन निर्बाह गर्ने 
            </h4>
            <hr style="border: 1px solid #adadad">
          </div>

              <table class="table" id="add_new_members">
                      <thead>
                        <tr>
                          <th>साधन </th>
                          <th>योग्यता </th>
                          <th>हालको ब्याबसाय </th>
                          
                          <th style="width:50px;"></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><input type="text" class="form-control" name="member_name[]" value="" required></td>
                          <td><input type="text" class="form-control" name="member_name[]" value="" required></td>
                          <td><input type="text" class="form-control" name="member_name[]" value="" required></td>
                          <td><button type="button" class="btn btn-danger remove-row" data-toggle="tooltip" title="हटाउनुहोस्"><span class="fa fa-times" tabindex="-1"></span></button></td>
                        </tr>
                      
                      </table>
                    <button type="button" class="btnAddNew" id="newBtn"><i class="fa fa-plus-circle"></i> नयाँ थप्नुहोस </button>
                    

                </div>

              </div>


        <div class="row mt-4">
          <div class="col-md-12 mb-3">
        <hr>
        <div class="row">
          <div class="col-lg-10">
            <div class="row">
              <div class="col-sm-2 text-right">
                <label>कागजातहरू <span class="text-danger">*</span> </label>
              </div>
              <div class="col-sm-10">
                <div class="mb-3 documents" id="doc_div_0">
                  <input type="file" name="documents[]" id="documents_0" style="width:300px" />
                  <select name="documents_type[]" id="documents_type_0">
                    <option value="">प्रकार छान्नुहोस्</option>

                    <?php foreach($documents as $doc):?>
                    <option value="<?= $doc->id?>"><?= $doc->name ?></option>
                    <?php endforeach;?>
                  </select>
                  <button type="button" class="float-right btn btn-danger delete-form doc_remove"
                    id="documents_remove_0"><i class="fa fa-times"></i></button>
                </div>
                <div id="document_div"></div>

                <!-- This button will add a new form when clicked -->
                <button type="button" class="btn btn-success" data-formset-add><i id="documents"
                    class="fa fa-plus"></i></button>
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
        <hr class="mt-5 mb-4">
        <div class="form-group row">
          <div class="col-sm-6 offset-sm-6 mt-4">
            <button type="submit" class='btn btn-block btn-submit btn-primary' name="submit">पेश
              गर्नुहोस्
            </button>
          </div>
        </div>
        <?php echo form_close();?>
      </div>
    </div></div>
</section>
</div>
<script src="<?=base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<script>
 function checkMyDate(date_selected, id_selected) {
   if (id_selected == "nepaliDate4") {
     var nep_dob = date_selected;
     param = {};
     param.nep_dob = nep_dob;
     JQ.ajax({
      url: "<?= base_url()?>getConvertedDate",
     method: "POST",
       data: param,
      success: function(data) {
         var obj = JSON.parse(data);
         JQ("#id_eng_dob").val(obj.html);
       },
       error: function(error) {
         console.log(JSON.stringify(error));
      }
     });
   }
 }
</script>
<script>
 var JQ = jQuery.noConflict();
  $(document).ready(function(){
    $(document).on("click","#new_add",function(){
      JQ.ajax({
        url: "<?= base_url()?>Templates/getChildData",
        method: "POST",
        data: '',
        success: function(data) {
          var obj = JSON.parse(data);
          JQ("#child_details").append(obj.html);
        }
      });
    });
    var JQ = jQuery.noConflict();
  $(document).ready(function(){
    $(document).on("click","#newBtn",function(){
      JQ.ajax({
        url: "<?= base_url()?>Templates/getLifeData",
        method: "POST",
        data: '',
        success: function(data) {
          var obj = JSON.parse(data);
          JQ("#add_new_members").append(obj.html);
        }
      });
    });
  });
    $("body").on("click",".child_remove_one", function(e){
            e.preventDefault();
            var id = $(this).data('id');
            
              $(this).parent().parent().remove();
            
        });
        $("body").on("click",".row_remove_two", function(e){
            e.preventDefault();
            var id = $(this).data('id');
          
              $(this).parent().parent().remove();
            
        });
    JQ(document).on("click", "#documents", function() {
      
      var count = JQ(".documents").length;
      param = {};
      param.count = count;
      JQ.ajax({
        url: "<?= base_url()?>getRoadDocumentHTML",
        method: "POST",
        data: param,
        success: function(data) {
          var obj = JSON.parse(data);
          JQ("#document_div").append(obj.html);
        }
      });
    });
    JQ(document).on("click", ".doc_remove", function() {
      var id_selected = JQ(this).attr("id");
      var res = id_selected.split("_");
      var id = res[res.length - 1];
      JQ("#doc_div_" + id).remove();
    });

    JQ(document).on('change', 'input[name=is_protector]', function() {
      var value = JQ(this).val();
      switch (value) {
        case 'father':
          var state = JQ("select[name=f_state] ").val();
          var district = JQ("select[name=f_district]").val();
          JQ("#id_protector_name").val(JQ("#id_father_name").val());
          JQ("select[name=s_state]").select2('val', state);
          JQ("select[name=s_district]").select2('val', district);
          break;
        default:
      }
    });
    JQ(document).on("click", "#buwa", function() {
      var father_name = JQ("#id_father_name").val();
      JQ("#id_protector_name").val(father_name);
    });
    JQ(document).on("click", "#aama", function() {
      var mother_name = JQ("#id_mother_name").val();
      JQ("#id_protector_name").val(mother_name);
        //add new row
      $('.btnAddNew').click(function(e) {
        e.preventDefault();
          var new_row = 
          '<tr>'+
            '<td><textarea class="form-control" name="aim[]"></textarea></td>'+
            '<td><button type="button" class="btn btn-danger remove-row" data-toggle="tooltip" title="हटाउनुहोस्"><span class="fa fa-times" tabindex="-1"></span></button></td>'+
          '<tr>'
          $("#add_new_fields").append(new_row);
      });
      $("body").on("click",".remove-row", function(e){
        e.preventDefault();
        if (confirm('के तपाइँ  यसलाई हटाउन निश्चित हुनुहुन्छ ?')) {
          $(this).parent().parent().remove();
        }
      });
    });
    JQ(document).on("input", "#id_nep_bp_tole,#id_eng_bp_tole", function() {
      var nep_tole = JQ("#id_nep_bp_tole").val();
      var eng_tole = JQ("#id_eng_bp_tole").val();

      JQ("#id_nep_tole").val(nep_tole);
      JQ("#id_eng_tole").val(eng_tole);
      JQ("#id_f_tole").val(nep_tole);
      JQ("#id_m_tole").val(nep_tole);
      JQ("#id_hw_tole").val(nep_tole);
      JQ("#id_p_tole").val(nep_tole);
    });
    
  });
</script>