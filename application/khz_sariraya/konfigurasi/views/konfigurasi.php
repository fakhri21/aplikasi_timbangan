
<div class="row mb-2">
        <div class="primary">
            <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
        </div>
</div>

<h1>Profile Perusahaan</h1>
 <div class="box-body">

            <div class="form-group">
                <form method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>konfigurasi/aksi/nama_perusahaan">
                    <label>Nama Perusahaan</label>
                    <input type="text" name="value" value="<?php echo get_option( 'nama_perusahaan' ); ?>">
                    <br>
                    <button class="btn btn-sm btn-flat btn-primary">Submit</button>
                </form>
            </div>
            
            <div class="form-group">
                <form method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>konfigurasi/aksi/alamat_perusahaan">
                    <label>Alamat Perusahaan</label>
                    <textarea name="value"><?php echo get_option( 'alamat_perusahaan' ); ?></textarea> 
                    <br>
                    <button class="btn btn-sm btn-flat btn-primary">Submit</button>
                </form>
            </div>
            
            <div class="form-group">
                <form method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>konfigurasi/aksi/slogan_perusahaan">
                    <label>Slogan Perusahaan</label>
                    <input type="text" name="value" value="<?php echo get_option( 'slogan_perusahaan' ); ?>">
                    <br>
                    <button class="btn btn-sm btn-flat btn-primary">Submit</button>
                </form>
            </div>
            
</div><!-- box body -->

<div class="col">
<h1>Konfigurasi Timbangan</h1>
    <div class="box-body">

                <div class="form-group">
                    <form method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>konfigurasi/aksi/nama_perusahaan">
                        <label>Nama Perusahaan</label>
                        <input type="text" name="value" value="<?php echo get_option( 'nama_perusahaan' ); ?>">
                        <br>
                        <button class="btn btn-sm btn-flat btn-primary">Submit</button>
                    </form>
                </div>
                
                <div class="form-group">
                    <form method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>konfigurasi/aksi/alamat_perusahaan">
                        <label>Alamat Perusahaan</label>
                        <textarea name="value"><?php echo get_option( 'alamat_perusahaan' ); ?></textarea> 
                        <br>
                        <button class="btn btn-sm btn-flat btn-primary">Submit</button>
                    </form>
                </div>
                
                <div class="form-group">
                    <form method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>konfigurasi/aksi/slogan_perusahaan">
                        <label>Slogan Perusahaan</label>
                        <input type="text" name="value" value="<?php echo get_option( 'slogan_perusahaan' ); ?>">
                        <br>
                        <button class="btn btn-sm btn-flat btn-primary">Submit</button>
                    </form>
                </div>
                
    </div><!-- box body -->
</div>

<script>
    $(document).ready(function() {

        $.getJSON("m_coa/json",function (data) {
        data
        $("#coa_kas_kasir").selectize({
                        valueField: 'id_coa',
                        labelField: 'nama_coa',
                        searchField: 'nama_coa',
                        options: data.data,
                        create: false
                    });
    
        })
    })

</script>