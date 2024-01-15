<?= $this->extend('Layout/main') ?>
<?= $this->section('content') ?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Profil</h1>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-5">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <form id="form-profil">
                                <div class="form-group row">
                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="text" readonly class="form-control-plaintext" id="email" value="<?= $user->email ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                                    <div class="col-sm-10">
                                        <input type="text" readonly class="form-control-plaintext" id="username" value="<?= $user->username ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $user->nama ?>" required>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a role="button" class="btn btn-warning btn-form-password">Ubah Password</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<template id="profil-password">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <form id="form-password">
                    <div class="form-group row">
                        <label for="password" class="col-sm-4 col-form-label">Password</label>
                        <div class="input-group col-sm-8">
                            <input type="password" class="form-control" id="password" name="password" required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary btn-password" type="button"><i class="fas fa-eye"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password_confirm" class="col-sm-4 col-form-label">Konfirmasi Password</label>
                        <div class="input-group col-sm-8">
                            <input type="password" class="form-control" id="password_confirm" name="password_confirm" required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary btn-password" type="button"><i class="fas fa-eye"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<template id="profil-password-control">
    <div style="display: flex; justify-content: end; align-items: center;">
        <div>
            <button type="button" class="btn btn-danger btn-sm btn-cancel">Batal</button>
            <button type="button" class="btn btn-primary btn-sm btn-form-password-submit">Simpan</button>
        </div>
    </div>
</template>

<?= $this->section('script') ?>
<script src="<?= base_url('js/pages/profil.js') ?>"></script>
<?= $this->endSection() ?>

<?= $this->endSection() ?>