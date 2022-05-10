<?php
if(isset($result))
{
    $action_page = base_url()."add_ward/".$result->id;
}
else
{
    $action_page = base_url()."add_ward";
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
                    <div  class="alert alert-danger alert-dismissible" >    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span><?=$this->session->flashdata('c');?></span></div>

                <?php } ?>
            </div>
        </div>
    </div>



    <div class="container-fluid ">
        <nav aria-label="breadcrumb" class="bg-shadow">
            <ol class="breadcrumb px-3 py-2">
                <li class="breadcrumb-item ml-1"><a href="<?= base_url()?>dashboard">गृह</a></li>


                <li class="breadcrumb-item active">सेटिंग्स</li>

                <li class="breadcrumb-item active">वडा नं.</li>

            </ol>
        </nav>
    </div>




    <div class="container-fluid ">
        <div class="card">
            <div class="card-body">
                <?php echo form_open($action_page)?>
                <div class="col-12 col-md-6 offset-md-3" >
                    <div class="form-group">
                        <label>वडा नं.</label>
                        <input type="text" name="name" class="form-control " value="<?php if(isset($result->name)){ echo $result->name;}?>" required>
                    </div>
                    <label>ठेगाना (नेपाली)</label>
                    <input type="text" name="address" class="form-control " value="<?php if(isset($result->address)){ echo $result->address;}?>" required>
                    <label>ठेगाना (ENGLISH)</label>
                    <input type="text" name="address_eng" class="form-control " value="<?php if(isset($result->address_eng)){ echo $result->address_eng;}?>" required>
                    <label>फोन नं</label>
                     <input type="text" name="phone_no" class="form-control " value="<?php if(isset($result->phone_no)){ echo $result->phone_no;}?>" required>
                    <label>इमेल</label>
                    <input type="text" name="email" class="form-control " value="<?php if(isset($result->email)){ echo $result->email;}?>" required>
                    <label>नारा</label>
                    <input type="text" name="nara" class="form-control " value="<?php if(isset($result->nara)){ echo $result->nara;}?>" required>
                    <label>Slogan(English)</label>
                    <input type="text" name="slogan" class="form-control " value="<?php if(isset($result->slogan)){ echo $result->slogan;}?>" required>
                    <hr>
                    <div class="form-group">
                        <div class="text-center">
                        <input type="submit" name="submit" class="btn btn-primary" value="सेभ गर्नुहोस्" >    
                        </div>
                    </div>
                </div>
            <?php if(!empty($wards)){?>
            <div class="" >
                <div class="box-header with-border">
                    <center><h4 class="box-title">वडाहरु</h4></center>
                </div>
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>क्र.स.</th>
                        <th>वडा नं.</th>
                        <th>ठेगाना (नेपाली)</th>
                        <th>ठेगाना (ENGLISH)</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Slogan (Nepali)</th>
                        <th>Slogan (ENGLISH)</th>
                        <th>&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 1;
                    foreach ($wards as $ward){
                        ?>
                        <tr>
                            <td><?=$i?></td>
                            <td><?=$ward->name?></td>
                            <td><?= $ward->address ?></td>
                            <td><?= $ward->address_eng ?></td>
                            <td><?= $ward->email ?></td>
                            <td><?= $ward->phone_no ?></td>
                            <td><?= $ward->nara ?></td>
                            <td><?= $ward->slogan ?></td>
                            <td>
                                <a href="<?=base_url()?>add_ward/<?=$ward->id?>">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                </a>&nbsp;&nbsp;
                                <a href="<?=base_url()?>ward/<?=$ward->id?>">
                                <i class="fa fa-trash-o text-danger" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                        <?php $i++;}?>
                    </tbody>
                </table>

                <?php } ?>
            </div>

            </div>

                <!-- /.box-body -->

                <div class="box-footer">

                </div>

                <?php echo form_close();?>
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
