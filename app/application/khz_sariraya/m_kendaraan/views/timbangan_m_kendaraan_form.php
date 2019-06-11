
<div class="col-md-12" style="margin-top: 30px;">
    <h3>Kelola Kendaraan</h3>
</div>

<div class="col-md-6 col-sm-6 col-xs-12">
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
	    <input type="hidden" name="uniqid" value="<?php echo $uniqid; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo base_url('m_kendaraan') ?>" class="btn btn-default">Cancel</a>
	</form>    
</div>