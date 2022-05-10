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


                    <li class="breadcrumb-item active">सचिवालय दर्ता किताब</li>



                </ol>
            </nav>
        </div>





<div class="container-fluid">
    <div class="card">
        <div class="body">
            <div class="row">
                <div class="col-lg-11 col-md-12 col-sm-12 col-xs-12">


<div class="container-fluid">
<div class="row">

    <div class="col-lg-2 col-12 mb-sm-3 ">
        <select class="form-control " name="filter" id="filter">
            <option value="search-form">Search</option>
            <option value="date">Filter</option>
        </select>
    </div>

    <div class="col-lg-10 col-12">
        <div class="date-content d-none" >
        <?php echo form_open(base_url().'sachiwalaya-darta-book', array('method'=>'get'));?>
        <div class="row">
            <div class="col-lg-9">
            <div class="input-group mb-2 mr-sm-2" style=" padding-right: 20px;">
                    <input type="text" id="nepaliDate4" name="start_date_nep" class="form-control "
                           placeholder="Start Date">

                    <input type="text" id="nepaliDate5" name="end_date_nep" class="form-control "
                           placeholder="End Date">&nbsp;
                    <div class="">
                        <button type="submit" name="submit" class="btn btn-primary" style="padding:9px 25px !important;">View</button>
                    </div>
                </div>
            </div>
            <?php echo form_close() ;?>
            <div class="col-lg-3">
                <div class="dropdown mb-2 mr-sm-2">
                    <button class="btn btn-secondary dropdown-toggle search-toggle" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        महिना अनुसार
                    </button>
                    <div class="dropdown-menu search" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item"
                           href="<?= base_url()?>sachiwalaya-darta-book?month=3&submit=">पछिल्लो
                            तीन महिनाको</a>
                        <a class="dropdown-item"
                           href="<?= base_url()?>sachiwalaya-darta-book?month=6&submit=">पछिल्लो
                            छ महिनाको</a>
                        <a class="dropdown-item"
                           href="<?= base_url()?>sachiwalaya-darta-book?month=12&submit=">पछिल्लो
                            बाह्र महिनाको</a>

                    </div>
                </div>
            </div>
        </div>

        </div>

        <div class="search-form" >
            <div class="col-12 col-lg-10 mb-2 mr-sm-2">


<form id='id_search_form' method='GET' action='<?= base_url()?>sachiwalaya-darta-book' class="form-inline ">
  <div class="input-group ">
    <input style="" id='search_field' class="form-control" type="search" placeholder="Search" aria-label="Search"
           name='search'
           value=''>
    <div class="input-group-append">
        <button class="btn  btn-success btn-lg btn-sm " name="submit" type="submit" style="border-radius:0 3px 3px 0;">Search
        </button>
    </div>

    <div class="mr-sm-2" style=" padding-right: 20px;">
        <button class="btn ml-lg-2 reset btn-lg btn-secondary" type="button">Reset</button>
    </div>


</div>
</form>

            </div>
        </div>

    </div>
</div>
</div>

                </div>

            </div>
            <?php if($this->session->userdata('is_muncipality')==1):?>
            <div class="text-right" style="margin-bottom:15px;">
                <a href="<?= base_url()?>sachiwalaya-darta" class="btn btn-primary">नयाँ दर्ता</a>
            </div>
            <?php endif;?>
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
                        if(!isset($result) || $result == FALSE)
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
                            foreach($result as $data)
                            {

                                $letter_subject = $data->letter_subject;
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
                            <td>
                                <a href="<?= base_url()?>sachiwalaya-darta-detail/<?= $data->id?>">
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
