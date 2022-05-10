<?php
    $local_body     = Modules::run("Settings/getLocal",$result->local_body);
    $state          = Modules::run("Settings/getState",$result->state);
    $ward           = Modules::run("Settings/getWard",$result->ward);
    $district       = Modules::run("Settings/getDistrict",$result->district);
    $current_session    = Modules::run('Settings/getCurrentSession',$result->session_id);
    $worker_post        = Modules::run('Settings/getPost',$ward_worker->post_id);
?>
<div class="letter_print font-eng">
    <div class="letter-head">
                            <!-- Letter head -->
                            <div class="row">
                                <div class="col-3 letter-head-left">
                                    <img src="<?=base_url()?>assets/images/icons/logo.png" alt="logo.png">
                                </div>
                                <div class="col-6 letter-head-center red">
                                    <h2><?= SITE_OFFICE_ENG ?></h2>
                                    <h3>Ward
                                        No. <?= $this->session->userdata('ward_no') ?>
                                        Office</h3>
                                    <?php if($this->session->userdata('is_muncipality')==0):?>
                                    <h3><?=  $this->session->userdata('address_eng').", ".SITE_DISTRICT_ENG?> </h3>
                                    <?php else: ?>
                                    <h3><?= SITE_ADDRESS_ENG ?></h3>
                                    <?php endif;?>
                                    <h4><?= SITE_STATE_ENG ?></h4>
                                </div>
                                <div style="margin-left: 680px;">E-mail: "<?php echo $user->email;?>"<br>
                                Web: "<?php echo SITE_EMAIL?></div>
                            </div>
                        </div><!-- Letter head end -->
                        <hr>
                        <div class="row">
                        <div class="col-3 letter-head-left">
                                    <span class="red">  F/Y: </span> <?= $current_session->name ?>
                                    <div class="clearfix"></div>
                                    <span class="red">  Ref no: </span> <?= $chalani_no ?>
                                </div>
                                <div class="col-3 text-right letter-head-right" style="margin-left: 605px">
                                    <div class="myclear"> </div>
                                    <span class="red"> Date : </span> <?= $chalani_result->nepali_chalani_miti?>
                                </div>
                            </div>
    <div class="text-center pb-4 pt-5">
        <h3><span style="border-bottom: 1px solid black; margin-bottom: 3px;">To Whom It May Concern</span>
        </h3>
    </div>

    <div class="text-center mt-2 mb-5 pb-4">
        <h4><span
                style="border-bottom: 1px solid black; margin-bottom: 3px;"> <span class="red"> Subject: </span> Tax Clearance Certificate</span>
        </h4>
    </div>

    <div class="text-justify" style="line-height: 2;">
        This is to certify that Mr./Mrs./Miss <span
            class="text-capitalize"><?= $result->applicant_name ?></span> has paid all Business
        Tax, Rental Tax, House
        and Land Tax/Integrated Property Tax ( <?= $result->property_tax ?> & Plot
        No. <?= $result->plot_no ?> Ward
        No. <?= $result->property_ward ?>)
        as per the rule of ……………………………..…………………………….. Office on fiscal
        year <?= $current_session->name ?> B.S.
    </div>

    <div class="row">
       <div class="space5"></div>
        <div class="col-3 offset-9 signature">
            <div>

                <?= $ward_worker->name?><br/>
                <?= $worker_post->name?>

            </div>
        </div>

    </div>
</div><br><br><br><br><br><br><br>
<hr>
<div class="text-center">"शिक्षा ,स्वास्थ्य ,कृषि ,पर्यटन र पूर्वाधार-समृद् ज्वालामुखीको मूल आधार"</div>
