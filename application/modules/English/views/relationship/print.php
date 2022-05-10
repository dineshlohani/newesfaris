<style type="text/css">

body {

  font-family: "Times New Roman", Times, serif;

}



div.rel-img {

  margin: 5px;

  border: 1px solid #000;

  float: left;

  width: 110px;

  height: 110px;

}



div.gallery:hover {

  border: 1px solid #777;

}



div.gallery img {

  width: 100%;

  height: auto;

}



div.desc {

  padding: 15px;

  /*text-align: center;*/

}



.numbers {
  font-family: Tahoma;
}

p {

   font-family: Arial;

}

select {

  border-top-style: hidden;

        border-right-style: hidden;

        border-left-style: hidden;

        border-bottom-style: groove;

        background-color: #eee;

}



input 

{       

        font-family: Arial;

        border-top-style: hidden;

        border-right-style: hidden;

        border-left-style: hidden;

        border-bottom-style: groove;

        background-color: #eee;

}

      

.no-outline:focus {

  outline: none;

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

    $path           = base_url()."assets/documents/home/road/";

    $current_session    = Modules::run('Settings/getCurrentSession',$detail->session_id);

//    $worker_post        = Modules::run('Settings/getPost',$ward_worker->post_id);
    if(!empty($print_office)) {
      $this_office   = Modules::run('Settings/getOffice', $print_office->id);
    }
    
if($detail->gender == 1){
    $gender = "Mr.";
}elseif($details->gender == 2){
    $gender = "Mrs.";
}else{
     $gender = "Miss.";
}
$son_daughter = ($detail->relation == 1)? 'Son' : 'Daughter';

?>
<br /><br />

<div class="letter_print">
    <hr><br>

    <div class="row">

    <div class="col-3 letter-head-left">
      <p style="font-size:18px;"><span class="red"> F/Y: </span> <?= $current_session->name ?><br></p>
      <p style="font-size:18px;"><span class="red"> Dispatch No.: </span> <?= $chalani_no ?></p>
    </div>

    <div class="col-3 text-right letter-head-right" style="margin-left: 719px">

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

      <p style="font-size: 26px;"><span style="border-bottom: 1px solid black; margin-bottom: 3px;"> <span class="red"> SUB: </span> RELATIONSHIP VERIFICATION </span><br></p>
      <p style="font-size: 26px;"><span style="border-bottom: 1px solid black; margin-bottom: 3px; margin-top: 30px;"> TO WHOM IT MAY CONCERN </span></p>

      <!-- <p style="font-size: 26px;"><span style="border-bottom: 1px solid black; margin-bottom: 3px;"> <span class="red"> SUB: </span> RELATIONSHIP CERTIFICATE </span></p>
      <p style="font-size: 26px;"><span style="border-bottom: 1px solid black; margin-bottom: 3px; margin-top: 80px !important;"> TO WHOM IT MAY CONCERN </span> -->
    </div> 

    <div class="text-justify">
         <p style="font-size:20px; text-align: justify;">This is to certify that <b><?php echo $gender?> <?php echo $detail->app_name?></b> <?php echo $detail->relation?> of<b>  &nbsp;Mr. <?php echo  $detail->father_name?></b> & <b>Mrs. <?php echo $detail->mother_name?></b> Permanent resident of &nbsp;<?php echo $gapa->english_name?> Ward No. <?php echo $detail->per_ward?>, <?php echo $dis->english_name?>, <?php echo $state->english_name?>, Nepal. As per her application and recommendation made by ward No. <?php echo $detail->rem_ward?>,
        <?php echo SITE_OFFICE_ENG?> <?php echo SITE_DISTRICT_ENG?>, Nepal, the following members are the family members of the applicant as mentioned below :</p>
        <div class="row">
            <div class="photo_box" style="margin-top: 50px;"> <span> फोटो </span> 
              <p style="margin-top: 70px;"><?php echo $gender?> <?php echo $detail->app_name?></p>
              <span style="margin-top: -59px;">(Applicant)
            </div>
            <?php if(!empty($reldetail)){
              foreach ($reldetail as $key => $rel) { ?>
                <div class="photo_box" style="margin-top: 50px;"> <span> फोटो </span> 
                  <p style="margin-top: 70px;"><?php echo $rel->gender?>. <?php echo $rel->name?></p>
                  <span style="margin-top: -59px;">(<?php echo $rel->relation?>)</span>
                </div>
            <?php  } } ?>
        </div>
    </div>
    <div class="space4"></div>
    <div class="row">
        <div class="col-3 offset-9">
            <div class="signature">
              <p style="font-size: 18px;"><?php echo $worker_id->english_name?></p>
              <p style="font-size: 18px;"><?php echo $post->designation?></p>
            </div>
        </div>
    </div>
</div>


