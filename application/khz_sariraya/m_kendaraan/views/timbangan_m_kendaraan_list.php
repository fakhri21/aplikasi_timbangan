<div class="col-md-12">

    <div class="box box-primary" style="margin-top: 30px;">
        <div class="box-header">
            <h3>List Kendaraan</h3>
        </div>

        <div class="box-body">
            <div class="row" style="margin-bottom: 10px">
                <div class="col-md-4">
                </div>
                <div class="col-md-4 text-center">
                    <div style="margin-top: 4px" id="message">
                        <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                    </div>
                </div>
                <div class="col-md-4 text-right">
                    <?php echo anchor(base_url('m_kendaraan/create'), 'Create', 'class="btn btn-primary"'); ?>
                    <?php echo anchor(base_url('m_kendaraan/excel'), 'Excel', 'class="btn btn-primary"'); ?>
                </div>
            </div>
            
            <div class="row">
                <div class="col">
                   <table style="width:100%;" class="table table-bordered table-striped" id="mytable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Id Kendaraan</th>
                        <th>No Plat</th>
                        <th>Nama Kendaraan</th>
                        <th>Nilai Tarra</th>
                        <th>Action</th>
                    </tr>
                </thead>

            </table>                    
                </div>
            </div>

            
        </div>
    </div>
</div><!-- col -->


    <script type="text/javascript">
        $(document).ready(function() {
            $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
                return {
                    "iStart": oSettings._iDisplayStart,
                    "iEnd": oSettings.fnDisplayEnd(),
                    "iLength": oSettings._iDisplayLength,
                    "iTotal": oSettings.fnRecordsTotal(),
                    "iFilteredTotal": oSettings.fnRecordsDisplay(),
                    "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                    "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
                };
            };

            var t = $("#mytable").dataTable({
                initComplete: function() {
                    var api = this.api();
                    $('#mytable_filter input')
                        .off('.DT')
                        .on('keyup.DT', function(e) {
                            if (e.keyCode == 13) {
                                api.search(this.value).draw();
                            }
                        });
                },
                oLanguage: {
                    sProcessing: "loading..."
                },
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "m_kendaraan/json",
                    "type": "POST"
                },
                columns: [{
                        "data": "uniqid",
                        "orderable": false
                    }, {
                        "data": "id_kendaraan"
                    }, {
                        "data": "no_plat"
                    }, {
                        "data": "nama_kendaraan"
                    }, {
                        "data": "nilai_tarra"
                    },
                    {
                        "data": "action",
                        "orderable": false,
                        "className": "text-center"
                    }
                ],
                order: [
                    [0, 'desc']
                ],
                rowCallback: function(row, data, iDisplayIndex) {
                    var info = this.fnPagingInfo();
                    var page = info.iPage;
                    var length = info.iLength;
                    var index = page * length + (iDisplayIndex + 1);
                    $('td:eq(0)', row).html(index);
                }
            });
        });

    </script>
