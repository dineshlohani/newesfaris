<style type="text/css">
    body {
      font-family: Arial;
    }

    .numbers {
      font-family: Tahoma;
    }
</style>



<?php



    // $local_body     = Modules::run("Settings/getLocal",$result->local_body);

    // $state          = Modules::run("Settings/getState",$result->state);

    // $ward           = Modules::run("Settings/getWard",$result->ward);

    // $district       = Modules::run("Settings/getDistrict",$result->district);

    // $office         = Modules::run("Settings/getOffice",$result->office);

    // if(!empty($result->document))

    // {

    //     $documents      = explode("+",$result->document);



    // }

    // $path           = base_url()."assets/documents/home/road/";

    // $current_session    = Modules::run('Settings/getCurrentSession',$result->session_id);

    // $worker_post        = Modules::run('Settings/getPost',$ward_worker->post_id);

    // $this_office   = Modules::run('Settings/getOffice', $print_office->id);

     $gender = ($result->gender == 1) ? 'MR' : 'MRS';

?>

<br /><br />

<div class="letter_print">

    <hr><br>

    <div class="row">

    <div class="col-3 letter-head-left">

               <p style="font-size:18px;"> <span class="red"> F/Y: </span> <?= $current_session->name ?><br></p>

                <p><span class="red"> Dispatch No.: </span> <?= !empty($chalani_no)?$result_chalani->chalani_no:'not dispacth' ?></p>

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

                            <p style="font-size:26px;"><span style="border-bottom: 1px solid black; margin-bottom: 3px;"> <span class="red"> SUB: </span>ADDRESS VERIFICATION </span><br>

                            <span style="border-bottom: 1px solid black; margin-bottom: 3px;"> TO WHOM IT MAY CONCERN </span>

                            </p>

                        </div>

                         <p style="font-size:18px; text-align: justify;">In reference to the subject <b><?php echo $gender?>. <?php echo $result->app_name?></b> 

                           has submitted an application to this office requesting to make clear about this address it is hereby certified that this address was <?php echo $result->old_name?> VDC  <?php echo $result->old_ward?> and recently has been changed as <?= $per_gapa->english_name.", Ward No-".$result->per_ward.", ".$per_district->name ?> according to the decision of the Government of Nepal applicable from 10th March 2017 A.D.(2073/11/27B.S.) 

                          <br>

                         Thus both addresses refer to same place. </p>

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