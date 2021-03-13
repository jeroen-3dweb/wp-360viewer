<?php

/** @var int $image_id */
if( $image = wp_get_attachment_image_src($image_id ) ) {

    echo '<a href="#" class="jsv-upl"><img class="jsv-notifier-upload-thumb" src="' . $image[0] . '" /></a>
	      <a href="#" class="jsv-rmv">Remove image</a>
	      <input type="hidden" name="jsv-notifier-img" value="' . $image_id . '"/>';

} else {

    echo '<a href="#" class="jsv-upl">Upload image</a>
	      <a href="#" class="jsv-rmv" style="display:none">Remove image</a>
	      <input type="hidden" name="jsv-notifier-img" value="">';
}