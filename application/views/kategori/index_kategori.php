<div class="row">
    <div class="col-lg-12">
        <div class="card shadow">
            <div class="card-header">
                Kategori Surat
            </div>
            <div class="card-body">
                <a href="<?= base_url('kategori/create') ?>" class="btn btn-primary">Tambah Kategori</a>
                <div class="table-responsive mt-2">
                    <table class="table table-bordered table-sm w-100" id="tbl-kategori">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Kategori</th>
                                <th>Jenis</th>
                                <th>--</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; foreach($kategori->result() as $k){ ?>
                            <tr>
                                <td class="text-center"><?= $no; ?></td>
                                <td><?= $k->nama_kategori ?></td>
                                <td>
                                    <?= ($k->jenis=='permohonan')?'Surat Permohonan':'Surat Keluar'; ?>
                                </td>
                                <td class="text-center">
                                    <a href="<?= base_url('kategori/edit/'.$k->id_kategori) ?>"
                                        class="btn btn-info btn-sm">Edit</a>
                                    <a href="<?= base_url('kategori/delete/'.$k->id_kategori) ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Apakah anda yakin akan menghapus data ini?')">Hapus</a>
                                </td>
                            </tr>
                            <?php $no++; } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(function() {
    $('#tbl-kategori').DataTable();
})
</script>