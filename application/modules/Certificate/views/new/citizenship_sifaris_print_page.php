<?php
    $local_body     = Modules::run("Settings/getLocal",$result->local_body);
    $state          = Modules::run("Settings/getState",$result->state);
    $ward           = Modules::run("Settings/getWard",$result->ward);
    $district       = Modules::run("Settings/getDistrict",$result->district);
    $old_new_address    = Modules::run("Settings/getOldNewAddress",$result->old_new_address);
    $current_session    = Modules::run('Settings/getCurrentSession',$result->session_id);
    $worker_post        = Modules::run('Settings/getPost',$ward_worker->post_id);
    
switch($result->relation)
{
    case 'son':
    $relation = 'छोरा';
    break;
    case 'daughter':
    $relation = 'छोरी';
    break;
    case 'wife':
    $relation = 'श्रीमती';
    break;
}    
?>
<?php $name = $_POST['check'];
// if ($name==null){
//     echo '<script>alert("कागजातहरु छानुहोस !!!")</script>';
//     die;
//     //echo alert ("कागजातहरु छान्नुहोस् !!!!");
// }
?>
<input type="hidden" id="name1" value="<?=$name?>" />
<div class="letter_print">
    <hr>
    <div class="row">
    <div class="col-3 letter-head-left">
               <p style="font-size:16px;"><span class="red"> पत्र संख्या: </span> <?= $current_session->name ?><br></p>
                <p style="font-size:16px;"><span class="red"> चलानी नं.:  </span> <?= $chalani_no ?></p>
            </div>
             <div class="col-3 text-right letter-head-right" style="margin-left: 605px">
                <div class="myclear"> </div>
                 <p style="font-size:16px; margin-top: -39px; margin-right:-151px"><span class="red"> मिति : </span> <?= $chalani_result->nepali_chalani_miti?></p>
            </div>
        </div>
    <div class="col-md-4">
        <?php
            $this_office   = Modules::run('Settings/getOffice', $print_office->id);
        ?>
        <div class='row'>
            <p style="font-size:16px; margin-top: 30px;"><?= !empty($this_office->sambodhan) ? $this_office->sambodhan : ''?></p>
        </div>
        <div class="row">
           <p style="font-size:16px;"> <?= $this_office->name?></p>
        </div>
        <div class="row">
           <p style="font-size:16px;"> <?= !empty($this_office->address) ? $this_office->address : ''?></p>
        </div>
    </div>
    <div class="space3"></div>
    <div class="text-center font-28" style="margin-top:-90px; margin-bottom: 20px;">
        <p style="font-size:16px; margin-top: -39px;">
            <span style="border-bottom: 1px solid black; font-size: 24px" > <span class="red"> बिषय : </span><strong> नागरिकता सिफारिस गरि पठाइएको बारे ।</strong>
            </span>
        </p>
    </div>
    <div class="text-justify">
                                       <p style="font-size:18px; text-align: justify;">
                                        उपरोक्त सम्बन्धमा यस <strong><?= $local_body->name ?></strong> वडा नं <?= $ward->name?> बस्ने श्री <strong><?= $result->name?>को</strong> <?= $relation?>
                                        वर्ष <strong><?= $result->age ?></strong> को 
                                        <?php if($result->gender!= 2)
                                        { 
                                            echo 'निवेदक';
                                        }
                                        else  {
                                           echo 'निवेदिका'; 
                                       };
                                       ?>
                                       <?=$result->gender_spec;?> <?= $result->applicant_name.'ले';?> हालसम्म नेपाल अधिराज्यको कुनै पनि स्थानबाट
                                       नेपाली नागरिकताको प्रमाण-पत्र प्राप्त नगरेकोले नेपाली नागरिकता प्रमाण-पत्र प्राप्त गर्नको लागि सम्बन्धित कार्यालयलाई सिफारिस गरि पाउँ भनि यस
                                       कार्यालयमा निवेदन दिएकाले निजसँग निम्न कागजातहरु बुझी यसैसाथ संलग्न राखी नेपाली नागरिकता
                                       प्रमाण-पत्र उपलब्ध गरि दिन सिफारिस गरि पठाएको व्यहोरा सादर अनुरोध गरिन्छ ।
                                   </div>
                                    <div class="col-md-12">
                                        <div class="row" style="margin-top:-30px;">
                                            <div class="col-md-6">
                                              <div class="text-justify  mt-5"></div>
                                                <p style="font-size:18px; ">
                                                जन्म स्थान : <?=$local_body->name?> वडा नं <?=$ward->name?>, <?php echo $district->name;?></p>
                                                <div class="clearfix"></div>
                                                <p style="font-size:18px;">बाबुको नाम थर : <?php echo $result->name;?></p>
                                                <div class="clearfix"></div>
                                                <p style="font-size:18px; ">
                                                स्थायी ठेगाना : <?=$local_body->name?> वडा नं <?=$ward->name?>, <?php echo $district->name;?></p>
                                                <div class="clearfix"></div>
                                                <p style="font-size:18px; ">जन्ममिति : <?=$result->janmamiti?></p>
                                                <div class="clearfix"></div>
                                                <p style="font-size:18px; ">टोलीबाट बनाएको भए दर्ता मिति :</p>
                                                <div class="clearfix"></div>
                                               <p style="font-size:18px; "> हस्ताक्षर :  </p>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="py-4" style="border:2px solid #555;margin-left:-250px;height:140px;width:140px;margin-top:53px;">
                                                निवेदकको दुवै कान <br> देखिने पासपोर्ट <br> साइजको फोटो
                                            </div>
                                        </div>
                                    </div>
                                <div class="row">
                                    <div class="col-md-4" style="margin-top:-25px">
                                        <div class="text-justify  mt-5" style="margin-right:-136px;">
                                            <h4 class="font-underline"  style="font-size:22px">कागजातहरु</h4>
                                            <div style="font-size: 18px">
                                            <div class="clearfix"></div>
                                            <?php foreach($name as $name){
                                                echo $name."<br />";
                                            }?>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            <div style="margin-left:432px margin-top:-25px;font-size: 22px" class="text-justify  mt-5"><u><b>सनाखत</b></u></div>
                            <p style="font-size: 18px;"> <?php if($result->gender!= 2)
                                        { 
                                            echo 'निवेदक';
                                        }
                                        else  {
                                           echo 'निवेदिका'; 
                                       };
                                       ?> <?=$result->applicant_name;?> मेरो  
                                       <?php if($result->gender!= 2)
                                        { 
                                            echo 'छोरा';
                                        }
                                        else  {
                                           echo 'छोरी'; 
                                       };
                                       ?> नाता हुन् । निजले हालसम्म कहीँ कतैबाट नेपाली नागरिकताको प्रमाण-पत्र लिएको छैन । व्यहोरा झुट्ठा ठहरेमा कानुन बमोजिम सहुँला बुझाउँला भनि सनाखत र सहिछाप गर्नेको</p>
                            <br>
                            <div class="col-md-12" style="margin-top:5px">
                                <div class="row">
                                    <div class="col-md-6" style="font-size: 18px">
                                            <p>नाम: <?=$result->name?></p>
                                            <div>ना.प्र.नं: <?= $result->cit_no_1?> </div>
                                            <div>सही छाप: </div>
                                            <div>मिति:  <?= $chalani_result->nepali_chalani_miti?> </div>  
                                    </div>
                                <div class="col-md-6">
                                    <div class="col-4 offset-1 text-center" style="margin-top: -94px; margin-left: 574px;">
                                        औठाको छाप
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
                                                <td style="height: 80px;">
                                                </td>
                                                <td>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                            
                                <div class="space3"></div>
                                <div style="margin-top: 82px;font-size: 18px;">
                                <div class="col-3 offset-9 signature">
                                    <?= $ward_worker->name?><br />
                                    <?= $worker_post->name?>
                                </div>
                            </div>
</div>
