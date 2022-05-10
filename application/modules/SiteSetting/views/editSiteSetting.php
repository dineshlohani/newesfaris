<?php
    $action_page = "SiteSetting/update";
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
                <li class="breadcrumb-item ml-1"><a href="<?php echo base_url()?>">गृह</a></li>
                <li class="breadcrumb-item active">Letter Setting</li>
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
                <?php echo form_open_multipart($action_page)?>
                <input type="hidden" name="id" value="<?php echo $site_data->id?>">
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label"><span
                                class="float-right">पालिकाको नाम<span
                                class="text-danger">&nbsp;*</span></span></label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                   <select class="form-control select2" name="palika_name_np">
                                        <?php if(!empty($locals)) :
                                            foreach($locals as $l) : ?>
                                                <option value="<?php echo $l->name?>" <?php if($site_data->palika_name == $l->name){ echo 'selected';}?>><?php echo $l->name?></option>
                                        <?php endforeach;endif;?>
                                       <option></option>
                                   </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 offset-md-3">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label"><span
                                class="float-right">पालिकाको नाम(English)<span
                                class="text-danger">&nbsp;*</span></span></label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                     <select class="form-control select2" name="palika_name_en">
                                        <?php if(!empty($locals)) :
                                            foreach($locals as $l) : ?>
                                                <option value="<?php echo $l->english_name?>" <?php if($site_data->palika_name_en == $l->english_name){ echo 'selected';}?>><?php echo $l->english_name?></option>
                                        <?php endforeach;endif;?>
                                       <option></option>
                                   </select>
                                </div>
                            </div>
                        </div>
                    </div>

                   <!--  <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label"><span
                                class="float-right">पालिकाको नाम (font-size)<span
                                class="text-danger">&nbsp;*</span></span></label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="number" name="palika_font_size" class="form-control" required />
                                </div>
                            </div>
                        </div>
                    </div> -->

                    <div class="col-md-6 offset-md-3">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label"><span
                                class="float-right">गाउँ/नगर  कार्यपालिका (font-size)<span
                                class="text-danger">&nbsp;*</span></span></label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="text" name="karay_palika_np" class="form-control" required value="<?php echo $site_data->karay_palika_np?>" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 offset-md-3">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label"><span
                                class="float-right">गाउँ/नगर  कार्यपालिका (english)<span
                                class="text-danger">&nbsp;*</span></span></label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="text" name="karay_palika_en" class="form-control" required value="<?php echo $site_data->karay_palika_en?>"/>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-6 offset-md-3">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label"><span
                                class="float-right">प्रदेश(state)<span
                                class="text-danger">&nbsp;*</span></span></label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <select class="form-control select2" name="state_np">
                                        <?php if(!empty($states)) :
                                            foreach($states as $s) : ?>
                                            <option value="<?php echo $s->name?>" <?php if($s->name == $site_data->state_np){ echo 'selected';}?>><?php echo $s->name?></option>
                                        <?php endforeach;endif;?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 offset-md-3">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label"><span
                                class="float-right">प्रदेश(English)<span
                                class="text-danger">&nbsp;*</span></span></label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <select class="form-control select2" name="state_en">
                                        <?php if(!empty($states)) :
                                            foreach($states as $se) : ?>
                                            <option value="<?php echo $se->english_name?>" <?php if($se->english_name == $site_data->state_en){ echo 'selected';}?>><?php echo $se->english_name?></option>
                                        <?php endforeach;endif;?>
                                    </select>
                                   <!--  <input type="number" name="palika_font_size" class="form-control" required /> -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 offset-md-3">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label"><span
                                class="float-right">जिल्ला<span
                                class="text-danger">&nbsp;*</span></span></label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <select class="form-control select2" name="district_np">
                                        <?php if(!empty($districts)) :
                                            foreach($districts as $d) : ?>
                                                <option value="<?php echo $d->name?>" <?php if($d->name == $site_data->district_np){ echo 'selected';}?>><?php echo $d->name?></option>
                                        <?php endforeach;endif;?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 offset-md-3">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label"><span
                                class="float-right">जिल्ला (english)<span
                                class="text-danger">&nbsp;*</span></span></label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <select class="form-control select2" name="district_en">
                                        <?php if(!empty($districts)) :
                                            foreach($districts as $d) : ?>
                                                <option value="<?php echo $d->english_name?>" <?php if($d->english_name == $site_data->district_en){ echo 'selected';}?>><?php echo $d->english_name?></option>
                                        <?php endforeach;endif;?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                 <!--    <div class="col-md-6 offset-md-3">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label"><span
                                class="float-right">पालिकाको नाम <span
                                class="text-danger">&nbsp;*</span></span></label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="number" name="palika_font_size" class="form-control" required />
                                </div>
                            </div>
                        </div>
                    </div> -->

                     <div class="col-md-6 offset-md-3">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label"><span
                                class="float-right">नेपाल सरकारको  लोगो  (logo) <span
                                class="text-danger">&nbsp;*</span></span></label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="file" name="sarkar_logo" class="form-control" <?php if(empty($site_data->id)){echo 'required';}?> />
                                </div>
                                <input type="hidden" name="old_sarkar_logo" value="<?php echo $site_data->sarkar_logo?>">

                                <?php if(!empty($site_data->id)):?>
                                    <img src="<?php echo base_url()?>assets/images/icons/<?php echo $site_data->sarkar_logo?>" style="height:100px;width: 100px;">
                                <?php endif;?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 offset-md-3">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label"><span
                                class="float-right">पालिकाको लोगो  (logo) <span
                                class="text-danger">&nbsp;*</span></span></label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="file" name="palika_logo" class="form-control" <?php if(empty($site_data->id)){echo 'required';}?>/>
                                </div>
                                <input type="hidden" name="old_palika_logo" value="<?php echo $site_data->palika_logo?>">
                                <?php if(!empty($site_data->palika_logo)):?>
                                    <img src="<?php echo base_url()?>assets/images/icons/<?php echo $site_data->palika_logo?>" style="height:100px;width: 100px;"><br>
                                    <a href="<?php echo base_url()?>SiteSetting/RemovePalikaLogo" style="color:red" onclick="return confirm('Are you sure?')"><i class="fa fa-trash" ></i> REMOVE</a>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 offset-md-3">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label"><span
                                class="float-right">पालिकाको नारा  (slogan) <span
                                class="text-danger">&nbsp;*</span></span></label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="text" name="palika_slogan" class="form-control" required  value="<?php echo $site_data->palika_slogan?>" />
                                </div>
                            </div>
                        </div>
                    </div>
