<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">   
    <title>Faktur</title>
	
	<style>
	*{margin: 0; padding: 0;}
	body{font-family: 'calibri'; font-size: 13px;}
	.page{width: 595px; height: 420px; border: 1px solid #aaa; box-sizing: border-box;}
	
	.head{padding: 10px 0px;}
	.head h4{}
	
	.info-faktur{margin: 10px 0px;}
	
	.faktur{ margin: 10px 0px;}
	.faktur table{width: 100%;}
	</style>
  </head>
  
  
  <body>
  
  <div class="page">
  
  <div class="head">
  <h4><?php echo  get_option( 'nama_perusahaan' ) ?></h4>
  <h4><?php echo  get_option( 'slogan_perusahaan' ) ?></h4>
  <p><?php echo  get_option( 'alamat_perusahaan' ) ?></p>
  </div><!-- /head -->
  
  <div class="info-faktur">
  <table border="0">
  
  <tr>
	<td>Tanggal</td>
	<td>:</td>
	<td><?php echo date_format(date_create($print['waktu_order']),"d/m/Y"); ?></td>
  </tr>
  
  <tr>
	<td>No. Kendaraan</td>
	<td>:</td>
	<td><?php echo $print['no_plat']; ?></td>
  </tr>
  
  <tr>
	<td>Kepada</td>
	<td>:</td>
	<td><?php echo $print['nama_customer']; ?></td>
  </tr>
  
  <tr>
	<td>Nama Supir</td>
	<td>:</td>
	<td><?php echo $print['nama_kendaraan']; ?></td>
  </tr>
  
  <tr>
	<td>Nama Produk</td>
	<td>:</td>
	<td><?php echo $print['nama_product']; ?></td>
  </tr>
  
  </table>
  
  </div><!-- /info faktur -->
  
  <div class="faktur">
	<table border="1">
		<thead>
			<tr>
				<th>Jam Masuk</th>
				<th>Jam Keluar</th>
				<th>No DO</th>
				<th colspan="4">Timbangan</th>
			</tr>
			
			<tr>
				<td><?php echo date_format(date_create($print['waktu_order']),"H:i"); ?></td>
				<td>12.00</td>
				<td><?php echo $print['id_penimbang']; ?></td>
				<td>Berat Bruto</td>
				<td>:</td>
				<td><?php echo $print['bruto']; ?></td>
				<td>Kg</td>
			</tr>

		</thead>
	</table>
  </div><!-- faktur -->

<div class="keterangan">
<p>Keterangan</p>

<table border="0">
<tr>
<td>Ditimbang</td>
<td style="width: 60px;">&nbsp;</td>
<td>Diketahui</td>
</tr>

<tr>
<td style="padding-top: 50px;">( Admin )</td>
<td style="width: 100px;">&nbsp;</td>
<td style="padding-top: 50px;">(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td>
</tr>
</table>
</div>


</div><!-- page -->
 

</body>
</html>