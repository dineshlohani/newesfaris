
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <?php if(!empty($this->session->flashdata('msg'))): ?>
                        <div  class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span><?=$this->session->flashdata('msg');?></span></div>
                    <?php endif; ?>
                    <?php if(!empty($this->session->flashdata('err_msg'))): ?>
                        <div  class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span><?=$this->session->flashdata('err_msg');?></span></div>
                    <?php endif; ?>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-2">
                            <a href="#">
                                <img src="<?php echo base_url()?>assets/images/icons/logo.png" alt="" style="">
                            </a>
                        </div>
                        <div class="col-md-8">
                            <div style="text-align: center;">
                                <h3 style="color:#000;margin-top: -12px;"><b><?php echo SITE_OFFICE ;?></b></h3>
                                <h2 style="color:#000;margin-top: -8px;">
                                    <?php 
                                        if($this->session->userdata('mode') == "user") {
                                            echo $this->session->userdata('ward_no')?> <b><?= SITE_WARD_OFFICE;
                                        } else {
                                            echo SITE_PALIKA;
                                        }
                                    ?>
                                <h2>
                                <h3>
                                <?php if($this->session->userdata('is_muncipality')==0):?>
                                    <?=  $this->session->userdata('address').','?>
                                <?php else: ?>
                                    <?= SITE_ADDRESS.','?>
                                <?php endif;?>
                               <?php echo SITE_DISTRICT?></h3>
                                <h5><?php echo SITE_STATE?>, नेपाल</h5>
                                <?php //print_r($this->session->userdata()) ?>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <?php if(SITE_PALIKA_LOGO != 'n/a') { ?>
                            <img src="<?=base_url()?>assets/images/icons/<?php echo SITE_PALIKA_LOGO?>" alt="<?php echo SITE_PALIKA_LOGO?>" style =" width:150px;height:127px;float:right;">
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="container-fluid">
            <div class="row">
                <?php if($this->session->userdata('mode') == 'administrator') { ?>
                    <div class="col-lg-6 col-4 mb-4">
                        <?php if(!empty($patra_name)) { ?>
                            <?php foreach($patra_name as $cat) : 
                                $parta_item = $this->Mdl_patra_item->getAllWardSubMenus($cat->id); ?>
                                <h2 class="font-kalimati text-center" style="margin-top: 20px; color:#fff"><?php echo $cat->name?>  <span class="badge badge-success font-kalimati pull-right"><?php echo $cat->cnt?></span></h2>
                                <table class="table table-bordered table-striped">
                                    <tbody>
                                    <?php $i =1; 
                                        foreach($parta_item as $item) : ?>
                                            <tr>
                                                <td class="font-kalimati" style="color:#fff"><?php echo $i++?></td>
                                                <td class="font-kalimati" style="width: 300px;"><a href="<?php echo base_url().$item->uri;?>" style="color:#FFF"><?php echo $item->name?> </a></td>
                                                <td class="font-kalimati" style="width: 130px;"> <a href="<?php echo base_url().$item->uri;?>" class="btn btn-sm btn-info" style="color:#fff"> <i class="fa fa-plus-circle"></i> नया <span class="badge badge-warning" style="border-radius: 50%; color:#fff;font-size: 12px;"><?php echo $item->Total?></span></td>
                                            </tr>
                                        <?php endforeach;?>
                                    </tbody>
                                </table>
                            <?php endforeach;?>
                    </div>
                <?php } } else { ?>
                    <div class="col-lg-6 col-4 mb-4" style="background: #418008">
                        <h3 style="margin-top: 20px; color:#fff" class="text-center">सिफारिसको प्रकार </h3>
                        <div id="accordion" style="margin-bottom: 20px;">
                            <?php foreach($patra_name as $cat) : 
                                $sifaris_count = $this->Mdl_patra_category->getTotalSifirasCount($cat->id);
                                $parta_item = $this->Mdl_patra_item->getAllWardSubMenus($cat->id);
                                print_r($patra_item);
                                ?>
                            <h2 class="font-kalimati"><?php echo $cat->name?>  <span class="badge badge-success font-kalimati pull-right"><?php echo $sifaris_count?></span></h2>
                            <div>
                                <table class="table table-bordered table-striped">
                                    <tbody>
                                    <?php $i =1;if(!empty($parta_item)) : 
                                        foreach($parta_item as $item) : ?>
                                        <tr>
                                            <?php 
                                                $patra_name = $this->Mdl_patra_item->getNameByUri($item->uri);
                                                $countByUri = $this->Mdl_patra_item->getTotalSifirasCountByUri($item->uri);
                                            ?>
                                            <!--<td class="font-kalimati"><?php echo $i++?></td>-->
                                            <td class="font-kalimati" style="width: 300px;"><li> 
                                            <a href="<?php echo base_url().$item->uri;?>"><i class="fa fa-check-circle-o"></i> <?php echo $patra_name->name?> </a>
                                            
                                            </li></td>
                                            <!--<td class="font-kalimati" style="width: 130px;"> <a href="<?php echo base_url().$item->uri;?>" class="btn btn-sm btn-info" style="color:#fff"> <i class="fa fa-plus-circle"></i> नया <span class="badge badge-warning" style="border-radius: 50%; color:#fff;font-size: 12px;"><?php echo $item->Total?></span> </a></td>-->
                                        </tr>
                                    <?php endforeach;endif;?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endforeach;?>
                        </div>
                    </div>
                <?php } ?>
                    <div class="col-md-6">
                        <div class="row">
                            <?php if($this->session->userdata('mode') == 'user') :?>
                            <div class="col-lg-12 col-12 mb-4">
                                <div class=" small-box bg-alt-aqua">
                                    <form class="form-horizontal">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group row">
                                                    <div class="space1"></div>
                                                    <label class="col-sm-4 col-form-label"><span
                                                        class="float-right">नागरिकता नं<span
                                                        class="text-danger">&nbsp;*</span></span></label>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <input type="text" name="ctzn_on" maxlength="10" class="form-control" required value=""/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">
                                                          <span class="float-right">
                                                            सम्बन्धित सिफारिस
                                                            <span class="text-danger">&nbsp;*</span>
                                                        </span>
                                                    </label>    
                                                    <div class="col-sm-6">
                                                        <?php if(!empty($patra_name)) : ?>
                                                            <select class="form-control select2">
                                                                <option value="">सम्बन्धित सिफारिस छान्नुहोस्</option>
                                                                <?php foreach($patra_name as $cat) : ?>
                                                                    <option value="<?php echo $cat->id?>"><?php echo $cat->name?></option>
                                                                <?php  endforeach;?>
                                                            </select>
                                                        <?php endif;?>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">
                                                      <span class="float-right">
                                                        सिफारिसको प्रकार
                                                        <span class="text-danger">&nbsp;*</span>
                                                    </span>
                                                    </label>
                                                    <div class="col-sm-6">
                                                        <select class="form-control select2">
                                                            <option value="">सिफारिसको प्रकार</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <button type="submit" class='btn btn-submit btn-block btn-primary' name="submit" disabled><i class="fa fa-search"></i> खोज्नुहोस</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <?php else : ?>
                            <div class="col-lg-12 col-12 mb-4">
                                <div class=" small-box bg-alt-aqua">
                                    <form class="form-horizontal">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group row">
                                                    <div class="space1"></div>
                                                    <label class="col-sm-4 col-form-label"><span
                                                        class="float-right">नागरिकता नं<span
                                                        class="text-danger">&nbsp;*</span></span></label>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <input type="text" name="ctzn_on" maxlength="10" class="form-control" required value="" disabled/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">
                                                          <span class="float-right">
                                                            सम्बन्धित सिफारिस
                                                            <span class="text-danger">&nbsp;*</span>
                                                        </span>
                                                    </label>    
                                                    <div class="col-sm-6">
                                                        <?php if(!empty($patra_name)) : ?>
                                                            <select class="form-control select2" disabled>
                                                                <option value="">सम्बन्धित सिफारिस छान्नुहोस्</option>
                                                                <?php foreach($patra_name as $cat) : ?>
                                                                    <option value="<?php echo $cat->id?>"><?php echo $cat->name?></option>
                                                                <?php  endforeach;?>
                                                            </select>
                                                        <?php endif;?>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">
                                                      <span class="float-right">
                                                        सिफारिसको प्रकार
                                                        <span class="text-danger">&nbsp;*</span>
                                                    </span>
                                                    </label>
                                                    <div class="col-sm-6">
                                                        <select class="form-control select2" disabled>
                                                            <option value="">सिफारिसको प्रकार</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <button type="submit" class='btn btn-submit btn-block btn-primary' name="submit" disabled><i class="fa fa-search"></i> खोज्नुहोस</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <?php endif?>
                                <div class="col-lg-12 col-12 mb-4">
                                    <div class="small-box bg-alt-yellow">
                                        <a href="<?= base_url()?>land-dashboard">
                                            <div class="inner text-center">
                                                <h5> दर्ता किताब<br>(<?php echo $darta_count?>)</h5>
                                            </div>
                                        </a>
                                        <a href="<?= base_url()?>darta-book" class="small-box-footer">विवरण हेर्नुहोस्  <i
                                        class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-12 mb-4">
                                    <div class="small-box bg-alt-green">
                                        <a href="<?= base_url()?>land-dashboard">
                                            <div class="inner text-center">
                                                <h5>चलानी किताब  <br>(<?php echo $chalani_count?>)</h5>
                                            </div>
                                        </a>
                                        <a href="<?= base_url()?>chalani-book" class="small-box-footer">अगाडी बढ्नुहोस <i
                                            class="fa fa-arrow-circle-right"></i></a>
                                        </div>
                                        <!-- <hr> -->
                                    </div>
                                </div>
                        </div>
                    </div>
            </div>
        <hr>
        <?php //if($this->session->userdata('mode') == 'superadmin') : ?>
        <div class="container-fluid font-kalimati">
            <div class="row">
                <div class="col-6">
                    <div class="small-box bg-alt-aqua">
                        <h5 class="text-center" style="padding-top: 15px;text-decoration: underline;">हाल सम्म दर्ता गरिएको सिफारिस विवरण(पाइ चार्ट)</h5>
                        <div id="chartdiv" style="width: 100%; height: 400px;"></div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="small-box bg-alt-green">
                         <h5 class="text-center" style="padding-top: 15px;text-decoration: underline;">हाल सम्म दर्ता गरिएको सिफारिस विवरण(बार चार्ट)</h5>
                        <div id="chartdiv1" style="width: 100%; height: 400px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="space1"></div>
        <div class="container-fluid font-kalimati">
            <div class="row">
                <div class="col-6">
                    <div class="small-box bg-deep-purple">
                        <h5 class="text-center" style="padding-top: 15px;text-decoration: underline;">हाल सम्म चलानी गरिएको सिफारिस विवरण(पाइ चार्ट)</h5>
                        <div id="chalanidiv" style="width: 100%; height: 400px;"></div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="small-box bg-brown">
                         <h5 class="text-center" style="padding-top: 15px;text-decoration: underline;">हाल सम्म चलानी गरिएको सिफारिस विवरण(बार चार्ट)</h5>
                        <div id="chalanidiv1" style="width: 100%; height: 400px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="space1"></div>
        <?php //endif?>
    </section>
