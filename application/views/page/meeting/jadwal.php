<?php $options = array(
    '001' => 'Kementerian Sekretariat Negara',
    '002' => 'PT ADHI KARYA',
    '003' => 'PT. Indonesia Asahan Alumunium',
    '004' => 'PT. Krakatau Steel',
    '005' => 'PT Pelabuhan Indonesia (Persero)',
    '006' => 'PT. Pembangunan Perumahan (Persero)',
    '007' => 'PT. PLN Persero',
    '008' => 'PT Rajawali Nusantara Indonesia',
    '009' => 'PT Telkom',
); ?>

<!-- Content Row -->
<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <h6 class="mb-4"><?=@$title; ?></h6>
                        <p class="font-weight-bold mb-4">Silakan isi form berikut untuk mengajukan permohonan rapat dengan kami.</p>
                        <a href="create_ph" class="btn btn-primary btn-icon-split btn-lg" data-toggle="modal" data-target="#myModalMeeting">
                            <span class="icon text-white-50">
                                <i class="fas fa-arrow-right"></i>
                            </span>
                            <span class="text">Ajukan <?=@$title; ?></span>
                        </a>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><?=@$title; ?></h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <?=get_header_table_custom($model, []);?>
                        </thead>
                        <tbody>
                        <?php
                        if($listData) : 
                            $id=1;
                            foreach($listData as $row) {
                                $instansi = @$options[$row->instansi] ?: null;
                                $kategori = ($row->kategori=='OL') ? 'Online (Zoom Meeting)' : 'Offline';
                                echo '<tr>
                                    <td>'.$id.'</td>
                                    <td>'.$instansi.'</td>
                                    <td>'.$row->subject.'</td>
                                    <td>'.$kategori.'</td>
                                    <td>'.date('d-m-Y', strtotime($row->tgl_permohonan)).'</td>
                                    <td>'.$row->lokasi.'</td>
                                    <td>'.$row->agenda.'</td>
                                    <td><div class="btn-group" role="group">
                                        <button type="button" data-id="'.$row->id.'" class="btn btn-secondary btnEdit" data-toggle="modal" data-target="#myModalMeeting">Edit</button>
                                        <button type="button" data-id="'.$row->id.'" class="btn btn-danger btnRemove">Hapus</button>
                                    </div></td>
                                </tr>';
                                $id++;
                            }
                        endif;
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="myModalMeeting" tabindex="-1" aria-labelledby="myModalMeetingLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalMeetingLabel"><?=@$title; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?=form_open('', array('id' => 'formMeeting', 'role' => 'form'));?>

            <div class="form-group">
                <label>Instansi</label>
                <?=form_dropdown('instansi', $options, '', array('class' => 'form-control', 'id' => 'input-instansi'));?>
                <div id="error"></div>
            </div>

            <!-- Subyek Masalah -->
            <?=get_form_input($model, 'subject'); ?>

            <!-- Jenis -->
            <?//=get_form_input($model, 'kategori'); ?>
            <div class="form-group">
                <label>Jenis</label>
                <?php $options = array(
                    'OL' => 'Online (Zoom Meeting)',
                    'OF' => 'Offline',
                ); ?>
                <?=form_dropdown('kategori', $options, '', array('class' => 'form-control', 'id' => 'input-kategori'));?>
                <div id="error"></div>
            </div>

            <!-- Tanggal -->
            <?=get_form_input($model, 'tgl_permohonan', array('class' => 'form-control datepicker', 'id' => 'input-tgl_permohonan')); ?>

            <!-- Lokasi -->
            <?=get_form_input($model, 'lokasi'); ?>

            <!-- Agenda -->
            <?=get_form_input($model, 'agenda', array('type' => 'textarea', 'rows' => '3', 'cols' => '10')); ?>

            <?=form_hidden('id', ''); ?>

            <!-- <button type="submit" class="btn btn-primary" id="formMeeting">Simpan Data</button>
            <button type="reset" class="btn btn-default">Kosongkan Data</button> -->
        <?=form_close();?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="formMeeting">Submit <?=@$title; ?></button>
      </div>
    </div>

  </div>
</div>

<?php
$Urladd = base_url('meeting/create');
$Urldetail = base_url('meeting/view');
$Urlremove = base_url('meeting/remove');
?>

<script type="text/javascript">
$( document ).ready(function() {
    // $.fn.datepicker.defaults.format = "dd/mm/yyyy";
    $(".datepicker").datepicker({
      format:'dd/mm/yyyy',
    }).datepicker("setDate",'now');

    var table = $('#dataTable').DataTable();

    $('button#formMeeting').on('click', function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "<?=$Urladd;?>", 
            data: $('form#formMeeting').serialize(),
            dataType: "json",
            beforeSend : function(xhr, opts){
              $('button#formMeeting').text('Loading...').prop("disabled", true);
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

    $(document).on('click', '.btnEdit', function (e) {
        e.preventDefault();
        var dataId = $(this).attr("data-id");
        console.log(dataId, '_dataId');

        $('#formMeeting input[name=id]').val(dataId);

        let promise = new Promise(function(resolve, reject) {
            // resolve(dataId);
        });

        $.get("<?=$Urldetail;?>/" + dataId, function(data, status){
            console.log(data, "data");
            $.each(data.data, function(key, value) {
                if(key == 'kategori') {
                    $('#kategori').val(value).change();
                } else if(key == 'tgl_permohonan') {
                    var newValue = new Date(value);
                    var formattedDate = [newValue.getDate(), newValue.getMonth() + 1, newValue.getFullYear()].join('/');
                    $('#input-' + key).val(formattedDate).change();
                } else {
                    $('#input-' + key).val(value);
                }
            });

            // $('#form input[name=kegiatan]').val(data.data.kegiatan);
        });
    });

    $(document).on('click', '.btnRemove', function (e) {
        e.preventDefault();
        var dataId = $(this).attr("data-id");
        console.log(dataId, '_dataId');

        if (confirm("Apakah anda yakin ingin menghapus data ini?")==true){
            // $(this).closest("tr").remove();
            table.row( $(this).parents('tr') ).remove().draw();
            $.post("<?=$Urlremove;?>/", {id: dataId}, function(result){
                console.log(result, "_result");
            });
        };
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