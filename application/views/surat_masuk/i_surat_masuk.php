<div class="row">
    <div class="col-lg-12">
        <div class="card shadow">
            <div class="card-header">
                Tambah Surat Masuk
            </div>
            <div class="card-body">
                <form action="<?= base_url('surat_masuk/create') ?>" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="id_kategori">Kategori</label>
                                <select class="form-control form-control-sm" name="id_kategori" id="id_kategori">
                                    <option value="">-- Pilih Kategori Surat --</option>
                                    <?php foreach($kategori as $k){ ?>
                                    <option value="<?= $k->id_kategori ?>"><?= $k->nama_kategori ?></option>
                                    <?php } ?>
                                </select>
                                <small id="notif_id_kategori" class="text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label for="tgl_masuk">Tanggal Surat Masuk</label>
                                <input type="date" class="form-control form-control-sm" id="tgl_masuk" name="tgl_masuk">
                                <small id="notif_tgl_masuk" class="text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label for="pengirim">Pengirim</label>
                                <input type="text" class="form-control form-control-sm" id="pengirim" name="pengirim">
                                <small id="notif_pengirim" class="text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label for="nomor">Nomor</label>
                                <input type="text" class="form-control form-control-sm" id="nomor" name="nomor">
                                <small id="notif_nomor" class="text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label for="perihal">Perihal</label>
                                <input type="text" class="form-control form-control-sm" id="perihal" name="perihal">
                                <small id="notif_perihal" class="text-danger"></small>
                            </div>

                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="tindakan">Tindakan</label>
                                <input type="text" class="form-control form-control-sm" id="tindakan" name="tindakan">
                                <small id="notif_tindakan" class="text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label for="file_surat">File Surat</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input custom" id="exampleInputFile1"
                                        id="file_surat" name="file_surat" />
                                    <label class="custom-file-label" for="exampleInputFile1">File Surat Berupa
                                        PDF...</label>
                                </div>
                                <small id="notif_file_surat" class="text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label for="lampiran">Lampiran</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input custom" id="exampleInputFile2"
                                        id="lampiran" name="lampiran" />
                                    <label class="custom-file-label" for="exampleInputFile2">File Surat Berupa
                                        PDF...</label>
                                </div>
                                <small id="notif_lampiran" class="text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label for="berkas">Berkas Lainnya</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input custom" id="exampleInputFile3"
                                        id="berkas" name="berkas" />
                                    <label class="custom-file-label" for="exampleInputFile3">File Surat Berupa
                                        PDF...</label>
                                </div>
                                <small id="notif_berkas" class="text-danger"></small>
                            </div>
                            <div class="form-group text-center">
                                <a href="<?= base_url('surat_masuk') ?>" class="btn btn-success">Kembali</a>
                                <input type="reset" class="btn btn-danger" value="Reset" />
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>