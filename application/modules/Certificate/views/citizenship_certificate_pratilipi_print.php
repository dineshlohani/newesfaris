<?php
    $b_local_body     = Modules::run("Settings/getLocal",$result->b_local_body);
    $b_ward           = Modules::run("Settings/getWard",$result->b_ward);
    $b_state          = Modules::run("Settings/getState",$result->b_state);
    $b_district       = Modules::run("Settings/getDistrict",$result->b_district);

    $p_local_body     = Modules::run("Settings/getLocal",$result->p_local_body);
    $p_ward           = Modules::run("Settings/getWard",$result->p_ward);
    $p_state          = Modules::run("Settings/getState",$result->p_state);
    $p_district     = Modules::run("Settings/getDistrict",$result->p_district);

    $f_local_body     = Modules::run("Settings/getLocal",$result->f_local_body);
    $f_ward           = Modules::run("Settings/getWard",$result->f_ward);
    $f_state          = Modules::run("Settings/getState",$result->f_state);
    $f_district       = Modules::run("Settings/getDistrict",$result->f_district);

    $m_local_body     = Modules::run("Settings/getLocal",$result->m_local_body);
    $m_ward           = Modules::run("Settings/getWard",$result->m_ward);
    $m_state          = Modules::run("Settings/getState",$result->m_state);
    $m_district       = Modules::run("Settings/getDistrict",$result->m_district);

    $hw_local_body     = Modules::run("Settings/getLocal",$result->hw_local_body);
    $hw_ward           = Modules::run("Settings/getWard",$result->hw_ward);
    $hw_state          = Modules::run("Settings/getState",$result->hw_state);
    $hw_district       = Modules::run("Settings/getDistrict",$result->hw_district);

    $s_local_body     = Modules::run("Settings/getLocal",$result->s_local_body);
    $s_ward           = Modules::run("Settings/getWard",$result->s_ward);
    $s_state          = Modules::run("Settings/getState",$result->s_state);
    $s_district       = Modules::run("Settings/getDistrict",$result->s_district);
   $birthdate_nep = explode("-",$result->nep_dob);
   $birthdate_eng = explode("-",$result->eng_dob);
   //print_r($birthdate_eng);
   $from = new DateTime($result->eng_dob);
   $worker_post        = Modules::run('Settings/getPost',$ward_worker->post_id);
    $to   = new DateTime();
    $age= $to->diff($from)->y;
    if(!empty($result->documents))
    {
        $documents      = explode("+",$result->documents);
    }
    $path           = base_url()."assets/documents/certificate/citcertificate_pratilipi/";
    $current_session    = Modules::run('Settings/getCurrentSession',$result->session_id);
    switch($result->gender)
    {
      case 'Male' :
        $gender = 'पुरुष';
        break;
      case 'Female':
        $gender = 'महिला';
        break;
      case 'Other':
        $gender = 'अन्य';
        break;
    }
