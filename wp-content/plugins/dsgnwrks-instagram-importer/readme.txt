=== Plugin Name ===
DsgnWrks Instagram Importer

Contributors: jtsternberg
Plugin Name: DsgnWrks Instagram Importer
Plugin URI: http://dsgnwrks.pro/plugins/dsgnwrks-instagram-importer
Tags: instagram, import, backup, photo, photos, importer
Author URI: http://jtsternberg.com/about
Author: Jtsternberg
Donate link: http://j.ustin.co/rYL89n
Requires at least: 3.1
Tested up to: 3.9.1
Stable tag: 1.2.9
Version: 1.2.9
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Backup your instagram photos & display your instagram archive. Supports importing to custom post-types & adding custom taxonomies.

== Description ==

In the spirit of WordPress and "owning your data," this plugin will allow you to import and backup your instagram photos to your WordPress site. Includes robust options to allow you to control the imported posts formatting including built-in support for WordPress custom post-types, custom taxonomies, post-formats. You can control the content of the title and content of the imported posts using tags like `**insta-image**`, `**insta-text**`, and others, or use the new conditional tags `[if-insta-text]Photo Caption: **insta-text**[/if-insta-text]` and `[if-insta-location]Photo taken at: **insta-location**[/if-insta-location]`. Add an unlimited number of user accounts for backup and importing.

