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
                        <a href="create_ph" class="btn btn-primary btn-icon-split btn-lg">
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
                            <?=get_header_table_custom($model, array('kasus_posisi', 'dokumen'));?>
                        </thead>
                        <tbody>
                        <?php
                        if($listData) : 
                            $id=1;
                            foreach($listData as $row) {
                                echo '<tr>
                                    <td>'.$id.'</td>
                                    <td>'.$row->instansi.'</td>
                                    <td>'.$row->tgl_permohonan.'</td>
                                    <td>'.$row->no_registrasi.'</td>
                                    <td>'.$row->subject.'</td>
                                    <td>'.$row->kategori.'</td>
                                    <td>'.$row->status.'</td>
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