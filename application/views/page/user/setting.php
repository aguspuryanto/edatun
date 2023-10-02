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
                <?=form_open_multipart('', array('id' => 'formProfile', 'role' => 'form'));?>
                    <!-- Profile picture image-->
                    <img class="img-account-profile rounded-circle mb-2" src="<?=($dataUser->picture_img) ? base_url() . 'uploads/' . $dataUser->picture_img : base_url() . 'assets/img/undraw_profile_1.svg'; ?>" alt="">
                    
                    <div class="form-group">
                        <input type="file" name="picture_img" id="input-picture_img" class="form-control" accept="image/*"/>
                        <div id="error"></div>
                    </div>

                    <!-- Profile picture help block-->
                    <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                    <div id="formError" class="text-danger"></div>
                    <!-- Profile picture upload button-->
                    <button type="submit" class="btn btn-primary" id="form-upload">Upload</button>

                    <?=form_hidden('id', $dataUser->id); ?>
                
                <?=form_close();?>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Account Details</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Ubah Password</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <?php include_once('_account.php'); ?>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <?php include_once('_pwd.php'); ?>
            </div>
        </div>
    </div>
</div>

<?php
$Urladd = base_url('user/setting');
$Urlpicture = base_url('user/picture');

$loadcss = <<<EOF
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
EOF;

$loadjs = <<<EOF
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
EOF;

$this->load->vars('_loadcss', $loadcss);
$this->load->vars('_loadjs', $loadjs);
?>

<script type="text/javascript">
<?php if($this->session->flashdata('success')){ ?>
    toastr.success("<?php echo $this->session->flashdata('success'); ?>");
<?php }else if($this->session->flashdata('error')){  ?>
    toastr.error("<?php echo $this->session->flashdata('error'); ?>");
<?php }else if($this->session->flashdata('warning')){  ?>
    toastr.warning("<?php echo $this->session->flashdata('warning'); ?>");
<?php }else if($this->session->flashdata('info')){  ?>
    toastr.info("<?php echo $this->session->flashdata('info'); ?>");
<?php } ?>
</script>

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
                    // setTimeout(function(){
                    //     window.location.reload();
                    // }, 3000);
                    $('<div class="alert alert-success">' + data.message + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"<span aria-hidden="true">&times;</span></button></div>').insertBefore('#formUser');
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

    $("#input-picture_img").on("change",function(e){
        /* Current this object refer to input element */         
        var $input = $(this);
        var reader = new FileReader(); 
        reader.onload = function(){
            $("img.img-account-profile").attr("src", reader.result).removeClass('rounded-circle');
        } 
        reader.readAsDataURL($input[0].files[0]);
    });

    $('form#formProfile').submit(function (e) {
        e.preventDefault();

        var fd = new FormData();
        var files = $(this).find('#input-picture_img')[0].files[0];
        fd.append('file',files);

        $.ajax({
            type: "POST",
            url: "<?=$Urlpicture; ?>", 
            // data: fd,
            data:new FormData(this),
            contentType: false,
            processData: false,
            cache: false,
            async: false,
            beforeSend : function(xhr, opts){
                $('#form-upload').text('Loading...').prop("disabled", true);
            },
            success: function(data){
                console.log(data, "data");
                if(data.success) {
                    // $('#myModalDokumen').modal('hide'); 
                    setTimeout(function(){
                        window.location.reload();
                    }, 1000);
                } else {
                    $('#formError').html(data.message);
                }
            }
        });
    });
    
    $('button#formPwd').on('click', function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "<?=$Urladd;?>", 
            data: $('form#formPwd').serialize(),
            dataType: "json",
            beforeSend : function(xhr, opts){
              $(this).text('Loading...').prop("disabled", true);
            },
            success: function(data){
                console.log(data, "data");
                if(data.success == true){
                    setTimeout(function(){
                        window.location.reload();
                    }, 3000);
                    // $('<div class="alert alert-success">' + data.message + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"<span aria-hidden="true">&times;</span></button></div>').insertBefore('#formUser');
                } else {
                    $.each(data, function(key, value) {
                        $('#input-' + key).addClass('is-invalid');
                        $('#input-' + key).parents('.form-group').find('#error').html(value);
                    });
                }
            }
        });
    });

});
</script>