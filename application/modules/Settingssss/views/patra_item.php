<?php
if(isset($result))
{
    $action_page = base_url()."add_patra_item/".$result->id;
}
else
{
    $action_page = base_url()."add_patra_item";
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

                <li class="breadcrumb-item active">पत्रको विषयहरु</li>

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
                        <label>पत्रको वर्ग</label>
                        <select name="category_id" class="form-control" required>
                            <option value="">छान्नुहोस्</option>
                            <?php foreach($categories as $category) : ?>
                                <option value="<?= $category->id?>"
                                    <?php
                                        if(isset($result) && $result->category_id == $category->id)
                                        {
                                            echo 'selected = "selected"';
                                        }
                                    ?>
                                ><?= $category->name ?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>पत्रको विषयको नाम</label>
                        <input type="text" name="name" class="form-control " value="<?php if(isset($result->name)){ echo $result->name;}?>" required>
                    </div>
                    <div class="form-group">
                        <label>URI LINK</label>
                        <input type="text" name="uri" class="form-control " value="<?php if(isset($result->uri)){ echo $result->uri;}?>" required>
                    </div>
                    <div class="form-group">
                        <label>Model name</label>
                        <input type="text" name="model" class="form-control " value="<?php if(isset($result->model)){ echo $result->model;}?>" required>
                    </div>
                    <div class="form-group">
                        <label>Image Link</label>
                        <input type="text" name="image_link" class="form-control " value="<?php if(isset($result->image_link)){ echo $result->image_link;}?>">
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
            <?php if(!empty($items)){?>
            <div class="box box-primary"  style="margin-left: 10px">
                <div class="box-header with-border">
                    <center><h4 class="box-title">पत्रको विषयहरु</h4></center>
                </div>
                <table id="table1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>क्र.स.</th>
                        <th>पत्रको वर्ग</th>
                        <th>पत्रको विषय</th>
                        <th>URI LINK</th>
                        <th>Model Name</th>
                        <th>Image Link</th>
                        <th>&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $i = 1;
                        foreach ($items as $item){
                            $category = Modules::run("Settings/getPatraCategory",$item->category_id);
                    ?>
                        <tr>
                            <td><?= $i?></td>
                            <td><?= $category->name ?></td>
                            <td><?= $item->name ?></td>
                            <td><?= $item->uri ?></td>
                            <td><?= $item->model ?></td>
                            <td><?= $item->image_link ?></td>
                            <td>
                                <a href="<?=base_url()?>add_patra_item/<?=$item->id?>">
                                    <img src="<?=base_url()?>assets/images/icons/edit.png">
                                </a>&nbsp;&nbsp;
                                <a href="<?=base_url()?>patra-item/<?=$item->id?>">
                                    <img src="<?=base_url()?>assets/images/icons/delete.png">
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
