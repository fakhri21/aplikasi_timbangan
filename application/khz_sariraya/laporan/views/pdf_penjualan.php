<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/bootstrap.min.css">
<style type="text/css">
    
    body{background: #ccc;}
    .box{padding: 20px; background: #fff;}
    
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
            <div class="box" style="margin-top: 50px;">
                <div class="panel-heading">
                    <h3>Laporan Penjualan</h3>
                    <p>Periode <?php echo $w_awal ?> s/d <?php echo $w_akhir ?></p>
                </div>
                <div class="panel-body" style="margin-top: 40px;">
                   <div style="overflow-x: auto;">
                    <table class="table-style-two">
                        <tr>
                            <th>No</th>
                            <?php 
                        foreach ($table_header as $header) { ?>
                            <th><?php echo $header ?></th>
                            <?php }?>
                        </tr>
                        <?php
                            $no=0;
                            $grandtotal=0;
                    
                            foreach ($record as $recorddata) {
                                $grandtotal=$grandtotal+$recorddata['total_bersih'];
                             ?>

                        <!-- Kategori -->
                        <tr>
                            <td><?php echo ++$no ?></td>
                            <?php foreach ($table_header as $header => $h_db) { ?>
                            <td><?php echo $recorddata[$h_db] ?></td>
                            <?php }?>
                        </tr>
                        <?php }?>
                        <tr>
                            <td>Grand Total</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><?php echo $grandtotal ?></td>

                        </tr>
                    </table>
                    </div>
                </div>
            </div>


        </div>


    </div>
</div>
