=== Simple Minify ===
Contributors: Salah Khouildi based on AssetsMinify by Alessandro Carbone
Donate link: 
Tags: assets, minify, css, js, less, sass, compass
Requires at least: 3.3
Tested up to: 3.7.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Stable tag: 1.2.0

Use Compass, SASS, LESS and CoffeeScript (NEW) to develop your themes and minify your stylesheets and JavaScript simply by installing Simple Minify.

== Description ==

How many times have you wished to minify in a clean way all the stylesheets and scripts of a WordPress website?

Simple Minify takes every CSS and JS asset included using `wp_enqueue_style()` and `wp_enqueue_script()` and Merges+Minifies them.

You can also use Simple Minify to create your WP theme using Compass / SASS / LESS without configuring any `config.rb` or *that kind of stuff*.

Simple Minify is based on Assetic library.

This plugin has been tested up to WordPress 3.7.1 beta.

= Define inclusion-sets per-page =

Although it is not a best practice you can define resources inclusions basing on the WordPress page just like this `if ( is_page( 2 ) ) { wp_enqueue_style( 'stylesheet-name' ); }`.

== Installation ==

1. Upload the `simple-minify` folder to the `/wp-content/plugins/` directory
1. Activate the Simple Minify plugin through the 'Plugins' menu in WordPress
1. Set write permission to uploads directory. In most cases: chmod 777 wp-content/uploads/
1. Configure the plugin by going to the `Settings > Simple Minify` menu that appears in your admin menu: you can choose whether to use Compass to compile SASS files or not flagging "Use Compass" field. If you check the flag "Use Compass" you can also specify the Compass compiler's path ( default is /usr/bin/compass ).
1. Important! If you choose to use Compass, the [PHP proc_open function](http://php.net/manual/en/function.proc-open.php) has to be enabled from the server on which the website relies.

== Frequently asked questions ==

= Which version of PHP is needed to use Simple Minify on my WordPress installation? =

PHP 5.3+


== Screenshots ==

1. Simple Minify's configuration panel
2. How to include your stylesheets
3. Set 777 permissions to you uploads directory

== Changelog ==



== Upgrade notice ==
