<div class="modal fade" id="modal-angka-timbangan" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Angka Timbangan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="body-meja">
        <div>
            <h2><span id="nilai_angka">0000000</span> Kg</h2> <button onclick="refresh()" type=""> Refresh</button>
            <button onclick="ambil_angka()">Ambil Angka</button>
        </div>
      </div>
    </div>
  </div>
</div>

<script>

$("#nilai_angka").load("<?php echo base_url('timbangan/nilai_timbangan') ?>",function () {
      
    })
  
  function refresh() {
    $("#nilai_angka").load("<?php echo base_url('timbangan/nilai_timbangan') ?>",function () {
      
    })

    
  }
  
  function ambil_angka() {
    $("#modal-angka-timbangan").modal('toggle')
    $("#massa").val($("#nilai_angka").text())
  }
</script>