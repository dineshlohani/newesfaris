<?php
if(isset($result))
{
    $action_page = base_url()."edit-land-type/".$result->id;
}
else
{
    $action_page = base_url()."land-type";
}

?>
<section class="content">

  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
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
      </div>
    </div>
  </div>



  <div class="container-fluid ">
    <nav aria-label="breadcrumb" class="bg-shadow">
      <ol class="breadcrumb px-3 py-2">
        <li class="breadcrumb-item ml-1"><a href="<?= base_url()?>dashboard">गृह</a></li>


        <li class="breadcrumb-item active">सेटिंग्स</li>

        <li class="breadcrumb-item active"> खुल्ला ढाँचा</li>

      </ol>
    </nav>
  </div>




  <div class="container-fluid ">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="offset-lg-1 col-lg-10">
            <form action="<?php echo base_url()?>Settings/update_letter_subject" method="post">
              <input type="hidden" value="<?php echo $row->id?>" name="id">
              <div class="col-md-10" style="font-size:17px; color:black;">
                <div class="form-group row">
                  पत्रको किसिम:
                  <select name="md_letter_type" id='md_letter_type' class="form-control" required="true">
                    <option value="">छान्नुहोस्</option>
                    <?php if($letter_types != FALSE): ?>
                    <?php foreach($letter_types as $type): ?>
                    <option value=" <?= $type->id ?>" <?php if($type->id == $row->letter_type){ echo 'selected';}?>>
                      <?= $type->name ?> </option>
                    <?php endforeach; ?>
                    <?php endif; ?>
                  </select>
                </div>
              </div>
              <div class="col-md-10" style="font-size:17px; color:black;">
                <div class="form-group row">
                  विषय: <input type="text" id="md_subject" name="md_subject" class="form-control" required="true"
                    value="<?php echo $row->subject?>">
                </div>
              </div>

              <div class="col-md-12" style="font-size:17px; color:black;">
                सिफारिसको ढाचा:<br>
                <div class="form-group row">
                  <textarea id="scontent" name="scontent" class="form-control col-md-12"
                    required="true"><?php echo $row->content?></textarea>
                </div>
              </div>
              <div class="text-center">
                <button type="submit" id="submit" name="submit" class="btn btn-success">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              </div>
          </div>

          <!-- Modal footer -->

          </form>
        </div>
      </div>



    </div>

  </div>
  </div>
  </div>

</section>
</div>

<script src="<?=base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?= base_url()?>assets/bower_components/ckeditor/ckeditor.js"></script>
<script type='text/javascript'>
jQuery(function() {
  CKEDITOR.replace('scontent')
});
</script>
</body>

</html>