<div class="row">
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-body">
                <?php if($_SESSION['level'] != '3'){ ?>
                <a href="<?= base_url('sample/create') ?>" class="btn bg-gradient-primary mr-2 mt-1 btn-sm">Tambah
                    Sample Surat</a>
                <?php } ?>

                <div class="table-responsive p-1 mt-3">
                    <table class="table table-bordered table-striped table-hover table-sm" id="tbl-sample" width="100%">
                        <thead class="bg-gradient-dark text-white">
                            <tr>
                                <th>No</th>
                                <th>Nama_Surat</th>
                                <th>Kategori</th>
                                <th>Jenis</th>
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
                                <td><?php 
                                    if($s->jenis=='masuk'){echo "Surat Masuk";}
                                    else{echo "Surat Permohonan";}
                                ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('sample/detail/'.$s->id_sample_surat) ?>"
                                        class="badge badge-warning p-1"><i class="fas fa-edit"></i> Detail</a>
                                    <a href="<?= base_url('sample/edit/'.$s->id_sample_surat) ?>"
                                        class="badge badge-info p-1"><i class="fas fa-edit"></i> Edit</a>
                                    <a href="<?= base_url('sample/delete/'.$s->id_sample_surat) ?>"
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
    $('#tbl-sample').DataTable();
})
</script>