</div>
<script src="<?php echo base_url()?>assets/amchart/amcharts/amchart.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/amchart/amcharts/pie.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/amchart/amcharts/serial.js" type="text/javascript"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
   jQuery(document).ready(function() {
    jQuery( "#accordion" ).accordion({
      collapsible: true,
      active: false,
      clearStyle: true,
      autoHeight: false
    });
});
</script>
<script>
    var sData = JSON.parse('<?php echo $dartajson ; ?>');
    var chart;
    AmCharts.makeChart("chartdiv", {
        "type": "pie",
        "theme": "dark",
        "depth3D":20,
        "radius": 100,
        "fontSize": 12,
        "pieY": "50%",
        "autoMargins": false,
        "dataProvider": sData,
        "titleField": "letter_subject",
        "valueField": "total",
        "colors":[ '#F44336', '#E91E63','#9C27B0','#673AB7','#3F51B5','#2196F3','#03A9F4','#00BCD4','#009688','#4CAF50','#8BC34A'],
        "balloon": {
            "adjustBorderColor": true,
            "color": "#000000",
            "cornerRadius": 5,
            "fillColor": "#e5e5e5"
        },
    });
    AmCharts.ready(function () {
        // SERIAL CHART
        chart = new AmCharts.AmSerialChart();
        chart.dataProvider = sData;
        chart.categoryField = "letter_subject";
        // the following two lines makes chart 3D
        chart.depth3D = 20;
        chart.angle = 10;
        var categoryAxis = chart.categoryAxis;
        categoryAxis.labelRotation = 30;
        categoryAxis.dashLength = 5;
        categoryAxis.gridPosition = "start";
        // value
        var valueAxis = new AmCharts.ValueAxis();
        valueAxis.title = "जम्मा ";
        valueAxis.dashLength = 3;
        chart.addValueAxis(valueAxis);
        // GRAPH
        var graph = new AmCharts.AmGraph();
        graph.valueField = "total";
        graph.colorField = "color";
        graph.balloonText = "<span style='font-size:10px'>[[category]]: <b>[[value]]</b></span>";
        graph.type = "column";
        graph.lineAlpha = 0;
        graph.fillAlphas = 1;
        chart.addGraph(graph);
        // CURSOR
        var chartCursor = new AmCharts.ChartCursor();
        chartCursor.cursorAlpha = 0;
        chartCursor.zoomable = false;
        chartCursor.categoryBalloonEnabled = false;
        chart.addChartCursor(chartCursor);
        // WRITE
        chart.write("chartdiv1");
    });
