<section class="content ">
    <div class="container-fluid ">
        <nav aria-label="breadcrumb" class="bg-shadow">
            <ol class="breadcrumb px-3 py-2">
                <li class="breadcrumb-item ml-1"><a href="<?= base_url()?>dashboard">गृह</a></li>
                <li class="breadcrumb-item active">चलानी  रिपोर्ट</li>
            </ol>
        </nav>
    </div>
        <div class="container-fluid">
            <div class="card">
                <div class="body">

                    <div class="row">
                        <div class="col-lg-3">
                            <div class="input-group ">
                                <input type="text" name="from_date" class="form-control ndp-nepali-calendar"  id="nepaliDate5" value="<?php echo !empty($this->input->post('from_date'))?$this->input->post('from_date'):'';?>">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="input-group ">
                               <input type="text" name="to_date" class="form-control ndp-nepali-calendar"  id="nepaliDate4" value="<?php echo !empty($this->input->post('to_date'))?$this->input->post('to_date'):'';?>">
                            </div>
                        </div>
                        <!-- <div class="col-lg-2">
                            <select class="form-control select2" name="sifaris_type">
                                <option value="">सिरफिसको किसिम</option>
                                <?php 
                                //if(!empty($patra_item)) : 
                                    //foreach ($patra_item as $key => $patra) : ?>
                                        <option value="<?php //echo $patra->uri?>"><?php //echo $patra->name?></option>
                                <?php //endforeach; endif;?>
                            </select>
                        </div> -->
                        <?php if($this->session->userdata('mode') == 'superadmin') { ?>
                           <div class="col-lg-4">
                            <select class="form-control select2 ward_no" name="ward_no" id="ward_no">
                                <option value="">वडा चयन गर्नुहोस</option>
                                <?php if(!empty($ward)) : 
                                    foreach ($ward as $key => $w) : ?>
                                        <option value="<?php echo $w->ward?>"><?php echo $w->ward?></option>
                                    <?php endforeach; endif;?>
                                </select>
                            </div>
                        <?php } ?>
                       

                        <div class="col-lg-2">
                            <button type="buttion" name="submit" class="btn btn-info search" style="padding:9px 25px !important;"><i class="fa fa-search"></i> Search</button>
                            
                        </div>
                       
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <hr>
                           <div class="search_report">
                                <table class="table table-responsive-sm table-responsive-md table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">क्र.सं.</th>
                                            <th scope="col">सिरफिसको किसिम.</th>
                                            <th scope="col">पत्रको विषय</th>
                                            <th scope="col">चलानी संख्या </th>
                                            <th scope="col"># </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; if(!empty($item_count)) :
                                          foreach($item_count as $key => $darta) :
                                            ?>
                                            <tr>
                                                <td><?php echo  $i++?></td>
                                                <td><?php echo  $darta['category']?></td>
                                                <td><?php echo  $darta['name']?></td>
                                                <td><?php echo  $darta['totalcount']?></td>
                                                <td>
                                                    <?php if($darta['totalcount'] > 0 ): ?>
                                                    <a href="" class="btn btn-info" style="color:#fff">सुची हेर्नुहोस्</a>
                                                <?php endif;?>
                                                </td>
                                            </tr>
                                        <?php endforeach;endif;?>
                                    </tbody>
                                </table>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
</div>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('click', '.search', function(){
            var obj = $(this);
            var from_date = $('#nepaliDate5').val();
            var to_date = $('#nepaliDate4').val();
            var ward_no = $('#ward_no').val();
            $.ajax({
                url:"<?php echo base_url()?>search-chalani-report",
                method:"POST",
                data:{
                    from_date:from_date,
                    to_date:to_date,
                    ward_no:ward_no,
                },
                beforeSend: function () {
                    obj.html('<i class="fa fa-spinner fa-spin"></i> <i class="fa fa-search"></i>');
                },
                success:function(resp){
                   
                    if(resp.status == 'success') {
                        $('.search_report').empty().html(resp.data);
                        obj.html(' <i class="fa fa-search"></i> खोज्नुहोस');
                    }
                }
            }); 
         });
    });
</script>
