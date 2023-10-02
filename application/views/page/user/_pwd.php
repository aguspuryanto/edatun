        <div class="card mb-4">
            <!-- <div class="card-header">Account Details</div> -->
            <div class="card-body">
                <?=form_open('', array('id' => 'formPwd', 'role' => 'form'));?>

                    <div class="row">
                        <div class="col-md-6">
                            <?=get_form_input($model, 'password', array('value' => '')); ?>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Konfirmasi Password</label>
                                <input type="text" name="repassword" value="" class="form-control" id="input-repassword">
                                <div id="error"></div>
                            </div>
                        </div>
                    </div>

                    <?=form_hidden('id', $dataUser->id); ?>
                    <?=form_hidden('type', 'pwd'); ?>

                    <button type="submit" class="btn btn-primary" id="formPwd">Simpan</button>

                <?=form_close();?>
            </div>
        </div>