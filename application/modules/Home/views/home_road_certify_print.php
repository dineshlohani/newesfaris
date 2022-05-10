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
<div class="letter_print">
    <hr>
    <div class="row">
        <div class="col-3 letter-head-left">
            <p style="font-size:18px;"><span class="red"> पत्र संख्या: </span> <?= $current_session->name ?><br></p>
            <p style="font-size:18px;"><span class="red"> चलानी नं.:  </span> <?php echo !empty($chalani_no)?$chalani_no:'चलानी गरिएको छैन' ?></p>
        </div>
        <div class="col-3 text-right letter-head-right" style="margin-left: 605px">
            <div class="myclear"> </div>
             <p style="font-size:18px; margin-top: -39px;"><span class="red"> मिति : </span> <?= $chalani_result->nepali_chalani_miti?></p>
        </div>
    </div>
    <div class="col-md-4">
        <?php
            $this_office   = Modules::run('Settings/getOffice', $print_office->id);
        ?>
        <div class='row'>
            <p style="font-size:18px; margin-top: 30px;"><?= !empty($this_office->sambodhan) ? $this_office->sambodhan : ''?></p>
        </div>
        <div class="row">
           <p style="font-size:18px;"> <?= $this_office->name?></p>
        </div>
        <div class="row">
           <p style="font-size:18px;"> <?= !empty($this_office->address) ? $this_office->address : ''?></p>
        </div>
    </div>
   
    <div class="text-center my-4 py-2 mt-5">
       <p style="font-size:26px;"><span class="red">बिषय:<u></span> : घरबाटो प्रमाणित ।</u></p>
    </div>
    <div style="margin-top: -18px;">
        <p class="text-body" style="font-size: 18px; text-align: justify;">
           प्रस्तुत बिषयमा   <b>
        <?php echo SITE_DISTRICT?></b> जिल्ला <b><?php echo SITE_OFFICE ?></b> वडा नं. <b><?= getonlyNumber($result->ward)?>
    </b> निवासी <?=$result->gender_spec?> <b><?= $result->applicant_name?></b>ले यस वडा कार्यालयमा दिनुभएको निवेदन अनुसार निम्न कित्ता जग्गाको हालको मितिसम्ममा निम्न अनुसारको घरबाटोको विवरण रहेको व्यहोरा सिफारिसका साथ अनुरोध गरिन्छ ।
</p>
    </div>
   
    <div class="text-center my-3 pt-3">
         <p style="font-size: 22px;">तपशिल</p>
    </div>

    <table class="table table-bordered text-center mytableborder">
        <thead>
            <tr>
                <th rowspan="2" style="font-size:18px;">क्र.स.</th>
                <th rowspan="2" style="font-size:18px;">वडा नं</th>
                <th colspan="3" style="font-size:18px;">जग्गाको विवरण</th>
                <th rowspan="2" style="font-size:18px;">घर</th>
                <th rowspan="2" style="font-size:18px;">घरको प्रकार</th>
                <th rowspan="2" style="font-size:18px;">अनुमानित मुल्य</th>
                <th rowspan="2" style="font-size:18px;">बाटो</th>
                <th rowspan="2" style="font-size:18px;">बाटोको प्रकार</th>
                <th rowspan="2" style="font-size:18px;">कैफियत</th>
            </tr>
            <tr>
                <th>न.सि.नं</th>
                <th>कि.नं</th>
                <th>क्षेत्रफल (रो. आ. पै. दा.</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $i = 1;
                    foreach($land_details as $details)
                    {
                        $old_new_address    = $this->Mdl_oldnew_address->getById($details->old_new_address);
                        if($details->home == 1)
                        {
                            $home       = "भएको";
                            $home_type      = $this->Mdl_home_type->getById($details->home_type);
                        }
                        else
                        {
                            $home       = "नभएको";
                        }

                        if($details->road == 1)
                        {
                            $road       = "भएको";
                            $road_type      = $this->Mdl_road_type->getById($details->road_type);
                        }
                        else
                        {
                            $road       = "नभएको";
                        }

                        if(empty($details->description))
                        {
                            $description    = "-";
                        }
                        else
                        {
                            $description    = $details->description;
                        }
                ?>
            <tr>
                <td><p style="font-size:18px;"><?= $i ?></p></td>
                <td><p style="font-size:18px;"><?= getonlyNumber($old_new_address->new_name)?></p></td>
                <td><p style="font-size:18px;"><?= $details->map_sheet_no ?></p></td>
                <td><p style="font-size:18px;"><?= $details->kitta_no ?></p></td>
                <td><p style="font-size:18px;"><?= $details->biggha."-".$details->kattha."-".$details->dhur.'-'.$details->paisa?></p></td>
                <td>
                  <p style="font-size:18px;">  <?= $home ?></p>
                </td>
                <td>
                   <p style="font-size:18px;"> <?= $details->home == 1 ? $home_type->name : "-" ?></p>
                </td>
                <td>
                    <p style="font-size:18px;"><?= $details->home == 1 ? $details->estimated_cost : "-" ?></p>
                </td>
                <td>
                   <p style="font-size:18px;"> <?= $road?></p>
                </td>
                <td>
                  <p style="font-size:18px;">  <?= $details->road == 1 ? $road_type->name : "-" ?></p>
                </td>
                <td>
                  <p style="font-size:18px;">  <?= $description ?></p>
                </td>
            </tr>
            <?php
                    $i++;
                    }
                ?>
        </tbody>
    </table>
    <div class="space4"></div>
    <div class="row">
        <div class="col-3 offset-9">
            <div class="signature">
                <?= $ward_worker->name?><br />
                <?php if(!empty($department)) {
                    echo $department->name;
                } else { ?>
                     <?= $worker_post->name?>
                <?php  } ?>
               
            </div>
        </div>
    </div>
</div>