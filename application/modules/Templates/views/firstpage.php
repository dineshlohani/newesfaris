<div class="font-14 myfontcolor" style="line-height: 2; font-size: 12px; font-weight: normal; font-family: sans-serif !important; margin: 5px 10px;">
    <!--<div class="card-body">-->
        <div class="font-14 font-bold myfontcolor" style="line-height: 1.5; font-weight: normal; margin-top:50px;">
            <div class="text-center mb-3">
                अनुसुची-७<br> (नियम ५ को उपनियम (१) र (३) नियम ७ को उपनियम (१),(२) र (५) सँग सम्बन्धित)
            </div>
            <div class="container-fluid" style="margin-left: 245px; font-weight: normal;">
                <div class="row">
                    <div class="col-9">
                        <div style="padding-top: 60px">
                            श्री प्रमुख जिल्लअधिकारी ज्यु, <br> जिल्ला प्रशासन कार्यालय <br> 
                           <?=SITE_DISTRICT;?> <br>
                           <?=SITE_STATE;?>, नेपाल ।
                        </div>
                    </div>
                    <div class="col-3 text-center font-14">
                        <div class="py-5" style="border: 2px solid #555; margin-left:-35px; height: 160px; width: 145px;">
                            निवेदकको दुवै कान <br> देखिने पासपोर्ट <br> साइजको फोटो
                        </div>
                    </div>
                </div>
            </div><br><br>


            <div class="text-center mb-2" style="margin-top: -35px;">
                <h2 class="font-18 black">
                    विषय : नेपाली नागरिकताको प्रमाणपत्र पाउँ ।
                </h2>
            </div>
            <div style="margin-top: 0;">
            <div style="margin-left: 250px;">
                महोदय, <br>
                <div class="text-justify" style="text-indent: 50px; font-weight: normal;">
                    मैले नेपाल नागरिकता ऐन २०६३ को दफा ५ बमोजिमको शर्ता साथ पुरा गरिसकेकोले / नेपालि नागरिकको छोरा, छोरि/ नेपालि नागरिकसँग वैवाहिक सम्बन्ध भएको बिदेशी महिलाको 
                    हैसियतले नेपालको अंगिकृत नागरिकताको प्रमाणपत्र पाउनको लागि देहायको बिबरण खोलि सिफारिस साथ रु ५ को टिकट टाँसी यो निवेदन पत्र पेश गरेको छु । 
                </div><br><br>
            </div>
            <div style="margin-left: 250px;">
            <div><h6>१.मेरो बिबरण :-</h6></div>
            <div class="container-fluid mb-3 mt-3">
                
                                                
                                                    <div style="padding: 2px !important;">
                                                   
                                                    <strong> (क)   पुरा नाम, थर :-</strong> <?=$result->nep_first_name." ".$result->nep_middle_name." ".$result->nep_last_name?>
                                                    <br><strong>Full Name(In Block) :- </strong><span class="text-uppercase"><?=$result->eng_first_name." ".$result->eng_middle_name." ".$result->eng_last_name?></span>
                                                       </div>
                                                
                                            

                                                   <div style="padding: 2px !important;"><strong>(ख) लिङ्ग :-</strong><br>
                                                       
                                                     <strong> Sex:-</strong> <?=$result->gender ?></span><br>
                                                


                                               
                                                    <strong>(ग) जन्मस्थान :-</strong> 
                                                    
                                                    <span class="mx-4">प्रदेश: <?=$b_state->name?></span>
                                                    <span class="">जिल्ला: <?=$b_district->name?>,</span> <span
                                                    class="">गा.पा./न.पा.: <?=$b_local_body->name?>,</span>
                                                    <span class="">वडा नं:<?= convertedcit($result->p_eng_ward)?>, </span>टोल: <?php  echo  $result->nep_bp_tole;?>,
                                                    <br>
                                                    <strong>Place Of Birth(In Block) :-</strong>
                                                    <span class="mx-4"><?= $result->b_eng_state?>Province,</span>
                                                    <span class=""><?= $result->b_eng_district?> District,</span>
                                                    <span class=""><?= $result->b_eng_local_body?></span>
                                                    <span class="">Ward: <?= $result->bp_eng_ward?></span>
                                                    Tole: <?php  echo $result->eng_bp_tole; ?><br>
                                                

                                           
                                                    <class style="padding: 2px !important;">
                                                    <strong class="mr-4">(घ) जन्म मिति (वि.सं.)
                                                        :-</strong> <?=convertedcit($birthdate_nep[0])?>
                                                        <span class="mr-4 font-bold">साल</span> <?=convertedcit($birthdate_nep[1])?>
                                                        <span class="mr-4 font-bold">महिना</span> <?=convertedcit($birthdate_nep[2])?>
                                                        <span class="mr-4 font-bold">गते</span>
                                                        <br>
                                                        <strong class="mr-4">Date Of Birth (A.D) :- <?=$birthdate_eng[0]?> 
                                                    </strong><A.Dbirthdate_eng[0]?>
                                                        <span class="mr-4 font-bold">Year</span> <?=$birthdate_eng[1]?> <span class="mr-4 font-bold">Month</span> <?=$birthdate_eng[2]?> <span class="mr-4 font-bold">Day</span><br>
                                                    
                                                
                                                        </div>
                                                    </div>
                                                     <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="well">
                                                    <class style="padding: 2px !important;">
                                                   <strong>(ङ)बुबाको:-</strong><br>
                                                        <strong> &nbsp&nbsp &nbsp&nbsp (क) नाम, थर :- </strong> <?=$result->father_name?><br>
                                                        <strong>&nbsp&nbsp &nbsp&nbsp (ख)ठेगाना :-</strong>
                                                        <span class="mx-4">प्रदेश: <?=$f_state->name?></span>
                                                        <span class="mx-4">जिल्ला: <?=$f_district->name?></span>
                                                        <span class="mx-4">गा.पा./न.पा.: <?=$f_local_body->name?></span>
                                                        <span class="mx-4">वार्ड नं: <?=$f_ward->name?></span> टोल: <?=$result->f_tole?><br>
                                                        <strong>&nbsp&nbsp &nbsp&nbsp (ग)नागरिकता :- <?=convertedcit($result->f_citizenship_no)?>
                                                    </strong>

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="well">
                                                    <strong>आमाको:-</strong><br>
                                                    <strong> &nbsp&nbsp &nbsp&nbsp  नाम, थर :- </strong> <?php echo $result->mother_name?><br>
                                                    <strong>&nbsp&nbsp &nbsp&nbsp ठेगाना :-</strong>
                                                    <span class="mx-4">प्रदेश: <?=$m_state->name?></span>
                                                    <span class="mx-4">जिल्ला: <?=$m_district->name?></span>
                                                    <span class="mx-4">गा.पा./न.पा.: <?=$m_local_body->name?></span>
                                                    <span class="mx-4">वार्ड नं: <?=$m_ward->name?></span> टोल:<?=$result->m_tole?> <br>
                                                    <strong>&nbsp&nbsp &nbsp&nbsp नागरिकता :- <?=convertedcit($result->m_citizenship_no)?></strong>
                                                </div>
                                                </div>
                                            </div><br>
                                            <classs style="padding: 2px !important;"><strong>(च) पुरा गरेको उमेर :-</strong> <?= $age1 ?>
                                            <span class="ml-5 pl-4"> <strong></strong> <?=$result->age1 ?></span><br>
                                           <class style="padding: 2px !important;"><strong>(छ)धर्म :-</strong> <?= $religen ?><span class="ml-5 pl-4"> <strong></strong> <?=$result->$religen ?></span>
                                                <br>
                                           <strong>(ज) पति / पत्नीको:-</strong>
                                           <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="well">
                                                    
                                                   
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                    <div class="well">
                                                    <class style="padding: 2px !important;">
                                                    <strong> (क) नाम, थर :- </strong> <?= $result->husband_wife_name?> <br>
                                                    <strong>(ख) ठेगाना :-</strong>
                                                    <span class="mx-4">प्रदेश: <?=$m_state->name?></span>
                                                    <span class="mx-4">जिल्ला: <?=$m_district->name?></span>
                                                    <span class="mx-4">गा.पा./न.पा.: <?=$m_local_body->name?></span>
                                                    <span class="mx-4">वार्ड नं: <?=$m_ward->name?></span> टोल:<?=$result->m_tole?> <br>
                                                    <strong>(ग) नागरिकता :- <?=convertedcit($result->m_citizenship_no)?></strong>
                                                
                                                </div>
                                             </div>

                                                
                                        </div>
                                            
                                         
                                    </div>
                                </div>
                            

                </div>
            </div>
        </div>
        <div style="margin-left: 250px;">
            <div><h6>२.नेपालमा बसोबास गरेको बर्ष :-</h6><br>
                    <strong>(क) नेपाली नागरिकको छोरा वा छोरीको हकमा :-</strong><br>
                    &nbsp&nbsp १) पिताको राष्ट्रियता:-<br>
                    &nbsp&nbsp २) पिताको मुलुकबाट नागरिकता प्रमाणपत्र लिए नलिएको निस्सा :-<br>
                    <strong>(ख) नेपालि नागरिकसँग वैवाहिक सम्बन्ध भएकी बिदेशी महिलाको हकमा:-</strong><br>
                    &nbsp&nbsp  ( श्री.................................सँग बिबाह भएको मिति)<br>
                    <strong>(ग) अरु बिदेशीको हकमा (कम्तिमा पन्ध्र वर्ष):-</strong>

          
                   </div><br>
        
            <div><h6>3.नेपालमा स्थायी बसोबास गरेको ठाउँ र मिति :-</h6>
                    
                        <strong> (क) </strong> 
                        <span class="mx-4">जिल्ला:........................,<?=$m_district->name?></span>
                    <span class="mx-4">गा.पा./ न.पा/ उ.म.न.पा.: <?=$m_local_body->name?></span><br>
                        <span class="mx-4">&nbsp&nbsp&nbsp&nbsp &nbsp&nbspवार्ड नं:..................................... <?=$m_ward->name?>
                    </span> टोल:..................................<?=$result->m_tole?> <br>
                    <span class=""><?= $result->b_eng_district?>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp District....................................,</span>
                    <?= $result->b_eng_district?> Rural/Municipality/Sub/Metrepols</span><br>
                                                    <span class=""><?= $result->b_eng_local_body?></span>
                                                    <span class="">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspWard No:..............................................., <?= $result->bp_eng_ward?></span>
                                                    Tole:................................... <?php  echo $result->eng_bp_tole; ?><br>
</div>
    </div>


    

    </style>