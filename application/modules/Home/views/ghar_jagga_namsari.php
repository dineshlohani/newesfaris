<?php
    if(!empty($this->uri->segment(3)))
    {
        $id          = $this->uri->segment(3);
        $action_page = base_url()."ghar-jagga-namsari/edit/".$id;
    }
    else
    {
        $action_page = base_url()."ghar-jagga-namsari/create";
    }
    if(!empty($result->documents))
    {
        $documents      = explode("+",$result->documents);

    }
    $path           = base_url()."assets/documents/home/ghar_jagga_namsari/";
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
                <li class="breadcrumb-item ml-1"><a href="/">गृह</a></li>


                <li class="breadcrumb-item active">घर जग्गा नामसारी</li>

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




                <?php echo form_open_multipart($action_page)?>

                    <div class="row">
                        <div class="col-md-6 offset-md-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label"><span
                                        class="float-right">आवेदन गरिएको मिति<span
                                            class="text-danger">&nbsp;*</span></span></label>


                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="text" name="nepali_date" class="form-control" id="nepaliDate4" placeholder="YYYY-MM-DD" required />
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <h4>
                                निवेदकको विवरण
                            </h4>
                            <hr style="border: 1px solid #adadad">
                        </div>

                        <div class="col-md-12">
                             <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">
                                            <span class="float-right">
                                                निवेदकको नाम<span class="text-danger">&nbsp;*</span>
                                            </span>

                                        </label>
                                        <div class="col-md-2">
                                            <select name="gender_spec" class="form-control" id="gender_spec" required>
                                                <option value="श्री" selected>श्री</option>
                                                <option value="सुश्री" >सुश्री</option>                        
                                                <option value="श्रीमती">श्रीमती</option>
                                            </select>
                                        </div>

                                        <div class="col-sm-6">
                                            <input type="text" name="applicant_name" class="form-control" id="id_applicant_name" value="<?= isset($result->applicant_name)? $result->applicant_name : '' ?>" maxlength="120" required />
                                        </div>

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
                                            <div class="input-group">
                                                <input type="text" name="cit_no" class="form-control" id="cit_no" value="<?= isset($result->cit_no)? $result->cit_no : '' ?>" maxlength="120" required />

                                            </div>
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
                                                जग्गा धनीको नाम<span class="text-danger">&nbsp;*</span>
                                            </span>

                                        </label>

                                        <div class="col-sm-8">
                                            <input type="text" name="owner_name" class="form-control" id="id_owner_name" value="<?= isset($result->owner_name)? $result->owner_name : '' ?>" maxlength="120" required />
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">
                                            <span class="float-right">
                                                मृत्यु भएको मिति<span class="text-danger">&nbsp;*</span>
                                            </span>

                                        </label>


                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input type="text" name="nepali_dod" class="form-control" id="nepaliDate5" placeholder="YYYY-MM-DD" value="<?= isset($result->nepali_dod)? $result->nepali_dod : '' ?>" maxlength="10" required />

                                            </div>
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
                                                सम्पर्क नं<span class="text-danger">&nbsp;*</span>
                                            </span>

                                        </label>

                                        <div class="col-sm-8">
                                            <input type="text" name="con_no" class="form-control" id="con_no" value="<?= isset($result->con_no)? $result->con_no : '' ?>" maxlength="120"/>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">
                                            <span class="float-right">
                                                नाता<span class="text-danger">&nbsp;*</span>
                                            </span>

                                        </label>


                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <select name="applicant_relation" class="form-control select2">
                                                    <option value="">छान्नुहोस्</option>
                                                    <?php
                                                    foreach($relations as $relation)
                                                    {
                                                        ?>
                                                        <option value="<?= $relation->id ?>"
                                                            <?php
                                                            if(isset($result->applicant_relation) && $result->applicant_relation == $relation->id)
                                                            {
                                                                echo "selected = 'selected'";
                                                            }
                                                            ?>
                                                            ><?= $relation->name ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12 mb-3 mt-4">
                            <h4>
                                मृतकका हकदारको विवरण
                            </h4>
                            <hr style="border: 1px solid #adadad">
                        </div>

                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered" id="add_new_fields">
                                        <thead>
                                            <tr>
                                                <th>हकदारको नाम</th>
                                                <th>मृतक सँगको नाता</th>
                                                <th>बुवा/पतिको नाम</th>
                                                <th>नागरिकता नं.</th>
                                                <th> <button type="button" id="hakdar" class="btn btn-success hakdaradd"><i
                                                class="fa fa-plus"></i></button></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="row_hakdar" id="row_hakdar_0">
                                                <td><input type="text" name="hakdar_ko_name[]" class="form-control" id="id_hakdar_ko_name_0" value="" required /></td>
                                                <td>
                                                    <select name="hakdar_ko_nata[]" class="form-control" id="hakdar_ko_nata_0">
                                                        <option value="">छान्नुहोस्</option>
                                                        <?php foreach($relations as $relation):?>
                                                            <option value="<?= $relation->name?>"
                                                                <?php
                                                                if(isset($result->hakdar_ko_nata) && $result->hakdar_ko_nata==$relation->id)
                                                                {
                                                                    echo "selected = 'selected'";
                                                                }
                                                                ?>
                                                                ><?= $relation->name?></option>
                                                            <?php endforeach;?>
                                                        </select>
                                                </td>

                                                <td><input type="text" name="father_husband_name[]" class="form-control" id="id_father_husband_name_0" value="<?= isset($result->father_husband_name)? $result->father_husband_name : '' ?>" required /></td>

                                                <td><input type="text" name="citizenship_no[]" class="form-control" id="id_citizenship_no_0" value="<?= isset($result->citizenship_no)? $result->citizenship_no : '' ?>" maxlength="32" required /></td>

                                                <td>
                                                   
                                                    <button type="button" class="btn btn-danger" id="hakdar_rm_0">
                                                    <i class="fa fa-times"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3 mt-4">
                            <h4>
                                नामसारी गर्ने घर/जग्गाको विवरण
                            </h4>
                            <hr style="border: 1px solid #adadad">
                        </div>
                        <div class="col-md-12">
                            <table class="table table-bordered" id="add_new_fields_jagga">
                                <thead>
                                    <tr>
                                        <th style="width: 80px;">न सि नं.</th>
                                        <th style="width: 80px;">कित्ता नं.</th>
                                        <th style="width: 120px;">घर नं</th>
                                        <th style="width: 320px;">क्षेत्रफल<br>(रोपनि. आना. पैसा. दाम)</th>
                                        <th style="width: 200px;">बाटोको प्रकार.</th>
                                        <th style="width: 250px;">बाटोको नाम.</th>
                                        <th style="width: 150px;">वडा नं.</th>
                                        <th style="width: 150px;">कैफियत.</th>
                                        <th> <button type="button" id="hakdar" class="btn btn-success jaggaadd"><i
                                        class="fa fa-plus"></i></button></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="row_hakdar" id="row_hakdar_0">
                                        <td><input type="text" name="map_sheet_no[]" class="form-control" id="id_map_sheet_no" value="<?= isset($result->map_sheet_no)? $result->map_sheet_no : '' ?>" maxlength="16" required /></td>
                                        <td>
                                           <input type="text" name="kitta[]" class="form-control" id="id_kitta" maxlength="32" value="<?= isset($result->kitta)? $result->kitta : '' ?>" required />
                                        </td>
                                        <td><input type="text" name="home_no[]" class="form-control" id="id_home_no" value="<?= isset($result->home_no)? $result->home_no : '' ?>" maxlength="16" /></td>

                                        <td>
                                            <div class="row">
                                                <div class="col-md-3"> <input type="number" name="biggha[]"  class="form-control" required min="0" id="id_biggha" value="0" placeholder="" style="width:50px;"/></div>
                                                <div class="col-md-3"><input type="number" name="kattha[]"  class="form-control" required min="0" id="id_kattha" value="0" placeholder="" style="width:50px;"/></div>
                                                <div class="col-md-3"> <input type="number" name="paisa[]"  class="form-control" required min="0" id="id_paisa" value="0" placeholder="" style="width:40px; margin-left: -5px;"/></div>
                                                <div class="col-md-3"><input type="number" name="dhur[]" class="paisa_div form-control "  min="0" max="4" id="id_paisa" value="0" placeholder="" style="width:40px;"/></div>
                                            </div>
                                           
                                        </td>

                                        <td style="width: 80px;">
                                            <select name="road_type[]" class="form-control" id="id_road_type" required>
                                                <option value="" >छान्नुहोस्</option>
                                                <?php
                                                foreach($roads as $road)
                                                {
                                                    ?>
                                                    <option value="<?= $road->name ?>"
                                                       <?php
                                                       if(isset($result->road_type) && $result->road_type == $road->id)
                                                       {
                                                        echo 'selected="selected"';
                                                    }
                                                    ?>
                                                    > <?= $road->name ?> </option>
                                                    <?php
                                                }
                                                ?>

                                            </select>
                                        </td>

                                      
                                        <td><textarea class="form-control" name="road_name[]">
                                             
                                         </textarea></td>

                                        

                                        <td>
                                            <select name="ward[]" class="form-control" id="id_ward_no" required>
                                                <option value="" selected>वडा नं</option>
                                                <?php
                                                foreach($wards as $ward)
                                                {
                                                    ?>
                                                    <option value="<?= $ward->id ?>"
                                                        <?php
                                                        if(isset($result->ward) && $result->ward == $ward->id)
                                                        {
                                                         echo 'selected="selected"';
                                                     }
                                                     ?>
                                                     > <?= $ward->name ?> </option>
                                                     <?php
                                                 }
                                                 ?>

                                             </select>
                                        </td>

                                        <td><textarea name="description[]" class=" form-control" id="id_description" cols="40" maxlength="512">
                                            <?php
                                            echo isset($result->description) ? $result->description : "";
                                            ?>
                                        </textarea></td>

                                        <td>
                                            <button type="button" class="btn btn-danger" id="hakdar_rm_0">
                                            <i class="fa fa-times"></i></button>
                                        </td>

                                    </tr>
                                </tbody>
                            </table>
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
                                    <div class="mb-3" >
                                            <div class="mb-3 documents" id="doc_div_0" >
                                                <input type="file" name="documents[]" id="document_0" />

                                                <button type="button" class="float-right btn btn-danger doc_remove" id="document_0">
                                                    <i class="fa fa-times"></i></button>

                                            </div>
                                        <div id="document_div">

                                        </div>
                                        <!-- This button will add a new form when clicked -->
                                        <button type="button" id="documents" class="btn btn-success"><i
                                                class="fa fa-plus"></i></button>
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
                </form>

            </div>
        </div>

</section>
<script src="<?=base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<script>
    var JQ = jQuery.noConflict();
    JQ(document).ready(function()
    {
        JQ(document).on("click", "#documents", function (){
            var  count = JQ(".documents").length;
            param = {};
            param.count = count;
            JQ.ajax({
                url: "<?= base_url()?>getGharJaggaDocumentHTML",
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

        $('.jaggaadd').click(function(e) {
          e.preventDefault();
          var new_row =  '<tr>'+
                            '<td><input type="text" name="map_sheet_no[]" class="form-control" id="id_map_sheet_no" value="<?= isset($result->map_sheet_no)? $result->map_sheet_no : '' ?>" maxlength="16" required /></td>'+
                                        '<td> <input type="text" name="kitta[]" class="form-control" id="id_kitta" maxlength="32" value="<?= isset($result->kitta)? $result->kitta : '' ?>" required /></td>'+
                                        '<td><input type="text" name="home_no[]" class="form-control" id="id_home_no" value="<?= isset($result->home_no)? $result->home_no : '' ?>" maxlength="16" /></td>'+

                                        '<td>'+
                                            '<div class="row">'+
                                                '<div class="col-md-3"> <input type="number" name="biggha[]"  class="form-control" required min="0" id="id_biggha" value="0" placeholder="" style="width:50px;"/></div>'+
                                                '<div class="col-md-3"><input type="number" name="kattha[]"  class="form-control" required min="0" id="id_kattha" value="0" placeholder="" style="width:50px;"/></div>'+
                                                '<div class="col-md-3"> <input type="number" name="paisa[]"  class="form-control" required min="0" id="id_paisa" value="0" placeholder="" style="width:40px; margin-left: -5px;"/></div>'+
                                                '<div class="col-md-3"><input type="number" name="dhur[]" class="paisa_div form-control "  min="0" max="4" id="id_paisa" value="0" placeholder="" style="width:40px;"/></div>'+
                                            '</div>'+
                                        '</td>'+

                                        '<td style="width: 80px;">'+
                                            '<select name="road_type[]" class="form-control" id="id_road_type" required><option value="" >छान्नुहोस्</option><?php foreach($roads as $road){
                                                    ?><option value="<?= $road->name ?>"><?= $road->name ?> </option> <?php } ?></select></td>'+
                                        '<td><textarea class="form-control" name="road_name[]"></textarea></td>'+
                                        '<td><select name="ward[]" class="form-control" id="id_ward_no" required><option value="" selected>वडा नं</option> <?php foreach($wards as $ward) { ?><option value="<?= $ward->id ?>"> <?= $ward->name ?> </option><?php }  ?> </select></td>'+
                                        '<td><textarea name="description[]" class=" form-control" id="id_description" cols="40" maxlength="512"></textarea></td>'+
                                         '<td><button type="button" class="btn btn-danger" id="hakdar_rm_0"><i class="fa fa-times"></i></button> </td>'+
                                '<tr>';
          $("#add_new_fields_jagga").append(new_row);
      });

        JQ(document).on("click", ".doc_remove", function () {
            var id_selected     = JQ(this).attr("id");
            var res             = id_selected.split("_");
            var id              = res[res.length - 1];
            JQ("#doc_div_"+id).remove();
        });

        $("body").on("click",".hakdar_remove", function(e){
            e.preventDefault();
            var id = $(this).data('id');
            if (confirm('के तपाइँ  यसलाई हटाउन निश्चित हुनुहुन्छ ?')) {
              $(this).parent().parent().remove();
            }
        });

        $(document).on('click','#hakdar_rm_0', function(){
            alert('First row is not removable');
            return false;
        });

        //-----------------------------------------------------------------------------------
        $('.hakdaradd').click(function(e) {
          e.preventDefault();
          var new_row =  '<tr><td><input type="text" name="hakdar_ko_name[]" class="form-control" id="id_hakdar_ko_name_0" value="<?= isset($result->hakdar_ko_name)? $result->hakdar_ko_name : '' ?>" required /></td> <td><select name="hakdar_ko_nata[]" class="form-control" id="hakdar_ko_nata_0"> <option value="">छान्नुहोस्</option><?php foreach($relations as $relation):?>
                                                            <option value="<?= $relation->name?>"<?php if(isset($result->hakdar_ko_nata) && $result->hakdar_ko_nata==$relation->id) { echo "selected = 'selected'";}?> ><?= $relation->name?></option> <?php endforeach;?>
                                                        </select></td><td><input type="text" name="father_husband_name[]" class="form-control" id="id_father_husband_name_0" value="<?= isset($result->father_husband_name)? $result->father_husband_name : '' ?>" required /></td> <td><input type="text" name="citizenship_no[]" class="form-control" id="id_citizenship_no_0" value="<?= isset($result->citizenship_no)? $result->citizenship_no : '' ?>" maxlength="32" required /></td><td> <button type="button" class="btn btn-danger hakdar_remove" id="hakdar_rm"><i class="fa fa-times"></i></button> </td><tr>';
          $("#add_new_fields").append(new_row);
      });
    });
</script>
