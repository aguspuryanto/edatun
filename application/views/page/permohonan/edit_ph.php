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
                            <?=get_form_input($model, 'tgl_permohonan', array('value' => ($dataEdit->tgl_permohonan) ? date('d/m/Y', strtotime($dataEdit->tgl_permohonan)) : '', 'class' => 'form-control datepicker', 'id' => 'input-tgl_permohonan')); ?>
                        </div>
                    </div>

                    <?=get_form_input($model, 'subject', array('value' => ($dataEdit->subject) ?? '')); ?>
                    <?=get_form_input($model, 'kasus_posisi', array('value' => ($dataEdit->kasus_posisi) ?? '', 'type' => 'textarea', 'rows' => '3', 'cols' => '10')); ?>

                    <?php /*echo get_form_input($model, 'dokumen[]', array('type' => 'file', 'multiple' => 'multiple'));*/ ?>
                    <!-- <button type="button" class="btn btn-info addJaksa float-right" data-toggle="modal" data-target="#exampleModal">Tambah Jaksa</button> -->
                    <button type="button" class="btn btn-info addDokumen float-right">Tambah Dokumen</button>
                    <div class="clearfix"></div>

                    <div class="row">
                        <?php
                        if(isset($dataEdit)) {
                            // echo json_encode($dataEdit);
                            $totDok = count((array)json_decode($dataEdit->dokumen));
                            if($totDok > 0) {
                                for($i = 0; $i < $totDok; $i++){
                                    $idx = ($i!=0) ? $i : '';
                                    $title = 'Dokumen ' . ($idx);
                                    if(json_decode($dataEdit->dokumen)[$i] != null){
                                        echo '<div id="dokumen' . $idx .'" class="col-md-4 form-group">';
                                        echo '<label>'.$title.'</label>';
                                        echo '<div class="form-control"><a target="_blank" href="' . base_url('permohonan/dokumen/' . json_decode($dataEdit->dokumen)[$i]) . '">'.json_decode($dataEdit->dokumen)[$i].'</a> <a class="btn btn-danger float-right" href="#" id="removeDokumen" data-id="'.$i.'"><span class="fa fa-trash"></span></a></div>';
                                        echo '<input type="file" multiple="" name="dokumen[]" id="input-dokumen" class="form-control d-none">';
                                        echo '</div>';
                                    }
                                }
                            } else {
                                echo '<div id="dokumen" class="col-md-4 form-group">';
                                echo '<label>Dokumen</label>';
                                echo '<input type="file" multiple="" name="dokumen[]" id="input-dokumen" class="form-control">';
                                echo '</div>';
                            }
                        } else {
                            echo '<div id="dokumen" class="col-md-4 form-group">';
                            echo '<label>Dokumen</label>';
                            echo '<input type="file" multiple="" name="dokumen[]" id="input-dokumen" class="form-control">';
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Jaksa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?=form_open('', array('id' => 'formJaksa', 'role' => 'form'));?>

            <?=get_form_input($model, 'nama_jaksa'); ?>
            <?=get_form_input($model, 'nip_jaksa'); ?>

            <?=form_hidden('id', ($dataEdit->id) ?? isset($_GET['row_id'])); ?>
        <?=form_close();?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="formJaksa">Tambah Jaksa</button>
      </div>
    </div>

  </div>
</div>

<script type="text/javascript">
$( document ).ready(function() {
    // $.fn.datepicker.defaults.format = "dd/mm/yyyy";
    $(".datepicker").datepicker({
      format:'dd/mm/yyyy',
    });
    $('#error').html(" ");

    const fileInput = document.querySelector("#input-dokumen");
    fileInput.addEventListener("change", event => {
        const files = event.target.files;
        console.log(files[0], '_files');
        // uploadFile(files[0]);
    });

    const uploadFile = file => {
        console.log("Uploading file...");
        const API_ENDPOINT = "https://file.io";
        const request = new XMLHttpRequest();
        const formData = new FormData();

        request.open("POST", API_ENDPOINT, true);
        request.onreadystatechange = () => {
            if (request.readyState === 4 && request.status === 200) {
            console.log(request.responseText);
            }
        };
        formData.append("file", file);
        request.send(formData);
    };

    var row_id = '<?=($dataEdit->id) ?? isset($_GET['row_id']); ?>';
    console.log(row_id, '_row_id');
    // $('form#form-submit').on('click', function (e) {
    $('form#form').submit(function (e) {
        e.preventDefault();

        var filedata = document.getElementById("input-dokumen").files[0];
        console.log(filedata, '_filedata');
        if(filedata?.files?.length){
            alert("Please select a file.");
            return;
        }

        var formData = new FormData(document.getElementById("form"));
        // form_data.append('file',files);
        // console.log(formData, '_form_data');

        $.ajax({
            type: "POST",
            url: "<?=site_url('permohonan/create');?>", 
            // data: $("#form").serialize(),
            data: formData,
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
                        window.location = '<?=site_url('permohonan/' . strtolower($_GET['type']));?>';
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

    $(document).on('click', 'button#formJaksa', function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "<?=site_url('permohonan/add_jaksa');?>", 
            data: $("#formJaksa").serialize(),
            beforeSend : function(xhr, opts){
                $('button#formJaksa').text('Loading...').prop("disabled", true);
            },
            success: function(data){
                console.log(data, "data");
                $('button#formJaksa').text('Tambah Jaksa').prop("disabled", false);
            }
        });
    });

    var cloneCount = $("[id^=dokumen]").length || 1;
    $('button.addDokumen').click(function(){
        var id = cloneCount++;
        $("div#dokumen").clone().attr('id', 'dokumen'+ id).insertAfter('[id^=dokumen]:last');        
        $("[id^=dokumen]:last").find('#input-dokumen').removeClass('d-none');
        $("[id^=dokumen]:last").find('div.form-control').remove();
        $("[id^=dokumen]:last").find("label").html('Dokumen ' + id);
    });

    $(document).on('click', '#removeDokumen', function (e) {
        e.preventDefault();
        var dataId = $(this).attr("data-id");
        console.log(dataId, '_dataId');

        $.ajax({   
            type: "POST",
            data : {row_id: row_id, id: dataId},
            url: "<?=site_url('permohonan/remove_dokumen');?>",   
            success: function(data){
                $("#results").html(data);                       
            }   
        }); 

        $(this).parents('div.form-control').next('#input-dokumen').removeClass('d-none');
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