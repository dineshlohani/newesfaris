<?php
    if($this->uri->segment(2)== "create")
    {
    $action_page = "bibaha-pramanit/create";
    }
    if($this->uri->segment(2)=="edit")
    {
    $action_page = "bibaha-pramanit/edit/".$this->uri->segment(3);
    }
    if(!empty($result->documents))
    {
        $documents      = explode("+",$result->documents);

    }
    $path           = base_url()."assets/documents/others/bibaha_pramanit/";
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



           <div class="container-fluid ">
               <nav aria-label="breadcrumb" class="bg-shadow">
                   <ol class="breadcrumb px-3 py-2">
                       <li class="breadcrumb-item ml-1"><a href="/">गृह</a></li>


       <li class="breadcrumb-item"><a href="<?= base_url()?>/bibaha-pramanit"> विवाह प्रमाणित दर्ता प्रमाणपत्र</a>
       </li>

   <li class="breadcrumb-item active">नयाँ</li>

                   </ol>
               </nav>
           </div>





   <div class="container-fluid">
       <div class="card">
           <div class="card-body">
               <div class="row">
                   <div class="col-lg-12">




                   </div>
               </div>

               <?php echo form_open_multipart($action_page); ?>
               <div class="row">
                    <div class="col-md-6 ">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label"><span
                                    class="float-right">आवेदन गरिएको मिति<span
                                    class="text-danger">&nbsp;*</span></span></label>


                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="text" name="nepali_date" maxlength="10" class="form-control" required id="nepaliDate4" value="<?= isset($result) ? $result->nepali_date : DateEngToNep(date('Y-m-d'))?>" />

                                    </div>
                                </div>

                        </div>
                    </div>
                    <div class="col-md-6 ">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label"><span
                                    class="float-right">विवाह भएको मिति<span
                                    class="text-danger">&nbsp;*</span></span></label>


                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="text" name="marriage_date_nepali" maxlength="10" class="form-control" required id="nepaliDate5"  value="<?= isset($result) ? $result->marriage_date_nepali : ''?>"/>

                                    </div>
                                </div>

                        </div>
                    </div>

                </div>
                <div class="col-md-12">
                    <div class="col-md-6 ">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label"><span
                                    class="float-right">विवाह प्रकार<span
                                    class="text-danger">&nbsp;*</span></span></label>


                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <select name="marriage_type" class="form-control" required>
                                            <option value="">छान्नुहोस्</option>
                                            <?php foreach($marriage_types as $type):?>
                                                <option value="<?= $type->id?>"
                                                    <?php
                                                       if(isset($result) && $result->marriage_type == $type->id)
                                                       {
                                                           echo 'selected= "selected"';
                                                       }
                                                    ?>
                                                ><?= $type->name?></option>
                                            <?php endforeach;?>
                                        </select>

                                    </div>
                                </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <h4>
                            दुलहाको विवरण
                        </h4>
                        <hr style="border: 1px solid #adadad">
                    </div>

                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">
                                            <span class="float-right">
                                                नाम<span class="text-danger">&nbsp;*</span>
                                            </span>

                                    </label>

                                        <div class="col-sm-8">
                                            <input type="text" name="g_name" maxlength="128" value="<?= isset($result) ? $result->g_name : ''?>" class="form-control" required id="id_groom" />
                                        </div>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">
                                            <span class="float-right">
                                                हजुर बुवाको नाम<span class="text-danger">&nbsp;*</span>
                                            </span>

                                    </label>

                                        <div class="col-sm-8">
                                            <input type="text" name="g_grand_father_name" maxlength="128" value="<?= isset($result) ? $result->g_grand_father_name : ''?>" class="form-control" required id="id_groom_grand_father" />
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
                                                बुवाको नाम<span class="text-danger">&nbsp;*</span>
                                            </span>

                                    </label>

                                        <div class="col-sm-8">
                                            <input type="text" name="g_father_name" maxlength="128" value="<?= isset($result) ? $result->g_father_name : ''?>" class="form-control" required id="id_groom_father" />
                                        </div>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">
                                            <span class="float-right">
                                                आमाको नाम<span class="text-danger">&nbsp;*</span>
                                            </span>

                                    </label>

                                        <div class="col-sm-8">
                                            <input type="text" name="g_mother_name" maxlength="128" class="form-control" value="<?= isset($result) ? $result->g_mother_name : ''?>" required id="id_groom_mother" />
                                        </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">
                                            <span class="float-right">
                                                ठेगाना<span class="text-danger">&nbsp;*</span>
                                            </span>

                            </label>

                                <div class="col-md-2 mb-sm-2">
                                      <select name="g_state" class="form-control state select2 state_selected" required id="state_selected-1">
                                             <option value="">प्रदेश</option>
                                          <?php foreach($states as $state):?>
                                             <option value="<?= $state->id ?>"
                                                 <?php
                                                    if(isset($result) && $result->g_state == $state->id)
                                                    {
                                                        echo 'selected= "selected"';
                                                    }
                                                    elseif($state->id==$default[0])
                                                    {
                                                        echo 'selected="selected"';
                                                    }
                                                 ?>
                                             ><?= $state->name ?></option>
                                          <?php endforeach; ?>
                                        </select>
                                </div>
                                <div class="col-md-3 mb-sm-2">
                                        <select name="g_district" class="form-control district select2 district_selected" required id="district_selected-1">
                                         <option value="">जिल्ला</option>
                                            <?php foreach ($districts as $district): ?>
                                                <option value="<?= $district->id ?>"
                                                    <?php
                                                       if(isset($result) && $result->g_district == $district->id)
                                                       {
                                                           echo 'selected= "selected"';
                                                       }
                                                       elseif($district->name==$default[1])
                                                           {
                                                               echo 'selected="selected"';
                                                           }
                                                    ?>
                                                ><?= $district->name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                </div>
                                <div class="col-md-3 mb-sm-2">

                                         <select name="g_local_body" class="form-control select2 local_body_selected" required id="local_body_selected-1">
                                         <option value="">गा.वि.स./न.पा </option>
                                         <?php foreach($locals as $local) : ?>
                                             <option value="<?= $local->id?>"
                                                 <?php
                                                    if(isset($result) && $result->g_local_body == $local->id)
                                                    {
                                                        echo 'selected= "selected"';
                                                    }
                                                    elseif($local->name==$default[2])
                                                        {
                                                            echo 'selected="selected"';
                                                        }
                                                 ?>
                                             ><?= $local->name ?></option>
                                         <?php endforeach;?>
                                        </select>

                                </div>
                                <div class="col-md-2 mb-sm-2">
                                    <select name="g_ward" class="form-control ward-no ward_selected" required id="ward_selected-1">
                                             <option value="" selected>वडा नं</option>
                                         <?php foreach($wards as $ward): ?>
                                             <option value="<?= $ward->id ?>"
                                                 <?php
                                                    if(isset($result) && $result->g_ward == $ward->id)
                                                    {
                                                        echo 'selected= "selected"';
                                                    }
                                                    elseif($ward->id==$default[3])
                                                    {
                                                            echo 'selected="selected"';
                                                    }
                                                 ?>
                                             > <?= $ward->name?></option>
                                         <?php endforeach;?>
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
                                                दुलाहाको नागरिकता/राहदानी नं <span class="text-danger">&nbsp;*</span>
                                            </span>

                                    </label>

                                        <div class="col-sm-8">
                                            <input name="g_citizenship_no" class="form-control" value="<?= isset($result) ? $result->g_citizenship_no : ''?>" required>
                                        </div>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">
                                            <span class="float-right">
                                                साबिक ठेगाना <span class="text-danger">&nbsp;*</span>
                                            </span>

                                    </label>

                                        <div class="col-sm-8">
                                            <select name="g_old_address" class="form-control select2" required id="id_g_old_place">
                                              <option value="" >छान्नुहोस्</option>
                                            <?php foreach($old_new as $data): ?>
                                                  <option value="<?= $data->id ?>"
                                                          <?php
                                                                if(isset($result) && $result->g_old_address == $data->id)
                                                                {
                                                                    echo 'selected= "selected"';
                                                                }
                                                             ?>

                                                      >
                                                    <?= $data->name ?></option>
                                            <?php endforeach; ?>
                                            </select>
                                        </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12 mb-3 mt-4">
                        <h4>
                            दुलहीको विवरण
                        </h4>
                        <hr style="border: 1px solid #adadad">
                    </div>

                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">
                                            <span class="float-right">
                                                नाम<span class="text-danger">&nbsp;*</span>
                                            </span>

                                    </label>

                                        <div class="col-sm-8">
                                            <input type="text" value="<?= isset($result) ? $result->b_name : ''?>" name="b_name" maxlength="128" class="form-control" required id="id_bride" />
                                        </div>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">
                                            <span class="float-right">
                                                हजुर बुवाको नाम<span class="text-danger">&nbsp;*</span>
                                            </span>

                                    </label>

                                        <div class="col-sm-8">
                                            <input type="text" name="b_grand_father_name" value="<?= isset($result) ? $result->b_grand_father_name : ''?>" maxlength="128" class="form-control" required id="id_bride_grand_father" />
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
                                                बुवाको नाम<span class="text-danger">&nbsp;*</span>
                                            </span>

                                    </label>

                                        <div class="col-sm-8">
                                            <input type="text" name="b_father_name" maxlength="128" value="<?= isset($result) ? $result->b_father_name : ''?>" class="form-control" required id="id_bride_father" />
                                        </div>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">
                                            <span class="float-right">
                                                आमाको नाम<span class="text-danger">&nbsp;*</span>
                                            </span>

                                    </label>

                                        <div class="col-sm-8">
                                            <input type="text" name="b_mother_name" maxlength="128" value="<?= isset($result) ? $result->b_mother_name : ''?>"class="form-control" required id="id_bride_mother" />
                                        </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">
                                            <span class="float-right">
                                                ठेगाना<span class="text-danger">&nbsp;*</span>
                                            </span>

                            </label>

                                <div class="col-md-2 mb-sm-2">
                                    <select name="b_state" class="form-control select2 state_selected" required id="state_selected-2">
                                  <option value="">प्रदेश</option>
                                          <?php foreach($states as $state):?>
                                             <option value="<?= $state->id ?>"
                                                 <?php
                                                    if(isset($result) && $result->b_state == $state->id)
                                                    {
                                                        echo 'selected= "selected"';
                                                    }
                                                    elseif($state->id==$default[0])
                                                    {
                                                        echo 'selected="selected"';
                                                    }
                                                 ?>
                                             ><?= $state->name ?></option>
                                          <?php endforeach; ?>

