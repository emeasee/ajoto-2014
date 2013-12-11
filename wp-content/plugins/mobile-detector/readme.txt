=== Plugin Name ===
Contributors: Tubal
Tags: mobile, detector, switcher, theme, device, browser, os
Requires at least: 3.0
Tested up to: 3.5
Stable tag: trunk

Lightweight detector of mobile devices, OSs & browsers. Optionally a mobile theme switcher.

== Description ==

A lightweight detector of mobile devices, OSs & browsers that, optionally, allows your site to switch to a mobile theme when a mobile device is detected or when your users feel like it.

This plugin adds the class **MobileDTS** to Wordpress.

= Mobile Detection =

On every request, this plugin will try to detect if the user is viewing your site with a mobile device or not. If he is, the detector will also give you some info about the device, browser and OS used.

**Who will be happy with this detector?**

If you need a fast and reliable way to detect if a user is visiting your site with a mobile device, then you'll be happy. However, if you need precise information about the device used (other than OS and browser) such as screen resolution you need a detector such as [DeviceAtlas](http://deviceatlas.com/) or [WURFL](http://wurfl.sourceforge.net/).

**How to query the detector?**

Use the method `MobileDTS::is($key)`. `is()` returns boolean `true` or `false`.

Example:

`<?php

if (MobileDTS::is('android')) {
	// User with a mobile device running Android OS
} else if (MobileDTS::is('ios')) {
	// User with a mobile device running iOS
} else if (MobileDTS::is('mobile')) {
	// User with a mobile device (any, even 10 years old mobile phones)	
} else {
	// User with a desktop device	
}

?>`

**Available keys:**

* `mobile` (Is it a mobile?)
* `other` (Any other mobile device)

Popular mobile devices

* `iphone` (Apple iPhone)
* `ipad` (Apple iPad)
* `kindle` (Amazon Kindle)

Mobile OS

* `android` (Android OS)
* `bada` (Bada OS)
* `bbos` (Blackberry OS)
* `ios` (Apple iOS)
* `palmos` (Palm OS)
* `symbian` (Symbian OS)
* `webos` (Hp WebOS)
* `windows` (Windows Phone OS and older)

Mobile browsers

* `ff_mobile` (Mozilla Fennec & Firefox mobile)
* `ie_mobile` (IE mobile)
* `netfront` (NetFront)
* `opera_mobile` (Opera Mobile or Mini)
* `uc_browser` (UC Browser)
* `webkit_mobile` (Webkit mobile)

= Theme Switching = 

You can configure your site to automatically switch to a mobile theme when a mobile device is detected or when the user requests it (on demand).

Once the plugin is installed, a new submenu titled `Mobile Detector` is added under the `Settings` menu. 

Theme switching is disabled by default. To enable theme switching simply select a theme to use as your mobile theme and the plugin will take care of the rest.

This plugin assumes your active theme is optimized for desktop screens only. So, if you're using a responsive theme that adapts to any screen size you shouldn't use the theme switching feature (don't select a theme).

**How it works:**

* On each page load, this plugin checks for the existence of a cookie that stores which theme (mobile-optimized or desktop-optimized) the user prefers to browse.
* If the cookie exists, the theme the user expects will be displayed.
* If the cookie does not exist (first-time visitor), this plugin checks whether the user is visiting your site with a mobile device or not and, if he is, your mobile-optimized theme will be used. Afterwards, a cookie will be set to store the user's "initial preference".
* Anytime the user switches (you must create a link/button in your theme using the Template functions below) between themes, the cookie is updated with his preference so the site version (theme) the user expects will be displayed on future visits.

**Template functions**

* `MobileDTS::get_switch_theme_link()` Returns the current URL with an additional `switch_theme` parameter (set automatically to 'mobile' or 'desktop'). You'll need this function to create a link/button that allows users to switch between the desktop and mobile themes. See example below.

* `MobileDTS::switch_theme_link()`: same as above but this one outputs the URL instead of returning it. URL is escaped.

* `MobileDTS::get_switch_theme_name()` returns the type of the theme to switch to (either 'mobile' or 'desktop'). Use this method together with `get_switch_theme_link()`. The type can be translated to your language (plugin uses wp's `__()` function for 'mobile' & 'desktop' strings).

* `MobileDTS::switch_theme_name()` same as above but this one outputs the type instead of returning it.

* `MobileDTS::is_mobile_theme()` tells you wether your site is displaying to the user the mobile theme or not. Returns boolean `true` or `false`.

* `MobileDTS::is_switcher_enabled()` tells you wether theme switching is disabled or not. Returns boolean `true` or `false`.

**Creating a 'Switch to ...' link**         

Let's create a switch link to allow the user to switch between the 2 versions of a site (themes):

`
<?php if (MobileDTS::is_switcher_enabled()): // Optional but useful if you need to disable theme switching for a while. ?>

<a href="<?php MobileDTS::switch_theme_link() ?>">Switch to the <?php MobileDTS::switch_theme_name() ?> version of this site</a>

<?php endif; ?>
`

Paste that code in your templates (usually in `header.php` and/or `footer.php`), enable theme switching and play a little.

Let's suppose a user is viewing the site (http://example.com/home) for the first time with a mobile device and theme switching is enabled. The above code would output this link:

`
<a href="http://example.com/home?switch_theme=desktop">Switch to the desktop version of this site</a>
`

== Screenshots == 

1. Theme switching settings page. Select a mobile theme or disable theme switching.

== Changelog ==

= 2.0.2 =
* The cookie now has both `path` & `domain` set as per Wordpress documentation (COOKIEPATH & COOKIE_DOMAIN constants) to avoid some rare cases.
* Memory footprint reduced since admin related code is from now on in a different file.
* New template function added: `is_switcher_enabled()`.

= 2.0.1 =
* Small bugfix regarding mobile detection.

= 2.0 =
* Complete rewrite. New API.
* Improved & updated mobile detection engine.
* Added theme switching.

= 1.1 =
* Code refactored. Cleaner to extend if you need to.
* Removed `$is_other_os` & `$is_other_browser`.

= 1.0 =
* Initial release.

== Installation ==

1. Upload `mobile-detector` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Done!