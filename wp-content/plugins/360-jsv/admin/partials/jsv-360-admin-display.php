<?php

include('header.php') ?>

    <div class="jsv-360__home">
        <h1 class="jsv-typography-root jsv-typography-h1">
            <?= __('360 Javascript Viewer', 'jsv360') ?>
        </h1>
        <h6 class="jsv-typography-root jsv-typography-h6 jsv-mt-4 jsv-mb-2">
            <?= __(
                'Official plugin for the 360° javascript viewer. <br>Create unlimited 360° product presentations with all kind of options.',
                'jsv'
            ) ?>
        </h6>
        <h2>
            <?= __('How it works:', 'jsv') ?>
        </h2>
        <ul>
            <li>
                <div class="jsv-360__home__step">
                    <p>
                    <?= __(
                        'Upload your images to wordpress',
                        'jsv'
                    ) ?></p>
                </div></li>
            <li>
                <div class="jsv-360__home__step">
                    <p>       <?= __(
                            'Select the first image (yourimage_01.jpg) from your uploads and use the tool to fine tune your 360 product presentation',
                            'jsv'
                        ) ?>

                        <a id='jsv-go-button'
                           href="#"
                           class="jsv-button-base-root jsv-button-root jsv-button-contained jsv-button-contained-primary jsv-mb-4 jsv-mt-2"
                           tabindex="0"
                           type="button"
                           data-element-type="button">
                                <span class="jsv-button-label" style="width: 100%;">
                                    <?= __('select your first image and get started!', 'jsv') ?><span
                                            class="jsv-button-endIcon">
                                    </span>
                                </span>
                        </a></p>
                    <img src="<?php
                    echo plugins_url('admin/img/first_image_select.png', JSV360_MAIN_URL) ?>" class="jsv__image-select"
                         alt="Select the first image">

                </div>
            </li>
            <li>
                <div class="jsv-360__home__step">
                    <p>           <?= __(
                            'Copy/paste the code in a widget, on a page or in WooCommerce',
                            'jsv'
                        ) ?></p>

               <img width="200px" src="<?php
                    echo plugins_url('admin/img/copy_code.png', JSV360_MAIN_URL) ?>" class="jsv__image-select"
                         alt="Select the first image">

                </div>
            </li>
            <li>
                <div class="jsv-360__home__step">
                    <p>                 <?= __(
                            'If you need other specific options check the <a href="https://wordpress.org/plugins/360deg-javascript-viewer/#installation" target="_blank">readme</a>. Like margins, floats and width',
                            'jsv'
                        ) ?></p>


                </div>
            </li>
        </ul>



    </div>

    <script type="application/javascript">
        jQuery(function ($) {
            $('body').on('click', '#jsv-go-button', function (e) {

                e.preventDefault();

                const button = $(this),
                    custom_uploader = wp.media({
                        title: 'Select the first image',
                        library: {
                            type: 'image'
                        },
                        button: {
                            text: 'This is the first image of the serie'
                        },
                        multiple: false
                    }).on('close', function () {
                        const attachment = custom_uploader.state().get('selection').first().toJSON();
                        const img = btoa(attachment.url)
                        const url = `https://www.360-javascriptviewer.com/wordpress?utm_source=wordpress&utm_medium=pluginhome&utm_campaign=3dweb&main_url=${img}`;
                        window.open(url, '_blank');
                    }).open();

            });
        });
    </script>

<?php
include('footer.php'); ?>