<?php

class JSV_360_Public_Woo_TwentyTwentyThree extends JSV_360_Public_Woo_Base
{
    const THEME_NAME = 'twentytwentythree';

    public function add_360_icon($d, $e)
    {
        $bbCode = $this->getBBCode();
        if (!empty($bbCode) and strlen($bbCode) > 10) {
            global $product;
            $attachment_ids = $product->get_gallery_image_ids();
			$text = '';

            if ($e == end($attachment_ids)) {
                $html = (new JSV_360_Parser($this->plugin_name, $this->version))->parse($bbCode);
				if(empty(trim($html))){
					$text .= sprintf('<script lang="text/javascript">window.addEventListener("load", () => 
							{
                                console.warn("360-jsv: No valid shortcode found in product gallery. Please check your code: %s");
							});
							</script>', $bbCode);
				}

                $randomId = $this->generateId();

                $thumbImage = plugins_url('/icon.png', __FILE__);
                $text .= sprintf(
                    '          <div style="min-height:50px;" data-thumb="%s"  class="woocommerce-product-gallery__image">
                            <script lang="text/javascript">window.addEventListener("load", () => 
                            {setTimeout(function(){
                                createJsvWooInstance(`%s`, `%s`, `%s`)}, 1000)
                            });
                            </script>
                              <a href="%s" id="%s">
                                <img width="416" height="312"
                                src="" 
                                class="wp-post-image" alt="" loading="lazy" data-caption=""  
                                data-large_image="%s" 
                                data-large_image_width="640" 
                                data-large_image_height="480"
                                 />                                
                            </a>                            
                        </div> ',
                    $thumbImage,
                    $html,
                    $randomId,
                    $html,
                    $thumbImage,
                    $randomId,
                    $thumbImage
                );

                return $d . $text;
            }
        }
        return $d;
    }
}