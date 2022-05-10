<?php
    $action_page = "LetterHeadSetting/create";
?>
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
                        <li class="breadcrumb-item ml-1"><a href="<?= base_url()?>dashboard">गृह</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url()?>abibhahit-pramanpatra/"> Letter-head Setting</a></li>
                    </ol>
                </nav>
            </div>
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="offset-lg-2 col-lg-8">
                            <h2 class="text-center"><span style="text-decoration: underline;">Letter Head Setting</span></h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class=" col-lg-12">
                            <?php echo form_open_multipart($action_page);?>
                            <input type="hidden" name="id" value="<?php echo $letter_head->id?>">
                            <table class="table table-bordered my-4">
                                <tbody>
                                  <tr style="background: #e5e5e5">
                                    <td align="center">Title</td>
                                    <td align="center">Font Size</td>
                                    <td align="center">Font Size(English Fromat)</td>
                                    <td align="center"> Alignment</td>
                                    <td align="center"> Alignment(English Fromat)</td>
                                  </tr>
                                    <tr>
                                       <td>
                                            <?php echo SITE_OFFICE?>
                                        </td>
                                        <td>
                                           <input type="number" class="form-control" placeholder="font-size" name="site_office" value="<?php echo $letter_head->site_office?>">

                                        </td>
                                        <td>
                                           <input type="number" class="form-control" placeholder="font-size" name="site_office_en" value="<?php echo $letter_head->site_office_en?>">
                                           
                                        </td>
                                        <td>
                                          Center
                                       </td>
                                        <td>
                                          Center
                                       </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?php echo SITE_PALIKA?>
                                        </td>
                                        <td>
                                           <input type="number" class="form-control" placeholder="font-size" name="site_palika" value="<?php echo $letter_head->site_palika?>">
                                        </td>
                                        <td>
                                           <input type="number" class="form-control" placeholder="font-size" name="site_palika_en" value="<?php echo $letter_head->site_palika_en?>">
                                        </td>
                                        <td>
                                          Center
                                       </td>
                                        <td>
                                          Center
                                       </td>
                                    </tr>
                                  
                                    <tr>
                                       <td>
                                        <?php echo SITE_WEBSITE?>
                                       </td>
                                       <td>
                                           <input type="number" class="form-control" placeholder="font-size" name="site_website" value="<?php echo $letter_head->site_website?>">
                                       </td>
                                       <td>
                                           <input type="number" class="form-control" placeholder="font-size" name="site_website_en" value="<?php echo $letter_head->site_website_en?>">
                                       </td>
                                       <td>
                                            <select class="form-control" name="site_website_alignment">
                                               <option value="">Select Option</option>
                                               <option value="top-left" <?php if($letter_head->site_email_alignment == 'top-left'){ echo 'selected';}?>>Top Left</option>
                                               <option value="top-right" <?php if($letter_head->site_email_alignment == 'top-right'){ echo 'selected';}?>>Top Right</option>
                                               <option value="center" <?php if($letter_head->site_email_alignment == 'center'){ echo 'selected';}?>>Center</option>
                                               <option value="footer" <?php if($letter_head->site_email_alignment == 'footer'){ echo 'selected';}?>>Footer</option>
                                            </select>
                                       </td>
                                       <td>
                                            <select class="form-control" name="site_website_alignment_en">
                                               <option value="">Select Option</option>
                                               <option value="top-left" <?php if($letter_head->site_email_alignment_en == 'top-left'){ echo 'selected';}?>>Top Left</option>
                                               <option value="top-right" <?php if($letter_head->site_email_alignment_en == 'top-right'){ echo 'selected';}?>>Top Right</option>
                                               <option value="center" <?php if($letter_head->site_email_alignment_en == 'center'){ echo 'selected';}?>>Center</option>
                                               <option value="footer" <?php if($letter_head->site_email_alignment_en == 'footer'){ echo 'selected';}?>>Footer</option>
                                            </select>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                        <?php echo SITE_EMAIL?>
                                       </td>
                                       <td>
                                           <input type="number" class="form-control" placeholder="font-size" name="site_email" value="<?php echo $letter_head->site_email?>">
                                       </td>
                                        <td>
                                           <input type="number" class="form-control" placeholder="font-size" name="site_email_en" value="<?php echo $letter_head->site_email_en?>">
                                       </td>
                                       <td>
                                            <select class="form-control" name="site_email_alignment">
                                               <option value="">Select Option</option>
                                               <option value="top-left" <?php if($letter_head->site_email_alignment == 'top-left'){ echo 'selected';}?>>Top Left</option>
                                               <option value="top-right" <?php if($letter_head->site_email_alignment == 'top-right'){ echo 'selected';}?>>Top Right</option>
                                               <option value="center" <?php if($letter_head->site_email_alignment == 'center'){ echo 'selected';}?>>Center</option>
                                               <option value="footer" <?php if($letter_head->site_email_alignment == 'footer'){ echo 'selected';}?>>Footer</option>
                                            </select>
                                       </td>

                                       <td>
                                            <select class="form-control" name="site_email_alignment_en">
                                               <option value="">Select Option</option>
                                               <option value="top-left" <?php if($letter_head->site_email_alignment_en == 'top-left'){ echo 'selected';}?>>Top Left</option>
                                               <option value="top-right" <?php if($letter_head->site_email_alignment_en == 'top-right'){ echo 'selected';}?>>Top Right</option>
                                               <option value="center" <?php if($letter_head->site_email_alignment_en == 'center'){ echo 'selected';}?>>Center</option>
                                               <option value="footer" <?php if($letter_head->site_email_alignment_en == 'footer'){ echo 'selected';}?>>Footer</option>
                                            </select>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                        <?php echo SITE_SLOGAN?>
                                       </td>
                                       <td>
                                           <input type="number" class="form-control" placeholder="font-size" name="site_slogan" value="<?php echo $letter_head->site_slogan?>">
                                       </td>
                                       <td>
                                           <input type="number" class="form-control" placeholder="font-size" name="site_slogan_en" value="<?php echo $letter_head->site_slogan_en?>">
                                       </td>
                                       <td>
                                            <select class="form-control" name="site_slogan_alignment">
                                               <option value="">Select Option</option>
                                               <option value="top-left" <?php if($letter_head->site_slogan_alignment == 'top-left'){ echo 'selected';}?>>Top Left</option>
                                               <option value="top-right" <?php if($letter_head->site_slogan_alignment == 'top-right'){ echo 'selected';}?>>Top Right</option>
                                               <option value="center" <?php if($letter_head->site_slogan_alignment == 'center'){ echo 'selected';}?>>Center</option>
                                               <option value="footer" <?php if($letter_head->site_slogan_alignment == 'footer'){ echo 'selected';}?>>Footer</option>
                                            </select>
                                       </td>
                                       <td>
                                            <select class="form-control" name="site_slogan_alignment_en">
                                               <option value="">Select Option</option>
                                               <option value="top-left" <?php if($letter_head->site_slogan_alignment_en == 'top-left'){ echo 'selected';}?>>Top Left</option>
                                               <option value="top-right" <?php if($letter_head->site_slogan_alignment_en == 'top-right'){ echo 'selected';}?>>Top Right</option>
                                               <option value="center" <?php if($letter_head->site_slogan_alignment_en == 'center'){ echo 'selected';}?>>Center</option>
                                               <option value="footer" <?php if($letter_head->site_slogan_alignment_en == 'footer'){ echo 'selected';}?>>Footer</option>
                                            </select>
                                       </td>
                                    </tr>

                                    <tr>
                                       <td>
                                        <?php echo SITE_SLOGAN_ENG?>
                                       </td>
                                       <td>
                                           <input type="number" class="form-control" placeholder="font-size" name="site_slogan" value="<?php echo $letter_head->site_slogan?>">
                                       </td>
                                       <td>
                                           <input type="number" class="form-control" placeholder="font-size" name="site_slogan_en" value="<?php echo $letter_head->site_slogan_en?>">
                                       </td>
                                       <td>
                                            <select class="form-control" name="site_slogan_alignment">
                                               <option value="">Select Option</option>
                                               <option value="top-left" <?php if($letter_head->site_slogan_alignment == 'top-left'){ echo 'selected';}?>>Top Left</option>
                                               <option value="top-right" <?php if($letter_head->site_slogan_alignment == 'top-right'){ echo 'selected';}?>>Top Right</option>
                                               <option value="center" <?php if($letter_head->site_slogan_alignment == 'center'){ echo 'selected';}?>>Center</option>
                                               <option value="footer" <?php if($letter_head->site_slogan_alignment == 'footer'){ echo 'selected';}?>>Footer</option>
                                            </select>
                                       </td>
                                        <td>
                                            <select class="form-control" name="site_slogan_alignment_en">
                                               <option value="">Select Option</option>
                                               <option value="top-left" <?php if($letter_head->site_slogan_alignment_en == 'top-left'){ echo 'selected';}?>>Top Left</option>
                                               <option value="top-right" <?php if($letter_head->site_slogan_alignment_en == 'top-right'){ echo 'selected';}?>>Top Right</option>
                                               <option value="center" <?php if($letter_head->site_slogan_alignment_en == 'center'){ echo 'selected';}?>>Center</option>
                                               <option value="footer" <?php if($letter_head->site_slogan_alignment_en == 'footer'){ echo 'selected';}?>>Footer</option>
                                            </select>
                                       </td>
                                    </tr>

                                    <tr>
                                       <td>
                                        <?php echo SITE_PHONE?>
                                       </td>
                                       <td>
                                           <input type="number" class="form-control" placeholder="font-size" name="site_phone" value="<?php echo $letter_head->site_phone?>">
                                       </td>
                                        <td>
                                           <input type="number" class="form-control" placeholder="font-size" name="site_phone_en" value="<?php echo $letter_head->site_phone_en?>">
                                       </td>
                                       <td>
                                            <select class="form-control" name="site_phone_alignment">
                                               <option value="">Select Option</option>
                                               <option value="top-left" <?php if($letter_head->site_phone_alignment == 'top-left'){ echo 'selected';}?>>Top Left</option>
                                               <option value="top-right" <?php if($letter_head->site_phone_alignment == 'top-right'){ echo 'selected';}?>>Top Right</option>
                                               <option value="center" <?php if($letter_head->site_phone_alignment == 'center'){ echo 'selected';}?>>Center</option>
                                               <option value="footer" <?php if($letter_head->site_phone_alignment == 'footer'){ echo 'selected';}?>>Footer</option>
                                            </select>
                                       </td>
                                       <td>
                                            <select class="form-control" name="site_phone_alignment_en">
                                               <option value="">Select Option</option>
                                               <option value="top-left" <?php if($letter_head->site_phone_alignment_en == 'top-left'){ echo 'selected';}?>>Top Left</option>
                                               <option value="top-right" <?php if($letter_head->site_phone_alignment_en == 'top-right'){ echo 'selected';}?>>Top Right</option>
                                               <option value="center" <?php if($letter_head->site_phone_alignment_en == 'center'){ echo 'selected';}?>>Center</option>
                                               <option value="footer" <?php if($letter_head->site_phone_alignment_en == 'footer'){ echo 'selected';}?>>Footer</option>
                                            </select>
                                       </td>
                                    </tr>

                                    <!-- 
                                    <tr>
                                      <td colspan="3" align="center">Letter Head Setting For Ward</td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <?php //echo SITE_OFFICE?>
                                        </td>
                                        <td>
                                           <input type="number" class="form-control" placeholder="font-size" name="site_office" value="<?php //echo $letter_head->site_office?>">
                                        </td>
                                        <td>
                                          Center -->
                                            <!-- <select class="form-control" name="site_office_alignment">
                                               <option value="">Select Option</option>
                                               <option value="top-left" <?php //if($letter_head->site_office_alignment == 'top-left'){ echo 'selected';}?>>Top Left</option>
                                               <option value="top-right" <?php //if($letter_head->site_office_alignment == 'top-right'){ echo 'selected';}?>>Top Right</option>
                                               <option value="center" <?php //if($letter_head->site_office_alignment == 'center'){ echo 'selected';}?>>Center</option>
                                               <option value="footer" <?php //if($letter_head->site_office_alignment == 'footer'){ echo 'selected';}?>>Footer</option>
                                            </select> -->
                                     <!--   </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?php //echo SITE_PALIKA?>
                                        </td>
                                        <td>
                                           <input type="number" class="form-control" placeholder="font-size" name="site_palika" value="<?php //echo $letter_head->site_palika?>">
                                        </td>
                                        <td>
                                          Center -->
                                            <!-- <select class="form-control" name="site_palika_alignment">
                                               <option value="">Select Option</option>
                                               <option value="top-left" <?php //if($letter_head->site_office_alignment == 'top-left'){ echo 'selected';}?>>Top Left</option>
                                               <option value="top-right" <?php //if($letter_head->site_office_alignment == 'top-right'){ echo 'selected';}?>>Top Right</option>
                                               <option value="center" <?php //if($letter_head->site_office_alignment == 'center'){ echo 'selected';}?>>Center</option>
                                               <option value="footer" <?php //if($letter_head->site_office_alignment == 'footer'){ echo 'selected';}?>>Footer</option>
                                            </select> -->
                                      <!--  </td>
                                    </tr>
                                  
                                    <tr>
                                       <td>
                                        <?php //echo SITE_WEBSITE?>
                                       </td>
                                       <td>
                                           <input type="number" class="form-control" placeholder="font-size" name="site_website" value="<?php //echo $letter_head->site_website?>">
                                       </td>
                                       <td>
                                            <select class="form-control" name="site_website_alignment">
                                               <option value="">Select Option</option>
                                               <option value="top-left" <?php //if($letter_head->site_email_alignment == 'top-left'){ echo 'selected';}?>>Top Left</option>
                                               <option value="top-right" <?php //if($letter_head->site_email_alignment == 'top-right'){ echo 'selected';}?>>Top Right</option>
                                               <option value="center" <?php //if($letter_head->site_email_alignment == 'center'){ echo 'selected';}?>>Center</option>
                                               <option value="footer" <?php //if($letter_head->site_email_alignment == 'footer'){ echo 'selected';}?>>Footer</option>
                                            </select>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                        <?php //echo SITE_EMAIL?>
                                       </td>
                                       <td>
                                           <input type="number" class="form-control" placeholder="font-size" name="site_email" value="<?php //echo $letter_head->site_email?>">
                                       </td>
                                       <td>
                                            <select class="form-control" name="site_email_alignment">
                                               <option value="">Select Option</option>
                                               <option value="top-left" <?php //if($letter_head->site_email_alignment == 'top-left'){ echo 'selected';}?>>Top Left</option>
                                               <option value="top-right" <?php //if($letter_head->site_email_alignment == 'top-right'){ echo 'selected';}?>>Top Right</option>
                                               <option value="center" <?php //if($letter_head->site_email_alignment == 'center'){ echo 'selected';}?>>Center</option>
                                               <option value="footer" <?php //if($letter_head->site_email_alignment == 'footer'){ echo 'selected';}?>>Footer</option>
                                            </select>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                        <?php //echo SITE_SLOGAN?>
                                       </td>
                                       <td>
                                           <input type="number" class="form-control" placeholder="font-size" name="site_slogan" value="<?php //echo $letter_head->site_slogan?>">
                                       </td>
                                       <td>
                                            <select class="form-control" name="site_slogan_alignment">
                                               <option value="">Select Option</option>
                                               <option value="top-left" <?php //if($letter_head->site_slogan_alignment == 'top-left'){ echo 'selected';}?>>Top Left</option>
                                               <option value="top-right" <?php //if($letter_head->site_slogan_alignment == 'top-right'){ echo 'selected';}?>>Top Right</option>
                                               <option value="center" <?php //if($letter_head->site_slogan_alignment == 'center'){ echo 'selected';}?>>Center</option>
                                               <option value="footer" <?php //if($letter_head->site_slogan_alignment == 'footer'){ echo 'selected';}?>>Footer</option>
                                            </select>
                                       </td>
                                    </tr>

                                    <tr>
                                       <td>
                                        <?php //echo SITE_SLOGAN_ENG?>
                                       </td>
                                       <td>
                                           <input type="number" class="form-control" placeholder="font-size" name="site_slogan" value="<?php //echo $letter_head->site_slogan?>">
                                       </td>
                                       <td>
                                            <select class="form-control" name="site_slogan_alignment">
                                               <option value="">Select Option</option>
                                               <option value="top-left" <?php //if($letter_head->site_slogan_alignment == 'top-left'){ echo 'selected';}?>>Top Left</option>
                                               <option value="top-right" <?php //if($letter_head->site_slogan_alignment == 'top-right'){ echo 'selected';}?>>Top Right</option>
                                               <option value="center" <?php //if($letter_head->site_slogan_alignment == 'center'){ echo 'selected';}?>>Center</option>
                                               <option value="footer" <?php //if($letter_head->site_slogan_alignment == 'footer'){ echo 'selected';}?>>Footer</option>
                                            </select>
                                       </td>
                                    </tr>
 -->
                               </tbody>
                           </table>

                            <div class="form-group row">
                                <div class="col-sm-6 offset-sm-6 mt-4">
                                    <button type="submit" class='btn btn-block btn-submit btn-primary' name="submit">सम्पादन 
                                        गर्नुहोस्
                                    </button>
                                </div>
                            </div>
                           <?php echo form_close()?>
                       </div>
                    </div>
                </div>
            </div>
        </div>


</section>
</div>
