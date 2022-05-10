<?php
    if(!empty($result->uri))
    {
        $patra_detail = Modules::run("Settings/getPatraItemByURI",$result->uri);
        $letter_subject = $patra_detail->name;
    }
    else
    {
        $letter_subject = $result->letter_subject;
    }
    if(!empty($result->darta_documents))
    {
        $docs = explode('+',$result->darta_documents);
    }
    $session = Modules::run('Settings/getSession',$result->session_id);
    switch ($result->letter_type) {
        case 'important':
            $letter_type = 'जरुरी';
            break;
        case 'most_important':
            $letter_type = 'अति जरुरी';
            break;
        case 'deadlined':
            $letter_type = 'म्याद तोकिएको';
            break;
        default:
            $letter_type = "-";
            break;
    }
    $depart = Modules::run('Settings/getDepartment',$result->department);
    $user = $this->Mdl_user->getById($result->user_id);
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
                    <li class="breadcrumb-item ml-1"><a href="<?= base_url()?>dashboard">गृह</a></li>


                    <li class="breadcrumb-item"><a href="<?= base_url()?>darta-book">चिठ्ठी पुर्जी दर्ता किताब</a></li>

                    <li class="breadcrumb-item active">विवरण</li>

                </ol>
            </nav>
        </div>
    <div class="container-fluid ">
    <div class="card">
        <div class="card-body">
            <?php if(!empty($this->session->userdata('department'))) :?>
                <?php
                    $color= '';
                    if($result->is_complete == 1)
                    {
                        $color = '#0be629';
                    }
                    else
                    {
                        if($result->letter_type == 'deadlined')
                        {
                            $days = calculateDays($result->deadline_eng, time());
                            if($days < 7)
                            {
                                $color = "red";
                            }
                            else {
                                $color = "yellow";
                            }
                        }
                        else {
                            $color = "yellow";
                        }
                    }
                ?>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <span class="circle" style="background-color:<?= $color?>"></span>
                    </div>
                </div>
            <?php endif;?>
            <div class="row">
                <div class="offset-lg-2 col-lg-8">
                    <table class="table table-bordered my-4">
                        <?php if($this->session->userdata('is_muncipality')==1):?>
                        <tbody>
                        <tr>
                            <td>
                                दर्ता नं
                            </td>
                            <td>
                                <?= $result->darta_no ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                दर्ता मिति
                            </td>
                            <td><?= $result->nepali_darta_miti ?></td>
                        </tr>

                        <tr>
                            <td>
                                पत्र संख्या
                            </td>
                            <td><?= $session->name ?></td>
                        </tr>

                        <tr>
                            <td>
                                पठाउने कार्यालयको नाम
                            </td>
                            <td><?= $result->applicant_name ?></td>
                        </tr>
                        <tr>
                            <td>
                                पत्रको चलानी नं
                            </td>
                            <td><?= $result->patra_chalani_no ?></td>
                        </tr>
                        <tr>
                            <td>
                                पत्रको विषय
                            </td>
                            <td><?= $result->letter_subject ?></td>
                        </tr>
                        <tr>
                            <td>
                               फाँट
                            </td>
                            <td><?= $depart->name ?></td>
                        </tr>
                        <tr>
                            <td>पत्रको किसिम</td>
                            <td><?= $letter_type ?></td>
                        </tr>
                            <?php if($result->letter_type == "deadlined"):?>
                        <tr>
                            <td>तोकिएको मिति</td>
                            <td><?= $result->deadline_nep ?></td>
                        </tr>
                            <?php endif;?>
                        <tr>
                            <td>लिंक</td>
                            <td>
                                <?php if(!empty($result->link)):?>
                                <a href="<?=$result->link?>" target="_blank"><?= $result->link?></a>
                                <?php  else:?>
                                "-"
                                <?php endif;?>
                            </td>
                        </tr>
                        <tr>
                            <td>कैफियत</td>
                            <td><?= $result->description?></td>
                        </tr>
                        <tr>
                            <td>
                                बुझिलिनेको नाम
                            </td>
                            <td> <?= ($user != FALSE) ? $user->name : '-'?> </td>
                        </tr>
                        <?php if(empty($result->uri)): ?>
                        <tr>
                            <td>कागजातहरु</td>
                            <td>
                                <?php
                                    if(!empty($result->darta_documents)):
                                        foreach($docs as $doc):
                                 ?>
                                    <a href="<?= base_url()?>assets/documents/darta_direct/<?=$doc?>" target="_blank"><?= $doc?></a>
                                 <?php
                                        endforeach;
                                    else:
                                        echo "-";
                                    endif;
                                  ?>
                            </td>
                        </tr>
                        <?php endif; ?>
                        </tbody>
                        <?php else: ?>
                        <tbody>
                        <tr>
                            <td>
                                दर्ता नं
                            </td>
                            <td>
                                <?= $result->darta_no ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                दर्ता मिति
                            </td>
                            <td><?= $result->nepali_darta_miti ?></td>
                        </tr>

                        <tr>
                            <td>
                                पत्र संख्या
                            </td>
                            <td><?= $session->name ?></td>
                        </tr>

                        <tr>
                            <td>
                                पठाउनेको नाम
                            </td>
                            <td><?= $result->applicant_name ?></td>
                        </tr>

                        <tr>
                            <td>
                                पत्रको बिषय
                            </td>
                            <td><?= $letter_subject ?></td>
                        </tr>
                        <tr>
                            <td>
                                बुझिलिनेको नाम
                            </td>
                            <td> <?= ($user != FALSE) ? $user->name : '-'?> </td>
                        </tr>
                        <?php if(empty($result->uri)): ?>
                        <tr>
                            <td>कागजातहरु</td>
                            <td>
                                <?php
                                    if(!empty($result->darta_documents)):
                                        foreach($docs as $doc):
                                 ?>
                                    <a href="<?= base_url()?>assets/documents/darta_direct/<?=$doc?>" target="_blank"><?= $doc?></a>
                                 <?php
                                        endforeach;
                                    else:
                                        echo "-";
                                    endif;
                                  ?>
                            </td>
                        </tr>
                        <?php endif; ?>
                        </tbody>
                        <?php endif;?>
                    </table>
                </div>
            </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                            <div class="row">
                                <?php
                                    if($this->session->userdata('is_muncipality')==1):?>
                                    <?php if($result->is_complete != 1 && $result->department == $this->session->userdata('department')):
                                    ?>
                                    <div class="col-lg-4 offset-lg-8">
                                        <button class="btn btn-info btn-submit mt-3 btn-block" data-toggle="modal" data-target="#transModal">स्थानान्तरण/काम सम्पन्न</button>
                                    </div>
                                    <?php endif; ?>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
