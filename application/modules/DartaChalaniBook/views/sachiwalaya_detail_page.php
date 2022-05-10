<?php
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
$docs = explode("+", $result->darta_documents);
    $session = Modules::run('Settings/getSession',$result->session_id);
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


                    <li class="breadcrumb-item"><a href="<?= base_url()?>darta-book">सचिवालय दर्ता किताब</a></li>

                    <li class="breadcrumb-item active">विवरण</li>

                </ol>
            </nav>
        </div>
    <div class="container-fluid ">
    <div class="card">
        <div class="card-body">
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
                            <td>
                                बुझिलिनेको नाम
                            </td>
                            <td> <?= ($user != FALSE) ? $user->name : '-'?> </td>
                        </tr>

                        <tr>
                            <td>कागजातहरु</td>
                            <td>
                                <?php
                                    if(!empty($result->darta_documents)):
                                        foreach($docs as $doc):
                                 ?>
                                    <a href="<?= base_url()?>assets/documents/sachiwalaya_darta/<?=$doc?>" target="_blank"><?= $doc?></a>
                                 <?php
                                        endforeach;
                                    else:
                                        echo "-";
                                    endif;
                                  ?>
                            </td>
                        </tr>
                        <tr>
                            <td>कैफियत</td>
                            <td></td>
                        </tr>
                        </tbody>
                        <?php endif;?>
                    </table>
                    <div class="offset-9 col-3">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                            ट्रान्सफर गर्नुहोस
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


</section>
</div>
<script>

</script>
<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">फायल ट्रान्सफर गर्नुहोस्</h4>
        <button type="button" class="close" data-dismiss="modal">&#10006;</button>
      </div>
      <?php echo form_open(base_url().'sachiwalaya-transfer/'.$result->id); ?>
      <!-- Modal body -->
      <div class="modal-body" style="color:black;">

          <div class="col-md-12">
              <div class="row">
                  <div class="col-md-8">
                      <div class="col-md-2">फाँट<i class=text-danger>*</i></div>
                      <div class="col-md-6">
                          <select class="select2 form-control col-md-4" name="department" required>
                              <option value="">छान्नुहोस्</option>
                              <?php foreach($departments as $depart): ?>
                              <option value="<?= $depart->id?>"><?= $depart->name?></option>
                              <?php endforeach; ?>
                          </select>
                      </div>
                  </div>
              </div>
              <div class="row mt-3">
                  <div class="col-md-8">
                      <div class="col-md-2">कैफियत</div>
                      <div class="col-md-6">
                          <textarea name="note" rows="4" cols="50"></textarea>
                      </div>
                  </div>
              </div>
          </div>

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
          <button type="submit" name="submit_transfer" class="btn btn-success">Save</button>
          <button type="reset" name="clear" class="btn btn-secondary">Clear</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    <?php echo form_close(); ?>
    </div>
  </div>
</div>
