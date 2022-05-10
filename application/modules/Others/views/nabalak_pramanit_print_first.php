<?php
 $p_local_body     = Modules::run("Settings/getLocal",$result->p_local_body);
    $p_ward           = Modules::run("Settings/getWard",$result->p_ward);
    $p_state          = Modules::run("Settings/getState",$result->p_state);
    $p_district     = Modules::run("Settings/getDistrict",$result->p_district);
    $j_local_body     = Modules::run("Settings/getLocal",$result->j_local_body);
     $relation          = Modules::run("Settings/getRelation",$result->relationship);
     $j_ward           = Modules::run("Settings/getWard",$result->j_ward);
     $j_state          = Modules::run("Settings/getState",$result->j_state);
    $j_district     = Modules::run("Settings/getDistrict",$result->j_district);
     $birthdate_eng = explode("-",$result->eng_dob);
     $current_session    = Modules::run('Settings/getCurrentSession',$result->session_id);

    //  $p_local_body     = Modules::run("Settings/getLocal",$result->p_local_body);
    // $p_ward           = Modules::run("Settings/getWard",$result->p_ward);
    // $p_state          = Modules::run("Settings/getState",$result->p_state);
    // $p_district     = Modules::run("Settings/getDistrict",$result->p_district);
     // $birthdate_eng = explode("-",$result->eng_dob);
     // $current_session    = Modules::run('Settings/getCurrentSession',$result->session_id);
$worker_post        = Modules::run('Settings/getPost',$ward_worker->post_id);
     ?>
<div class="letter_print">
    
    <hr>
    <div class="row">
        <div class="col-3 letter-head-left">
            <p style="font-size:18px;"><span class="red"> पत्र संख्या: </span> <?= $current_session->name ?></p>
            <p style="font-size:18px;"><span class="red"> चलानी नं.:  </span> <?= $chalani_no ?></p>
        </div>
        <div class="col-3 text-right letter-head-right" style="margin-left: 719px">
                <div class="myclear"> </div>
                <span class="red"> मिति : </span> <?= $chalani_result->nepali_chalani_miti?>
            </div>
        </div>
    <div class="space1"></div>
    <div class="row mt-5">
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
        <div class="col-4 offset-2">
            <div class="text-right" style="margin-left: 780px">
                    <div class="py-5" style="border: 2px solid black;height: 140px; width: 135px; float:right;margin-top: -80px;">
                       निवेदकको दुवै कान <br> देखिने पासपोर्ट <br> साइजको
                        फोटो<p style="font-size:18px; margin-top: 30px;">
                    </div>
            </div>
        </div>
    </div>

    <div class="text-center my-5 ">
        <p style="font-size:26px; margin-top: -180px;">
            <span style="border-bottom: 1px solid black; margin-bottom: 5px;"> <span class="red"> बिषय : </span> नाबालक परिचयपत्र पाउँ ।
            </span>
        </p>
    </div>

    <div>
        <div class="my-4"><p style="font-size:18px; text-align: justify; margin-top: 35px;">महोदय,</p></div>

        <div class="text-justify" style="text-indent: 50px;">
             <p style="font-size:18px; text-align: justify; margin-top: 35px;"> मेरो निम्नानुसारको विवरण भएको 
            <?php 
            if ($result->gender=="Male") {
                echo छोरा ;
            }else{
                echo छोरी;
            }
            ?>को नाबालक परिचयपत्र बनाउनु
            परेकोले
            सिफारिस साथ रु.१० को टिकट टाँसी
            यो निबेदन पेश 
            <?php 
            if ($result->gender=="Male") {
                echo गरेको ;
            }else{
                echo गरेकी;
            }?>
            छु। मेरो सम्बन्धले निजको नामबाट यस अघि
            नाबालक
            परिचयपत्र लिएको छैन। </p>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
           <table class="table table-bordered">
               <!--  <tr>
                    <td></td>
                </tr> -->
                <tr>
                    <td>१.</td>
                    <td>नाबालकको नाम</td>
                    <td>
                         <?=$result->nep_first_name.' '.$result->nep_middle_name.' '.$result->nep_last_name ?>
                    </td>
                    <td>
                        <?=$result->eng_first_name.' '.$result->eng_middle_name.' '.$result->eng_last_name ?>
                    </td>
                </tr>
                <tr>
                    <td>२.</td>
                    <td>लिङ्ग</td>
                    <td>
                        <?php if($result->gender=="Male"){echo "पुरुष";}elseif($result->gender=="Female"){ echo "महिला ";}else{ echo "अन्य ";}?>
                    </td>
                    <td>
                        <?=$result->gender?>
                    </td>
                </tr>
                <tr>
                    <td>३.</td>
                    <td>जन्मस्थान</td>
                    <td colspan="2">
                     <?=$j_local_body->name?>, वडा <?=$j_ward->name?>, <?=$j_district->name?>, <?=$j_state->name?>
                    </td>
                </tr>
                <tr>
                    <td>४.</td>
                    <td>बाबुको नाम थर</td>
                    <td>
                        <?=$result->father_name_nep?>
                    </td>
                    <td>
                      <?=$result->father_name_eng?>
                    </td>
                </tr>
                <tr>
                    <td>५.</td>
                    <td>आमाको नाम थर</td>
                    <td>
                        <?=$result->mother_name_nep?>
                    </td>
                    <td>
                      <?=$result->mother_name_eng?>
                    </td>
                </tr>
                <tr>
                    <td>६.</td>
                    <td>संरक्षकको नाम थर</td>
                    <td>
                        <?=$result->gurdians_name_nep?>
                    </td>
                    <td>
                      <?=$result->gurdians_name_eng?>
                    </td>
                </tr>
                <tr>
                    <td>७.</td>
                    <td>संरक्षकको ठेगाना</td>
                    <td colspan="2">
                        <?=$result->gurdians_address?>
                    </td>
                </tr>
                <tr>
                    <td>८.</td>
                    <td>स्थायी बासस्थान</td>
                    <td colspan="2">
                      <?=$p_local_body->name?>-<?=$p_ward->name?>, <?=$p_district->name?>
                    </td>
                </tr>
                <tr>
                    <td>९.</td>
                    <td>जन्म मिति</td>
                    <td colspan="">
                      <?=$result->nep_dob?>
                    </td>
                    <td><?=$result->eng_dob?></td>
                </tr>
            </table>

            <span class="b">१०. निवेदकको औंठा छाप: </span>
            <div class="row mt-3">
                <div class="col-4 text-center">
                    <table class="finger-table table">
                        <tr>
                            <td>
                                दायाँ
                            </td>
                            <td>
                                बायाँ
                            </td>
                        </tr>
                        <tr>
                            <td style="height: 150px;">

                            </td>
                            <td>

                            </td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>

      
    </div>

    <div class="text-center mt-4" style="font-style:italic;margin-left: 330px; margin-top: -200px !important;">
        मैले माथि लेखेको व्यहोरा ठिक साँचो हो । झुठ्ठा ठहरे कानुन बमोजिम
        सहुँला
        बुझाउला भनी सहि गर्ने ।
    </div>

    <div class="space1"></div>
    <div class="row mt-4">
        <div class="col-3 offset-9">
            <div class="b">निवेदक,</div>
            दस्तखत: <br>
            नाम थर: <?=$result->applicant_name?><br>
            नाता सम्बन्ध: <?=$result->relationship?><br>
            मिति: <?= $result->nepali_date?>

        </div>
    </div>
</div>