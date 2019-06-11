
<?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
   <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="box box-primary" style="margin-top: 30px;">
        <div class="box-header"><h3>Profile Perusahaan</h3></div>
        
        <div class="box-body">
           <div class="form-group">
                <form method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>konfigurasi/aksi/nama_perusahaan">
                    <label>Nama Perusahaan</label>
                    <input type="text" class="form-control" name="value" value="<?php echo get_option( 'nama_perusahaan' ); ?>">
                    <button class="btn btn-sm btn-flat btn-primary">Submit</button>
                </form>
            </div>
            
            <div class="form-group">
                <form method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>konfigurasi/aksi/alamat_perusahaan">
                    <label>Alamat Perusahaan</label>
                    <textarea name="value" class="form-control"><?php echo get_option( 'alamat_perusahaan' ); ?></textarea> 
                    <button class="btn btn-sm btn-flat btn-primary">Submit</button>
                </form>
            </div>
            
            <div class="form-group">
                <form method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>konfigurasi/aksi/slogan_perusahaan">
                    <label>Slogan Perusahaan</label>
                    <input type="text" class="form-control" name="value" value="<?php echo get_option( 'slogan_perusahaan' ); ?>">
                    <button class="btn btn-sm btn-flat btn-primary">Submit</button>
                </form>
            </div>            
        </div>
    </div>
    
</div>

<div class="col-md-6 col-sm-6 col-xs-12">
    <div class="box box-primary" style="margin-top: 30px;">
        <div class="box-header"><h3>Konfigurasi Timbangan</h3></div>
        
        <div class="box-body">
        <div class="form-group">
                    <form method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>konfigurasi/aksi/comp_port">
                        <label>Comp Port</label>
                        <select name="value">
                            <option value="COM1">COM1</option>
                            <option value="COM2">COM2</option>
                            <option value="COM9">COM9</option>
                        </select>
                      
                        <button class="btn btn-sm btn-flat btn-primary">Submit</button>
                    </form>
                </div>
                
                <div class="form-group">
                    <form method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>konfigurasi/aksi/baud_rate">
                        <label>Baud Rate</label>
                        <select name="value">
                            <option value="2400">2400</option>
                            <option value="9600">9600</option>
                        </select>
                        <button class="btn btn-sm btn-flat btn-primary">Submit</button>
                    </form>
                </div>
                
                <div class="form-group">
                    <form method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>konfigurasi/aksi/data_bits">
                        <label>Data Bits</label>
                          <select name="value">
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                          </select>
                        <button class="btn btn-sm btn-flat btn-primary">Submit</button>
                    </form>
                </div>
        </div>
    </div>
</div>

<div class="col-md-6 col-sm-6 col-xs-12">
    <div class="box box-primary" style="margin-top: 30px;">
        <div class="box-header"><h3>Konfigurasi Lainnya</h3></div>
        
        <div class="box-body">
                <div class="form-group">
                    <form method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>konfigurasi/aksi/coa_kas">
                        <label>Coa Kas</label>
                        <?php echo cmb_dinamis('m_coa_kas','akuntansi_m_coa','nama_coa','uniqid','uniqid') ?>
                        <button class="btn btn-sm btn-flat btn-primary">Submit</button>
                    </form>
                </div>
                
                <div class="form-group">
                    <form method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>konfigurasi/aksi/coa_pendapatan">
                        <label>Coa Pendapatan</label>
                        <?php echo cmb_dinamis('m_coa_pendapatan','akuntansi_m_coa','nama_coa','uniqid','uniqid') ?>
                        <button class="btn btn-sm btn-flat btn-primary">Submit</button>
                    </form>
                </div>
        </div>
    </div>
</div>
        



<script>
    $(document).ready(function() {

        $("#m_coa_kas").selectize();
        $("#m_coa_pendapatan").selectize();
    
    })

</script>