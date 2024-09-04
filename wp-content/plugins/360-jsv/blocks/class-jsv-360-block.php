<?php

class JSV_360_Block
{

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

    public function register()
    {
        if (!function_exists('register_block_type')) {
            return;
        }

        $path = realpath(__DIR__ . '/../build/');

        register_block_type($path,
            [
                'render_callback' => [$this, 'render'],
            ]);
    }

    public function render($attributes, $code, $blockInfo)
    {
        $source = $code;

        if (isset($attributes['useACFProduct']) && $attributes['useACFProduct']) {
            $acfCode = $this->getACFCode();
            if ($acfCode) {
                $source = $acfCode;
            }
        }

        if (isset($attributes['useWooCommerceProduct']) && $attributes['useWooCommerceProduct']) {
            $wooCode = $this->getWooCommerceCode();
            if ($wooCode) {
                $source = $wooCode;
            }
        }

        if (strpos($source, '[360') === false) {
            return '';
        }

		$reference = isset($attributes['reference']) ? $attributes['reference'] : null;

        return (new JSV_360_Parser($this->pluginName, $this->version))->parse($source, $reference);
    }

    private function getACFCode()
    {
        $acfFieldName = get_option(JSV_360_ADMIN_ACF::ACF_FIELD, '');
        $post_id      = get_queried_object_id();
        return $post_id ? get_post_meta($post_id, $acfFieldName, true) : false;
    }

    private function getWooCommerceCode()
    {
        global $product;
        return $product ? get_post_meta($product->get_id(), 'jsv_360_woo_bbcode_', true) : false;
    }
}