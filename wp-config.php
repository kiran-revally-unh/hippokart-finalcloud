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

 * @link https://wordpress.org/documentation/article/editing-wp-config-php/

 *

 * @package WordPress

 */


// ** Database settings - You can get this info from your web host ** //

/** The name of the database for WordPress */

define( 'DB_NAME', 'bitnami_wordpress' );


/** Database username */

define( 'DB_USER', 'bn_wordpress' );


/** Database password */

define( 'DB_PASSWORD', 'f8e2279e741b3f6be7de8c6a02935edfbbafbeb447a085cc4d6a50384c955e6c' );


/** Database hostname */

define( 'DB_HOST', '127.0.0.1:3306' );


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

define( 'AUTH_KEY',         'k;)bzMA-[}MP#4CUi,8#:df>;ZI1mlY:#/Obl-b*x)tVWy^rZCR=zA6&6p5{1d,o' );

define( 'SECURE_AUTH_KEY',  'S!}vC!b#hN)yQ]n^:t}-h )L|uo4KHld#r&v`66j,y$C ;ti$J5t<f-acTNy8YT%' );

define( 'LOGGED_IN_KEY',    '0Q#szCQ-7pdsDFnn/MEulC7B_?%kQ0d$.#IPBh?g97r^v&HzXg;BjW;cs0q 4&FU' );

define( 'NONCE_KEY',        '.4J3kXJ9-t3n6PPQUz{sMW~[2)1Vlj[Rw}`87Fc[`&[51tUq:0&Sf8[2/Nr]Q1g-' );

define( 'AUTH_SALT',        'J%jZLn3!]~8&yXV(uI|eQ/8geceh43$t%zvsQl..xMp%6)ETgwJp~kpYyP(T[.*;' );

define( 'SECURE_AUTH_SALT', 'y7tDNFYrPmcjxj:kv1:6r@MTX;rQ``UXo=UTZYnl8P3g_qN }+|(ST`2|(MG60oK' );

define( 'LOGGED_IN_SALT',   '%XN||mmAp{-&_Z]S=/s,h(uNMKAvn`L28GdzfTG&2v%cYG?}e076DnK45:#RB[H8' );

define( 'NONCE_SALT',       '[L#hhr5@Xw397`l^ecvE9K{s%eaJ7f `r/6$!t95rvy1$rN}S!ngl;+Jo$Re;lG' );


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

 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/

 */

define( 'WP_DEBUG', false );


/* Add any custom values between this line and the "stop editing" line. */




define( 'FS_METHOD', 'direct' );
/**
 * The WP_SITEURL and WP_HOME options are configured to access from any hostname or IP address.
 * If you want to access only from an specific domain, you can modify them. For example:
 *  define('WP_HOME','http://example.com');
 *  define('WP_SITEURL','http://example.com');
 *
 */
if ( defined( 'WP_CLI' ) ) {
	$_SERVER['HTTP_HOST'] = '127.0.0.1';
}

define( 'WP_HOME', 'http://' . $_SERVER['HTTP_HOST'] . '/' );
define( 'WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST'] . '/' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */


/** Absolute path to the WordPress directory. */

if ( ! defined( 'ABSPATH' ) ) {

	define( 'ABSPATH', __DIR__ . '/' );

}


/** Sets up WordPress vars and included files. */

require_once ABSPATH . 'wp-settings.php';

/**
 * Disable pingback.ping xmlrpc method to prevent WordPress from participating in DDoS attacks
 * More info at: https://docs.bitnami.com/general/apps/wordpress/troubleshooting/xmlrpc-and-pingback/
 */
if ( !defined( 'WP_CLI' ) ) {
	// remove x-pingback HTTP header
	add_filter("wp_headers", function($headers) {
		unset($headers["X-Pingback"]);
		return $headers;
	});
	// disable pingbacks
	add_filter( "xmlrpc_methods", function( $methods ) {
		unset( $methods["pingback.ping"] );
		return $methods;
	});
}
