<style type="text/css">

body {

  font-family: Arial;

}

.numbers {

  font-family: Tahoma;

 /* color: red;*/

}

select{

  font-family: Arial;

}

</style>

<?php

    $this->load->helper('functions_helper');

    if($this->uri->segment(2)== "create")

    {

    $action_page = "annual-income-en/save";

    $name = "नवीनतम डाटा";

    }

   

   

    $gender = ($result->gender == 1) ? 'MR' : 'MRS';

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

                <li class="breadcrumb-item"><a href="<?=  base_url()?>annual-income-en"> Annual Income Certificate </a></li>

                <li class="breadcrumb-item active">Detail</li>

            </ol>

        </nav>

    </div>

    <div class="container-fluid font-kalimati">

        <div class="bd-example bd-example-tabs">

            <nav class="nav nav-tabs" id="nav-tab" role="tablist">

                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#details" role="tab" aria-controls="home" aria-expanded="true"><i class="fa fa-info-circle"></i> DETAIL</a>

                <?php

                if($result->status !=1)

                {

            ?>

                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#sifaris" role="tab" aria-controls="profile" aria-expanded="false"><i class="fa fa-eye"></i> PRINT PREVIEW</a>

                <?php

                }

            ?>

            </nav>

            <div class="tab-content" id="nav-tabContent">

              <div class="tab-pane fade active show" id="details" role="tabpanel" aria-labelledby="nav-home-tab" aria-expanded="true">

                <div class="row">

                    <div class="col-lg-12">

                      <table class="table table-bordered my-4">

                        <tbody>

                         <tr class="text-center font-bold font-20">

                              <td colspan="2"><i class="fa fa-check-circle-o" style="color:<?php if($result->status == 1 ){

                                  echo "red";

                                } elseif($result->status == 2) {

                                  echo 'bkue';

                                } elseif($result->status == 3 ) {

                                  echo 'green';

                                } else {

                                  echo "#000";

                                }?>"></i> Address Verification Detail</td>

                          </tr>

                          <tr>

                              <td>

                                  From ID

                              </td>

                              <td class="numbers">

                                  <?= $result->form_id?>

                              </td>

                          </tr>

                          <tr>

                              <td>

                                 Status

                              </td>

                              <td>

                                <?php 

                                  if($result->status == 1) {

                                          echo "SUBMITTED";

                                        } elseif($result->status == 2) {

                                          echo 'DARTA';

                                        } elseif($result->status == 3) {

                                          echo "CHALANI";

                                        } else {

                                          echo 'INVALID STATUS MUST ME 12,3';

                                        }

                                ?>

                              </td>

                          </tr>

                           <tr>

                              <td>

                                 Darta No

                              </td>

                              <td class="numbers">

                                  <?php echo !empty($result->darta_no)?$result->darta_no:'-' ?>

                              </td>

                          </tr>

                          <tr>

                              <td>

                                CHALANI NO 

                              </td>

                              <td class="numbers">

                                  <?php echo !empty($chalani_details->chalani_no)?$chalani_details->chalani_no:'-' ?>

                              </td>

                          </tr>

                          <tr class="text-center font-bold font-20">

                              <td colspan="2">Detail</td>

                          </tr>

                          <tr>

                              <td>

                                  Applicant Name

                              </td>

                              <td><?= $result->app_name ?></td>

                          </tr>

                          <tr>

                              <td>

                                  Father's Name

                              </td>

                              <td><?= $result->father_name?></td>

                          </tr>

                         <tr>

                              <td>

                                  Mother's Name

                              </td>

                              <td><?= $result->mother_name ?></td>

                          </tr>

                          

                          <tr>

                              <td>

                                 Permanent Address

                              </td>

                              <td class="numbers">

                                 <?= $per_gapa->english_name.", ward no-".$result->per_ward.", ".$per_district->english_name .",".$per_state->english_name.", Nepal"?>

                              </td>

                          </tr>

                        </tbody>

                      </table>



                      <table class="table table-bordered table-bordered">

                        <tr class="text-center font-bold font-20">

                          <td colspan="5">Source of Income</td>

                        </tr>

                        <tr>

                          <td>SN</td>

                          <td>Income Source 

                            <?php 

                              $current = date('Y');

                              $first = date('Y', strtotime('-1 year'));

                              $secondYear = date('Y',strtotime('-2 year'));

                              $thirdYear = date('Y',strtotime('-3 year'));

                            ?>

                          </td>

                            <td class="numbers">Annual Income of <br>Fiscal Year <br><?php echo $thirdYear.'/'.$secondYear?></td>

                            <td class="numbers">Annual Income of <br>Fiscal Year <br><?php echo $secondYear.'/'.$first?></td>

                            <td class="numbers">Annual Income of <br>Fiscal Year <br><?php echo $first.'/'.$current?> </td>

                        </tr>

                        <?php 

                        $i= 1;

                        $ft = 0;

                        $st = 0;

                        $tt = 0;

                        if(!empty($sources)): 

                        foreach ($sources as $key => $source) :?>

                          <tr>

                            <td class="numbers"><?php echo $i++?></td>

                            <td><?php echo $source->income_source?></td>

                            <td class="numbers"><?php echo $source->fy_i?></td>

                            <td class="numbers"><?php echo $source->fy_ii?></td>

                            <td class="numbers"><?php echo $source->fy_iii?></td>

                            <?php 

                              $ft += $source->fy_i;

                              $st += $source->fy_ii;

                              $tt += $source->fy_iii;

                            ?>

                        </tr>

                        <?php endforeach;endif;?>

                        <tfoot>

                          <tr>

                            <td colspan="2"></td>

                            <td class="numbers"><?php echo $ft;?></td>

                            <td class="numbers"><?php echo $st;?></td>

                            <td class="numbers"><?php echo $tt;?></td>

                          </tr>

                        </tfoot>

                      </table>

                      <div class="row">

                        <div class="offset-lg-2 col-lg-8">

                          <table class="table table-borderless ">

                            <tbody>

                              <tr>

                                <td colspan="2">

                                  <div class="row">

                                    <?php if($result->status == 1) { ?>

                                      <div class="col-lg-6">

                                        <a class="btn btn-warning btn-submit mt-3 btn-block  " href="<?= base_url() ?>annual-income-en/edit/<?= $result->id ?>/">सम्पादन गर्नुहोस्</a>

                                      </div>

                                      <div class="col-lg-6">

                                        <a class="btn btn-success btn-submit  mt-3 btn-block  " href="<?= base_url() ?>annual-income-en/darta/<?= $result->id ?>/">दर्ता गर्नुहोस</a>

                                      </div>

                                    <?php  } elseif ($result->status == 2) { ?>

                                      <div class="col-lg-6">

                                        <a class="btn btn-warning btn-submit mt-3 btn-block  " href="<?= base_url() ?>annual-income-en/edit/<?= $result->id ?>/">सम्पादन गर्नुहोस्</a>

                                      </div>

                                    <div class="col-lg-6">

                                      <a class="btn btn-success btn-submit mt-3 btn-block  " href="<?= base_url() ?>annual-income-en/chalani/<?= $result->id ?>/">चलानी गर्नुहोस</a>

                                    </div>

                                    <?php } ?>

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

              <?php if($result->status != 1) {?>

              <div class="tab-pane fade" id="sifaris" role="tabpanel" aria-labelledby="nav-home-tab" aria-expanded="true">

                <div class="row">

                    <div class="col-lg-12">

                      <div class="text-right">

                        <?php if($result->status == 3) : ?>

                        <?php echo form_open(base_url().'annual-income-en/print/'.$result->id ,'target="_blank"'); ?>

                        <button type="submit" class="btn  btn-success  mb-4"><i class="fa fa-print"></i> &nbsp; &nbsp; छाप्नुहोस्</button>

                      <?php endif;?>

                      </div>



                      <div class="font-14 text-black" style="line-height: 1.6;">

                        <div class="letter">

                            <div class="letter-head"><!-- Letter head -->

                                <div class="row">

                                    <div class="col-3 letter-head-left">

                                        <img src="<?=base_url()?>assets/images/icons/logo.png" alt="logo.png">

                                      <span class="red"> F/Y: </span> <span class="numbers"><?= $current_session->name ?></span><br>

                                        <span class="red"> Dispatch No:  </span> <span class="numbers"><?php echo $chalani_details->chalani_no ?></span>

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

                                        <span class="red" style="font-family: Arial;"> Date :  <?= $chalani_details->english_chalani_miti?></span>

                                    </div>

                                </div>

                            </div><!-- Letter head end -->

                        <div class="col-md-3">

                            <?php

                                if($print_detail != FALSE)

                                {

                                    $this_office = Modules::run('Settings/getOffice',$print_detail->office_id);

                                }

                            ?>

                            <div class="row non-border-input">

                                <input type="text" id="office_sambodhan" class="form-control" value="<?= $print_detail != FALSE ? $this_office->sambodhan : ''?>">

                            </div>

                          

                        </div>

                       

                        <div class="space4"></div>

                        <div class="text-center mt-2 mb-5">

                            <h4><span style="border-bottom: 1px solid black; margin-bottom: 3px;"> <span class="red"> SUB: </span> CERTIFICATE OF ANNUAL INCOME </span>

                              <h4><span style="border-bottom: 1px solid black; margin-bottom: 3px;"> TO WHOM IT MAY CONCERN </span>

                            </h4>

                        </div>

                        <div class="text-justify" style=" font-family: Arial; ">

                          This is to certify that  <b><?php echo $gender?>. <?php echo $result->app_name?></b> 

                           (Father of applicant Mr. <?php echo $result->father_name?>) permanent resident of <?= $per_gapa->english_name.", Ward No ".$result->per_ward.", ".$per_district->english_name ?>. The family has been earning from different sources of different fiscal year as listed below:

                        </div>

                        <br>

                        <div class="text-justify" style=" font-family: Arial; ">

                          <table class="table table-bordered table-bordered">

                            

                            <tr>

                              <td>SN</td>

                              <td>Income Source 

                                <?php 

                                $current = date('Y');

                                $first = date('Y', strtotime('-1 year'));

                                $secondYear = date('Y',strtotime('-2 year'));

                                $thirdYear = date('Y',strtotime('-3 year'));

                                ?>

                              </td>

                              <td class="numbers">Annual Income of Fiscal Year <br><?php echo $thirdYear.'/'.$secondYear?></td>

                              <td class="numbers">Annual Income of Fiscal Year <br><?php echo $secondYear.'/'.$first?></td>

                              <td class="numbers">Annual Income of Fiscal Year <br><?php echo $first.'/'.$current?> </td>

                            </tr>

                            <?php 

                            $i= 1;

                            $ft = 0;

                            $st = 0;

                            $tt = 0;

                            if(!empty($sources)): 

                              foreach ($sources as $key => $source) :?>

                                <tr>

                                  <td class="numbers"><?php echo $i++?></td>

                                  <td><?php echo $source->income_source?></td>

                                  <td class="numbers"><?php echo $source->fy_i?></td>

                                  <td class="numbers"><?php echo $source->fy_ii?></td>

                                  <td class="numbers"><?php echo $source->fy_iii?></td>

                                  <?php 

                                  $ft += $source->fy_i;

                                  $st += $source->fy_ii;

                                  $tt += $source->fy_iii;

                                  ?>

                                </tr>

                              <?php endforeach;endif;?>

                              <tfoot>

                                <tr>

                                  <td colspan="2" align="center">Total</td>

                                  <td class="numbers"><?php echo $ft;?></td>

                                  <td class="numbers"><?php echo $st;?></td>

                                  <td class="numbers"><?php echo $tt;?></td>

                                </tr>

                              </tfoot>

                            </table>

                        </div>



                        <div class="text-justify" style=" font-family: Arial; ">

                          Total Annual income of the fiscal Year <?php echo $first.'/'.$current?> is NRs. <?php echo $tt?>

                        </div>

                        <div class="text-justify" style=" font-family: Arial; ">

                          Equivalent is USD <?php  

                            $rate = $this->input->cookie('currency_rate',true);

                            $amount = $rate * $tt;

                            echo $amount;

                          ?>

                        </div>

                        <div class="text-justify" style=" font-family: Arial; ">

                         Exchange rate (Selling rate) fixed by Nepal Rastra Bank on <?php echo date('Y-m-d')?> for US $1 = NRs. <?php echo $this->input->cookie('currency_rate',true);

                          ?>

                        </div>

                        

                        <div class="row">

                            <div class="col-3 offset-9">

                                <div style="margin-top: 120px;">

                                    <div class="text-center">

                                        ................................. <br>
<!-- 
                                        <?php //echo $ward_worker->english_name?>

                                        <br>Chairman -->
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
                                     

                                        <?php echo form_close();?>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>



                    </div>

                </div>

              </div>

              <!------------------------------------------districts----------------------------------------------------------------------------- -->

            <?php } ?>

            </div>

          </div>

    </section>

</div>

<script src="<?=base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>

<script type="text/javascript"></script>

<script>

function checkMyDate(date_selected, id_selected)

    {

      if(id_selected=="nepaliDate4")

      {

//        console.log(obj);

       var  nep_dob = date_selected;

//              alert(nep_dob);

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