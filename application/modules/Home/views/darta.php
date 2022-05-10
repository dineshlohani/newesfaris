<?php
    $uri_accept     = base_url().$this->uri->segment(1)."/darta/".$this->uri->segment(3);
    $uri_decline    = base_url().$this->uri->segment(1)."/detail/".$this->uri->segment(3);
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
        <div class="card-body  p-y-10 ">

            <div class="delete-page ">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="offset-md-3 col-md-6">
                                <p class="lead text-center"><h5> के तपाई यो डेटा दर्ता गर्न चाहानु हुन्छ ?
                                    <br> चाहानु हुन्छ भने निबेदन अप्लोड गर्नुहोस्।</h5> </p>
                                <hr>
                                <?php echo form_open_multipart($uri_accept)?>
                                <?php if($reserved_darta_nos != FALSE ):?>
                                    <div class="form-row">
                                        <div class="col-md-8 ">
                                            <h6>रिजभ भएको दर्ता मितिहरु:</h6>
                                        </div>
                                        <?php
                                            if(isset($reserved_darta_nos)):
                                                foreach($reserved_darta_nos as $data) :
                                        ?>
                                        <div class="col-md-8">
                                            <input type="radio" name="darta_id" value="<?= $data->id ?>"><?= $data->nepali_darta_miti ?> (दर्ता नं. <?= $data->darta_no?>)
                                        </div>
                                        <?php
                                                endforeach;
                                            endif;

                                        ?>

                                    </div>
                                    <hr>
                                <?php endif;?>
                                    <div class="col-sm-12">
                                        <div class="mb-3 documents" id="doc_div_0">
                                            <input type="file" name="documents[]" id="documents_0" />

                                            <button type="button"
                                                    class="float-right btn btn-danger delete-form doc_remove"
                                                    id="documents_remove_0"><i
                                                    class="fa fa-times"></i></button>
                                        </div>
                                        <div id="document_div"></div>
                                        <!-- This button will add a new form when clicked -->
                                        <button type="button" class="btn btn-success" data-formset-add><i
                                                id ="documents" class="fa fa-plus"></i></button>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-6 mt-3 mb-2">
                                            <input type="submit" name="submit" class="btn btn-lg btn-danger btn-block " value="चाहान्छु">
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <a href="<?=$uri_decline?>"
                                               class="btn btn-secondary btn-lg btn-block ">चाहन्न</a>
                                        </div>

                                    </div>
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
<script>
    var JQ =jQuery.noConflict();
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
        JQ(document).on("click", ".doc_remove", function () {
            var id_selected     = JQ(this).attr("id");
            var res             = id_selected.split("_");
            var id              = res[res.length - 1];
            JQ("#doc_div_"+id).remove();
        });

    });
</script>
