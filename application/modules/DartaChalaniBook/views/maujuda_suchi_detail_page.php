<?php
    if(!empty($result->darta_documents))
    {
        $docs = explode('+',$result->darta_documents);
    }
    $darta_type = $renew = $work_type = $service_type =  '-';
    if($maujuda_detail->darta_type == 'pan')
    {
        $darta_type = "पान दर्ता";
    }
    else if($maujuda_detail->darta_type == 'vat')
    {
        $darta_type = "भ्याट दर्ता";
    }
    if($maujuda_detail->is_renewed == 'yes')
    {
        $renew = "छ";
    }
    else if($maujuda_detail->is_renewed == 'no')
    {
        $renew = "छैन";
    }
    if(!empty($maujuda_detail->work_type))
    {
        $work = Modules::run('Settings/getWork',$maujuda_detail->work_type);
        $work_type = $work->name;
    }
    if(!empty($maujuda_detail->service_type))
    {
        $service = Modules::run('Settings/getService',$maujuda_detail->service_type);
        $service_type = $service->name;
    }
    $session = Modules::run('Settings/getSession',$result->session_id);
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
                    <li class="breadcrumb-item ml-1"><a href="<?= base_url()?>dashboard">गृह</a></li>


                    <li class="breadcrumb-item"><a href="<?= base_url()?>darta-book">चिठ्ठी पुर्जी दर्ता किताब</a></li>

                    <li class="breadcrumb-item active">विवरण</li>

                </ol>
            </nav>
        </div>
    <div class="container-fluid ">
    <div class="card">
        <div class="card-body">
            <?php if(!empty($this->session->userdata('department'))) :?>
                <?php
                    $color= '';
                    if($result->is_complete == 1)
                    {
                        $color = '#0be629';
                    }
                    else
                    {
                        if($result->letter_type == 'deadlined')
                        {
                            $days = calculateDays($result->deadline_eng, time());
                            if($days < 7)
                            {
                                $color = "red";
                            }
                            else {
                                $color = "yellow";
                            }
                        }
                        else {
                            $color = "yellow";
                        }
                    }
                ?>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <span class="circle" style="background-color:<?= $color?>"></span>
                    </div>
                </div>
            <?php endif;?>
            <div class="row">
                <div class="offset-lg-2 col-lg-8">
                    <table class="table table-bordered my-4">
                        <tbody>
                        <tr>
                            <td>
                                दर्ता नं
                            </td>
                            <td>
                                <?= $result->darta_no ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                दर्ता मिति
                            </td>
                            <td><?= $result->nepali_darta_miti ?></td>
                        </tr>

                        <tr>
                            <td>
                                पत्र संख्या
                            </td>
                            <td><?= $session->name ?></td>
                        </tr>

                        <tr>
                            <td>
                                संस्था / फर्मको नाम
                            </td>
                            <td><?= $result->applicant_name ?></td>
                        </tr>
                        <tr>
                            <td>सम्पर्क व्यक्तिको नाम</td>
                            <td><?= $maujuda_detail->contact_name?></td>
                        </tr>
                        <tr>
                            <td>सम्पर्क नं</td>
                            <td><?= $maujuda_detail->contact_number?></td>
                        </tr>
                        <tr>
                            <td>
                                निवेदन दर्ता मिति
                            </td>
                            <td><?= $maujuda_detail->niwedan_darta_miti_nep ?></td>
                        </tr>
                        <tr>
                            <td>
                                संस्था दर्ता नं
                            </td>
                            <td><?= $maujuda_detail->sanstha_darta_no ?></td>
                        </tr>
                        <tr>
                            <td>पान / भ्याट दर्ता</td>
                            <td><?= $darta_type ?></td>
                        </tr>
                        <tr>
                            <td>पान / भ्याट नं</td>
                            <td><?= $maujuda_detail->pan_vat_no ?></td>
                        </tr>
                        <tr>
                            <td>संस्था दर्ता नवीकरण</td>
                            <td><?= $renew ?></td>
                        </tr>
                        <tr>
                            <td>कामको विवरण</td>
                            <td><?= $work_type?></td>
                        </tr>
                        <tr>
                            <td>मालसामान / सेवाको प्रकृति</td>
                            <td><?= $service_type ?></td>
                        </tr>
                        <tr>
                            <td>कार्यानुभव</td>
                            <td><?= $maujuda_detail->karyanubhab?></td>
                        </tr>
                        <tr>
                            <td>काम गर्न चाहेको लक्षित समूह</td>
                            <td><?= $maujuda_detail->lakshit_group?></td>
                        </tr>

                        <tr>
                            <td>
                                बुझिलिनेको नाम
                            </td>
                            <td> <?= ($user != FALSE) ? $user->name : '-'?> </td>
                        </tr>
                        <tr>
                            <td>कागजातहरु</td>
                            <td>
                                <?php
                                    if(!empty($result->darta_documents)):
                                        foreach($docs as $doc):
                                 ?>
                                    <a href="<?= base_url()?>assets/documents/darta_direct/<?=$doc?>" target="_blank"><?= $doc?></a>
                                 <?php
                                        endforeach;
                                    else:
                                        echo "-";
                                    endif;
                                  ?>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>


</section>
</div>
<script>
    jQuery(document).ready(function(){
        jQuery(document).on('click','#submit_darta',function(){
            var department  = jQuery('select[name=department]').val() || 0;
            var is_complete = 0;
            if(jQuery("#is_complete").is(":checked")== true)
            {
                is_complete = 1;
            }
            if(department != 0 && is_complete != 0)
            {
                event.preventDefault();
                alert('स्थानान्तरण वा काम सम्पन्न मात्र गर्नुहोला |');
            }
        });
    });
</script>
