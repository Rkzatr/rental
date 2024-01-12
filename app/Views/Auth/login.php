<?= $this->extend(config('Auth')->views['layout']) ?>

<?= $this->section('title') ?><?= lang('Auth.login') ?> <?= $this->endSection() ?>

<?= $this->section('main') ?>

<!-- Outer Row -->
<div class="row justify-content-center">

    <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block splide" role="group" aria-label="Splide Basic HTML Example">
                        <div class="splide__track">
                            <ul class="splide__list">
                                <li class="splide__slide"><img src="<?= base_url('img/slide/1.jpg') ?>" alt="gambar1">
                                </li>
                                <li class="splide__slide"><img src="<?= base_url('img/slide/2.jpg') ?>" alt="gambar2">
                                </li>
                                <li class="splide__slide"><img src="<?= base_url('img/slide/3.jpg') ?>" alt="gambar3">
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4"><?= lang('Auth.login') ?></h1>
                            </div>
                            <?php if (session('error') !== null) : ?>
                                <div class="alert alert-danger" role="alert"><?= session('error') ?></div>
                            <?php elseif (session('errors') !== null) : ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php if (is_array(session('errors'))) : ?>
                                        <?php foreach (session('errors') as $error) : ?>
                                            <?= $error ?>
                                            <br>
                                        <?php endforeach ?>
                                    <?php else : ?>
                                        <?= session('errors') ?>
                                    <?php endif ?>
                                </div>
                            <?php endif ?>
                            <?php if (session('message') !== null) : ?>
                                <div class="alert alert-success" role="alert"><?= session('message') ?></div>
                            <?php endif ?>

                            <form class="user" action="<?= url_to('login') ?>" method="post">
                                <?= csrf_field() ?>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="email" aria-describedby="emailHelp" name="email" autocomplete="email" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" name="password" id="password" autocomplete="current-password" placeholder="<?= lang('Auth.password') ?>" required>
                                </div>
                                <!-- Remember me -->
                                <?php if (setting('Auth.sessionConfig')['allowRemembering']) : ?>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" name="remember" class="custom-control-input" id="customCheck" <?php if (old('remember')) : ?> checked<?php endif ?>>
                                            <label class="custom-control-label" for="customCheck"><?= lang('Auth.rememberMe') ?></label>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    <?= lang('Auth.login') ?>
                                </button>
                            </form>
                            <hr>

                            <?php if (setting('Auth.allowMagicLinkLogins')) : ?>
                                <div class="text-center">
                                    <?= lang('Auth.forgotPassword') ?> <a class="small" href="<?= url_to('magic-link') ?>"><?= lang('Auth.useMagicLink') ?></a>
                                </div>
                            <?php endif ?>

                            <?php if (setting('Auth.allowRegistration')) : ?>
                                <div class="text-center">
                                    <?= lang('Auth.needAccount') ?> <a class="small" href="<?= url_to('register') ?>"><?= lang('Auth.register') ?></a>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>