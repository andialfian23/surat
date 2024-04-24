<style>
.inpdate {
    width: 120px;
    font-size: 14px;
    text-align: center;
    border-radius: none;
    border: 1px solid #ffc107;
}

.inpselect {
    font-size: 14px;
    border: 1px solid #ffc107;
}

.nwrap {
    white-space: nowrap;
}
</style>


<div class="row">
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <div class="row d-flex justify-content-between">

                    <div class="col-lg-2 col-md-6 col-sm-12 mt-1">
                        <span class="mx-2">Surat Permohonan</span>
                    </div>
                    <div class="text-right ml-auto pr-3">
                        <div class="input-group input-group-sm">


                            <a href="<?= base_url('permohonan/create') ?>"
                                class="btn bg-gradient-primary mr-2 mt-1 btn-sm">Tambah Surat Permohonan</a>


                            <?php if($_SESSION['level'] == 1){ ?>
                            <div class="input-group-prepend mt-1">
                                <span class="input-group-text border-warning bg-dark">Fakultas</span>
                            </div>
                            <select name="fak" id="fak" class="inpselect mt-1 mr-2">
                                <option value="All">Semua</option>
                                <?php foreach($fak as $f){ ?>
                                <option value="<?= $f['kode_fak'] ?>"><?= $f['nama_fak'] ?></option>
                                <?php } ?>
                            </select>
                            <?php } ?>

                            <div class="input-group-prepend mt-1">
                                <span class="input-group-text border-warning bg-dark">Tanggal</span>
                            </div>
                            <input type="date" class="inpdate mt-1" id="xBegin" value="<?= date('Y-m-01') ?>" />
                            <input type="date" class="inpdate mt-1" id="xEnd" value="<?= date('Y-m-d') ?>" />
                            <div class="input-group-prepend">
                                <button id="cari" type="button"
                                    class="btn bg-gradient-success btn-sm border-warning mt-1">
                                    <i class="fas fa-search"></i> Cari</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body px-3 py-3 pb-2">
                <div class="table-responsive p-1">
                    <table class="table table-bordered table-striped table-hover table-sm" id="tbl-surat-permohonan"
                        width="100%">
                        <thead class="bg-gradient-dark text-white">
                            <tr>
                                <th>Tanggal</th>
                                <th>Nomor Surat</th>
                                <th>Pembuat</th>
                                <th>Surat Permohonan</th>
                                <th>--</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(function() {
    let table = $('#tbl-surat-permohonan').DataTable({
        dom: "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        lengthMenu: [
            [5, 10, 25],
            ['5', '10', '25']
        ],
        pageLength: 10,
        buttons: [{
                extend: 'pageLength',
                text: 'Tampilkan Data',
                className: 'btn btn-secondary btn-sm',
            },
            // {
            //     extend: 'pdf',
            //     text: '<i class="fas fa-print"></i> Cetak Laporan',
            //     className: 'btn bg-gradient-blue btn-sm',
            //     action: function(e, dt, node, config) {
            //         setTimeout(function() {
            //             window.open("<?= base_url('permohonan/print') ?>",
            //                 '_blank');
            //         }, 1000);
            //     }
            // },
        ],
        language: {
            url: "<?= base_url('extra-libs/ID.json') ?>",
        },
        serverSide: true,
        processing: true,
        "columnDefs": [{
            "orderable": false,
            "targets": [4]
        }],
        ajax: {
            url: "<?= base_url('permohonan/show') ?>",
            type: "POST",
            data: function(d) {
                d.xBegin = $('#xBegin').val();
                d.xEnd = $('#xEnd').val();
                d.fak = $('#fak').val();
            }
        },
        columns: [{
            data: 'tgl_permohonan',
        }, {
            data: 'no_sp',
        }, {
            data: 'pemohon',
        }, {
            data: 'nama_surat',
        }, {
            data: 'id_sp',
            render: function(data, type, row, meta) {
                return `<a href="<?= base_url('permohonan/pdf/') ?>` + row.id_sp + `" 
                            class="badge bg-warning p-1" target="_blank">
                                <i class="fas fa-file-pdf"></i> Pdf</a>
                        <a href="<?= base_url('permohonan/edit/') ?>` + row.id_sp + `" 
                            class="badge badge-info p-1"><i class="fas fa-edit"></i> Edit</a>
                        <a href="<?= base_url('permohonan/delete/') ?>` + row.id_sp + `"
                            class="badge badge-danger p-1"
                            onclick="return confirm('Apakah anda yakin akan menghapus data ini?')"><i
                            class="fas fa-trash-alt"></i> Hapus</a>`;

            },
        }, ],
    });

    $(document).on('click', '#cari', function() {
        table.ajax.reload(null, false);
    });

    $(document).on('change', '#fak', function() {
        table.ajax.reload(null, false);
    });
});
</script>