</select>
                                </div>
                                <div class="col-md-3 mb-sm-2">
                                    <select name="b_district" class="form-control select2 district_selected" required id="district_selected-2">
   <option value="">जिल्ला</option>
                                            <?php foreach ($districts as $district): ?>
                                                <option value="<?= $district->id ?>"
                                                    <?php
                                                       if(isset($result) && $result->b_district == $district->id)
                                                       {
                                                           echo 'selected= "selected"';
                                                       }
                                                       elseif($district->name==$default[1])
                                                           {
                                                               echo 'selected="selected"';
                                                           }
                                                    ?>
                                                ><?= $district->name ?></option>
                                            <?php endforeach; ?>

</select>
                                </div>
                                <div class="col-md-3 mb-sm-2">
                                    <select name="b_local_body" class="form-control select2 local_body_selected" required id="local_body_selected-2">
   <option value="">गा.वि.स./न.पा </option>
                                         <?php foreach($locals as $local) : ?>
                                             <option value="<?= $local->id?>"
                                                 <?php
                                                    if(isset($result) && $result->b_local_body == $local->id)
                                                    {
                                                        echo 'selected= "selected"';
                                                    }
                                                    elseif($local->name==$default[2])
                                                        {
                                                            echo 'selected="selected"';
                                                        }
                                                 ?>
                                             ><?= $local->name ?></option>
                                         <?php endforeach;?>

