
<!DOCTYPE html>
<html lang="en">
<style type="text/css">
    body{background: #ddd; }    
    .box{
        width: 400px;
        padding: 20px 30px; background: #fff;
        margin: 20px 0px;
    }
	table.table-style-two {
		font-family: verdana, arial, sans-serif;
		font-size: 17px;
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
 
	table.table-style-two tr:hover td {
		background-color: #DFEBF1;
	}
 
	table.table-style-two td {
		border-width: 1px;
		padding: 8px;
		border-style: solid;
		border-color: #517994;
		background-color: #ffffff;
	}
</style>
    <body>
    
    <div class="box">
  <h3>Serah Terima Penimbang</h3>
  <h3>Periode <?php echo $w_awal ?> s/d <?php echo $w_akhir ?></h3>
                <table class="table-style-two">
                    <tr>
                        <th>SHIFT</th>
                        <th>Nama Penimbang</th>
                        <th>Total Uang</th>
                        <th>Paraf</th>
                        
                    </tr>
                    <?php
                            $grandtotal=0;
                            $no=0;
                            foreach ($record as $recorddata) {
                                $grandtotal=$grandtotal+$recorddata['pendapatan'];
                             ?>

                        <!-- Kategori -->
                        <tr>
                            <td><?php echo ++$no ?></td>
                            <td><?php echo $recorddata['nama_penimbang'] ?></td>
                            <td><?php echo number_format($recorddata['pendapatan']) ?></td>
                            <td></td>
                        </tr>
                        <?php }?>
                    <tr>
                        <td colspan='2'>Grand Total</td>
                        <td><?php echo number_format($grandtotal) ?></td>
                           <td>&nbsp;</td>
                            
                    </tr>
        </table>
        </div>
    </body>
</html>
