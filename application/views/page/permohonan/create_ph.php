<!-- Content Row -->
<div class="row">
    <div class="col-lg-12">
        <!-- Basic Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><?=@$title; ?></h6>
            </div>
            <div class="card-body">
                <?=form_open('', array('id' => 'form', 'role' => 'form'));?>
                    <div class="row">
                        <div class="col-md-6">
                            <?=get_form_input($model, 'pemohon'); ?>
                        </div>
                            
                        <div class="col-md-6">
                            <?=get_form_input($model, 'termohon'); ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <?=get_form_input($model, 'no_registrasi'); ?>
                        </div>
                        <div class="col-md-6">
                            <?=get_form_input($model, 'tgl_permohonan', array('class' => 'form-control datepicker', 'id' => 'input-tgl_permohonan')); ?>
                        </div>
                    </div>

                    <?=get_form_input($model, 'subject'); ?>
                    <?=get_form_input($model, 'kasus_posisi', array('type' => 'textarea', 'rows' => '3', 'cols' => '10')); ?>

                    <?php /*echo get_form_input($model, 'dokumen[]', array('type' => 'file', 'multiple' => 'multiple'));*/ ?>
                    <div class="form-group">
                        <label>Dokumen</label>
                        <?= form_input(array(
                            'type'  => 'file',
                            'name'  => 'dokumen[]',
                            'id'    => 'input-dokumen',
                            // 'value' => 'john@example.com',
                            'class' => 'form-control'
                        )); ?>
                    </div>
                    <div class="form-group">
                        <label>Dokumen</label>
                        <?= form_input(array(
                            'type'  => 'file',
                            'name'  => 'dokumen[]',
                            'id'    => 'input-dokumen',
                            // 'value' => 'john@example.com',
                            'class' => 'form-control'
                        )); ?>
                    </div>
                    <div class="form-group">
                        <label>Dokumen</label>
                        <?= form_input(array(
                            'type'  => 'file',
                            'name'  => 'dokumen[]',
                            'id'    => 'input-dokumen',
                            // 'value' => 'john@example.com',
                            'class' => 'form-control'
                        )); ?>
                    </div>
                    
                    <?=form_hidden('jenis_permohonan', $_GET['type']); ?>
                    <?=form_hidden('status', '1'); ?>

                    <button type="submit" class="btn btn-primary" id="form-submit">Submit Permohonan</button>
                    <button type="reset" class="btn btn-default">Reset</button>

                <?=form_close();?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$( document ).ready(function() {
    // $.fn.datepicker.defaults.format = "dd/mm/yyyy";
    $(".datepicker").datepicker({
      format:'dd/mm/yyyy',
    }).datepicker("setDate",'now');
    $('#error').html(" ");

    // $('form#form-submit').on('click', function (e) {
    $('form#form').submit(function (e) {
        e.preventDefault();

        var form_data = new FormData(document.getElementById("form"));
        var files = $('#input-dokumen')[0].files[0];
        form_data.append('file',files);

        if(files?.length){
            alert("Please select a file.");
            return;
        }

        $.ajax({
            type: "POST",
            url: "<?=site_url('permohonan/create');?>", 
            // data: $("#form").serialize(),
            data: form_data,
            processData: false,
            contentType: false,
            cache: false,
            dataType: "json",
            beforeSend : function(xhr, opts){
                $('button#form-submit').text('Loading...').prop("disabled", true);
            },
            success: function(data){
                console.log(data, "data");
                if(data.success == true){
                    // alert(data.message);
                    toastr.success(data.message);
                    setTimeout(function(){
                        window.location.reload();
                    }, 3000);
                } else {
                    if(data.success == false) {
                        toastr.error(data.message);
                    } else {
                        $.each(data, function(key, value) {
                            $('#input-' + key).addClass('is-invalid');
                            $('#input-' + key).parents('.form-group').find('#error').html(value);
                        });
                    }
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

<?php
// $loadcss = <<<EOF
// <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css" integrity="sha512-34s5cpvaNG3BknEWSuOncX28vz97bRI59UnVtEEpFX536A7BtZSJHsDyFoCl8S7Dt2TPzcrCEoHBGeM4SUBDBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
// EOF;

// $loadjs = <<<EOF
// <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js" integrity="sha512-LsnSViqQyaXpD4mBBdRYeP6sRwJiJveh2ZIbW41EBrNmKxgr/LFZIiWT6yr+nycvhvauz8c2nYMhrP80YhG7Cw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
// EOF;

// $this->load->vars('_loadcss', $loadcss);
// $this->load->vars('_loadjs', $loadjs);

$loadcss = <<<EOF
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
EOF;

$loadjs = <<<EOF
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
EOF;

$this->load->vars('_loadcss', $loadcss);
$this->load->vars('_loadjs', $loadjs);
?>