<?php
    if(!empty($result->uri))
    {
        $patra_detail = Modules::run("Settings/getPatraItemByURI",$result->uri);
        $letter_subject = $patra_detail->name;
    }
    else
    {
        $letter_subject = $result->letter_subject;
        
    }
    if(!empty($result->chalani_documents))
    {
        $docs = explode('+',$result->chalani_documents);
    }
    $current_session    = Modules::run('Settings/getCurrentSession',$result->session_id);
    if(!empty($result->department))
    {
        $department_detail  = Modules::run('Settings/getDepartment',$result->department);
        $department         = $department_detail->name;
    }
    else
    {
        if(!empty($result->department_other))
        {
            $department         = $result->department_other;
        }
        else {
            $department         =  "-";
       }

    }
    if(!empty($result->office))
    {
        $this_office = Modules::run('Settings/getOffice',$result->office);
        $office      = $this_office->name;
    }
    else {
        $office      = "-";
    }
    $user = $this->Mdl_user->getById($result->user_id);
?>
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
                    <li class="breadcrumb-item ml-1"><a href="<?= base_url()?>dashboard">?????????</a></li>


                    <li class="breadcrumb-item"><a href="<?= base_url()?>chalani-book">?????????????????? ?????????????????? ??????????????? ???????????????</a></li>

                    <li class="breadcrumb-item active">???????????????</li>

                </ol>
            </nav>
        </div>





<div class="container-fluid ">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="offset-lg-2 col-lg-8">
                    <table class="table table-bordered my-4">
                        <?php if($this->session->userdata('is_muncipality') == 1) :?>
                            <tbody>
                            <tr>
                                <td>
                                    ??????????????? ??????
                                </td>
                                <td>
                                    <?= $result->chalani_no ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    ??????????????? ????????????
                                </td>
                                <td><?= $result->nepali_chalani_miti ?></td>
                            </tr>

                            <tr>
                                <td>
                                    ???????????? ??????????????????
                                </td>
                                <td><?= $current_session->name ?></td>
                            </tr>
                             <?php if(empty($result->uri)):?>
                            <tr>
                                <td>
                                    ?????????????????? ????????????
                                </td>
                                <td><?= $result->patra_miti_nep ?></td>
                            </tr>
                             <?php endif;?>
                            <tr>
                                <td>
                                    ?????????????????? ????????????
                                </td>
                                <td><?= $letter_subject ?></td>
                            </tr>
                            <tr>
                                <td>
                                    ???????????? ??????????????? ?????????????????????????????? ?????????
                                </td>
                                <td><?= $result->applicant_name ?></td>
                            </tr>
                            <?php if(empty($result->uri)):?>
                            <tr>
                                <td colspan="2"  class="text-center"><b>???????????? ?????????????????? ???????????????</b></td>
                            </tr>
                            <tr>
                                <td>
                                    ?????????
                                </td>
                                <td><?= $result->patra_wahak_naam ?></td>
                            </tr>
                            <tr>
                                <td>
                                    ????????????????????? ??????
                                </td>
                                <td><?= $result->patra_wahak_contact ?></td>
                            </tr>
                            <tr>
                                <td>???????????????????????????</td>
                                <td>
                                
                                <?php
                                    if(!empty($result->chalani_documents)):
                                        foreach($docs as $doc):
                                 ?>
                                    <a href="<?= base_url()?>assets/documents/chalani_direct/<?=$doc?>" target="_blank"><?= $doc?></a>
                                 <?php
                                        endforeach;
                                    else:
                                        echo "-";
                                    endif;
                                  ?>
                                </td>
                            
                            </tr>
                            <?php endif;?>
                            </tbody>
                        <?php else: ?>
                            <tbody>
                            <tr>
                                <td>
                                    ??????????????? ??????
                                </td>
                                <td>
                                    <?= $result->chalani_no ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    ??????????????? ????????????
                                </td>
                                <td><?= $result->nepali_chalani_miti ?></td>
                            </tr>

                            <tr>
                                <td>
                                    ???????????? ??????????????????
                                </td>
                                <td><?= $current_session->name ?></td>
                            </tr>

                            <tr>
                                <td>
                                    ????????????????????? ????????? ??????????????????
                                </td>
                                <td><?= $result->applicant_name ?></td>
                            </tr>

                            <tr>
                                <td>
                                    ?????????????????? ????????????
                                </td>
                                <td><?= $result->letter_subject ?></td>
                            </tr>

                            <tr>
                                <td>
                                    ????????????
                                </td>
                                <td><?= $department ?></td>
                            </tr>
                            <tr>
                                <td>
                                    ????????????????????????
                                </td>
                                <td><?= $office?></td>
                            </tr>
                            <tr>
                                <td>
                                    ?????????????????????????????? ?????????
                                </td>
                                <td> <?= ($user != FALSE) ? $user->name : '-'?> </td>
                            </tr>
                            <?php if(empty($result->uri)): ?>
                        <tr>
                            <td>???????????????????????????</td>
                            <td>
                                <?php
                                    if(!empty($result->chalani_documents)):
                                        foreach($docs as $doc):
                                 ?>
                                    <a href="<?= base_url()?>assets/documents/chalani_direct/<?=$doc?>" target="_blank"><?= $doc?></a>
                                 <?php
                                        endforeach;
                                    else:
                                        echo "-";
                                    endif;
                                  ?>
                            </td>
                        </tr>
                        <?php endif; ?>
                            </tbody>
                        <?php endif; ?>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


</section>
</div>
