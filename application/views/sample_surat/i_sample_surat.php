<link rel="stylesheet" type="text/css" href="<?= base_url('extra-libs/') ?>trix/trix.css">
<script type="text/javascript" src="<?= base_url('extra-libs/') ?>trix/trix.js"></script>
<style>
#tbl-params {
    width: 100%;
    border-collapse: collapse;
}

#tbl-params th {
    text-align: center;
}

#tbl-params td,
#tbl-params th {
    border: 1px solid #000;
}
</style>

<div class="row">
    <div class="col-lg-12">
        <div class="card shadow">
            <div class="card-header">
                Tambah Sample Surat
            </div>
            <div class="card-body">
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
                            <label for="nama_surat">Nama Surat</label>
                            <input type="text" class="form-control form-control-sm" id="nama_surat" name="nama_surat">
                            <small id="notif_nama_surat" class="text-danger"></small>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="format_nomor">Format Nomor</label>
                            <input type="text" class="form-control form-control-sm" id="format_nomor"
                                name="format_nomor">
                            <small id="notif_format_nomor" class="text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="kop_surat">Kop Surat</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input custom" id="exampleInputFile1"
                                    id="kop_surat" name="kop_surat" />
                                <label class="custom-file-label" for="exampleInputFile1">
                                    Berupa Gambar JPG/PNG
                                </label>
                            </div>
                            <small id="notif_kop_surat" class="text-danger"></small>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="template">Paremeter Input</label>
                            <table id="tbl-params">
                                <thead class="bg-gradient-dark">
                                    <tr>
                                        <th>No.</th>
                                        <th>Label</th>
                                        <th>Value</th>
                                        <th>--</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">{$1}</td>
                                        <td>Nomor</td>
                                        <td>Sesuai Format</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">{$2}</td>
                                        <td>Hal</td>
                                        <td>Nama Surat</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">{$3}</td>
                                        <td>Lampiran</td>
                                        <td>
                                            <select class="val_params w-100">
                                                <option value="-">-</option>
                                            </select>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">{$4}</td>
                                        <td>Kepada</td>
                                        <td>
                                            <select class="val_params w-100">
                                                <option value="-">-</option>
                                                <option value="input_by_TU" selected>Di input TU</option>
                                                <option value="input_by_mhs" selected>Di input Mahasiswa</option>
                                            </select>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr data-no="5">
                                        <td class="text-center">{$5}</td>
                                        <td>
                                            <input type="text" id="lbl_params" class="lbl_params w-100">
                                        </td>
                                        <td>
                                            <select class="val_params w-100">
                                                <option value="-">-</option>
                                                <option value="input_by_mhs" selected>Di input Mahasiswa</option>
                                                <option value="input_by_TU" selected>Di input TU</option>
                                            </select>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn-sm btn-danger btn-delete-params">X</button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4">
                                            <button id="btn-add-params" class="btn btn-primary btn-block btn-sm">Tambah
                                                Parameter Input</button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="form-group">
                            <label for="template">Template Surat</label>
                            <input type="hidden" id="body">
                            <trix-editor input="body"></trix-editor>
                        </div>
                        <div class="form-group text-center">
                            <a href="<?= base_url('sample_surat') ?>" class="btn btn-success">Kembali</a>
                            <input type="reset" class="btn btn-danger" value="Reset" />
                            <button type="submit" class="btn btn-primary" id="btn-save">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let last_no = $('#tbl-params tbody tr:last').data('no');

$(document).on('click', '#btn-save', function() {
    alert('ke alon acan');
});

$(document).on('click', '#btn-add-params', function() {
    let tbody = $('#tbl-params tbody');
    last_no = parseInt(last_no);
    last_no = last_no + 1;

    tbody.append(`
    <tr data-no="` + last_no + `">
        <td class="text-center">{$` + last_no + `}</td>
        <td>
            <input type="text" id="lbl_params" class="lbl_params w-100">
        </td>
        <td>
            <select class="val_params w-100">
                <option value="-">-</option>
                <option value="input_by_mhs" selected>Di input Mahasiswa</option>
                <option value="input_by_tu" selected>Di input TU</option>
            </select>
        </td>
        <td class="text-center">
            <button type="button" class="btn-sm btn-danger btn-delete-params">X</button>
        </td>
    </tr>`);
});

$(document).on('click', '.btn-delete-params', function() {
    $(this).parents('tr').remove();
});
</script>