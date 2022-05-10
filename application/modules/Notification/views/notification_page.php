<section class="content ">

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <?php if(!empty($this->session->flashdata('msg'))): ?>
                    <div  class="alert alert-success alert-dismissible" >    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span><?=$this->session->flashdata('msg');?></span></div>
                <?php endif; ?>
                <?php if(!empty($this->session->flashdata('err_msg'))): ?>
                    <div  class="alert alert-danger alert-dismissible" >    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span><?=$this->session->flashdata('err_msg');?></span></div>
                <?php endif; ?>
            </div>
        </div>
    </div>



        <div class="container-fluid ">
            <nav aria-label="breadcrumb" class="bg-shadow">
                <ol class="breadcrumb px-3 py-2">
                    <li class="breadcrumb-item ml-1">नोटिफिकेसन</li>
                    <li class="breadcrumb-item">सम्पूर्ण</li>
                </ol>
            </nav>
        </div>
        <div class="container-fluid ">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table  table_bordered" >
                                <tbody>
                                    <?php
                                        if($notifications != FALSE):
                                            foreach($notifications as $notify):
                                                $this_darta = Modules::run('DartaChalaniBook/getDartaByFormId',$notify->form_id);
if($this_darta):

                                    ?>
                                    <tr>
                                        <td class="text-center" style="width:3%"><i class="fa fa-bell"></i></td>
                                        <td class="text-center">
                                             <a href="<?= base_url()?>darta-book/detail/<?= $this_darta->id ?>">दर्ता नं  <?= $this_darta->darta_no?> को फायल यो फाँटमा पठाइएको छ
                                            <?php if($notify->is_seen == 0):?>
                                            <span class="badge badge-danger">new</span>
                                            <?php endif; ?>
                                            </a>
                                        </td>
                                        <td class="text-center"><?= $this_darta->transfer_date_nep ?></td>
                                    </tr>
                                    <?php
                                        		endif;
                                        	endforeach;
                                        else:
                                    ?>
                                    <tr>
                                        <td><center>कुनै पनि नोटिफिकेसन छैन</center></td>
                                    </tr>
                                    <?php
                                        endif;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


</section>
</div>
