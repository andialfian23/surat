<div class="row">
    <div class="col-lg-6">
        <div class="card shadow">
            <div class="card-header">
                Tambah Kategori
            </div>
            <div class="card-body">
                <form action="<?= base_url('kategori/create') ?>" method="POST">
                    <div class="form-group">
                        <label for="nama_kategori">Nama Surat</label>
                        <input type="text" class="form-control form-control-sm" name="nama_kategori" id="nama_kategori"
                            value="<?= set_value('nama_kategori') ?>">
                        <small id="notif_nama_kategori" class="text-danger">
                            <?= form_error('nama_kategori') ?>
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="jenis">Kategori</label>
                        <div class="input-group">
                            <select class="form-control form-control-sm" name="jenis" id="jenis">
                                <option value="">-- Jenis Surat --</option>
                                <option value="keluar">Surat Keluar</option>
                                <option value="permohonan">Surat Permohonan</option>
                            </select>
                        </div>
                        <small id="notif_jenis" class="text-danger">
                            <?= form_error('jenis') ?>
                        </small>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-block">SIMPAN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>