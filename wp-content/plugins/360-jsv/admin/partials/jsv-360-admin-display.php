<?php

include('header.php') ?>

    <div class="jsv-360__home">
        <h1 class="jsv-typography-root jsv-typography-dark jsv-typography-h1">
            <?= __('360 Javascript Viewer', 'jsv360') ?>
        </h1>
        <h6 class="jsv-typography-root jsv-typography-grey jsv-typography-h6 jsv-mt-4 jsv-mb-2 external-link">
            <?= __(
                'Official plugin for the 360° javascript viewer made by <a target="_blank" href="https://3dweb.io?utm_source=plugin-page&utm_id=wordpress">3dweb.io</a> . <br>Create unlimited 360° product presentations with all kind of options.',
                'jsv'
            ) ?>
        </h6>

        <div class="jsv-360__home__card-holder">
            <div class="jsv-360__home__card-holder__card">
                <h2>Use local hosting</h2>
                <div class="jsv-360__home__card__image">
                    <img src="<?php
                    echo plugins_url('admin/img/local.png', JSV360_MAIN_URL) ?>" class="jsv__image-select"
                         alt="Use your own hosted images">
                </div>
                <a href="<?= menu_page_url(JSV_360_ADMIN_DEDICATED::PATH, false)  ?>" class="jsv-360__button jsv-360__button--normal jsv-360__button--outlined">start uploading</a>
            </div>
        <div class="jsv-360__home__card-holder__card">
            <h2>Central managed and hosted</h2>
            <div class="jsv-360__home__card__image">
                <img src="<?php
                echo plugins_url('admin/img/cloud.png', JSV360_MAIN_URL) ?>" class="jsv__image-select"
                     alt="Use central hosted presentations">
            </div>
            <a href="<?= menu_page_url(JSV_360_ADMIN_CLOUD::PATH, false)  ?>" class="jsv-360__button jsv-360__button--normal jsv-360__button--outlined">select presentation</a>
        </div>

    </div>
<?php
include('footer.php'); ?>