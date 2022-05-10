<?php
if(isset($result))
{
    $action_page = base_url()."add_office/".$result->id;
}
else
{
    $action_page = base_url()."add_office";
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

                <li class="breadcrumb-item active">कार्यालय</li>

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
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label">
                                        <span class="float-right">
                                           कार्यालयको नाम<span class="text-danger">&nbsp;*</span>
                                        </span>

                                </label>

                                    <div class="col-sm-8">
                                        <input type="text" name="name" class="form-control " value="<?php if(isset($result->name)){ echo $result->name;}?>" required>
                                    </div>

                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label">
                                        <span class="float-right">
                                           ठेगाना <span class="text-danger">&nbsp;*</span>
                                        </span>

                                </label>

                                    <div class="col-sm-8">
                                        <input type="text" name="address" class="form-control " value="<?php if(isset($result->name)){ echo $result->address;}?>" >
                                    </div>

                            </div>
                        </div>

                    </div>
                </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">
                                            <span class="float-right">
                                               सम्बोधन<span class="text-danger">&nbsp;*</span>
                                            </span>

                                    </label>

                                        <div class="col-sm-8">
                                            <input type="text" name="sambodhan" class="form-control " value="<?php if(isset($result->sambodhan)){ echo $result->sambodhan;}?>" >
                                        </div>

                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="form-group row no-gutters">
                        <div class="col-sm-12 offset-sm-2 mt-4 pl-3">
                            <input type="submit" name="submit" class="btn btn-primary" value="सेभ गर्नुहोस्" >
                        </div>
                    </div>



                <!-- /.box-body -->

                <div class="box-footer">

                </div>

                <?php echo form_close();?>
            </div>
            <hr/>
            <?php if(!empty($offices)){?>
            <div class="box box-primary"  style="margin-left: 10px">
                <div class="box-header with-border">
                    <center><h4 class="box-title">कार्यालयहरु</h4></center>
                </div>
                <table id="table1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>क्र.स.</th>
                        <th>कार्यालय</th>
                        <th>ठेगाना</th>
                        <th>सम्बोधन</th>
                        <th>&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i = 1;
                            foreach ($offices as $office){
                        ?>
                            <tr>
                                <td><?=$i?></td>
                                <td><?=$office->name?></td>
                                <td><?= $office->address ?></td>
                                <td><?= $office->sambodhan?></td>
                                <td>
                                    <a href="<?=base_url()?>add_office/<?=$office->id?>">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    </a>&nbsp;
                                    <a href="<?=base_url()?>office/<?=$office->id?>">
                                    <i class="fa fa-trash-o text-danger" aria-hidden="true"></i>
                                    </a>
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
