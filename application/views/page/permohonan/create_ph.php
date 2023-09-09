<!-- Content Row -->
<div class="row">
    <div class="col-lg-12">
        <!-- Basic Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><?=@$title; ?></h6>
            </div>
            <div class="card-body">
                <?=form_open('permohonan/create_ph', array('id' => 'form', 'role' => 'form'));?>
                    
                    <div class="form-group">
                        <!-- <label><?=form_label($model->rules()[2]['label']); ?></label> -->
                        <label>Pilih mitra</label>
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
                    </div>
                    
                    <div class="form-group">
                        <!-- <label><?=form_label($model->rules()[2]['label']); ?></label> -->
                        <label>Pilih jenis layanan</label>
                        <?php $options = array(
                            '' => 'Pilih salah satu',
                            'LO' => 'Legal Opinion',
                            'LA' => 'Legal Audit',
                            'LA' => 'Legal Asistance',
                            'PH' => 'Pelayanan Hukum',
                            'THL' => 'Tindakan Hukum Lain',
                        ); ?>
                        <?=form_dropdown('layanan', $options, '', array('class' => 'form-control', 'id' => 'input-layanan'));?>
                        <div id="error"></div>
                    </div>

                    <?=get_form_input($model, 'no_registrasi'); ?>
                    <?=get_form_input($model, 'tgl_permohonan'); ?>
                    <?=get_form_input($model, 'subject'); ?>

                <?=form_close();?>
            </div>
        </div>
    </div>
</div>