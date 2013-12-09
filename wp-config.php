<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */
 
// Include local configuration
if (file_exists(dirname(__FILE__) . '/local-config.php')) {
	include(dirname(__FILE__) . '/local-config.php');
}

// Global DB config
if (!defined('DB_NAME')) {
	define('DB_NAME', 'ajoto2');
}
if (!defined('DB_USER')) {
	define('DB_USER', 'root');
}
if (!defined('DB_PASSWORD')) {
	define('DB_PASSWORD', 'root');
}
if (!defined('DB_HOST')) {
	define('DB_HOST', 'localhost');
}

/** Database Charset to use in creating database tables. */
if (!defined('DB_CHARSET')) {
	define('DB_CHARSET', 'utf8');
}

/** The Database Collate type. Don't change this if in doubt. */
if (!defined('DB_COLLATE')) {
	define('DB_COLLATE', '');
}

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         ' xk|w=}:F- ~FV?)Ce9Q+!AKS7s:(Y)N)%~=t[`+s0dfn u4Zm{p6ruA4%vDSw$O');
define('SECURE_AUTH_KEY',  '%S!pq>x;;`Qz}Ob8+|d9fZ v..97}2jK|LU6`0wJjQCF+QP:kiY!T/D;|Jkayoqe');
define('LOGGED_IN_KEY',    'Cv*G~20c]D{SC4JJ|%yB%->~BhpsaSE(%y5TQAh{wam+]u7M,V<Nv)-$BgBKgWS{');
define('NONCE_KEY',        'I9?m%nJA!Z6DlI+_E.+a6dqsV^8aPnN`}3L*z{vux|S_Eg$+XDwc1}-t~|xF|S5G');
define('AUTH_SALT',        '{(RNt/%o[>e_}[*4cCsw:v{hSuK&b~dh9~lRAh]zw=s8Fn[G 1_{!#}0v7huCyYS');
define('SECURE_AUTH_SALT', '6EhZd%(a6q/K$/+7tgcugS%rAr_:wkvRy=/(CcMz,>mM45H#r/MAV5CU<4D=?WA~');
define('LOGGED_IN_SALT',   '0fPo P/DUWh~4Fyb$.{:iJNkbX%p--+7`57q+)j,xTwhZY7m# 5)b7$Dbf4t_wH%');
define('NONCE_SALT',       'Fs|iS=V/W1-vvtV:vRp].C}Uw=[3;|9sVIS0;bRb.{RuO21rySkudt>aj]2&.}+R');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'aj_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');


/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
if (!defined('WP_DEBUG')) {
	define('WP_DEBUG', false);
}

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
