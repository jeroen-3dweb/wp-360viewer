<?php

class JSV_360_Public_Woo_Flatsome extends JSV_360_Public_Woo_Base
{

    const THEME_NAME = 'flatsome';

    private $counts = 0;

    public function add_360_icon($d, $e)
    {
        // where is function called from?
        // $d is the html content of the product image
        // $e is the attachment id of the product image

        $bbCode = $this->getBBCode();
        if (!empty($bbCode) and strlen($bbCode) > 10) {
            global $product;
            $attachment_ids = $product->get_gallery_image_ids();

            if ($e == end($attachment_ids)) {
                $this->counts++;
//                if ($this->counts < 2) {
//                    return $d;
//                }

                $html = (new JSV_360_Parser($this->plugin_name, $this->version))->parse($bbCode);
                $randomId = $this->generateId();

                $thumbImage = plugins_url('/icon.png', __FILE__);
                $script = sprintf(
                    '
                            <script lang="text/javascript">window.addEventListener("load", () => 
                            {setTimeout(function(){
                                 createJsvWooInstance(`%s`, `%s`, `%s`)}, 1000)
                            });
                            </script>
                            ',
                    $html,
                    $randomId,
                    $this->counts > 1
                );

                $text = sprintf(
                    '
                            <div class="col"">
				                <a class="jsv-flatsome">
					                <img loading="lazy" src="%s" alt="" width="247" height="296" class="attachment-woocommerce_thumbnail">		
							    </a>
			                </div>
                            ',
                    $thumbImage
                );

                return  $d . $script . $text;
            }
        }
        return $d;
    }
}