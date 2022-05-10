<?php
if(isset($result))
{
    $action_page = base_url()."add_session/".$result->id;
}
else
{
    $action_page = base_url()."add_session";
}

?>
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

                <li class="breadcrumb-item active">आर्थिक वर्षहरु</li>

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
                <?php echo form_open($action_page)?>
                <div class="col-12 col-md-6 offset-md-3" >

                    <div class="form-group">
                        <label>आर्थिक वर्ष</label>
                        <input type="text" name="name" class="form-control " value="<?php if(isset($result->name)){ echo $result->name;}?>" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-primary" value="सेभ गर्नुहोस्" >
                    </div>
                </div>

                <!-- /.box-body -->

                <div class="box-footer">

                </div>

                <?php echo form_close();?>
            </div>
            <hr/>
            <div class="col-12 col-md-6 offset-md-3" >

                <div class="form-group">
                    <label><b>हालको आर्थिक वर्ष:</b> <?= $current_session->name ?></label>
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">अहिलेको आर्थिक वर्ष छान्नुहोस्</button>
                </div>
            </div>
            <hr/>

            <?php if(!empty($sessions)){?>
            <div class="box box-primary"  style="margin-left: 10px">
                <div class="box-header with-border">
                    <center><h4 class="box-title mb-3">आर्थिक वर्षहरु</h4></center>
                </div>
                <table id="table1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>क्र.स.</th>
                        <th>आर्थिक वर्ष</th>
                        <!--<th>&nbsp;</th>-->
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $i = 1;
                        foreach ($sessions as $session){
                    ?>
                        <tr>
                            <td><?= $i?></td>
                            <td><?= $session->name ?></td>
                            <!--<td>-->
                            <!--    <a href="<?=base_url()?>add_session/<?=$session->id?>">-->
                            <!--        <img src="<?=base_url()?>assets/images/icons/edit.png">-->
                            <!--    </a>&nbsp;&nbsp;-->
                                <!-- <a href="<?=base_url()?>session/<?=$session->id?>">
                            <!-- <img src="<?=base_url()?>assets/images/icons/delete.png">-->
                            <!--    </a> -->
                            <!--</td>-->
                        </tr>
                        <?php $i++;}?>
                    </tbody>
                </table>

                <?php }?>
            </div>

        </div>
    </div>
    </div>
    <!-- Trigger the modal with a button -->
    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title">अहिले आर्थिक वर्ष छान्नुहोस्</h4>
            <button type="button" class="close" data-dismiss="modal">&#10006;</button>

          </div>
          <div class="modal-body">
              <?php echo form_open(base_url()."session/current")?>
              <div class="row">
                   <div class="col-md-4"><b>आर्थिक वर्ष:</b></div>
                   <div class="col-md-4">
                       <select name="session_id" class="form-control select2" style="width:100%">
                              <option value="">छान्नुहोस्</option>
                              <?php foreach($sessions as $session) : ?>
                                  <option value="<?= $session->id ?>"
                                      <?php
                                        if($session->id == $current_session->id)
                                        {
                                            echo 'selected="selected"';
                                        }
                                      ?>
                                  ><?= $session->name?></option>
                              <?php endforeach;?>
                       </select>
                  </div>
                  <div>
                      <input type="submit" class="btn btn-primary" name="submit" value="अपडेट गर्नुहोस">
                  </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>
</section>
</div>
<script src="<?=base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!--<script src="--><?//=base_url()?><!--assets/js/popper.min.js"></script>-->
<script src="<?=base_url()?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?=base_url()?>assets/bower_components/select2/dist/js/select2.min.js"></script>
<script src="<?= base_url()?>assets/calendar/nepali.datepicker.v2.1.min.js"></script>
<!--<script src="--><?//=base_url()?><!--assets/js/admin.js"></script>-->

<script src="<?= base_url();?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url();?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?=base_url()?>assets/calendar/js/nepalidate.js"></script>

<script src="<?=base_url()?>assets/js/frontend.js"></script>

</body>
</html>
