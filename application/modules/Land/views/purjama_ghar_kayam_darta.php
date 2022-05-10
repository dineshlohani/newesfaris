<?php
    $action_page = "purjama-ghar-kayam/darta/".$this->uri->segment(3);
?>
<section class="content ">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                                            </div>
        </div>
    </div>

 <div class="card">
        <div class="card-body  p-y-10 ">



            <div class="delete-page ">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="offset-md-3 col-md-6">
                                <p class="lead text-center"> के तपाई यो डेटा दर्ता गर्न चाहानु हुन्छ ?
                                    <br> चाहानु हुन्छ भने निबेदन अप्लोड गर्नुहोस्। </p>
                                    <hr/>
                                <?php echo form_open_multipart($action_page)?>
                                <?php if($reserved_darta_nos !=FALSE ):?>
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
                                            <a href="<?=  base_url()?>purjama-ghar-kayam/details/<?=$result->id?>"
                                               class="btn btn-secondary btn-lg btn-block ">चाहन्न</a>
                                        </div>
                                    </div>
                               <?php echo form_close();?>
                            </div>
                        </div>
                    </div>
                </div>

        </div>
    </div>


</section>
</div>
