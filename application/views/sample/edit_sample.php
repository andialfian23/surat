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
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="id_kategori">Kategori</label>

                            <select class="form-control form-control-sm" id="jenis">
                                <option value="">-- Jenis Surat --</option>
                                <option value="keluar">Surat Keluar</option>
                                <option value="permohonan">Surat Permohonan</option>
                            </select>
                            <select class="form-control form-control-sm" id="id_kategori"></select>

                            <small id="notif_id_kategori" class="text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="nama_surat">Nama Surat</label>
                            <input type="text" class="form-control form-control-sm" id="nama_surat"
                                value="<?= $sample->nama_surat ?>">
                            <small id="notif_nama_surat" class="text-danger"></small>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="format_nomor">Format Nomor</label>
                            <input type="text" class="form-control form-control-sm" id="format_nomor"
                                value="<?= $sample->format_nomor ?>">
                            <small id="notif_format_nomor" class="text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="kop_surat">Kop Surat</label>
                            <div class="custom-file" id="kop_surat">
                                <input type="file" class="custom-file-input custom" id="exampleInputFile1"
                                    id="kop_surat" />
                                <label class="custom-file-label" for="exampleInputFile1">
                                    Berupa Gambar JPG/PNG
                                </label>
                            </div>
                            <div class="">
                                <img src="<?= base_url('images/kop_surat/'.$sample->kop_surat) ?>" alt="" width="100%">
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
                                        <td>
                                            <input type="text" class="lbl_params w-100" value="Nomor" data-no="1"
                                                disabled />
                                        </td>
                                        <td>
                                            <select class="val_params w-100" data-no="1" disabled>
                                                <option value="sesuai_format">Format Nomor</option>
                                            </select>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">{$2}</td>
                                        <td>
                                            <input type="text" class="lbl_params w-100" value="Hal" data-no="2"
                                                disabled />
                                        </td>
                                        <td>
                                            <select class="val_params w-100" data-no="2">
                                                <option value="nama_surat" selected>Nama Surat</option>
                                            </select>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">{$3}</td>
                                        <td>
                                            <input type="text" class="lbl_params w-100" value="Lampiran" data-no="3"
                                                disabled />
                                        </td>
                                        <td>
                                            <select class="val_params w-100" data-no="3">
                                                <option value="-" selected>-</option>
                                                <option value="input_by_TU">Di input TU</option>
                                                <option value="input_by_mhs">Di input Mahasiswa</option>
                                            </select>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">{$4}</td>
                                        <td>
                                            <input type="text" class="lbl_params w-100" value="Tanggal" data-no="4"
                                                disabled />
                                        </td>
                                        <td>
                                            <select class="val_params w-100" data-no="4" disabled>
                                                <option value="tanggal_surat">Otomastis</option>
                                                <option value="input_by_TU">Di input TU</option>
                                            </select>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">{$5}</td>
                                        <td>
                                            <input type="text" class="lbl_params w-100" Value="Kepada" data-no="5"
                                                disabled />
                                        </td>
                                        <td>
                                            <select class="val_params w-100" data-no="5">
                                                <option value="-">-</option>
                                                <option value="input_by_TU" selected>Di input TU</option>
                                                <option value="input_by_mhs">Di input Mahasiswa</option>
                                            </select>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr data-no="5">
                                        <td class="text-center">{$6}</td>
                                        <td>
                                            <input type="text" class="lbl_params w-100" data-no="6">
                                        </td>
                                        <td>
                                            <select class="val_params w-100" data-no="6">
                                                <option value="-">-</option>
                                                <option value="input_by_mhs" selected>Di input Mahasiswa</option>
                                                <option value="input_by_TU">Di input TU</option>
                                            </select>
                                        </td>
                                        <td class="text-center">
                                            <button type="button"
                                                class="badge badge-danger btn-delete-params">X</button>
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
                            <input type="hidden" id="template">
                            <trix-editor input="template"></trix-editor>
                        </div>
                        <div class="form-group text-center">
                            <a href="<?= base_url('sample') ?>" class="btn btn-success">Kembali</a>
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
let last_no = $('#tbl-params tbody tr').length;

$(function() {
    bsCustomFileInput.init();
});

$(document).on('change', '#jenis', function() {
    $.ajax({
        url: '<?= base_url('sample/kategori') ?>',
        type: 'POST',
        data: {
            jenis: $(this).val(),
        },
        dataType: 'json',
        success: function(res) {
            $('#id_kategori').empty()
            $('#id_kategori').html('<option value="">--Pilih Kategori Surat--</option>')
            $(res.data).each(function(i, row) {
                $('#id_kategori').append(`<option value="` + row.id_kategori + `">` + row
                    .nama_kategori + `</option>`)
            });
        }
    });
});

$(document).on('click', '#btn-save', function() {
    let params = null;

    $('#tbl-params tbody tr').each(function() {
        let id = $(this).find('td:eq(0)').html();
        let label = $(this).find('.lbl_params').val();
        let value = $(this).find('.val_params').val();
        params += id + '#' + label + '#' + value + ',';
    });
    let dataset = new FormData();
    dataset.append('id_kategori', $('#id_kategori').val());
    dataset.append('nama_surat', $('#nama_surat').val());
    dataset.append('format_nomor', $('#format_nomor').val());
    dataset.append('kop_surat', $('input[type="file"]')[0].files[0]);
    dataset.append('params', params);
    dataset.append('template', $('#template').val());

    $.ajax({
        url: '<?= base_url('sample/insert') ?>',
        type: 'POST',
        data: dataset,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(res) {
            if (res.status == 1) {
                toastr.success('Berhasil Menyimpan Data');
            } else {
                toastr.success('Gagal Menyimpan Data');
            }
        }
    });
});

$(document).on('click', '#btn-add-params', function() {
    let tbody = $('#tbl-params tbody');
    last_no = parseInt(last_no);
    last_no = last_no + 1;

    tbody.append(`
    <tr data-no="` + last_no + `">
        <td class="text-center">{$` + last_no + `}</td>
        <td>
            <input type="text" class="lbl_params w-100" data-no="` + last_no + `">
        </td>
        <td>
            <select class="val_params w-100" data-no="` + last_no + `">
                <option value="-">-</option>
                <option value="input_by_mhs" selected>Di input Mahasiswa</option>
                <option value="input_by_tu">Di input TU</option>
            </select>
        </td>
        <td class="text-center">
            <button type="button" class="badge badge-danger btn-delete-params">X</button>
        </td>
    </tr>`);
});

$(document).on('click', '.btn-delete-params', function() {
    $(this).parents('tr').remove();
});
</script>