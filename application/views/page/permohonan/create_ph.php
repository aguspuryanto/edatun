<!-- Content Row -->
<div class="row">
    <div class="col-lg-12">
        <!-- Basic Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><?=@$title; ?></h6>
            </div>
            <div class="card-body">
                <?=form_open_multipart('permohonan/create_ph', array('id' => 'form', 'role' => 'form'));?>
                    <div class="row">
                        <div class="col-md-6">
                            <!-- <div class="form-group">
                                <label>Pilih Pemohon</label>
                                <?php $options = array(
                                    '' => 'Pilih salah satu',
                                    '047' => 'adminadhikarya - PT ADHI KARYA',
                                    '046' => 'Admin Inalum - PT. Indonesia Asahan Alumunium',
                                    '045' => 'admin ptks - PT. Krakatau Steel',
                                    '044' => 'Tonny Suhartono Zainuddin - PT. Krakatau Steel',
                                    '043' => 'divisi keuangan - PT. Krakatau Steel',
                                    '042' => 'adminpelindo - PT Pelabuhan Indonesia (Persero)',
                                    '041' => 'Admin PT PP - PT. Pembangunan Perumahan (Persero)',
                                    '040' => 'Administratorxx - PT. PLN Persero',
                                ); ?>
                                <?=form_dropdown('instansi', $options, '', array('class' => 'form-control', 'id' => 'input-instansi'));?>
                                <div id="error"></div>
                            </div> -->
                            <?=get_form_input($model, 'instansi'); ?>
                        </div>
                            
                        <div class="col-md-6">
                            <!-- <div class="form-group">
                                <label>Pilih jenis layanan</label>
                                <?php $options = array(
                                    '' => 'Pilih salah satu',
                                    'FAS' => 'Fasilitasi',
                                    'MED' => 'Mediasi',
                                    'KON' => 'Konsiliasi',
                                ); ?>
                                <?=form_dropdown('kategori', $options, '', array('class' => 'form-control', 'id' => 'input-kategori'));?>
                                <div id="error"></div>
                            </div> -->
                            <div class="form-group">
                                <label>Termohon</label>
                                <?= form_input('termohon', '', array('class' => 'form-control', 'id' => 'input-termohon')); ?>
                            </div>
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

                    <?=get_form_input($model, 'dokumen[]', array('type' => 'file')); ?>
                    <?=get_form_input($model, 'dokumen[]', array('type' => 'file')); ?>
                    <?=get_form_input($model, 'dokumen[]', array('type' => 'file')); ?>
                    <?=get_form_input($model, 'dokumen[]', array('type' => 'file')); ?>
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

        var fd = new FormData();
        // var files = $('#input-dokumen[]')[0].files[0];
        var totalfiles = document.getElementById('input-dokumen[]').files.length;
        for (var index = 0; index < totalfiles; index++) {            
            var files = $('#input-dokumen[]')[0].files[index];
            fd.append('file',files);
            // fd.append("input-dokumen[]", document.getElementById('input-dokumen[]').files[index]);
        }

        if(files?.length){
            alert("Please select a file.");
            // return;
        }

        $.ajax({
            type: "POST",
            url: "<?=site_url('permohonan/create_ph');?>", 
            // data: $("#form").serialize(),
            data: fd,
            processData: false,
            contentType: false,
            cache: false,
            dataType: "json",  
            success: function(data){
                console.log(data, "data");
                if(data.success == true){
                    // setTimeout(function(){
                    //     window.location.reload();
                    // }, 3000);
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

<?php
$loadcss = <<<EOF
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css" integrity="sha512-34s5cpvaNG3BknEWSuOncX28vz97bRI59UnVtEEpFX536A7BtZSJHsDyFoCl8S7Dt2TPzcrCEoHBGeM4SUBDBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
EOF;

$loadjs = <<<EOF
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js" integrity="sha512-LsnSViqQyaXpD4mBBdRYeP6sRwJiJveh2ZIbW41EBrNmKxgr/LFZIiWT6yr+nycvhvauz8c2nYMhrP80YhG7Cw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
EOF;

// $this->load->vars('_loadcss', $loadcss);
// $this->load->vars('_loadjs', $loadjs);
?>