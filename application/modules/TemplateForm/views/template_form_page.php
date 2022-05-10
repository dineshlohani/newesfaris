<?php
    if(!isset($result))
    {
        $action_page = "letter-form/create";
        $bread = "नयाँ";
    }
    else
    {
        $action_page = "letter-form/edit/".$this->uri->segment(3);
        $bread = "सम्पादन";
    }
    if(!empty($result->documents))
    {
        $documents      = explode("+",$result->documents);

    }
    $path           = base_url()."assets/documents/template_form/";
?>
<section class="content ">

  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <?php if(!empty($this->session->flashdata('msg'))): ?>
        <div class="alert alert-success alert-dismissible"> <a href="#" class="close" data-dismiss="alert"
            aria-label="close">&times;</a><span><?=$this->session->flashdata('msg');?></span></div>
        <?php endif; ?>
        <?php if(!empty($this->session->flashdata('err_msg'))): ?>
        <div class="alert alert-danger alert-dismissible"> <a href="#" class="close" data-dismiss="alert"
            aria-label="close">&times;</a><span><?=$this->session->flashdata('err_msg');?></span></div>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <div class="container-fluid ">
    <nav aria-label="breadcrumb" class="bg-shadow">
      <ol class="breadcrumb px-3 py-2">
        <li class="breadcrumb-item ml-1"><a href="<?= base_url()?>">गृह</a></li>
        <li class="breadcrumb-item"><a href="<?= base_url()?>letter-form-list"> सिफारिस </a></li>
        <li class="breadcrumb-item active"><?= $bread?></li>

      </ol>
    </nav>
  </div>
  <div class="container-fluid">
    <div class="card">
      <div class="card-body">
        <?php echo form_open_multipart($action_page);?>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-4 col-form-label"><span class="float-right">आवेदकको नाम<span
                    class="text-danger">&nbsp;*</span></span></label>
              <div class="col-sm-8">
                <div class="input-group">
                  <input type="text" name="applicant_name" class="form-control" required
                    value="<?= isset($result) ? $result->applicant_name : ''?>" />
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-4 col-form-label"><span class="float-right">आवेदन गरिएको मिति<span
                    class="text-danger">&nbsp;*</span></span></label>
              <div class="col-sm-8">
                <div class="input-group">
                  <input type="text" name="nepali_date" maxlength="10" class="form-control" required id="nepaliDate4"
                    value="<?= isset($result) ? $result->nepali_date : DateEngToNep(date('Y-m-d'))?>" />
                </div>
              </div>
            </div>
          </div>
        </div>
        <hr style="border: 1px solid #adadad" />
        <div class="row">
          <div class="col-md-5">
            <div class="form-group row">
              <label class="col-sm-4 col-form-label"><span class="float-right">पत्रको किसिम<span
                    class="text-danger">&nbsp;*</span></span></label>
              <div class="col-sm-8">
                <div class="input-group">
                  <select name='letter_type' class="form-control select2" id="letter_type" required>
                    <option value="">छान्नुहोस्</option>
                    <?php if($letter_types != FALSE): ?>
                    <?php foreach($letter_types as $type): ?>
                    <?php
                                                    $selected ='';
                                                    if(isset($result) && $result->letter_type == $type->id){ $selected = 'selected';}
                                                    ?>
                    <option value="<?= $type->id?>" <?= $selected?>><?= $type->name ?></option>
                    <?php endforeach; ?>
                    <?php endif; ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-5">
            <div class="form-group row">
              <label class="col-sm-4 col-form-label"><span class="float-right">पत्रको विषय<span
                    class="text-danger">&nbsp;*</span></span></label>
              <div class="col-sm-8">
                <div class="input-group">
                  <select name='letter_subject' class="form-control select2" id="letter_subject" required>
                    <option value="">छान्नुहोस्</option>
                    <?php if(isset($result)): ?>
                    <?php foreach($subjects as $data): ?>
                    <?php
                                                    $selected ='';
                                                    if(isset($result) && $result->letter_subject == $data->id){ $selected = 'selected';}
                                                    ?>
                    <option value="<?= $data->id?>" <?= $selected?>><?= $data->subject ?></option>
                    <?php endforeach; ?>
                    <?php endif; ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
              <i class="fa fa-plus"></i>
            </button>
            <a href="<?php echo base_url()?>Settings/viewLetterSubject" class="btn btn-info btn-sm"
              title="पत्रको विषयको सुचिमा जानुहोस">
              <i class=" fa fa-info-circle"></i>
            </a>
          </div>
        </div>

        <div class=" row">
          <div class="col-md-12">
            <div class="form-group row">
              <label class="col-sm-4 col-form-label"><span class="float-right">सिफरिसिको पत्रको विषय<span
                    class="text-danger">&nbsp;*</span></span></label>
              <div class="col-sm-8">
                <div class="input-group">
                  <input type="text" name="subject" class="form-control" id="sletter_subject" required
                    value="<?= isset($result) ? $result->content_sub : ''?>" />
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12 mt-4">
            <textarea id="content" name="content"
              class='form-control'><?= isset($result) ? $result->content : ''?></textarea>
          </div>
        </div>
        <hr class="mt-5 mb-4" style="border: 1px solid #adadad">

        <div class="row">
          <div class="col-lg-12">
            <div class="row">

            </div>
          </div>
          <div class="col-lg-12">
            <div class="row">
              <div class="col-sm-3 text-right">
                <label>कागजातहरू <span class="text-danger">*</span> </label>
              </div>

              <div class="col-sm-9">
                <div class="mb-3">
                  <div class="mb-3 documents" id="doc_div_0">
                    <input type="file" name="documents[]" id="document_0" />

                    <button type="button" class="float-right btn btn-danger doc_remove" id="document_0">
                      <i class="fa fa-times"></i></button>

                  </div>
                  <div id="document_div">

                  </div>
                  <!-- This button will add a new form when clicked -->
                  <button type="button" id="documents" class="btn btn-success"><i class="fa fa-plus"></i></button>
                  <?php
                                           if(isset($result->documents) && !empty($result->documents))
                                           {
                                               echo "<br/><br/><h6><u>कागजातहरु</u></h6>";
                                               foreach($documents as $doc)
                                               {
                                                   echo "<a href='".$path.$doc."' target='_blank'>".$doc."</a><br/>";
                                               }

                                           }
                                       ?>
                </div>
              </div>
            </div>
            <hr class="mt-5 mb-4">
          </div>

        </div>
        <div class="form-group row">
          <div class="col-sm-3 offset-sm-9 mt-4">
            <button type="submit" class='btn btn-block btn-submit btn-primary' name="submit_form">
              पेश गर्नुहोस्
            </button>
          </div>
        </div>
        <?php echo form_close();?>
      </div>
    </div>
  </div>

