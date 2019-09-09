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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'myblog' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'Ahmed13/10/1996' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         'OYKl>^n/[let&NU8Qj+uY[8m(%dDzXi_Z?GANlWQg1+$>}B(Oxci;64Rk<pSnrrM' );
define( 'SECURE_AUTH_KEY',  'R5*1B@gGE<eKQ@~NFWB`Fb2K?45iXw(1Aka.0go9rB6(!)V739*{U~W/fKJY,Ogj' );
define( 'LOGGED_IN_KEY',    'l<c34[)b_Jt~oUFGv`/<;_>k})nCQgHG|u /]Dm<wP,7G699t$=2;|pqxLryU8VS' );
define( 'NONCE_KEY',        ' L|n&E6,dYw<1+L4j&E@?6s%U@sNJF/Jp5(5-ymWEY[hts`~Zt(G7ZOneB7aueK%' );
define( 'AUTH_SALT',        'd6d[Y;r>@Q}dA[Y}atAg||# /~yA1Sk<1 yG{_bz0oh4PcU>=v3k{,#WDs(%1_x1' );
define( 'SECURE_AUTH_SALT', 'AsVvH`9r9FoKTypQ+n8mj0b{VC(78`s(;Rz)>$FK*oMJ1I^.gCu3Z9Fq7ub(hf>)' );
define( 'LOGGED_IN_SALT',   'FARF<J.&l^.(Jt&KnF+WVEU,J%B`OsS}WI~K#9h#XdNhXrcM,.vfDx0buv6<Dcs6' );
define( 'NONCE_SALT',       'q@[/tsKl8WgPw3A.`U+^h( SrI`dlYS*:T;.jUIrB8^Hi;:T5u%GeD9B^SYzxNmR' );

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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
define('FS_METHOD', 'direct');
