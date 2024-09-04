<?php

include('header.php') ?>

    <div class="jsv-360__home">
        <h1 class="jsv-typography-root jsv-typography-dark jsv-typography-h1">
            <?= __('360 Javascript Viewer', 'jsv360') ?>
        </h1>
        <h6 class="jsv-typography-root jsv-typography-grey jsv-typography-h6 jsv-mt-4 jsv-mb-2 external-link">
            <?= __(
                'Official plugin for the 360° javascript viewer made by <a target="_blank" href="https://360-javascriptviewer.com?utm_source=plugin-page&utm_id=wordpress">360 Javascript Viewer</a> and <a target="_blank" href="https://3dweb.io?utm_source=plugin-page&utm_id=wordpress">3dweb.io</a> . <br>Create unlimited 360° product presentations with all kind of options.',
                JSV360_DOMAIN
            ) ?>
        </h6>
    <h6 class="jsv-typography-root jsv-typography-grey jsv-typography-h6 jsv-mt-4 jsv-mb-2 external-link"> Check for more info at <a target="_blank" href="https://wordpress.360-javascriptviewer.com/">WordPress Demo 360</a> </h6>

        <div class="jsv-360__home__card-holder">
            <div class="jsv-360__home__card-holder__card">
                <h2>Local configuration</h2>
                <p>Use this option if you have one site and want to control the presentations in the wordpress backend.
                <ul>
                    <li>Use your own hosting for images</li>
                    <li>Manage your presentations locally</li>
                    <li class="negative">Cannot share between other domains easily</li>
                </ul>
                </p>
                <div class="jsv-360__home__card__image">
                    <img src="<?php
                    echo plugins_url('admin/img/local.png', JSV360_MAIN_URL) ?>" class="jsv__image-select"
                         alt="Use your own hosted images">
                </div>
                <a href="<?= menu_page_url(JSV_360_ADMIN_DEDICATED::PATH, false)  ?>" class="jsv-360__button jsv-360__button--normal jsv-360__button--outlined">start uploading</a>
            </div>
        <div class="jsv-360__home__card-holder__card">
            <h2>Remote configuration</h2>
            <p>Manage your presentations in one place. Use optimised images loaded from a fast CDN.</p>
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