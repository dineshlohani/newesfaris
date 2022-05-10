<section class="content ">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
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
                    <li class="breadcrumb-item ml-1"><a href="<?= base_url()?>dashboard">गृह</a></li>
                    <li class="breadcrumb-item active">चिठ्ठी पुर्जी दर्ता किताब</li>
                </ol>
            </nav>
        </div>
<div class="container-fluid">
    <div class="card">
        <div class="body">
            <div class="text-left" style="margin-bottom:15px;">
                <a href="<?= base_url()?>Report/chalani_book_excel/<?php echo $uridetails->uri?>" class="btn btn-success"><i class="fa fa-excel-o"></i>Export to Excel</a>
            </div>
            <table class="table table-responsive-sm table-responsive-md">
                <thead class="thead-light">
                <tr>
                    <th scope="col">क्र.सं.</th>
                    <th scope="col">चलानी नं.</th>
                    <th scope="col">चलानी मिति</th>
                    <th scope="col">पत्र संख्या</th>
                    <th scope="col">पठाउने कार्यालय वा व्यक्तिको विवरण</th>
                    <th scope="col">पत्रको विषय</th>
                    <th scope="col">फाँट</th>
                    <th scope="col">बुझिलिनेको नाम</th>
                    <th style="max-width:15%"></th>
                </tr>
                </thead>
                <tbody>
                    <?php
                        if(!isset($chalani_list) || $chalani_list == FALSE)
                        {
                    ?>
                    <tr>
                            <td class="text-danger text-center" colspan="8"><h5>डाटाबेसमा कुनै डाटा छैन | </h5></td>
                    </tr>
                    <?php
                        }
                        else
                        {
                            $i = 1;
                            foreach($chalani_list as $data)
                            {
                                if(!empty($data->uri))
                                {
                                    $patra = Modules::run("Settings/getPatraItemByURI",$data->uri);
                                    $letter_subject = $patra->name;
                                }
                                else
                                {
                                    $letter_subject = $data->letter_subject;
                                }
                                if(!empty($data->department))
                                {
                                    $department_detail  = Modules::run('Settings/getDepartment',$data->department);
                                    $department         = $department_detail->name;
                                }
                                else
                                {
                                    $department         = $data->department_other;
                                }
                                $session = Modules::run('Settings/getSession',$data->session_id);
                               $user = $this->Mdl_user->getById($data->user_id);
                    ?>
                    <tr>
                            <td> <?= $i ?> </td>
                            <td> <?= $data->chalani_no?> </td>
                            <td> <?= $data->nepali_chalani_miti ?></td>
                            <td> <?= $session->name ?>   </td>
                            <td> <?= $data->applicant_name ?> </td>
                            <td> <?= $letter_subject ?> </td>
                            <td> <?= $department ?> </td>
                            <td> <?= ($user != FALSE) ? $user->name : '-'?> </td>
                            <td>
                                <?php if($this->session->userdata('is_muncipality') == 1):?>
                                 <a href="<?= base_url()?>edit-chalani/<?=$data->id ?>">
                                    <i class="fa fa-edit fa-2x" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit"></i>
                                 </a>
                                <?php endif;?>
                                <a href="<?= base_url()?>chalani-book/detail/<?=$data->id ?>">
                                    <i class="fa fa-eye fa-2x" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Details"></i>
                                 </a>
                            </td>
                    </tr>
                    <?php
                                $i++;
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</section>
</div>
<script src="<?=base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?= base_url()?>assets/js/search.js"></script>
