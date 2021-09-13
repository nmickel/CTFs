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
define( 'DB_NAME', getenv('DB_NAME') );

/** MySQL database username */
define( 'DB_USER', getenv('DB_USER') );

/** MySQL database password */
define( 'DB_PASSWORD', getenv('DB_PASSWORD') );

/** MySQL hostname */
define( 'DB_HOST', getenv('DB_HOST') );

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
define( 'AUTH_KEY',         '$MJ)EbOhn*)*R`/X9[Kii%BdlvYQG+TU=]b3`y!4+l.~{n}+W-,a!]U+mq>(.y33' );
define( 'SECURE_AUTH_KEY',  '<ySNx4_yN6ojGT_~`XK2[<DjV2NH-wDrg4p6h~HECp+m31<0$hKS(slverDQzEqN' );
define( 'LOGGED_IN_KEY',    'ZaJ+:ezC6g^Q(=h,?~D!8~7RN-2|7m,o.Go&Am% GOpKKa-z}K#,IPX^T6DF&)Ud' );
define( 'NONCE_KEY',        '4GFFHs3443`!z.?Ka.;Cd-){?u>dT^R$VKn9u&no}]PZBf|lsIh)>,KYic_r>dPP' );
define( 'AUTH_SALT',        'k,64G,YQ3c+`3h(M2s|;(Af=#d@U*;j0:O**W7Z_7PDXF}%7N6_AyyS[Ss:XQd7e' );
define( 'SECURE_AUTH_SALT', '@MkS%}b2H}V;0,|}[p)N),B$4N-*U;C)5HS$Ljf<gws5a!jw5c&1pi`}ED1Bv/w#' );
define( 'LOGGED_IN_SALT',   '_xH0/@WLHYCrsS<p4O^N0deLB:3i<E*DFeMu 09O?z/CHDWvY]DO6Of@870@YZ$b' );
define( 'NONCE_SALT',       ' pwI4tfA a<,*;Yj+v15kmI=tL(h0klADg}~gyFa`~1?$hXx(CuQ#r(6rIfVd-Uz' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
