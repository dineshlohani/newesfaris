<?php
    $id = $this->uri->segment(3);
    $uri_accept     = base_url().$this->uri->segment(1)."/chalani/".$id;
    $uri_decline    = base_url().$this->uri->segment(1)."/detail/".$id;

?>
<section class="content ">

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

    <div class="card">
        <div class="card-body  p-y-20 ">
            <div class="delete-page ">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="offset-md-3 col-md-6">
                                <p class="lead text-center"> के तपाई यो डेटा चलानी गर्न चाहानु हुन्छ ?
                                </p>
                                <?php echo form_open($uri_accept)?>
                                <div class="form-row">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">
                                            <span class="float-right">
                                                फाँट
                                            </span>
                                        </label>
                                        <div class="col-sm-5">
                                            <select name="department" class="form-control select2">
                                                <option value="">छान्नुहोस्</option>
                                                <?php foreach($departments as $depart) : ?>
                                                    <option value="<?= $depart->id ?>"><?= $depart->name?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="button" id="depart_check" class="btn btn-primary" value="अन्य फाँट" ><br/><br/>
                                            <input name="department_other"  type="text" class="form-control" id="depart_other" placeholder="फाँटको नाम" style="display:none;">
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    $url = $this->uri->segment(1);
                                    $this_item = Modules::run('Settings/getPatraItemByURI',$url);
                                    if(!empty($this->session->userdata('department')) && ($this_item == FALSE)):
                                ?>
                                    <div class="form-row">
                                        <div class="form-group row">
                                            <label class="col-md-4 col-form-label">
                                                <span class="float-right">
                                                    कार्यलय<span class="text-danger">&nbsp;*</span>
                                                </span>

                                            </label>
                                            <div class="col-sm-8">
                                                <select name="office" class="form-control select2">
                                                    <option value="">छान्नुहोस्</option>
                                                    <?php foreach($offices as $office) : ?>
                                                        <option value="<?= $office->id ?>"><?= $office->name?></option>
                                                    <?php endforeach;?>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                <?php
                                    endif;
                                ?>
                                    <div class="form-row">
                                        <div class="col-md-6 mt-3 mb-2">
                                            <input type="submit" class="btn btn-lg btn-danger btn-block " name="submit" value="चाहान्छु">
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <a href="<?= $uri_decline?>"
                                               class="btn btn-secondary btn-lg btn-block ">चाहन्न</a>
                                        </div>
                                    </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>

</section>
</div>
