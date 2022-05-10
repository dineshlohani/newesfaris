  <form action="<?php echo base_url()?>LandCategory/Update" method="post" class="form save_post">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
    <input type="hidden" class="form-control " placeholder="" name="id" required="required" value="<?php if(!empty($row['id'])){ echo $row['id'];} ?>">
    <div class="form-group">
      <div class="col-md-12">
        <div class="form-group">
          <label>जग्गाको श्रेणी<span style="color:red">*</span></label>
          <input type="text" class="form-control " placeholder="" name="category" required="required" value="<?php if(!empty($row['category'])){ echo $row['category'];} ?>">
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-primary btn-xs save_btn" data-toggle="tooltip" title="सम्पादन गर्नुहोस्" name="Submit" type="submit" value="Submit">सम्पादन गर्नुहोस्</button>
      <button type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" title="सम्पादन गर्नुहोस्" data-dismiss="modal">रद्द गर्नुहोस्</button>
    </div>
</form>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/customjs.js"></script>