<div class="modal fade" id="transModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">स्थानान्तरण/काम सम्पन्न गर्नुहोस्</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&#10006;</span>
        </button>
      </div>
      <div class="modal-body">
          <?php echo form_open('DartaChalaniBook/darta_transfer_completion')?>
        <div class="row">
            <div class="col-md-6">
                <label class="text-center" for="depart-check">फाँट स्थानान्तरण गर्नुहोस्</label>
                <select name="department" id="department" class="select2" style="width:100% !important;">
                        <option value=''>छान्नुहोस्</option>
                        <?php if($departments != FALSE):?>
                            <?php foreach($departments as $depart):?>
                                <option value='<?= $depart->id ?>'><?= $depart->name ?></option>
                            <?php endforeach;?>
                        <?php endif;?>
                </select>
            </div>
            <div class="col-md-6">
                <label class="text-center" for="is_complete">काम सम्पन्न भयो</label>
                <input type="checkbox" id="is_complete" name="is_complete" value="1">
                <input type="hidden" name="darta_id" value="<?= $result->id?>">
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
        <button type="submit" class="btn btn-primary" id="submit_darta" name="submit_darta"><i class="fa fa-save"></i> Save</button>
        <?php echo form_close();?>
      </div>
    </div>
  </div>
</div>

</section>
</div>
<script>
    jQuery(document).ready(function(){
        jQuery(document).on('click','#submit_darta',function(){
            var department  = jQuery('select[name=department]').val() || 0;
            var is_complete = 0;
            if(jQuery("#is_complete").is(":checked")== true)
            {
                is_complete = 1;
            }
            if(department != 0 && is_complete != 0)
            {
                event.preventDefault();
                alert('स्थानान्तरण वा काम सम्पन्न मात्र गर्नुहोला |');
            }
        });
    });
</script>
