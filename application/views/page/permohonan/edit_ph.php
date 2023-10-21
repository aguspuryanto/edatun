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
                            <?=get_form_input($model, 'pemohon', array('value' => ($dataEdit->pemohon) ?? '')); ?>
                        </div>
                            
                        <div class="col-md-6">
                            <?=get_form_input($model, 'termohon', array('value' => ($dataEdit->termohon) ?? '')); ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <?=get_form_input($model, 'no_registrasi', array('value' => ($dataEdit->no_registrasi) ?? '')); ?>
                        </div>
                        <div class="col-md-6">
                            <?=get_form_input($model, 'tgl_permohonan', array('value' => ($dataEdit->tgl_permohonan) ?? '', 'class' => 'form-control datepicker', 'id' => 'input-tgl_permohonan')); ?>
                        </div>
                    </div>

                    <?=get_form_input($model, 'subject', array('value' => ($dataEdit->pemohon) ?? '')); ?>
                    <?=get_form_input($model, 'kasus_posisi', array('value' => ($dataEdit->kasus_posisi) ?? '', 'type' => 'textarea', 'rows' => '3', 'cols' => '10')); ?>

                    <?php /*echo get_form_input($model, 'dokumen[]', array('type' => 'file', 'multiple' => 'multiple'));*/ ?>
                    <button type="button" class="btn btn-info addDokumen float-right">Tambah Dokumen</button>
                    <div class="clearfix"></div>

                    <div class="row">
                        <!-- <div id="dokumen" class="col-md-4 form-group">
                            <label>Dokumen</label>
                            <?= form_input(array(
                                'type'  => 'file',
                                'name'  => 'dokumen[]',
                                'id'    => 'input-dokumen',
                                'class' => 'form-control'
                            )); ?>
                        </div> -->
                        <?php
                        if(isset($dataEdit)) {
                            // echo json_encode($dataEdit);
                            $totDok = count((array)json_decode($dataEdit->dokumen));
                            if($totDok > 0) {
                                for($i = 0; $i < $totDok; $i++){
                                    $title = 'Dokumen ' . ($i+1);
                                    if(json_decode($dataEdit->dokumen)[$i] != null){
                                        echo '<div id="dokumen" class="col-md-4 form-group">';
                                        echo '<label>'.$title.'</label>';
                                        echo '<div class="form-control"><a href="' . json_decode($dataEdit->dokumen)[$i] . '">'.$title.'</a> <a class="btn btn-danger float-right" href="#" id="removeDokumen" data-id="'.$i.'"><span class="fa fa-trash"></span></a></div>';
                                        echo '<input type="file" name="dokumen[]" id="input-dokumen" class="form-control">';
                                        echo '</div>';
                                    }
                                }
                            } else {
                                echo '<div id="dokumen" class="col-md-4 form-group">';
                                echo '<label>Dokumen</label>';
                                echo '<input type="file" name="dokumen[]" id="input-dokumen" class="form-control">';
                                echo '</div>';
                            }
                        } else {
                            echo '<div id="dokumen" class="col-md-4 form-group">';
                            echo '<label>Dokumen</label>';
                            echo '<input type="file" name="dokumen[]" id="input-dokumen" class="form-control">';
                            echo '</div>';
                        }
                        ?>
                    </div>
                    
                    <?=form_hidden('jenis_permohonan', ($dataEdit->jenis_permohonan) ?? $_GET['type']); ?>
                    <?=form_hidden('status', ($dataEdit->status) ?? '1'); ?>
                    <?=form_hidden('id', ($dataEdit->id) ?? isset($_GET['row_id'])); ?>
                    <hr>
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
        console.log(form_data, '_form_data');

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
                $('button#form-submit').text('Submit Permohonan').prop("disabled", false);
                if(data.success == true){
                    // alert(data.message);
                    toastr.success(data.message);
                    setTimeout(function(){
                        // window.location.reload();
                        // window.location = '<?=site_url('permohonan/' . strtolower($_GET['type']));?>';
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
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $('button#form-submit').text('Submit Permohonan').prop("disabled", false);
            }
        });
    });

    $('#form input').on('keyup', function () { 
        $(this).removeClass('is-invalid').addClass('is-valid');
        $(this).parents('.form-group').find('#error').html(" ");
    });

    var cloneCount = 1;
    $('button.addDokumen').click(function(){
        var id = cloneCount++;
        $("div#dokumen").clone().attr('id', 'dokumen'+ id).insertAfter('[id^=dokumen]:last');
        $("[id^=dokumen]:last").find("label").html('Dokumen ' + id);
    });

    $(document).on('click', '#removeDokumen', function (e) {
        e.preventDefault();
        var dataId = $(this).attr("data-id");
        console.log(dataId, '_dataId');
        if(dataId == 0){
            // $(this).parents('#dokumen').remove();
        } else {
            // $(this).parents('#dokumen' + dataId).remove();
        }
        $(this).parents('div.form-control').remove();
    });
});
</script>

<?php
$loadcss = <<<EOF
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
EOF;

$loadjs = <<<EOF
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
EOF;

$this->load->vars('_loadcss', $loadcss);
$this->load->vars('_loadjs', $loadjs);
?>