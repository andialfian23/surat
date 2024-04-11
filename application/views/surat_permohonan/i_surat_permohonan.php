<div class="row">
    <div class="col-lg-6">
        <div class="card shadow">
            <div class="card-header">
                Buat Surat Permohonan
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="surat">Surat</label>
                    <select class="form-control form-control-sm" id="surat">
                        <option value="" hidden>-- Pilih Surat --</option>
                        <?php foreach($sample->result() as  $s){ ?>
                        <option value="<?= $s->id_sample_surat ?>"><?= $s->nama_surat ?></option>
                        <?php } ?>
                    </select>
                    <small id="notif_surat" class="text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="tgl_permohonan">Tanggal</label>
                    <input type="date" class="form-control form-control-sm" id="tgl_permohonan" />
                    <small id="notif_tgl_permohonan" class="text-danger"></small>
                </div>

                <!-- AREA INPUT PARAMS TU -->
                <div id="form-input"></div>
            </div>
            <div class="card-footer text-center">
                <a href="<?= base_url('surat_permohonan') ?>" class="btn btn-success" id="btn-save">Kembali</a>
                <button type="button" class="btn btn-primary" id="btn-save">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).on('change', '#surat', function() {
    $.ajax({
        url: '<?= base_url('surat_permohonan/get_sample') ?>',
        type: 'POST',
        data: {
            id: $(this).val()
        },
        dataType: 'json',
        success: function(res) {
            $('#form-input').html(res);
        }
    });
});

$(document).on('click', '#btn-save', function() {
    $('small').html('');

    if ($('#surat').val() == '') {
        $('#surat').addClass('is-invalid');
        $('#notif_surat').html('Pilih Surat terlebih dahulu');
        return false;
    }

    if ($('#tgl_permohonan').val() == '') {
        $('#tgl_permohonan').addClass('is-invalid');
        $('#notif_tgl_permohonan').html('Tanggal Masih Kosong');
        return false;
    }

    let value_sp = null;
    $('#form-input').find('input').each(function() {
        let params_no = $(this).data('no');
        let value = $(this).val();
        value_sp += '[' + params_no + ']#' + value + '|';
    });


    $.ajax({
        url: '<?= base_url('surat_permohonan/insert') ?>',
        type: 'POST',
        data: {
            surat: $('#surat').val(),
            tanggal: $('#tgl_permohonan').val(),
            value_sp: value_sp
        },
        dataType: 'json',
        success: function(res) {
            if (res.status == 1) {
                toastr.success('Berhasil Menyimpan Data');
                setTimeout(function() {
                    window.location.replace("<?= base_url('surat_permohonan') ?>");
                }, 1000);
            } else {
                toastr.success('Gagal Menyimpan Data');
            }
        }
    });
});
</script>