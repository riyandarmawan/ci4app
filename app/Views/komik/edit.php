<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col-8">
            <h2 class="my-3">Form Ubah Data Komik</h2>
            <form action="/komik/update/<?= $komik['id']; ?>" method="post">
                <?= csrf_field(); ?>
                <input type="hidden" name="slug" value="<?= $komik['slug']; ?>">
                <div class="row mb-3">
                    <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= (session()->getFlashdata('judul') ? 'is-invalid' : ''); ?>" id="judul" name="judul" autofocus value="<?= (old('judul')) ? old('judul') : $komik['judul'] ?>">
                        <div class="invalid-feedback">
                            <?= session()->getFlashdata('judul'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="penulis" class="col-sm-2 col-form-label">Penulis</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= (session()->getFlashdata('penulis') ? 'is-invalid' : ''); ?>" id="penulis" name="penulis" value="<?= (old('penulis')) ? old('penulis') : $komik['penulis'] ?>">
                        <div class="invalid-feedback">
                            <?= session()->getFlashdata('penulis'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= (session()->getFlashdata('penerbit') ? 'is-invalid' : ''); ?>" id="penerbit" name="penerbit" value="<?= (old('penerbit')) ? old('penerbit') : $komik['penerbit'] ?>">
                        <div class="invalid-feedback">
                            <?= session()->getFlashdata('penerbit'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="sampul" class="col-sm-2 col-form-label">Sampul</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= (session()->getFlashdata('sampul') ? 'is-invalid' : ''); ?>" id="sampul" name="sampul" value="<?= (old('sampul')) ? old('sampul') : $komik['sampul'] ?>">
                        <div class="invalid-feedback">
                            <?= session()->getFlashdata('sampul'); ?>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Ubah Data</button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>