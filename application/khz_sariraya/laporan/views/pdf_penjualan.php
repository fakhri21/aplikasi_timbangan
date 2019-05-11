
<!DOCTYPE html>
<html lang="en">
<style type="text/css">
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
    <body>
    
  <div class="panel-body">
  <h3>Laporan Penjualan</h3>
  <h3>Periode <?php echo $w_awal ?> s/d <?php echo $w_akhir ?></h3>
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


    </body>
</html>

