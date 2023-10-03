<!-- Page Heading -->
<!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?=@$title; ?></h1>
</div> -->

<!-- Content Row -->
<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <h6 class="mb-4">Apa itu <?=@$title; ?>?</h6>
                        <p class="text-xs font-weight-bold mb-4"><?=@$title; ?> adalah Jasa Hukum yang diberikan oleh Jaksa Pengacara Negara Kepada Negara atau Pemerintah, dalam bentuk Pendapat Hukum (Legal/Opinion/LO) dan/atau Pendampingan Hukum (Legal Asistance/LA) di Bidang Perdata dan Tata Usaha Negara dan/atau Audit Hukum (Legal Audit) di Bidang Perdata.</p>
                        <a href="create_ph?type=<?=@$title; ?>" class="btn btn-primary btn-icon-split btn-lg">
                            <span class="icon text-white-50">
                                <i class="fas fa-arrow-right"></i>
                            </span>
                            <span class="text">Submit <?=@$title; ?></span>
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
                <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <?=get_header_table_custom($model, ['jenis_permohonan']);?>
                        </thead>
                        <tbody>
                        <?php
                        if($listData) : 
                            $id=1;
                            foreach($listData as $row) {
                                $dokUrl = ($row->dokumen) ? '<a target="_blank" href="'.base_url('permohonan/dokumen/' . $row->dokumen).'" class="btn btn-link btn-block">Dokumen</a>' : '#';
                                echo '<tr>
                                    <td>'.$id.'</td>
                                    <td>'.$row->pemohon.'</td>
                                    <td>'.$row->termohon.'</td>
                                    <td>'.date('d-m-Y', strtotime($row->tgl_permohonan)).'</td>
                                    <td>'.$row->no_registrasi.'</td>
                                    <td>'.$row->subject.'</td>
                                    <td>'.$row->kasus_posisi.'</td>
                                    <td>'.$dokUrl.'</td>
                                    <td>'.$row->status.'</td>
                                    <td><div class="btn-group" role="group">
                                        <a href="' . base_url('permohonan/edit_ph?type=Konsiliasi&row_id='.$row->id) . '" data-id="'.$row->id.'" class="btn btn-secondary btnEdit">Edit</a>
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

<?php
// $Urladd = base_url('permohonan/create');
$Urldetail = base_url('permohonan/view_konsiliasi');
$Urlremove = base_url('permohonan/remove_konsiliasi');
?>

<script type="text/javascript">
$( document ).ready(function() {
    // $.fn.datepicker.defaults.format = "dd/mm/yyyy";
    $(".datepicker").datepicker({
      format:'dd/mm/yyyy',
    }).datepicker("setDate",'now');

    var table = $('#dataTable').DataTable();

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