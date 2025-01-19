<?php

include('header.php') ?>

    <div class="jsv-360__home">
        <h1 class="jsv-typography-root jsv-typography-dark jsv-typography-h1">
            <?= __('360 Javascript Viewer', 'jsv360') ?>
        </h1>
        <h6 class="jsv-typography-root jsv-typography-grey jsv-typography-h6 jsv-mt-4 jsv-mb-2 external-link">
            <?= __(
                'Official plugin for the 360° javascript viewer made by <a target="_blank" href="https://360-javascriptviewer.com?utm_source=plugin-page&utm_id=wordpress">360 Javascript Viewer</a>. <br>Create unlimited 360° product presentations with all kind of options.',
                JSV360_DOMAIN
            ) ?>
        </h6>
    <h6 class="jsv-typography-root jsv-typography-grey jsv-typography-h6 jsv-mt-4 jsv-mb-2 external-link"> Check for more info at <a target="_blank" href="https://wordpress.360-javascriptviewer.com/">WordPress Demo 360</a> </h6>

        <div class="jsv-360__home__card-holder">
            <div class="jsv-360__home__card-holder__card">
                <h2>Before you begin</h2>
                <p> The plugin use images from your media library or from a CDN. More images means a smoother 3D effect.
                </p>
                <ul>
                    <li>Make sure your images have a name with a number in it, like yourimage_01.jpg.</li>
                    <li>Resize the images or use a CDN with scaling options, otherwise your presentation becomes too heavy for your client.</li>
                    <li>Use our tool to explore all the viewer options and all the integration options.</li>
                </ul>
                </p>
                <a href="<?= menu_page_url(JSV_360_ADMIN_DEDICATED::PATH, false)  ?>" class="jsv-360__button jsv-360__button--normal jsv-360__button--outlined">start uploading</a>
            </div>
    </div>
<?php
include('footer.php'); ?>