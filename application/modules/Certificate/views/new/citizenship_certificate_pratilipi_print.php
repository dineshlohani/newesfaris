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
   $from = new DateTime($result->eng_dob);
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
<!--<div class="font-18 text-black " style="line-height: 2; font-size: 12px; font-weight: normal; font-family: sans-serif !important; margin: 5px 10px;">-->

<!--<div class="card-body">-->
<div class="letter letter_print">
    <div>

        <p> श्री प्रमुख जिल्ला अधिकारी ज्यु, <br>
            जिल्ला प्रशासन कार्यालय <br>
            <span class="font-normal">
                ..................................
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
        <div class="text-justify" style="text-indent: 50px;">
            मैले मेजिष्टेट अफिस <span class="font-normal">........................../............................</span>
            अञ्चलाधीशको कार्यालय <span class="font-normal">/...............................</span>
            गोश्वारा कार्यालय र
            यसै कार्यालयबाट दैहायको विवरण भएको नेपाली नागरिकता प्रमाणपत्र लिएकोमा सो
            प्रमाणपत्रको
            सक्कल झुत्रो भएको
            हराएको नयाँ ढाँचाको आवश्यक भएको हुँदा सोको प्रतिलिपि पाउनका लागि सो नागरिकता
            प्रमाणपत्रको सक्कल नक्कल
            प्रति संलग्न राखि रु १० (दश) को टिकट टाँसी सिफारिस सहित यो निवेदन पेश गरेको छु ।
        </div>
    </div>
    <h5 class="text-center mt-3"> <span class="border-b">  मैले नागरिकताको प्रमाण-पत्र लिदाको विवरण एस प्रकार छ । </span></h5>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12" style="border: 2px solid #252525; margin-top: 10px; padding-top: 20px; padding-bottom: 20px; border-radius:15px;">
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
                                <span class="text-capitalize"><?=$result->eng_first_name." ".$result->eng_middle_name." ".$result->eng_last_name?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>३.</td>
                            <td>लिंग :- <?= $gender?><span class="font-normal">Sex:- <?=$result->gender?></span>
                                ४.
                                जन्मस्थान
                                :
                                वार्ड नं:<?=$b_ward->name.' '.$b_local_body->name.' '.$b_district->name?>

                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="font-normal font-16">
                                Place of Birth (In block ) : District: <?= $result->b_eng_district?> Rural/ Mun. : <?= $result->b_eng_local_body?> Ward No.: <?=$result->b_eng_ward?>
                            </td>
                        </tr>
                        <tr>
                            <td>५.</td>
                            <td>स्थायी वास्स्थान : जिल्ला :<?=$p_district->name?>
                                <span class="">गा.पा/ न.पा :<?=$p_local_body->name?></span>वडा
                                नं.
                                : <?=$b_ward->name?>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="font-normal font-16">Permanent address :
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
                                महिना <?=$birthdate_nep[2]?> गते/ <span class="">
                                    Date of Birth (AD) : <?=$birthdate_eng[0]?> year <?=$birthdate_eng[1]?> Month <?=$birthdate_eng[2]?> Day
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>७.</td>
                            <td>
                                बाबुको नामथर, वतन
                                :<?=$result->father_name?> , वार्ड-<?=$f_ward->name.' '.$f_local_body->name.' '.$f_district->name?>
                                <span class="ml-4">नागरिकता नं :

                                    <?=$result->f_citizenship_no?>

                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>८.</td>
                            <td>
                                आमाको नामथर, वतन : <?php echo $result->mother_name?>, वार्ड-<?=$m_ward->name.' '.$m_local_body->name.' '.$m_district->name?>
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

    <div class="mb-4 text-justify" style="text-indent: 70px; margin-top:5px;">
        माथि लेखिएको विवरण मैले <span class="font-normal">............................................</span>
        कार्यालयबाट लिएको नं. <span class="font-normal">....................</span> को
        ना.प्र.प.को
        व्यहोरासंग दुरुस्त छ ।
        फरक छैन । लेखिएको व्यहोरा झुठ्ठा ठहरेमा कानुन बमोजिम सहुँला बुझाउँला ।
    </div>

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
        <div class="col-4 offset-4">
            <div class="text-center b"> निवेदकको </div> <br>
            दस्तखत :<br>
            नाम, थर :<br>
            मिति :

        </div>
    </div>

    <div>
        <!--
        <div class="text-center" style="padding-top:50px;">
            <h5 class="">
                <span style="border-bottom: 2px solid black;">
                    ( प्रतिलिपि ना.प्र.य.का लागि सिफारिस )
                </span>
            </h5>
        </div>
-->

        <div style="line-height: 1.4" class="text-justify">
            <?=$b_local_body->name." वडा नं ".$b_ward->name?> मा
            मिति <?=$result->nep_dob?> मा जन्म भई हालसम्म स्थायी रुपमा वसोवास गरी
            आएका
            यसमा लेखिएका
            श्रीमान् <?=$result->father_name?> को छोरा वर्ष <?=$age?> को श्री <?=$result->nep_first_name." ".$result->nep_middle_name." ".$result->nep_last_name?>
            लाई म राम्ररी
            चिन्दछु
            । निजको माग बमोजिम
            उपर्युक्त विवरण भएको नं. <?=$result->citizenship_no?>
            मिति <?=$result->citizenship_reg_date?> को नागरिकता प्रमाणपत्रको
            प्रतिलिपिको
            सक्कल प्रति झुत्रो भएको
            हराएको / नयाँ ढाँचाको आवश्यक भएको व्यहोरा
            साँचो हुदाँ । प्रतिलिपि बनाई दिएमा फरक नपर्ने व्यहोरा सिफारिस गर्दछु । उक्त विवरण
            झुट्टाठहरे कानुन
            बमोजिम सहुला बुझौला / बुझाउँला ।
        </div>
    </div>

    <div class="row" style="margin-top: 10px;line-height: 2">
        <div class="col-4">
            <p>मिति :-<br>कार्यालयको नाम :-</p>
            <div class="py-3 text-center" style="border: 2px solid black; margin-top:-10px; height: 150px; width: 150px;">
                दुवै कान देखिने <br> हालसालै खिचेको <br> २.५ x ३ से.मि. <br>साइजको
                फोटो
            </div>
        </div>
        <div class="col-4 offset-4">
            <div class="text-center b mt-5">सिफारिस गर्नेको </div>
            <p class="mt-2">दस्तखत : <span class="font-normal">.........................................</span>
            </p>
            <p>नाम, थर :
                <span class="font-normal">.........................................</span>
            </p>
            <p>पद : <span class="font-normal">................................................</span>
            </p>
        </div>
        
    </div>


</div>


<!--</div>-->