</section>
</div>
<script src="<?=base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?= base_url()?>assets/bower_components/ckeditor/ckeditor.js"></script>
<script type='text/javascript'>
jQuery(function() {


  CKEDITOR.replace('content')

});

jQuery(function() {


  CKEDITOR.replace('scontent')

});
jQuery(document).on('change', '#letter_type', function() {
  var letter_type = jQuery("#letter_type").val();
  if (letter_type != '') {
    var param = {};
    param.letter_type = letter_type;
    jQuery.get('<?php echo base_url()?>TemplateForm/getLetterByTypeJSON', param, function(data) {
      var obj = JSON.parse(data);
      if (obj.err_msg == "") {
        jQuery("#letter_subject").empty().append(obj.html);
      } else {
        jQuery("#letter_subject").empty();
        alert(obj.err_msg);
      }
    });
  }
});
//jQuery(document).on('click','#submit_subject',function()
//{
//       var letter_type = jQuery("#md_letter_type").val();
//       var subject = jQuery("#md_subject").val();
//       if((subject != '') && (letter_type != '') )
//       {
//           var param = {};
//           param.subject     = subject;
//           param.letter_type = letter_type;
//           param.submit_subject = 'submit';
//           jQuery.post(base_url+'TemplateForm/save_letter_subject',param,function(data){
//               console.log(data);
//               var obj = JSON.parse(data);
//               if(obj.err_msg == "")
//               {
//                   alert('Data Saved Successfully');
//                   // jQuery("#letter_subject").empty().append(obj.html);
//                   jQuery("#letter_type").select2("val", letter_type);

//                   jQuery("#md_subject").val('');
//                   jQuery("#md_letter_type").val('');
//                   jQuery("#office_name").val('');
//                   jQuery("#letter_subject").select2('val', obj.insert_id);
//                   jQuery('#myModal').modal('hide');
//               }
//               else {
//                   alert(obj.err_msg);
//               }
//           });
//       }
//   });
jQuery(document).on('change', '#letter_subject', function() {
  var subject = jQuery("#letter_subject").val();
  if (subject != '') {
    var param = {};
    param.subject = subject;
    jQuery.get(base_url + 'TemplateForm/getContentBySubject', param, function(data) {

      var obj = JSON.parse(data);
      if (obj.msg == "TRUE") {
        CKEDITOR.instances.content.setData(obj.content);
        jQuery('#sletter_subject').val(obj.letter_subject);
      }
    });
  }
});
jQuery(document).ready(function() {
  jQuery(document).on("click", "#documents", function() {
    var count = jQuery(".documents").length;
    param = {};
    param.count = count;
    jQuery.ajax({
      url: "<?= base_url()?>getGharJaggaDocumentHTML",
      method: "POST",
      data: param,
      success: function(data) {
        var obj = JSON.parse(data);
        JQ("#document_div").append(obj.html);
      },
      error: function(error) {
        console.log(JSON.stringify(error));
      }
    });
  });
  jQuery(document).on("click", ".doc_remove", function() {
    var id_selected = jQuery(this).attr("id");
    var res = id_selected.split("_");
    var id = res[res.length - 1];
    jQuery("#doc_div_" + id).remove();
  });
});
</script>

<!-- The Modal Start -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title ">पत्र विषय थप</h4>
        <button type="button" class="close" data-dismiss="modal">&#10006;</button>
      </div>

      <!-- Modal body -->

      <div class="modal-body">
        <form action="<?php echo base_url()?>TemplateForm/save_letter_subject" method="post">
          <div class="col-md-10" style="font-size:17px; color:black;">
            <div class="form-group row">
              पत्रको किसिम:
              <select name="md_letter_type" id='md_letter_type' class="form-control" required="true">
                <option value="">छान्नुहोस्</option>
                <?php if($letter_types != FALSE): ?>
                <?php foreach($letter_types as $type): ?>
                <option value="<?= $type->id ?>"><?= $type->name ?></option>
                <?php endforeach; ?>
                <?php endif; ?>
              </select>
            </div>
          </div>
          <div class="col-md-10" style="font-size:17px; color:black;">
            <div class="form-group row">
              विषय: <input type="text" id="md_subject" name="md_subject" class="form-control" required="true">
            </div>
          </div>

          <div class="col-md-10" style="font-size:17px; color:black;">
            <div class="form-group row">
              सिफारिसको ढाचा: <textarea id="scontent" name="scontent" class="form-control" required="true"></textarea>
            </div>
          </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" id="submit_subject" name="submit_subject" class="btn btn-success">Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- ----------------------Modal End-------------- -->