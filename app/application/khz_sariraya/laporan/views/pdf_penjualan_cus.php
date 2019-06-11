<style type="text/css">
    
    /* body{background: #ccc;} */
    /* .box{padding: 20px; background: #fff;}
     */
    table.table-style-two {
        font-family: verdana, arial, sans-serif;
        font-size: 11px;
        color: #333333;
        border-width: 1px;
        border-color: #3A3A3A;
        border-collapse: collapse;
    }

    table.table-style-two th {
        border-width: 1px;
        padding: 8px;
        border-style: solid;
        border-color: #517994;
        background-color: #B2CFD8;
    }

    /* table.table-style-two tr:hover td {
		background-color: #FFF;
	}
  */
    table.table-style-two td {
        border-width: 1px;
        padding: 8px;
        border-style: solid;
        border-color: #517994;
        background-color: #ffffff;
    }

</style>

<div class="container-fluid">
    <div class="row">

        <div class="col-md-12">
        <h1><?php echo get_option('nama_perusahaan') ?></h1>
        <h2><?php echo get_option('slogan_perusahaan') ?></h2>
        <p><?php echo get_option('alamat_perusahaan') ?></p>
            <div class="box">
                <div class="panel-heading">
                    <h3>Laporan Penimbangan Customer</h3>
                    <p>Periode <?php echo $w_awal ?> s/d <?php echo $w_akhir ?></p>
                </div>
                <div class="panel-body">
                   <table class="table-style-two">
                    <?php
                                            $no=0;
                                            $grandtotal=0;
                                    
                                            foreach ($record as $recorddata) {
                                                $grandtotal=$grandtotal+$recorddata['total_bersih'];
                                            ?>

                    <tr>
                        <th colspan=4><?php echo $recorddata['nama_product'] ?></th>
                    </tr>
                    <tr>
                        <th rowspan=2>No</th>
                        <th rowspan=2>No.DO</th>
                        <th rowspan=2>Penimbang</th>
                        <th rowspan=2>Customer</th>
                        <th rowspan=2>No Plat</th>
                        <th colspan=2>Timbangan Bruto</th>
                        <th colspan=2>Timbangan Tarra</th>
                        <th rowspan=2>Netto</th>
                        <th rowspan=2>Potongan</th>
                        <th rowspan=2>Total Bersih</th>
                        <th rowspan=2>Harga / Kg</th>
                        <th rowspan=2>Jumlah</th>
                    </tr>
                    <tr>
                        <th>Waktu Masuk</th>
                        <th>Bruto</th>
                        <th>Waktu Keluar</th>
                        <th>Tarra</th>
                    </tr>
                    <tr>
                        <td><?php echo ++$no ?></td>
                        <td><?php echo $recorddata['id_timbang'] ?></td>
                        <td><?php echo $recorddata['nama_penimbang'] ?></td>
                        <td><?php echo $recorddata['nama_customer'] ?></td>
                        <td><?php echo $recorddata['no_plat'] ?></td>
                        <td><?php echo $recorddata['waktu_timbang'] ?></td>
                        <td><?php echo $recorddata['bruto'] ?> Kg</td>
                        <td><?php echo $recorddata['waktu_timbang'] ?></td>
                        <td><?php echo $recorddata['tarra'] ?> Kg</td>
                        <td><?php echo $recorddata['netto'] ?> Kg</td>
                        <td><?php echo $recorddata['nilai_potongan'] ?> Kg</td>
                        <td><?php echo $recorddata['total_bersih'] ?> Kg</td>
                        <td>Rp. <?php echo $recorddata['nilai_persatuan'] ?></td>
                        <td><?php echo $recorddata['jumlah'] ?></td>
                    </tr>
                    <tr>
                    <td colspan=14></td>
                    </tr>
                                            <?php }?>
                    <tr>
                    <td colspan=13>Grand Total :</td>
                    <td colspan>Rp. <?php echo number_format($grandtotal) ?></td>
                    </tr>

                </table>

                   
                </div>
            </div>


        </div>


    </div>
</div>


<!-- 'waktu timbang'=>'waktu_timbang',
                                    'Id timbang'=>'id_timbang',
                                    'Nama Penimbang'=>'nama_penimbang',
                                    'Nama Customer'=>'nama_customer',
                                    'Nama Kendaraan'=>'nama_kendaraan',
                                    'Plat Kendaraan'=>'no_plat',
                                    'Nama Product'=>'nama_product',
                                    'Bruto'=>'bruto',
                                    'Tarra'=>'tarra',
                                    'Netto'=>'netto',
                                    'Nilai potongan'=>'nilai_potongan',
                                    'Total bersih'=>'total_bersih',
                                    'Jumlah'=>'jumlah', -->