<div class="row">
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <div class="row d-flex justify-content-between">
                    <div class="col-lg-3 col-md-6 col-sm-12 mt-1">
                        <span class="mx-2">Sample Surat Keluar</span>
                    </div>
                    <div class="text-right ml-auto">
                        <div class="input-group input-group-sm">
                            <?php if($_SESSION['level'] != '3'){ ?>
                            <a href="<?= base_url('sample_surat/create') ?>"
                                class="btn bg-gradient-primary mr-2 mt-1 btn-sm">Tambah Sample Surat</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body px-3 py-3 pb-2">
                <div class="table-responsive p-1">
                    <table class="table table-bordered table-striped table-hover table-sm" id="tbl-sample_surat"
                        width="100%">
                        <thead class="bg-gradient-dark text-white">
                            <tr>
                                <th>No</th>
                                <th>Nama_Surat</th>
                                <th>Kategori</th>
                                <th>--</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php   $no=1; 
                            foreach($sample_surat as $s){  ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td><?= $s->nama_surat ?></td>
                                <td><?= $s->nama_kategori ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('sample_surat/detail/'.$s->id_sample_surat) ?>"
                                        class="badge badge-warning p-1"><i class="fas fa-edit"></i> Detail</a>
                                    <a href="<?= base_url('sample_surat/edit/'.$s->id_sample_surat) ?>"
                                        class="badge badge-info p-1"><i class="fas fa-edit"></i> Edit</a>
                                    <a href="<?= base_url('sample_surat/delete/'.$s->id_sample_surat) ?>"
                                        class="badge badge-danger p-1"
                                        onclick="return confirm('Apakah anda yakin akan menghapus data ini?')">
                                        <i class="fas fa-trash-alt"></i> Hapus</a>
                                </td>
                            </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(function() {
    $('#tbl-sample_surat').DataTable();
})
</script>