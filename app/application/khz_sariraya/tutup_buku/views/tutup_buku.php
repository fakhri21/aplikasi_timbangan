
<?php
if (!empty($this->session->flashdata('message_success'))) {
  echo '
  <div class="alert alert-success alert-dismissible">
     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
     <h4><i class="icon fa fa-check"></i> Selamat.!</h4>
     '.$this->session->flashdata('message_success').'
 </div>
 ';
}

if (!empty($this->session->flashdata('message_failed'))) {
  echo '
  <div class="alert alert-warning alert-dismissible">
     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
     <h4><i class="icon fa fa-ban"></i> Perhatian.!</h4>
     '.$this->session->flashdata('message_failed').'
 </div>
 ';
}

?>
<div class="container">
	<div class="mt-4">
	 <a style="padding: 9px 15px; background: #81c784; color: #fff; cursor: pointer; border-radius:3px;"onclick="goBack()"><i class="fa fa-angle-left"></i> Kembali</a>

<script>
function goBack() {
  window.history.back();
}
</script> 
</div>
    <div class="box box-primary px-2" style="margin-top: 30px;">
        <div class="box-header">
            <h3 class="display- mb-2">
                Tutup Buku
            </h3>
            <p> Harian    :<?php echo $hari;?></p>
        </div>
        <div class="box-body">
            <div class="row">

                <div class="col card p-3 m-2">
                    <form id="eod" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>tutup_buku/eod">
                        <div class="form-group d-flex flex-column justify-content-center align-items-center">
                            <label>Harian</label>
								<button type="submit" name="buka" class="btn btn-primary btn-block">Buka</button>
								
								<button type="submit" name="hari" class="btn btn-outline-primary btn-block">EOD</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>

    $("#hari").datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
    });

    $("#bulan").datepicker({
        format: 'yyyy-mm-00',
        minViewMode: 1,
        autoclose: true
    });

    $("#tahun").datepicker({
        format: 'yyyy',
        minViewMode: 2,
        autoclose: true
    });


</script>