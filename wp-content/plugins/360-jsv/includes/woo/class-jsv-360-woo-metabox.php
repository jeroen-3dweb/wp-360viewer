<?php

class JSV_360_WOO_METABOX
{

    const FIELD_BBCODE = 'jsv_360_woo_bbcode_';

    const FIELD_NONCE = 'jsv_360_woo_nonce_';

    /**
     * @var string $pluginName
     */
    private $pluginName;

    /**
     * @var string $version
     */
    private $version;

    /**
     * JSV_Parser constructor.
     * @param $pluginName
     * @param $version
     */
    public function __construct($pluginName, $version)
    {
        $this->pluginName = $pluginName;
        $this->version    = $version;
    }


    public function addBoxes($post_type)
    {
        if (in_array($post_type, ['product'])) {
            add_meta_box(
                'sr-product-360-view',
                '360 Javascript Viewer Code',
                array(
                    self::class,
                    'jsv_360_woo_product_360_view_callback'
                ),
                $post_type,
                'normal',
                'core'
            );
        }
    }

    public function saveBoxes($post_id)
    {
        if (!isset($_POST[self::FIELD_NONCE]) || (empty($_POST[self::FIELD_NONCE]) || !wp_verify_nonce(
                    $_POST[self::FIELD_NONCE],
                    basename(__FILE__)
                ))) {
            return;
        }

        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        if (isset($_POST[self::FIELD_BBCODE])) {
            update_post_meta($post_id, self::FIELD_BBCODE, $_POST[self::FIELD_BBCODE]);
        } else {
            delete_post_meta($post_id, self::FIELD_BBCODE);
        }
    }

    static function jsv_360_woo_product_360_view_callback($post)
    {
        wp_nonce_field(basename(__FILE__), self::FIELD_NONCE);
        $bbCode = sanitize_meta(self::FIELD_BBCODE, get_post_meta($post->ID, self::FIELD_BBCODE, true), 'post');
        ?>
        <table class="form-table">
            <tr>
                <td>
                    <div>
                        <p>Enter your shortcode here
                            <strong><?= __('Shortcode:', 'jsv_360_view'); ?>
                                <a target="_blank" href="https://www.360-javascriptviewer.com/wordpress" title="create code online">
                                    tool for creating code
                                </a></strong> <br>
                            Make sure you have images in the product gallery, or else you won't see the 360 icon.
                            You can use this shortcode also for the 360 widget if you want to show the 360 presentation somewhere else on the page.
                        </p>
                        <br>

                        <textarea placeholder="[360-jsv id=<3dweb id>]" rows="10" cols="100" class="jsv-360-woo-bbcode" type="text" name="<?= self::FIELD_BBCODE ?>" ><?= $bbCode ?> </textarea>
                    </div>
                </td>
            </tr>
        </table>
        <?php
    }
}