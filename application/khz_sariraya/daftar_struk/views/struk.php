<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">   
    <title>Faktur</title>
	
	<style>
	*{margin: 3px; padding: 0;}
	body{font-family: 'calibri'; font-size: 13px; }
	.page{width: 595px; height: 420px;  box-sizing: border-box;}
	
	.head{padding: 10px 0px;}
	.head h4{}
	
	.info-faktur{margin: 10px 0px;}
	
	.faktur{ margin: 10px 0px;}
	.faktur table{width: 100%; }
	.thead{border-bottom:1px solid #333;}
	</style>
  </head>
  
  
  <body>
  
  <div class="page">
  
  <div class="head">
  <h2><?php echo  get_option( 'nama_perusahaan' ) ?></h4>
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
	<table>
		<thead>
			<tr>
				<th class="thead">Jam Masuk</th>
				<th class="thead">Jam Keluar</th>
				<th class="thead">No DO</th>
				<th colspan="4" class="thead">Timbangan</th>
			</tr>
			
			<tr>
				<td><?php echo date_format(date_create($print['waktu_order']),"H:i"); ?></td>
				<td>12.00</td>
				<td><?php echo $print['id_timbang']; ?></td>
				<td>
					<p>Berat Bruto</p>
					<p>Berat Tarra</p>
					<p>Berat Netto</p>
					<p>Potongan</p>
					<p>Total Bersih</p>
				
				</td>
				<td>
					<p>:</p>
					<p>:</p>
					<p>:</p>
					<p>:</p>
					<p>:</p>
				</td>
				<td>
					<p><?php echo $print['bruto']; ?></p>
					<p><?php echo $print['tarra']; ?></p>
					<p><?php echo $print['netto']; ?></p>
					<p><?php echo $print['nilai_potongan']; ?></p>
					<p><?php echo $print['total_bersih']; ?></p>
				</td>
				<td>
				<p>Kg</p>
				<p>Kg</p>
				<p>Kg</p>
				<p>Kg</p>
				<p>Kg</p>
				</td>
			</tr>

		</thead>
	</table>
  </div><!-- faktur -->

<br>
<br>
<br>

<div class="keterangan">
<p>Keterangan</p>

<table border="0">
<tr>
<td>Ditimbang</td>
<td style="width: 60px;">&nbsp;</td>
<td>Diketahui</td>
</tr>

<tr>
<td style="padding-top: 50px;">( <?php echo $print['nama_penimbang']?> )</td>
<td style="width: 100px;">&nbsp;</td>
<td style="padding-top: 50px;">(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td>
</tr>
</table>
</div>

<br>
<br>

Cetakan ke : <?php echo $print['status_print'] ?>
</div><!-- page -->
 

</body>
</html>
		