?>
<div class="letter letter_print">
    <div>
        <p> श्रीमान प्रमुख जिल्ला अधिकारी ज्यू, <br>
            जिल्ला प्रशासन कार्यालय <br>
            <span class="font-normal">
            <?=SITE_SUB_ADD?>, <?=SITE_DISTRICT?><br>
            <?=SITE_STATE?>, नेपाल ।
            </span>
        </p>
    </div>
    <div class="text-center">
        <h5>
            <span style="border-bottom: 2px solid black;"> विषय : नेपाली नागरिकताको प्रमाणपत्रको प्रतिलिपि पाँऊ।</span>
        </h5>
    </div>
    <div style="">
        महोदय,
        <br>
        <div class="text-justify" style="text-indent: 50px; font-size:16px;">
            मैले मेजिष्टेट अफिस <span class="font-normal">........................../............................</span>
            अञ्चलाधीशको कार्यालय <span class="font-normal">/...............................</span>
            गोश्वारा कार्यालय र
            यसै कार्यालयबाट दैहायको विवरण भएको नेपाली नागरिकता प्रमाणपत्र लिएकोमा सो
            प्रमाणपत्रको
            सक्कल <?=$result->citizenship_type_1?> हुँदा सोको प्रतिलिपि पाउनका लागि सो नागरिकता
            प्रमाणपत्रको
            <?php if($result->citizenship_type_1==1){
                echo "नक्कल";
            }else{
                echo "सक्कल";
            }?>
            प्रति संलग्न राखि रु १० (दश) को टिकट टाँसी सिफारिस सहित यो निवेदन पेश गरेको छु ।
        </div>
    </div>
    <h5 class="text-center mt-3"> <span class="border-b">  मैले नागरिकताको प्रमाण-पत्र लिदाको विवरण यस प्रकार छ । </span></h5>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12" style="border: 2px solid #252525; margin-top: 10px; padding-top: 20px; padding-bottom: 20px; border-radius:15px; font-size: 16px;">
                <table class="table-borderless" style="margin: 1px; padding:15px;">
                    <tbody>
                        <tr>
                            <td>१.</td>
                            <td>ना.प्रा.प. नं : <?=$result->citizenship_no?>
                                <span class="mx-5">मिति : <?=$result->citizenship_reg_date?></span>
                                किसिम : <span class=""><?php if($result->citizenship_type==1){ ?>वंसज<?php } ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>२.</td>
                            <td>नाम, थर :<?=$result->nep_first_name." ".$result->nep_middle_name." ".$result->nep_last_name?>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="">Full Name (In block) :-
                                <span class="text-uppercase"><?=$result->eng_first_name." ".$result->eng_middle_name." ".$result->eng_last_name?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>३.</td>
                            <td>लिंग :- <?= $gender?> <span class="font-normal"> Sex:- <?=$result->gender?></span></td>
                        </tr>
                        <tr>
                                <td>४.</td>
                                <td>
                                    <?php if(!empty($result->country_name)){?>
                                                    जन्मस्थान
                                                    : <?php echo $result->country_name;?>, <?php echo $result->country_address;?>
                                                    <?php }else{?>
                                                    जन्मस्थान
                                                    :
                                                    वडा नं: <?=$b_ward->name.' '.$b_local_body->name.' '.$b_district->name?>
                                    <?php }?>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="font-normal font-16">
                                <?php if(!empty($result->country_name)){?>
                                                    Place of Birth (In block ) : 
                                                    <span class="text-uppercase"><?php echo $result->country_name_eng;?>, <?php echo $result->country_address_eng;?></span>
                                                    <?php }else{?>
                                                    Place of Birth (In block ) : District: 
                                                    <span class="text-uppercase"> <?= $result->b_eng_district?> : <?= $result->b_eng_local_body?> Ward No.: <?=$result->b_eng_ward?></span>
                                <?php }?>
                            </td>
                        </tr>
                        <tr>
                            <td>५.</td>
                            <td>स्थायी वास्स्थान : जिल्ला :<?=$p_district->name?>
                                <span class="">गा.पा/ न.पा :<?=$p_local_body->name?></span> वडा
                                नं.
                                : <?=$b_ward->name?>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="font-16 numbers">
                                Permanent address -:
                                District: <?= $result->p_eng_district?>
                                <span class="mx-5">Rural/ Mun. : <?= $result->p_eng_local_body?> </span>Ward
                                No.: <?= $result->p_eng_ward?>
                            </td>
                        </tr>
                        <tr>
                            <td>६.</td>
                            <td>
                                जन्म मिति : <?=$birthdate_nep[0]?> साल
                                <?=$birthdate_nep[1]?>
                                महिना <?=$birthdate_nep[2]?> गते <span class="numbers" style="margin-left: 60px">
                                    Date of Birth (AD) : 
                                    <?=$birthdate_eng[0]?> Year <?=$birthdate_eng[1]?> Month <?=$birthdate_eng[2]?> Day
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>७.</td>
                            <td>
                                बाबुको नामथर, वतन
                                :<?=$result->father_name?>, <?=$f_local_body->name?> वडा नं. <?=$f_ward->name.' '.$f_district->name?>
                                <span class="ml-4">नागरिकता नं :
                                    <?=$result->f_citizenship_no?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>८.</td>
                            <td>
                                आमाको नामथर, वतन : <?php echo $result->mother_name?>, <?=$m_local_body->name?> वडा नं. <?=$m_ward->name.' '.$m_district->name?>
                                <span class="ml-4">नागरिकता नं :
                                    <?=$result->m_citizenship_no?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>९.</td>
                            <td>
                                पतिको नामथर, वतन
                                : <?=$result->husband_wife_name?>
                                <span class="ml-4">नागरिकता नं:

                                    <?=$result->hw_citizenship_no?>
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="mb-4 text-justify" style="text-indent: 70px; margin-top:5px; font-size: 16px;">
        माथि लेखिएको विवरण मैले <span class="font-normal">जिल्ला प्रशासन</span>
        कार्यालयबाट लिएको नं. <span class="font-normal"><b><?=$result->citizenship_no?></b></span> को
        ना.प्र.प.को
        व्यहोरासंग दुरुस्त छ ।
        फरक छैन । लेखिएको व्यहोरा झुठ्ठा ठहरेमा कानुन बमोजिम सहुँला बुझाउँला ।
    </div>
    <div class="myspacer20"></div>
    <div class="row">
        <div class="col-4 text-center">
            <div class="b"> औठाको छाप </div>
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
                    <td style="height: 130px;">
                    </td>
                    <td>
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-4 offset-4" style="font-size: 16px">
            <div class="text-center b"> निवेदकको </div> <br>
            दस्तखत :<br>
            नाम, थर : <?=$result->nep_first_name." ".$result->nep_middle_name." ".$result->nep_last_name?><br>
            मिति : <?php  echo convertedcit($result->nepali_date)?>
        </div>
    </div>
   <div>
        <div style="line-height: 1.4; font-size: 16px" class="text-justify">
           <?=$b_local_body->name." वडा नं ".$b_ward->name?> मा
                        मिति <?=$result->nep_dob?> मा जन्म भई हालसम्म स्थायी रुपमा वसोवास गरी
                        आएका
                        यसमा लेखिएका
                        श्रीमान् <?=$result->father_name?> को 
                        <?php if($result->gender==1){
                            echo "छोरा";
                        }else{
                            echo "छोरी";
                        }?>
                        वर्ष <?=$age?> को श्री <?=$result->nep_first_name." ".$result->nep_middle_name." ".$result->nep_last_name?>
                        लाई म राम्ररी
                        चिन्दछु
                        । निजको माग बमोजिम
                        उपर्युक्त विवरण भएको नं. <?=$result->citizenship_no?>
                        मिति <?=$result->citizenship_reg_date?> को नागरिकता प्रमाणपत्रको
                        प्रतिलिपिको
                        सक्कल प्रति <?=$result->citizenship_type_1?> व्यहोरा
                        साँचो हुदाँ । प्रतिलिपि बनाई दिएमा फरक नपर्ने व्यहोरा सिफारिस गर्दछु । उक्त विवरण
                        झुट्टाठहरे कानुन
                        बमोजिम सहुला बुझौला / बुझाउँला ।
                    </div>
    </div>
    <div class="myspace2"></div>
     <div class="col-md-12" style="font-size: 16px;">
        <div class="row">
            <div class="col-md-4">
               
            <p>मिति :- <?php  echo convertedcit($result->nepali_date)?>
                <br>कार्यालयको नाम :- <b><?=$result->b_eng_ward?> नं. वडा कार्यालय <?=$b_local_body->name?></b></p>
            
        
            </div>
            <div class="col-md-4">
              <div class="py-3 text-center" style="border: 2px solid black; height: 150px; width: 150px;">
                दुवै कान देखिने <br> हालसालै खिचेको <br> २.५ x ३ से.मि. <br>साइजको
                फोटो
            </div>  
            </div>
                <div class="col-md-4">
                                <div class="col-6 offset-8 signature">
                                    <?= $ward_worker->name?><br />
                                    <?= $worker_post->name?>
                                </div>
                </div>
            </div>
        </div>