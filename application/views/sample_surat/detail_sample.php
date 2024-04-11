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
                Detail Sample Surat
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <a href="<?= base_url('sample_surat') ?>" class="btn btn-success">Kembali</a>
                        </div>
                        <div class="form-group">
                            <label for="id_kategori">Jenis Surat</label>
                            <div class="" id="id_kategori">
                                <?= ($sample->jenis =='permohonan')?'Surat Permohonan':'Surat Keluar'; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="id_kategori">Kategori Surat</label>
                            <div class="" id="id_kategori">
                                <?= $sample->nama_kategori ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama_surat">Nama Surat</label>
                            <div class="" id="nama_surat">
                                <?= $sample->nama_surat ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="format_nomor">Format Nomor</label>
                            <div class="" id="format_nomor">
                                <?= $sample->format_nomor ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="kop_surat">Kop Surat</label>
                            <div class="custom-file" id="kop_surat">
                                <img src="<?= base_url('images/kop_surat/'.$sample->kop_surat) ?>" alt="" width="100%">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-1">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="template">Paremeter Input</label>
                            <table id="tbl-params">
                                <thead class="bg-gradient-dark">
                                    <tr>
                                        <th>No.</th>
                                        <th>Label</th>
                                        <th>Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $params = explode('|',$sample->params);
                                        foreach($params as $p){
                                            if($p !=''){
                                            $key = explode('#',$p);
                                            if($key[2]=='sesuai_format'){
                                                $value = 'Sesuai Format';
                                            }else  if($key[2]=='nama_surat'){
                                                $value = 'Nama Surat';
                                            }else  if($key[2]=='tanggal_surat'){
                                                $value = 'Tanggal Surat';
                                            }else  if($key[2]=='input_by_TU'){
                                                $value = 'Input Oleh Tata Usaha';
                                            }else  if($key[2]=='input_by_mhs'){
                                                $value = 'Input Oleh Mahasiswa';
                                            }else{
                                                $value = $key[2];
                                            }
                                    ?>
                                    <tr>
                                        <td class="text-center"><?= $key[0] ?></td>
                                        <td><?= $key[1] ?></td>
                                        <td><?= $value ?></td>
                                    </tr>
                                    <?php } 
                                            } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-8 p-2">
                        <div class="form-group">
                            <label for="template">Template Surat</label>
                            <div class="row">
                                <div class="col-lg-12 p-1" style="border:1px solid #000;">
                                    <?= $sample->template ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>