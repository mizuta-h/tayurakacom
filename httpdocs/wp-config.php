<?php

//Begin Really Simple Security session cookie settings
@ini_set('session.cookie_httponly', true);
@ini_set('session.cookie_secure', true);
@ini_set('session.use_only_cookies', true);
//END Really Simple Security cookie settings




/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp_jfqia' );

/** Database username */
define( 'DB_USER', 'wp_shl9p' );

/** Database password */
define( 'DB_PASSWORD', 'O?8TPn%KPpo68wge' );

/** Database hostname */
define( 'DB_HOST', 'localhost:3306' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', ';D01:Y[[2%8:6ZM4d&_R2F9bHmM#eWcq!2|3CJ%zJ4H#3J3~Txg~29U68o6x2T4g');
define('SECURE_AUTH_KEY', '94@F:c/t6;d62;3OsK4E7&*brK29phH3[|K]7&X+1-K4R]*F;g1|z6056K0/4w*D');
define('LOGGED_IN_KEY', '7krX;3a)734#87-9_;gPz|i)N&@ttvZTPwP1mv-pR7xVrRM8k)7s0/0_*h9bHu4)');
define('NONCE_KEY', 'MfO:xL7Oc4;Bn#0P_87t|550KWV+44QQ*56#_@No3eE@+I2vn0lo@m#EEou7/8Yu');
define('AUTH_SALT', '|Fq|#]]uX2:s&@rY-;p4-U#gQ@H60jf|KQ+81BL;U!kNNT0*n*)[9W[;IX~46QsS');
define('SECURE_AUTH_SALT', 'ao3Dcl0YF&23-JSf8p16K)9gQ*Ghz0+4:o9bFK%L(_#R@q|41ti6Jzw+W8VYE-Z9');
define('LOGGED_IN_SALT', '1YdbKah-11tFeB|G+c@47i@tP80036XckU2RcSU6[:/4pAs_!)3pWn%*!Hx7&@is');
define('NONCE_SALT', 'j9Pv046zP+*6v7qA02#)9u%1E#Od3VKT:nun/mh;EZM@c;hP~3zO]V9bBRc!;5];');


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = '6QeprIRz_';


/* Add any custom values between this line and the "stop editing" line. */

define('WP_ALLOW_MULTISITE', true);
/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