</select>
                                </div>
                                <div class="col-md-2 mb-sm-2">
                                    <select name="b_ward" class="form-control select2 ward_selected" required id="ward_selected-2">
   <option value="" selected>वडा नं</option>
                                         <?php foreach($wards as $ward): ?>
                                             <option value="<?= $ward->id ?>"
                                                 <?php
                                                    if(isset($result) && $result->b_ward == $ward->id)
                                                    {
                                                        echo 'selected= "selected"';
                                                    }
                                                    elseif($ward->id==$default[3])
                                                    {
                                                            echo 'selected="selected"';
                                                    }
                                                 ?>
                                             > <?= $ward->name?></option>
                                         <?php endforeach;?>

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
                                                दुलहीको नागरिकता/राहदानी नं <span class="text-danger">&nbsp;*</span>
                                            </span>

                                    </label>

                                        <div class="col-sm-8">
                                            <input name="b_citizenship_no" class="form-control" value="<?= isset($result) ? $result->b_citizenship_no : ''?>" required>
                                        </div>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">
                                            <span class="float-right">
                                                साबिक ठेगाना <span class="text-danger">&nbsp;*</span>
                                            </span>

                                    </label>

                                        <div class="col-sm-8">
                                            <select name="b_old_address" class="form-control select2" required id="id_b_old_place">
  <option value="" selected>छान्नुहोस्</option>
<?php foreach($old_new as $data): ?>
  <option value="<?= $data->id ?>"
          <?php
                                                    if(isset($result) && $result->g_old_address == $data->id)
                                                    {
                                                        echo 'selected= "selected"';
                                                    }
                                                 ?>

          >
    <?= $data->name ?></option>
<?php endforeach; ?>

</select>
                                        </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                   <hr class="mt-5 mb-4" style="border: 1px solid #adadad">

                   <div class="row">
                       <div class="col-lg-10">


<div class="row">
   <div class="col-sm-3 text-right">
       <label>कागजातहरू <span class="text-danger">*</span> </label>
   </div>

   <div class="col-sm-9">
       <div class="mb-3 documents" id="doc_div_0">
           <input type="file" name="documents[]" id="documents_0" />
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
                       echo "</div>";
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

               </form>
           </div>
       </div>
   </div>

   </section>
</div>
<script src="<?=base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>
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
