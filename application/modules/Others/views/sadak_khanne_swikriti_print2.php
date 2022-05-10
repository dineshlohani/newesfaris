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
                <span class="red"> पत्र संख्या: </span> <?= $current_session->name ?><br>
                <span class="red"> चलानी नं.: </span> <?= $chalani_no ?>
            </div>
            <div class="col-3 text-right letter-head-right" style="margin-left: 605px">
                <div class="myclear"> </div>
                <span class="red"> मिति : </span> <?= $chalani_result->nepali_chalani_miti?>
            </div>
          </div>
    <div class="space5"> </div>
    <div class="text-justify pt-5">
       <table class="table-responsive table-borderless">
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
       
    </div>

    <div class="row mt-5">
        <div class="col-6 text-left">
            
                     <div class="b"> निवेदकको साबिकको ठेगाना  </div> 
                    ..........................
               
        </div>
        <div class="col-3 offset-3 signature ">
            <?= $ward_worker->name?><br />
            वडा <?= $worker_post->name?>
        </div>
    </div>
    <div class="space4"></div>
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