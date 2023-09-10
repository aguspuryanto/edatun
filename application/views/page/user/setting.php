<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?=@$title; ?></h1>
</div>

<!-- Content Row -->
<div class="row">
    <div class="col-lg-4">
        <div class="card mb-4 mb-xl-0">
            <div class="card-header">Profile Picture</div>
            <div class="card-body text-center">
                <!-- Profile picture image-->
                <img class="img-account-profile rounded-circle mb-2" src="assets/img/illustrations/profiles/profile-1.png" alt="">
                <!-- Profile picture help block-->
                <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                <!-- Profile picture upload button-->
                <button class="btn btn-primary" type="button">Upload new image</button>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card mb-4">
            <div class="card-header">Account Details</div>
            <div class="card-body">
                <?php
                /*<form>
                    <!-- Form Group (username)-->
                    <div class="mb-3">
                        <label class="small mb-1" for="inputUsername">Username</label>
                        <input class="form-control" id="inputUsername" type="text" placeholder="Enter your username" value="username">
                    </div>
                    <!-- Form Row-->
                    <div class="row gx-3 mb-3">
                        <!-- Form Group (first name)-->
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputFirstName">First name</label>
                            <input class="form-control" id="inputFirstName" type="text" placeholder="Enter your first name" value="Valerie">
                        </div>
                        <!-- Form Group (last name)-->
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputLastName">Last name</label>
                            <input class="form-control" id="inputLastName" type="text" placeholder="Enter your last name" value="Luna">
                        </div>
                    </div>
                    <!-- Form Row        -->
                    <div class="row gx-3 mb-3">
                        <!-- Form Group (organization name)-->
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputOrgName">Organization name</label>
                            <input class="form-control" id="inputOrgName" type="text" placeholder="Enter your organization name" value="Start Bootstrap">
                        </div>
                        <!-- Form Group (location)-->
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputLocation">Location</label>
                            <input class="form-control" id="inputLocation" type="text" placeholder="Enter your location" value="San Francisco, CA">
                        </div>
                    </div>
                    <!-- Form Group (email address)-->
                    <div class="mb-3">
                        <label class="small mb-1" for="inputEmailAddress">Email address</label>
                        <input class="form-control" id="inputEmailAddress" type="email" placeholder="Enter your email address" value="name@example.com">
                    </div>
                    <!-- Form Row-->
                    <div class="row gx-3 mb-3">
                        <!-- Form Group (phone number)-->
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputPhone">Phone number</label>
                            <input class="form-control" id="inputPhone" type="tel" placeholder="Enter your phone number" value="555-123-4567">
                        </div>
                        <!-- Form Group (birthday)-->
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputBirthday">Birthday</label>
                            <input class="form-control" id="inputBirthday" type="text" name="birthday" placeholder="Enter your birthday" value="06/10/1988">
                        </div>
                    </div>
                    <!-- Save changes button-->
                    <button class="btn btn-primary" type="button">Save changes</button>
                </form>*/

                // echo json_encode($this->session->userdata('role_id'));
                echo json_encode($dataUser);
                ?>

                <?=form_open('', array('id' => 'formUser', 'role' => 'form'));?>

                    <?=get_form_input($model, 'instansi'); ?>

                    <div class="row">
                        <div class="col-md-6">
                            <?=get_form_input($model, 'username'); ?>
                        </div>
                        <div class="col-md-6">
                            <?=get_form_input($model, 'nama'); ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <?=get_form_input($model, 'divisi'); ?>
                        </div>
                        <div class="col-md-6">
                            <?//=get_form_input($model, 'role_id'); ?>
                            <div class="form-group">
                                <label>Role</label>
                                <?php $options = array(
                                    'OL' => 'Online (Zoom Meeting)',
                                    'OF' => 'Offline',
                                ); ?>
                                <?=form_dropdown('kategori', $options, '', array('class' => 'form-control', 'id' => 'input-kategori'));?>
                                <div id="error"></div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <?=get_form_input($model, 'email'); ?>
                        </div>
                        <div class="col-md-6">
                            <?=get_form_input($model, 'nohape'); ?>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary" id="form-submit">Submit Permohonan</button>

                <?=form_close();?>
            </div>
        </div>
    </div>
</div>

<?php
$Urladd = base_url('user/setting'); ?>

<script type="text/javascript">
$( document ).ready(function() {

    $('button#form-submit').on('click', function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "<?=$Urladd;?>", 
            data: $('form#formUser').serialize(),
            dataType: "json",
            beforeSend : function(xhr, opts){
              // $('#form-submit').text('Loading...').prop("disabled", true);
            },
            success: function(data){
                console.log(data, "data");
                if(data.success == true){
                    setTimeout(function(){
                        window.location.reload();
                    }, 3000);
                } else {
                    $.each(data, function(key, value) {
                        $('#input-' + key).addClass('is-invalid');
                        $('#input-' + key).parents('.form-group').find('#error').html(value);
                    });
                }
            }
        });
    });

    $('#form input').on('keyup', function () { 
        $(this).removeClass('is-invalid').addClass('is-valid');
        $(this).parents('.form-group').find('#error').html(" ");
    });

});
</script>