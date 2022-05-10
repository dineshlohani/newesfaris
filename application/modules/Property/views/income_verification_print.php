<?php
    $local_body     = Modules::run("Settings/getLocal",$result->local_body);
    $state          = Modules::run("Settings/getState",$result->state);
    $ward           = Modules::run("Settings/getWard",$result->ward);
    $district       = Modules::run("Settings/getDistrict",$result->district);
    $path           = base_url()."assets/documents/property/income_verification/";
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
    <div class="text-center my-4 py-2 pt-5">
        <h4><span style="border-bottom: 1px solid black; margin-bottom: 3px;"> <span class="red"> Subject: </span> Verification of Annual Income</span>
        </h4>
    </div>

    <div class="text-center pb-5">
        <h4><span style="border-bottom: 1px solid black; margin-bottom: 3px;">To Whom It May Concern</span>
        </h4>
    </div>

    <p class="text-justify">
        This is to certify that Mr/Mrs/Miss <span
                class="text-capitalize"><?= $result->applicant_name ?></span>, permanent resident of
        <?= $local_body->english_name ?> Ward
        No: <?= $ward->name ?>, <?= $district->english_name?> , <?= $state->english_name?>, Nepal, has income from the following
        sources:
    </p>


    <table class="table letter-table table-bordered mybordertable">
        <thead>
            <tr>
                <th>S.N.</th>
                <th>
                    Relations with Applicant
                </th>
                <th>
                    Parties Name
                </th>
                <th>
                    Annual Income
                </th>
                <th>
                    Remarks
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
                $total  = 0;
                $rate   = $this->input->cookie('currency_rate',true);
                $i      = 1;
                foreach($income_details as $data):
                    $relation = Modules::run("Settings/getRelation",$data->relation);
                    if(!empty($data->description))
                    {
                        $description = $data->description;
                    }
                    else
                    {
                        $description = "-";
                    }
                    $total += $data->annual_income;
             ?>
            <tr>
                <td><?= $i ?></td>
                <td class="text-capitalize"><?= $relation->english_name ?></td>
                <td class="text-capitalize"><?= $data->parties_name ?></td>
                <td><?= $data->annual_income ?></td>
                <td> <?= $description ?> </td>

            </tr>

            <?php $i++; endforeach;?>
        </tbody>
    </table>

    <div class="text-justify">
        Total valuation of income source is
        <strong>NRs. <?= placeholder($total) ?></strong> which is equivalent to
        <strong>$ <?= number_format($total * $rate ,2,".",",")?></strong> Note:Today's exchange rate <strong>$1 =
            NRs. <?= $rate ?></strong>.
    </div>

    <div class="row">
       <div class="space5"></div>
        <div class="col-3 offset-9 signature">
            <div class="">

                <?= $ward_worker->name?><br />
                <?= $worker_post->name?>
            </div>
        </div>

    </div>
</div><br><br><br><br><br><br><br>
<hr>
<div class="text-center">"शिक्षा ,स्वास्थ्य ,कृषि ,पर्यटन र पूर्वाधार-समृद् ज्वालामुखीको मूल आधार"</div>