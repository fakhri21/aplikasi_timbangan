Priode : <?php echo date_format(date_create(get_option('buka_timbangan')),"d/m/Y")  ?>
<br>
Nama Penimbang : <?php echo $nama_penimbang ?> 
    <div class="col">
        <div class="box box-primary">

            <div class="box-header with-border">
                <h3>Timbangan Utama</h3>
            </div>

            <div class="box-body">

                <div class="col-md-6 col-sm-6 col-xs-6">
                <div class="row">


                    
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>No Plat Kendaraan</label>
                            <?php echo cmb_dinamis('m_kendaraan','timbangan_m_kendaraan','no_plat','uniqid','uniqid') ?>
                        </div>
                    </div>
                    
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Customer</label>
                            <?php echo cmb_dinamis('m_customer','timbangan_m_customer','nama_customer','uniqid','uniqid') ?>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Product</label>
                            <?php echo cmb_dinamis('m_product','timbangan_m_product','nama_product','uniqid','uniqid') ?>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Bruto</label>
                            <input id="bruto" oninput="" placeholder="Kg" class="form-control">
                        </div>
                    </div>
                    
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Tarra</label>
                            <input id="tarra" oninput="" placeholder="Kg" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Potongan</label>
                            <input id="persen_potongan" oninput="" placeholder="%" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Jumlah</label>
                            <input id="nilai" oninput="" placeholder="Rp" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea id="keterangan" placeholder="Keterangan" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <button class="btn btn-primary" onclick="hitung_timbangan()"><i class="fa fa-check"></i> Hitung Timbangan</button>
                        <button class="btn btn-success" onclick="masuk_timbangan()"><i class="fa fa-check"></i> Simpan</button>
                        <button class="btn btn-danger" onclick="location.reload()"><i class="fa fa-remove"></i> Cancel</button>
                    </div>

                </div>
                </div><!-- row -->

                <div class="col" id="hasil_timbangan">
                 <div>
                     
                 hasil
                 </div>

                </div>


            </div><!-- box-body -->
            
        </div><!-- box -->
    </div><!-- col -->
</div>


</div>

<script>
$(document).ready(function() {
      $("#m_kendaraan").selectize();
      $("#m_customer").selectize();

        var cleaveNumeral = new Cleave('#nilai', {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand'
        });
   
})


</script>

<script>
function hitung_timbangan() {
    var data={
        'bruto'     :   numeral($('#bruto').val()).value(),
        'tarra'     :   numeral($('#tarra').val()).value(),
        'persen_potongan'  :   numeral($('#persen_potongan').val()).value(),
        'nilai'     :   numeral($('#nilai').val()).value(),

    }

    $.post('<?php echo base_url("timbangan/hitung_timbangan/"); ?>',data,function (response) {
        alertify.success("Berhasil Menambahkan");
        $("#hasil_timbangan").html(response)
    })
}

function masuk_timbangan() {
    var data={
        'kendaraan' :   $("#m_kendaraan").val(),
        'customer'  :   $("#m_customer").val(),
        'product'   :   $("#m_product").val(),
        'bruto'     :   numeral($('#bruto').val()).value(),
        'tarra'     :   numeral($('#tarra').val()).value(),
        'persen_potongan'  :   numeral($('#persen_potongan').val()).value(),
        'nilai'     :   numeral($('#nilai').val()).value(),

    }

    $.post('<?php echo base_url("timbangan/masuktimbangan/"); ?>',data,function (response) {
        alertify.success("Berhasil Menambahkan");
        location.href=response
    })
}    
</script>

