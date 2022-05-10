<style type="text/css">

body {

  font-family: Arial;

}

</style>



<?php



    $local_body     = Modules::run("Settings/getLocal",$result->local_body);

    $state          = Modules::run("Settings/getState",$result->state);

    $ward           = Modules::run("Settings/getWard",$result->ward);

    $district       = Modules::run("Settings/getDistrict",$result->district);

    $office         = Modules::run("Settings/getOffice",$result->office);

    if(!empty($result->document))

    {

        $documents      = explode("+",$result->document);



    }

    $path           = base_url()."assets/documents/home/road/";

    $current_session    = Modules::run('Settings/getCurrentSession',$result->session_id);

    $worker_post        = Modules::run('Settings/getPost',$ward_worker->post_id);

    $this_office   = Modules::run('Settings/getOffice', $print_office->id);

?>

<br /><br />

<div class="letter_print">

    <div class="letter-head">

        <!-- Letter head -->

        <div class="row">

            <div class="col-3 letter-head-left">

                <img src="<?=base_url()?>assets/images/icons/logo.png" alt="logo.png">

            </div>

          

            <div class="col-6 letter-head-center red">

                <h2><?= SITE_OFFICE_ENG ?></h2>

                <div>

                    <?php if($this->session->userdata('is_muncipality') == 1):?>

                    <h3> <?= SITE_PALIKA_ENG ?></h3>

                    <?php else: ?>

                    <h3><?=$this->session->userdata('ward_no')?> <?= SITE_WARD_OFFICE_ENG ?></h3>

                    <?php endif; ?>

                    <?php if($this->session->userdata('is_muncipality')==0):?>

                    <h3><?=  $this->session->userdata('address').", ".SITE_DISTRICT_ENG?> </h3>

                    <?php else: ?>

                    <h3><?= SITE_ADDRESS_ENG ?></h3>

                    <?php endif;?>

                    <h4><?= SITE_STATE_ENG ?> </h4>

                </div>

            </div>

            <div style="margin-left: 630px;">E-mail: "<?php echo SITE_EMAIL?>"<br>

                                Web: <?php echo SITE_EMAIL ?></div>

        </div>

    </div><!-- Letter head end -->

    <hr><br>

    <div class="row">

    <div class="col-3 letter-head-left">

                <span class="red"> F/Y: </span> <?= $current_session->name ?><br>

                <span class="red"> Dispatch No.: </span> <?= $chalani_no ?>

    </div>

    <div class="col-3 text-right letter-head-right" style="margin-left: 605px">

                <div class="myclear"> </div>

                <span class="red"> Date : </span> <?= $result_chalani->english_chalani_miti?>

    </div>

    </div>

    <div class="col-md-4" style="margin-top:50px;">

        <div class='row'>

            <?= !empty($this_office->sambodhan) ? $this_office->sambodhan."," : ''?>

        </div>

        <div class="row">

            <?= $this_office->name?>,

        </div>

        <div class="row">

            <?= !empty($this_office->address) ? $this_office->address."," : ''?>

        </div>



    </div>

   <!--  <div class="text-center my-4 py-2 mt-5">

        <h4>विषय: घरबाटो प्रमाणित ।</h4>

    </div> -->

  <div class="text-center mt-2 mb-5">

                            <h4><span style="border-bottom: 1px solid black; margin-bottom: 3px;"> <span class="red"> SUB: </span> BIRTH CERTIFICATE </span>

                              <h4><span style="border-bottom: 1px solid black; margin-bottom: 3px;"> TO WHOM IT MAY CONCERN </span>

                            </h4>

                        </div>

                       This is to certify that <b><?php echo $gender?>. <?php echo $detail->app_name?></b>, <?php echo $son_daughter?> of <b>Mr. <?php echo $detail->father_name?></b>, &amp; <b>Mrs.

                           <?php echo $detail->father_name?></b>, Was born in <?php echo $born_gapa->english_name?>, Ward No.  <?php echo $detail->birth_ward?>, <?php echo $born_dis->name?>, 

                           Permanent resident

                          of Jwalamukhi Rural Municipality Ward No. 05, Dhading, 3 No. Province, Nepal.

                          <br>

                          According to our record her date of birth is <?php echo $detail->dob_np?> B. S. (<?php echo $detail->dob_en?> A. D.).

    <div class="space4"></div>

    <div class="row">

        <div class="col-3 offset-9">

            <div class="signature">

               <p style="font-size: 18px;"><?php echo $worker_id->english_name?></p>
              <p style="font-size: 18px;"><?php echo $post->designation?></p>

            </div>

        </div>

    </div>
    <hr>
</div>



