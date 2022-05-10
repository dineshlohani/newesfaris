<style type="text/css">

body {

  font-family: Arial;

}

.numbers {

  font-family: Tahoma;

  

}

</style>



<?php

    $gender = ($result->gender == 1) ? 'MR' : 'MRS';

?>

<br /><br />

<div class="letter_print">

    <hr>

    <div class="row">

    <div class="col-3 letter-head-left">

                <p style="font-size:18px;"><span class="red"> F/Y: </span> <?= $current_session->name ?><br></p>

                <p style="font-size:18px;"><span class="red"> Dispatch No.: </span> <?= $chalani_no ?></p>

    </div>

    <div class="col-3 text-right letter-head-right" style="margin-left: 605px">

                <div class="myclear"> </div>

               <p style="font-size:18px; margin-top: -39px;"> <span class="red"> Date : </span> <?= $result_chalani->english_chalani_miti?></p>

    </div>

    </div>

    <div class="col-md-4" style="margin-top:50px;">

        <div class='row'>

            <?= !empty($this_office->sambodhan) ? $this_office->sambodhan."," : ''?>

        </div>

        <div class="row">

            <?= $this_office->name?>,

        </div>

        <div class="row">

            <?= !empty($this_office->address) ? $this_office->address."," : ''?>

        </div>



    </div>

   <!--  <div class="text-center my-4 py-2 mt-5">

        <h4>विषय: घरबाटो प्रमाणित ।</h4>

    </div> -->

    <div class="text-center mt-2 mb-5">

       <!--  <h4><span style="border-bottom: 1px solid black; margin-bottom: 3px;"> <span class="red"> SUB: </span>Married Verification</span>

          <h4><span style="border-bottom: 1px solid black; margin-bottom: 3px;"> TO WHOM IT MAY CONCERN </span>

          </h4> -->
           <p style="font-size: 26px;"><span style="border-bottom: 1px solid black; margin-bottom: 3px;"> <span class="red"> SUB: </span>MARRIED VERIFICATION</span><br></p>
                              <div class="space4"></div>
                             <p style="font-size: 26px;"> <span style="border-bottom: 1px solid black; margin-bottom: 3px; margin-top: 30px;"> TO WHOM IT MAY CONCERN </span>

                            </p>

      </div>

       <p style="font-size:20px; text-align: justify;">This is to certified that  <b><?php echo 'Mr'?> <?php echo $result->app_name?></b> and Son of <b>Mr. <?php echo $result->father_name?></b> and <b> MRs. <?php echo $result->mother_name?></b> pan inhabitance of  <?php echo $per_gapa->english_name?> ward no.<?php echo $result->per_ward?>,<?php echo $per_district->english_name?>, <?php echo $per_state->english_name?>,Nepal and Mrs. <?php echo $result->wife_name?> daughter of Mr. <?php echo $result->wife_father_name?> and Mrs. <?php echo $result->wife_mother_name?> an inhabitance of <?php echo $wife_gapa->english_name?> ward no <?php echo $result->wife_ward?>, <?php echo $wife_district->english_name?>, <?php echo $wife_state->english_name?> got married on <?php echo $result->married_date_bs?>(BS)/ <?php echo $result->married_date_ad?>(AD) according to our office record.</p>

    <!-- <div class="space3"></div> -->

   <div class="space4"></div>

    <div class="row">

        <div class="col-3 offset-9">

            <div class="signature">

                <?php 

                echo $worker_id->english_name?>

                <br><?php echo $post->designation?>
<!-- 
                <?php //echo $ward_worker->english_name?>

                <br>Chairman -->

            </div>

        </div>

    </div>
  
</div>



