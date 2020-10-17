<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */
// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', "tutoriales-para" );
/** MySQL database username */
define( 'DB_USER', "root" );
/** MySQL database password */
define( 'DB_PASSWORD', "" );
/** MySQL hostname */
define( 'DB_HOST', "localhost" );
/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );
/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );
/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'za2ul6dbr9lq4ly42tns0gjcgm0gbvfsodemhpsjcweq79be22ua4ci0oh0ft3ai' );
define( 'SECURE_AUTH_KEY',  'lexrcb6hs5tgjzwjugxluoodovkzgiyvbvsaax8zgyq22myfca3mdkotarqvxpaf' );
define( 'LOGGED_IN_KEY',    '8md8w6ag6ke6z5vnsmzjduj1zcrhorneus8ojf1lao8rbyegv2vsz4esyx4ua96a' );
define( 'NONCE_KEY',        'dhjghiu0lurrj4pqpynogegxvqxieyykfi3tewxeve4wesochmiaze4jpntajwdp' );
define( 'AUTH_SALT',        'd2h7kszwuz8wvgxrvbzecwubhbn6i4tfxygqcifjhtaiixyrwgpix2uodyzbfm5y' );
define( 'SECURE_AUTH_SALT', 'h8c5uctmbl1ta8intmuhrzo11v6qjmy57vicjotwz4t1bjribwvp31ddjootvfrd' );
define( 'LOGGED_IN_SALT',   'a8m0qmdkwqbqxmvga6laichj2chyn0qpsxvl3a3oq43lfuwoeihpj9woim7vtffm' );
define( 'NONCE_SALT',       'b0wslzfnvhnzzgzjditppmphlhazkzvg1rj5ih7qa1hwj10xdqlun8tlgzqmfdah' );
/**#@-*/
/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 't4Bl43_';
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
/* That's all, stop editing! Happy publishing. */
/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}
/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
