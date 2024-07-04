<?php

include('header.php') ?>

    <div class="jsv-360__dedicated">
        <h1 class="jsv-typography-root jsv-typography-dark jsv-typography-h1">
            <?= __('Local configuration', 'jsv360') ?>
        </h1>
        <h6 class="jsv-typography-root jsv-typography-grey jsv-typography-h6 jsv-mt-4 jsv-mb-2 external-link">
            <?= __(
                'In two steps you can create your presentation, need more help? Check out this <a target="_blank" href="https://www.youtube.com/watch?v=qYCD2sL1lM0">video</a>',
                'jsv'
            ) ?>
        </h6>

        <div class="jsv-360__dedicated__card-holder">
<!--            step 1-->
            <div class="jsv-360__dedicated__card-holder__card">
                <div class="jsv-360__dedicated__card-holder__card-left external-link">
                    <h3 style="clear: both">
                        <?= __(
                            'Generate your shortcode',
                            'jsv'
                        ) ?></h3>
                    <p>       <?= __(
                            'Select the first image (yourimage_01.jpg) from your media library, You will be redirected to our website where you can easily generate your shortcode',
                            'jsv360'
                        ) ?>

                        <br>
                        <?= __(
                            'Are your images hosted somewhere else?<br>
 Click <a target="_blank" href="https://www.360-javascriptviewer.com/wordpress?utm_source=wordpress&utm_medium=pluginhome&utm_campaign=3dweb">here</a> to configure your presentation',
                            'jsv'
                        ) ?>

                        <br>
                        <br>
                        <a id='jsv-go-button'
                           href="#"
                           class="jsv-360__button jsv-360__button--normal  jsv-mb-4 jsv-mt-2"
                           tabindex="0"
                           type="button"
                           data-element-type="button">
                                <span class="jsv-button-label" style="width: 100%;">
                                    <?= __('select your first image and get started!', 'jsv') ?><span
                                            class="jsv-button-endIcon">
                                    </span>
                                </span>
                        </a>

                    </p>
                    <?php
                        if(JSV_360_Admin_HELPER::isLocalhost()) {
                    ?>
                    <p class="warning">
                        <span class="warn warning"></span>
                        <?= __(
                            'Make sure you images are reachable from the internet. Otherwise the tool to create a shortcode won\'t work.',
                            'jsv'
                        ) ?>
                    </p>
                    <?php } ?>
                </div>
                <div class="jsv-360__dedicated__card-holder__card-right">
                    <img src="<?php
                    echo plugins_url('admin/img/first_image_select.png', JSV360_MAIN_URL) ?>" class="jsv__image-select"
                         alt="Select the first image">
                </div>
            </div>
<!--            step 2-->
            <div class="jsv-360__dedicated__card-holder__card">
                <div class="jsv-360__dedicated__card-holder__card-left">
                    <h3 style="clear: both">
                        <?= __(
                            'Paste the shortcode',
                            'jsv'
                        ) ?></h3>

                    <p>           <?= __(
                            'Copy/paste the code in a widget, on a page, in a block or in WooCommerce',
                            'jsv'
                        ) ?></p>
                </div>
                <div class="jsv-360__dedicated__card-holder__card-right">
                    <img width="200px" src="<?php
                    echo plugins_url('admin/img/copy_code.png', JSV360_MAIN_URL) ?>" class="jsv__image-select"
                         alt="Select the first image">
                </div>
            </div>
        </div>
    </div>

    <script type="application/javascript">
      jQuery(function ($) {
        $('body').on('click', '#jsv-go-button', function (e) {

          e.preventDefault()

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
              const attachment = custom_uploader.state().get('selection').first().toJSON()
              const img = btoa(attachment.url)
              const url = `https://www.360-javascriptviewer.com/wordpress?utm_source=wordpress&utm_medium=pluginhome&utm_campaign=3dweb&main_url=${img}`
              window.open(url, '_blank')
            }).open()

        })
      })
    </script>

<?php
include('footer.php'); ?>