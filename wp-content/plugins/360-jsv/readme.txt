=== 360 Javascript Viewer ===
Contributors: jtermaat
Tags: 360, 360 product view, 360 product rotation, 360 product viewer,360 image, 3d product viewer, 360 view software,
product rotation, objectvr, object vr, 3D product rotation, 3D, product spin, 360 product spin
Requires at least: 3.3.0
Requires PHP: 5.6
Tested up to: 5.5.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Stable tag: 1.5.6

Turn a series of product images into an interactive 360 degree view.

== Description ==

####Features####
* Full 360° view
* Responsive design
* Unlimited presentations on a single page
* Just upload your images to your media library, no external service needed
* Variable amount of frames, limit is 365 images
* Customize speed and inertia
* Reverse dragging
* Custom frame format, no renaming of files
* Optional autorotation on start
* Reverse autorotation
* Speed autorotation
* Custom start frame
* ShortCodes system, [generate the shortcodes online for more control](https://www.360-javascriptviewer.com/wordpress)
* Very lightweight (50kb)

== Installation ==

1. Upload the plugin files to the `your_wordpress_plugins_dir/360deg-javascript-viewer` directory, or Install as a regular WordPress plugin
2. Go your Plugins page in the WordPress Dashboard and activate it

####Shortcode parameters####
[Generate the shortcodes online](https://www.360-javascriptviewer.com/wordpress)

`example: [360-jsv total-frames=72 speed=90 inertia=30 max-width=200]  // will take the default image`
`example: [360-jsv main-image-url=your/image.jpg total-frames=16 speed=90 inertia=30 image-url-format=your/image_xx.jpg]`

* **main-image-url** is the url to the main image, that is the base for all the other frames
* **total-frames** is the total number of frames in the presentation
* **speed** is the speed of rotating
* **inertia** is the delay when the user stops dragging
* **reverse** inverts the rotation direction when dragging
* **image-url-format** give a format for the next frames
* **max-width** sets the max-width of the presentation in px

== Changelog ==
= 1.0 =
* Basic version, still under development
= 1.0.1 =
* Bugfixes in viewer, update to v0.0.45
= 1.1.0 =
* Added optional autorotation on start