<?php

/**
* Define type of server
*
* Depending on the type other stuff can be configured
* Note: Define them all, don't skip one if other is already defined
*/

define( 'DB_CREDENTIALS_PATH', dirname( __FILE__ ) ); // cache it for multiple use
define( 'WP_LOCAL_SERVER', file_exists( DB_CREDENTIALS_PATH . '/local-config.php' ) );
define( 'WP_DEV_SERVER', file_exists( DB_CREDENTIALS_PATH . '/dev-config.php' ) );

/**
* Load DB credentials
*/

if ( WP_LOCAL_SERVER )
    require DB_CREDENTIALS_PATH . '/local-config.php';
elseif ( WP_DEV_SERVER )
    require DB_CREDENTIALS_PATH . '/dev-config.php';
else
    require DB_CREDENTIALS_PATH . '/production-config.php';

/**
* Authentication Unique Keys and Salts.
*
* Change these to different unique phrases!
* You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
* You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
*/

if ( ! defined( 'AUTH_KEY' ) )
    define('AUTH_KEY', '8OJ|?J@+sR/_<+*`QYjD^k{4g!<?(|2^wk2{bX:C]AzROVW0l8+&!=kQ|i7_01oK');
if ( ! defined( 'SECURE_AUTH_KEY' ) )
    define('SECURE_AUTH_KEY', 'NY*AC:3uKTBd#WaZDk8ry0Wd,7G><0+E@j1;<)4$F2#gaK36i=7d!uPchx9PiHXG');
if ( ! defined( 'LOGGED_IN_KEY' ) )
    define('LOGGED_IN_KEY', '`EVRr$zF,>p8t&7HHRL~+$7a9ASR&#[jpS0s=g!+Mh=&2j@}Sj,+$9x`>I<HcU 7');
if ( ! defined( 'NONCE_KEY' ) )
    define('NONCE_KEY', 'y8[-`4(}>~8JJ?ddd2_rM^#1HZVh-R/$EM|?V8s9~a;uC,sF=D;UR3WDl=XKg+EQ');
if ( ! defined( 'AUTH_SALT' ) )
    define('AUTH_SALT', '%mh]NCBU}n/U^xPqAfanP||#Zg)OrTs}0FJ<<?6E;QCX}Mb~K]^0!g_=j*1cQiL*');
if ( ! defined( 'SECURE_AUTH_SALT' ) )
    define('SECURE_AUTH_SALT', '@lr & 4F/<bW<uuofdVp|#xpppTm0,0 #I]x |W*Fx~+t5p)U1F6aiG<Al]q!?S{');
if ( ! defined( 'LOGGED_IN_SALT' ) )
    define('LOGGED_IN_SALT', 'Iea|+ h)Zr_$:B^_-dx?3(s<i4-};wrqQSweB<ESjYxm|`W~P%*hg)cH+}+H[g+W');
if ( ! defined( 'NONCE_SALT' ) )
    define('NONCE_SALT', '!oz}a^ORMQbTuX,#-RxEv[o&wt+pd&ZIVjBC-K;`o4d%r(iVb1YZWK{+j-FQNgfR');

/**
* WordPress Database Table prefix.
*
* You can have multiple installations in one database if you give each a unique
* prefix. Only numbers, letters, and underscores please!
*/

$table_prefix = 'wp_';

/**
* WordPress Localized Language, defaults to English.
*
* Change this to localize WordPress. A corresponding MO file for the chosen
* language must be installed to wp-content/languages. For example, install
* de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
* language support.
*/

define( 'WPLANG', '' );

/**
* For developers: WordPress debugging mode.
*
* Change this to true to enable the display of notices during development.
* It is strongly recommended that plugin and theme developers use WP_DEBUG
* in their development environments.
*/

if ( WP_LOCAL_SERVER || WP_DEV_SERVER ) {

    define( 'WP_DEBUG', true );
    define( 'WP_DEBUG_LOG', true ); // Stored in wp-content/debug.log
    define( 'WP_DEBUG_DISPLAY', true );

    define( 'SCRIPT_DEBUG', true );
    define( 'SAVEQUERIES', true );

} else if ( WP_STAGING_SERVER ) {

    define( 'WP_DEBUG', true );
    define( 'WP_DEBUG_LOG', true ); // Stored in wp-content/debug.log
    define( 'WP_DEBUG_DISPLAY', false );

} else {

    define( 'WP_DEBUG', false );
}


/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');