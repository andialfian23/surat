<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $judul ?></title>
</head>

<body>
    <img src="<?= base_url('images/kop_surat/'.$kop_surat) ?>" alt="" width="100%" />

    <div class="template">
        <?= $isi_surat; ?>
    </div>

    <script>
    window.print();
    </script>
</body>

</html>