=== 360 Javascript Viewer ===
Contributors: jtermaat
Tags: 360, 360 product view, 360 product rotation, 360 product viewer, 3d product viewer, 360 view software,
product rotation, objectvr, object vr, 3D product rotation, 3D, product spin, 360 product spin
Requires at least: 3.3.0
Requires PHP: 5.6
Tested up to: 5.5.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Stable tag: 1.5.6

Turn a series of product images into an interactive 360 degree view.

== Description ==

####Features####
* Full 360° view
* Responsive design
* Works on mobile devices
* Unlimited presentations on a single page
* Customize speed and inertia
* Reverse dragging
* ShortCodes System
* Very Lightweight

== Installation ==

1. Upload the plugin files to the `your_wordpress_plugins_dir/360deg-javascript-viewer` directory, or Install as a regular WordPress plugin
2. Go your Plugins page in the WordPress Dashboard and activate it

####Shortcode parameters####
example [360-jsv total-frames=72 speed=90 inertia=30 max-width=200]  // will take the default image
example [360-jsv main-image-url=your/image.jpg total-frames=16 speed=90 inertia=30 image-url-format=your/image_xx.jpg]
* **main-image-url** is the url to the main image, that is the base for all the other frames
* **total-frames** is the total number of frames in the presentation
* **speed** is the speed of rotating
* **inertia** is the delay when the user stops dragging
* **reverse** inverts the rotation direction when dragging
* **image-url-format** give a format for the next frames
* **max-width** sets the max-width of the presentation in px

== Changelog ==
= 1.0 =
Basic version, still under development