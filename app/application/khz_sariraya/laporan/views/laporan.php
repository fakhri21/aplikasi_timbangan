<div class="container">
<div class="mt-4">
<a style="padding: 9px 15px; background: #81c784; color: #fff; cursor: pointer; border-radius:3px;"onclick="goBack()"><i class="fa fa-angle-left"></i> Kembali</a>

<script>
function goBack() {
  window.history.back();
}
</script> 
</div>

    <div class="row">
        <div class="col">
            <div class="box box-primary" style="margin-top: 40px;">
                <div class="box-header">
                    <h3>Laporan Timbang</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form id="laporan_penjualan" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>laporan/pdf_penjualan">
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-xs-12">
                                        <span class="font-weight-light">Laporan Timbang Berdasarkan Tanggal.</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-xs-12">
                                        <span class="font-weight-light">Kosongkan tanggal apabila ingin melihat Timbang yang sedang berjalan.</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="tanggal_awal" >Tanggal Awal</label>
                                            <input class="tanggal form-control datepicker" type="text" name="tanggal_awal" id="tanggal_awal" value="">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-tanggal_akhir">
                                            <label for="tanggal_awal" >Tanggal Akhir</label>
                                            <input class="tanggal form-control datepicker" type="text" name="tanggal_akhir" id="tanggal_akhir" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio1" name="status" class="custom-control-input" value="1" checked>
                                        <label class="custom-control-label" for="customRadio1">Tidak Void</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio2" name="status" class="custom-control-input" value="2">
                                        <label class="custom-control-label" for="customRadio2">Void</label>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <input type="radio" name="kondisi" value="0" id="status" checked>Customer
                                    <input type="radio" name="kondisi" value="1" id="status">Supplier
                                </div>
                       
                                <div class="form-group">
                                    <button class="btn btn-success" onclick="submitform('excel')" >Submit Excel</button>
                                    <button class="btn btn-primary" onclick="submitform('pdf')" >Submit Pdf</button>
                                    <button class="btn btn-primary" onclick="submitform('pdf_serah_terima')" >Serah Terima</button>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>


</body>
</html>
<script>
    $( document ).ready(function() {
        $('#id_jenis').append($("<option></option>")
            .attr("value","")
            .text('All'))
    });

    $(".tanggal").datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true
    });


    function submitform(pilihan) {
        $("#laporan_penjualan").attr( "action", "<?php echo base_url('laporan/') ?>"+pilihan+"_penjualan" );
        $("#laporan_penjualan").submit()
    }
</script>