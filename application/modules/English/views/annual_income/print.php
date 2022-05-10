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
      <p style="font-size:18px;"> <span class="red"> F/Y: </span> <?= $current_session->name ?><br></p>
      <p style="font-size:18px;"><span class="red"> Dispatch No.: </span> <?= $chalani_no ?></p>
    </div>
    <div class="col-3 text-right letter-head-right" style="margin-left: 720px">
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

  <div class="text-center mt-2 mb-5">
    <p style="font-size: 26px;"><span style="border-bottom: 1px solid black; margin-bottom: 3px;"> <span class="red"> SUB: </span> CERTIFICATE OF ANNUAL INCOME </p>
    <div class="space4"></div>
    <p style="font-size: 26px;"><span style="border-bottom: 1px solid black; margin-bottom: 3px;"> TO WHOM IT MAY CONCERN </span></p>
  </div>
   <p style="font-size:20px; text-align: justify;">This is to certify that  <b><?php echo $gender?>. <?php echo $result->app_name?></b> 
  (Father of applicant Mr. <?php echo $result->father_name?>) permanent resident of <b><?= $per_gapa->english_name.", Ward No ".$result->per_ward.", ".$per_district->english_name ?> <?php echo $per_state->english_name?></b>. The family has been earning from different sources of different fiscal year as listed below:</p>
    <div class="space1"></div>
    <div class="text-justify" style=" font-family: Arial; ">
      <table class="table table-bordered table-bordered">
        <tr>
          <td style="font-size:20px; text-align: justify;">SN</td>
          <td style="font-size:20px; text-align: justify;">Income Source  <?php 
           $current = date('Y');

            $first = date('Y', strtotime('-1 year'));

            $secondYear = date('Y',strtotime('-2 year'));

            $thirdYear = date('Y',strtotime('-3 year'));

            ?>

        </td>

        <td class="numbers" style="font-size:20px; text-align: justify;">Annual Income of Fiscal Year <br><?php echo $thirdYear.'/'.$secondYear?></td>

        <td class="numbers" style="font-size:20px; text-align: justify;">Annual Income of Fiscal Year <br><?php echo $secondYear.'/'.$first?></td>

        <td class="numbers" style="font-size:20px; text-align: justify;">Annual Income of Fiscal Year <br><?php echo $first.'/'.$current?> </td>

    </tr>

    <?php 

    $i= 1;

    $ft = 0;

    $st = 0;

    $tt = 0;

    if(!empty($sources)): 

      foreach ($sources as $key => $source) :?>

        <tr>

          <td class="numbers" style="font-size:20px; text-align: justify;"><?php echo $i++?></td>

          <td style="font-size:20px; text-align: justify;"><?php echo $source->income_source?></td>

          <td class="numbers" style="font-size:20px; text-align: justify;"><?php echo $source->fy_i?></td>

          <td class="numbers" style="font-size:20px; text-align: justify;"><?php echo $source->fy_ii?></td>

          <td class="numbers" style="font-size:20px; text-align: justify;"><?php echo $source->fy_iii?></td>

          <?php 

          $ft += $source->fy_i;

          $st += $source->fy_ii;

          $tt += $source->fy_iii;

          ?>

      </tr>

  <?php endforeach;endif;?>

  <tfoot>

    <tr>

      <td colspan="2" align="center" style="font-size:20px; text-align: justify;">Total</td>

      <td class="numbers" style="font-size:20px; text-align: justify;"><?php echo $ft;?></td>

      <td class="numbers" style="font-size:20px; text-align: justify;"><?php echo $st;?></td>

      <td class="numbers" style="font-size:20px; text-align: justify;"><?php echo $tt;?></td>

  </tr>

</tfoot>

</table>

</div>



<div class="text-justify" style=" font-family: Arial;font-size:20px;">
  Total Annual income of the fiscal Year <?php echo $first.'/'.$current?> is NRs. <?php echo $tt?>
</div>

<div class="text-justify" style=" font-family: Arial;font-size:20px; ">

  Equivalent is USD <?php  

  $rate = get_us_currency_rate();

  $amount = $tt / $rate;

  echo round($amount,2);

  ?>

</div>

<div class="text-justify" style=" font-family: Arial;font-size:20px; ">
   Exchange rate (Selling rate) fixed by Nepal Rastra Bank on <?php echo date('Y-m-d')?> for US $1 = NRs. <?php echo get_us_currency_rate();
   ?>
</div>
<div class="space4"></div>
    <div class="row">
        <div class="col-3 offset-9">
            <div class="signature">
              <?php 
                echo $worker_id->english_name?>
                <br><?php echo $post->designation?>
            </div>
        </div>
    </div>
</div>
