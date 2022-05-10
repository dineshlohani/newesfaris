<style type="text/css">


 
</style>
<?php
if(isset($result))
{
    $action_page = base_url()."add-post/".$result->id;
}
else
{
    $action_page = base_url()."add-post";
}

?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<section class="content">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <?php if(!empty($this->session->flashdata('msg')))
                {?>
                    <div  class="alert alert-success alert-dismissible" >    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span><?=$this->session->flashdata('msg');?></span></div>


                <?php } ?>
                <?php if(!empty($this->session->flashdata('err_msg')))
                {?>
                    <div  class="alert alert-danger alert-dismissible" >    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span><?=$this->session->flashdata('err_msg');?></span></div>

                <?php } ?>
            </div>
        </div>
    </div>

    <div class="container-fluid ">
        <nav aria-label="breadcrumb" class="bg-shadow">
            <ol class="breadcrumb px-3 py-2">
                <li class="breadcrumb-item ml-1"><a href="<?= base_url()?>dashboard">गृह</a></li>
                <li class="breadcrumb-item active">सेटिंग्स</li>
                <li class="breadcrumb-item active">पद</li>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                  Launch demo modal
                </button>
            </ol>


        </nav>

        <div class="row">
            <div class="col-12">

              <div id="accordion">
                <h3>Section 1</h3>
                <div>
                  <li><a href="">नागरीकता सिफारीस</a></li>
                  <li><a href="">नागरीकता प्रमाण-पत्र सिफारीस</a></li>
                  <li><a href=""> नागरीकता प्रमाण-पत्र प्रतिलिपी सिफारीस</a></li>
                </div>
                <h3>Section 2</h3>
                <div>
                 <li><a href="">नागरीकता सिफारीस</a></li>
                  <li><a href="">नागरीकता प्रमाण-पत्र सिफारीस</a></li>
                  <li><a href=""> नागरीकता प्रमाण-पत्र प्रतिलिपी सिफारीस</a></li>
                </div>
                <h3>Section 3</h3>
                <div>
                  <li><a href="">नागरीकता सिफारीस</a></li>
                  <li><a href="">नागरीकता प्रमाण-पत्र सिफारीस</a></li>
                  <li><a href=""> नागरीकता प्रमाण-पत्र प्रतिलिपी सिफारीस</a></li>
                </div>
              </div>
             <!--  <div class="sifarismenu">
                <ul>
                  <div><h3>सिफारिसका प्रकार</h3></div>

                  <li class="container"><p>नागरीकता सम्बन्धी </p>
                    <ul>
                      <li><p><a href=""><i class="fa fa-hand-o-right"></i> नागरीकता सिफारीस</a></p></li>
                      <li><p><a href="">नागरीकता प्रमाण-पत्र सिफारीस</a></p></li>
                      <li><p><a href=""> नागरीकता प्रमाण-पत्र प्रतिलिपी सिफारीस</a></p></li>
                    </ul>
                  </li>

                  <li class="container"><p>नागरीकता सम्बन्धी </p>
                    <ul>
                      <li><p><a href="">नागरीकता सिफारीस</a></p></li>
                      <li><p><a href="">नागरीकता प्रमाण-पत्र सिफारीस</a></p></li>
                      <li><p><a href=""> नागरीकता प्रमाण-पत्र प्रतिलिपी सिफारीस</a></p></li>
                    </ul>
                  </li>

                  <li class="container"><p>नागरीकता सम्बन्धी </p>
                    <ul>
                      <li><p><a href="">नागरीकता सिफारीस</a></p></li>
                      <li><p><a href="">नागरीकता प्रमाण-पत्र सिफारीस</a></p></li>
                      <li><p><a href=""> नागरीकता प्रमाण-पत्र प्रतिलिपी सिफारीस</a></p></li>
                    </ul>
                  </li>

                  <li class="container"><p>नागरीकता सम्बन्धी </p>
                    <ul>
                      <li><p><a href="">नागरीकता सिफारीस</a></p></li>
                      <li><p><a href="">नागरीकता प्रमाण-पत्र सिफारीस</a></p></li>
                      <li><p><a href=""> नागरीकता प्रमाण-पत्र प्रतिलिपी सिफारीस</a></p></li>
                    </ul>
                  </li>

                </ul>
              </div> -->

             
            </div>
        </div>
    </div>

</section>
</div>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  jQuery(document).ready(function() {
    jQuery( "#accordion" ).accordion({
      collapsible: true,
      active: false,
    });
});
</script>
</body>
</html>
