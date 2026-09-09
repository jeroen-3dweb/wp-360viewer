<?php include('header.php'); ?>
<h1>Create a 360&deg; view</h1>
<p class="jsv-lead">Prepare your photos, configure the view, then add it to WordPress.</p>
<section class="jsv-panel">
    <h2>1. Upload your photo sequence</h2>
    <p>Use photos of the same product taken from successive angles around a full circle. Keep the product in the same position and use the same image dimensions for every photo.</p>
    <p>Give the files matching names with consecutive numbers, such as <code>product_01.jpg</code>, <code>product_02.jpg</code> and <code>product_03.jpg</code>. Upload the whole sequence together so the files share the same folder.</p>
    <a class="button" href="<?= esc_url(admin_url('media-new.php')) ?>" target="_blank" rel="noopener noreferrer">Upload photos to Media Library (new tab)</a>
    <details class="jsv-help"><summary>See an example photo sequence</summary><?php include('image-sequence.php'); ?></details>
    <p class="description">Resize and compress large photos before uploading to keep loading times short. More photos can make rotation smoother, but also increase the amount visitors need to download.</p>
</section>
<section class="jsv-panel">
    <h2>2. Select your first photo and configure the view</h2>
    <p>Once all photos are uploaded, select only the first photo in the sequence. Our online setup tool opens in a new tab with that photo's URL. Use it to set the filename pattern and number of photos so the viewer can load the remaining images.</p>
    <button id="jsv-go-button" type="button" class="button button-primary">Select first photo &amp; open setup tool</button>
    <p class="jsv-help">Your photos must be publicly accessible for the online tool to show them. Photos on localhost or a password-protected website will not load there.</p>
    <details class="jsv-help"><summary>My photos are hosted on another website</summary>
        <p>You can also use publicly accessible image URLs. <a href="https://www.360-javascriptviewer.com/wordpress?utm_source=wordpress&amp;utm_medium=pluginhome&amp;utm_campaign=3dweb" target="_blank" rel="noopener noreferrer">Open the setup tool (new tab)</a> and enter the first photo's URL.</p>
    </details>
    <p>Check that every angle loads in the preview, then copy the generated <strong>shortcode</strong>: the text starting with <code>[360-jsv</code> and ending with <code>]</code>.</p>
</section>
<section class="jsv-panel">
    <h2>3. Add the view to WordPress</h2>
    <ol>
        <li>Return to WordPress and open the page or post you want to edit.</li>
        <li>Click <strong>+ Add block</strong>, search for <strong>Shortcode</strong> and add that block.</li>
        <li>Paste the complete shortcode from the setup tool.</li>
        <li>Preview the page and drag the product to check the rotation. Publish or update the page when you are happy with it.</li>
    </ol>
    <details class="jsv-help"><summary>Use the view in WooCommerce</summary><p>Edit a product and paste the shortcode into the <strong>360 Javascript Viewer Code</strong> box. Make sure the product gallery contains images, then update and preview the product.</p><a href="<?= esc_url(menu_page_url(JSV_360_ADMIN_WOOCOMMERCE::PATH, false)) ?>">View WooCommerce settings</a></details>
    <details class="jsv-help"><summary>Use the view in Elementor</summary><p>Add Elementor's Shortcode widget, paste the complete shortcode and preview the page.</p></details>
</section>
<script>
jQuery(function ($) {
    $('#jsv-go-button').on('click', function () {
        const uploader = wp.media({
            title: 'Select the first photo in your sequence',
            library: { type: 'image' },
            button: { text: 'Use this photo and open setup tool' },
            multiple: false
        });
        uploader.on('select', function () {
            const selected = uploader.state().get('selection').first();
            if (!selected) return;
            const url = new URL('https://www.360-javascriptviewer.com/wordpress');
            url.searchParams.set('utm_source', 'wordpress');
            url.searchParams.set('utm_medium', 'pluginhome');
            url.searchParams.set('utm_campaign', '3dweb');
            url.searchParams.set('main_url', btoa(selected.toJSON().url));
            window.open(url.toString(), '_blank', 'noopener,noreferrer');
        });
        uploader.open();
    });
});
</script>
<?php include('footer.php'); ?>
