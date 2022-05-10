<style type="text/css">

body {
 font-family: "Times New Roman", Times, serif;
}

.numbers {

  font-family: Tahoma;

  color: red;

}

</style>
<?php
  $current_session    = Modules::run('Settings/getCurrentSession',$result->session_id);
  $gender = ($result->status == 1) ? 'MR' : 'MRS';
  $son_daughter = ($result->son_daughter == 1)? 'Son' : 'Daughter';
?>

<div class="letter_print">
    <hr>
    <div class="row">
      <div class="col-3 letter-head-left">
        <p style="font-size:18px;"><span class="red"> F/Y: </span> <?= $current_session->name ?></p>
        <p style="font-size:18px;"><span class="red"> Ref No.: </span> <?= $chalani_no ?></p>
      </div>
      <div class="col-3 text-right letter-head-right" style="margin-left: 719px">
        <div class="myclear"> </div>
        <p style="font-size:18px; margin-top: -39px;"> <span class="red"> Date : </span> <?= $result_chalani->english_chalani_miti?></p>
      </div>
   </div>

    <div class="col-md-4" style="margin-top:50px;">
        <div class='row'>
            <?= !empty($this_office->sambodhan) ? $this_office->sambodhan."," : ''?>
        </div>
        <div class="row">
          <?php echo !empty($this_office->name)?$this_office->name:''?>,
        </div>

        <div class="row">
            <?= !empty($this_office->address) ? $this_office->address."," : ''?>
        </div>
    </div>
  <div class="text-center mt-2 mb-5">
    <p style="font-size: 26px;"><span style="border-bottom: 1px solid black; margin-bottom: 3px;"> <span class="red"> SUB: </span> TAX CLEARANCE CERTIFICATE</span><br></p>
    <div class="space4"></div>
    <p style="font-size: 26px;"> <span style="border-bottom: 1px solid black; margin-bottom: 3px; margin-top: 30px;"> TO WHOM IT MAY CONCERN </span></p>
  </div>
  <p style="font-size:20px; text-align: justify;"> 
    This is to certify that <?php echo $gender?><?php echo $detail->app_name?> Permanent  resident of <?php echo $dis->english_name?> <?php echo $gapa->english_name?> <?php echo $detail->per_ward?> <?php echo $state->english_name?>
    Nepal has been regularly paying all the taxes in this office as per the government rules and regulation.
  </p>
  <div class="space2"></div>
    <p style="font-size:20px; text-align: justify;">In my observation, there is no any pending due of taxes.</p>
  <div class="space2"></div>
      
    <div class="row">

        <div class="col-3 offset-9">

            <div class="signature" style="margin-top: 50px;">

                <?php 

                echo $worker_id->english_name?>

                <br><?php echo $post->designation?>

            </div>

        </div>

    </div>
</div>