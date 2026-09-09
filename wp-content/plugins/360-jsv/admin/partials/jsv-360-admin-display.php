<?php include('header.php'); ?>
<h1>Create a product view your visitors can rotate</h1>
<p class="jsv-lead">Turn a sequence of product photos into an interactive 360&deg; view for your WordPress page or shop.</p>
<div class="jsv-actions">
    <a class="button button-primary button-hero" href="<?= esc_url(menu_page_url(JSV_360_ADMIN_DEDICATED::PATH, false)) ?>">Create your first 360&deg; view</a>
    <a href="https://wordpress.360-javascriptviewer.com/" target="_blank" rel="noopener noreferrer">See a live example (new tab)</a>
</div>
<p class="description">You can use the free version with &ldquo;Powered by&rdquo; branding. A license is optional.</p>
<section class="jsv-panel">
    <h2>Start with photos from different angles</h2>
    <p>You need a sequence of photos of the <strong>same product</strong>, taken as it turns through a full circle. The plugin plays these photos in order as a visitor drags. It does not create a 360&deg; view from a single photo.</p>
    <?php include('image-sequence.php'); ?>
</section>
<section class="jsv-panel">
    <h2>Your first 360&deg; view in 3 steps</h2>
    <ol class="jsv-steps">
        <li><h3>Upload your photo sequence</h3><p>Add all photos to your WordPress Media Library. Keep their numbered filenames in order.</p></li>
        <li><h3>Configure your view</h3><p>Select the first photo, then continue to our online setup tool in a new tab. Check the image sequence and copy your shortcode.</p></li>
        <li><h3>Add it to a page</h3><p>Return to WordPress. Add a Shortcode block to a page, paste the code and preview your 360&deg; view.</p></li>
    </ol>
</section>
<?php include('footer.php'); ?>
