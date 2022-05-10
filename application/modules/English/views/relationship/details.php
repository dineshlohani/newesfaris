<style type="text/css">

  body {

    font-family: Arial;

  }

  div.rel-img {

    margin: 5px;

    border: 1px solid #000;

    float: left;

    width: 110px;

    height: 110px;

  }



  div.gallery:hover {

    border: 1px solid #777;
  }
  div.gallery img {
    width: 100%;
    height: auto;
  }
  div.desc {
    padding: 15px;
    /*text-align: center;*/
  }
  .numbers {
    font-family: Tahoma;
    /*color: red;*/
  }
  p {
   font-family: Arial;
 }
 select {
  border-top-style: hidden;
  border-right-style: hidden;
  border-left-style: hidden;
  border-bottom-style: groove;
  background-color: #eee;
}
input 
{       
  font-family: Arial;
  border-top-style: hidden;
  border-right-style: hidden;
  border-left-style: hidden;
  /*border-bottom-style: groove;*/
  background-color: #e5e5e5;
}
.no-outline:focus {
  outline: none;
}
</style>
<?php
$this->load->helper('functions_helper');
if($this->uri->segment(2)== "create")
{
  $action_page = "birth-certificate/save";
  $name = "नवीनतम डाटा";
}
if($this->uri->segment(2)=="edit")
{
  $action_page = "citizenship-certificate/edit/".($this->uri->segment(3));
  $name = "साच्याउनुहोस";
}
if($detail->gender == 1){
    $gender = "Mr.";
}elseif($detail->gender == 2){
    $gender = "Mrs.";
}else{
     $gender = "Miss.";
}
$son_daughter = ($detail->relation == 1)? 'Son' : 'Daughter';
?>
<section class="content ">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="django-messages">
          <div class="container-fluid">
            <?php if(!empty($this->session->flashdata('msg'))): ?>

              <div  class="alert alert-success alert-dismissible" >    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span><?=$this->session->flashdata('msg');?></span></div>

            <?php endif; ?>

            <?php if(!empty($this->session->flashdata('err_msg'))): ?>

              <div  class="alert alert-danger alert-dismissible" >    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span><?=$this->session->flashdata('err_msg');?></span></div>

            <?php endif; ?>

          </div>

        </div>

      </div>

    </div>

  </div>



  <div class="container-fluid ">

    <nav aria-label="breadcrumb" class="bg-shadow">

      <ol class="breadcrumb px-3 py-2">

        <li class="breadcrumb-item ml-1"><a href="<?=  base_url()?>">Home</a></li>

        <li class="breadcrumb-item"><a href="<?=  base_url()?>relationship"> Relationship Certificate </a></li>

        <li class="breadcrumb-item active">Create</li>

      </ol>

    </nav>

  </div>

  <div class="container-fluid font-kalimati">

    <div class="bd-example bd-example-tabs">

      <nav class="nav nav-tabs" id="nav-tab" role="tablist">

        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#details" role="tab" aria-controls="home" aria-expanded="true"><i class="fa fa-info-circle"></i> DETAIL</a>

        <?php

        if($detail->status !=1)

        {

          ?>

          <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#sifaris" role="tab" aria-controls="profile" aria-expanded="false"><i class="fa fa-print"></i> PRINT PREVIEW</a>

          <?php

        }

        ?>

      </nav>

      <div class="tab-content" id="nav-tabContent">

        <div class="tab-pane fade <?php if($detail->status == 1){ echo 'active show';}?>" id="details" role="tabpanel" aria-labelledby="nav-home-tab" aria-expanded="true">

          <div class="row">

            <div class="col-md-12">

              <div class="offset-lg-2 col-lg-8">

                            <table class="table table-bordered my-4 ">

                                <tbody>

                                    <tr>

                                        <td>

                                            Form ID

                                        </td>

                                        <td class="numbers">

                                            <?= $detail->form_id?>

                                        </td>

                                    </tr>

                                    <tr>

                                      <td> Status </td>

                                      <td> <?php 

                                        if($detail->status == 1) {

                                          echo "SUBMITTED";

                                        } elseif($detail->status == 2) {

                                          echo 'DARTA';

                                        } elseif($detail->status == 3) {

                                          echo "CHALANI";

                                        } else {

                                          echo 'INVALID STATUS MUST ME 12,3';

                                        }

                                      //echo $detail->status == '1' ? "SUBMITTED": $detail->status == '2' ? "DARTA":$detail->status == '3' ? 'CHALANI':'INVALID';?></td>

                                    </tr>



                                    <tr>

                                        <td>Darta No </td>

                                        <td class="numbers">

                                           <?php echo !empty($detail->darta_no)?$detail->darta_no:'-';?>

                                        </td>

                                    </tr>



                                     <tr>

                                        <td>

                                            Chalani No

                                        </td>

                                        <td class="numbers">

                                           <?php echo !empty($chalani_details->chalani_no) ? $chalani_details->chalani_no :''  ?>

                                        </td>

                                    </tr>

                                    <tr>

                                      <td>Father  Name </td>

                                      <td><?php echo "Mr. ".$detail->father_name?></td>

                                    </tr>



                                    <tr>

                                      <td>Mother Name </td>

                                      <td><?php echo "Mrs. ".$detail->mother_name?></td>

                                    </tr>



                                    <tr>

                                      <td>Relation: </td>

                                      <td><?php echo $detail->relation?></td>

                                    </tr>

                                   <!--  <tr class="text-center font-bold font-20">

                                        <td colspan="2">Permanent Address</td>

                                    </tr> -->

                                    <tr>

                                      <td>Permanent Address </td>

                                      <td class="numbers"><?php echo $gapa->english_name.'-'.$detail->per_ward.','.$dis->english_name.','. $state->english_name?></td>

                                    </tr>


                                </tbody>

                            </table>

                            <table class="table table-bordered table-bordered">

                             <tr class="text-center font-bold font-20">

                              <td colspan="3">Family Members</td>

                            </tr>

                              <tr>

                                <td>SN</td>

                                <td>Name</td>

                                <td>Relation</td>

                              </tr>

                              <?php $i= 1;if(!empty($members)): 

                              foreach ($members as $key => $member) :?>

                                <tr>

                                  <td class="number"><?php echo $i++?></td>

                                  <td><?php echo $member->name?></td>

                                  <td><?php echo $member->relation?></td>

                                </tr>

                              <?php endforeach;endif;?>

                            </table>

                               <table class="table table-borderless ">

                                <tbody>



                                    <tr>

                                        <td colspan="2">

                                            <div class="row">

                                                <?php

                                                   if($detail->status == 1) {

                                               ?>

                                                <div class="col-lg-6">

                                                    <a class="btn btn-warning btn-submit mt-3 btn-block  " href="<?= base_url() ?>relationship/edit/<?= $detail->id ?>/">सम्पादन

                                                        गर्नुहोस्</a>

                                                </div>

                                                <div class="col-lg-6">

                                                    <a class="btn btn-success btn-submit  mt-3 btn-block  " href="<?= base_url() ?>relationship/darta/<?= $detail->id ?>/">

                                                        दर्ता गर्नुहोस</a>

                                                </div>

                                                <?php

                                                   }

                                                   elseif ($detail->status == 2) {

                                               ?>

                                               <div class="col-lg-6">

                                                    <a class="btn btn-warning btn-submit mt-3 btn-block  " href="<?= base_url() ?>relationship/edit/<?= $detail->id ?>/">सम्पादन

                                                        गर्नुहोस्</a>

                                                </div>

                                                <div class="col-lg-6">

                                                    <a class="btn btn-success btn-submit mt-3 btn-block  " href="<?= base_url() ?>relationship/chalani/<?= $detail->id ?>/">

                                                        चलानी गर्नुहोस</a>

                                                </div>

                                                <?php

                                                   }

                                               ?>

                                            </div>

                                        </td>

                                    </tr>

                                </tbody>

                            </table>

                        </div>

            </div>

          </div>

        </div>

      </div>



      <!-- ----------------------------------------districts----------------------------------------------------------------------------- -->

      <?php if($detail->status != 1) {?>

        <div class="tab-pane fade <?php if($detail->status != 1){ echo 'active show';}?>" id="sifaris" role="tabpanel" aria-labelledby="nav-home-tab" aria-expanded="true">

          <div class="row">

            <div class="col-lg-12">

              <div class="text-right">

                <?php if($detail->status == 3 ) : ?>

                <?php echo form_open(base_url().'relationship/print/'.$detail->id ,'target="_blank"'); ?>

                <button type="submit" class="btn  btn-success  mb-4"><i class="fa fa-print"></i> &nbsp; &nbsp; छाप्नुहोस्</button>

              <?php endif;?>

              </div>



              <div class="font-14 text-black" style="line-height: 1.6;">

                <div class="letter">

                  <div class="letter-head"><!-- Letter head -->

                    <div class="row">

                      <div class="col-3 letter-head-left">

                        <img src="<?=base_url()?>assets/images/icons/logo.png" alt="logo.png">

                                        <span class="red numbers"> F/Y: </span><span class=" numbers">  <?= $current_session->name ?></span><br>

                                        <span class="red numbers"> Ref no:  </span><span class=" numbers">  <?= !empty($chalani_details->chalani_no)?$chalani_details->chalani_no:'-' ?></span>

                                      </div>

                                      <div class="col-6 letter-head-center red">

                                        <h2><?= SITE_OFFICE_ENG ?></h2>

                                        <div>

                                          <?php if($this->session->userdata('is_muncipality') == 1):?>

                                            <h3> <?= SITE_PALIKA_ENG ?></h3>

                                            <?php else: ?>

                                              <h3 class="numbers"><?=$this->session->userdata('ward_no')?> <?= SITE_WARD_OFFICE_ENG ?></h3>

                                            <?php endif; ?>

                                            <?php if($this->session->userdata('is_muncipality')==0):?>

                                              <h3><?=  $this->session->userdata('address_eng').", ".SITE_DISTRICT_ENG?> </h3>

                                              <?php else: ?>

                                                <h3><?= SITE_ADDRESS_ENG ?></h3>

                                              <?php endif;?>

                                              <h4><?= SITE_STATE_ENG ?> </h4>

                                            </div>

                                          </div>

                                          <div class="col-3 text-right letter-head-right">

                                            <div class="myclear"> </div>

                                            <span class="red" style="font-family: Arial;"> Date :  <?= !empty($chalani_details->english_chalani_miti)?$chalani_details->english_chalani_miti:'-'?></span>

                                          </div>

                                        </div>

                                      </div><!-- Letter head end -->

                                     



                                      <div class="space4"></div>

                                      <div class="text-center mt-2 mb-5">

                                        <h4><span style="border-bottom: 1px solid black; margin-bottom: 3px;"> <span class="red"> SUB: </span> RELATIONSHIP VERIFICATION </span>

                                          <h4><span style="border-bottom: 1px solid black; margin-bottom: 3px;"> TO WHOM IT MAY CONCERN </span>

                                          </h4>

                                        </div>

                                        <div class="text-justify" style=" font-family: Arial; ">

        This is to certify that <b><?php echo $gender?> <?php echo $detail->app_name?></b> <?php echo $detail->relation?> of<b> &nbsp;Mr. <?php echo  $detail->father_name?></b> & <b>Mrs. <?php echo $detail->mother_name?></b> Permanent resident of &nbsp;<?php echo $gapa->english_name?> Ward No. <?php echo $detail->per_ward?>, <?php echo $dis->english_name?>, <?php echo $state->english_name?>, Nepal. As per her application and recommendation made by ward No. <?php echo $detail->rem_ward?>,
        <?php echo SITE_OFFICE_ENG?> <?php echo SITE_DISTRICT_ENG?>, Nepal, the following members are the family members of the applicant as mentioned below :<br>

                                          <hr>

                                          <div class="row">

                                            <!-- <div class="col-md-12"> -->
                                               <div class="photo_box"> <span> फोटो </span> 
                                                  <p style="margin-top: 70px;"><?php echo $gender ?> <?php echo $detail->app_name?></p>
                                                   <span style="margin-top: -89px;">(Applicant)
                                                </div>
                                              <?php if(!empty($members)){
                                                foreach ($members as $key => $rel) { ?>
                                                  <div class="photo_box"> <span> फोटो </span> 
                                                    <p style="margin-top: 70px;"><?php echo $rel->gender?>. <?php echo $rel->name?></p>
                                                    <span style="margin-top: -89px;">(<?php echo $rel->relation?>)</span>
                                                  </div>
                                                <?php  }
                                              } ?>
                                            </div>
                                          </div>

                                          <div class="row">

                                            <div class="col-3 offset-9">

                                              <div style="margin-top: 120px;">

                                                <div class="text-center">

                                                  ................................. <br>
                                                  <select class="form-control worker_id" name="ward_worker" id="worker_id" required="true">
                                                    <option value="">Plesase Select</option>
                                                    <?php if(!empty($ward_worker)) : 
                                                      foreach($ward_worker as $worker) : ?>
                                                        <option value="<?php echo $worker->id?>"> <?php echo $worker->english_name?></option>
                                                      <?php endforeach;endif?>                                          
                                                    </select>
                                                    <?php //echo !empty($ward_worker->english_name)?$ward_worker->english_name:''?>
                                                    <!--  <br>Chairman -->
                                                    <br>
                                                    <input type="text" name="" class="worker_post form-control" id="worker_post">

                                                 <!--  <?php //echo $ward_worker->english_name?>

                                                  <br>Chairman -->

                                                  <?php echo form_close();?>

                                                </div>

                                              </div>

                                            </div>

                                          </div>

                                        </div>

                                      </div>

                                    </div>

                                  </div>

                                <?php } ?>

                              </div>

                            </div>

                          </section>

                        </div>

<script src="<?=base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>

<script type="text/javascript"></script>

<script>

  function checkMyDate(date_selected, id_selected) {

    if(id_selected=="nepaliDate4") {

      var  nep_dob = date_selected;

      param = {};

      param.nep_dob = nep_dob;

      JQ.ajax({

        url: "<?= base_url()?>getConvertedDate",

        method: "POST",

        data: param,

        success: function (data) {

          var obj = JSON.parse(data);

          JQ("#id_eng_dob").val(obj.html);

        },

        error: function (error) {

          console.log(JSON.stringify(error));

        }

      });

    }

  }

</script>