As of version 1.2.0, you can now import and backup your instagram photos automatically! The plugin gives you the option to choose from the default WordPress cron schedules, but if you wish to add a custom interval, you may want to add the [wp-crontrol plugin](http://wordpress.org/extend/plugins/wp-crontrol/).

Version 1.2.6 introduced many new features for Instagram video. Your videos will now be imported to the WordPress media library, as well as the cover image. The new shortcode, `[dsgnwrks_instagram_embed src="INSTAGRAM_MEDIA_URL"]`, displays your imported media as an Instagram embed (works great for video!) and finally, you can now use the tags, `**insta-embed-image**`, and `**insta-embed-video**`, in the Post Content template to save the `dsgnwrks_instagram_embed` shortcode to the post.

Plugin is built with developers in mind and has many filters to manipulate the imported posts.

--------------------------

= Sites That Have Used the Importer =

* [stevenfurtick.com](http://www.stevenfurtick.com/)
* [instadre.com](http://instadre.com/)
* [photos.jkudish.com](http://photos.jkudish.com/)
* [aaronrutley.com](http://www.aaronrutley.com/)
* [photos.jtsternberg.com](http://photos.jtsternberg.com)

(send me your site if you want to be featured here)

Like this plugin? Checkout the [DsgnWrks Twitter Importer](http://j.ustin.co/QbMC8N). Feel free to [contribute to this plugin on github](http://j.ustin.co/QbQKpw).

== Installation ==

1. Upload the `dsgnwrks-instagram-importer` directory to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Visit the plugin settings page (`/wp-admin/tools.php?page=dsgnwrks-instagram-importer-settings`) to add your instagram usernames and adjust your import settings. If you want to see how how the output will look, I suggest you set the date filter to the last month or so. If you have a lot of instagram photos, you may want to import the photos in chunks (set the date further and further back between imports till you have them all) to avoid server overload or timeouts.
4. Import!

== Frequently Asked Questions ==

= Plugin gives me an error! help? =
* Please install the [DsgnWrks Instagram Importer Debug](http://wordpress.org/extend/plugins/dsgnwrks-instagram-importer-debug/) plugin.

= Is it possible to set the default image display size in a post? =
* If you're importing as the featured image and your theme supports featured images, that is the size that will be used. If you're instead importing the image to the post, there is a filter in the plugin for overriding the image size. If you wanted to instead use the "medium" image size created by WordPress, you would filter the image size like this:
`add_filter( 'dsgnwrks_instagram_image_size', 'YOURPREFIX_instagram_img_size' );
function YOURPREFIX_instagram_img_size( $size ) {

	return 'medium';
}`

That is a filter on the $size parameter passed to `wp_get_attachment_image_src()` so you can use any values you would use there. `wp_get_attachment_image_src()` on the codex: http://codex.wordpress.org/Function_Reference/wp_get_attachment_image_src

= Is it possible to limit the length of the imported posts? =
* Yes, use this gist: https://gist.github.com/jtsternberg/6148635

= ?? =
* If you run into a problem or have a question, contact me ([contact form](http://j.ustin.co/scbo43) or [@jtsternberg on twitter](http://j.ustin.co/wUfBD3)). I'll add them here.


== Screenshots ==

1. Welcome Panel.
2. After authenticating a user, this is the options panel you'll be presented with. If you select a custom post-type in the post-type selector, the options may change based on the post-type's supports, as well as any custom taxonomies.

== Changelog ==

= 1.2.9 =
* Bug fix: Made the auto-import feature off by default. Would sometimes be triggered on plugin activation.
* Saved the Instagram username to post-meta (`instagram_username`) along with the entire Instagram user object (`instagram_user`).

= 1.2.9 =
* Bug fix: Made the auto-import feature off by default. Would sometimes be triggered on plugin activation.
* Saved the Instagram username to post-meta (`instagram_username`) along with the entire Instagram user object (`instagram_user`).

= 1.2.8 =
* Bug fix: Tag filter is now more reliable.

= 1.2.7 =
* Bug fix: Adding a new user no longer resets the auto-import frequency setting.
* Bug fix: User settings would occasionally not save correctly.
* Conflict fix: Do not publicize imported posts via Jetpack.
* New: Template tag for getting the instagram image, `dw_get_instagram_image`, and for displaying the image, `dw_instagram_image`.

= 1.2.6 =
* New: Shortcode for displaying instagram embed, `dsgnwrks_instagram_embed`.
* New: `**insta-embed-image**`, and `**insta-embed-video**` import content tags to add the embed shortcode. Using these tags will negate the `**insta-image**` tag.
* New: Plugin option for selecting to remove #hashtags when saving posts' Title/Content/Excerpt.
* New: `dsgnwrks_instagram_import_types` filter - Modify to exclude images or video (or others?) from the import.
* New: `dsgnwrks_instagram_post_excerpt` filter - Modifies the imported posts' excerpts.
* New: `dsgnwrks_instagram_post_title` filter - Modifies the imported posts' titles.
* New: `dsgnwrks_instagram_post_content` filter - Modifies the imported posts' content.
* New: `dsgnwrks_instagram_{$tag}` filter - Allows granular modification of each content tag's replacement.
* Improvement: Better ajax importing of images/posts. Each imported post will show live feedback during the import process.
* Improvement: Better styling for users with MP6 installed.
* Fixed: Authenticating users with Emoji (or other special characters in their bios) would cause the plugin to break.
* Fixed: Post format selector didn't have correct class and so wasn't getting shown correctly.

= 1.2.5 =
* Added: POT translation file.
* Improvement: Import now runs via AJAX, and imported post messages have improved styling.
* Fixed: Previously had no uninstall hook. Now deletes plugin option data (not imported posts) when uninstalling plugin.

= 1.2.4 =
* Fixed: `**insta-image-link**` now pulls in the full 612x612 image size.
* Added: dsgnwrks_instagram_image_size filter for changing from 'full' to any registered image size.
* Added: dsgnwrks_instagram_insta_image filter to allow manipulation of the `**insta-image**` html markup (add classes, etc).

= 1.2.3 =
* Fixed: Better SSL management

= 1.2.2 =
* Added: Option to save Instagram hashtags as taxonomy terms (tags, categories, etc).
* Added: Filter on Settings page to allow other plugins/themes to add extra settings fields.
* Added: More of the Instagram photo data is saved to post_meta. props [csenf](https://github.com/csenf/DsgnWrks-Instagram-Importer-WordPress-Plugin/commit/5816ddade00b92fa0975fb47b49ca8467779e2a4)
* Fixed: Better management and display of API connection errors. props [csenf](https://github.com/csenf/DsgnWrks-Instagram-Importer-WordPress-Plugin/commit/6fec092cafc7d241c1b1d75e4a80b42d28eff2d5)

= 1.2.1 =
* Added: Internationalization (i18n) translation support, and debugging infrastructure.

= 1.2.0 =
* Added: It's finally here! Option to auto-import/backup your instagram shots.

= 1.1.4 =
* Added: Option to conditionally add "insta-text" & "insta-location."
* Updated: Default options when first adding a user, including the "insta-location" conditional in the post content.
* Fixed: When unchecking "set as featured image," the posts would still add the featured image.

= 1.1.3 =
* Fixed: When unchecking "set as featured image" the input would still display as checked

= 1.1.2 =
* Fix infinite redirect when adding a new user

= 1.1.1 =
* Update plugin instructions that state setting the image as featured is required for images to be backed-up. As of version 1.1, this is no longer a requirement.

= 1.1 =
* Convert plugin to an OOP class and remove amazon S3 links from post content. Props to [@UltraNurd](https://github.com/UltraNurd).

= 1.0.2 =
* Fixes a bug with new user profile images not showing correctly

= 1.0.1 =
* Fixed a bug where imported instagram times could be set to the future

= 1.0 =
* Launch.


== Upgrade Notice ==

= 1.2.9 =
* Bug fix: Made the auto-import feature off by default. Would sometimes be triggered on plugin activation.
* Saved the Instagram username to post-meta (`instagram_username`) along with the entire Instagram user object (`instagram_user`).

= 1.2.8 =
* Bug fix: Tag filter is now more reliable.

= 1.2.7 =
* Bug fix: Adding a new user no longer resets the auto-import frequency setting.
* Bug fix: User settings would occasionally not save correctly.
* Conflict fix: Do not publicize imported posts via Jetpack.
* New: Template tag for getting the instagram image, `dw_get_instagram_image`, and for displaying the image, `dw_instagram_image`.

= 1.2.6 =
* New: Shortcode for displaying instagram embed, `dsgnwrks_instagram_embed`.
* New: `**insta-embed-image**`, and `**insta-embed-video**` import content tags to add the embed shortcode. Using these tags will negate the `**insta-image**` tag.
* New: Plugin option for selecting to remove #hashtags when saving posts' Title/Content/Excerpt.
* New: `dsgnwrks_instagram_import_types` filter - Modify to exclude images or video (or others?) from the import.
* New: `dsgnwrks_instagram_post_excerpt` filter - Modifies the imported posts' excerpts.
* New: `dsgnwrks_instagram_post_title` filter - Modifies the imported posts' titles.
* New: `dsgnwrks_instagram_post_content` filter - Modifies the imported posts' content.
* New: `dsgnwrks_instagram_{$tag}` filter - Allows granular modification of each content tag's replacement.
* Improvement: Better ajax importing of images/posts. Each imported post will show live feedback during the import process.
* Improvement: Better styling for users with MP6 installed.
* Fixed: Authenticating users with Emoji (or other special characters in their bios) would cause the plugin to break.
* Fixed: Post format selector didn't have correct class and so wasn't getting shown correctly.

= 1.2.5 =
* Added: POT translation file.
* Improvement: Import now runs via AJAX, and imported post messages have improved styling.
* Fixed: Previously had no uninstall hook. Now deletes plugin option data (not imported posts) when uninstalling plugin.

= 1.2.4 =
* Fixed: `**insta-image-link**` now pulls in the full 612x612 image size.
* Added: dsgnwrks_instagram_image_size filter for changing from 'full' to any registered image size.
* Added: dsgnwrks_instagram_insta_image filter to allow manipulation of the `**insta-image**` html markup (add classes, etc).

= 1.2.3 =
* Fixed: Better SSL management

= 1.2.2 =
* Added: Option to save Instagram hashtags as taxonomy terms (tags, categories, etc).
* Added: Filter on Settings page to allow other plugins/themes to add extra settings fields.
* Added: More of the Instagram photo data is saved to post_meta. props [csenf](https://github.com/csenf/DsgnWrks-Instagram-Importer-WordPress-Plugin/commit/5816ddade00b92fa0975fb47b49ca8467779e2a4)
* Fixed: Better management and display of API connection errors. props [csenf](https://github.com/csenf/DsgnWrks-Instagram-Importer-WordPress-Plugin/commit/6fec092cafc7d241c1b1d75e4a80b42d28eff2d5)

= 1.2.1 =
* Added: Internationalization (i18n) translation support, and debugging infrastructure.

= 1.2.0 =
* Added: It's finally here! Option to auto-import/backup your instagram shots.

= 1.1.4 =
* Added: Option to conditionally add "insta-text" & "insta-location."
* Updated: Default options when first adding a user, including the "insta-location" conditional in the post content.
* Fixed: When unchecking "set as featured image," the posts would still add the featured image.

= 1.1.3 =
* Fixed: When unchecking "set as featured image" the input would still display as checked

= 1.1.2 =
* Fix infinite redirect when adding a new user

= 1.1.1 =
* Update plugin instructions that state setting the image as featured is required for images to be backed-up. As of version 1.1, this is no longer a requirement.

= 1.1 =
* Convert plugin to an OOP class and remove amazon S3 links from post content. Props to [@UltraNurd](https://github.com/UltraNurd).

= 1.0.2 =
* Fixes a bug with new user profile images not showing correctly

= 1.0.1 =
* Fixed a bug where imported instagram times could be set to the future

= 1.0 =
* Launch
