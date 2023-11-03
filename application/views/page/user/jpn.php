<!-- Content Row -->
<div class="row">
    <div class="col-lg-12">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary float-left"><?=@$title; ?></h6>
                <div class="float-right">
                    <a href="#" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#myModalUser">
                        <span class="icon text-white-50">
                            <i class="fas fa-arrow-right"></i>
                        </span>
                        <span class="text">User Baru</span>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <?=get_header_table_custom($model, array('instansi', 'username', 'role_id', 'email', 'password', 'picture_img'), '<th>Aksi</th>');?>
                        </thead>
                        <tbody>
                        <?php
                        if($listData) : 
                            $id=1;
                            foreach($listData as $row) {
                                $user = ($row->role_id=='1') ? 'Administrator' : 'User';
                                echo '<tr>
                                    <td>'.$id.'</td>
                                    <td>'.$row->nama.'</td>
                                    <td>'.$row->divisi.'</td>
                                    <td>'.$row->nohape.'</td>
                                    <td>
                                        <div class="btn-group mb-3" role="group">
                                            <button type="button" data-id="'.$row->id.'" class="btn btn-secondary btnEdit" data-toggle="modal" data-target="#myModalUser">Edit</button>
                                            <button type="button" data-id="'.$row->id.'" class="btn btn-danger btnRemove">Hapus</button>
                                        </div>
                                    </td>
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
<div class="modal fade" id="myModalUser" tabindex="-1" aria-labelledby="myModalUserLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalUserLabel"><?=@$title; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?=form_open('', array('id' => 'formUser', 'role' => 'form'));?>
            
            <?=get_form_input($model, 'username'); ?>
            <?=get_form_input($model, 'email'); ?>
            <?=get_form_input($model, 'nama'); ?>
            <?=get_form_input($model, 'divisi'); ?>
            <!-- <div class="form-group">
                <label>Pangkat</label>
                <input type="text" name="divisi" value="" class="form-control" id="input-divisi">
                <div id="error"></div>
            </div> -->

            <?=get_form_input($model, 'nohape'); ?>
            <!-- <div class="form-group">
                <label>NIP</label>
                <input type="text" name="nohape" value="" class="form-control" id="input-nohape">
                <div id="error"></div>
            </div> -->

            <?=form_hidden('role_id', '5'); ?>
            <?=form_hidden('id', ''); ?>

        <?=form_close();?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="formUser">Submit <?=@$title; ?></button>
      </div>
    </div>

  </div>
</div>

<?php
$Urladd = base_url('user/create');
$Urldetail = base_url('user/detailjpn');
$Urlremove = base_url('user/removejpn');
?>

<script type="text/javascript">
$( document ).ready(function() {
    // $.fn.datepicker.defaults.format = "dd/mm/yyyy";
    $(".datepicker").datepicker({
      format:'dd/mm/yyyy',
    }).datepicker("setDate",'now');

    $('button#formUser').on('click', function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "<?=$Urladd;?>", 
            data: $('form#formUser').serialize(),
            dataType: "json",
            beforeSend : function(xhr, opts){
              $('button#formUser').text('Loading...').prop("disabled", true);
            },
            success: function(data){
                console.log(data, "data");
                $('button#formUser').text('Submit <?=@$title; ?>').prop("disabled", false);
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

        $('#formUser input[name=id]').val(dataId);

        $.get("<?=$Urldetail;?>/" + dataId, function(data, status){
            console.log(data, "data");
            $.each(data.data, function(key, value) {
                if(key == 'username' || key == 'email') {
                    $('#input-' + key).val(value).attr('readonly', true);
                } else {
                    $('#input-' + key).val(value);
                }

                // if(key == 'kategori') {
                //     $('#kategori').val(value).change();
                // } else if(key == 'tgl_permohonan') {
                //     var newValue = new Date(value);
                //     var formattedDate = [newValue.getDate(), newValue.getMonth() + 1, newValue.getFullYear()].join('/');
                //     $('#input-' + key).val(formattedDate).change();
                // }
            });

            // $('#form input[name=id]').val(data.data.kegiatan);
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