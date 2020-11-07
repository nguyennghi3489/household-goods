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
define( 'DB_NAME', 'han62435_household-goods' );

/** MySQL database username */
define( 'DB_USER', 'han62435_root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'Ngh1G1aLa1@!@!' );

/** MySQL hostname */
define( 'DB_HOST', '127.0.0.1' );

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
define( 'AUTH_KEY',         'pB#@G~lX?4|gNc.h(^DzaSsQP^Z Bc7~_LY$mt1#0QGqm,hSX])A6hd4!-Kj^o8w' );
define( 'SECURE_AUTH_KEY',  '(sxhZ$?N_e)X,0,0K>tj9J$6RE =RWU5r[)jPb;GyWgx$DL }paDkB6 Dt#E!n1>' );
define( 'LOGGED_IN_KEY',    '6aYn}]mdsi@8!6(N >yJWwP^Y29!f~q2jMc,*o% ~9i1`9^ib0]4VU:fOBPXQT-5' );
define( 'NONCE_KEY',        'WC&q88]z=}p~7 ag1|Hxg;QcnJ*F8h{OQ6UQj}^g-A%o>|w&Av_CM5!=xc*#G.^`' );
define( 'AUTH_SALT',        'Fhe< $X;l>i;uj4t#xU+*,h)pi<Aqw3sIjiT$gtWDCjfuyt/onD/z}otzzm RIZQ' );
define( 'SECURE_AUTH_SALT', ' y!}% G%Eg)0TL?7|3#-.Lv~k0|z&kvO!&H[P]rCw<,_jIuaq8/$|WR6GM8CUh(x' );
define( 'LOGGED_IN_SALT',   'H=N!!E;FF:-)+!x7D^nE`%EH2{{wbP^vH7j8bN#3ztM|%9t:zt{M~(c{$8|&)fIq' );
define( 'NONCE_SALT',       'zt5tr3o:p>7~4cg6)2|(BOTiL(LE#{X(zKB~&<OFEP_NnEgIG<`:+6O_.2vgf)o3' );

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

