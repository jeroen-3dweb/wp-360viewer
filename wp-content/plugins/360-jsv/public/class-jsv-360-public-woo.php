<?php

class JSV_360_Public_Woo
{
    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $plugin_name The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $version The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @param string $plugin_name The name of the plugin.
     * @param string $version The version of this plugin.
     * @since    1.0.0
     */
    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version     = $version;
    }

    private function generateId() {
        $permitted_chars = implode('', range('a', 'z'));
        return 'jsv-' .  '-' . substr(str_shuffle($permitted_chars), 0, 10);
    }

    public function add_360_icon($d, $e)
    {
        if ($bbCode = $this->getBBCode()) {
            global $product;
            $attachment_ids = $product->get_gallery_image_ids();

            if ($e == end($attachment_ids)) {
                $html = (new JSV_360_Parser($this->plugin_name, $this->version))->parse($bbCode);
                $htmlLarge = (new JSV_360_Parser($this->plugin_name, $this->version))->parse($bbCode);
                $randomId = $this->generateId();

                $mainImage  = 'https://360-viewer.gumlet.net/blue-shoe-small/20180906-001-blauw.jpg';
                $thumbImage = plugins_url('/img/icon.png', __FILE__);
                $text       =
                    <<<EOD
                    <div data-thumb="$thumbImage"  class="woocommerce-product-gallery__image">
                        <script lang="text/javascript">loadjsv(`$html`, `$randomId`,'$htmlLarge')</script>
                          <a href="$mainImage" id="$randomId">
                            <img width="416" height="312"
                            src="" 
                            class="wp-post-image" alt="" loading="lazy" title="blauw" data-caption="" 
                            data-large_image="$mainImage" 
                            data-large_image_width="640" 
                            data-large_image_height="480" />
                        </a>
                    </div>                    
                    EOD;


                return $d .$text;
            }
        }
        return $d;
    }

    private function getBBCode()
    {
        /** @var WC_Product $product */
        global $product;
        return $product->get_meta(JSV_360_WOO_METABOX::FIELD_BBCODE) ?: null;
    }
}
