<?php 
$this->load->view('template/head');
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>
<section class="content">
        <h2 style="margin-top:0px">Timbangan_m_kendaraan Read</h2>
        <div class="box">
        <div class="box-body">
        <table class="table">
	    <tr><td>Id Kendaraan</td><td><?php echo $id_kendaraan; ?></td></tr>
	    <tr><td>No Plat</td><td><?php echo $no_plat; ?></td></tr>
	    <tr><td>Nama Kendaraan</td><td><?php echo $nama_kendaraan; ?></td></tr>
	    <tr><td>Nilai Tarra</td><td><?php echo $nilai_tarra; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('m_kendaraan') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
</div>
</div>
</section>
<?php 
$this->load->view('template/js');
$this->load->view('template/foot');
?>