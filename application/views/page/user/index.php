<!-- Page Heading -->
<!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?=@$title; ?></h1>
</div> -->

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
                            <?=get_header_table_custom($model, array('divisi', 'password', 'picture_img'));?>
                        </thead>
                        <tbody>
                        <?php
                        if($listData) : 
                            $id=1;
                            foreach($listData as $row) {
                                $user = ($row->role_id=='1') ? 'Administrator' : 'User';
                                echo '<tr>
                                    <td>'.$id.'</td>
                                    <td>'.$row->instansi.'</td>
                                    <td>'.$row->username.'</td>
                                    <td>'.$user.'</td>
                                    <td>'.$row->nama.'</td>
                                    <td>'.$row->email.'</td>
                                    <td>'.$row->nohape.'</td>
                                    <td>#</td>
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

            <div class="form-group">
                <label>Instansi</label>
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
                <?=form_dropdown('instansi', $options, '', array('class' => 'form-control', 'id' => 'input-instansi'));?>
                <div id="error"></div>
            </div>
            
            <?=get_form_input($model, 'username'); ?>
            <?=get_form_input($model, 'nama'); ?>
            <?=get_form_input($model, 'divisi'); ?>

            <!-- Role -->
            <div class="form-group">
                <label>Role</label>
                <?php $options = array(
                    '1' => 'Administrator',
                    '2' => 'User',
                ); ?>
                <?=form_dropdown('role_id', $options, '', array('class' => 'form-control', 'id' => 'input-role_id'));?>
                <div id="error"></div>
            </div>
            
            <?=get_form_input($model, 'email'); ?>

            <?=get_form_input($model, 'nohape'); ?>

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