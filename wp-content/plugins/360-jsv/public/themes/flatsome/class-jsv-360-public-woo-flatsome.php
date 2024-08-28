<?php

class JSV_360_Public_Woo_Flatsome extends JSV_360_Public_Woo_Base
{

    const THEME_NAME = 'flatsome';

    public function add_360_icon($d, $e)
    {
        $bbCode = $this->getBBCode();
        if (!empty($bbCode) and strlen($bbCode) > 10) {
            global $product;
            $attachment_ids = $product->get_gallery_image_ids();

            if ($e == end($attachment_ids)) {
                $html = (new JSV_360_Parser($this->plugin_name, $this->version))->parse($bbCode);
                $randomId = $this->generateId();

                $thumbImage = plugins_url('/icon.png', __FILE__);
                $text       = sprintf(
                    '
                            <script lang="text/javascript">window.addEventListener("load", () => 
                            {setTimeout(function(){
                                 createJsvWooInstance(`%s`, `%s`)}, 1000)
                            });
                            </script>
                            <div class="col"">
				<a>
					<img loading="lazy" src="%s" alt="" width="247" height="296" class="jsv-flatsome attachment-woocommerce_thumbnail">		
							</a>
			</div>
                            ',
                    $html,
                    $randomId,
                    $thumbImage
                );

                return $d . $text;
            }
        }
        return $d;
    }
}