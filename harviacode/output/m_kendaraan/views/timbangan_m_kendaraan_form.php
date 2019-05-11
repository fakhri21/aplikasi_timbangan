<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
    </head>
    <body>
        <h2 style="margin-top:0px">Timbangan_m_kendaraan <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Id Kendaraan <?php echo form_error('id_kendaraan') ?></label>
            <input type="text" class="form-control" name="id_kendaraan" id="id_kendaraan" placeholder="Id Kendaraan" value="<?php echo $id_kendaraan; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">No Plat <?php echo form_error('no_plat') ?></label>
            <input type="text" class="form-control" name="no_plat" id="no_plat" placeholder="No Plat" value="<?php echo $no_plat; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nama Kendaraan <?php echo form_error('nama_kendaraan') ?></label>
            <input type="text" class="form-control" name="nama_kendaraan" id="nama_kendaraan" placeholder="Nama Kendaraan" value="<?php echo $nama_kendaraan; ?>" />
        </div>
	    <div class="form-group">
            <label for="decimal">Nilai Tarra <?php echo form_error('nilai_tarra') ?></label>
            <input type="text" class="form-control" name="nilai_tarra" id="nilai_tarra" placeholder="Nilai Tarra" value="<?php echo $nilai_tarra; ?>" />
        </div>
	    <input type="hidden" name="uniqid" value="<?php echo $uniqid; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('m_kendaraan') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>