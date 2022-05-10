<?php
    if($this->uri->segment(2)== "create")
    {
    $action_page = "home-recommend/create";
    }
    if($this->uri->segment(2)=="edit")
    {
    $action_page = "home-recommend/edit/".$this->uri->segment(3);
    }
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
            <ol class="breadcrumb">
                <li class="breadcrumb-item ml-1"><a href="/">गृह</a></li>


                <li class="breadcrumb-item active">घर कायमको सिफारिस</li>

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

                <?php echo form_open($action_page)?>
                 <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label"><span
                                        class="float-right">आवेदन गरिएको मिति<span
                                            class="text-danger">&nbsp;*</span></span></label>


                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="text" name="nepali_date" class="form-control" id="nepaliDate4" value="<?=isset($result->nepali_date) ? $result->nepali_date : DateEngToNep(date('Y-m-d')) ?>" required />

                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3 pt-3">
                            <h4 style="margin-left: 10px; border-bottom: 2px solid #333;" class="pb-2">
                                घर कायम सिफारिस विवरण
                            </h4>

                        </div>

                        <div class="col-md-12">
                            <div class="row">
                            
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">
                                            <span class="float-right">
                                                आवेदकको नाम<span class="text-danger">&nbsp;*
                                                </span>
                                            </span>
                                        </label>
                                        <label class="col-md-3 col-form-label">
                                            <select name="gender_spec" class="form-control" id="gender_spec" required>
                                                    <option value="श्री" selected>श्री</option>
                                                    <option value="श्रीमती" selected>श्रीमती</option>
                                                    <option value="सुश्री" selected>सुश्री</option>                        
                                            </select>
                                        </label>
                                        <label class="col-md-4 col-form-label">
                                        
                                            <input type="text" name="applicant_name" class="form-control" id="id_applicant_name" maxlength="120" value="<?=isset($result->applicant_name) ? $result->applicant_name : '' ?>" required />
                                       
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">
                                            <span class="float-right">
                                                नागरिकता नं<span class="text-danger">&nbsp;*</span>
                                            </span>

                                        </label>

                                        <div class="col-sm-8">
                                            <input type="text" name="cit_no" class="form-control" id="cit_no" maxlength="120" value="<?=isset($result->cit_no) ? $result->cit_no : '' ?>" required />
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
                                            <input type="text" name="con_no" class="form-control" id="con_no" maxlength="120" value="<?=isset($result->con_no) ? $result->cit_no : '' ?>" required />
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">
                                            <span class="float-right">
                                              जग्गाको ठेगाना<span class="text-danger">&nbsp;*</span>
                                            </span>

                                </label>

                                <div class="col-md-2 mb-sm-2">
                                    <select name="state" class="form-control select2 state_selected" id="state_selected-1" required >
                                        <option value="" selected>प्रदेश</option>
                                        <?php
                                                foreach($states as $state) {
                                            ?>

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
                                            <?php
                                                }
                                            ?>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-sm-2">
                                    <select name="district" class="form-control select2 district_selected" id="district_selected-1" required>
                                        <option value="" selected>जिल्ला</option>
                                    <?php
                                        foreach($districts as $district) {
                                    ?>
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
                                    <?php
                                        }
                                     ?>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-sm-2">
                                    <select name="local_body" class="form-control select2 local_body_selected" id="local_body_selected-1" required>
                                        <option value="" selected>गा.वि.स./न.पा </option>
                                    <?php
                                        foreach($locals as $local)
                                        {
                                    ?>
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
                                    <?php
                                        }
                                    ?>
                                    </select>
                                </div>
                                <div class="col-md-2 mb-sm-2">
                                    <select name="ward" class="form-control" id="id_ward_no" required>
                                        <option value="" selected>वडा नं</option>
                                    <?php
                                        foreach($wards as $ward) {
                                    ?>
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
                                                जग्गाको साबिक ठेगाना<span class="text-danger">&nbsp;*</span>
                                            </span>

                                        </label>

                                        <div class="col-sm-8">
                                            <select name="old_new_address" class="form-control" id="id_old_new_address" required>
                                                <option value="" selected>छान्नुहोस्</option>
                                            <?php
                                                foreach($addresses as $address) {
                                            ?>
                                                    <option value="<?= $address->id ?>"
                                                        <?php if(isset($result->old_new_address)&&$result->old_new_address == $address->id)
                                                        {
                                                            echo "selected='selected'";
                                                        }
                                                        ?>
                                                    > <?= $address->name ?></option>
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
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">
                                            <span class="float-right">
                                                नक्सा सिट नं<span
                                                    class="text-danger">&nbsp;*</span>
                                            </span>

                                        </label>

                                        <div class="col-sm-8">
                                            <input type="text" name="map_sheet_no" class="form-control" id="id_map_sheet_no" maxlength="16" value="<?=isset($result->map_sheet_no) ? $result->map_sheet_no : '' ?>" required />
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">
                                            <span class="float-right">
                                                कित्ता नं <span
                                                    class="text-danger">&nbsp;*</span>
                                            </span>

                                        </label>

                                        <div class="col-sm-8">
                                            <input type="text" name="kitta_no" class="form-control" id="id_kitta_no" maxlength="16" value="<?=isset($result->kitta_no) ? $result->kitta_no : '' ?>" required />
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3 mb-3">
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
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">
                                            <span class="float-right">
                                                घर नं
                                            </span>

                                        </label>

                                        <div class="col-sm-8">
                                            <input type="text" name="home_no" class="form-control" id="id_home_no" value="<?=isset($result->home_no) ? $result->home_no : '' ?>" maxlength="16" />
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">
                                            <span class="float-right">
                                                घरको प्रकार<span
                                                    class="text-danger">&nbsp;*</span>
                                            </span>

                                        </label>

                                        <div class="col-sm-8">
                                          <select name="home_type" class="form-control" required>
                                            <option value="">छान्नुहोस्</option>
                                            <?php
                                                foreach($home_types as $home_type)
                                                {
                                            ?>
                                              <option value="<?=$home_type->id?>"
                                                <?php if(isset($result->home_type)&&$result->home_type == $home_type->id)
                                                {
                                                    echo "selected='selected'";
                                                }
                                                ?>
                                                ><?= $home_type->name ?></option>
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
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-4">
                                            <span class="float-right">
                                                घर निर्माण भएको/अनुमति लिएको साल
                                        </label>

                                        <div class="col-sm-8">
                                            <input type="text" name="home_created_year" class="form-control" id="id_home_created_year" maxlength="4" value="<?=isset($result->home_created_year) ? $result->home_created_year : '' ?>"  />
                                        </div>

                                    </div>
                                </div>
                            </div><hr class="mt-5 mb-4">
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
                <?php echo form_close();?>

            </div>
        </div>
    </div>

</section>
</div>
<script src="<?=base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>
