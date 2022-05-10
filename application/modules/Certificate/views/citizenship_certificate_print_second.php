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
$path           = base_url()."assets/documents/certificate/citcertificate/";
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
<div class="font-14 myfontcolor" style="line-height: 2; margin: 5px 10px; margin-top:80px;">
    <div class="font-14 font-bold" style="line-height: 1.8">
        <div style="border-bottom: 2px solid black;" class="pb-2 font-18 black">
            <span class="font-normal"><b><?=$b_local_body->name?></b></span>बाट सर्जमिन र सनाखतको लागि प्रोषित
        </div>
        <div class="text-justify pt-4" style="font-size:110%">
            <span class="font-normal"><b><?=$b_local_body->name?></span> वडा नं <span class="font-normal"> <b><?=convertedcit($result->p_eng_ward)?></b></span>
            बस्ने <span class="font-normal"><b><?=$result->father_name?></b></span> को छोरा / छोरी / पत्नी वर्ष <span class="font-normal"> <b><?=convertedcit(round($age))?></b></span> को श्री / सुश्री / श्रीमती <span class="font-normal"><b><?=$result->nep_first_name." ".$result->nep_middle_name." ".$result->nep_last_name?></b> </span> ले ऐन र नियमले तोकेको प्रमाण पेश गर्न नसकेकाले निजलाई स्थलगत सर्जमिन र सनाखत प्रकृया अबलम्बन गरी बंशजको नाता / जन्मको आधारमा नागरिकता सम्बन्धी निर्माण हुन प्रेषित गरिएको छ।
        </div>
        <div class="container-fluid" style="font-size:110%">
            <div class="row">
                <div class="col-6 mt-3">
                    <div style="margin-left: -15px!important;">
                        मिति <span class="font-normal"></span><br>
                        कार्यालयको नाम र छाप<span class="font-normal">..............................</span> <br>
                        <span class="font-normal">.................................................</span>
                    </div>
                </div>
                <div class="col-6 mt-3">
                    <div style="margin-left: 100px;">
                        दस्तखत <span class="font-normal">.........................................</span> <br>
                        नाम, थर <span class="font-normal">........................................</span> <br>
                        पद <span class="font-normal">...............................................</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-12 text-center" style="margin-top:25px;">
                    <h2 class="font-18 black">कार्यालयले भर्ने</h2>
                </div>
                <div class="col-6 mb-3" style="border: 2px solid black; border-right: none; font-size:110%;">
                    <div class="text-justify">
                        निवेदक / निबेदिका <span class="font-normal"><b><?=$result->nep_first_name." ".$result->nep_middle_name." ".$result->nep_last_name?></b></span> मेरो आफ्नो
                        <span class="font-normal">छोरा / छोरी </span> नाताका हुन् । निजलाई बंशजको नाताले / जन्मको आधारले नेपाली नागरिकताको प्रमाण पत्र दिएमा पछि सम्म फरक पर्नेछैन। फरक परेमा कानुन बमोजिम सहुँला बुझाउँला भनी कार्यालयमा उपस्थित भई सनाखत सहिछाप गर्नेको
                    </div>
                    नाम : <span class="font-normal"><b><?=$result->father_name?></b></span><br>
                    ना.प्र.प.नं <span class="font-normal">.....................................................</span><br>
                    सहिछाप <span class="font-normal">.......................................................</span><br>
                    मिति <span class="font-normal"></span><br>
                </div>
                <div class="col-6 mb-3" style="border: 2px solid; font-size:110%;">
                    <div class="text-justify">
                        माथिको विवरण बमोजिम मेरो रोहवरमा सनाखत सहिछाप भएको ठिक
                        साँचो
                        हो।
                        माथिको विवरण ठिक दुरुस्त छ फरक
                        छैन। फरक परेमा कानून बमोजिम सहन बुझाउन मञ्जुर छु भनी
                        सहिछाप
                        गर्ने निवेदकको
                    </div>
                    <br>
                    <br>
                    नाम : <span class="font-normal"><b><?=$result->nep_first_name." ".$result->nep_middle_name." ".$result->nep_last_name?></b></span><br>
                    सहिछाप <span class="font-normal">.......................................................</span><br>
                    मिति <span class="font-normal"></span><br>
                </div>
            </div>
        </div>
        <div class="container-fluid mb-3" style="margin-top:25px;">
            <div class="row">
                <div class="col-6 mt-2 py-2" style="border: 2px solid black; line-height: 1.5; font-size:110%">
                    <div class="text-center">
                        <h2 class="font-18 black">
                            <u> सर्जमिनमा बस्नेको नाम, थर , ठेगाना </u>
                        </h2>
                    </div>
                    १. <br> २. <br> ३. <br> ४. <br> ५.
                </div>

                <div class="col-6 mt-2 py-2" style="border: 2px solid black; line-height: 1.5; font-size:110%">
                    <div class="text-center">
                        <h2 class="font-18 black">
                            <u> सनाखत गर्ने व्यक्तिको नाम, थर , ठेगाना </u>
                        </h2>
                    </div>
                    १. <br> २. <br> ३.
                </div>
            </div>
        </div>
        <div style="line-height: 1.5; margin-top:25px; font-size:110%">
            <div class="text-center mt-5">
                <h2 class="font-18 black"> निर्णय </h2>
            </div>
            <div class="text-justify" style="text-indent: 70px; font-size:110%">
                यो आनुसुचिमा भएको सिफारिस, निवेदक / निवेदिका <span class="font-normal">.................................................</span>
                को सनाखत सहिछाप र संलग्न निम्न प्रमाणहरुका आधारमा निवेदकलाई
                बंशजको
                नाताले / जन्मको आधारले नेपाली
                नागरिकताको प्रमाण-पत्र दिन उपयुक्त हुने देखि निर्णयार्थ पेश
                गरेको
                छु।
            </div>
        </div>
        <div style="line-height: 1.5; ">
            <div class="text-center mt-3" style="font-size:110%">
                <h2 class="font-18 black">संलग्न प्रमाणहरु </h2>
            </div>
            <div class="container-fluid" style="margin-left: -15px;">
                <div class="row">
                    <div class="col-6">
                        १. <br> ३. <br> ५.
                    </div>
                    <div class="col-6">
                        २. <br> ४. <br> ६.
                    </div>
                    <div class="col-12 mt-3" style="font-size:110%">
                        <span>वितरित ना.प्र.प.नं.</span>
                        <span style="margin-left: 250px;"> सनाखत गराउने </span>
                        <span style="margin-left: 130px;"> पेश गर्ने </span>
                        <span style="margin-left: 150px;"> सदर गर्ने </span>
                    </div>
                    <div class="col-md-12 mt-5" style="font-size:110%">
                        मिति <span class="font-normal"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
