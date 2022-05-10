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


    <hr><br>

    <div class="row">

    <div class="col-3 letter-head-left">

                <p style="font-size:18px;"><span class="red"> F/Y: </span> <?= $current_session->name ?><br></p>

                <p style="font-size:18px;"><span class="red"> Dispatch No.: </span> <?= $chalani_no ?></p>

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

            <?= !empty($this_office->name)?$this_office->name:''?>,

        </div>

        <div class="row">

            <?= !empty($this_office->address) ? $this_office->address."," : ''?>

        </div>



    </div>

   <!--  <div class="text-center my-4 py-2 mt-5">

        <h4>विषय: घरबाटो प्रमाणित ।</h4>

    </div> -->

    <div class="text-center mt-2 mb-5">

        <p style="font-size: 26px;"><span style="border-bottom: 1px solid black; margin-bottom: 3px;"> <span class="red"> SUB: </span>CERTIFICATE OF PROPERTY VALUATION</span></p>
        <div class="space4"></div>
          <p style="font-size: 26px;"><span style="border-bottom: 1px solid black; margin-bottom: 3px;"> TO WHOM IT MAY CONCERN </span>

         </p>

      </div>

      <p style="font-size:20px; text-align: justify;">In regards to the above subject, as <b><?php echo $gender?>. <?php echo $result->app_name?></b> 

      permanent resident of <?= $per_gapa->english_name.", Ward No ".$result->per_ward.", ".$per_district->english_name ?>, Nepal. <?php if($gender==1){echo 'son';} else {echo 'daughter';}?> Mr. <?php echo $result->father_name?> & Mrs. <?php echo $result->mother_name?> submitted an application with recommendation of the concerned ward requesting for recommendation of economic value of the Land in order to study abroad. Whereas,a deed of public inquiry conducted from the concerning ward is received in this regards; therefore, on the basis of the same; it is hereby recommended that the details of economic value of the applicant's is as follows:</p>

    <div class="space4"></div>



    <div class="text-justify" style=" font-family: Arial;margin-top:-100px; ">

      <table class="table table-bordered table-bordered">

      

        <tr>

          <td  style="font-size: 18px;">SN</td>

          <td style="font-size: 18px;">Owner of the Property </td>

          <td class="numbers" style="font-size: 18px;">Description</td>

          <td class="numbers" style="font-size: 18px;">Location of the Property</td>

          <td class="numbers" style="font-size: 18px;">Plot No.</td>

          <td class="numbers" style="font-size: 18px;">Area(B-K-D</td>

          <td class="numbers" style="font-size: 18px;">Amount in Rs.</td>

        </tr>

      <?php 

        $i= 1;

        $ft = 0;

        if(!empty($sources)): 

        foreach ($sources as $key => $source) :?>

          <tr>

            <td class="numbers" style="font-size: 18px;"><?php echo $i++?></td>

            <td><?php echo $source->owner_name?></td>

            <td class="numbers" style="font-size: 18px;"><?php echo $source->descp?></td>

            <td class="numbers" style="font-size: 18px;"><?php echo $source->location?></td>

            <td class="numbers" style="font-size: 18px;"><?php echo $source->plot_no?></td>

            <td class="numbers" style="font-size: 18px;"><?php echo $source->area?></td>

            <td class="numbers" style="font-size: 18px;"><?php echo $source->amount?></td>

            <?php 

            $ft += $source->amount;

            ?>

          </tr>

        <?php endforeach;endif;?>

        <tfoot>

          <tr>

            <td colspan="7" class="numbers" align="center" style="font-size: 18px;">Total: <?php echo $ft;?></td>

          </tr>

        </tfoot>

      </table>

</div>



<div class="text-justify" style=" font-family: Arial; ">

  Total Annual income of the fiscal Year <?php echo $first.'/'.$current?> is NRs. <?php echo $tt?>

</div>

<div class="text-justify" style=" font-family: Arial; ">

  Equivalent is USD <?php  

  $rate = get_us_currency_rate();

  $amount = $rate * $tt;

  echo $amount;

  ?>

</div>

<div class="text-justify" style=" font-family: Arial; ">

   Exchange rate (Selling rate) fixed by Nepal Rastra Bank on <?php echo date('Y-m-d')?> for US $1 = NRs. <?php echo get_us_currency_rate();

   ?>

</div>

    <div class="space4"></div>



    <div class="row">

        <div class="col-3 offset-9">

            <div class="signature">


               <?php echo $worker_id->english_name?>

                <br><?php echo $post->designation?>
            </div>

        </div>

    </div>
</div>

