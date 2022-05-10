<section class="content ">

    <div class="container-fluid ">
        <nav aria-label="breadcrumb" class="bg-shadow">
            <ol class="breadcrumb px-3 py-2">
                <li class="breadcrumb-item ml-1"><a href="<?= base_url()?>dashboard">गृह</a></li>
                <li class="breadcrumb-item active">दर्ता सुची</li>
            </ol>
        </nav>
    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="body">
                <div class="row">
                    <div class="col-md-12">
                        <?php if($this->session->userdata('is_muncipality')==1):?>
                            <div class="text-right mb-3" >
                               <!--  <a href="<?= base_url()?>darta-book-excel" class='btn btn-info'><i class='fa fa-file-excel-o'></i> Export Excel</a> -->
                            </div>
                        <?php endif;?>
                    </div>
                    <div class="col-md-12">
                        <table class="table table-responsive-sm table-responsive-md">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">क्र.सं.</th>
                                    <th scope="col">दर्ता नं.</th>
                                    <th scope="col">दर्ता मिति</th>
                                    <th scope="col">पत्र संख्या</th>
                                    <th scope="col">पठाउने कार्यालय वा व्यक्तिको विवरण</th>
                                    <th scope="col">प्राप्त पत्रको विवरण</th>
                                    <th scope="col">बुझिलिनेको नाम</th>
                                    <th style="max-width:15%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if(!isset($darta_list) || $darta_list == FALSE)
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
                                    foreach($darta_list as $data)
                                    {
                                        if(!empty($data->uri))
                                        {
                                            $patra          = Modules::run("Settings/getPatraItemByURI",$data->uri);
                                            $letter_subject = $patra->name;
                                        }
                                        else
                                        {
                                            $letter_subject = $data->letter_subject;
                                        }
                                        $session = Modules::run('Settings/getSession',$data->session_id);
                                        $user = $this->Mdl_user->getById($data->user_id);
                                        ?>
                                        <tr>
                                            <td> <?= $i ?> </td>
                                            <td> <?= $data->darta_no?> </td>
                                            <td> <?= $data->nepali_darta_miti ?></td>
                                            <td> <?= $session->name ?>   </td>
                                            <td> <?= $data->applicant_name ?> </td>
                                            <td> <?= $letter_subject ?> </td>
                                            <td> <?= ($user != FALSE) ? $user->name : '-'?> </td>
                                            <td><a href="<?= base_url()?>darta-book/detail/<?= $data->id?>">
                                                <i class="fa fa-eye fa-2x" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Details"></i>
                                            </a></td>
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
        </div>
    </div>
</section>