<!-- old_palika_logo
old_sarkar_logo -->

                    <div class="col-md-6 offset-md-3">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label"><span
                                class="float-right">palika slogan  (english)<span
                                class="text-danger">&nbsp;*</span></span></label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="text" name="palika_slogan_en" class="form-control"  value="<?php echo $site_data->palika_slogan_en?>" required />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="col-md-6 offset-md-3">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label"><span
                                class="float-right">पालिकाको लोगो  (width)<span
                                class="text-danger">&nbsp;*</span></span></label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="number" name="palika_font_size" class="form-control" required />
                                </div>
                            </div>
                        </div>
                    </div> -->

                    <div class="col-md-6 offset-md-3">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label"><span
                                class="float-right">website<span
                                class="text-danger">&nbsp;*</span></span></label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="text" name="website" class="form-control" value="<?php echo $site_data->website?>" required />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 offset-md-3">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label"><span
                                class="float-right">phone no<span
                                class="text-danger">&nbsp;*</span></span></label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="number" name="phone_no" class="form-control" required value="<?php echo $site_data->phone_no?>" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 offset-md-3">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label"><span
                                class="float-right">Email<span
                                class="text-danger">&nbsp;*</span></span></label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="email" name="email" class="form-control" value="<?php echo $site_data->email?>" required />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 offset-md-3">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label"><span
                                class="float-right">Facebook<span
                                class="text-danger">&nbsp;*</span></span></label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="text" name="facebook" class="form-control" value="<?php echo $site_data->facebook?>" required />
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="mt-5 mb-4">

                    <div class="col-md-6 offset-md-3">
                        <div class="form-group row">
                            <button type="submit" class='btn btn-block btn-submit btn-primary' name="submit">सम्पादन
                                गर्नुहोस्
                            </button>
                        </div>
                    </div>
                  <!--  <div class="form-group row">
                        <div class="col-md-12">
                           
                        </div>
                    </div> -->

                </div>
                <?php echo form_close()?>
            </div>
        </div>
    </div>