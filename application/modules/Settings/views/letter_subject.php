<?php
if(isset($result))
{
    $action_page = base_url()."edit-land-type/".$result->id;
}
else
{
    $action_page = base_url()."land-type";
}

?>
<section class="content">

  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <?php if(!empty($this->session->flashdata('msg')))
                {?>
        <div class="alert alert-success alert-dismissible"> <a href="#" class="close" data-dismiss="alert"
            aria-label="close">&times;</a><span><?=$this->session->flashdata('msg');?></span></div>


        <?php } ?>
        <?php if(!empty($this->session->flashdata('err_msg')))
                {?>
        <div class="alert alert-danger alert-dismissible"> <a href="#" class="close" data-dismiss="alert"
            aria-label="close">&times;</a><span><?=$this->session->flashdata('err_msg');?></span></div>

        <?php } ?>
      </div>
    </div>
  </div>



  <div class="container-fluid ">
    <nav aria-label="breadcrumb" class="bg-shadow">
      <ol class="breadcrumb px-3 py-2">
        <li class="breadcrumb-item ml-1"><a href="<?= base_url()?>dashboard">गृह</a></li>


        <li class="breadcrumb-item active">सेटिंग्स</li>

        <li class="breadcrumb-item active">खुल्ला ढाचाको पत्रको विषय</li>

      </ol>
    </nav>
  </div>




  <div class="container-fluid ">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="offset-lg-1 col-lg-10">

          </div>
        </div>


        <?php if(!empty($post)){?>

        <table id="tale1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>क्र.स.</th>
              <th>पत्रको किसिम</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody>
            <?php
                        $i = 1;
                        foreach ($post as $data){
                    ?>
            <tr>
              <td><?= $i?></td>
              <td><?= $data->subject ?></td>
              <td>
               <a href="<?=base_url()?>Settings/editLetterSubject/<?=$data->id?>">
                  <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </a>&nbsp;&nbsp;

              </td>
            </tr>
            <?php $i++;}?>
          </tbody>
        </table>

        <?php }?>
      </div>

    </div>
  </div>
  </div>

</section>
</div>
</body>

</html>