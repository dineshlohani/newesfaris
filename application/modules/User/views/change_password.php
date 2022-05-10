<?php
$id = $this->uri->segment(2);
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






    <div class="container">
        <div class="row mb-4">
            <div class="col-md-offset-3 col-md-6">


            </div>
        </div>
        <div class="row">
            <div class="offset-md-3 col-md-6 mt-3 mb-3">


                <div class="form-wrap mt-4 mb-4">
                    <?php echo form_open_multipart(base_url()."change-password/".$id); ?>
                    <?php if(empty($id)):?>
                        <div class="form-group">
                            <label class="control-label">Current Password</label>
                            <input type="password" name="old_password" class="form-control" required placeholder="Enter your current password" id="id_current_password" />

                        </div>
                    <?php endif; ?>
                    <div class="form-group">
                        <label class="control-label">New Password</label>
                        <input type="password" name="password" class="form-control" required placeholder="Enter your new password" id="id_new_password" />

                    </div>

                    <div class="form-group">
                        <label class="control-label">Confirm New Password</label>
                        <input type="password" name="confirm" class="form-control" required placeholder="Enter your new password password" id="id_confirm_new_password" />

                    </div>

                    <div class="form-group mt-4">
                        <button type="submit" name="submit" class="btn btn-success btn-md btn-block">
                            Submit &nbsp;<i class="fa fa-sign-in"></i>
                        </button>
                    </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

</section>
</div>
