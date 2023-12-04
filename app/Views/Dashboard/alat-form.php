<?= $this->extend('Layout/main') ?>
<?= $this->section('content') ?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <a href="<?= base_url('alat') ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-hand-point-left fa-sm text-white-50"></i> Kembali</a>
    <h1 class="h3 mb-0 text-gray-800">Tambah Alat</h1>
</div>

<!-- Content Row -->
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <form class="my-form" method="POST" action="<?= $item ? base_url("api/alat/{$item->id}") : base_url('api/alat') ?>" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">
                            <label for="nama">Nama Alat</label>
                            <input type="text" id="nama" name="nama" class="form-control" value="<?= $item ? $item->nama : '' ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="5"><?= $item ? $item->deskripsi : '' ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="id_kategori">Kategori Alat</label>
                            <select name="id_kategori" id="id_kategori" class="form-control">
                                <option value="" selected disabled>Pilih Kategori</option>
                                <?php foreach ($kategori as $k) : ?>
                                    <option value="<?= $k->id ?>"><?= $k->label ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga Alat</label>
                            <input type="number" id="harga" name="harga" class="form-control" value="<?= $item ? $item->harga : '' ?>" required>
                        </div>
                        <?php if ($item) : ?>
                            <div class="row justify-content-center">
                                <img src="<?= $item->gambar ?>" alt="" class="img-thumbnail" height="100" srcset="">
                            </div>
                        <?php endif; ?>
                        <div class="form-group">
                            <label for="gambar">Gambar Alat</label>
                            <input type="file" id="gambar" name="gambar" class="form-control" accept="image/png, image/gif, image/jpeg" value="<?= $item ? $item->gambar : '' ?>" required />
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->section('script') ?>
<script>
    $('.my-form').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr("action"),
            type: $(this).attr("method"),
            dataType: "JSON",
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function(data, status) {
                $.each(data.messages, function(t, m) {
                    Toast.fire({
                        icon: t,
                        title: m
                    });
                });
            },
            error: function(xhr, desc, err) {
                Toast.fire({
                    icon: 'error',
                    title: err
                })
            }
        });
        <?php if ($item) : ?>
            let reader = new FileReader();
            reader.readAsDataURL($('#gambar').prop('files')[0]);
            $('input').attr('value', $('#label').val());
            reader.addEventListener(
                "load",
                () => {
                    $('.img-thumbnail').removeAttr('src').attr('src', reader.result);
                },
                false,
            );
        <?php endif; ?>
        this.reset();
    });
</script>
<?= $this->endSection(); ?>
<?= $this->endSection(); ?>