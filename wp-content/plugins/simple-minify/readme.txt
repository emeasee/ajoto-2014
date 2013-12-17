=== Simple Minify ===
Contributors: Khouildi Salah
Donate link: 
Tags: assets, minify, css, js, less, sass, compass, coffeeScript
Requires at least: 3.3
Tested up to: 3.7.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Stable tag: 1.0.0

Simple Minify allow you to compress and minify all your javascripts or css ressources. Compatible with css, js, sass, less, compass and CoffeeScript.
Enjoy with the best minify and compress ressources plugin!

== Description ==
(based on Assets Minify by Alessandro Carbone)

How many times have you wished to minify in a clean way all the stylesheets and scripts of a WordPress website?

Simple Minify takes every CSS and JS asset included using `wp_enqueue_style()` and `wp_enqueue_script()` and Merges+Minifies them.

You can also use Simple Minify to create your WP theme using Compass / SASS / LESS without configuring any `config.rb` or *that kind of stuff*.

If you have conflict with some ressources, you can excluded them in the back-office.

Simple Minify is based on Assetic library.

== Installation ==

1. Upload the `simple-minify` folder to the `/wp-content/plugins/` directory
1. Activate the Simple Minify plugin through the 'Plugins' menu in WordPress
1. Set write permission to uploads directory. In most cases: chmod 777 wp-content/uploads/
1. Configure the plugin by going to the `Settings > Simple Minify` menu that appears in your admin menu: you can choose whether to use Compass to compile SASS files or not flagging "Use Compass" field. If you check the flag "Use Compass" you can also specify the Compass compiler's path ( default is /usr/bin/compass ).
In this page, you can also include/exclude external or local ressources, remove cache, disabled compress for css or js.
1. Important! If you choose to use Compass, the [PHP proc_open function](http://php.net/manual/en/function.proc-open.php) has to be enabled from the server on which the website relies.

== Frequently asked questions ==

= Which version of PHP is needed to use Simple Minify on my WordPress installation? =

PHP 5.3+

= How can I excluded some ressources? =

In settings->SimpleMinify, you can exclude all ressources you want.
In "Resources to exclude" field, fill in the filename of the resources you don't want to be managed from AssetsMinify, separated by comma. (eg. custom-carousel.js, slideshow.css)

= How can I include some external ressources? =

In settings->SimpleMinify, you can include all external ressources you want.
In "Domains of styles to include" or "Domains of scripts to include" field, fill in the domains of the styles you want to be managed from AssetsMinify, separated by comma. (eg. fonts.googleapis.com, minify.fr).

= How can I disabled compress ressources? =

In settings->SimpleMinify, you can disabled compress ressources.
Uncheck "Compress scripts" or "Compress styles" box.

= How can I disabled compress external ressources? =

In settings->SimpleMinify, you can disabled external compress ressources.
Uncheck "Compress external scripts" or "Compress external styles" box.

= How can I remove cache ressources? =

In settings->SimpleMinify, you can remove cache ressources.
Click on "Empty AssetsMinify's Cache" link.


