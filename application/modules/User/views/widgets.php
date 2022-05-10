        <div class="col-12">
                    <div class="dainik-prashasan mt-3">

                        <div class="row">
                            <?php if($this->session->userdata('is_sachib') == 0):?>

                                <div class="col-lg-3 col-6 mb-4">
                                    <!-- small box -->
                                    <div class="small-box bg-alt-red">
                                        <a href="<?= base_url()?>land-dashboard">
                                            <div class="inner text-center">
                                                <h5>जग्गा सम्बन्धित <br>(<?php echo $jagga_sambandai?>)</h5>
                                            </div>
                                        </a>
                                        <a href="<?= base_url()?>land-dashboard" class="small-box-footer">अगाडी बढ्नुहोस <i
                                                    class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-6 mb-4">
                                    <!-- small box -->
                                    <div class="small-box bg-blue-grey">
                                        <a href="<?= base_url()?>settlement-dashboard">
                                            <div class="inner text-center">
                                                <h5>बसोबास सम्बन्धित <br>(<?php echo $settlement?>)</h5>
                                            </div>
                                        </a>
                                        <a href="<?= base_url()?>settlement-dashboard" class="small-box-footer">अगाडी बढ्नुहोस <i
                                                    class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-6 mb-4">
                                    <!-- small box -->
                                    <div class="small-box bg-brown">
                                        <a href="<?= base_url()?>certificate-dashboard">
                                            <div class="inner text-center">
                                                <h5>नागरिकता सम्बन्धित <br>(<?php echo $certificate?>)</h5>
                                            </div>
                                        </a>
                                        <a href="<?= base_url()?>certificate-dashboard" class="small-box-footer">अगाडी बढ्नुहोस <i
                                                    class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-6 mb-4">
                                    <!-- small box -->
                                    <div class="small-box bg-deep-purple">
                                        <a href="<?= base_url()?>others-dashboard">
                                            <div class="inner text-center">
                                                <h5>अन्य <br>(<?php echo $others?>)</h5>
                                            </div>
                                        </a>
                                        <a href="<?= base_url()?>others-dashboard" class="small-box-footer">अगाडी बढ्नुहोस <i
                                                    class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-6 mb-4">
                                    <!-- small box -->
                                    <div class="small-box bg-alt-aqua">
                                        <a href="home-dashboard">
                                            <div class="inner text-center ">
                                                <h5>घर सम्बन्धित <br>(<?php echo $total_home_recommend?>)</h5>
                                            </div>
                                        </a>
                                        <a href="home-dashboard" class="small-box-footer">अगाडी बढ्नुहोस <i
                                                    class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-6 mb-4">
                                    <!-- small box -->
                                    <div class="small-box bg-alt-green">
                                        <a href="<?= base_url()?>business-dashboard">
                                            <div class="inner text-center">
                                                <h5>संस्था/व्यवसाय सम्बन्धित <br>(<?php echo $total_business?>)</h5>
                                            </div>
                                        </a>
                                        <a href="<?= base_url()?>business-dashboard" class="small-box-footer">अगाडी बढ्नुहोस <i
                                                    class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-6 mb-4">
                                    <!-- small box -->
                                    <div class="small-box bg-alt-yellow">
                                        <a href="<?= base_url()?>property-dashboard">
                                            <div class="inner text-center">
                                                <h5>सम्पत्ति सम्बन्धित<br>(<?php echo $sampati?>)</h5>
                                            </div>
                                        </a>
                                        <a href="<?= base_url()?>property-dashboard" class="small-box-footer">अगाडी बढ्नुहोस <i
                                                    class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                               
                                <?php else:?>
                                <div class="col-lg-3 col-6 mb-4">
                                    <!-- small box -->
                                    <div class="small-box bg-alt-aqua">
                                        <a href="<?= base_url()?>sachiwalaya-darta-book">
                                            <div class="inner text-center ">
                                                <h5>दर्ता किताब</h5>
                                            </div>
                                        </a>
                                        <a href="<?= base_url()?>sachiwalaya-darta-book" class="small-box-footer">अगाडी बढ्नुहोस <i
                                                    class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <?php endif;?>
                        </div>
                    </div>
        </div>