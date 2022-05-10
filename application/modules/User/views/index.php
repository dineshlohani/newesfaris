
     <section class=" ">

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="django-messages">

                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid mt-5">
            <div class="row ">
                <div class="col-12 col-md-6 offset-md-3">
                    <?php echo form_open("index")?>
                    <div class="col-lg-12 ">
                            <label>Select</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <select name="batch" class="form-control" required="" id="id_batch">
                                        <option value="">छनौट गर्नुहोस्</option>

                                        <option value="1" selected>वडाकार्यालय</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 ">
                            <label for="email_address_2">वडाकार्यालय </label>
                            <div class="form-group">
                                <div class="form-line">
                                    <select name="ward" class="form-control" required="" id="id_ward_no">

                                        <option value="">Select Ward</option>

                                        <option value="1">
                                            1
                                        </option>

                                        <option value="2">
                                            2
                                        </option>

                                        <option value="3">
                                            3
                                        </option>

                                        <option value="4">
                                            4
                                        </option>

                                        <option value="5">
                                            5
                                        </option>

                                        <option value="6">
                                            6
                                        </option>

                                        <option value="7">
                                            7
                                        </option>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <input class="btn btn-primary btn-block btn-lg" type="submit" name="submit" value='Submit'>
                        </div>
                    <?php form_close()?>
                </div>

            </div>
        </div>

    </section>
</div>

