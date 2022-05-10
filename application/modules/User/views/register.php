
    <section class=" ">

        <div class="container-fluid">
            <div class="row">

            </div>
        </div><div class="container">
        <div class="page-wrapper mb-5 pt-5">
            <main class="main-wrapper my-5">
                <div class="container-fluid my-5">

                    <div class="col-12">
                        <?php if(!empty($this->session->flashdata('msg'))): ?>
                            <div  class="alert alert-success alert-dismissible" >    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span><?=$this->session->flashdata('msg');?></span></div>
                        <?php endif; ?>
                        <?php if(!empty($this->session->flashdata('err_msg'))): ?>
                            <div  class="alert alert-danger alert-dismissible" >    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span><?=$this->session->flashdata('err_msg');?></span></div>

                        <?php endif; ?>
                    </div>

                    <div class="row">
                        <div class="offset-md-4 col-md-8 my-3">
                            <div class="card ">

                                <div class="card-body">
                                    <h5 class="card-title" style="text-align:center;">Register</h5>

                                    <div class="login-form-wrap">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <?php echo form_open('register');?>
                                                    <div class="form-group ">
                                                        <div class="input-group input-group-sm">
                                                            <input type="text" name="name" class="form-control" placeholder="Full Name" required id="id_name" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="input-group input-group-sm">
                                                            <input type="text" name="phone" class="form-control" placeholder="Phone Number" required id="id_phone" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="input-group input-group-sm">
                                                            <input type="email" name="email" class="form-control" placeholder="Email" required id="id_email" />
                                                        </div>
                                                    </div>

                                                    <div class="form-group ">
                                                        <div  style="border: 1px solid lightgrey;border-radius:3px;">
                                                            <div class="input-group" style="margin-left:5px;">
                                                                <span class="input-group-addon">
                                                                  <input type="radio" id="no_muncipality" value="0" name="is_muncipality" required>
                                                                  <label for="no_muncipality"> वडा Login</label>
                                                                </span>
                                                                <span class="input-group-addon">
                                                                  <input type="radio" value="1" id="yes_muncipality" name="is_muncipality" required>
                                                                  <label for="yes_muncipality"> गाउँपालिका/नगरपालिका Login</label>
                                                                </span>
                                                          </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group hidden" id="ward_div">
                                                        <div class="input-group input-group-sm">
                                                            <select name="ward" id="id_ward" class="form-control" >
                                                                <option value="">Ward</option>
                                                                <?php foreach($wards as $ward) : ?>
                                                                    <option value="<?= $ward->id ?>"><?= $ward->name ?></option>
                                                                <?php endforeach;?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group hidden department_div">
                                                        <div class="input-group input-group-sm">
                                                            <select name="department" id="id_department" class="form-control">
                                                                <option value="">Department</option>
                                                                <?php foreach($departments as $department) : ?>
                                                                    <option value="<?= $department->id ?>"><?= $department->name ?></option>
                                                                <?php endforeach;?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group hidden department_div">
                                                        <div class="input-group input-group-sm">
                                                            <span style="font-size:15px;">सचिवालय User</span>
                                                            <label style="font-size:15px;margin-left:10px;">हो</label>
                                                            <input type="radio" name="is_sachib" value="1">
                                                            <label>होइन</label>
                                                            <input type="radio" name="is_sachib" value="0" checked>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="input-group input-group-sm">
                                                            <select name="mode" id="id_mode" class="form-control" required>
                                                                <option value="">Mode</option>
                                                                <option value="superadmin">Super Admin</option>
                                                                <option value="administrator">Admin</option>
                                                                <option value="user">User</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="input-group input-group-sm">
                                                            <input type="text" name="username" class="form-control" placeholder="Username" required id="id_username" />
                                                        </div>
                                                    </div>

                                                    <div class="form-group ">
                                                        <div class="input-group input-group-sm">
                                                            <!--<span class="input-group-addon">
                                                              <em class="fa fa-lock"></em>
                                                            </span> -->
                                                            <input type="password" name="password" class="form-control" placeholder="Password" required id="id_password" />

                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="input-group input-group-sm">
                                                            <!--<span class="input-group-addon">
                                                              <em class="fa fa-lock"></em>
                                                            </span> -->
                                                            <input type="password" name="repassword" class="form-control" placeholder="Retype password" required id="id_repassword" />
                                                            <span id="right" class="fa fa-check" style="display:none;color:green;"></span>
                                                            <span id="wrong" class="fa fa-times" style="display:none;color:red;"></span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group mt-2">
                                                        <button class="btn btn-success btn-sm btn-block" name="submit"
                                                                type="submit">
                                                            Sign Up
                                                        </button>

                                                    </div>
                                                </form>


                                </div>
                            </div>

                        </div>
                    </div>
                </div>
        </div>

    </div>
    </div>
    </main>
    </div>
    </div>

    </section>
</div>
<script type="text/javascript">
    var JQ = jQuery.noConflict();
    JQ(document).ready(function(){
        JQ(document).on("input","#id_repassword",function(){
            var password = JQ("#id_password").val();
            var confirm  = JQ("#id_repassword").val();
            if(password!=confirm)
            {
                JQ("#wrong").show();
                JQ("#right").hide();
            }
            else
            {
                JQ("#right").show();
                JQ("#wrong").hide();
            }
        });

        JQ(document).on('click','input[name="is_muncipality"]',function(){
            if(JQ(this).val()==1)
            {
                JQ(".department_div").show();
                 JQ("#ward_div").hide();
            }
            else {
                JQ(".department_div").hide();
                JQ("#ward_div").show();
            }
        });
    });

</script>