</script>
<script>
    var cData = JSON.parse('<?php echo $chalanijson; ?>');
    var chart;
    AmCharts.makeChart("chalanidiv", {
        "type": "pie",
        "theme": "dark",
        "depth3D":20,
        "radius": 100,
        "fontSize": 12,
        "pieY": "50%",
        "autoMargins": false,
        "dataProvider": cData,
        "titleField": "letter_subject",
        "valueField": "total",
        "colors":[ '#F44336', '#E91E63','#9C27B0','#673AB7','#3F51B5','#2196F3','#03A9F4','#00BCD4','#009688','#4CAF50','#8BC34A'],
        "balloon": {
            "adjustBorderColor": true,
            "color": "#000000",
            "cornerRadius": 5,
            "fillColor": "#e5e5e5"
        },
    });
    AmCharts.ready(function () {
        // SERIAL CHART
        chart = new AmCharts.AmSerialChart();
        chart.dataProvider = cData;
        chart.categoryField = "letter_subject";
        // the following two lines makes chart 3D
        chart.depth3D = 20;
        chart.angle = 10;
        var categoryAxis = chart.categoryAxis;
        categoryAxis.labelRotation = 30;
        categoryAxis.dashLength = 5;
        categoryAxis.gridPosition = "start";
        // value
        var valueAxis = new AmCharts.ValueAxis();
        valueAxis.title = "जम्मा ";
        valueAxis.dashLength = 3;
        chart.addValueAxis(valueAxis);
        // GRAPH
        var graph = new AmCharts.AmGraph();
        graph.valueField = "total";
        graph.colorField = "color";
        graph.balloonText = "<span style='font-size:10px'>[[category]]: <b>[[value]]</b></span>";
        graph.type = "column";
        graph.lineAlpha = 0;
        graph.fillAlphas = 1;
        chart.addGraph(graph);
        // CURSOR
        var chartCursor = new AmCharts.ChartCursor();
        chartCursor.cursorAlpha = 0;
        chartCursor.zoomable = false;
        chartCursor.categoryBalloonEnabled = false;
        chart.addChartCursor(chartCursor);
        // WRITE
        chart.write("chalanidiv1");
    });
</script>