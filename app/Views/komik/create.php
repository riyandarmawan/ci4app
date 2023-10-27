<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col-8">
            <h2 class="my-3">Form Tambah Data Komik</h2>
            <form action="/komik/save" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="row mb-3">
                    <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= (session()->getFlashdata('judul') ? 'is-invalid' : ''); ?>" id="judul" name="judul" autofocus value="<?= old('judul'); ?>">
                        <div class="invalid-feedback">
                            <?= session()->getFlashdata('judul'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="penulis" class="col-sm-2 col-form-label">Penulis</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= (session()->getFlashdata('penulis') ? 'is-invalid' : ''); ?>" id="penulis" name="penulis" value="<?= old('penulis'); ?>">
                        <div class="invalid-feedback">
                            <?= session()->getFlashdata('penulis'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= (session()->getFlashdata('penerbit') ? 'is-invalid' : ''); ?>" id="penerbit" name="penerbit" value="<?= old('penerbit'); ?>">
                        <div class="invalid-feedback">
                            <?= session()->getFlashdata('penerbit'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3 d-flex align-items-center">
                    <label for="sampul" class="col-sm-2 col-form-label">Sampul</label>
                    <div class="col-sm-2">
                        <img src="/img/default.jpg" class="img-thumbnail img-preview">
                    </div>
                    <div class="col-sm-8">
                        <div class="mb-3 position-relative container">
                            <input class="form-control <?= (session()->getFlashdata('sampul') ? 'is-invalid' : ''); ?> d-none" type="file" id="sampul" name="sampul" onchange="previewImg()">
                            <label for="sampul" class="form-control pe-auto tombol-label" title="Pilih gambar...">Pilih gambar...</label>
                            <label for="sampul" class="btn btn-secondary position-absolute end-0 top-0 tombol-cari" title="Pilih gambar...">Browse</label>
                            <div class="invalid-feedback">
                                <?= session()->getFlashdata('sampul'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Tambah Data</button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>