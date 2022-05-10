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
                                <p class="lead text-center"> आजको मितिमा कति वोटा दर्ता नं रिजभ गर्न चाहानुहुन्छ ?
                                </p>
                                <?php echo form_open(base_url().'darta-fix'); ?>
                                <div class="form-row">
                                    <div class="col-md-12 mt-3 mb-2">
                                        मिति<span class="text-danger">*</span></span>
                                        <input type="text" class="form-control" name="nepali_darta_miti" id="nepaliDate4" value="<?= generateCurrDate()?>" required>
                                    </div>
                                    <div class="col-md-12 mt-3 mb-2">
                                        <input type="number" class="form-control" name="number" required>
                                    </div>

                                </div>
                                <div class="form-row">
                                        <div class="col-md-6 mt-3 mb-2">
                                            <input type="submit" class="btn btn-lg btn-primary btn-block " name="submit" value="सेभ गर्नुहोस" style="margin-left:120px">
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
