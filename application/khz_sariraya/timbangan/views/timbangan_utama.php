	
	<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="box-info-penimbang">
			<p>Priode : <?php echo date_format(date_create(get_option('buka_timbangan')),"d/m/Y")  ?></p>
			<p>Nama Penimbang : <?php echo $nama_penimbang ?></p>
		</div>
	</div>
	
	<div class="col-md-8 col-sm-8 col-xs-12">	
		<div class="box box-primary">

            <div class="box-header with-border">
                <h3>Timbangan Utama</h3>
            </div>

            <div class="box-body">

                <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="row">


                    
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label>No Plat Kendaraan</label>
                            <?php echo cmb_dinamis('m_kendaraan','timbangan_m_kendaraan','no_plat','uniqid','uniqid') ?>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div id="form-customer" class="form-group">
                            <label>Customer</label>
                            <?php echo cmb_dinamis('m_customer','timbangan_m_customer','nama','uniqid','uniqid') ?>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <input type="radio" name="kondisi" value="0" id="status" checked onclick="hide_supplier()">Customer
                            <input type="radio" name="kondisi" value="1" id="status" checked onclick="hide_customer()">Supplier
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div id="form-supplier" class="form-group">
                            <label>Supplier</label>
                            <?php echo cmb_dinamis('m_supplier','timbangan_m_supplier','nama','uniqid','uniqid') ?>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Product</label>
                            <?php echo cmb_dinamis('m_product','timbangan_m_product','nama_product','uniqid','uniqid') ?>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label>Bruto (Kg)</label>
                            <input id="bruto" oninput="" placeholder="Kg" class="form-control angka">
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label>Tarra (Kg)</label>
                            <input id="tarra" oninput="" placeholder="Kg" class="form-control angka">
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label>Potongan (%)</label>
                            <input type="number" max="100" id="persen_potongan" oninput="" placeholder="%" class="form-control angka">
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label>Nilai Harga / Kg</label>
                            <input id="nilai" oninput="" placeholder="Rp" class="form-control angka">
                        </div>
                    </div>
<!-- 
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea id="keterangan" placeholder="Keterangan" class="form-control"></textarea>
                        </div>
                    </div> -->

                    <div class="col-md-12">
                        <button class="btn btn-primary" onclick="hitung_timbangan()"><i class="fa fa-check"></i> Hitung Timbangan</button>
                        <button class="btn btn-success" onclick="masuk_timbangan()"><i class="fa fa-check"></i> Simpan</button>
                        <button class="btn btn-danger" onclick="location.reload()"><i class="fa fa-remove"></i> Cancel</button>
                    </div>

                </div>
                </div><!-- row -->
            </div><!-- box-body -->
            
        </div><!-- box -->
	</div>
	
	<div class="col-md-4 col-sm-4 col-xs-12">
		<div class="box-hasil-timbangan">
		<div id="hasil_timbangan">
		</div>
		</div>
	</div>
	</div>
	

</div>

<script>
$(document).ready(function() {
        $("#m_kendaraan").selectize();
        $("#m_customer").selectize();
        $("#m_supplier").selectize();
        $("#m_product").selectize();

        $('.angka').toArray().forEach(function(field){
            new Cleave(field, {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            })
        });
   
})


</script>

<script>
    function hide_supplier() {
        $("#form-supplier").hide()
        $("#form-customer").show()
    }
    
    function hide_customer() {
        $("#form-supplier").show()
        $("#form-customer").hide()
    }
</script>


<script>
function isi_bruto(nilai) {
    $('#bruto').val(nilai)
alert('<?php echo current_time( 'mysql' ) ?>')
}    

function isi_tarra(nilai) {
    $('#tarra').val(nilai)
}

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
    var kondisi=$("#status").val()
    var data={
        'kendaraan' :   $("#m_kendaraan").val(),
        'product'   :   $("#m_product").val(),
        'bruto'     :   numeral($('#bruto').val()).value(),
        'tarra'     :   numeral($('#tarra').val()).value(),
        'persen_potongan'  :   numeral($('#persen_potongan').val()).value(),
        'nilai'     :   numeral($('#nilai').val()).value(),

    }

    if (kondisi==0) {
            data.customer=$("#m_customer").val()
        } else {
            data.customer=$("#m_supplier").val()
        }

    $.post('<?php echo base_url("timbangan/masuktimbangan/"); ?>',data,function (response) {
        alertify.success("Berhasil Menambahkan");
        location.href=response
    })
}    
</script>

