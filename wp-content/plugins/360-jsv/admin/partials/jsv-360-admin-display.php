<?php

include('header.php') ?>

    <div class="jsv-px-4 jsv-pt-4">
        <h1 class="jsv-typography-root jsv-typography-h1">
            <?= __('360 Product Viewer', 'jsv360') ?><br/><?= __(
                'for WordPress and WooCommerce',
                'jsv'
            ) ?>
        </h1>
        <h6 class="jsv-typography-root jsv-typography-h6 jsv-mt-4 jsv-mb-2">
            <?= __(
                'Official plugin for the 360° javascript viewer. <br>Create unlimited 360° product presentations with all kind of options.',
                'jsv'
            ) ?>
        </h6>
        <h6 class="jsv-typography-root jsv-typography-h6 jsv-mt-4 jsv-mb-2">
            <?= __('How it works:', 'jsv') ?>
        </h6>
        <ul class="jsv-list-root pb-4 jsv-list-padding">
            <li class="jsv-list-item-root" style="max-width: 550px;">
                <div class="jsv-list-item-icon-root jsv-pr-3 jsv-mt-2">
                    <svg class="jsv-svg-icon-root jsv-svg-icon-color" focusable="false"
                         viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M4.75 8.12891L12.6953 0.183594L13.75 1.23828L4.75 10.2383L0.566406 6.05469L1.62109 5L4.75 8.12891Z"
                              fill="#7A5CBD"/>
                    </svg>
                </div>
                <div class="jsv-list-item-text-root jsv-d-flex jsv-flex-column jsv-m-0">
                    <p class="jsv-typography-root jsv-body2" style="color: rgba(0, 0, 0, 0.6);">
                        <?= __(
                            'Use the tool to fine tune your 360 product presentation',
                            'jsv'
                        ) ?>
                    </p>
                    <div>
                        <a id='jsv-go-button'
                           href="#"
                           class="jsv-button-base-root jsv-button-root jsv-button-contained jsv-button-contained-primary jsv-mb-4 jsv-mt-2"
                           tabindex="0"
                           type="button"
                           data-element-type="button">
                                <span class="jsv-button-label" style="width: 100%;">
                                    <?= __('select your first image and get started!', 'jsv') ?><span
                                            class="jsv-button-endIcon">
                                    <svg class="jsv-Svgicon-root" focusable="false" viewBox="0 0 24 24"
                                         aria-hidden="true">
                                        <path d="M19 19H5V5h7V3H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2v-7h-2v7zM14 3v2h3.59l-9.83 9.83 1.41 1.41L19 6.41V10h2V3h-7z"></path>
                                    </svg>
                                    </span>
                                </span>
                        </a>
                        <img src="<?php
                        echo plugins_url('admin/img/first_image_select.png', JSV360_MAIN_URL) ?>" class="jsv__image-select"
                             alt="Select the first image">
                    </div>
                </div>
            </li>
            <li class="jsv-list-item-root" style="max-width: 550px;">
                <div class="jsv-list-item-icon-root jsv-pr-3 jsv-mt-2">
                    <svg class="jsv-svg-icon-root jsv-svg-icon-color" focusable="false"
                         viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M4.75 8.12891L12.6953 0.183594L13.75 1.23828L4.75 10.2383L0.566406 6.05469L1.62109 5L4.75 8.12891Z"
                              fill="#7A5CBD"/>
                    </svg>
                </div>
                <div class="jsv-list-item-text-root jsv-d-flex jsv-flex-column jsv-m-0">
                    <p class="jsv-typography-root jsv-body2" style="color: rgba(0, 0, 0, 0.6);">
                        <?= __(
                            'Copy/paste the code in a widget, on a page or in WooCommerce',
                            'jsv'
                        ) ?>
                    </p>
                </div>
            </li>
            <li class="jsv-list-item-root" style="max-width: 550px;">
                <div class="jsv-list-item-icon-root jsv-pr-3 jsv-mt-2">
                    <svg class="jsv-svg-icon-root jsv-svg-icon-color" focusable="false"
                         viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M4.75 8.12891L12.6953 0.183594L13.75 1.23828L4.75 10.2383L0.566406 6.05469L1.62109 5L4.75 8.12891Z"
                              fill="#7A5CBD"/>
                    </svg>
                </div>
                <div class="jsv-list-item-text-root jsv-d-flex jsv-flex-column jsv-m-0">
                    <p class="jsv-typography-root jsv-body2" style="color: rgba(0, 0, 0, 0.6);">
                        <?= __(
                            'If you need other specific options check the <a href="https://wordpress.org/plugins/360deg-javascript-viewer/#installation" target="_blank">readme</a>. Like margins, floats and width',
                            'jsv'
                        ) ?>
                    </p>
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