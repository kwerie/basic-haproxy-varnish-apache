<?php
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
 * * ABSPATH
 *
 * This has been slightly modified (to read environment variables) for use in Docker.
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// IMPORTANT: this file needs to stay in-sync with https://github.com/WordPress/WordPress/blob/master/wp-config-sample.php
// (it gets parsed by the upstream wizard in https://github.com/WordPress/WordPress/blob/f27cb65e1ef25d11b535695a660e7282b98eb742/wp-admin/setup-config.php#L356-L392)


// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wpdb' );

/** Database username */
define( 'DB_USER', 'wpuser' );

/** Database password */
define( 'DB_PASSWORD', 'wp' );

/**
 * Docker image fallback values above are sourced from the official WordPress installation wizard:
 * https://github.com/WordPress/WordPress/blob/f9cc35ebad82753e9c86de322ea5c76a9001c7e2/wp-admin/setup-config.php#L216-L230
 * (However, using "example username" and "example password" in your database is strongly discouraged.  Please use strong, random credentials!)
 */

/** Database hostname */
//define( 'DB_HOST', 'localhost' );
define( 'DB_HOST', 'db01' );

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
define('AUTH_KEY',         '-`.C#.#n2 7td!CW:I<v20)u%YaB3snx)M#F+Wf^!N7!.<+a21{]]vm2y)<s{)>]');
define('SECURE_AUTH_KEY',  'c]-.GnZO?Ewq{s`|yV|n5t7)Gdj+.)TeJ39LU,yP&.-EL-hMRY}7W^VS*4tGVpvj');
define('LOGGED_IN_KEY',    'k/G`PE=(;+6s7]Ck*mG:_,qCiD&ke0y-:l]_u[k^#qXL@ju*G5f@^ny=LbgtHv0{');
define('NONCE_KEY',        'tSZXUnOvB>m8,h:khsggG_e(!WzfZ[K+i/)F6Xy1SIS9s4IaAygyYyeLL35%*{l-');
define('AUTH_SALT',        '7<U|N!aS+UA6]V{~a07wJDe941VA&*x!mPIR0+kZ>EU6qnf4,Q=ku(j]/5SK>m$s');
define('SECURE_AUTH_SALT', '|gb{y8aBoR3qozPT~_1.D@.- 2Sw}+-]u+<Y1Dk:~W+3g-+k|^^(?;aifq9I|sed');
define('LOGGED_IN_SALT',   '$g<[~upr`F{+Y(p.]l>uhdX-usE6S6HrW02n&hZD7#d?2JWFTR)VOB!kX5;!j5-7');
define('NONCE_SALT',       '[&&5@N(kX&Re3:5#E5{T!&Io~N4IDN-T>8Z{*gB9WU,RMe1u?? IePtZz([T<;}X');
// (See also https://wordpress.stackexchange.com/a/152905/199287)

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */

// If we're behind a proxy server and using HTTPS, we need to alert WordPress of that fact
// see also https://wordpress.org/support/article/administration-over-ssl/#using-a-reverse-proxy
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && strpos($_SERVER['HTTP_X_FORWARDED_PROTO'], 'https') !== false) {
	$_SERVER['HTTPS'] = 'on';
}
// (we include this by default because reverse proxying is extremely common in container environments)


/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
