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

               <p style="font-size:18px;"> <span class="red"> Dispatch No.: </span> <?= $chalani_no ?></p>

    </div>

    <div class="col-3 text-right letter-head-right" style="margin-left: 605px">

                <div class="myclear"> </div>

                <p style="font-size:18px; margin-top: -39px;"><span class="red"> Date : </span> <?= $result_chalani->english_chalani_miti?></p>

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

       <!--  <h4><span style="border-bottom: 1px solid black; margin-bottom: 3px;"> <span class="red"> SUB: </span>NAME VERIFICATION</span>

          <h4><span style="border-bottom: 1px solid black; margin-bottom: 3px;"> TO WHOM IT MAY CONCERN </span>

          </h4> -->
          <p style="font-size: 26px;"><span style="border-bottom: 1px solid black; margin-bottom: 3px;"> <span class="red"> SUB: </span> NAME VERIFICATION </span><br></p>
          <div class="space4"></div>
          <p style="font-size: 26px;"> <span style="border-bottom: 1px solid black; margin-bottom: 3px; margin-top: 30px;"> TO WHOM IT MAY CONCERN </span>

          </p>

      </div>

      <p style="font-size:20px; text-align: justify;">This is to inform and certify to the concern authority regarding the name of applicant (Grand Son of <b><?php echo $result->grand_father_name?></b> and Son of <b><?php echo $result->father_name?>)</b> is different in academic transcripts, character certificates and citizenship. The name of student written as <b><?php echo $result->diff_name?></b> in all academic transcripts and certificates but his name written as <b><?php echo $result->app_name?></b> in cetizenship issued by Government of Nepal.</p>

    <!-- <div class="space3"></div> -->

   <div class="space1"></div>

    <div class="text-justify" style=" font-family: Arial; ">

     <p style="font-size:20px; text-align: justify;">The above mentioned spelling of <b><?php echo $result->app_name?></b> and <b><?php echo $result->diff_name?></b> are same in use.</p>

   </div>



   <div class="text-justify" style=" font-family: Arial; ">

    <p style="font-size:20px; text-align: justify;"> Feel free if you have any inquiry regarding his Name case</p>

   </div>

   <div class="space4"></div>

    <div class="row">

        <div class="col-3 offset-9">

            <div class="signature" style="margin-top: ">
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


