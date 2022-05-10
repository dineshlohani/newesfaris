<style type="text/css">

body {

 font-family: "Times New Roman", Times, serif;

}
</style>



<?php



    // $local_body     = Modules::run("Settings/getLocal",$result->per_gapana);

    // $state          = Modules::run("Settings/getState",$result->per_state);

    // $ward           = Modules::run("Settings/getWard",$result->per_ward);

    // $district       = Modules::run("Settings/getDistrict",$result->per_district);

    // $office         = Modules::run("Settings/getOffice",$result->office);

    // if(!empty($result->document))

    // {

    //     $documents      = explode("+",$result->document);



    // }

   // $path           = base_url()."assets/documents/home/road/";

    $current_session    = Modules::run('Settings/getCurrentSession',$result->session_id);

    //$worker_post        = Modules::run('Settings/getPost',$ward_worker->post_id);

//    $this_office   = Modules::run('Settings/getOffice', $print_office->id);

    $gender = ($result->status == 1) ? 'MR' : 'MRS';

    $son_daughter = ($result->son_daughter == 1)? 'Son' : 'Daughter';
?>

<div class="letter_print">

    <hr>

    <div class="row">

    <div class="col-3 letter-head-left">

                 <p style="font-size:18px;"><span class="red"> F/Y: </span> <?= $current_session->name ?></span><br></p>

                 <p style="font-size:18px;"><span class="red"> Ref No.: </span> <?= $chalani_no ?></span></p>

    </div>

    <div class="col-3 text-right letter-head-right" style="margin-left: 720px">

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

   <!--  <div class="text-center my-4 py-2 mt-5">

        <h4>विषय: घरबाटो प्रमाणित ।</h4>

    </div> -->

  <div class="text-center mt-2 mb-5">

                            <p style="font-size: 26px;"><span style="border-bottom: 1px solid black; margin-bottom: 3px;"> <span class="red"> SUB: </span> BIRTH CERTIFICATE </span><br></p>
                              <div class="space4"></div>
                             <p style="font-size: 26px;"> <span style="border-bottom: 1px solid black; margin-bottom: 3px; margin-top: 30px;"> TO WHOM IT MAY CONCERN </span>

                            </p>

                        </div>

                      <p style="font-size:20px; text-align: justify;"> This is to certify that <b><?php echo $gender?>. <?php echo $result->app_name?></b>, <?php echo $son_daughter?> of <b>Mr. <?php echo $result->father_name?></b>, &amp; <b>Mrs.

                           <?php echo $result->mother_name?></b>, Was born in <?php echo $born_gapa->english_name?>, Ward No.  <?php echo $result->birth_ward?>, <?php echo $born_dis->english_name?>,
                           Permanent resident
                          of <?php echo $per_gapa->english_name?> Ward No. <?php echo $result->per_ward?>, <?php echo $per_district->english_name?>, <?php echo $per_state->english_name?>, Nepal.
                          <div class="space1"></div>
                          <span style="font-size:20px;">According to our record her date of birth is <?php echo $result->dob_np?> B. S. (<?php echo $result->dob_en?> A. D.).</span></p>

              <div class="space4"></div>

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
