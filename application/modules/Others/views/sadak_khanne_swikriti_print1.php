<?php
    $local_body     = Modules::run("Settings/getLocal",$result->local_body);
    $state          = Modules::run("Settings/getState",$result->state);
    $ward           = Modules::run("Settings/getWard",$result->ward);
    $district       = Modules::run("Settings/getDistrict",$result->district);
    $current_session    = Modules::run('Settings/getCurrentSession',$result->session_id);
    $worker_post        = Modules::run('Settings/getPost',$ward_worker->post_id);
?>
<div class="letter_print">
    <hr>
    <div class="row">
        <div class="col-3 letter-head-left">
                    <p style="font-size:18px;"><span class="red"> पत्र संख्या: </span> <?= $current_session->name ?></p>
                    <p style="font-size:18px;"><span class="red"> चलानी नं.:  </span> <?= $chalani_no ?></p>
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
    <div class="text-center font-28" style="margin-top:10px; margin-bottom: 30px;">
        <p style="font-size:26px;"><span style="border-bottom: 1px solid black; margin-bottom: 5px;"> <span class="red"> बिषय : </span> सडक खन्ने स्विकृति।</span>
        </p>
    </div>

    <div class="mt-5">
       <p style="font-size:18px;"> श्री <?= $result->applicant_name?> <br>
        <?= $local_body->name ?> वडा नं <?= $ward->name?> <br>
        ........................................ ।<p style="font-size:26px;">


    </div>

    <div class="text-justify" style="text-indent: 150px;">
       <p style="font-size:18px;">
        <?php if($result->applic==1){
                                        echo  "त्यस कार्यालयको";
                                    }else{
                                        echo "तपाईको"; 
                                    }
                                    ?>
                                    मिति <b><?= $result->nep_applicated_date ?></b>
                                    को 
                                    <?php if($result->applic==1){
                                        echo "पत्र";
                                    }else{
                                        echo "निवेदन";
                                    }?>
                                    अनुसार निम्न
                                    बमोजिम स्थानको <b><?= $result->road_name?></b> सडक खन्ने अनुमति दिइएको
                                    छ ।
                                    लेखिए बमोजिमको शर्तहरु पालना गरि यो
                                    पत्र प्राप्त
                                    भएको मितिले <b><?= $result->completion_time ?></b> दिन भित्र
                                    कार्य
                                    सम्पन्न गर्नुहोला ।</p>
                                </div>

    <div class="mt-3" style="line-height: 2.7; font-style:italic;">
        <p style="font-size:18px;"><span class="font-bold">खन्न स्विकृत प्रदान गरेको सडक:</span> <?= $result->road_name?>
        </p>
        <p style="font-size:18px; margin-top: -20px;"><span class="font-bold">सडक खन्न स्विकृत प्रदान गरेक ईकाइ:</span> <?= $result->road_quantity ?>
        वर्ग मिटर <p>
        <p style="font-size:18px; margin-top: -20px;"><span class="font-bold">सडक खन्न स्विकृत प्रदान धरौटी रकम रु:</span> <?= $result->refundable_amount ?></p>
    </div>
    
    <div class="space5"></div>
    <div class="text-justify">
        <div class="mt-5">
            <p style="font-size:18px; margin-top: -140px;"><span class="font-bold" style="text-decoration: underline;">शर्तहरु:</span></p>
        </div>
        <table class="table-responsive table-borderless">
            <tr>
               <td> १. </td>
               <td> सडक खन्नु अघि खन्ने ठाउको चारैतिर कमसेकम १०० मिटर टाडाबाट देखिने
                गरि १ मिटर अग्लो काठको बार लगाउनु पर्दछ र बारको चारैतिर रातो झन्डा राखी सवारी आवागमनमा बाधा नपर्ने व्यवस्था मिलाउनु पर्नेछ ।</td>
           </tr>
           <tr>
               <td> २. </td>
               <td> सडक खनेर निस्केको माटो, ढुंगा, बालुवा, आदि बाट सवारीको
            आवागमनमा
            बाधा
            नपर्ने व्यवस्था मिलाउनु पर्नेछ । </td>
           </tr>
           <tr>
               <td> ३. </td>
               <td>  काम समाप्त भएपछि पुरानै अवस्थामा हुने गरी मर्मत गर्नु पर्दछ । </td>
           </tr>
           <tr>
               <td> ४. </td>
               <td> पाइप बिच्छाउनु पर्ने अवस्थामा सडक भन्दा कम्तिमा १ फिट ६ इन्च तलबाट पाइप बिच्छाउनु पर्नेछ। </td>
           </tr>
           <tr>
               <td> ५. </td>
               <td>महत्वपूर्ण सडक खन्ने स्वीकृतीका हकमा सडक खन्न थालेको दिनमा
            काम
            समाप्त
            गर्नु पर्नेछ। कुनै कारणवश सोही
            दिनमा सम्पन्न गर्न नसकी रातभरी यथावत राख्नुपर्ने भएमा सम्बन्धित
            कार्यालय/व्यक्तिले यस कार्यालय संग
            सम्पर्क
            राखी ब्लिकिंग लाइट वाली राख्नु पर्नेछ । </td>
           </tr>
           <tr>
               <td> ६. </td>
               <td> सडक खन्दा सडक भित्र भूमिगत अवस्थामा रहेको खानेपानी, बिधुत, टेलिफोन आदिसंग सम्बन्धित लाइनहरु टुटफुट हुन गएमा सोको मर्मत गर्ने जिम्मेवारी पनि स्विकृती लिन खनेका व्यक्ति / संस्थाको नै हुनेछ।</td>
           </tr>
           <tr>
               <td> ७. </td>
               <td> पिच सडक खन्ने काम रातको १० बजेदेखि बिहान ५ बजे सक्नु पर्नेछ। </td>
           </tr>
           <tr>
               <td> ८. </td>
               <td> उक्त कार्य पानी नपरेको दिन गर्नु पर्नेछ। </td>
           </tr>
           <tr>
               <td> ९. </td>
               <td> पाइप बिच्छाउनु पर्ने अवस्थामा सडक भन्दा कम्तिमा १ फिट ६ इन्च तलबाट पाइप बिच्छाउनु पर्नेछ। </td>
           </tr>
           <tr>
               <td> १०. </td>
               <td>सडक खन्ने ठाउँमा पुन: निर्माण गरी पुर्ववत अवस्थामा पुर्याउने जिम्मा सम्बन्धित व्यक्ति वा  संस्थाको नै हुने छ। </td>
           </tr>
           <tr>
               <td> ११. </td>
               <td> तोकिए बमोजिम धरौटी रकम सम्बन्धमा प्राबिधिक प्रतिबेदन प्राप्त
            भए
            पश्चात फिर्ता गरिने
            छ। </td>
           </tr>
           <tr>
               <td> १२. </td>
               <td>  कार्य प्रयोजन समाप्त भएको मितिले ठिक एक वर्ष पछि धरौटी रकम
            फिर्ता
            हुने छैन।</td>
           </tr>
       </table>
       <!--  <div class="mt-3">
           <p style="font-size:18px;"> १. सडक खन्नु अघि खन्ने ठाउको चारैतिर कमसेकम १०० मिटर टाडाबाट
            देखिने
            गरि
            १ मिटर अग्लो काठको बार लगाउनु
            पर्दछ
            र बारको चारैतिर रातो झन्डा राखी सवारी आवागमनमा बाधा नपर्ने
            व्यवस्था
            मिलाउनु पर्नेछ । </p>
        </div>
        <div class="mt-3">
           <p style="font-size:18px;"> २. सडक खनेर निस्केको माटो, ढुंगा, बालुवा, आदि बाट सवारीको
            आवागमनमा
            बाधा
            नपर्ने व्यवस्था मिलाउनु पर्नेछ ।</p>
        </div>
        <div class="mt-3">
           <p style="font-size:18px;"> ३. काम समाप्त भएपछि पुरानै अवस्थामा हुने गरी मर्मत गर्नु पर्दछ ।</p>
        </div>
        <div class="mt-3">
           <p style="font-size:18px;"> ४. सम्बन्धित कार्यालयसंग सम्पर्क राखी लाइन पाएपछि मात्र काम सुरु
            गर्नु
            पर्दछ ।</p>
        </div>
        <div class="mt-3">
           <p style="font-size:18px;"> ५. महत्वपूर्ण सडक खन्ने स्वीकृतीका हकमा सडक खन्न थालेको दिनमा
            काम
            समाप्त
            गर्नु पर्नेछ। कुनै कारणवश सोही
            दिनमा सम्पन्न गर्न नसकी रातभरी यथावत राख्नुपर्ने भएमा सम्बन्धित
            कार्यालय/व्यक्तिले यस कार्यालय संग
            सम्पर्क
            राखी ब्लिकिंग लाइट वाली राख्नु पर्नेछ । </p>
        </div> -->
    </div>

    <div class="row mt-5">
        <div class="col-6 text-left">
            
                     <div class="b"> निवेदकको साबिकको ठेगाना  </div> 
                    <strong><?=$result->old_place?></strong>
               
        </div>
        <div class="col-3 offset-3 signature " style="margin-top: 10px;">
            <?= $ward_worker->name?><br />
            <?= $worker_post->name?>
        </div>
    </div>
    <div class="mt-5">
        <span class="font-bold">बोधार्थ:</span>
        <div class=" ml-5">
            <span class="font-bold">१. &nbsp; श्री प्राविधिक शाखा :</span>
            <br>
            माथि उल्लेखित शर्तहरु पालना भए नभएको अनुगमन गरि प्रतिबेदन पेस
            गर्नु
            हुन
            । <br>
            <span class="font-bold">१. &nbsp;श्री ट्राफिक प्रहरी कार्यालय : </span>
            <br>
            सवारी साधनको आवागमनमा सहजातको लागि अनुरोध छ ।
        </div>
    </div>
</div>