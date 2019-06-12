<div class="container-fluid p-3">

	<div class="mt-3 mb-4">
<a style="padding: 9px 15px; background: #81c784; color: #fff; cursor: pointer; border-radius:3px;"onclick="goBack()"><i class="fa fa-angle-left"></i> Kembali</a>

<script>
function goBack() {
  window.history.back();
}
</script> 
</div>

    <div class="row">
	            
            <div class="col-md-6">
                <div class="card">
					<div class="card-body">
                    <p>Priode : <?php echo date_format(date_create(get_option('buka_timbangan')),"d/m/Y")  ?></p>
                    <p>Nama Penimbang : <?php echo $nama_penimbang ?></p>
					</div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <select id="search_voucher" placeholder="Payment" ></select>
                        <button id="bukaUlang" class="btn btn-success" onclick="current_voucher()"><i class="fa fa-arrow-right"></i> Buka Ulang</button>
                        <div class="search-voucher-error" style="color:red;display:none;">Silahkan pilih kode voucher terlebih dahulu</div>
                    
					<div>
					<br>
                        <h4><label>No DO :</label>
                        <span id="id_current_voucher">#0000000</span></h4>
                    </div>
					
					</div>

                    
                </div>
            </div>
	</div>
	
	<div class="row mt-3">	
	
    <div class="col-md-4 col-sm-4 col-xs-12">	
		<div class="box box-primary">

            <div class="box-header with-border">
                <h3>Timbangan Utama</h3>
            </div>

            <div class="box-body">

                <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="row">


                    
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <div class="form-group">
                            <label>No Plat Kendaraan</label>
                            <?php echo cmb_dinamis('m_kendaraan','timbangan_m_kendaraan','no_plat','uniqid','uniqid') ?>
                        </div>
                    </div>
                    
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Supir</label><br>
                            <input type="text" id="supir" value="" class="form-control" placeholder="masukkan nama supir">
                        </div>
                    </div>
                    
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <input type="radio" checked="checked" name="kondisi" value="0" id="status" onclick="hide_supplier()">Customer
                            <input type="radio" name="kondisi" value="1" id="status" onclick="hide_customer()">Supplier
                        </div>
                    </div>
                    
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div id="form-customer" class="form-group">
                            <label>Customer</label>
                            <?php echo cmb_dinamis('m_customer','timbangan_m_customer','nama','uniqid','uniqid') ?>
                        </div>
                    </div>
                    
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div id="form-supplier" hide class="form-group">
                            <label>Supplier</label>
                            <?php echo cmb_dinamis('m_supplier','timbangan_m_supplier','nama','uniqid','uniqid') ?>
                        </div>
                    </div>

<!-- 
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea id="keterangan" placeholder="Keterangan" class="form-control"></textarea>
                        </div>
                    </div> -->

                </div><!-- row -->
                </div>
            </div><!-- box-body -->
            
        </div><!-- box -->
	</div>
	
	<div class="col-md-8 col-sm-8 col-xs-12">
		<div class="box box-primary">
            
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label>Product</label>
                    <?php echo cmb_dinamis('m_product','timbangan_m_product','nama_product','uniqid','uniqid') ?>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>Potongan (%)</label>
                        <input type="number" max="100" id="persen_potongan" oninput="" placeholder="%" class="form-control angka">
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <label>Nilai Harga / Kg</label>
                        <input id="nilai" oninput="" placeholder="Rp" class="form-control angka">
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <input type="radio" name="kondisi_timbang" value="bruto" id="status_timbang" checked="checked" >Bruto
                    <input type="radio" name="kondisi_timbang" value="tarra" id="status_timbang" >Tarra
                </div>
            </div>
            
            <!-- <div class="row">
                <div class="col" id="col-bruto">
                    <div class="form-group">
                        <label>Bruto (Kg)</label>
                        <input id="bruto" oninput="" placeholder="Kg" class="form-control angka">
                    </div>
                </div>
                
                <div class="col" id="col-tarra">
                    <div class="form-group">
                        <label>Tarra (Kg)</label>
                        <input id="tarra" oninput="" placeholder="Kg" class="form-control angka">
                    </div>
                </div>
            </div> -->
            
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label>Massa (Kg)</label>
                    <input id="massa" oninput="" placeholder="Kg" class="form-control angka">
                </div>
            </div>

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <button id="btn-pilih-meja" class="btn btn-primary ml-3" data-toggle="modal" data-target="#modal-angka-timbangan" >Ambil angka timbangan</button>
                </div>
            </div>

		</div>
	</div>
    <div class="col-md-12">
        <button class="btn btn-success" onclick="masuk_timbangan()"><i class="fa fa-check"></i> Simpan</button>
        <button class="btn btn-danger" onclick="location.reload()"><i class="fa fa-remove"></i> Cancel</button>
    </div>
	
    </div>
	

</div>

<script>
var uniqid=null;

$(document).ready(function() {
        $("#m_kendaraan").selectize();
        $("#m_customer").selectize();
        $("#m_supplier").selectize();
        $("#m_product").selectize();

        $("#form-supplier").hide()
        $("#col-tarra").hide()

        $('.angka').toArray().forEach(function(field){
            new Cleave(field, {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            })
        });

    $.getJSON("<?php echo base_url('timbangan/json_list_timbang'); ?>",function (data) {
        data
        $("#search_voucher").selectize({
           valueField: 'uniqid',
           labelField: 'id_timbang',
           searchField: 'id_timbang',
           options: data.data,
           create: false
       });
    })
   
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
   
   function hide_bruto() {
        $("#col-bruto").hide()
        $("#col-tarra").show()
    }
    
    function hide_tarra() {
        $("#col-bruto").show()
        $("#col-tarra").hide()
    }
</script>


<script>
function current_voucher() {
    uniqid=$("#search_voucher").val()
    $("#id_current_voucher").text($("#search_voucher").text())
    alertify.alert("Berhasil Membuka "+$("#search_voucher").text())
}

function isi_bruto(nilai) {
    $('#bruto').val(nilai)
alert('<?php echo current_time( 'mysql' ) ?>')
}    

function isi_tarra(nilai) {
    $('#tarra').val(nilai)
}

function masuk_timbangan() {
    var kondisi=$("#status").val()
    var data={
        'uniqid'            :   uniqid,
        'kendaraan'         :   $("#m_kendaraan").val(),
        'supir'             :   $("#supir").val(),
        'product'           :   $("#m_product").val(),
        'status_timbang'    :   $("#status_timbang:checked").val(),
        'massa'             :   numeral($('#massa').val()).value(),
        'persen_potongan'   :   numeral($('#persen_potongan').val()).value(),
        'nilai'             :   numeral($('#nilai').val()).value(),

    }

    if (kondisi==0) {
            data.customer=$("#m_customer").val()
        } else {
            data.customer=$("#m_supplier").val()
        }

    alertify.confirm("Apakah anda yakin ?",function (e) {
        if (e) {
            $.post('<?php echo base_url("timbangan/masuktimbangan/"); ?>',data,function (response) {
                alert("Berhasil Menambahkan");
                window.location.reload()
            })  
        } else {
            
        }
    })
    
}    

function tes_confirm(params) {
    alertify.confirm("Apakah anda yakin",function (e) {
        if (e) {
          alert("sdfsdf")  
        } else {
            
        }
    })
}
</script>

